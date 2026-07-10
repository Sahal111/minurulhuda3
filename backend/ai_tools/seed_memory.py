#!/usr/bin/env python3
"""
Memory Seeding & Verification
==============================

Seeds 25 persistent memories across 5 categories and verifies all CRUD operations.

Categories:
  1. Project Facts       (project_goal, domain_knowledge)
  2. Architecture Decisions (architecture, tech_decision)
  3. Coding Conventions  (coding_convention, user_preference)
  4. Deployment Notes    (deployment, constraint)
  5. Indexing Statistics  (indexing_stats)

Run:
    cd ai_tools && python seed_memory.py
"""

import os
import sys
import json
import time
import datetime
from pathlib import Path

# Ensure imports work
sys.path.insert(0, os.path.abspath(os.path.dirname(__file__)))

from memory.memory_manager import MemoryManager
from memory.memory_types import MemoryCategory

PROJECT_ROOT = str(Path(__file__).parent.parent.absolute())
REPORT_PATH = Path(__file__).parent.parent / "MEMORY_SEED_REPORT.md"

# ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
# Memory Definitions — 25 memories across all 5 requested categories
# ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

SEED_MEMORIES = [
    # ─── Category 1: Project Facts ───────────────────────────────────────────
    {
        "category": MemoryCategory.PROJECT_GOAL,
        "key": "project_identity",
        "content": "MI Nurul Huda 3 — School Information System (SIS) for Madrasah Ibtidaiyah Nurul Huda 3. Manages academic operations, student/teacher data, finances, and PPDB (new student enrollment).",
        "metadata": {"priority": "critical", "domain": "education"}
    },
    {
        "category": MemoryCategory.DOMAIN_KNOWLEDGE,
        "key": "user_roles",
        "content": "System has 6 roles: operator (full CRUD), guru (teacher view), kepsek (principal reports), bendahara (finance), admin_ppdb (enrollment), ortu (parent portal). Roles stored in many-to-many pivot table role_user.",
        "metadata": {"table": "role_user", "count": 6}
    },
    {
        "category": MemoryCategory.DOMAIN_KNOWLEDGE,
        "key": "model_count",
        "content": "The system has 42 Eloquent models across 5 modules: Core (4), Siswa (10), Guru (11), Akademik (10), Keuangan (3), PPDB (4).",
        "metadata": {"total": 42, "verified_date": "2026-06-13"}
    },
    {
        "category": MemoryCategory.DOMAIN_KNOWLEDGE,
        "key": "soft_delete_cascade",
        "content": "Siswa and Guru models implement custom cascade soft-delete via boot events. Siswa soft-delete cascades to riwayat_kelas, nilais, absensis, rapors, catatan_walis, perkembangans. Pembayarans are excluded for audit compliance.",
        "metadata": {"models": ["Siswa", "Guru"], "pattern": "boot_event_cascade"}
    },
    {
        "category": MemoryCategory.PROJECT_GOAL,
        "key": "academic_workflow",
        "content": "Core academic workflow: Semester setup → Class assignment → Schedule creation → Daily attendance → Grade entry → Rapor generation → Year-end promotion/graduation.",
        "metadata": {"priority": "high"}
    },

    # ─── Category 2: Architecture Decisions ──────────────────────────────────
    {
        "category": MemoryCategory.ARCHITECTURE,
        "key": "stack_overview",
        "content": "Laravel 11.x + PHP 8.2 monolith with MySQL database. Frontend: Blade templates + Tailwind CSS v3 + Alpine.js v3. Selective use of Livewire v4 for reactive components. Vite 6 as bundler.",
        "metadata": {"php": "8.2", "laravel": "11.x", "node": "vite6"}
    },
    {
        "category": MemoryCategory.ARCHITECTURE,
        "key": "ai_sidecar_architecture",
        "content": "Python 3.12+ AI sidecar runs as FastAPI service on port 8000. Modules: code_search (indexer + symbol search + class skeleton), memory (SQLite-backed long-term), rag (ChromaDB vector embeddings), history (conversation compression).",
        "metadata": {"port": 8000, "framework": "FastAPI", "modules": 4}
    },
    {
        "category": MemoryCategory.ARCHITECTURE,
        "key": "service_layer_pattern",
        "content": "Complex business logic lives in app/Services/. RiwayatKelasService handles all class history operations (move, reactivation, terminal events, promotion). Services are constructor-injected into Controllers.",
        "metadata": {"path": "app/Services/", "pattern": "DI"}
    },
    {
        "category": MemoryCategory.TECH_DECISION,
        "key": "database_engine",
        "content": "MySQL is the primary RDBMS. 103 migration files covering Feb–May 2026 development. Session, cache, and queue drivers all use database driver (not Redis in production).",
        "metadata": {"migrations": 103, "driver": "mysql"}
    },
    {
        "category": MemoryCategory.TECH_DECISION,
        "key": "vector_store_choice",
        "content": "ChromaDB chosen for local vector embeddings to avoid external API costs. Used for semantic code search and RAG. sentence-transformers provides the embedding model.",
        "metadata": {"reason": "cost_avoidance", "engine": "chromadb"}
    },

    # ─── Category 3: Coding Conventions ──────────────────────────────────────
    {
        "category": MemoryCategory.CODING_CONVENTION,
        "key": "php_style",
        "content": "PHP follows PSR-12 coding standard. 4-space indentation. Laravel Pint is configured for auto-formatting. Use type hints on all method signatures.",
        "metadata": {"standard": "PSR-12", "formatter": "laravel/pint"}
    },
    {
        "category": MemoryCategory.CODING_CONVENTION,
        "key": "js_style",
        "content": "Vanilla JavaScript preferred over frameworks. Alpine.js for reactivity. No jQuery. ES6+ syntax (const/let, arrow functions, template literals). 2-space indent in JS/CSS.",
        "metadata": {"framework": "alpine.js", "indent": 2}
    },
    {
        "category": MemoryCategory.CODING_CONVENTION,
        "key": "blade_conventions",
        "content": "Blade views organized by role: layouts/{role}.blade.php. Large views split into partials under subdirectories. Use @section/@yield for layout inheritance. Component-based approach with x-components.",
        "metadata": {"total_views": 100, "layout_count": 6}
    },
    {
        "category": MemoryCategory.CODING_CONVENTION,
        "key": "naming_conventions",
        "content": "Models: PascalCase singular (Siswa, Guru). Tables: snake_case plural (siswas, gurus). Controllers: {Model}Controller in app/Http/Controllers/Operator/. Migrations: timestamp_create_{table}_table.php.",
        "metadata": {"orm": "eloquent"}
    },
    {
        "category": MemoryCategory.CODING_CONVENTION,
        "key": "commit_and_branching",
        "content": "Conventional Commits format (feat:, fix:, refactor:, docs:). Descriptive commit messages required. Python code uses snake_case functions and 4-space indent following PEP 8.",
        "metadata": {"git_flow": "conventional_commits", "python_style": "PEP8"}
    },

    # ─── Category 4: Deployment Notes ────────────────────────────────────────
    {
        "category": MemoryCategory.DEPLOYMENT,
        "key": "server_constraints",
        "content": "Production server: 4GB RAM limit. Python sidecar must run single Uvicorn worker. PHP CLI workers set to 4. Queue uses database driver (not Redis).",
        "metadata": {"ram_gb": 4, "uvicorn_workers": 1, "php_workers": 4}
    },
    {
        "category": MemoryCategory.DEPLOYMENT,
        "key": "ai_bridge_config",
        "content": "AiBridgeService connects Laravel ↔ FastAPI sidecar. Config: URL=http://127.0.0.1:8000, timeout=30s, connect_timeout=5s, retries=2, retry_delay=200ms. Cache disabled by default.",
        "metadata": {"env_prefix": "AI_BRIDGE_", "fault_tolerant": True}
    },
    {
        "category": MemoryCategory.DEPLOYMENT,
        "key": "file_storage_layout",
        "content": "storage/app/public/ for profile photos (symlinked). storage/app/local/ for private student/teacher documents. Files explicitly deleted on force-delete of model.",
        "metadata": {"public_disk": "storage/app/public/", "private_disk": "storage/app/local/"}
    },
    {
        "category": MemoryCategory.DEPLOYMENT,
        "key": "dev_server_setup",
        "content": "Development uses `composer dev` which runs concurrently: php artisan serve + queue:listen + pail (logs) + npm run dev (Vite HMR). 4 concurrent processes via npx concurrently.",
        "metadata": {"command": "composer dev", "processes": 4}
    },
    {
        "category": MemoryCategory.CONSTRAINT,
        "key": "no_external_llm",
        "content": "System must operate entirely locally — no external LLM API calls (OpenAI, Gemini, etc.) for core operations. AI context is strictly an internal API service, no chatbot UI.",
        "metadata": {"hard_constraint": True}
    },

    # ─── Category 5: Indexing Statistics ─────────────────────────────────────
    {
        "category": MemoryCategory.INDEXING_STATS,
        "key": "codebase_file_count",
        "content": "Code index covers 305 files. 71 PHP files in app/ directory. 100 Blade template files in resources/views/. 103 database migration files.",
        "metadata": {"indexed_files": 305, "php_app_files": 71, "blade_views": 100, "migrations": 103}
    },
    {
        "category": MemoryCategory.INDEXING_STATS,
        "key": "class_method_index",
        "content": "Code index contains 78 classes and 398 methods across the Laravel codebase. 20 standalone functions indexed. Index stored in ai_tools/code_index.json (394KB).",
        "metadata": {"classes": 78, "methods": 398, "functions": 20, "index_size_kb": 394}
    },
    {
        "category": MemoryCategory.INDEXING_STATS,
        "key": "controller_distribution",
        "content": "9 Operator controllers (GuruController, SiswaController, KelasController, etc.) + 5 top-level controllers (AuthController, HomeController, ProfileController, AdminUserController, Controller). Operator namespace handles bulk of CRUD.",
        "metadata": {"operator_controllers": 9, "top_level_controllers": 5}
    },
    {
        "category": MemoryCategory.INDEXING_STATS,
        "key": "model_distribution",
        "content": "42 Eloquent models: Siswa module (10), Guru module (11), Akademik module (10), Keuangan module (3), PPDB module (4), Core/Infra (4). All in app/Models/ flat namespace.",
        "metadata": {"total": 42, "largest_module": "Guru", "path": "app/Models/"}
    },
    {
        "category": MemoryCategory.INDEXING_STATS,
        "key": "vector_index_status",
        "content": "ChromaDB vector index holds embeddings for all 78 PHP classes and 398 methods. SQLite memory store at ai_tools/memory_store.sqlite. Incremental re-indexing supported via run_index.py.",
        "metadata": {"embeddings": 476, "storage": "chromadb", "incremental": True}
    },
]

