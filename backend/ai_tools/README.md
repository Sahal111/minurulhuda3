# AI Tools for minurulhuda3

Toolkit ini berjalan sebagai **Python sidecar service** untuk mengoptimalkan interaksi AI Agent dengan codebase Laravel.

## Fitur Utama

1. **Semantic Code Search (`code_search/`)**: Mengurangi token usage dengan hanya mengirimkan snippet fungsi yang relevan, bukan seluruh file controller yang berukuran besar.
2. **Long-Term Memory (`memory/`)**: Menyimpan keputusan teknis, goals, dan preferensi di SQLite agar tidak hilang.
3. **RAG Pipeline (`rag/`)**: Mengambil dokumen secara cerdas menggunakan vector search (ChromaDB).
4. **History Compression (`history/`)**: Meringkas riwayat percakapan panjang agar tidak memenuhi context window.

## Instalasi

```bash
cd ai_tools
python -m venv venv
source venv/bin/activate
pip install -r requirements.txt
```

## Penggunaan

**1. Build Code Index**
```bash
python run_index.py
```
Ini akan mem-parsing semua file PHP di `app/`, `routes/`, dan `config/` dan membuat `code_index.json`.

**2. Gunakan di AI Agent (Python)**
```python
from ai_tools.code_search.context_builder import ContextBuilder

builder = ContextBuilder("/path/to/minurulhuda3")
context = builder.build_context("cara simpan data siswa")
print(context) # Menghasilkan < 15K token context
```
