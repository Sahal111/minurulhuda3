@extends('layouts.kepsek')
@section('content')
    <main class="flex-1 p-6 space-y-6 w-full max-w-[1600px] mx-auto">
        <div class="flex justify-between items-end">
            <div class="flex flex-col">
                <span class="text-xs font-semibold text-primary dark:text-primary mb-1 uppercase tracking-wider">Executive
                    Overview</span>
                <h2 class="text-2xl font-display font-bold text-slate-900 dark:text-white leading-tight">
                    Assalamualaikum, <br class="md:hidden" />Ust. Abdullah</h2>
            </div>
            <div class="text-right hidden sm:block">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Thursday, 14 Rajab 1445H</p>
            </div>
        </div>
        <section>
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-display font-bold text-slate-700 dark:text-slate-200">Key Performance
                    Indicators</h3>
                <div class="flex gap-2">
                    <span
                        class="px-2 py-1 bg-white dark:bg-slate-800 rounded-lg text-[10px] font-medium border border-slate-200 dark:border-slate-700 shadow-sm">Sem
                        2</span>
                    <span
                        class="px-2 py-1 bg-white dark:bg-slate-800 rounded-lg text-[10px] font-medium border border-slate-200 dark:border-slate-700 shadow-sm">2023/2024</span>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div
                    class="bg-white dark:bg-surface-dark p-4 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50">
                    <div class="flex justify-between items-start mb-2">
                        <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-xl text-blue-600 dark:text-blue-400">
                            <i class="w-5 h-5" data-lucide="graduation-cap"></i>
                        </div>
                        <span
                            class="flex items-center text-[10px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-1.5 py-0.5 rounded-md">
                            +2% <i class="material-icons-round text-[10px] ml-0.5">trending_up</i>
                        </span>
                    </div>
                    <div class="mt-2">
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">
                            Students</p>
                        <h4 class="text-xl font-display font-bold text-slate-800 dark:text-white">450</h4>
                    </div>
                    <div class="h-8 mt-2 flex items-end justify-between gap-0.5 opacity-60">
                        <div class="w-full bg-blue-100 h-[30%] rounded-sm"></div>
                        <div class="w-full bg-blue-100 h-[50%] rounded-sm"></div>
                        <div class="w-full bg-blue-100 h-[40%] rounded-sm"></div>
                        <div class="w-full bg-blue-200 h-[70%] rounded-sm"></div>
                        <div class="w-full bg-blue-500 h-[80%] rounded-sm"></div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark p-4 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50">
                    <div class="flex justify-between items-start mb-2">
                        <div class="p-2 bg-purple-50 dark:bg-purple-900/20 rounded-xl text-purple-600 dark:text-purple-400">
                            <i class="w-5 h-5" data-lucide="briefcase"></i>
                        </div>
                        <span
                            class="flex items-center text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-700 px-1.5 py-0.5 rounded-md">
                            0%
                        </span>
                    </div>
                    <div class="mt-2">
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">
                            Faculty</p>
                        <h4 class="text-xl font-display font-bold text-slate-800 dark:text-white">32</h4>
                    </div>
                    <div class="h-8 mt-2 flex items-end justify-between gap-0.5 opacity-60">
                        <div class="w-full bg-purple-100 h-[90%] rounded-sm"></div>
                        <div class="w-full bg-purple-100 h-[90%] rounded-sm"></div>
                        <div class="w-full bg-purple-100 h-[90%] rounded-sm"></div>
                        <div class="w-full bg-purple-200 h-[90%] rounded-sm"></div>
                        <div class="w-full bg-purple-500 h-[90%] rounded-sm"></div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark p-4 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50">
                    <div class="flex justify-between items-start mb-2">
                        <div class="p-2 bg-orange-50 dark:bg-orange-900/20 rounded-xl text-orange-600 dark:text-orange-400">
                            <i class="w-5 h-5" data-lucide="layout-grid"></i>
                        </div>
                        <span
                            class="flex items-center text-[10px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-1.5 py-0.5 rounded-md">
                            +1
                        </span>
                    </div>
                    <div class="mt-2">
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">
                            Classes</p>
                        <h4 class="text-xl font-display font-bold text-slate-800 dark:text-white">15</h4>
                    </div>
                    <div class="h-8 mt-2 flex items-end justify-between gap-0.5 opacity-60">
                        <div class="w-full bg-orange-100 h-[40%] rounded-sm"></div>
                        <div class="w-full bg-orange-100 h-[40%] rounded-sm"></div>
                        <div class="w-full bg-orange-100 h-[40%] rounded-sm"></div>
                        <div class="w-full bg-orange-200 h-[40%] rounded-sm"></div>
                        <div class="w-full bg-orange-500 h-[45%] rounded-sm"></div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark p-4 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50">
                    <div class="flex justify-between items-start mb-2">
                        <div class="p-2 bg-teal-50 dark:bg-teal-900/20 rounded-xl text-teal-600 dark:text-teal-400">
                            <i class="w-5 h-5" data-lucide="user-check"></i>
                        </div>
                        <span
                            class="flex items-center text-[10px] font-bold text-red-600 bg-red-50 dark:bg-red-900/30 px-1.5 py-0.5 rounded-md">
                            -1.2% <i class="material-icons-round text-[10px] ml-0.5">trending_down</i>
                        </span>
                    </div>
                    <div class="mt-2">
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">
                            Attendance</p>
                        <h4 class="text-xl font-display font-bold text-slate-800 dark:text-white">96%</h4>
                    </div>
                    <div class="h-8 mt-2 flex items-end justify-between gap-0.5 opacity-60">
                        <div class="w-full bg-teal-100 h-[90%] rounded-sm"></div>
                        <div class="w-full bg-teal-100 h-[92%] rounded-sm"></div>
                        <div class="w-full bg-teal-100 h-[88%] rounded-sm"></div>
                        <div class="w-full bg-teal-200 h-[95%] rounded-sm"></div>
                        <div class="w-full bg-teal-500 h-[96%] rounded-sm"></div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark p-4 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50">
                    <div class="flex justify-between items-start mb-2">
                        <div
                            class="p-2 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl text-emerald-600 dark:text-emerald-400">
                            <i class="w-5 h-5" data-lucide="wallet"></i>
                        </div>
                        <span
                            class="flex items-center text-[10px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-1.5 py-0.5 rounded-md">
                            +12%
                        </span>
                    </div>
                    <div class="mt-2">
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">
                            Income (M)</p>
                        <h4 class="text-lg font-display font-bold text-slate-800 dark:text-white">45jt</h4>
                    </div>
                    <div class="h-8 mt-2 flex items-end justify-between gap-0.5 opacity-60">
                        <div class="w-full bg-emerald-100 h-[30%] rounded-sm"></div>
                        <div class="w-full bg-emerald-100 h-[50%] rounded-sm"></div>
                        <div class="w-full bg-emerald-100 h-[40%] rounded-sm"></div>
                        <div class="w-full bg-emerald-200 h-[70%] rounded-sm"></div>
                        <div class="w-full bg-emerald-500 h-[85%] rounded-sm"></div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark p-4 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50">
                    <div class="flex justify-between items-start mb-2">
                        <div class="p-2 bg-red-50 dark:bg-red-900/20 rounded-xl text-red-600 dark:text-red-400">
                            <i class="w-5 h-5" data-lucide="alert-circle"></i>
                        </div>
                        <span
                            class="flex items-center text-[10px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-1.5 py-0.5 rounded-md">
                            -5%
                        </span>
                    </div>
                    <div class="mt-2">
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">
                            Arrears</p>
                        <h4 class="text-lg font-display font-bold text-slate-800 dark:text-white">5.2jt</h4>
                    </div>
                    <div class="h-8 mt-2 flex items-end justify-between gap-0.5 opacity-60">
                        <div class="w-full bg-red-100 h-[70%] rounded-sm"></div>
                        <div class="w-full bg-red-100 h-[60%] rounded-sm"></div>
                        <div class="w-full bg-red-100 h-[55%] rounded-sm"></div>
                        <div class="w-full bg-red-200 h-[50%] rounded-sm"></div>
                        <div class="w-full bg-red-500 h-[45%] rounded-sm"></div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark p-4 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50">
                    <div class="flex justify-between items-start mb-2">
                        <div
                            class="p-2 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl text-indigo-600 dark:text-indigo-400">
                            <i class="w-5 h-5" data-lucide="file-plus"></i>
                        </div>
                        <span
                            class="flex items-center text-[10px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-1.5 py-0.5 rounded-md">
                            New: 12
                        </span>
                    </div>
                    <div class="mt-2">
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">
                            PPDB Apps</p>
                        <h4 class="text-xl font-display font-bold text-slate-800 dark:text-white">128</h4>
                    </div>
                    <div class="h-8 mt-2 flex items-end justify-between gap-0.5 opacity-60">
                        <div class="w-full bg-indigo-100 h-[20%] rounded-sm"></div>
                        <div class="w-full bg-indigo-100 h-[35%] rounded-sm"></div>
                        <div class="w-full bg-indigo-100 h-[45%] rounded-sm"></div>
                        <div class="w-full bg-indigo-200 h-[60%] rounded-sm"></div>
                        <div class="w-full bg-indigo-500 h-[75%] rounded-sm"></div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark p-4 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50">
                    <div class="flex justify-between items-start mb-2">
                        <div class="p-2 bg-amber-50 dark:bg-amber-900/20 rounded-xl text-amber-600 dark:text-amber-400">
                            <i class="w-5 h-5" data-lucide="pie-chart"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">
                            Quota Left</p>
                        <h4 class="text-xl font-display font-bold text-slate-800 dark:text-white">22</h4>
                    </div>
                    <div class="h-8 mt-2 flex items-center">
                        <div class="w-full h-2 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-500 w-[85%] rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div
                class="bg-white dark:bg-surface-dark rounded-3xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Attendance
                            Trend</h3>
                        <p class="text-[11px] text-slate-400">Daily Average %</p>
                    </div>
                    <select
                        class="text-xs bg-slate-50 dark:bg-background-dark border-0 rounded-lg py-1.5 pl-3 pr-8 text-slate-600 dark:text-slate-300 focus:ring-1 focus:ring-primary shadow-sm font-medium">
                        <option>This Month</option>
                        <option>Last Month</option>
                    </select>
                </div>
                <div class="relative h-48 w-full">
                    <svg class="w-full h-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 100 50">
                        <defs>
                            <linearGradient id="attendanceGradient" x1="0" x2="0" y1="0"
                                y2="1">
                                <stop offset="0%" stop-color="#10b981" stop-opacity="0.2"></stop>
                                <stop offset="100%" stop-color="#10b981" stop-opacity="0"></stop>
                            </linearGradient>
                        </defs>
                        <path d="M0,40 Q15,35 30,38 T60,20 T90,25 T100,22 V50 H0 Z" fill="url(#attendanceGradient)"></path>
                        <path class="chart-line" d="M0,40 Q15,35 30,38 T60,20 T90,25 T100,22" fill="none"
                            stroke="#10b981" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        </path>
                        <circle cx="30" cy="38" fill="white" r="2" stroke="#10b981" stroke-width="2">
                        </circle>
                        <circle cx="60" cy="20" fill="white" r="2" stroke="#10b981" stroke-width="2">
                        </circle>
                        <circle cx="90" cy="25" fill="white" r="2" stroke="#10b981" stroke-width="2">
                        </circle>
                    </svg>
                    <div class="flex justify-between text-[10px] text-slate-400 mt-2 font-medium">
                        <span>Week 1</span>
                        <span>Week 2</span>
                        <span>Week 3</span>
                        <span>Week 4</span>
                    </div>
                </div>
            </div>
            <div
                class="bg-white dark:bg-surface-dark rounded-3xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Monthly Finance
                        </h3>
                        <p class="text-[11px] text-slate-400">Income vs Expenses (Millions)</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-[10px] text-slate-500">In</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                            <span class="text-[10px] text-slate-500">Out</span>
                        </div>
                    </div>
                </div>
                <div class="h-48 flex items-end justify-between gap-3 px-2">
                    <div class="flex flex-col items-center gap-2 flex-1 group">
                        <div class="flex gap-1 items-end h-full w-full justify-center">
                            <div
                                class="w-3 bg-slate-200 dark:bg-slate-700 rounded-t-sm h-[40%] group-hover:bg-slate-300 transition-all">
                            </div>
                            <div
                                class="w-3 bg-emerald-500 rounded-t-sm h-[60%] group-hover:bg-emerald-400 transition-all shadow-glow">
                            </div>
                        </div>
                        <span class="text-[10px] text-slate-400 font-medium">Aug</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 flex-1 group">
                        <div class="flex gap-1 items-end h-full w-full justify-center">
                            <div
                                class="w-3 bg-slate-200 dark:bg-slate-700 rounded-t-sm h-[50%] group-hover:bg-slate-300 transition-all">
                            </div>
                            <div class="w-3 bg-emerald-500 rounded-t-sm h-[55%] group-hover:bg-emerald-400 transition-all">
                            </div>
                        </div>
                        <span class="text-[10px] text-slate-400 font-medium">Sep</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 flex-1 group">
                        <div class="flex gap-1 items-end h-full w-full justify-center">
                            <div
                                class="w-3 bg-slate-200 dark:bg-slate-700 rounded-t-sm h-[30%] group-hover:bg-slate-300 transition-all">
                            </div>
                            <div
                                class="w-3 bg-emerald-500 rounded-t-sm h-[75%] group-hover:bg-emerald-400 transition-all shadow-[0_0_10px_rgba(16,185,129,0.5)]">
                            </div>
                        </div>
                        <span class="text-[10px] text-slate-800 dark:text-white font-bold">Oct</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 flex-1 group">
                        <div class="flex gap-1 items-end h-full w-full justify-center">
                            <div
                                class="w-3 bg-slate-200 dark:bg-slate-700 rounded-t-sm h-[60%] group-hover:bg-slate-300 transition-all">
                            </div>
                            <div class="w-3 bg-emerald-500 rounded-t-sm h-[65%] group-hover:bg-emerald-400 transition-all">
                            </div>
                        </div>
                        <span class="text-[10px] text-slate-400 font-medium">Nov</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 flex-1 group">
                        <div class="flex gap-1 items-end h-full w-full justify-center">
                            <div
                                class="w-3 bg-slate-200 dark:bg-slate-700 rounded-t-sm h-[50%] group-hover:bg-slate-300 transition-all">
                            </div>
                            <div class="w-3 bg-emerald-500 rounded-t-sm h-[80%] group-hover:bg-emerald-400 transition-all">
                            </div>
                        </div>
                        <span class="text-[10px] text-slate-400 font-medium">Dec</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 flex-1 group">
                        <div class="flex gap-1 items-end h-full w-full justify-center">
                            <div
                                class="w-3 bg-slate-200 dark:bg-slate-700 rounded-t-sm h-[40%] group-hover:bg-slate-300 transition-all">
                            </div>
                            <div class="w-3 bg-emerald-500 rounded-t-sm h-[45%] group-hover:bg-emerald-400 transition-all">
                            </div>
                        </div>
                        <span class="text-[10px] text-slate-400 font-medium">Jan</span>
                    </div>
                </div>
            </div>
            <div
                class="bg-white dark:bg-surface-dark rounded-3xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Average Grades
                        </h3>
                        <p class="text-[11px] text-slate-400">Class Performance</p>
                    </div>
                    <select
                        class="text-xs bg-slate-50 dark:bg-background-dark border-0 rounded-lg py-1.5 pl-3 pr-8 text-slate-600 dark:text-slate-300 focus:ring-1 focus:ring-primary shadow-sm font-medium">
                        <option>Math</option>
                        <option>Science</option>
                        <option>Islamic</option>
                    </select>
                </div>
                <div class="relative h-40 w-full">
                    <svg class="w-full h-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 100 50">
                        <defs>
                            <linearGradient id="gradesGradient" x1="0" x2="0" y1="0"
                                y2="1">
                                <stop offset="0%" stop-color="#8b5cf6" stop-opacity="0.3"></stop>
                                <stop offset="100%" stop-color="#8b5cf6" stop-opacity="0"></stop>
                            </linearGradient>
                        </defs>
                        <path d="M0,35 Q20,30 40,15 T60,25 T80,10 T100,20 V50 H0 Z" fill="url(#gradesGradient)">
                        </path>
                        <path d="M0,35 Q20,30 40,15 T60,25 T80,10 T100,20" fill="none" stroke="#8b5cf6"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    <div class="flex justify-between text-[10px] text-slate-400 mt-2 font-medium px-2">
                        <span>Class 1</span>
                        <span>Class 3</span>
                        <span>Class 6</span>
                    </div>
                </div>
            </div>
            <div
                class="bg-white dark:bg-surface-dark rounded-3xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">PPDB Intake
                        </h3>
                        <p class="text-[11px] text-slate-400">Yearly Comparison</p>
                    </div>
                    <div class="flex gap-2">
                        <span class="w-2 h-2 rounded-full bg-orange-500 mt-1"></span>
                        <span class="text-[10px] text-slate-500">2024</span>
                    </div>
                </div>
                <div class="relative h-40 w-full">
                    <svg class="w-full h-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 100 50">
                        <path d="M0,45 L20,40 L40,30 L60,15 L80,20 L100,5" fill="none" stroke="#f97316"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        <path d="M0,48 L20,45 L40,38 L60,30 L80,35 L100,25" fill="none" stroke="#cbd5e1"
                            stroke-dasharray="2 2" stroke-width="1.5"></path>
                    </svg>
                    <div class="flex justify-between text-[10px] text-slate-400 mt-2 font-medium px-1">
                        <span>Feb</span>
                        <span>Mar</span>
                        <span>Apr</span>
                        <span>May</span>
                        <span>Jun</span>
                        <span>Jul</span>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="bg-gradient-to-br from-emerald-900 via-emerald-800 to-slate-900 text-white rounded-3xl shadow-lg p-6 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10 blur-2xl pointer-events-none">
            </div>
            <div class="flex items-center justify-between mb-4 relative z-10">
                <div class="flex items-center gap-2">
                    <div class="bg-red-500/20 p-2 rounded-lg backdrop-blur-sm">
                        <i class="material-icons-round text-red-400 text-lg">warning</i>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-base">Critical Alerts</h3>
                        <p class="text-[10px] text-slate-300">Action Required Immediately</p>
                    </div>
                </div>
                <span
                    class="bg-red-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-full border border-red-400/30 shadow-lg">2
                    Pending</span>
            </div>
            <div class="space-y-3 relative z-10">
                <div
                    class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/10 hover:bg-white/15 transition-colors">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-orange-400 animate-pulse"></span>
                            <span class="text-xs font-semibold text-emerald-100">Pending RAB Approval</span>
                        </div>
                        <span class="text-[10px] text-slate-400 bg-black/20 px-1.5 py-0.5 rounded">2h ago</span>
                    </div>
                    <p class="text-xs text-slate-200 mb-3 leading-relaxed">Proposal for IT Lab Upgrade (20 PCs)
                        totals <span class="font-bold text-white bg-emerald-500/20 px-1 rounded">Rp
                            15.000.000</span>. Needs principal signature.</p>
                    <div class="flex gap-2">
                        <button
                            class="flex-1 bg-emerald-500 hover:bg-emerald-400 text-white text-xs font-bold py-2 rounded-lg transition-colors shadow-lg shadow-emerald-900/20">Approve</button>
                        <button
                            class="flex-1 bg-white/5 hover:bg-white/10 text-white text-xs font-medium py-2 rounded-lg transition-colors border border-white/10">Details</button>
                    </div>
                </div>
                <div
                    class="bg-white/5 rounded-xl p-3 border border-transparent hover:border-white/10 transition-colors flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                            <span class="text-xs font-semibold text-emerald-100">Overdue Task</span>
                        </div>
                        <p class="text-xs text-slate-400">Verify Teacher Certification Data</p>
                    </div>
                    <button class="text-xs text-emerald-300 hover:text-white underline">View</button>
                </div>
            </div>
        </div>
    </main>
@endsection
