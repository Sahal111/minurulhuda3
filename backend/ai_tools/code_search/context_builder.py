"""
Context Builder
===============

Assembles the final context string from search results.
Ensures the context stays within token limits while providing maximum value.
"""

from typing import List, Optional
from pathlib import Path

from .indexer import CodeIndex
from .symbol_search import SymbolSearcher, SearchResult
from .function_search import FunctionSearcher
from .class_search import ClassSearcher
from .file_ranker import FileRanker

class ContextBuilder:
    """Builds an optimized context prompt from a natural language query."""
    
    def __init__(self, project_root: str, index: Optional[CodeIndex] = None):
        from .indexer import CodeIndexer
        self.project_root = project_root
        
        if index is None:
            # Try to load existing
            index_path = Path(project_root) / "ai_tools" / "code_index.json"
            indexer = CodeIndexer(project_root)
            if index_path.exists():
                self.index = indexer.load_index(str(index_path))
            else:
                self.index = indexer.build_index()
                indexer.save_index(self.index, str(index_path))
        else:
            self.index = index
            
        self.symbol_searcher = SymbolSearcher(self.index, project_root)
        self.function_searcher = FunctionSearcher(self.index, project_root)
        self.class_searcher = ClassSearcher(self.index, project_root)
        self.file_ranker = FileRanker(self.index, project_root)

    def build_context(self, query: str, max_tokens: int = 15000) -> str:
        """
        Build a comprehensive context string for a query.
        Tries to be smart about what to include based on the query.
        """
        output = [f"=== SEMANTIC CODE CONTEXT FOR: '{query}' ===\n"]
        current_est_tokens = 50
        
        # 1. Search for specific functions/methods (most granular)
        func_results = self.function_searcher.search(query, top_k=3)
        if func_results:
            output.append("--- Relevant Functions/Methods ---")
            for res in func_results:
                # Estimate token size (~4 chars per token)
                est_tokens = len(res.snippet) // 4
                if current_est_tokens + est_tokens > max_tokens * 0.7:  # Leave room
                    break
                    
                output.append(f"\nFile: {res.relative_path} (Lines: {res.line_start}-{res.line_end})")
                output.append(f"Symbol: {res.symbol_name}")
                output.append("```php\n" + res.snippet + "\n```")
                current_est_tokens += est_tokens
        
        # 2. Add class skeletons if classes are mentioned
        class_results = self.symbol_searcher.search(query, symbol_types=["class"], top_k=2, include_snippet=False)
        if class_results:
            output.append("\n--- Relevant Class Structures ---")
            for res in class_results:
                skeleton = self.class_searcher.get_class_skeleton(res.symbol_name)
                if skeleton:
                    est_tokens = len(skeleton) // 4
                    if current_est_tokens + est_tokens > max_tokens:
                        break
                    
                    output.append(f"\nFile: {res.relative_path}")
                    output.append(f"Class Skeleton: {res.symbol_name}")
                    output.append("```php\n" + skeleton + "\n```")
                    current_est_tokens += est_tokens
                    
        # 3. Mention other relevant files
        ranked_files = self.file_ranker.rank_files(query, top_k=5)
        if ranked_files:
            output.append("\n--- Other Potentially Relevant Files ---")
            for path, score in ranked_files:
                output.append(f"- {path} (relevance: {score:.2f})")
                
        output.append("\n=============================================")
        return "\n".join(output)
