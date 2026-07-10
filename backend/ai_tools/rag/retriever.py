"""
Document Retriever
==================

High-level interface coordinating chunking, embedding, and vector storage.
"""

import os
from pathlib import Path
from typing import List, Dict, Any, Optional

from .chunker import DocumentChunker
from .embedder import TextEmbedder
from .vector_store import VectorStore

class DocumentRetriever:
    """Main interface for RAG document operations."""
    
    def __init__(self, project_root: str):
        self.project_root = Path(project_root)
        db_path = self.project_root / "ai_tools" / "chroma_data"
        
        self.chunker = DocumentChunker()
        self.embedder = TextEmbedder()
        self.vector_store = VectorStore(str(db_path))

    def ingest_file(self, file_path: str):
        """Read, chunk, embed, and store a file."""
        abs_path = self.project_root / file_path
        if not abs_path.exists():
            print(f"File not found: {abs_path}")
            return False
            
        print(f"Ingesting {file_path}...")
        
        with open(abs_path, 'r', encoding='utf-8', errors='replace') as f:
            content = f.read()
            
        # 1. Chunk
        chunks = self.chunker.chunk_markdown(file_path, content)
        if not chunks:
            return False
            
        # 2. Embed
        texts = [c.text for c in chunks]
        embeddings = self.embedder.embed_texts(texts)
        
        # 3. Store
        self.vector_store.add_chunks(chunks, embeddings)
        print(f"Successfully ingested {len(chunks)} chunks from {file_path}")
        return True

    def search(self, query: str, top_k: int = 3, file_filter: Optional[str] = None) -> str:
        """Search for relevant document snippets and format as context string."""
        # 1. Embed query
        query_emb = self.embedder.embed_query(query)
        
        # 2. Search vector store
        where = {"source": file_filter} if file_filter else None
        results = self.vector_store.search(query_emb, n_results=top_k, where=where)
        
        if not results:
            return ""
            
        # 3. Format output
        output = ["=== RELEVANT DOCUMENTATION ==="]
        for res in results:
            # lower distance = higher similarity in Chroma default L2 metric
            output.append(f"\n--- Source: {res['metadata'].get('source', 'unknown')} ---")
            output.append(res['text'])
            
        return "\n".join(output)
