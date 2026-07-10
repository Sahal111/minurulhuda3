"""
Symbol Search
=============

Exact and fuzzy symbol lookup in the code index.
Searches for classes, methods, functions, and properties by name.

Technical rationale:
- Exact match first (O(1) dict lookup), then fuzzy fallback
- Fuzzy matching uses simple substring + Levenshtein-like scoring
- Returns code snippets with line ranges, not full files
- This is the primary tool for reducing token usage: instead of reading
  a 68KB controller, we return only the 50-line method that matters
"""

import re
from typing import List, Optional, Tuple
from pathlib import Path
from dataclasses import dataclass

from .indexer import CodeIndex, ClassInfo, MethodInfo


@dataclass
class SearchResult:
    """A single search result with code snippet."""
    symbol_name: str
    symbol_type: str  # class, method, function
    file_path: str
    relative_path: str
    line_start: int
    line_end: int
    snippet: str
    score: float  # 0.0 - 1.0 relevance


class SymbolSearcher:
    """
    Search for symbols (classes, methods, functions) in the code index.

    Usage:
        searcher = SymbolSearcher(index, project_root)
        results = searcher.search("SiswaController::store")
        results = searcher.search("RiwayatKelasService")
    """

    def __init__(self, index: CodeIndex, project_root: str):
        self.index = index
        self.project_root = Path(project_root)

    def _read_lines(self, file_path: str, start: int, end: int) -> str:
        """Read specific lines from a file (1-indexed)."""
        try:
            with open(file_path, 'r', encoding='utf-8', errors='replace') as f:
                lines = f.readlines()
            # Clamp to valid range
            start = max(1, start)
            end = min(len(lines), end)
            return ''.join(lines[start - 1:end])
        except Exception:
            return ""

    def _fuzzy_score(self, query: str, target: str) -> float:
        """
        Simple fuzzy matching score.
        Returns 0.0 - 1.0 based on how well query matches target.
        """
        query_lower = query.lower()
        target_lower = target.lower()

        # Exact match
        if query_lower == target_lower:
            return 1.0

        # Exact substring
        if query_lower in target_lower:
            return 0.9

        # Target contains query
        if target_lower in query_lower:
            return 0.7

        # camelCase/PascalCase word matching
        # Split "SiswaController" -> ["siswa", "controller"]
        query_words = re.findall(r'[a-z]+|[A-Z][a-z]*', query)
        target_words = re.findall(r'[a-z]+|[A-Z][a-z]*', target)

        if not query_words or not target_words:
            return 0.0

        matched = sum(
            1 for qw in query_words
            if any(qw.lower() in tw.lower() for tw in target_words)
        )
        return (matched / len(query_words)) * 0.8

    def search(
        self,
        query: str,
        symbol_types: Optional[List[str]] = None,
        top_k: int = 5,
        include_snippet: bool = True,
    ) -> List[SearchResult]:
        """
        Search for a symbol by name.

        Args:
            query: Symbol name, e.g. "SiswaController::store", "RiwayatKelasService"
            symbol_types: Filter by type: ["class", "method", "function"]. None = all.
            top_k: Maximum results to return.
            include_snippet: If True, include code snippet in result.

        Returns:
            List of SearchResult sorted by relevance score.
        """
        results: List[SearchResult] = []
        types = symbol_types or ["class", "method", "function"]

        # Parse "Class::method" syntax
        class_filter = None
        method_filter = query
        if "::" in query:
            parts = query.split("::", 1)
            class_filter = parts[0]
            method_filter = parts[1]

        # Search classes
        if "class" in types and not class_filter:
            for fqn, cls in self.index.classes.items():
                score = self._fuzzy_score(query, cls.name)
                if score > 0.3:
                    snippet = ""
                    if include_snippet:
                        snippet = self._read_lines(cls.file_path, cls.line_start, cls.line_start + 5)
                    rel_path = str(Path(cls.file_path).relative_to(self.project_root))
                    results.append(SearchResult(
                        symbol_name=fqn,
                        symbol_type="class",
                        file_path=cls.file_path,
                        relative_path=rel_path,
                        line_start=cls.line_start,
                        line_end=cls.line_end,
                        snippet=snippet,
                        score=score,
                    ))

        # Search methods
        if "method" in types:
            for key, method in self.index.methods.items():
                # If class filter is specified, only match methods of that class
                if class_filter:
                    if method.class_name and self._fuzzy_score(class_filter, method.class_name) < 0.5:
                        continue
                    score = self._fuzzy_score(method_filter, method.name)
                else:
                    score = self._fuzzy_score(query, method.name)
                    # Boost if class name also matches
                    if method.class_name:
                        class_score = self._fuzzy_score(query, method.class_name)
                        score = max(score, class_score * 0.6)

                if score > 0.3:
                    snippet = ""
                    if include_snippet:
                        snippet = self._read_lines(method.file_path, method.line_start, method.line_end)
                    rel_path = str(Path(method.file_path).relative_to(self.project_root))
                    results.append(SearchResult(
                        symbol_name=key,
                        symbol_type="method",
                        file_path=method.file_path,
                        relative_path=rel_path,
                        line_start=method.line_start,
                        line_end=method.line_end,
                        snippet=snippet,
                        score=score,
                    ))

        # Search standalone functions
        if "function" in types and not class_filter:
            for name, func in self.index.functions.items():
                score = self._fuzzy_score(query, name)
                if score > 0.3:
                    snippet = ""
                    if include_snippet:
                        snippet = self._read_lines(func.file_path, func.line_start, func.line_end)
                    rel_path = str(Path(func.file_path).relative_to(self.project_root))
                    results.append(SearchResult(
                        symbol_name=name,
                        symbol_type="function",
                        file_path=func.file_path,
                        relative_path=rel_path,
                        line_start=func.line_start,
                        line_end=func.line_end,
                        snippet=snippet,
                        score=score,
                    ))

        # Sort by score descending, take top_k
        results.sort(key=lambda r: r.score, reverse=True)
        return results[:top_k]

    def search_exact(self, symbol_name: str) -> Optional[SearchResult]:
        """
        Exact symbol lookup by full qualified name.
        E.g., "App\\Http\\Controllers\\Operator\\SiswaController"
        or "SiswaController::store"
        """
        # Check classes
        if symbol_name in self.index.classes:
            cls = self.index.classes[symbol_name]
            snippet = self._read_lines(cls.file_path, cls.line_start, cls.line_end)
            rel_path = str(Path(cls.file_path).relative_to(self.project_root))
            return SearchResult(
                symbol_name=symbol_name,
                symbol_type="class",
                file_path=cls.file_path,
                relative_path=rel_path,
                line_start=cls.line_start,
                line_end=cls.line_end,
                snippet=snippet,
                score=1.0,
            )

        # Check methods
        if symbol_name in self.index.methods:
            method = self.index.methods[symbol_name]
            snippet = self._read_lines(method.file_path, method.line_start, method.line_end)
            rel_path = str(Path(method.file_path).relative_to(self.project_root))
            return SearchResult(
                symbol_name=symbol_name,
                symbol_type="method",
                file_path=method.file_path,
                relative_path=rel_path,
                line_start=method.line_start,
                line_end=method.line_end,
                snippet=snippet,
                score=1.0,
            )

        # Check functions
        if symbol_name in self.index.functions:
            func = self.index.functions[symbol_name]
            snippet = self._read_lines(func.file_path, func.line_start, func.line_end)
            rel_path = str(Path(func.file_path).relative_to(self.project_root))
            return SearchResult(
                symbol_name=symbol_name,
                symbol_type="function",
                file_path=func.file_path,
                relative_path=rel_path,
                line_start=func.line_start,
                line_end=func.line_end,
                snippet=snippet,
                score=1.0,
            )

        return None
