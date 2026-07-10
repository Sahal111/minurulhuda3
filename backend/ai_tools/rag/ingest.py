#!/usr/bin/env python3
"""
RAG Ingest Script
=================

Script to ingest all memory documentation into the vector database.
"""

import sys
import os
from pathlib import Path

# Add parent directory to path to allow importing 'rag' as a module
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), '..')))

from rag.retriever import DocumentRetriever

def main():
    # project_root should point to minurulhuda3 (3 levels up from ingest.py)
    project_root = Path(__file__).parent.parent.parent.absolute()
    retriever = DocumentRetriever(str(project_root))
    
    # Target memory directory
    memory_dir = project_root / "memory"
    
    if not memory_dir.exists():
        print(f"Memory directory not found at {memory_dir}")
        return
        
    print("Starting RAG ingestion...")
    count = 0
    
    # Ingest all markdown files
    for md_file in memory_dir.glob("*.md"):
        rel_path = str(md_file.relative_to(project_root))
        # Skip output reports to avoid recursion loops
        if md_file.name in ["CURRENT_STATE.md", "OPTIMIZATION_REPORT.md"]:
            continue
            
        try:
            if retriever.ingest_file(rel_path):
                count += 1
        except Exception as e:
            print(f"Error ingesting {rel_path}: {e}")
            
    # Also try to ingest ERD if available
    erd_file = project_root / "docs" / "erd" / "index.html"
    if erd_file.exists():
        try:
            # Basic HTML stripping could go here, but sentence-transformers 
            # can often handle raw HTML reasonably well for semantic search
            if retriever.ingest_file(str(erd_file.relative_to(project_root))):
                count += 1
        except Exception as e:
            print(f"Error ingesting ERD: {e}")
            
    print(f"RAG ingestion complete. Processed {count} files.")

if __name__ == "__main__":
    main()
