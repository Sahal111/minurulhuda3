# Antigravity Performance Benchmark (PERFORMANCE_REPORT)

> Generated: 2026-06-13
> Project: minurulhuda3

## Executive Summary
This report analyzes the performance metrics of the Antigravity Python Sidecar (`ai_tools`). The benchmarks were conducted on the same local environment handling the Laravel application. The results clearly demonstrate a massive disparity between "Cold Start" (spawning a new process) and "Warm Start" (reusing models already in memory).

---

## 1. Latency Measurements

### Cold Start Latency
*(Measured when starting a fresh Python process)*
- **Python Imports (`torch`, `chromadb`, etc):** ~3.09 seconds
- **Object Initialization:** ~0.01 seconds
- **Machine Learning Weights Loading (`all-MiniLM-L6-v2`):** ~7.21 seconds
- **Total Cold Latency:** **~10.31 seconds**

### Warm Start Latency
*(Measured on subsequent calls when models are cached in RAM)*
- **Code Search Execution:** 0.017 seconds (17ms)
- **ChromaDB RAG Retrieval:** 0.328 seconds (328ms)
- **Memory Retrieval (SQLite):** 0.0003 seconds (< 1ms)
- **Context Builder Orchestration:** 0.012 seconds (12ms)
- **Total Warm Latency:** **~0.35 seconds**

---

## 2. Resource Utilization

- **Base Python RAM:** ~15 MB
- **RAM After Library Imports:** ~385 MB
- **Peak RAM Usage (With Transformer Weights):** **~475 MB**
- *Note:* The memory footprint is highly efficient and easily fits within a standard 1GB VPS limit alongside PHP-FPM and MySQL.

### Estimated Requests Per Minute (RPM)
- **Cold Start Capacity:** ~5-6 RPM (The CPU spends most of its time blocking on disk I/O to load models).
- **Warm Start Capacity:** **~170+ RPM** (Limited only by LLM generation speed on the API side, not context building).

---

## 3. Integration Architecture Recommendation

Based on the empirical evidence above, here is the assessment of the two integration methods:

### Option A: Symfony Process (CLI Script)
If Laravel calls `python get_context.py` via `shell_exec` on every user query, it will trigger a **Cold Start**. 
- **User Impact:** The user will wait > 10 detik *hanya untuk mengumpulkan konteks* sebelum *request* dikirim ke Gemini/OpenAI. Total respon bisa memakan waktu 15-20 detik. Ini sangat buruk untuk *user experience*.

### Option B: Local REST API (FastAPI)
Jika Laravel memanggil `http://localhost:8000/build-context`, Python hanya mengalami Cold Start sekali saat server FastAPI dinyalakan. Semua query berikutnya menggunakan **Warm Start**.
- **User Impact:** Pembuatan konteks memakan waktu **< 0.5 detik**. Respons AI akan terasa seketika (bergantung penuh pada kecepatan layanan LLM pihak ketiga).

### Final Recommendation
**Option B (FastAPI) is strongly recommended.** 

The 10-second penalty of reloading the `sentence-transformers` PyTorch models on every request makes the CLI approach unviable for an interactive AI assistant, even for a school project. Running a lightweight FastAPI server on port 8000 consumes ~475MB of RAM statically and reduces latency by **~96%** (from 10.3s to 0.35s).
