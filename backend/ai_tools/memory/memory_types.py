"""
Memory Types
============
"""

from enum import Enum
from dataclasses import dataclass
from typing import Optional, Dict, Any
import datetime

class MemoryCategory(str, Enum):
    PROJECT_GOAL = "project_goal"
    TECH_DECISION = "tech_decision"
    USER_PREFERENCE = "user_preference"
    ARCHITECTURE = "architecture"
    CONSTRAINT = "constraint"
    DOMAIN_KNOWLEDGE = "domain_knowledge"
    CODING_CONVENTION = "coding_convention"
    DEPLOYMENT = "deployment"
    INDEXING_STATS = "indexing_stats"

@dataclass
class MemoryItem:
    id: str
    category: str
    key: str
    content: str
    metadata: Dict[str, Any]
    created_at: str
    updated_at: str
