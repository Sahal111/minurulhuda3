"""
Class Search
============

Retrieves class definitions, including properties and method signatures.
Provides a "skeleton" view of a class to understand its structure without
reading the entire file (which could be >60KB for fat controllers).
"""

from typing import List, Optional, Dict
from pathlib import Path

from .indexer import CodeIndex, ClassInfo
from .symbol_search import SymbolSearcher, SearchResult


class ClassSearcher:
    """
    Search and retrieve class structures.

    Usage:
        searcher = ClassSearcher(index, project_root)
        skeleton = searcher.get_class_skeleton("SiswaController")
    """

    def __init__(self, index: CodeIndex, project_root: str):
        self.index = index
        self.project_root = Path(project_root)
        self.symbol_searcher = SymbolSearcher(index, project_root)

    def search(self, class_name: str) -> List[SearchResult]:
        """Search for classes by name (delegates to SymbolSearcher)."""
        return self.symbol_searcher.search(class_name, symbol_types=["class"], top_k=5)

    def get_class_info(self, class_name: str) -> Optional[ClassInfo]:
        """Get ClassInfo by exact or partial name."""
        # Exact match first
        if class_name in self.index.classes:
            return self.index.classes[class_name]

        # Partial match (case-insensitive, match end of FQN)
        class_name_lower = class_name.lower()
        best_match = None
        for fqn, cls in self.index.classes.items():
            if fqn.lower().endswith(class_name_lower):
                return cls
            if class_name_lower in fqn.lower():
                best_match = cls
        
        return best_match

    def get_class_skeleton(self, class_name: str) -> Optional[str]:
        """
        Generate a minimal "skeleton" representation of a class.
        Includes namespace, class definition, properties, and method signatures (no bodies).
        """
        cls = self.get_class_info(class_name)
        if not cls:
            return None

        lines = []
        if cls.namespace:
            lines.append(f"namespace {cls.namespace};\n")

        # Class definition
        parts = [cls.type, cls.name]
        if cls.extends:
            parts.extend(["extends", cls.extends])
        if cls.implements:
            parts.extend(["implements", ", ".join(cls.implements)])
        
        lines.append(" ".join(parts) + " {")

        # Traits
        if cls.traits:
            lines.append(f"    use {', '.join(cls.traits)};")
            lines.append("")

        # Properties
        if cls.properties:
            for prop in cls.properties:
                lines.append(f"    ${prop};")
            lines.append("")

        # Method signatures
        methods = []
        for fqn, method in self.index.methods.items():
            if method.class_name == cls.name:
                methods.append(method)

        for method in methods:
            # Reconstruct signature
            visibility = f"{method.visibility} " if method.visibility else ""
            static = "static " if method.is_static else ""
            lines.append(f"    {visibility}{static}function {method.name}({method.parameters}) {{ ... }}")
            
        lines.append("}")

        return "\n".join(lines)
