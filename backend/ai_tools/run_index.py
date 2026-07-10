#!/usr/bin/env python3
"""
Run Indexer
===========

Script to build or rebuild the code index.
Run this when the Laravel codebase changes significantly.
"""

import sys
import os
import time
from pathlib import Path

# Add current directory to path
sys.path.insert(0, os.path.abspath(os.path.dirname(__file__)))

from code_search.indexer import CodeIndexer


def main():
    project_root = Path(__file__).parent.parent.absolute()
    index_path = Path(__file__).parent / "code_index.json"
    
    print(f"Indexing project at: {project_root}")
    
    indexer = CodeIndexer(str(project_root))
    
    # Try to load existing for incremental update
    existing_index = None
    if index_path.exists():
        print(f"Loading existing index from {index_path}...")
        existing_index = indexer.load_index(str(index_path))
    
    start_time = time.time()
    index = indexer.build_index(existing_index)
    duration = time.time() - start_time
    
    stats = indexer.get_stats(index)
    
    print("\nIndex Statistics:")
    print(f"  Files:     {stats['total_files']}")
    print(f"  Classes:   {stats['total_classes']}")
    print(f"  Methods:   {stats['total_methods']}")
    print(f"  Functions: {stats['total_functions']}")
    print(f"  Total Loc: {stats['total_lines']}")
    
    print(f"\nSaving index to {index_path}...")
    indexer.save_index(index, str(index_path))
    
    print(f"Done in {duration:.2f} seconds.")


if __name__ == "__main__":
    main()
