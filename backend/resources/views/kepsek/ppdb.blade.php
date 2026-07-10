@extends('layouts.kepsek')
@section('content')
    <main class="flex-1 p-6 space-y-6 w-full max-w-[1600px] mx-auto">
        <div class="flex justify-between items-end">
            <div class="flex flex-col">
                <span class="text-xs font-semibold text-primary dark:text-primary mb-1 uppercase tracking-wider">Admission
                    Analytics</span>
                <h2 class="text-2xl font-display font-bold text-slate-900 dark:text-white leading-tight">PPDB
                    2024/2025 Overview</h2>
            </div>
            <div class="flex items-center gap-2">
                <button
                    class="flex items-center gap-2 px-3 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-xs font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 transition-colors shadow-sm">
                    <i class="material-icons-round text-sm">cloud_download</i>
                    Export Report
                </button>
                <button
                    class="flex items-center gap-2 px-3 py-2 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition-colors shadow-glow">
                    <i class="material-icons-round text-sm">add</i>
                    New Applicant
                </button>
            </div>
        </div>
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div
                class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50 relative overflow-hidden group hover:shadow-soft transition-all">
                <div class="absolute right-0 top-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                    <i class="material-icons-round text-6xl text-blue-600">group_add</i>
                </div>
                <div class="flex justify-between items-start mb-3">
                    <div class="p-2.5 bg-blue-50 dark:bg-blue-900/20 rounded-xl text-blue-600 dark:text-blue-400">
                        <i class="material-icons-round text-xl">assignment_ind</i>
                    </div>
                    <span
                        class="flex items-center text-[10px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-1 rounded-md">
                        +12 Today
                    </span>
                </div>
                <div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">
                        Total Applicants</p>
                    <h4 class="text-2xl font-display font-bold text-slate-800 dark:text-white mt-1">342</h4>
                </div>
                <div class="flex items-center gap-4 mt-4 pt-3 border-t border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                        <span class="text-xs text-slate-600 dark:text-slate-300 font-medium">180 Boys</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-pink-500"></span>
                        <span class="text-xs text-slate-600 dark:text-slate-300 font-medium">162 Girls</span>
                    </div>
                </div>
            </div>
            <div
                class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50 relative overflow-hidden group hover:shadow-soft transition-all">
                <div class="absolute right-0 top-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                    <i class="material-icons-round text-6xl text-emerald-600">check_circle</i>
                </div>
                <div class="flex justify-between items-start mb-3">
                    <div
                        class="p-2.5 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl text-emerald-600 dark:text-emerald-400">
                        <i class="material-icons-round text-xl">playlist_add_check</i>
                    </div>
                    <span
                        class="flex items-center text-[10px] font-bold text-slate-500 bg-slate-100 dark:bg-slate-700 px-2 py-1 rounded-md">
                        Avg 82
                    </span>
                </div>
                <div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">
                        Success Rate</p>
                    <h4 class="text-2xl font-display font-bold text-slate-800 dark:text-white mt-1">68%</h4>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-700 h-1.5 rounded-full mt-5 overflow-hidden">
                    <div class="bg-emerald-500 h-full rounded-full" style="width: 68%"></div>
                </div>
                <p class="text-[10px] text-slate-400 mt-2 text-right">232 Passed Selection</p>
            </div>
            <div
                class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50 relative overflow-hidden group hover:shadow-soft transition-all">
                <div class="flex justify-between items-start">
                    <div class="flex flex-col justify-between h-full">
                        <div
                            class="p-2.5 bg-amber-50 dark:bg-amber-900/20 rounded-xl text-amber-600 dark:text-amber-400 w-fit mb-3">
                            <i class="material-icons-round text-xl">pie_chart</i>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">
                                Remaining Quota</p>
                            <h4 class="text-2xl font-display font-bold text-slate-800 dark:text-white mt-1">45
                                <span class="text-sm font-normal text-slate-400">/ 120</span>
                            </h4>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-3 font-medium">Target Fulfillment: 62%</p>
                    </div>
                    <div class="relative w-20 h-20 flex items-center justify-center">
                        <svg class="w-full h-full" viewBox="0 0 100 100">
                            <circle class="text-slate-100 dark:text-slate-700 stroke-current" cx="50" cy="50"
                                fill="transparent" r="40" stroke-width="8"></circle>
                            <circle class="text-amber-500 progress-ring-circle stroke-current" cx="50" cy="50"
                                fill="transparent" r="40" stroke-dasharray="251.2" stroke-dashoffset="95"
                                stroke-linecap="round" stroke-width="8"></circle>
                        </svg>
                        <i class="material-icons-round text-amber-500 absolute text-xl">chair</i>
                    </div>
                </div>
            </div>
            <div
                class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50 relative overflow-hidden group hover:shadow-soft transition-all">
                <div class="absolute right-0 top-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                    <i class="material-icons-round text-6xl text-purple-600">payments</i>
                </div>
                <div class="flex justify-between items-start mb-3">
                    <div class="p-2.5 bg-purple-50 dark:bg-purple-900/20 rounded-xl text-purple-600 dark:text-purple-400">
                        <i class="material-icons-round text-xl">monetization_on</i>
                    </div>
                    <span
                        class="flex items-center text-[10px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-1 rounded-md">
                        +2.5M
                    </span>
                </div>
                <div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide">
                        Total PPDB Revenue</p>
                    <h4 class="text-2xl font-display font-bold text-slate-800 dark:text-white mt-1">Rp 85.2jt</h4>
                </div>
                <div class="grid grid-cols-2 gap-2 mt-4">
                    <div class="bg-slate-50 dark:bg-slate-800 p-2 rounded-lg">
                        <p class="text-[9px] text-slate-400 uppercase">Forms</p>
                        <p class="text-xs font-bold text-slate-700 dark:text-slate-200">15.2jt</p>
                    </div>
                    <div class="bg-slate-50 dark:bg-slate-800 p-2 rounded-lg">
                        <p class="text-[9px] text-slate-400 uppercase">Re-Reg</p>
                        <p class="text-xs font-bold text-slate-700 dark:text-slate-200">70.0jt</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div
                    class="bg-white dark:bg-surface-dark rounded-3xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Daily
                                Registration Trend</h3>
                            <p class="text-[11px] text-slate-400">Applicant inflow over the last 7 days</p>
                        </div>
                        <select
                            class="text-xs bg-slate-50 dark:bg-background-dark border-0 rounded-lg py-1.5 pl-3 pr-8 text-slate-600 dark:text-slate-300 focus:ring-1 focus:ring-primary shadow-sm font-medium">
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                        </select>
                    </div>
                    <div class="relative h-64 w-full">
                        <svg class="w-full h-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 100 50">
                            <defs>
                                <linearGradient id="trendGradient" x1="0" x2="0" y1="0"
                                    y2="1">
                                    <stop offset="0%" stop-color="#3b82f6" stop-opacity="0.2"></stop>
                                    <stop offset="100%" stop-color="#3b82f6" stop-opacity="0"></stop>
                                </linearGradient>
                            </defs>
                            <line stroke="#e2e8f0" stroke-width="0.2" x1="0" x2="100" y1="10"
                                y2="10"></line>
                            <line stroke="#e2e8f0" stroke-width="0.2" x1="0" x2="100" y1="20"
                                y2="20"></line>
                            <line stroke="#e2e8f0" stroke-width="0.2" x1="0" x2="100" y1="30"
                                y2="30"></line>
                            <line stroke="#e2e8f0" stroke-width="0.2" x1="0" x2="100" y1="40"
                                y2="40"></line>
                            <path d="M0,45 L16.6,35 L33.3,40 L50,20 L66.6,25 L83.3,15 L100,5 V50 H0 Z"
                                fill="url(#trendGradient)"></path>
                            <path class="chart-line" d="M0,45 L16.6,35 L33.3,40 L50,20 L66.6,25 L83.3,15 L100,5"
                                fill="none" stroke="#3b82f6" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"></path>
                            <circle cx="16.6" cy="35" fill="white" r="1.5" stroke="#3b82f6"
                                stroke-width="1.5"></circle>
                            <circle cx="33.3" cy="40" fill="white" r="1.5" stroke="#3b82f6"
                                stroke-width="1.5"></circle>
                            <circle cx="50" cy="20" fill="white" r="1.5" stroke="#3b82f6"
                                stroke-width="1.5"></circle>
                            <circle cx="66.6" cy="25" fill="white" r="1.5" stroke="#3b82f6"
                                stroke-width="1.5"></circle>
                            <circle cx="83.3" cy="15" fill="white" r="1.5" stroke="#3b82f6"
                                stroke-width="1.5"></circle>
                            <circle cx="100" cy="5" fill="white" r="1.5" stroke="#3b82f6"
                                stroke-width="1.5"></circle>
                        </svg>
                        <div class="flex justify-between text-[10px] text-slate-400 mt-2 font-medium px-1">
                            <span>Mon</span>
                            <span>Tue</span>
                            <span>Wed</span>
                            <span>Thu</span>
                            <span>Fri</span>
                            <span>Sat</span>
                            <span>Sun</span>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark rounded-3xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Applicant
                                Origin</h3>
                            <p class="text-[11px] text-slate-400">Kindergarten (TK/RA) Distribution</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="group">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-700 dark:text-slate-300">RA Nurul Huda
                                    (Internal)</span>
                                <span class="font-bold text-slate-900 dark:text-white">45% (154)</span>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-emerald-500 h-2.5 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                        <div class="group">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-700 dark:text-slate-300">TK Aisyiyah 12</span>
                                <span class="font-bold text-slate-900 dark:text-white">20% (68)</span>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-blue-500 h-2.5 rounded-full" style="width: 20%"></div>
                            </div>
                        </div>
                        <div class="group">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-700 dark:text-slate-300">RA Al-Ikhlas</span>
                                <span class="font-bold text-slate-900 dark:text-white">15% (51)</span>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-purple-500 h-2.5 rounded-full" style="width: 15%"></div>
                            </div>
                        </div>
                        <div class="group">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-700 dark:text-slate-300">TK Pertiwi</span>
                                <span class="font-bold text-slate-900 dark:text-white">10% (34)</span>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-orange-500 h-2.5 rounded-full" style="width: 10%"></div>
                            </div>
                        </div>
                        <div class="group">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-700 dark:text-slate-300">Others</span>
                                <span class="font-bold text-slate-900 dark:text-white">10% (35)</span>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-slate-400 h-2.5 rounded-full" style="width: 10%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-6">
                <div
                    class="bg-white dark:bg-surface-dark rounded-3xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-display font-bold text-slate-800 dark:text-white text-base">Selection
                            Status</h3>
                        <button class="text-[10px] text-emerald-600 font-bold uppercase hover:underline">View
                            All</button>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div
                            class="p-4 rounded-xl border border-green-100 bg-green-50/50 dark:bg-green-900/10 dark:border-green-900/30 flex flex-col items-center justify-center text-center">
                            <span class="text-2xl font-bold text-green-600 dark:text-green-400">232</span>
                            <span class="text-[10px] font-bold uppercase text-green-600/70 tracking-wide mt-1">Lulus</span>
                        </div>
                        <div
                            class="p-4 rounded-xl border border-yellow-100 bg-yellow-50/50 dark:bg-yellow-900/10 dark:border-yellow-900/30 flex flex-col items-center justify-center text-center">
                            <span class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">45</span>
                            <span
                                class="text-[10px] font-bold uppercase text-yellow-600/70 tracking-wide mt-1">Pending</span>
                        </div>
                        <div
                            class="p-4 rounded-xl border border-blue-100 bg-blue-50/50 dark:bg-blue-900/10 dark:border-blue-900/30 flex flex-col items-center justify-center text-center">
                            <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">18</span>
                            <span
                                class="text-[10px] font-bold uppercase text-blue-600/70 tracking-wide mt-1">Cadangan</span>
                        </div>
                        <div
                            class="p-4 rounded-xl border border-red-100 bg-red-50/50 dark:bg-red-900/10 dark:border-red-900/30 flex flex-col items-center justify-center text-center">
                            <span class="text-2xl font-bold text-red-600 dark:text-red-400">47</span>
                            <span class="text-[10px] font-bold uppercase text-red-600/70 tracking-wide mt-1">Tidak
                                Lulus</span>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark rounded-3xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
                    <h3 class="font-display font-bold text-slate-800 dark:text-white text-base mb-4">Quota per
                        Class</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="text-[10px] uppercase text-slate-400 border-b border-slate-100 dark:border-slate-700/50">
                                    <th class="pb-2 font-medium">Class</th>
                                    <th class="pb-2 font-medium text-center">Capacity</th>
                                    <th class="pb-2 font-medium text-right">Filled</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs">
                                <tr class="border-b border-slate-50 dark:border-slate-800/50 group">
                                    <td class="py-3 font-semibold text-slate-700 dark:text-slate-200">Class 1A</td>
                                    <td class="py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <div
                                                class="w-16 h-1.5 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                                <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 100%"></div>
                                            </div>
                                            <span class="text-[10px] text-slate-400">30/30</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-right text-emerald-600 font-bold">Full</td>
                                </tr>
                                <tr class="border-b border-slate-50 dark:border-slate-800/50 group">
                                    <td class="py-3 font-semibold text-slate-700 dark:text-slate-200">Class 1B</td>
                                    <td class="py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <div
                                                class="w-16 h-1.5 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                                <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 85%">
                                                </div>
                                            </div>
                                            <span class="text-[10px] text-slate-400">25/30</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-right text-slate-600 dark:text-slate-300">25</td>
                                </tr>
                                <tr class="border-b border-slate-50 dark:border-slate-800/50 group">
                                    <td class="py-3 font-semibold text-slate-700 dark:text-slate-200">Class 1C</td>
                                    <td class="py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <div
                                                class="w-16 h-1.5 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                                <div class="bg-amber-500 h-1.5 rounded-full" style="width: 60%">
                                                </div>
                                            </div>
                                            <span class="text-[10px] text-slate-400">18/30</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-right text-slate-600 dark:text-slate-300">18</td>
                                </tr>
                                <tr class="group">
                                    <td class="py-3 font-semibold text-slate-700 dark:text-slate-200">Class 1D</td>
                                    <td class="py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <div
                                                class="w-16 h-1.5 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                                <div class="bg-red-400 h-1.5 rounded-full" style="width: 10%">
                                                </div>
                                            </div>
                                            <span class="text-[10px] text-slate-400">3/30</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-right text-slate-600 dark:text-slate-300">3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-indigo-900 to-indigo-800 text-white rounded-3xl shadow-lg p-6 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-10 -mt-10 blur-2xl pointer-events-none">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm border border-white/10">
                                <i class="material-icons-round text-yellow-300">receipt_long</i>
                            </div>
                            <div>
                                <h3 class="font-display font-bold text-base">Payment Tracking</h3>
                                <p class="text-[10px] text-indigo-200">Registration Fee Status</p>
                            </div>
                        </div>
                        <div class="flex items-end justify-between mb-2">
                            <span class="text-3xl font-display font-bold">18 <span
                                    class="text-sm font-normal text-indigo-200">Unpaid</span></span>
                            <span class="text-xs bg-indigo-500/50 px-2 py-1 rounded border border-indigo-400/30">Total:
                                Rp 3.6jt</span>
                        </div>
                        <div class="w-full bg-black/20 h-2 rounded-full mb-4 overflow-hidden">
                            <div class="bg-yellow-400 h-2 rounded-full" style="width: 92%"></div>
                        </div>
                        <div class="space-y-2">
                            <div
                                class="flex items-center justify-between text-xs p-2 bg-white/5 rounded border border-white/5 hover:bg-white/10 transition-colors cursor-pointer">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-6 h-6 rounded-full bg-indigo-500 flex items-center justify-center text-[10px] font-bold">
                                        MA</div>
                                    <span>M. Ali</span>
                                </div>
                                <span class="text-yellow-300 text-[10px] font-bold">Unpaid</span>
                            </div>
                            <div
                                class="flex items-center justify-between text-xs p-2 bg-white/5 rounded border border-white/5 hover:bg-white/10 transition-colors cursor-pointer">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-6 h-6 rounded-full bg-pink-500 flex items-center justify-center text-[10px] font-bold">
                                        SF</div>
                                    <span>Siti F.</span>
                                </div>
                                <span class="text-yellow-300 text-[10px] font-bold">Unpaid</span>
                            </div>
                        </div>
                        <button
                            class="w-full mt-4 py-2 bg-white text-indigo-900 text-xs font-bold rounded-lg hover:bg-indigo-50 transition-colors shadow-lg">Send
                            Reminders</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
