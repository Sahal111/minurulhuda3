import time
import sys
import os
import resource
import psutil

def get_memory_usage():
    process = psutil.Process(os.getpid())
    return process.memory_info().rss / 1024 / 1024  # in MB

print(f"Memory before imports: {get_memory_usage():.2f} MB")

start_imports = time.time()
from code_search.context_builder import ContextBuilder
from rag.retriever import DocumentRetriever
from memory.memory_manager import MemoryManager
import chromadb
import sentence_transformers
import tiktoken
import torch
import huggingface_hub
end_imports = time.time()

print(f"Memory after imports: {get_memory_usage():.2f} MB")
import_time = end_imports - start_imports
print(f"Import time: {import_time:.4f}s")

project_root = "/Users/sahalanwarhadi/Documents/minurulhuda3"

start_init = time.time()
cb = ContextBuilder(project_root)
retriever = DocumentRetriever(project_root)
memory = MemoryManager(project_root)
end_init = time.time()
init_time = end_init - start_init
print(f"Object Initialization time: {init_time:.4f}s")
print(f"Memory after initialization: {get_memory_usage():.2f} MB")

cold_start_time = import_time + init_time

# Warm metrics
query = "mutasi siswa"

# 1. Code Search (which is internally run by context builder or symbol searcher)
start_cs = time.time()
cb.symbol_searcher.search(query)
cb.function_searcher.search(query)
cb.class_searcher.search(query)
end_cs = time.time()
cs_time = end_cs - start_cs

# 2. ChromaDB RAG
start_rag = time.time()
# The embedder might do a lazy load on the first call, so let's separate embedder lazy load vs actual search
retriever.search(query)
end_rag = time.time()
rag_time_first = end_rag - start_rag
print(f"Memory after first RAG call (loads transformer weights): {get_memory_usage():.2f} MB")

start_rag_warm = time.time()
retriever.search("perpindahan kelas")
end_rag_warm = time.time()
rag_time_warm = end_rag_warm - start_rag_warm

# 3. Memory Retrieval
start_mem = time.time()
memory.search_memory(query)
end_mem = time.time()
mem_time = end_mem - start_mem

# 4. Total Context Build Time (Warm)
start_cb = time.time()
cb.build_context("cara simpan data siswa dan ubah status aktif")
end_cb = time.time()
cb_time = end_cb - start_cb

print("-" * 30)
print(f"Cold Start (Imports + Init): {cold_start_time:.4f}s")
print(f"First RAG Call (Model Load): {rag_time_first:.4f}s")
print(f"Total Cold Latency: {cold_start_time + rag_time_first:.4f}s")
print("-" * 30)
print(f"Code Search Warm: {cs_time:.4f}s")
print(f"ChromaDB RAG Warm: {rag_time_warm:.4f}s")
print(f"Memory Retrieval Warm: {mem_time:.4f}s")
print(f"Total Context Build Warm: {cb_time:.4f}s")
print("-" * 30)
print(f"Final Peak RAM Usage: {get_memory_usage():.2f} MB")
