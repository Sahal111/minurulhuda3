"""
Text Embedder
=============

Wraps sentence-transformers to convert text into vector embeddings.
"""

from typing import List
import os

class TextEmbedder:
    """Generates embeddings using sentence-transformers."""
    
    def __init__(self, model_name: str = "all-MiniLM-L6-v2"):
        self.model_name = model_name
        self._model = None
        
    def _get_model(self):
        if self._model is None:
            # Lazy import to save memory when not in use
            try:
                from sentence_transformers import SentenceTransformer
                # Suppress huggingface warnings
                os.environ["TOKENIZERS_PARALLELISM"] = "false"
                self._model = SentenceTransformer(self.model_name)
            except ImportError:
                print("Error: sentence-transformers not installed. Run 'pip install sentence-transformers'")
                raise
        return self._model
        
    def embed_texts(self, texts: List[str]) -> List[List[float]]:
        """Convert a list of strings into a list of vectors."""
        model = self._get_model()
        embeddings = model.encode(texts, convert_to_numpy=True)
        return embeddings.tolist()
        
    def embed_query(self, query: str) -> List[float]:
        """Convert a single query string into a vector."""
        model = self._get_model()
        embedding = model.encode([query], convert_to_numpy=True)[0]
        return embedding.tolist()
