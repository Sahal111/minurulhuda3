"""
RAG Pipeline Module
===================

Retrieval-Augmented Generation for document search (PRD, SRS, markdown docs).
Uses ChromaDB for vector storage and sentence-transformers for embeddings.
"""

from .chunker import DocumentChunker
from .embedder import TextEmbedder
from .vector_store import VectorStore
from .retriever import DocumentRetriever

__all__ = [
    "DocumentChunker",
    "TextEmbedder",
    "VectorStore",
    "DocumentRetriever",
]
