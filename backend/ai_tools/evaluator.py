import json
import os
import sys

sys.path.insert(0, os.path.abspath(os.path.dirname(__file__)))

from api.service import build_context
from eval_questions import QUESTIONS

results = []

print("Running Evaluation Suite for 30 questions...")

for i, q_obj in enumerate(QUESTIONS):
    print(f"[{i+1}/{len(QUESTIONS)}] Query: {q_obj['q']}")
    try:
        ctx_response = build_context(q_obj['q'])
        
        retrieved = []
        # code_context is a list of strings
        if ctx_response.code_context:
            for section in ctx_response.code_context:
                for line in section.split('\n'):
                    if line.startswith('File: '):
                        retrieved.append(line.replace('File: ', '').split(' ')[0].strip())
        
        if ctx_response.rag_context:
            for section in ctx_response.rag_context:
                for line in section.split('\n'):
                    if line.startswith('--- Source:'):
                        retrieved.append(line.replace('--- Source:', '').replace('---', '').strip())
        
        if ctx_response.memory_context:
            # Check if there are specific memory hits (ignoring the global get_context_string result if it doesn't have the hits)
            # The global string has "=== LONG-TERM MEMORY ==="
            has_hits = any(not section.startswith('=== LONG-TERM MEMORY ===') for section in ctx_response.memory_context)
            if has_hits:
                retrieved.append("ai_tools/memory_store.sqlite (Memory)")
            
        retrieved_source = ", ".join(list(set(retrieved)))
        if not retrieved_source:
            retrieved_source = "None"
            
        q_obj["retrieved_source"] = retrieved_source
        q_obj["context_snippet"] = ctx_response.combined_context[:1000] 
        results.append(q_obj)
        
    except Exception as e:
        print(f"Error on {q_obj['q']}: {e}")
        q_obj["retrieved_source"] = f"Error: {e}"
        q_obj["context_snippet"] = ""
        results.append(q_obj)

with open("evaluation_results.json", "w") as f:
    json.dump(results, f, indent=2)

print("Evaluation contexts saved to evaluation_results.json")
