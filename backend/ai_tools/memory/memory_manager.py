"""
Memory Manager
==============

High-level interface for managing long-term memory.
"""

import os
from pathlib import Path
from typing import List, Optional, Dict, Any

from .memory_types import MemoryCategory, MemoryItem
from .memory_db import MemoryDB

class MemoryManager:
    """
    Manages long-term memory for the AI agent.
    
    Usage:
        manager = MemoryManager("/path/to/project")
        manager.save_memory(
            MemoryCategory.TECH_DECISION,
            "rbac_implementation",
            "RBAC uses many-to-many relationship (roles <-> users) rather than a single column."
        )
    """

    def __init__(self, project_root: str):
        self.project_root = Path(project_root)
        db_path = self.project_root / "ai_tools" / "memory_store.sqlite"
        self.db = MemoryDB(str(db_path))

    def save_memory(self, category: str, key: str, content: str, metadata: Optional[Dict[str, Any]] = None) -> str:
        """Save a new memory item."""
        # Ensure category is valid
        valid_categories = [c.value for c in MemoryCategory]
        if category not in valid_categories:
            print(f"Warning: '{category}' is not a standard category. Using anyway.")
            
        return self.db.insert(category, key, content, metadata)

    def search_memory(self, query: str, category: Optional[str] = None, top_k: int = 5) -> List[MemoryItem]:
        """Search memories by content or key."""
        return self.db.find(query, category, top_k)

    def update_memory(self, memory_id: str, content: Optional[str] = None, metadata: Optional[Dict[str, Any]] = None) -> bool:
        """Update an existing memory."""
        return self.db.update(memory_id, content, metadata)

    def delete_memory(self, memory_id: str) -> bool:
        """Delete a memory."""
        return self.db.delete(memory_id)

    def list_memories(self, category: Optional[str] = None) -> List[MemoryItem]:
        """List all memories, optionally filtered by category."""
        return self.db.list_all(category)
        
    def get_context_string(self, category: Optional[str] = None) -> str:
        """Get all memories as a formatted string for prompt injection."""
        memories = self.list_memories(category)
        if not memories:
            return "No long-term memories found."
            
        lines = ["=== LONG-TERM MEMORY ==="]
        
        # Group by category if returning all
        if not category:
            grouped = {}
            for m in memories:
                if m.category not in grouped:
                    grouped[m.category] = []
                grouped[m.category].append(m)
                
            for cat, items in grouped.items():
                lines.append(f"\n[{cat.upper()}]")
                for item in items:
                    lines.append(f"- {item.key}: {item.content}")
        else:
            for item in memories:
                lines.append(f"- {item.key}: {item.content}")
                
        return "\n".join(lines)
