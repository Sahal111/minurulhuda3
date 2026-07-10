"""
Long-Term Memory Module
=======================

Stores project goals, architecture decisions, user preferences, and constraints.
Backed by SQLite for persistence across AI sessions.
"""

from .memory_types import MemoryCategory, MemoryItem
from .memory_db import MemoryDB
from .memory_manager import MemoryManager

__all__ = [
    "MemoryCategory",
    "MemoryItem",
    "MemoryDB",
    "MemoryManager",
]
