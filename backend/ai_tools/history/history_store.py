"""
History Store
=============

Manages conversation history on disk.
"""

import json
from pathlib import Path
from typing import List, Dict, Any, Optional

class HistoryStore:
    """Stores full conversation history on disk."""
    
    def __init__(self, project_root: str):
        self.project_root = Path(project_root)
        self.history_dir = self.project_root / "ai_tools" / "conversations"
        self.history_dir.mkdir(parents=True, exist_ok=True)
        
    def get_conversation_path(self, conversation_id: str) -> Path:
        return self.history_dir / f"{conversation_id}.json"
        
    def save_history(self, conversation_id: str, messages: List[Dict[str, str]], summary: str = ""):
        """Save the full history and current summary to disk."""
        path = self.get_conversation_path(conversation_id)
        
        data = {
            "conversation_id": conversation_id,
            "summary": summary,
            "messages": messages
        }
        
        with open(path, 'w', encoding='utf-8') as f:
            json.dump(data, f, indent=2, ensure_ascii=False)
            
    def load_history(self, conversation_id: str) -> Optional[Dict[str, Any]]:
        """Load conversation data."""
        path = self.get_conversation_path(conversation_id)
        
        if not path.exists():
            return None
            
        with open(path, 'r', encoding='utf-8') as f:
            return json.load(f)
            
    def get_summary(self, conversation_id: str) -> str:
        """Get just the summary for a conversation."""
        data = self.load_history(conversation_id)
        return data.get("summary", "") if data else ""