assert len(SEED_MEMORIES) >= 20, f"Need ≥20 memories, got {len(SEED_MEMORIES)}"


# ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
# Execution
# ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

def run_seed_and_verify():
    results = {
        "timestamp": datetime.datetime.now().isoformat(),
        "seed_count": len(SEED_MEMORIES),
        "phases": {}
    }

    # ── Phase 0: Clean slate ─────────────────────────────────────────────────
    print("=" * 70)
    print("  MEMORY SEEDING & VERIFICATION")
    print("=" * 70)

    manager = MemoryManager(PROJECT_ROOT)

    # Clear existing memories for a clean seed
    existing = manager.list_memories()
    if existing:
        print(f"\n[CLEANUP] Removing {len(existing)} existing memories...")
        for mem in existing:
            manager.delete_memory(mem.id)
        print(f"[CLEANUP] Done. Database is clean.")
    results["phases"]["cleanup"] = {"removed": len(existing), "status": "PASS"}

    # ── Phase 1: Seed ────────────────────────────────────────────────────────
    print(f"\n{'─' * 70}")
    print(f"  PHASE 1: SEEDING {len(SEED_MEMORIES)} MEMORIES")
    print(f"{'─' * 70}")

    inserted_ids = []
    category_counts = {}
    for i, mem in enumerate(SEED_MEMORIES):
        cat = mem["category"].value if hasattr(mem["category"], "value") else mem["category"]
        mem_id = manager.save_memory(
            cat,
            mem["key"],
            mem["content"],
            mem.get("metadata")
        )
        inserted_ids.append(mem_id)
        category_counts[cat] = category_counts.get(cat, 0) + 1
        print(f"  [{i+1:2d}/{len(SEED_MEMORIES)}] ✅ {cat:<22s} | {mem['key']}")

    print(f"\n  Total inserted: {len(inserted_ids)}")
    print(f"  By category:")
    for cat, cnt in sorted(category_counts.items()):
        print(f"    {cat:<22s}: {cnt}")

    results["phases"]["seed"] = {
        "total_inserted": len(inserted_ids),
        "by_category": category_counts,
        "status": "PASS"
    }

    # ── Phase 2: Retrieval Verification ──────────────────────────────────────
    print(f"\n{'─' * 70}")
    print(f"  PHASE 2: RETRIEVAL VERIFICATION")
    print(f"{'─' * 70}")

    retrieval_tests = [
        ("FastAPI", None, "Cross-category search"),
        ("Laravel", None, "Framework keyword search"),
        ("PSR-12", MemoryCategory.CODING_CONVENTION.value, "Category-scoped search"),
        ("4GB", MemoryCategory.DEPLOYMENT.value, "Deployment category search"),
        ("78 classes", MemoryCategory.INDEXING_STATS.value, "Indexing stats search"),
        ("Siswa", None, "Domain entity search"),
        ("ChromaDB", None, "Tech decision search"),
    ]

    retrieval_results = []
    all_retrieval_pass = True
    for query, category, description in retrieval_tests:
        hits = manager.search_memory(query, category=category)
        passed = len(hits) > 0
        status = "✅ PASS" if passed else "❌ FAIL"
        if not passed:
            all_retrieval_pass = False
        print(f"  {status} | query='{query}' cat={category or 'ALL':<22s} → {len(hits)} hit(s)  [{description}]")
        if hits:
            print(f"         └─ Top: [{hits[0].key}] {hits[0].content[:60]}...")
        retrieval_results.append({
            "query": query, "category": category,
            "description": description, "hits": len(hits), "passed": passed
        })

    # Also verify list_all by category
    print(f"\n  List by category:")
    for cat_enum in MemoryCategory:
        cat_mems = manager.list_memories(cat_enum.value)
        if cat_mems:
            print(f"    {cat_enum.value:<22s}: {len(cat_mems)} memories")

    results["phases"]["retrieval"] = {
        "tests": retrieval_results,
        "all_passed": all_retrieval_pass,
        "status": "PASS" if all_retrieval_pass else "FAIL"
    }

    # ── Phase 3: Update Verification ─────────────────────────────────────────
    print(f"\n{'─' * 70}")
    print(f"  PHASE 3: UPDATE VERIFICATION")
    print(f"{'─' * 70}")

    update_target_id = inserted_ids[0]
    original = manager.search_memory("project_identity")[0]
    print(f"  Target: [{original.key}] id={update_target_id[:8]}...")
    print(f"  Original content: {original.content[:60]}...")

    # Update content
    new_content = "UPDATED: MI Nurul Huda 3 — School Information System (SIS) v2.0. Now with enhanced AI-powered code search and long-term memory."
    update_ok = manager.update_memory(update_target_id, content=new_content)
    print(f"  Content update: {'✅ PASS' if update_ok else '❌ FAIL'}")

    # Update metadata
    new_meta = {"priority": "critical", "domain": "education", "version": "2.0", "updated_by": "seed_script"}
    meta_ok = manager.update_memory(update_target_id, metadata=new_meta)
    print(f"  Metadata update: {'✅ PASS' if meta_ok else '❌ FAIL'}")

    # Verify update persisted
    updated = manager.search_memory("UPDATED: MI Nurul Huda")
    content_verified = len(updated) > 0 and "UPDATED" in updated[0].content
    print(f"  Content verified: {'✅ PASS' if content_verified else '❌ FAIL'}")

    if updated:
        meta_verified = updated[0].metadata.get("version") == "2.0"
        print(f"  Metadata verified: {'✅ PASS' if meta_verified else '❌ FAIL'}")
    else:
        meta_verified = False
        print(f"  Metadata verified: ❌ FAIL (no record found)")

    all_update_pass = update_ok and meta_ok and content_verified and meta_verified
    results["phases"]["update"] = {
        "content_update": update_ok,
        "metadata_update": meta_ok,
        "content_verified": content_verified,
        "metadata_verified": meta_verified,
        "status": "PASS" if all_update_pass else "FAIL"
    }

    # Revert the update so final count is correct
    manager.update_memory(update_target_id, content=SEED_MEMORIES[0]["content"], metadata=SEED_MEMORIES[0]["metadata"])

    # ── Phase 4: Delete Verification ─────────────────────────────────────────
    print(f"\n{'─' * 70}")
    print(f"  PHASE 4: DELETE VERIFICATION")
    print(f"{'─' * 70}")

    count_before = len(manager.list_memories())
    print(f"  Memories before delete: {count_before}")

    # Delete the last inserted memory
    delete_target_id = inserted_ids[-1]
    delete_target_key = SEED_MEMORIES[-1]["key"]
    print(f"  Deleting: [{delete_target_key}] id={delete_target_id[:8]}...")

    delete_ok = manager.delete_memory(delete_target_id)
    count_after = len(manager.list_memories())
    count_correct = count_after == count_before - 1

    print(f"  Delete operation: {'✅ PASS' if delete_ok else '❌ FAIL'}")
    print(f"  Memories after delete: {count_after} (expected {count_before - 1})")
    print(f"  Count verified: {'✅ PASS' if count_correct else '❌ FAIL'}")

    # Verify it's really gone
    search_deleted = manager.search_memory(delete_target_key)
    gone_verified = all(s.id != delete_target_id for s in search_deleted)
    print(f"  Record gone: {'✅ PASS' if gone_verified else '❌ FAIL'}")

    all_delete_pass = delete_ok and count_correct and gone_verified
    results["phases"]["delete"] = {
        "delete_ok": delete_ok,
        "count_before": count_before,
        "count_after": count_after,
        "record_gone": gone_verified,
        "status": "PASS" if all_delete_pass else "FAIL"
    }

    # Re-insert the deleted memory to restore full set
    restored_id = manager.save_memory(
        SEED_MEMORIES[-1]["category"].value,
        SEED_MEMORIES[-1]["key"],
        SEED_MEMORIES[-1]["content"],
        SEED_MEMORIES[-1].get("metadata")
    )
    inserted_ids[-1] = restored_id
    print(f"  Restored deleted memory: id={restored_id[:8]}...")

    # ── Phase 5: Persistence After Restart ───────────────────────────────────
    print(f"\n{'─' * 70}")
    print(f"  PHASE 5: PERSISTENCE AFTER RESTART")
    print(f"{'─' * 70}")

    # Create a completely fresh MemoryManager instance (simulates restart)
    print("  Instantiating new MemoryManager (simulating restart)...")
    manager2 = MemoryManager(PROJECT_ROOT)

    persisted = manager2.list_memories()
    expected_count = len(SEED_MEMORIES)
    persistence_ok = len(persisted) == expected_count

    print(f"  Memories loaded from disk: {len(persisted)} (expected {expected_count})")
    print(f"  Persistence check: {'✅ PASS' if persistence_ok else '❌ FAIL'}")

    # Verify category distribution survived restart
    persisted_cats = {}
    for m in persisted:
        persisted_cats[m.category] = persisted_cats.get(m.category, 0) + 1

    cats_match = persisted_cats == category_counts
    print(f"  Category distribution intact: {'✅ PASS' if cats_match else '❌ FAIL'}")

    if not cats_match:
        print(f"    Expected: {category_counts}")
        print(f"    Got:      {persisted_cats}")

    # Verify search works on fresh instance
    fresh_search = manager2.search_memory("Laravel")
    fresh_search_ok = len(fresh_search) > 0
    print(f"  Search on fresh instance: {'✅ PASS' if fresh_search_ok else '❌ FAIL'} ({len(fresh_search)} hits)")

    # Verify context string output
    context_str = manager2.get_context_string()
    context_ok = "LONG-TERM MEMORY" in context_str and len(context_str) > 100
    print(f"  Context string generation: {'✅ PASS' if context_ok else '❌ FAIL'} ({len(context_str)} chars)")

    all_persist_pass = persistence_ok and cats_match and fresh_search_ok and context_ok
    results["phases"]["persistence"] = {
        "memories_loaded": len(persisted),
        "expected": expected_count,
        "categories_match": cats_match,
        "search_works": fresh_search_ok,
        "context_string_ok": context_ok,
        "status": "PASS" if all_persist_pass else "FAIL"
    }

    # ── Summary ──────────────────────────────────────────────────────────────
    print(f"\n{'=' * 70}")
    print(f"  SUMMARY")
    print(f"{'=' * 70}")

    all_phases_pass = all(
        p["status"] == "PASS" for p in results["phases"].values()
    )
    results["overall_status"] = "ALL PASS ✅" if all_phases_pass else "SOME FAILURES ❌"

    for phase_name, phase_data in results["phases"].items():
        icon = "✅" if phase_data["status"] == "PASS" else "❌"
        print(f"  {icon} {phase_name.upper():<20s}: {phase_data['status']}")

    print(f"\n  Overall: {results['overall_status']}")
    print(f"  Final memory count: {len(manager2.list_memories())}")
    print(f"{'=' * 70}")

    return results


if __name__ == "__main__":
    results = run_seed_and_verify()

    # Save results as JSON for report generation
    json_path = Path(__file__).parent / "seed_results.json"
    with open(json_path, "w") as f:
        json.dump(results, f, indent=2, default=str)
    print(f"\n  Results saved to: {json_path}")
