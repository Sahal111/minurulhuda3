"""
File Ranker
===========

Ranks entire files based on relevance to a natural language query.
Useful as a fallback when specific symbols cannot be identified.
"""

from typing import List, Dict, Tuple
from pathlib import Path

from .indexer import CodeIndex
from .function_search import FunctionSearcher


class FileRanker:
    """Rank files based on relevance to a query."""

    def __init__(self, index: CodeIndex, project_root: str):
        self.index = index
        self.project_root = Path(project_root)
        self.function_searcher = FunctionSearcher(index, project_root)

    def rank_files(self, query: str, top_k: int = 10) -> List[Tuple[str, float]]:
        """
        Rank files by relevance to query.
        Returns list of (relative_path, score).
        """
        keywords = self.function_searcher._extract_keywords(query)
        expanded_keywords = self.function_searcher._expand_keywords(keywords)
        
        file_scores: Dict[str, float] = {}

        # Base score from file path
        for rel_path, file_info in self.index.files.items():
            path_lower = rel_path.lower()
            score = 0.0
            
            for kw in expanded_keywords:
                kw_lower = kw.lower()
                if kw_lower in path_lower:
                    score += 2.0
                    
            if score > 0:
                file_scores[rel_path] = score

        # Aggregate scores from classes
        for fqn, cls in self.index.classes.items():
            rel_path = str(Path(cls.file_path).relative_to(self.project_root))
            cls_lower = cls.name.lower()
            
            score = 0.0
            for kw in expanded_keywords:
                if kw.lower() in cls_lower:
                    score += 1.5
                    
            if score > 0:
                file_scores[rel_path] = file_scores.get(rel_path, 0.0) + score

        # Aggregate scores from methods/functions
        for method in self.index.methods.values():
            rel_path = str(Path(method.file_path).relative_to(self.project_root))
            
            # Use the existing function scorer
            method_score = self.function_searcher._score_method(method, expanded_keywords)
            
            if method_score > 0.1:
                # Add scaled method score to file score
                file_scores[rel_path] = file_scores.get(rel_path, 0.0) + (method_score * 2.0)

        # Sort by score
        ranked = [(path, score) for path, score in file_scores.items() if score > 0]
        ranked.sort(key=lambda x: x[1], reverse=True)
        
        return ranked[:top_k]
