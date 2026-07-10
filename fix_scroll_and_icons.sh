#!/bin/bash
FILE="/Users/sahalanwarhadi/Documents/minurulhuda3/resources/views/operator/partials/_modalKartuGuru.blade.php"

# Fix min-h-0 on wrappers to ensure scrolling works
sed -i '' 's|<div class="flex-1 p-6 sm:p-10 bg-slate-50/50 dark:bg-slate-900/50 overflow-hidden flex flex-col">|<div class="flex-1 p-6 sm:p-10 bg-slate-50/50 dark:bg-slate-900/50 overflow-hidden flex flex-col min-h-0">|g' "$FILE"

sed -i '' 's|<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 flex-1 overflow-hidden h-full">|<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 flex-1 overflow-hidden h-full min-h-0">|g' "$FILE"

sed -i '' 's|<aside class="lg:col-span-4 flex flex-col gap-6 overflow-y-auto custom-scrollbar pr-2 pb-4 h-full">|<aside class="lg:col-span-4 flex flex-col gap-6 overflow-y-auto custom-scrollbar pr-2 pb-4 h-full min-h-0">|g' "$FILE"

sed -i '' 's|<main class="md:col-span-1 lg:col-span-8 flex flex-col gap-5 overflow-hidden h-full">|<main class="md:col-span-1 lg:col-span-8 flex flex-col gap-5 overflow-hidden h-full min-h-0">|g' "$FILE"

# Fix icons
sed -i '' 's|<i class="ti ti-user"></i>|<span class="material-symbols-outlined text-[1.2em]">person</span>|g' "$FILE"
sed -i '' 's|<i class="ti ti-id-badge-2"></i>|<span class="material-symbols-outlined text-[1.2em]">badge</span>|g' "$FILE"
sed -i '' 's|<i class="ti ti-award"></i>|<span class="material-symbols-outlined text-[1.2em]">workspace_premium</span>|g' "$FILE"
sed -i '' 's|<i class="ti ti-wallet"></i>|<span class="material-symbols-outlined text-[1.2em]">account_balance_wallet</span>|g' "$FILE"
sed -i '' 's|<i class="ti ti-school"></i>|<span class="material-symbols-outlined text-[1.2em]">school</span>|g' "$FILE"

