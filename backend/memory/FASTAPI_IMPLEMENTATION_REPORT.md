# FastAPI Context Builder — Implementation Report

> **Status:** ✅ Implemented & Verified  
> **Date:** 2026-06-13  
> **Option:** B (FastAPI sidecar)

---

## Architecture

```
┌──────────────┐       POST /build-context       ┌─────────────────────┐
│   Laravel    │  ──────────────────────────────▶ │  FastAPI (port 8000)│
│  (PHP app)   │  ◀──────────────────────────────  │  Python sidecar     │
└──────────────┘       JSON response              └────────┬────────────┘
                                                           │
                                    ┌──────────────────────┼──────────────────────┐
                                    │                      │                      │
                              ┌─────▼─────┐   ┌───────────▼──────┐   ┌───────────▼──────┐
                              │ Code Search│   │ RAG / ChromaDB   │   │ Memory (SQLite)  │
                              │ (JSON index)│   │ (sentence-xformer)│   │ (memory_store.db)│
                              └────────────┘   └──────────────────┘   └──────────────────┘
```

**Key constraints honoured:**
- ❌ No chatbot logic
- ❌ No Gemini / OpenAI calls
- ❌ No UI
- ❌ No Laravel modifications

---

## File Tree

```
ai_tools/
├── api/                          ← NEW (FastAPI application)
│   ├── __init__.py               ← Package marker
│   ├── main.py                   ← FastAPI app, lifespan warmup, endpoints
│   ├── schemas.py                ← Pydantic request/response models
│   ├── service.py                ← Context orchestration logic
│   └── dependencies.py           ← Lazy singletons (ContextBuilder, Retriever, etc.)
│
├── code_search/                  ← REUSED (unchanged)
│   ├── context_builder.py
│   ├── function_search.py
│   ├── class_search.py
│   ├── symbol_search.py
│   ├── file_ranker.py
│   └── indexer.py
│
├── rag/                          ← REUSED (unchanged)
│   ├── retriever.py
│   ├── vector_store.py
│   ├── embedder.py
│   └── chunker.py
│
├── memory/                       ← REUSED (unchanged)
│   ├── memory_manager.py
│   ├── memory_db.py
│   └── memory_types.py
│
├── history/                      ← REUSED (unchanged)
│   ├── summarizer.py
│   ├── history_store.py
│   └── token_counter.py
│
├── requirements.txt              ← MODIFIED (added fastapi, uvicorn)
└── venv/                         ← Existing virtualenv
```

**New files created:** 5  
**Existing files modified:** 1 (`requirements.txt`)  
**Existing files unchanged:** All code_search, rag, memory, history modules

---

## Endpoints

### `POST /build-context`

Aggregates all four context pipelines for a natural-language query.

**Request:**
```json
{
  "query": "mutasi siswa"
}
```

**Response:**
```json
{
  "code_context": [
    "=== SEMANTIC CODE CONTEXT FOR: 'mutasi siswa' ===\n..."
  ],
  "rag_context": [
    "=== RELEVANT DOCUMENTATION ===\n..."
  ],
  "memory_context": [
    "=== LONG-TERM MEMORY ===\n..."
  ],
  "summary_context": "",
  "combined_context": "...all layers merged..."
}
```

| Field | Type | Description |
|---|---|---|
| `code_context` | `string[]` | Functions, class skeletons, ranked files from code index |
| `rag_context` | `string[]` | ChromaDB document chunks (PRD, SRS, docs) |
| `memory_context` | `string[]` | SQLite long-term memory items |
| `summary_context` | `string` | Compressed conversation summary (if any) |
| `combined_context` | `string` | All layers merged into one prompt-ready string |

**Validation:**
- `query` must be 1–1000 characters
- Empty query returns `422 Unprocessable Entity`

---

### `GET /health`

Simple liveness check.

**Response:**
```json
{
  "status": "ok",
  "project_root": "/Users/sahalanwarhadi/Documents/minurulhuda3"
}
```

---

### `GET /docs`

Auto-generated Swagger UI (built into FastAPI).

---

## Startup Instructions

### 1. Activate the virtualenv

```bash
cd /Users/sahalanwarhadi/Documents/minurulhuda3/ai_tools
source venv/bin/activate
```

### 2. Install dependencies (if not already installed)

```bash
pip install -r requirements.txt
```

### 3. Start the server

```bash
# Development (with auto-reload)
uvicorn api.main:app --host 127.0.0.1 --port 8000 --reload

# Production
uvicorn api.main:app --host 0.0.0.0 --port 8000 --workers 1
```

> [!IMPORTANT]
> Use `--workers 1` in production. The sentence-transformer model uses ~500 MB RAM per worker. Multiple workers would multiply this cost without benefit since the code index and ChromaDB are disk-backed.

### 4. Verify

```bash
curl http://127.0.0.1:8000/health
```

---

## Test Examples

### Basic query

```bash
curl -X POST http://127.0.0.1:8000/build-context \
  -H "Content-Type: application/json" \
  -d '{"query": "mutasi siswa"}'
```

### Query about payments

```bash
curl -X POST http://127.0.0.1:8000/build-context \
  -H "Content-Type: application/json" \
  -d '{"query": "cara simpan data pembayaran SPP"}'
```

### Query about authentication

```bash
curl -X POST http://127.0.0.1:8000/build-context \
  -H "Content-Type: application/json" \
  -d '{"query": "login dan role-based access control"}'
```

### Validation error (empty query)

```bash
curl -X POST http://127.0.0.1:8000/build-context \
  -H "Content-Type: application/json" \
  -d '{"query": ""}'
# Returns 422 with validation details
```

### Using from PHP / Laravel

```php
$response = Http::post('http://127.0.0.1:8000/build-context', [
    'query' => 'mutasi siswa',
]);

$context = $response->json();
$combined = $context['combined_context'];
// Pass $combined to your LLM prompt
```

---

## Verification Results

| Test | Result |
|---|---|
| Import check (`python -c "from api.main import app"`) | ✅ Pass |
| Health endpoint (`GET /health`) | ✅ `{"status": "ok"}` |
| Build context (`POST /build-context`) | ✅ All 4 layers returned |
| Validation (`POST` with empty query) | ✅ 422 returned |
| Code context contains `MutasiSiswa` model | ✅ Confirmed |
| RAG context returns documentation | ✅ 3 doc chunks |
| No Gemini/OpenAI calls made | ✅ Confirmed |
| Laravel files untouched | ✅ Confirmed |

---

## Design Decisions

1. **Lazy singletons in `dependencies.py`** — The sentence-transformer model (~500 MB) loads once at startup and is reused across requests. No per-request overhead.

2. **Independent error handling per pipeline** — If ChromaDB fails, code search and memory still return. Each layer is wrapped in its own try/except.

3. **Lifespan warmup** — Code index and ChromaDB client are initialised at server start so the first request doesn't pay cold-start cost.

4. **CORS enabled** — Laravel can call the API from any origin during development. Tighten `allow_origins` for production.

5. **No async I/O for pipelines** — The underlying libraries (ChromaDB, SQLite, sentence-transformers) are synchronous. FastAPI handles this correctly by running sync handlers in a threadpool.
