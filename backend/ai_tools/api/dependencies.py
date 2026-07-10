"""
Dependencies
=============

Application-scoped singletons (created once at startup, reused per request).
Uses a simple module-level cache so expensive model loads happen only once.
"""

import os
import sys
from pathlib import Path
from typing import Optional

# ---------------------------------------------------------------------------
# Resolve project root (two levels up from this file: api/ -> ai_tools/ -> project_root)
# ---------------------------------------------------------------------------
_THIS_DIR = Path(__file__).resolve().parent                 # .../ai_tools/api
_AI_TOOLS_DIR = _THIS_DIR.parent                            # .../ai_tools
_PROJECT_ROOT = _AI_TOOLS_DIR.parent                        # .../minurulhuda3

# Ensure ai_tools is importable when running the API standalone
if str(_AI_TOOLS_DIR.parent) not in sys.path:
    sys.path.insert(0, str(_AI_TOOLS_DIR.parent))
if str(_AI_TOOLS_DIR) not in sys.path:
    sys.path.insert(0, str(_AI_TOOLS_DIR))

PROJECT_ROOT = str(_PROJECT_ROOT)

# ---------------------------------------------------------------------------
# Lazy singletons
# ---------------------------------------------------------------------------
_context_builder = None
_document_retriever = None
_memory_manager = None
_history_summarizer = None


def get_context_builder():
    """Return the shared ContextBuilder instance (loads code index once)."""
    global _context_builder
    if _context_builder is None:
        from code_search.context_builder import ContextBuilder
        _context_builder = ContextBuilder(PROJECT_ROOT)
    return _context_builder


def get_document_retriever():
    """Return the shared DocumentRetriever instance (initialises ChromaDB once)."""
    global _document_retriever
    if _document_retriever is None:
        from rag.retriever import DocumentRetriever
        _document_retriever = DocumentRetriever(PROJECT_ROOT)
    return _document_retriever


def get_memory_manager():
    """Return the shared MemoryManager instance (opens SQLite once)."""
    global _memory_manager
    if _memory_manager is None:
        from memory.memory_manager import MemoryManager
        _memory_manager = MemoryManager(PROJECT_ROOT)
    return _memory_manager


def get_history_summarizer():
    """Return the shared HistorySummarizer instance."""
    global _history_summarizer
    if _history_summarizer is None:
        from history.summarizer import HistorySummarizer
        _history_summarizer = HistorySummarizer(PROJECT_ROOT)
    return _history_summarizer
