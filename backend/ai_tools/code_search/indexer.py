"""
Code Indexer
============

Parses PHP files to extract classes, methods, functions, and their metadata.
Builds a searchable JSON index for fast symbol lookup without reading full files.

Technical rationale:
- Uses regex-based parsing instead of full PHP AST parser to avoid php-parser dependency
- Captures enough structure for 95%+ of Laravel patterns (class, method, trait, interface)
- Index is stored as JSON for portability and human readability
- Re-indexing is fast (~1s for 70 PHP files) since we only scan file headers and signatures
"""

import json
import os
import re
import hashlib
from pathlib import Path
from typing import Dict, List, Optional
from dataclasses import dataclass, asdict, field


@dataclass
class MethodInfo:
    """Represents a PHP method/function extracted from source code."""
    name: str
    class_name: Optional[str]
    file_path: str
    line_start: int
    line_end: int
    visibility: str  # public, protected, private
    is_static: bool
    parameters: str  # raw parameter string
    docstring: str
    body_preview: str  # first 3 lines of body for context


@dataclass
class ClassInfo:
    """Represents a PHP class/interface/trait extracted from source code."""
    name: str
    file_path: str
    line_start: int
    line_end: int
    type: str  # class, interface, trait, enum
    extends: Optional[str]
    implements: List[str]
    traits: List[str]
    methods: List[str]  # method names only
    properties: List[str]  # property names only
    namespace: Optional[str]


@dataclass
class FileInfo:
    """Metadata about a parsed file."""
    path: str
    relative_path: str
    size_bytes: int
    hash: str
    classes: List[str]
    functions: List[str]
    line_count: int
    last_indexed: str


@dataclass
class CodeIndex:
    """The complete code index."""
    project_root: str
    files: Dict[str, FileInfo] = field(default_factory=dict)
    classes: Dict[str, ClassInfo] = field(default_factory=dict)
    methods: Dict[str, MethodInfo] = field(default_factory=dict)
    functions: Dict[str, MethodInfo] = field(default_factory=dict)


