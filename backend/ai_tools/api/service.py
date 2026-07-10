"""
Context Builder Service
=======================

Pure orchestration logic — no LLM calls, no chatbot behaviour.
Aggregates the four context layers and returns structured data.
"""

import time
from dataclasses import dataclass, field
from typing import List

from .dependencies import (
    get_context_builder,
    get_document_retriever,
    get_memory_manager,
    get_history_summarizer,
)


@dataclass
class ContextResult:
    """Internal result object passed to the response serialiser."""
    code_context: List[str] = field(default_factory=list)
    rag_context: List[str] = field(default_factory=list)
    memory_context: List[str] = field(default_factory=list)
    summary_context: str = ""
    combined_context: str = ""
    elapsed_ms: float = 0.0


def build_context(query: str) -> ContextResult:
    """
    Orchestrate all four context pipelines for *query*.

    Returns a ContextResult with individual layers + a merged
    ``combined_context`` string ready for prompt injection.
    """
    t0 = time.perf_counter()
    result = ContextResult()

    # ── 1. Code Search ────────────────────────────────────────────────
    try:
        cb = get_context_builder()
        code_ctx = cb.build_context(query, max_tokens=15000)
        if code_ctx:
            result.code_context = [code_ctx]
    except Exception as exc:
        result.code_context = [f"[code_search error] {exc}"]

    # ── 2. RAG / ChromaDB ────────────────────────────────────────────
    try:
        retriever = get_document_retriever()
        rag_ctx = retriever.search(query, top_k=3)
        if rag_ctx:
            result.rag_context = [rag_ctx]
    except Exception as exc:
        result.rag_context = [f"[rag error] {exc}"]

    # ── 3. Memory ────────────────────────────────────────────────────
    try:
        mem = get_memory_manager()
        mem_ctx = mem.get_context_string()
        if mem_ctx and mem_ctx != "No long-term memories found.":
            result.memory_context = [mem_ctx]

        # Also include targeted search hits
        search_results = mem.search_memory(query, top_k=5)
        for item in search_results:
            result.memory_context.append(f"[{item.category}] {item.key}: {item.content}")
    except Exception as exc:
        result.memory_context = [f"[memory error] {exc}"]

    # ── 4. History Summary (stateless — return stored summary if any)
    try:
        summarizer = get_history_summarizer()
        stored_summary = summarizer.store.get_summary("current")
        if stored_summary:
            result.summary_context = stored_summary
    except Exception:
        pass  # No conversation context is fine

    # ── 5. Merge into combined_context ────────────────────────────────
    parts: List[str] = []
    for section in result.code_context:
        parts.append(section)
    for section in result.rag_context:
        parts.append(section)
    for section in result.memory_context:
        parts.append(section)
    if result.summary_context:
        parts.append(f"=== CONVERSATION SUMMARY ===\n{result.summary_context}")
    result.combined_context = "\n\n".join(parts)

    result.elapsed_ms = (time.perf_counter() - t0) * 1000
    return result
