"""
API Schemas
===========

Pydantic models for request/response validation.
"""

from typing import List, Optional
from pydantic import BaseModel, Field


class BuildContextRequest(BaseModel):
    """Request body for POST /build-context."""
    query: str = Field(
        ...,
        min_length=1,
        max_length=1000,
        description="Natural-language query describing the context needed.",
        examples=["mutasi siswa", "cara simpan data pembayaran SPP"],
    )


class BuildContextResponse(BaseModel):
    """Structured response containing all context layers."""
    code_context: List[str] = Field(
        default_factory=list,
        description="Relevant code snippets from the Laravel codebase.",
    )
    rag_context: List[str] = Field(
        default_factory=list,
        description="Relevant documentation chunks from ChromaDB.",
    )
    memory_context: List[str] = Field(
        default_factory=list,
        description="Relevant long-term memory items.",
    )
    summary_context: str = Field(
        default="",
        description="Compressed conversation summary (if any).",
    )
    combined_context: str = Field(
        default="",
        description="All context layers merged into a single prompt-ready string.",
    )
