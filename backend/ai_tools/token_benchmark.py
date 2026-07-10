import os
import sys
import json
import time
import tiktoken

sys.path.insert(0, os.path.abspath(os.path.dirname(__file__)))

from api.service import build_context
from eval_questions import QUESTIONS

# Load a tokenizer
encoding = tiktoken.get_encoding("cl100k_base")

def count_tokens(text: str) -> int:
    return len(encoding.encode(text))

project_root = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))

# 1. Measure Scenario A: Full Project Context
def get_full_project_tokens():
    total_tokens = 0
    total_files = 0
    dirs_to_scan = ["app", "resources/views", "routes", "database/migrations", "memory"]
    
    for d in dirs_to_scan:
        path = os.path.join(project_root, d)
        if not os.path.exists(path): continue
        for root, _, files in os.walk(path):
            for file in files:
                if file.endswith(('.php', '.md', '.html', '.js', '.css', '.json')):
                    filepath = os.path.join(root, file)
                    try:
                        with open(filepath, "r", encoding="utf-8") as f:
                            content = f.read()
                            total_tokens += count_tokens(content)
                            total_files += 1
                    except:
                        pass
    return total_tokens, total_files

print("Measuring Full Project Context (Scenario A)...")
full_project_tokens, total_scanned_files = get_full_project_tokens()
print(f"Full Project Tokens: {full_project_tokens:,} across {total_scanned_files} files.")

# 2. Measure Scenario B: Retrieved Context
queries = QUESTIONS[:20]
results = []

print(f"Measuring Retrieved Context (Scenario B) for {len(queries)} queries...")

for i, q_obj in enumerate(queries):
    q = q_obj["q"]
    print(f"  [{i+1}/{len(queries)}] {q}")
    
    t0 = time.time()
    ctx_response = build_context(q)
    latency = time.time() - t0
    
    retrieved_text = ctx_response.combined_context
    retrieved_tokens = count_tokens(retrieved_text)
    
    results.append({
        "query": q,
        "latency_sec": latency,
        "retrieved_tokens": retrieved_tokens,
        "full_tokens": full_project_tokens
    })

# 3. Calculate statistics
total_retrieved = sum(r["retrieved_tokens"] for r in results)
total_full = sum(r["full_tokens"] for r in results)

avg_retrieved = total_retrieved / len(results)
avg_full = total_full / len(results)

reduction_pct = ((avg_full - avg_retrieved) / avg_full) * 100

best_case = min(results, key=lambda x: x["retrieved_tokens"])
worst_case = max(results, key=lambda x: x["retrieved_tokens"])

best_reduction = ((best_case["full_tokens"] - best_case["retrieved_tokens"]) / best_case["full_tokens"]) * 100
worst_reduction = ((worst_case["full_tokens"] - worst_case["retrieved_tokens"]) / worst_case["full_tokens"]) * 100

# Generate Report
report = [
    "# Token Optimization Benchmark Report",
    "> Generated for Antigravity AI sidecar",
    "",
    "## 1. Scenario Definitions",
    "- **Scenario A (Baseline):** Sending the entire codebase (PHP, Blade, MD, Migrations, Routes) into the LLM context.",
    "- **Scenario B (Optimized):** Using AI Sidecar (Code Search, RAG, Memory, History) to build a focused context snippet.",
    "",
    "## 2. Summary Statistics",
    f"- **Average Scenario A (Full Context):** {avg_full:,.0f} tokens / query",
    f"- **Average Scenario B (Retrieved):** {avg_retrieved:,.0f} tokens / query",
    f"- **Overall Context Reduction:** **{reduction_pct:.2f}%**",
    "",
    "### Cost Analysis",
    "*Assuming $2.50 per 1M input tokens (GPT-4o / Claude 3.5 Sonnet range)*",
    f"- **Cost per 100 queries (Scenario A):** ${((avg_full * 100) / 1_000_000) * 2.50:.2f}",
    f"- **Cost per 100 queries (Scenario B):** ${((avg_retrieved * 100) / 1_000_000) * 2.50:.2f}",
    f"- **Estimated Cost Savings:** **{reduction_pct:.2f}%**",
    "",
    "## 3. Best vs Worst Case",
    f"- **Best Case Savings:** {best_reduction:.2f}% reduction (Query: *{best_case['query']}* | Tokens: {best_case['retrieved_tokens']})",
    f"- **Worst Case Savings:** {worst_reduction:.2f}% reduction (Query: *{worst_case['query']}* | Tokens: {worst_case['retrieved_tokens']})",
    "",
    "## 4. Query-by-Query Breakdown",
    "| Query | Full Tokens | Retrieved Tokens | Reduction % | Latency (s) |",
    "|-------|-------------|------------------|-------------|-------------|"
]

for r in results:
    reduction = ((r["full_tokens"] - r["retrieved_tokens"]) / r["full_tokens"]) * 100
    report.append(f"| {r['query']} | {r['full_tokens']:,} | {r['retrieved_tokens']:,} | {reduction:.2f}% | {r['latency_sec']:.2f}s |")

report_path = os.path.join(project_root, "TOKEN_OPTIMIZATION_REPORT.md")
with open(report_path, "w") as f:
    f.write("\n".join(report))

print(f"Benchmark completed. Report saved to {report_path}")
