"""
Memory DB
=========

SQLite backend for long-term memory.
"""

import sqlite3
import json
import uuid
import datetime
from pathlib import Path
from typing import List, Optional, Dict, Any

from .memory_types import MemoryItem, MemoryCategory

class MemoryDB:
    def __init__(self, db_path: str):
        self.db_path = db_path
        self._init_db()

    def _get_conn(self):
        # Return row as dict-like
        conn = sqlite3.connect(self.db_path)
        conn.row_factory = sqlite3.Row
        return conn

    def _init_db(self):
        """Create tables if they don't exist."""
        # Ensure directory exists
        Path(self.db_path).parent.mkdir(parents=True, exist_ok=True)
        
        with self._get_conn() as conn:
            conn.execute("""
                CREATE TABLE IF NOT EXISTS memories (
                    id TEXT PRIMARY KEY,
                    category TEXT NOT NULL,
                    key_name TEXT NOT NULL,
                    content TEXT NOT NULL,
                    metadata TEXT,
                    created_at TEXT NOT NULL,
                    updated_at TEXT NOT NULL
                )
            """)
            conn.execute("CREATE INDEX IF NOT EXISTS idx_category ON memories(category)")
            conn.execute("CREATE INDEX IF NOT EXISTS idx_key ON memories(key_name)")

    def _row_to_item(self, row: sqlite3.Row) -> MemoryItem:
        return MemoryItem(
            id=row['id'],
            category=row['category'],
            key=row['key_name'],
            content=row['content'],
            metadata=json.loads(row['metadata'] if row['metadata'] else '{}'),
            created_at=row['created_at'],
            updated_at=row['updated_at']
        )

    def insert(self, category: str, key: str, content: str, metadata: Optional[Dict[str, Any]] = None) -> str:
        memory_id = str(uuid.uuid4())
        now = datetime.datetime.now().isoformat()
        meta_str = json.dumps(metadata) if metadata else '{}'
        
        with self._get_conn() as conn:
            conn.execute(
                "INSERT INTO memories (id, category, key_name, content, metadata, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)",
                (memory_id, category, key, content, meta_str, now, now)
            )
        return memory_id

    def update(self, memory_id: str, content: Optional[str] = None, metadata: Optional[Dict[str, Any]] = None) -> bool:
        now = datetime.datetime.now().isoformat()
        
        with self._get_conn() as conn:
            if content is not None and metadata is not None:
                cursor = conn.execute(
                    "UPDATE memories SET content = ?, metadata = ?, updated_at = ? WHERE id = ?",
                    (content, json.dumps(metadata), now, memory_id)
                )
            elif content is not None:
                cursor = conn.execute(
                    "UPDATE memories SET content = ?, updated_at = ? WHERE id = ?",
                    (content, now, memory_id)
                )
            elif metadata is not None:
                cursor = conn.execute(
                    "UPDATE memories SET metadata = ?, updated_at = ? WHERE id = ?",
                    (json.dumps(metadata), now, memory_id)
                )
            else:
                return False
                
            return cursor.rowcount > 0

    def delete(self, memory_id: str) -> bool:
        with self._get_conn() as conn:
            cursor = conn.execute("DELETE FROM memories WHERE id = ?", (memory_id,))
            return cursor.rowcount > 0

    def get(self, memory_id: str) -> Optional[MemoryItem]:
        with self._get_conn() as conn:
            cursor = conn.execute("SELECT * FROM memories WHERE id = ?", (memory_id,))
            row = cursor.fetchone()
            return self._row_to_item(row) if row else None

    def find(self, query: str, category: Optional[str] = None, top_k: int = 5) -> List[MemoryItem]:
        """Simple LIKE search. For advanced semantic search, use RAG."""
        search_term = f"%{query}%"
        
        with self._get_conn() as conn:
            if category:
                cursor = conn.execute(
                    "SELECT * FROM memories WHERE category = ? AND (content LIKE ? OR key_name LIKE ?) ORDER BY updated_at DESC LIMIT ?",
                    (category, search_term, search_term, top_k)
                )
            else:
                cursor = conn.execute(
                    "SELECT * FROM memories WHERE content LIKE ? OR key_name LIKE ? ORDER BY updated_at DESC LIMIT ?",
                    (search_term, search_term, top_k)
                )
            return [self._row_to_item(row) for row in cursor.fetchall()]

    def list_all(self, category: Optional[str] = None) -> List[MemoryItem]:
        with self._get_conn() as conn:
            if category:
                cursor = conn.execute("SELECT * FROM memories WHERE category = ? ORDER BY updated_at DESC", (category,))
            else:
                cursor = conn.execute("SELECT * FROM memories ORDER BY category, updated_at DESC")
            return [self._row_to_item(row) for row in cursor.fetchall()]
