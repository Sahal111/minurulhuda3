"""
Vector Store
============

Wraps ChromaDB for storing and querying document embeddings.
"""

from typing import List, Dict, Any, Optional
from pathlib import Path

from .chunker import Chunk

class VectorStore:
    """Manages document embeddings using ChromaDB."""
    
    def __init__(self, db_dir: str, collection_name: str = "docs"):
        self.db_dir = db_dir
        self.collection_name = collection_name
        self._client = None
        self._collection = None
        
    def _init_db(self):
        if self._client is None:
            try:
                import chromadb
                # Ensure directory exists
                Path(self.db_dir).mkdir(parents=True, exist_ok=True)
                self._client = chromadb.PersistentClient(path=self.db_dir)
                self._collection = self._client.get_or_create_collection(name=self.collection_name)
            except ImportError:
                print("Error: chromadb not installed. Run 'pip install chromadb'")
                raise

    def add_chunks(self, chunks: List[Chunk], embeddings: List[List[float]]):
        """Add document chunks and their embeddings to the store."""
        self._init_db()
        
        ids = [c.id for c in chunks]
        texts = [c.text for c in chunks]
        metadatas = [c.metadata for c in chunks]
        
        # ChromaDB handles batching automatically in newer versions
        self._collection.upsert(
            ids=ids,
            embeddings=embeddings,
            documents=texts,
            metadatas=metadatas
        )

    def search(self, query_embedding: List[float], n_results: int = 5, where: Optional[Dict[str, Any]] = None) -> List[Dict[str, Any]]:
        """Search for similar chunks."""
        self._init_db()
        
        results = self._collection.query(
            query_embeddings=[query_embedding],
            n_results=n_results,
            where=where
        )
        
        # Format results
        formatted = []
        if results and results['documents'] and results['documents'][0]:
            for i in range(len(results['documents'][0])):
                formatted.append({
                    "id": results['ids'][0][i],
                    "text": results['documents'][0][i],
                    "metadata": results['metadatas'][0][i] if results['metadatas'] else {},
                    "distance": results['distances'][0][i] if 'distances' in results and results['distances'] else 0.0
                })
                
        return formatted