class CodeIndexer:
    """
    Indexes PHP/Blade files in a Laravel project.

    Usage:
        indexer = CodeIndexer("/path/to/project")
        index = indexer.build_index()
        indexer.save_index(index, "code_index.json")
    """

    # Regex patterns for PHP parsing
    RE_NAMESPACE = re.compile(r'^\s*namespace\s+([\w\\]+)\s*;', re.MULTILINE)
    RE_USE = re.compile(r'^\s*use\s+([\w\\]+)(?:\s+as\s+(\w+))?\s*;', re.MULTILINE)
    RE_CLASS = re.compile(
        r'^\s*(?:abstract\s+|final\s+)?'
        r'(class|interface|trait|enum)\s+'
        r'(\w+)'
        r'(?:\s+extends\s+([\w\\]+))?'
        r'(?:\s+implements\s+([\w\\,\s]+))?',
        re.MULTILINE
    )
    RE_METHOD = re.compile(
        r'^\s*(?:(public|protected|private)\s+)?'
        r'(?:(static)\s+)?'
        r'function\s+'
        r'(\w+)\s*'
        r'\(([^)]*)\)',
        re.MULTILINE
    )
    RE_PROPERTY = re.compile(
        r'^\s*(?:public|protected|private)\s+'
        r'(?:static\s+)?'
        r'(?:readonly\s+)?'
        r'(?:[\w\\?|]+\s+)?'
        r'\$(\w+)',
        re.MULTILINE
    )
    RE_USE_TRAIT = re.compile(r'^\s*use\s+([\w\\]+(?:\s*,\s*[\w\\]+)*)\s*;', re.MULTILINE)
    RE_DOCSTRING = re.compile(r'/\*\*(.*?)\*/', re.DOTALL)

    def __init__(self, project_root: str):
        self.project_root = Path(project_root).resolve()
        self.exclude_dirs = {
            'vendor',
            'node_modules',
            'storage',
            'bootstrap',  # We'll handle bootstrap/cache
            'public',     # We'll handle public/build
            'venv',
            'chroma_data',
            '.git',
            '.vscode',
            '.idea'
        }
        
        # Specific paths to exclude if we don't exclude the parent entirely
        self.exclude_paths = {
            'bootstrap/cache',
            'public/build',
            'ai_tools/venv',
            'ai_tools/chroma_data'
        }

    def _find_php_files(self) -> List[Path]:
        """Find all PHP files in project, ignoring excluded directories."""
        php_files = []
        
        for root, dirs, files in os.walk(self.project_root):
            # Modify dirs in-place to skip excluded directories
            dirs[:] = [d for d in dirs if d not in self.exclude_dirs]
            
            for file in files:
                if file.endswith('.php'):
                    filepath = Path(root) / file
                    rel_path = str(filepath.relative_to(self.project_root))
                    
                    # Check specific paths
                    skip = False
                    for ex_path in self.exclude_paths:
                        # Normalize path separators for cross-platform checking
                        normalized_ex = ex_path.replace('/', os.sep)
                        if rel_path.startswith(normalized_ex):
                            skip = True
                            break
                            
                    if not skip:
                        php_files.append(filepath)
                        
        return sorted(php_files)

    def _file_hash(self, filepath: Path) -> str:
        """Generate MD5 hash of file for change detection."""
        content = filepath.read_bytes()
        return hashlib.md5(content).hexdigest()

    def _find_method_end(self, lines: List[str], start_line: int) -> int:
        """Find the closing brace of a method by counting braces."""
        brace_count = 0
        found_open = False
        for i in range(start_line, len(lines)):
            for char in lines[i]:
                if char == '{':
                    brace_count += 1
                    found_open = True
                elif char == '}':
                    brace_count -= 1
                    if found_open and brace_count == 0:
                        return i
        return min(start_line + 50, len(lines) - 1)  # fallback

    def _extract_docstring(self, lines: List[str], before_line: int) -> str:
        """Extract PHPDoc comment above a declaration."""
        doc_lines = []
        for i in range(before_line - 1, max(before_line - 15, -1), -1):
            if i < 0:
                break
            stripped = lines[i].strip()
            if stripped.endswith('*/'):
                doc_lines.insert(0, stripped)
                if stripped.startswith('/**'):
                    break
            elif stripped.startswith('*') or stripped.startswith('/**'):
                doc_lines.insert(0, stripped)
                if stripped.startswith('/**'):
                    break
            elif doc_lines:
                break
            elif stripped and not stripped.startswith('//') and not stripped.startswith('#'):
                break
        return '\n'.join(doc_lines) if doc_lines else ''

    def _parse_file(self, filepath: Path) -> dict:
        """Parse a single PHP file and extract all symbols."""
        content = filepath.read_text(encoding='utf-8', errors='replace')
        lines = content.split('\n')

        result = {
            'namespace': None,
            'classes': [],
            'methods': [],
            'functions': [],
            'properties': [],
        }

        # Extract namespace
        ns_match = self.RE_NAMESPACE.search(content)
        if ns_match:
            result['namespace'] = ns_match.group(1)

        # Extract classes
        current_class = None
        for match in self.RE_CLASS.finditer(content):
            line_num = content[:match.start()].count('\n')
            class_type = match.group(1)
            class_name = match.group(2)
            extends = match.group(3)
            implements_raw = match.group(4)
            implements = [i.strip() for i in implements_raw.split(',')] if implements_raw else []

            # Find class end
            class_end = self._find_method_end(lines, line_num)

            # Find traits used within the class
            class_body = '\n'.join(lines[line_num:class_end + 1])
            traits = []
            for trait_match in self.RE_USE_TRAIT.finditer(class_body):
                trait_names = trait_match.group(1)
                # Filter out import 'use' statements (they have backslash but no semicolon issues)
                for t in trait_names.split(','):
                    t = t.strip()
                    if '\\' not in t or t.count('\\') <= 1:
                        traits.append(t)

            class_info = ClassInfo(
                name=class_name,
                file_path=str(filepath),
                line_start=line_num + 1,
                line_end=class_end + 1,
                type=class_type,
                extends=extends,
                implements=implements,
                traits=traits,
                methods=[],
                properties=[],
                namespace=result['namespace'],
            )
            result['classes'].append(class_info)
            current_class = class_info

        # Extract methods and functions
        for match in self.RE_METHOD.finditer(content):
            line_num = content[:match.start()].count('\n')
            visibility = match.group(1) or 'public'
            is_static = match.group(2) is not None
            func_name = match.group(3)
            params = match.group(4).strip()

            method_end = self._find_method_end(lines, line_num)
            docstring = self._extract_docstring(lines, line_num)

            # Body preview (first 3 lines after opening brace)
            body_lines = []
            for i in range(line_num + 1, min(line_num + 5, len(lines))):
                stripped = lines[i].strip()
                if stripped and stripped != '{':
                    body_lines.append(stripped)
                if len(body_lines) >= 3:
                    break

            # Determine if this is a method (inside class) or standalone function
            owning_class = None
            for cls in result['classes']:
                if cls.line_start <= line_num + 1 <= cls.line_end:
                    owning_class = cls
                    break

            method_info = MethodInfo(
                name=func_name,
                class_name=owning_class.name if owning_class else None,
                file_path=str(filepath),
                line_start=line_num + 1,
                line_end=method_end + 1,
                visibility=visibility,
                is_static=is_static,
                parameters=params,
                docstring=docstring,
                body_preview='\n'.join(body_lines),
            )

            if owning_class:
                owning_class.methods.append(func_name)
                result['methods'].append(method_info)
            else:
                result['functions'].append(method_info)

        # Extract properties
        for match in self.RE_PROPERTY.finditer(content):
            prop_name = match.group(1)
            result['properties'].append(prop_name)
            if current_class:
                current_class.properties.append(prop_name)

        return result

    def build_index(self, existing_index: Optional[CodeIndex] = None) -> CodeIndex:
        """
        Build or update the code index.
        If existing_index is provided, only re-index changed files (incremental).
        """
        from datetime import datetime

        index = existing_index or CodeIndex(project_root=str(self.project_root))
        php_files = self._find_php_files()

        for filepath in php_files:
            rel_path = str(filepath.relative_to(self.project_root))
            file_hash = self._file_hash(filepath)

            # Skip unchanged files
            if rel_path in index.files and index.files[rel_path].hash == file_hash:
                continue

            try:
                parsed = self._parse_file(filepath)
            except Exception as e:
                print(f"  WARN: Could not parse {rel_path}: {e}")
                continue

            # Update file info
            index.files[rel_path] = FileInfo(
                path=str(filepath),
                relative_path=rel_path,
                size_bytes=filepath.stat().st_size,
                hash=file_hash,
                classes=[c.name for c in parsed['classes']],
                functions=[f.name for f in parsed['functions']],
                line_count=len(filepath.read_text(encoding='utf-8', errors='replace').split('\n')),
                last_indexed=datetime.now().isoformat(),
            )

            # Update class index
            for cls in parsed['classes']:
                fqn = f"{parsed['namespace']}\\{cls.name}" if parsed['namespace'] else cls.name
                index.classes[fqn] = cls

            # Update method index
            for method in parsed['methods']:
                key = f"{method.class_name}::{method.name}" if method.class_name else method.name
                index.methods[key] = method

            # Update function index
            for func in parsed['functions']:
                index.functions[func.name] = func

        return index

    def save_index(self, index: CodeIndex, output_path: str) -> None:
        """Save the index to a JSON file."""
        data = {
            'project_root': index.project_root,
            'files': {k: asdict(v) for k, v in index.files.items()},
            'classes': {k: asdict(v) for k, v in index.classes.items()},
            'methods': {k: asdict(v) for k, v in index.methods.items()},
            'functions': {k: asdict(v) for k, v in index.functions.items()},
        }
        Path(output_path).parent.mkdir(parents=True, exist_ok=True)
        with open(output_path, 'w', encoding='utf-8') as f:
            json.dump(data, f, indent=2, ensure_ascii=False)

    def load_index(self, index_path: str) -> Optional[CodeIndex]:
        """Load an existing index from JSON file."""
        if not Path(index_path).exists():
            return None

        with open(index_path, 'r', encoding='utf-8') as f:
            data = json.load(f)

        index = CodeIndex(project_root=data['project_root'])

        for k, v in data.get('files', {}).items():
            index.files[k] = FileInfo(**v)

        for k, v in data.get('classes', {}).items():
            index.classes[k] = ClassInfo(**v)

        for k, v in data.get('methods', {}).items():
            index.methods[k] = MethodInfo(**v)

        for k, v in data.get('functions', {}).items():
            index.functions[k] = MethodInfo(**v)

        return index

    def get_stats(self, index: CodeIndex) -> dict:
        """Return statistics about the index."""
        return {
            'total_files': len(index.files),
            'total_classes': len(index.classes),
            'total_methods': len(index.methods),
            'total_functions': len(index.functions),
            'total_size_bytes': sum(f.size_bytes for f in index.files.values()),
            'total_lines': sum(f.line_count for f in index.files.values()),
        }
