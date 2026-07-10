"""
Function Search
================

Search functions/methods by name, parameter patterns, and body content.
Optimized for natural language queries like "simpan data siswa" or "export PDF guru".

Technical rationale:
- Builds on SymbolSearcher but adds body-content search capability
- Uses keyword extraction from natural language queries
- Maps Indonesian terms to code patterns (e.g., "simpan" → "store", "hapus" → "destroy")
- Returns function snippets, not full files
"""

import re
from typing import List, Optional, Dict
from pathlib import Path

from .indexer import CodeIndex, MethodInfo
from .symbol_search import SymbolSearcher, SearchResult


# Indonesian-to-English keyword mapping for Laravel context
ID_TO_EN_MAP: Dict[str, List[str]] = {
    'simpan': ['store', 'save', 'create', 'insert'],
    'tambah': ['store', 'create', 'add', 'insert'],
    'ubah': ['update', 'edit', 'modify'],
    'edit': ['update', 'edit', 'modify'],
    'perbarui': ['update', 'refresh'],
    'hapus': ['destroy', 'delete', 'remove'],
    'lihat': ['show', 'view', 'get', 'index', 'display'],
    'tampil': ['show', 'view', 'index', 'display', 'render'],
    'daftar': ['index', 'list', 'all'],
    'cari': ['search', 'find', 'filter', 'query'],
    'ekspor': ['export', 'download'],
    'impor': ['import', 'upload'],
    'cetak': ['print', 'pdf', 'export'],
    'upload': ['upload', 'store', 'import'],
    'unduh': ['download', 'export'],
    'validasi': ['validate', 'check', 'verify'],
    'verifikasi': ['verify', 'validate', 'check'],
    'aktifkan': ['activate', 'enable', 'setActive'],
    'nonaktif': ['deactivate', 'disable', 'softDelete'],
    'pulihkan': ['restore', 'recover'],
    'arsip': ['archive', 'trash'],
    'data': ['data', 'index', 'list'],
    'siswa': ['siswa', 'student'],
    'guru': ['guru', 'teacher'],
    'kelas': ['kelas', 'class'],
    'nilai': ['nilai', 'score', 'grade'],
    'rapor': ['rapor', 'report'],
    'absensi': ['absensi', 'attendance'],
    'pembayaran': ['pembayaran', 'payment'],
    'jadwal': ['jadwal', 'schedule'],
    'semester': ['semester'],
    'tahun': ['tahunAjaran', 'tahun', 'year'],
    'berkas': ['berkas', 'document', 'file'],
    'prestasi': ['prestasi', 'achievement'],
    'beasiswa': ['beasiswa', 'scholarship'],
    'diklat': ['diklat', 'training'],
    'inpassing': ['inpassing'],
    'dokumen': ['dokumen', 'document'],
    'mutasi': ['mutasi', 'transfer', 'mutation'],
}


