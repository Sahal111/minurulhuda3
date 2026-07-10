@extends('layouts.kepsek')
@section('content')
   <main class="flex-1 w-full max-w-7xl mx-auto flex flex-col">
            <div class="p-4 sm:p-8 lg:p-10 space-y-8 flex-1">
                <section
                    class="mesh-gradient rounded-[3rem] p-10 shadow-2xl relative overflow-hidden flex flex-col lg:flex-row items-center gap-10 border border-white/20">
                    <div class="absolute inset-0 bg-emerald-950/10 backdrop-blur-[1px]"></div>
                    <div class="absolute -right-20 -top-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="relative z-10 group shrink-0">
                        <div
                            class="w-48 h-48 rounded-[3rem] border-8 border-white/20 shadow-4xl overflow-hidden transform group-hover:scale-[1.02] transition-all duration-700">
                            <img alt="Profile" class="w-full h-full object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDY7vamtqBK039NU-0nqRTIMnKS1DXXfPIgZoQWlUY9zjMpfq2cbTS7EK4_nCohiGjYdvjfUEKMLy6GRZHl7xQzJg7CG1TBYnfF_diFPXYMSgGZhTYOy274B_iiAjAVbxS1rCKOJDpGgHNNP8J9vFNqpZlogRkgvr-JyV98IgrI5LlncsQLcKW1XpWtfbJJeX021QhAzRhP2LlrpTkL_lSGhuPUFJMRQtor458xuRCydx9-U3zycCs1MS-gkniXyxYBrNBA_0XcKqs" />
                        </div>
                        <button
                            class="absolute -bottom-2 -right-2 bg-white text-emerald-900 p-4 rounded-3xl shadow-2xl hover:bg-emerald-50 transition-colors">
                            <i class="material-icons-round text-2xl">photo_camera</i>
                        </button>
                    </div>
                    <div class="relative z-10 flex-1 text-center lg:text-left">
                        <div class="flex flex-col gap-2 mb-6">
                            <h2 class="text-5xl font-display font-extrabold text-white tracking-tight">Ust. Abdullah
                            </h2>
                            <div class="flex flex-col lg:flex-row lg:items-center gap-3 mt-1">
                                <span class="text-emerald-100 text-2xl font-display font-medium">Kepala Sekolah
                                    (Principal)</span>
                                <span class="hidden lg:block w-1.5 h-1.5 rounded-full bg-emerald-400/50"></span>
                                <span class="text-emerald-200/60 text-sm font-display tracking-widest uppercase">ID:
                                    19820312 201001 1 008</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-8">
                            <div class="bg-white/10 backdrop-blur-md rounded-3xl p-4 border border-white/20">
                                <p class="text-[10px] font-bold text-emerald-200 uppercase tracking-tighter">Tenure</p>
                                <p class="text-xl font-bold text-white">6 Years</p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-md rounded-3xl p-4 border border-white/20">
                                <p class="text-[10px] font-bold text-emerald-200 uppercase tracking-tighter">Security
                                    Level</p>
                                <p class="text-xl font-bold text-white">Tier 1</p>
                            </div>
                            <div
                                class="col-span-2 sm:col-span-1 bg-emerald-400/20 backdrop-blur-md rounded-3xl p-4 border border-emerald-400/30">
                                <p class="text-[10px] font-bold text-emerald-50 uppercase tracking-tighter">Status</p>
                                <p class="text-xl font-bold text-white">Verified</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                            <button
                                class="bg-white text-emerald-900 px-8 py-4 rounded-2xl text-sm font-bold transition-all flex items-center gap-3 shadow-2xl hover:shadow-white/10 active:scale-95">
                                <i class="material-icons-round">edit</i>
                                Edit Administrative Profile
                            </button>
                            <button
                                class="bg-emerald-950/30 hover:bg-emerald-950/40 text-white backdrop-blur-md px-8 py-4 rounded-2xl text-sm font-bold transition-all flex items-center gap-3 border border-white/10">
                                <i class="material-icons-round">share</i>
                                Public Portfolio
                            </button>
                        </div>
                    </div>
                </section>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div
                        class="glass-card rounded-[2.5rem] p-8 flex flex-col justify-between group overflow-hidden relative">
                        <div
                            class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-500/5 rounded-full group-hover:scale-150 transition-transform duration-700">
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center gap-5">
                                    <div
                                        class="w-16 h-16 bg-emerald-500/10 rounded-3xl flex items-center justify-center text-emerald-600 shadow-inner">
                                        <i class="material-icons-round text-3xl">key</i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-display font-bold text-slate-800 dark:text-white">
                                            Credentials</h3>
                                        <p class="text-xs font-medium text-slate-500 mt-0.5">Last changed May 12, 2024
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4 mb-8">
                                <div
                                    class="flex justify-between items-center p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-white/5">
                                    <span class="text-xs font-semibold text-slate-500">Security Score</span>
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-24 h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                            <div class="w-[85%] h-full bg-emerald-500"></div>
                                        </div>
                                        <span class="text-xs font-bold text-emerald-600">85%</span>
                                    </div>
                                </div>
                                <div
                                    class="flex justify-between items-center p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-white/5">
                                    <span class="text-xs font-semibold text-slate-500">Compromise Check</span>
                                    <span
                                        class="text-[10px] font-bold text-emerald-600 bg-emerald-100 dark:bg-emerald-500/10 px-3 py-1 rounded-full uppercase">All
                                        Clear</span>
                                </div>
                            </div>
                        </div>
                        <button
                            class="w-full py-5 bg-slate-900 dark:bg-emerald-600 hover:bg-emerald-700 text-white rounded-[1.5rem] text-sm font-bold transition-all shadow-xl shadow-emerald-600/20 active:scale-[0.98]">
                            Update Security Key
                        </button>
                    </div>
                    <div class="glass-card rounded-[2.5rem] p-8 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center gap-5">
                                    <div
                                        class="w-16 h-16 bg-blue-500/10 rounded-3xl flex items-center justify-center text-blue-600 shadow-inner">
                                        <i class="material-icons-round text-3xl">vibration</i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-display font-bold text-slate-800 dark:text-white">Dual
                                            Verification</h3>
                                        <p class="text-xs font-medium text-slate-500 mt-0.5">Biometric &amp; SMS Active
                                        </p>
                                    </div>
                                </div>
                                <div class="relative">
                                    <input checked="" class="custom-switch hidden" id="toggle-2fa"
                                        type="checkbox" />
                                    <label class="flex items-center cursor-pointer" for="toggle-2fa">
                                        <div
                                            class="bg w-14 h-8 bg-slate-200 dark:bg-slate-700 rounded-full transition-colors duration-300 relative">
                                            <div
                                                class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition-transform duration-300 shadow-md">
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div
                                class="p-5 bg-blue-50/50 dark:bg-blue-500/5 rounded-3xl border border-blue-100 dark:border-blue-500/20 mb-6">
                                <div class="flex items-start gap-4">
                                    <i class="material-icons-round text-blue-500 mt-1">info</i>
                                    <p
                                        class="text-xs text-blue-800/80 dark:text-blue-200/70 leading-relaxed font-medium">
                                        Multi-factor authentication adds a critical layer of protection to student
                                        records and financial data.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between px-2">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Connected
                                    Methods</span>
                                <div class="flex -space-x-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center border-2 border-white dark:border-slate-900 text-slate-400">
                                        <i class="material-icons-round text-sm">phone_iphone</i></div>
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center border-2 border-white dark:border-slate-900 text-slate-400">
                                        <i class="material-icons-round text-sm">mail</i></div>
                                    <div
                                        class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center border-2 border-white dark:border-slate-900 text-white shadow-glow-emerald">
                                        <i class="material-icons-round text-sm">fingerprint</i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="glass-card rounded-[3rem] p-10">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-10">
                        <div class="flex items-center gap-5">
                            <div
                                class="w-14 h-14 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-600">
                                <i class="material-symbols-outlined text-4xl font-light">settings_input_component</i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-display font-extrabold text-slate-900 dark:text-white">
                                    Workspace Prefs</h3>
                                <p class="text-xs font-medium text-slate-500">Personalize your administrative dashboard
                                    experience</p>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div
                            class="flex items-center justify-between p-6 bg-slate-50/50 dark:bg-slate-800/30 rounded-[2rem] border border-slate-100 dark:border-white/5 hover:border-emerald-500/30 transition-all group">
                            <div class="flex items-center gap-5">
                                <div
                                    class="w-12 h-12 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-500 group-hover:scale-110 transition-transform">
                                    <i class="material-icons-round text-2xl">nights_stay</i>
                                </div>
                                <div>
                                    <p class="text-base font-bold text-slate-800 dark:text-white">OLED Dark Mode</p>
                                    <p class="text-xs text-slate-500">Pure black for OLED displays</p>
                                </div>
                            </div>
                            <div class="relative">
                                <input class="custom-switch hidden" id="toggle-dark-mode" type="checkbox" />
                                <label class="flex items-center cursor-pointer" for="toggle-dark-mode">
                                    <div
                                        class="bg w-14 h-8 bg-slate-200 dark:bg-slate-700 rounded-full transition-colors duration-300 relative">
                                        <div
                                            class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition-transform duration-300 shadow-md">
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-between p-6 bg-slate-50/50 dark:bg-slate-800/30 rounded-[2rem] border border-slate-100 dark:border-white/5 hover:border-emerald-500/30 transition-all">
                            <div class="flex items-center gap-5">
                                <div
                                    class="w-12 h-12 bg-rose-500/10 rounded-2xl flex items-center justify-center text-rose-500">
                                    <i class="material-icons-round text-2xl">timer_3</i>
                                </div>
                                <div>
                                    <p class="text-base font-bold text-slate-800 dark:text-white">Auto Logout</p>
                                    <p class="text-xs text-slate-500">Idle protection threshold</p>
                                </div>
                            </div>
                            <div class="relative">
                                <select
                                    class="appearance-none bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl py-2.5 px-6 pr-12 text-xs font-black text-slate-800 dark:text-slate-100 shadow-sm cursor-pointer focus:ring-2 focus:ring-emerald-500 transition-all uppercase tracking-widest">
                                    <option>15m</option>
                                    <option selected="">30m</option>
                                    <option>1h</option>
                                    <option>4h</option>
                                </select>
                                <i
                                    class="material-icons-round text-slate-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-xl">expand_more</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="flex items-center justify-between px-2">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-600">
                                <i class="material-symbols-outlined text-3xl font-light">history</i>
                            </div>
                            <h3 class="text-2xl font-display font-extrabold text-slate-900 dark:text-white">Access Logs
                            </h3>
                        </div>
                        <button
                            class="text-sm font-bold text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 px-6 py-2 rounded-xl transition-all">View
                            Full Audit</button>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div
                            class="glass-card p-6 rounded-[2rem] relative overflow-hidden group border-emerald-500/30 dark:border-emerald-500/30 bg-emerald-50/30 dark:bg-emerald-950/20">
                            <div class="flex items-start justify-between mb-4">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-900 shadow-sm flex items-center justify-center text-emerald-500 border border-emerald-100 dark:border-emerald-500/20">
                                    <i class="material-icons-round text-3xl">smartphone</i>
                                </div>
                                <span
                                    class="text-[9px] font-black uppercase tracking-widest bg-emerald-500 text-white px-3 py-1 rounded-full shadow-glow-emerald animate-pulse">Live
                                    Now</span>
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white">iPhone 14 Pro</h4>
                                <p class="text-xs font-medium text-slate-500">Jakarta, ID • IP: 182.25.x.x</p>
                                <p class="text-[10px] font-bold text-emerald-600 uppercase mt-2 tracking-tighter">
                                    Current Admin Device</p>
                            </div>
                        </div>
                        <div
                            class="glass-card p-6 rounded-[2rem] group hover:border-slate-300 dark:hover:border-slate-700 transition-all">
                            <div class="flex items-start justify-between mb-4">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-900 shadow-sm flex items-center justify-center text-blue-500 border border-slate-100 dark:border-slate-800">
                                    <i class="material-icons-round text-3xl">laptop_mac</i>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white">MacBook Air M2</h4>
                                <p class="text-xs font-medium text-slate-500">Surabaya, ID • Yesterday, 14:30</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase mt-2 tracking-tighter">
                                    Verified Browser</p>
                            </div>
                        </div>
                        <div
                            class="glass-card p-6 rounded-[2rem] group hover:border-slate-300 dark:hover:border-slate-700 transition-all">
                            <div class="flex items-start justify-between mb-4">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-900 shadow-sm flex items-center justify-center text-amber-500 border border-slate-100 dark:border-slate-800">
                                    <i class="material-icons-round text-3xl">desktop_windows</i>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white">Principal Office PC</h4>
                                <p class="text-xs font-medium text-slate-500">Sidoarjo, ID • 2 days ago</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase mt-2 tracking-tighter">Wired
                                    Network</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection



