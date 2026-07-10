"""
FastAPI Application — Context Builder
======================================

Single-endpoint API that aggregates Code Search, RAG, Memory, and
History Compression into one structured response.

• No chatbot logic
• No Gemini / OpenAI calls
• No UI
• Does not touch Laravel

Usage:
    cd ai_tools
    uvicorn api.main:app --host 0.0.0.0 --port 8000 --reload
"""

from contextlib import asynccontextmanager
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware

from .schemas import BuildContextRequest, BuildContextResponse
from .service import build_context as _build_context
from .dependencies import (
    get_context_builder,
    get_document_retriever,
    get_memory_manager,
    PROJECT_ROOT,
)


# ---------------------------------------------------------------------------
# Lifespan — eagerly warm up heavy singletons at server start
# ---------------------------------------------------------------------------
@asynccontextmanager
async def lifespan(app: FastAPI):
    """Warm caches on startup so the first request isn't slow."""
    import time, sys

    print("=" * 60)
    print("  Context Builder API — warming up …")
    print(f"  Project root: {PROJECT_ROOT}")
    print("=" * 60)

    t0 = time.perf_counter()

    # Load code index
    print("  ↳ Loading code index …")
    get_context_builder()

    # Initialise ChromaDB client (model loads lazily on first query)
    print("  ↳ Initialising ChromaDB …")
    get_document_retriever()

    # Open SQLite memory DB
    print("  ↳ Opening memory store …")
    get_memory_manager()

    elapsed = (time.perf_counter() - t0) * 1000
    print(f"  ✓ Ready in {elapsed:.0f} ms")
    print("=" * 60)

    yield  # application runs

    print("  Context Builder API — shutting down.")


# ---------------------------------------------------------------------------
# App
# ---------------------------------------------------------------------------
app = FastAPI(
    title="Context Builder API",
    description=(
        "Aggregates Code Search, RAG (ChromaDB), Long-Term Memory, "
        "and History Compression into a single prompt-ready context payload.\n\n"
        "**No chatbot. No LLM calls. No UI.**"
    ),
    version="1.0.0",
    lifespan=lifespan,
)

# Allow Laravel or any local client to call the API
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_methods=["POST", "GET"],
    allow_headers=["*"],
)


# ---------------------------------------------------------------------------
# Endpoints
# ---------------------------------------------------------------------------
@app.post(
    "/build-context",
    response_model=BuildContextResponse,
    summary="Build aggregated context for a query",
    description=(
        "Runs the query through Code Search, ChromaDB RAG, Memory, and "
        "History Compression pipelines. Returns each layer separately plus "
        "a merged `combined_context` string."
    ),
)
async def build_context(request: BuildContextRequest) -> BuildContextResponse:
    result = _build_context(request.query)
    return BuildContextResponse(
        code_context=result.code_context,
        rag_context=result.rag_context,
        memory_context=result.memory_context,
        summary_context=result.summary_context,
        combined_context=result.combined_context,
    )


@app.get("/health", summary="Health check")
async def health():
    return {"status": "ok", "project_root": PROJECT_ROOT}
