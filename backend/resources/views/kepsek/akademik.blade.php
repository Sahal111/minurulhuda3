@extends('layouts.kepsek')
@section('content')
    <main class="flex-1 p-6 space-y-6 w-full max-w-[1600px] mx-auto">
        <div class="flex flex-col xl:flex-row gap-4 justify-between items-start xl:items-end">
            <div class="w-full xl:w-auto grid grid-cols-2 md:grid-cols-4 gap-3">
                <div class="space-y-1">
                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wide">Academic
                        Year</label>
                    <select
                        class="w-full md:w-40 text-sm bg-white dark:bg-surface-dark border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2.5 focus:ring-emerald-500 focus:border-emerald-500 shadow-sm">
                        <option>2023/2024</option>
                        <option>2022/2023</option>
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wide">Semester</label>
                    <select
                        class="w-full md:w-32 text-sm bg-white dark:bg-surface-dark border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2.5 focus:ring-emerald-500 focus:border-emerald-500 shadow-sm">
                        <option>Genap (2)</option>
                        <option>Ganjil (1)</option>
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wide">Class
                        Level</label>
                    <select
                        class="w-full md:w-32 text-sm bg-white dark:bg-surface-dark border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2.5 focus:ring-emerald-500 focus:border-emerald-500 shadow-sm">
                        <option>All Classes</option>
                        <option>Grade 1</option>
                        <option>Grade 2</option>
                        <option>Grade 3</option>
                        <option>Grade 4</option>
                        <option>Grade 5</option>
                        <option>Grade 6</option>
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wide">Subject</label>
                    <select
                        class="w-full md:w-40 text-sm bg-white dark:bg-surface-dark border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2.5 focus:ring-emerald-500 focus:border-emerald-500 shadow-sm">
                        <option>Matematika</option>
                        <option>Bahasa Indonesia</option>
                        <option>IPA</option>
                        <option>IPS</option>
                        <option>PAI</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center gap-2 w-full xl:w-auto">
                <button
                    class="flex-1 xl:flex-none flex items-center justify-center gap-2 px-4 py-2.5 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors shadow-sm text-sm font-medium">
                    <i class="material-icons-round text-red-500 text-lg">picture_as_pdf</i>
                    <span>PDF</span>
                </button>
                <button
                    class="flex-1 xl:flex-none flex items-center justify-center gap-2 px-4 py-2.5 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors shadow-sm text-sm font-medium">
                    <i class="material-icons-round text-emerald-600 text-lg">table_view</i>
                    <span>Excel</span>
                </button>
                <button
                    class="flex-1 xl:flex-none flex items-center justify-center gap-2 px-4 py-2.5 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors shadow-sm text-sm font-medium">
                    <i class="material-icons-round text-slate-500 text-lg">print</i>
                    <span>Print</span>
                </button>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div
                class="lg:col-span-2 bg-white dark:bg-surface-dark rounded-2xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Class
                            Performance Comparison</h3>
                        <p class="text-[11px] text-slate-400">Average Scores by Class (Current Semester)</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-[10px] text-slate-500">Avg</span>
                        </div>
                    </div>
                </div>
                <div class="relative h-64 w-full">
                    <svg class="w-full h-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 100 50">
                        <defs>
                            <linearGradient id="scoreGradient" x1="0" x2="0" y1="0" y2="1">
                                <stop offset="0%" stop-color="#10b981" stop-opacity="0.2"></stop>
                                <stop offset="100%" stop-color="#10b981" stop-opacity="0"></stop>
                            </linearGradient>
                        </defs>
                        <path d="M0,35 Q10,25 20,30 T40,15 T60,20 T80,10 T100,25 V50 H0 Z" fill="url(#scoreGradient)">
                        </path>
                        <path class="chart-line" d="M0,35 Q10,25 20,30 T40,15 T60,20 T80,10 T100,25" fill="none"
                            stroke="#10b981" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        <circle class="fill-white stroke-emerald-500" cx="0" cy="35" r="1.5"
                            stroke-width="1.5"></circle>
                        <circle class="fill-white stroke-emerald-500" cx="20" cy="30" r="1.5"
                            stroke-width="1.5"></circle>
                        <circle class="fill-white stroke-emerald-500" cx="40" cy="15" r="1.5"
                            stroke-width="1.5"></circle>
                        <circle class="fill-white stroke-emerald-500" cx="60" cy="20" r="1.5"
                            stroke-width="1.5"></circle>
                        <circle class="fill-white stroke-emerald-500" cx="80" cy="10" r="1.5"
                            stroke-width="1.5"></circle>
                        <circle class="fill-white stroke-emerald-500" cx="100" cy="25" r="1.5"
                            stroke-width="1.5"></circle>
                    </svg>
                    <div
                        class="absolute top-[10%] left-[76%] transform -translate-x-1/2 bg-slate-800 text-white text-[10px] py-1 px-2 rounded shadow-lg">
                        Highest: 88.5 (5A)
                        <div class="absolute bottom-[-4px] left-1/2 -translate-x-1/2 w-2 h-2 bg-slate-800 rotate-45">
                        </div>
                    </div>
                    <div class="flex justify-between text-[10px] text-slate-400 mt-2 font-medium px-1">
                        <span>1A</span>
                        <span>2A</span>
                        <span>3A</span>
                        <span>4A</span>
                        <span>5A</span>
                        <span>6A</span>
                    </div>
                </div>
            </div>
            <div
                class="bg-white dark:bg-surface-dark rounded-2xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50 flex flex-col">
                <div class="mb-4">
                    <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Grade Distribution
                    </h3>
                    <p class="text-[11px] text-slate-400">Student Scoring Percentage</p>
                </div>
                <div class="flex-1 flex items-center justify-center relative">
                    <div
                        class="w-40 h-40 rounded-full bg-[conic-gradient(at_center,_var(--tw-gradient-stops))] from-emerald-500 via-emerald-400 to-emerald-300 relative">
                        <div class="absolute inset-0 rounded-full"
                            style="background: conic-gradient(#10b981 0% 45%, #34d399 45% 75%, #fbbf24 75% 90%, #f87171 90% 100%);">
                        </div>
                        <div
                            class="absolute inset-8 bg-white dark:bg-surface-dark rounded-full flex items-center justify-center flex-col shadow-inner">
                            <span class="text-2xl font-bold text-slate-800 dark:text-white">450</span>
                            <span class="text-[9px] text-slate-400 uppercase tracking-wide">Total Students</span>
                        </div>
                    </div>
                </div>
                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold text-slate-700 dark:text-slate-300">Grade A
                                (85-100)</span>
                            <span class="text-[10px] text-slate-400">45% (202)</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-300"></span>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold text-slate-700 dark:text-slate-300">Grade B
                                (75-84)</span>
                            <span class="text-[10px] text-slate-400">30% (135)</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold text-slate-700 dark:text-slate-300">Grade C
                                (60-74)</span>
                            <span class="text-[10px] text-slate-400">15% (68)</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-red-400"></span>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold text-slate-700 dark:text-slate-300">Grade D
                                (&lt;60)</span>
                            <span class="text-[10px] text-slate-400">10% (45)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="bg-white dark:bg-surface-dark rounded-2xl shadow-soft border border-slate-100 dark:border-slate-700/50 overflow-hidden">
            <div class="p-6 border-b border-slate-100 dark:border-slate-700/50 flex justify-between items-center">
                <div>
                    <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Average Scores
                        Overview</h3>
                    <p class="text-[11px] text-slate-400">Per Class Performance Breakdown</p>
                </div>
                <button class="text-emerald-600 text-xs font-medium hover:text-emerald-700">View Detailed
                    Report</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700/50 text-[11px] uppercase tracking-wide text-slate-500">
                            <th class="p-4 font-semibold">Class</th>
                            <th class="p-4 font-semibold">Homeroom Teacher</th>
                            <th class="p-4 font-semibold">Students</th>
                            <th class="p-4 font-semibold">Avg Score</th>
                            <th class="p-4 font-semibold">Highest</th>
                            <th class="p-4 font-semibold">Lowest</th>
                            <th class="p-4 font-semibold">Trend</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-100 dark:divide-slate-700/50">
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="p-4 font-bold text-slate-700 dark:text-white">Class 1A</td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-6 h-6 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-[10px] font-bold">
                                        NH</div>
                                    <span>Nurul Hidayah</span>
                                </div>
                            </td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">28</td>
                            <td class="p-4 font-bold text-emerald-600">82.5</td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">98</td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">65</td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-16 h-8" viewBox="0 0 50 20">
                                        <path d="M0,15 L10,10 L20,12 L30,5 L40,8 L50,2" fill="none" stroke="#10b981"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg>
                                    <span class="text-[10px] text-emerald-600 font-bold">+2.4%</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="p-4 font-bold text-slate-700 dark:text-white">Class 2A</td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-[10px] font-bold">
                                        AS</div>
                                    <span>Ahmad Sobari</span>
                                </div>
                            </td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">30</td>
                            <td class="p-4 font-bold text-emerald-600">79.8</td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">95</td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">60</td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-16 h-8" viewBox="0 0 50 20">
                                        <path d="M0,10 L10,12 L20,8 L30,12 L40,10 L50,10" fill="none" stroke="#f59e0b"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg>
                                    <span class="text-[10px] text-amber-500 font-bold">0.0%</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="p-4 font-bold text-slate-700 dark:text-white">Class 3B</td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-6 h-6 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center text-[10px] font-bold">
                                        FT</div>
                                    <span>Fatima Zahra</span>
                                </div>
                            </td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">29</td>
                            <td class="p-4 font-bold text-red-500">71.2</td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">90</td>
                            <td class="p-4 text-slate-600 dark:text-slate-300">45</td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-16 h-8" viewBox="0 0 50 20">
                                        <path d="M0,5 L10,8 L20,10 L30,12 L40,15 L50,18" fill="none" stroke="#ef4444"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg>
                                    <span class="text-[10px] text-red-500 font-bold">-1.8%</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div
                class="bg-white dark:bg-surface-dark rounded-2xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                <div class="flex items-center gap-2 mb-4">
                    <div
                        class="p-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-lg">
                        <i class="material-icons-round text-lg">emoji_events</i>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Top 10
                            Outstanding</h3>
                        <p class="text-[11px] text-slate-400">Highest Achieving Students</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div
                        class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors border border-transparent hover:border-slate-100 dark:hover:border-slate-700">
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-slate-300 text-lg w-4 text-center">1</span>
                            <div
                                class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white text-xs font-bold">
                                AZ</div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-white leading-tight">Ahmad
                                    Zulkarnain</h4>
                                <span class="text-[10px] text-slate-500">Class 5A</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="block text-sm font-bold text-emerald-600">98.5</span>
                            <span class="flex items-center justify-end text-[10px] text-emerald-500 gap-0.5">
                                <i class="material-icons-round text-[10px]">trending_up</i> Avg
                            </span>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors border border-transparent hover:border-slate-100 dark:hover:border-slate-700">
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-slate-300 text-lg w-4 text-center">2</span>
                            <div
                                class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-xs font-bold">
                                SN</div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-white leading-tight">Siti
                                    Nurhaliza</h4>
                                <span class="text-[10px] text-slate-500">Class 6B</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="block text-sm font-bold text-emerald-600">97.2</span>
                            <span class="flex items-center justify-end text-[10px] text-emerald-500 gap-0.5">
                                <i class="material-icons-round text-[10px]">trending_up</i> Avg
                            </span>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors border border-transparent hover:border-slate-100 dark:hover:border-slate-700">
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-slate-300 text-lg w-4 text-center">3</span>
                            <div
                                class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs font-bold">
                                RF</div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-white leading-tight">Rian
                                    Firmansyah</h4>
                                <span class="text-[10px] text-slate-500">Class 4A</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="block text-sm font-bold text-emerald-600">96.8</span>
                            <span class="flex items-center justify-end text-[10px] text-emerald-500 gap-0.5">
                                <i class="material-icons-round text-[10px]">trending_up</i> Avg
                            </span>
                        </div>
                    </div>
                    <div class="pt-2 text-center">
                        <a class="text-xs font-medium text-emerald-600 hover:text-emerald-700" href="#">View
                            Full Leaderboard</a>
                    </div>
                </div>
            </div>
            <div
                class="bg-white dark:bg-surface-dark rounded-2xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                <div class="flex items-center gap-2 mb-4">
                    <div class="p-2 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg">
                        <i class="material-icons-round text-lg">priority_high</i>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Needs Attention
                        </h3>
                        <p class="text-[11px] text-slate-400">10 Students with Low Performance</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div
                        class="flex items-center justify-between p-3 rounded-xl bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-800/30">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-red-200 text-red-700 flex items-center justify-center text-xs font-bold">
                                BU</div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-white leading-tight">Budi
                                    Utomo</h4>
                                <span class="text-[10px] text-slate-500">Class 3B</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="block text-sm font-bold text-red-600">45.0</span>
                            <span class="flex items-center justify-end text-[10px] text-red-500 gap-0.5">
                                <i class="material-icons-round text-[10px]">trending_down</i> Math
                            </span>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between p-3 rounded-xl bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-800/30">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-red-200 text-red-700 flex items-center justify-center text-xs font-bold">
                                DA</div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-white leading-tight">Dewi
                                    Anggraeni</h4>
                                <span class="text-[10px] text-slate-500">Class 2C</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="block text-sm font-bold text-red-600">52.5</span>
                            <span class="flex items-center justify-end text-[10px] text-red-500 gap-0.5">
                                <i class="material-icons-round text-[10px]">trending_down</i> IPA
                            </span>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between p-3 rounded-xl bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-800/30">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-red-200 text-red-700 flex items-center justify-center text-xs font-bold">
                                KR</div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-white leading-tight">
                                    Kurniawan Rizki</h4>
                                <span class="text-[10px] text-slate-500">Class 5A</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="block text-sm font-bold text-red-600">58.0</span>
                            <span class="flex items-center justify-end text-[10px] text-red-500 gap-0.5">
                                <i class="material-icons-round text-[10px]">trending_down</i> Eng
                            </span>
                        </div>
                    </div>
                    <div class="pt-2 text-center">
                        <button
                            class="text-xs font-medium text-red-600 hover:text-red-700 px-3 py-1 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">Notify
                            Parents &amp; Counselors</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

