@extends('layouts.kepsek')
@section('content')
    <main class="flex-1 p-4 md:p-6 space-y-6 w-full max-w-[1600px] mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl font-display font-bold text-slate-900 dark:text-white leading-tight">System
                    Activity Logs</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 max-w-xl">Comprehensive audit trail of
                    system modifications, access controls, and data integrity checks.</p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="flex items-center gap-2 px-4 py-2.5 bg-white/80 dark:bg-surface-dark/80 backdrop-blur-sm border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all shadow-sm group">
                    <span
                        class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-200 dark:group-hover:bg-emerald-800 transition-colors">
                        <i class="material-icons-round text-sm">download</i>
                    </span>
                    CSV
                </button>
                <button
                    class="flex items-center gap-2 px-4 py-2.5 bg-emerald-gradient text-white border border-emerald-500/20 rounded-xl text-sm font-semibold transition-all shadow-glow hover:shadow-lg hover:translate-y-[-1px]">
                    <i class="material-icons-round text-lg">picture_as_pdf</i>
                    Export Report
                </button>
            </div>
        </div>
        <div class="flex overflow-x-auto hide-scroll pb-2 -mx-4 px-4 md:mx-0 md:px-0">
            <div class="flex items-center gap-3 min-w-max">
                <div
                    class="flex items-center bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-xl p-1 shadow-sm">
                    <button
                        class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300">All
                        Time</button>
                    <button
                        class="px-3 py-1.5 rounded-lg text-xs font-medium text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800">This
                        Week</button>
                    <button
                        class="px-3 py-1.5 rounded-lg text-xs font-medium text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800">This
                        Month</button>
                </div>
                <div class="h-6 w-[1px] bg-slate-200 dark:bg-slate-700"></div>
                <button
                    class="flex items-center gap-2 px-3 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-600 dark:text-slate-300 shadow-sm hover:border-emerald-500 transition-colors">
                    <i class="material-icons-round text-base text-slate-400">filter_list</i>
                    Filter by User
                    <i class="material-icons-round text-base text-slate-400">expand_more</i>
                </button>
                <button
                    class="flex items-center gap-2 px-3 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-600 dark:text-slate-300 shadow-sm hover:border-emerald-500 transition-colors">
                    <i class="material-icons-round text-base text-slate-400">category</i>
                    Activity Type
                    <i class="material-icons-round text-base text-slate-400">expand_more</i>
                </button>
                <button
                    class="flex items-center gap-2 px-3 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-600 dark:text-slate-300 shadow-sm hover:border-emerald-500 transition-colors">
                    <i class="material-icons-round text-base text-slate-400">vpn_key</i>
                    Severity Level
                    <i class="material-icons-round text-base text-slate-400">expand_more</i>
                </button>
                <div class="ml-auto">
                    <div class="relative group">
                        <i
                            class="material-icons-round absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg group-focus-within:text-emerald-500 transition-colors">search</i>
                        <input
                            class="pl-9 pr-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-xl text-xs focus:ring-emerald-500 focus:border-emerald-500 w-48 transition-all shadow-sm"
                            placeholder="Search logs..." type="text" />
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4 pb-24">
            <div
                class="group bg-white dark:bg-surface-dark rounded-2xl p-5 shadow-card border border-slate-100 dark:border-slate-700/50 hover:shadow-soft hover:border-emerald-200 dark:hover:border-emerald-800 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-emerald-500"></div>
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div
                                class="w-10 h-10 rounded-full overflow-hidden ring-2 ring-emerald-50 dark:ring-emerald-900/20">
                                <img class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDY7vamtqBK039NU-0nqRTIMnKS1DXXfPIgZoQWlUY9zjMpfq2cbTS7EK4_nCohiGjYdvjfUEKMLy6GRZHl7xQzJg7CG1TBYnfF_diFPXYMSgGZhTYOy274B_iiAjAVbxS1rCKOJDpGgHNNP8J9vFNqpZlogRkgvr-JyV98IgrI5LlncsQLcKW1XpWtfbJJeX021QhAzRhP2LlrpTkL_lSGhuPUFJMRQtor458xuRCydx9-U3zycCs1MS-gkniXyxYBrNBA_0XcKqs" />
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 bg-emerald-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-md border border-white dark:border-surface-dark">
                                ADM</div>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold font-display text-slate-800 dark:text-white">Ust. Abdullah
                            </h3>
                            <p class="text-[10px] text-slate-500 dark:text-slate-400">Principal</p>
                        </div>
                    </div>
                    <span
                        class="px-2.5 py-1 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 text-[10px] uppercase tracking-wider font-bold rounded-lg border border-emerald-100 dark:border-emerald-900/30">
                        Info
                    </span>
                </div>
                <div
                    class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-3 mb-4 border border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                        <p class="text-xs font-semibold text-slate-700 dark:text-slate-300">Grade Modification</p>
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mb-2">Updated final grade for <span
                            class="font-medium text-slate-700 dark:text-slate-300">Ahmad Fauzi (4B)</span></p>
                    <div
                        class="flex items-center gap-3 bg-white dark:bg-slate-800 rounded-lg p-2 border border-slate-100 dark:border-slate-700 shadow-sm">
                        <div class="text-center min-w-[3rem]">
                            <p class="text-[9px] text-slate-400 uppercase font-bold">From</p>
                            <p class="text-sm font-mono text-red-500 line-through decoration-red-500/50">78</p>
                        </div>
                        <i class="material-icons-round text-slate-300 text-sm">arrow_forward</i>
                        <div class="text-center min-w-[3rem]">
                            <p class="text-[9px] text-slate-400 uppercase font-bold">To</p>
                            <p class="text-sm font-mono text-emerald-600 font-bold">85</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-2 border-t border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-1.5 text-slate-400">
                        <i class="material-icons-round text-[14px]">schedule</i>
                        <span class="text-[10px] font-medium">10:45 AM, Today</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-slate-400">
                        <i class="material-icons-round text-[14px]">dns</i>
                        <span
                            class="text-[10px] font-mono bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-slate-500 dark:text-slate-400">192.168.1.104</span>
                    </div>
                </div>
            </div>
            <div
                class="group bg-white dark:bg-surface-dark rounded-2xl p-5 shadow-card border border-slate-100 dark:border-slate-700/50 hover:shadow-soft hover:border-amber-200 dark:hover:border-amber-800 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-amber-500"></div>
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div
                                class="w-10 h-10 rounded-full overflow-hidden ring-2 ring-emerald-50 dark:ring-emerald-900/20">
                                <img class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBXOSdyRUhz22PIvNTQDG58hYXNBuBzijHN8XJpMjeT2rpzBEK33EkaW5Awag2Z6j81oVu_kG7TgIaBtcwN2-dshsyALgmMP6Md7zQaPfe43i743Yk7aNnZCKQNMRHUzgauhv2082FdwsBnZFcB4bfyuQ4xaD2QGrvWoSFLH_bBktc0MMM3ktWOagOsT3CfLtqz0r5VStiJQLc8RRIcQ9kOwAQahSeSeMiaMnX6lKN6wufAHQa7sQ6PpAkTZ5xT1p7EZ0eQH-q-aCY" />
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 bg-amber-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-md border border-white dark:border-surface-dark">
                                STF</div>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold font-display text-slate-800 dark:text-white">Siti Aminah
                            </h3>
                            <p class="text-[10px] text-slate-500 dark:text-slate-400">Finance Staff</p>
                        </div>
                    </div>
                    <span
                        class="px-2.5 py-1 bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 text-[10px] uppercase tracking-wider font-bold rounded-lg border border-amber-100 dark:border-amber-900/30">
                        Warning
                    </span>
                </div>
                <div
                    class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-3 mb-4 border border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        <p class="text-xs font-semibold text-slate-700 dark:text-slate-300">Late Enrollment</p>
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mb-2">Added new student record
                        manually outside PPDB period.</p>
                    <div
                        class="flex items-center gap-3 bg-white dark:bg-slate-800 rounded-lg p-2 border border-slate-100 dark:border-slate-700 shadow-sm">
                        <div class="flex-1">
                            <p class="text-[9px] text-slate-400 uppercase font-bold">Action</p>
                            <p class="text-xs font-medium text-slate-700 dark:text-slate-300">Create Profile: Yusuf
                                Mansur</p>
                        </div>
                        <div
                            class="px-2 py-1 bg-amber-50 dark:bg-amber-900/30 rounded text-[10px] font-mono text-amber-700 dark:text-amber-400">
                            #PPDB-MANUAL
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-2 border-t border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-1.5 text-slate-400">
                        <i class="material-icons-round text-[14px]">schedule</i>
                        <span class="text-[10px] font-medium">09:12 AM, Today</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-slate-400">
                        <i class="material-icons-round text-[14px]">dns</i>
                        <span
                            class="text-[10px] font-mono bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-slate-500 dark:text-slate-400">192.168.1.121</span>
                    </div>
                </div>
            </div>
            <div
                class="group bg-white dark:bg-surface-dark rounded-2xl p-5 shadow-card border border-slate-100 dark:border-slate-700/50 hover:shadow-soft hover:border-purple-200 dark:hover:border-purple-800 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-purple-500"></div>
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div
                                class="w-10 h-10 rounded-full overflow-hidden ring-2 ring-emerald-50 dark:ring-emerald-900/20">
                                <img class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCcgxtJjzir8dQcU1GxbbhfjuCZKpTdEBPCls5Re3TF-CxXHJ8F4sPxtwmlJDlr_IhMCVR1Huq_kZD-muQvq90FBdopjGzEkf155vOHzn9JTcwIH3llB9Y2YuFkqcYaDLdNFmH3m7dI6-qxljCepTkTjeQaYIL6-jm3T2p0JXdVaiW6RGJBzZ5qUCcMU5XLjkBiL-xvZoGqwggoci4v7ulyN4zMMGaxVIjkmqRRGoJwwi8aL-bkLZZaRDbZOAjE2picNvuY53n2gIw" />
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 bg-purple-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-md border border-white dark:border-surface-dark">
                                SYS</div>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold font-display text-slate-800 dark:text-white">System Admin
                            </h3>
                            <p class="text-[10px] text-slate-500 dark:text-slate-400">IT Support</p>
                        </div>
                    </div>
                    <span
                        class="px-2.5 py-1 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 text-[10px] uppercase tracking-wider font-bold rounded-lg border border-emerald-100 dark:border-emerald-900/30">
                        Info
                    </span>
                </div>
                <div
                    class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-3 mb-4 border border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                        <p class="text-xs font-semibold text-slate-700 dark:text-slate-300">Config Change</p>
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mb-2">Extended <span
                            class="font-medium text-slate-700 dark:text-slate-300">PPDB Closing Date</span></p>
                    <div
                        class="flex items-center gap-3 bg-white dark:bg-slate-800 rounded-lg p-2 border border-slate-100 dark:border-slate-700 shadow-sm">
                        <div class="text-center min-w-[3rem]">
                            <p class="text-[9px] text-slate-400 uppercase font-bold">Old</p>
                            <p class="text-xs font-mono text-slate-500 line-through">2023-12-31</p>
                        </div>
                        <i class="material-icons-round text-slate-300 text-sm">arrow_forward</i>
                        <div class="text-center min-w-[3rem]">
                            <p class="text-[9px] text-slate-400 uppercase font-bold">New</p>
                            <p class="text-xs font-mono text-emerald-600 font-bold">2024-01-15</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-2 border-t border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-1.5 text-slate-400">
                        <i class="material-icons-round text-[14px]">schedule</i>
                        <span class="text-[10px] font-medium">04:30 PM, Yesterday</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-slate-400">
                        <i class="material-icons-round text-[14px]">dns</i>
                        <span
                            class="text-[10px] font-mono bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-slate-500 dark:text-slate-400">202.10.22.45</span>
                    </div>
                </div>
            </div>
            <div
                class="group bg-white dark:bg-surface-dark rounded-2xl p-5 shadow-card border border-slate-100 dark:border-slate-700/50 hover:shadow-soft hover:border-red-200 dark:hover:border-red-800 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-red-500"></div>
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div
                                class="w-10 h-10 rounded-full overflow-hidden ring-2 ring-emerald-50 dark:ring-emerald-900/20">
                                <img class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDY7vamtqBK039NU-0nqRTIMnKS1DXXfPIgZoQWlUY9zjMpfq2cbTS7EK4_nCohiGjYdvjfUEKMLy6GRZHl7xQzJg7CG1TBYnfF_diFPXYMSgGZhTYOy274B_iiAjAVbxS1rCKOJDpGgHNNP8J9vFNqpZlogRkgvr-JyV98IgrI5LlncsQLcKW1XpWtfbJJeX021QhAzRhP2LlrpTkL_lSGhuPUFJMRQtor458xuRCydx9-U3zycCs1MS-gkniXyxYBrNBA_0XcKqs" />
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 bg-red-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-md border border-white dark:border-surface-dark">
                                HOD</div>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold font-display text-slate-800 dark:text-white">Budi Santoso
                            </h3>
                            <p class="text-[10px] text-slate-500 dark:text-slate-400">Academic Head</p>
                        </div>
                    </div>
                    <span
                        class="px-2.5 py-1 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 text-[10px] uppercase tracking-wider font-bold rounded-lg border border-red-100 dark:border-red-900/30">
                        Critical
                    </span>
                </div>
                <div
                    class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-3 mb-4 border border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                        <p class="text-xs font-semibold text-slate-700 dark:text-slate-300">Delete Record</p>
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mb-2">Permanently removed duplicate
                        attendance record.</p>
                    <div
                        class="flex items-center gap-3 bg-white dark:bg-slate-800 rounded-lg p-2 border border-slate-100 dark:border-slate-700 shadow-sm">
                        <div class="flex-1">
                            <p class="text-[9px] text-slate-400 uppercase font-bold">Target</p>
                            <p class="text-xs font-medium text-slate-700 dark:text-slate-300">Attendance Log
                                #ATT-88219</p>
                        </div>
                        <div
                            class="px-2 py-1 bg-red-50 dark:bg-red-900/30 rounded text-[10px] font-mono text-red-700 dark:text-red-400 font-bold">
                            DELETED
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-2 border-t border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-1.5 text-slate-400">
                        <i class="material-icons-round text-[14px]">schedule</i>
                        <span class="text-[10px] font-medium">11:20 AM, 14 Oct</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-slate-400">
                        <i class="material-icons-round text-[14px]">dns</i>
                        <span
                            class="text-[10px] font-mono bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-slate-500 dark:text-slate-400">114.122.34.8</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="fixed bottom-0 md:bottom-4 left-0 md:left-72 right-0 md:px-6 z-40 pointer-events-none floating-footer">
        <div
            class="bg-emerald-900/95 dark:bg-surface-dark/95 text-white backdrop-blur-xl md:rounded-2xl p-4 md:p-5 shadow-2xl border-t md:border border-emerald-500/30 pointer-events-auto max-w-[1600px] mx-auto relative overflow-hidden group">
            <div
                class="absolute -right-20 -bottom-20 w-64 h-64 bg-emerald-500/20 rounded-full blur-[80px] group-hover:bg-emerald-500/30 transition-all duration-700">
            </div>
            <div class="absolute -left-20 -top-20 w-64 h-64 bg-primary/10 rounded-full blur-[80px]"></div>
            <div class="flex flex-row items-center justify-between gap-4 relative z-10">
                <div class="flex items-center gap-4">
                    <div
                        class="p-3 bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-xl shadow-lg border border-emerald-500/30 shrink-0">
                        <i class="material-icons-round text-emerald-100 text-xl md:text-2xl">shield</i>
                    </div>
                    <div class="hidden sm:block">
                        <h3 class="font-display font-bold text-base md:text-lg text-white">Security Pulse</h3>
                        <div class="flex items-center gap-2">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <p class="text-xs text-emerald-200/90 font-medium">System Secure &amp; Monitoring
                                Active</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-6 md:gap-12 md:pr-4">
                    <div class="text-center group/stat">
                        <p
                            class="text-[10px] text-emerald-300/80 uppercase tracking-widest font-bold mb-0.5 group-hover/stat:text-emerald-200 transition-colors">
                            Failed</p>
                        <p
                            class="text-xl md:text-2xl font-display font-bold text-white tabular-nums group-hover/stat:scale-110 transition-transform origin-bottom">
                            0</p>
                    </div>
                    <div class="w-[1px] h-8 bg-emerald-700/50"></div>
                    <div class="text-center group/stat">
                        <p
                            class="text-[10px] text-emerald-300/80 uppercase tracking-widest font-bold mb-0.5 group-hover/stat:text-emerald-200 transition-colors">
                            Critical</p>
                        <p
                            class="text-xl md:text-2xl font-display font-bold text-white tabular-nums group-hover/stat:scale-110 transition-transform origin-bottom">
                            2</p>
                    </div>
                    <div class="w-[1px] h-8 bg-emerald-700/50"></div>
                    <div class="text-center group/stat">
                        <p
                            class="text-[10px] text-emerald-300/80 uppercase tracking-widest font-bold mb-0.5 group-hover/stat:text-emerald-200 transition-colors">
                            Health</p>
                        <p
                            class="text-xl md:text-2xl font-display font-bold text-emerald-400 tabular-nums shadow-emerald-500/50 drop-shadow-sm">
                            100%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