class FunctionSearcher:
    """
    Search for functions/methods using natural language queries.

    Usage:
        searcher = FunctionSearcher(index, project_root)
        results = searcher.search("cara simpan data siswa")
        results = searcher.search("export PDF guru")
    """

    def __init__(self, index: CodeIndex, project_root: str):
        self.index = index
        self.project_root = Path(project_root)
        self.symbol_searcher = SymbolSearcher(index, project_root)

    def _extract_keywords(self, query: str) -> List[str]:
        """Extract meaningful keywords from a natural language query."""
        # Lowercase and split
        words = re.findall(r'\w+', query.lower())

        # Remove common stop words
        stop_words = {
            'cara', 'bagaimana', 'untuk', 'yang', 'dan', 'atau', 'di', 'ke',
            'dari', 'dengan', 'ini', 'itu', 'pada', 'akan', 'sudah', 'belum',
            'bisa', 'buat', 'buatkan', 'tolong', 'mau', 'ingin', 'perlu',
            'the', 'a', 'an', 'is', 'are', 'was', 'how', 'to', 'in', 'of',
            'for', 'and', 'or', 'this', 'that', 'do', 'does', 'can', 'what',
        }
        keywords = [w for w in words if w not in stop_words and len(w) > 2]
        return keywords

    def _expand_keywords(self, keywords: List[str]) -> List[str]:
        """Expand Indonesian keywords to English equivalents."""
        expanded = list(keywords)  # keep originals
        for kw in keywords:
            if kw in ID_TO_EN_MAP:
                expanded.extend(ID_TO_EN_MAP[kw])
        return list(set(expanded))

    def _score_method(self, method: MethodInfo, keywords: List[str]) -> float:
        """Score a method based on keyword relevance."""
        score = 0.0
        name_lower = method.name.lower()
        class_lower = (method.class_name or '').lower()
        params_lower = method.parameters.lower()
        doc_lower = method.docstring.lower()
        body_lower = method.body_preview.lower()

        # Split camelCase name into words
        name_words = [w.lower() for w in re.findall(r'[a-z]+|[A-Z][a-z]*', method.name)]

        for kw in keywords:
            kw_lower = kw.lower()

            # Method name exact match (highest weight)
            if kw_lower == name_lower:
                score += 3.0
            # Method name contains keyword
            elif kw_lower in name_lower:
                score += 2.0
            # Keyword matches a camelCase word
            elif kw_lower in name_words:
                score += 1.8

            # Class name match
            if kw_lower in class_lower:
                score += 1.5

            # Parameter match
            if kw_lower in params_lower:
                score += 0.5

            # Docstring match
            if kw_lower in doc_lower:
                score += 0.8

            # Body preview match
            if kw_lower in body_lower:
                score += 0.3

        # Normalize by number of keywords
        if keywords:
            score = score / len(keywords)

        return min(score, 1.0)

    def search(
        self,
        query: str,
        top_k: int = 5,
        include_snippet: bool = True,
        class_filter: Optional[str] = None,
    ) -> List[SearchResult]:
        """
        Search for functions/methods using natural language query.

        Args:
            query: Natural language query, e.g., "simpan data siswa"
            top_k: Maximum results
            include_snippet: Include code snippet
            class_filter: Optional class name to restrict search

        Returns:
            Sorted list of SearchResult
        """
        keywords = self._extract_keywords(query)
        expanded = self._expand_keywords(keywords)

        results: List[SearchResult] = []

        # Search methods
        for key, method in self.index.methods.items():
            if class_filter and method.class_name:
                if class_filter.lower() not in method.class_name.lower():
                    continue

            score = self._score_method(method, expanded)
            if score > 0.2:
                snippet = ""
                if include_snippet:
                    snippet = self.symbol_searcher._read_lines(
                        method.file_path, method.line_start, method.line_end
                    )
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

        # Also search standalone functions
        for name, func in self.index.functions.items():
            score = self._score_method(func, expanded)
            if score > 0.2:
                snippet = ""
                if include_snippet:
                    snippet = self.symbol_searcher._read_lines(
                        func.file_path, func.line_start, func.line_end
                    )
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

        results.sort(key=lambda r: r.score, reverse=True)
        return results[:top_k]

    def search_by_pattern(
        self,
        pattern: str,
        top_k: int = 5,
    ) -> List[SearchResult]:
        """
        Search methods whose body matches a regex pattern.
        Useful for finding specific code patterns like DB::transaction, Storage::put, etc.
        """
        compiled = re.compile(pattern, re.IGNORECASE)
        results: List[SearchResult] = []

        for key, method in self.index.methods.items():
            full_body = self.symbol_searcher._read_lines(
                method.file_path, method.line_start, method.line_end
            )
            matches = compiled.findall(full_body)
            if matches:
                rel_path = str(Path(method.file_path).relative_to(self.project_root))
                results.append(SearchResult(
                    symbol_name=key,
                    symbol_type="method",
                    file_path=method.file_path,
                    relative_path=rel_path,
                    line_start=method.line_start,
                    line_end=method.line_end,
                    snippet=full_body,
                    score=min(len(matches) * 0.3, 1.0),
                ))

        results.sort(key=lambda r: r.score, reverse=True)
        return results[:top_k]
