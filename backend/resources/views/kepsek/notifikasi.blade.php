@extends('layouts.kepsek')
@section('content')
    <main class="flex-1 p-5 space-y-6 w-full max-w-[1600px] mx-auto z-10">
        <section class="relative">
            <div class="flex justify-between items-end mb-4 px-1">
                <h2 class="text-lg font-display font-bold text-slate-800 dark:text-white tracking-tight">Overview</h2>
                <a class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 flex items-center gap-0.5"
                    href="#">
                    View All <i class="material-icons-round text-sm">arrow_forward</i>
                </a>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div
                    class="glass-card p-5 rounded-2xl shadow-premium hover:shadow-lg transition-shadow duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class="material-icons-round text-6xl text-emerald-600">mark_chat_unread</i>
                    </div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div
                            class="w-12 h-12 rounded-xl bg-emerald-gradient shadow-lg shadow-emerald-500/30 flex items-center justify-center text-white mb-4">
                            <i class="material-icons-round text-2xl">mark_chat_unread</i>
                        </div>
                        <div>
                            <h4 class="text-3xl font-display font-bold text-slate-800 dark:text-white mb-1">8</h4>
                            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                Unread</p>
                        </div>
                    </div>
                </div>
                <div
                    class="glass-card p-5 rounded-2xl shadow-premium hover:shadow-lg transition-shadow duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class="material-icons-round text-6xl text-amber-500">pending_actions</i>
                    </div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 shadow-lg shadow-amber-500/30 flex items-center justify-center text-white mb-4">
                            <i class="material-icons-round text-2xl">pending_actions</i>
                        </div>
                        <div>
                            <h4 class="text-3xl font-display font-bold text-slate-800 dark:text-white mb-1">3</h4>
                            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                Approvals</p>
                        </div>
                    </div>
                </div>
                <div
                    class="glass-card p-5 rounded-2xl shadow-premium hover:shadow-lg transition-shadow duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class="material-icons-round text-6xl text-red-500">gpp_maybe</i>
                    </div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-400 to-red-600 shadow-lg shadow-red-500/30 flex items-center justify-center text-white mb-4">
                            <i class="material-icons-round text-2xl">gpp_maybe</i>
                        </div>
                        <div>
                            <h4 class="text-3xl font-display font-bold text-slate-800 dark:text-white mb-1">2</h4>
                            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                System Alerts</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="flex items-center gap-2 overflow-x-auto hide-scroll pb-2">
            <button
                class="px-4 py-2 rounded-full bg-emerald-600 text-white text-xs font-bold shadow-lg shadow-emerald-500/20 whitespace-nowrap transition-transform hover:scale-105">
                All Updates
            </button>
            <button
                class="px-4 py-2 rounded-full bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-xs font-bold whitespace-nowrap hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                Approvals
            </button>
            <button
                class="px-4 py-2 rounded-full bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-xs font-bold whitespace-nowrap hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                System
            </button>
            <button
                class="px-4 py-2 rounded-full bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-xs font-bold whitespace-nowrap hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                PPDB
            </button>
            <button
                class="px-4 py-2 rounded-full bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-xs font-bold whitespace-nowrap hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                Finance
            </button>
        </div>
        <section class="space-y-6 pt-2">
            <div class="flex justify-between items-center px-1">
                <h3 class="text-sm font-display font-bold text-slate-700 dark:text-slate-200">Recent Activity</h3>
                <button
                    class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 px-2 py-1 rounded-md transition-colors">Mark
                    all as read</button>
            </div>
            <div class="relative space-y-6">
                <div
                    class="absolute left-[26px] top-6 bottom-6 w-0.5 bg-gradient-to-b from-emerald-200 via-slate-200 to-transparent dark:from-emerald-800 dark:via-slate-700 z-0">
                </div>
                <div class="relative pl-14 group">
                    <div
                        class="absolute left-3 top-0 w-10 h-10 rounded-full bg-gradient-to-br from-red-500 to-rose-600 flex items-center justify-center text-white shadow-lg shadow-red-500/30 z-10 ring-4 ring-white dark:ring-background-dark">
                        <i class="material-icons-round text-xl">priority_high</i>
                    </div>
                    <div
                        class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-soft hover:shadow-premium transition-shadow duration-300 border-l-4 border-l-red-500 border-y border-r border-slate-100 dark:border-slate-700/50">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex flex-col">
                                <span
                                    class="text-[10px] font-bold text-red-500 uppercase tracking-wider mb-1 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Critical
                                    Activity
                                </span>
                                <h4 class="text-base font-display font-bold text-slate-800 dark:text-white leading-tight">
                                    New PPDB Milestone Reached</h4>
                            </div>
                            <span
                                class="text-[10px] text-slate-400 font-medium bg-slate-50 dark:bg-slate-800 px-2 py-1 rounded-lg">10m
                                ago</span>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-4 font-body">Target of 125
                            applicants for the 2024 academic year has been exceeded. Currently at <span
                                class="font-bold text-slate-800 dark:text-slate-200">128</span>.</p>
                        <div
                            class="flex items-center justify-end gap-3 pt-2 border-t border-slate-50 dark:border-slate-800/50">
                            <button
                                class="px-3 py-1.5 text-xs font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">Dismiss</button>
                            <button
                                class="px-4 py-1.5 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg shadow-sm transition-colors">View
                                Report</button>
                        </div>
                    </div>
                </div>
                <div class="relative pl-14 group">
                    <div
                        class="absolute left-3 top-0 w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white shadow-lg shadow-amber-500/30 z-10 ring-4 ring-white dark:ring-background-dark">
                        <i class="material-icons-round text-xl">hourglass_empty</i>
                    </div>
                    <div
                        class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-soft hover:shadow-premium transition-shadow duration-300 border border-slate-100 dark:border-slate-700/50 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/5 rounded-bl-full pointer-events-none">
                        </div>
                        <div class="flex justify-between items-start mb-2 relative z-10">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold text-amber-600 uppercase tracking-wider mb-1">Approval
                                    Pending</span>
                                <h4 class="text-base font-display font-bold text-slate-800 dark:text-white leading-tight">
                                    RAB for Library Books Waiting</h4>
                            </div>
                            <span
                                class="text-[10px] text-slate-400 font-medium bg-slate-50 dark:bg-slate-800 px-2 py-1 rounded-lg">2h
                                ago</span>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-4 font-body relative z-10">
                            Finance department has submitted a new budget proposal (RAB) for the Annual Library Book Update
                            (<span class="font-mono text-emerald-600 dark:text-emerald-400 font-bold">IDR 5.2M</span>).</p>
                        <div
                            class="flex items-center justify-between pt-2 border-t border-slate-50 dark:border-slate-800/50 relative z-10">
                            <div class="flex -space-x-2">
                                <div
                                    class="w-6 h-6 rounded-full bg-slate-200 border-2 border-white dark:border-slate-800 text-[10px] flex items-center justify-center font-bold text-slate-500">
                                    FM</div>
                                <div
                                    class="w-6 h-6 rounded-full bg-slate-200 border-2 border-white dark:border-slate-800 text-[10px] flex items-center justify-center font-bold text-slate-500">
                                    LB</div>
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="px-4 py-1.5 text-xs font-bold text-amber-600 bg-amber-50 hover:bg-amber-100 dark:bg-amber-900/20 dark:hover:bg-amber-900/30 dark:text-amber-400 rounded-lg transition-colors border border-amber-200/50 dark:border-amber-800/30">Review</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative pl-14 group">
                    <div
                        class="absolute left-3 top-0 w-10 h-10 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/30 z-10 ring-4 ring-white dark:ring-background-dark">
                        <i class="material-icons-round text-xl">cloud_done</i>
                    </div>
                    <div
                        class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-soft hover:shadow-premium transition-shadow duration-300 border border-slate-100 dark:border-slate-700/50">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider mb-1">System
                                    Reminder</span>
                                <h4 class="text-base font-display font-bold text-slate-800 dark:text-white leading-tight">
                                    System Backup Completed</h4>
                            </div>
                            <span
                                class="text-[10px] text-slate-400 font-medium bg-slate-50 dark:bg-slate-800 px-2 py-1 rounded-lg">Yesterday</span>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-3 font-body">The weekly
                            automated backup for Student Records and Financial Logs was successfully stored in <span
                                class="font-semibold text-slate-700 dark:text-slate-300">Secure Server 2</span>.</p>
                        <div class="flex items-center justify-end pt-2">
                            <button
                                class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                                <i class="material-icons-round text-sm">check_circle</i> Acknowledge
                            </button>
                        </div>
                    </div>
                </div>
                <div class="relative pl-14 group">
                    <div
                        class="absolute left-3 top-0 w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/30 z-10 ring-4 ring-white dark:ring-background-dark grayscale opacity-70">
                        <i class="material-icons-round text-xl">person_add</i>
                    </div>
                    <div
                        class="bg-white/60 dark:bg-surface-dark/60 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/50 opacity-75 hover:opacity-100 transition-opacity">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold text-blue-600 uppercase tracking-wider mb-1">HR
                                    Update</span>
                                <h4
                                    class="text-base font-display font-bold text-slate-700 dark:text-slate-200 leading-tight">
                                    New Teacher Onboarded</h4>
                            </div>
                            <span class="text-[10px] text-slate-400 font-medium">2 days ago</span>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-body">Data for Ust.
                            Hamdan (Islamic Studies) has been added to the HR system and assigned to Class 4B.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-8 pb-10">
            <button
                class="w-full py-4 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-2xl text-slate-500 dark:text-slate-400 text-sm font-bold hover:bg-slate-50 dark:hover:bg-slate-800 transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                <i class="material-icons-round text-lg">history</i>
                Load Older Notifications
            </button>
        </section>
    </main>
@endsection
