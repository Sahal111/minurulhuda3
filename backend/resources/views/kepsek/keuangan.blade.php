@extends('layouts.kepsek')
@section('content')
    <main class="flex-1 p-6 space-y-6 w-full max-w-[1600px] mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
            <div class="flex flex-col gap-4 w-full">
                <h2 class="text-2xl font-display font-bold text-slate-900 dark:text-white leading-tight">Financial
                    Overview</h2>
                <div class="flex overflow-x-auto hide-scroll pb-2 border-b border-slate-200 dark:border-slate-700 w-full">
                    <button
                        class="px-4 py-2 text-sm font-semibold text-emerald-600 dark:text-emerald-400 border-b-2 border-emerald-600 dark:border-emerald-400 whitespace-nowrap">Dashboard</button>
                    <button
                        class="px-4 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors whitespace-nowrap">Laporan
                        Pemasukan</button>
                    <button
                        class="px-4 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors whitespace-nowrap">Laporan
                        Pengeluaran</button>
                    <button
                        class="px-4 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors whitespace-nowrap">Status
                        Pembayaran SPP</button>
                    <button
                        class="px-4 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors whitespace-nowrap">Rekap
                        Tahunan</button>
                </div>
            </div>
        </div>
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div
                class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="material-icons-round text-6xl text-emerald-600">arrow_circle_up</i>
                </div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div
                        class="p-2.5 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl text-emerald-600 dark:text-emerald-400">
                        <i class="material-icons-round text-xl">account_balance_wallet</i>
                    </div>
                    <span
                        class="flex items-center text-[11px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-1 rounded-lg">
                        +12% vs last month
                    </span>
                </div>
                <div class="relative z-10">
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide mb-1">
                        Total Pemasukan</p>
                    <h4 class="text-2xl font-display font-bold text-slate-800 dark:text-white">Rp 45.250.000</h4>
                    <p class="text-[10px] text-slate-400 mt-1">Bulan Ini (Februari 2024)</p>
                </div>
            </div>
            <div
                class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="material-icons-round text-6xl text-red-600">arrow_circle_down</i>
                </div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div class="p-2.5 bg-red-50 dark:bg-red-900/20 rounded-xl text-red-600 dark:text-red-400">
                        <i class="material-icons-round text-xl">payments</i>
                    </div>
                    <span
                        class="flex items-center text-[11px] font-bold text-red-600 bg-red-50 dark:bg-red-900/30 px-2 py-1 rounded-lg">
                        +5% vs last month
                    </span>
                </div>
                <div class="relative z-10">
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide mb-1">
                        Total Pengeluaran</p>
                    <h4 class="text-2xl font-display font-bold text-slate-800 dark:text-white">Rp 32.100.000</h4>
                    <p class="text-[10px] text-slate-400 mt-1">Bulan Ini (Februari 2024)</p>
                </div>
            </div>
            <div
                class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="material-icons-round text-6xl text-blue-600">savings</i>
                </div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div class="p-2.5 bg-blue-50 dark:bg-blue-900/20 rounded-xl text-blue-600 dark:text-blue-400">
                        <i class="material-icons-round text-xl">account_balance</i>
                    </div>
                    <span
                        class="flex items-center text-[11px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-1 rounded-lg">
                        Healthy
                    </span>
                </div>
                <div class="relative z-10">
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide mb-1">
                        Net Cash Flow</p>
                    <h4 class="text-2xl font-display font-bold text-slate-800 dark:text-white text-emerald-600">+Rp
                        13.150.000</h4>
                    <p class="text-[10px] text-slate-400 mt-1">Surplus Bulan Ini</p>
                </div>
            </div>
            <div
                class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-card border border-slate-100 dark:border-slate-700/50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="material-icons-round text-6xl text-amber-500">pie_chart</i>
                </div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div class="p-2.5 bg-amber-50 dark:bg-amber-900/20 rounded-xl text-amber-600 dark:text-amber-400">
                        <i class="material-icons-round text-xl">assignment_turned_in</i>
                    </div>
                    <span
                        class="flex items-center text-[11px] font-bold text-amber-600 bg-amber-50 dark:bg-amber-900/30 px-2 py-1 rounded-lg">
                        Target: 95%
                    </span>
                </div>
                <div class="relative z-10">
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-wide mb-1">
                        % Lunas SPP</p>
                    <div class="flex items-end gap-2">
                        <h4 class="text-2xl font-display font-bold text-slate-800 dark:text-white">82%</h4>
                        <span class="text-xs text-red-500 font-medium mb-1.5">(18% Belum)</span>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-slate-700 h-1.5 rounded-full mt-2 overflow-hidden">
                        <div class="bg-amber-500 h-full rounded-full" style="width: 82%"></div>
                    </div>
                </div>
            </div>
        </section>
        <div
            class="bg-white dark:bg-surface-dark rounded-3xl shadow-soft p-6 border border-slate-100 dark:border-slate-700/50">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <div>
                    <h3 class="font-display font-bold text-slate-800 dark:text-white text-lg">Cash Flow Analysis
                    </h3>
                    <p class="text-xs text-slate-400">Income vs Expenses Overview</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <select
                        class="text-xs bg-slate-50 dark:bg-background-dark border-0 rounded-lg py-2 pl-3 pr-8 text-slate-600 dark:text-slate-300 focus:ring-1 focus:ring-primary shadow-sm font-medium">
                        <option>February</option>
                        <option>January</option>
                        <option>December</option>
                    </select>
                    <select
                        class="text-xs bg-slate-50 dark:bg-background-dark border-0 rounded-lg py-2 pl-3 pr-8 text-slate-600 dark:text-slate-300 focus:ring-1 focus:ring-primary shadow-sm font-medium">
                        <option>2024</option>
                        <option>2023</option>
                    </select>
                    <select
                        class="text-xs bg-slate-50 dark:bg-background-dark border-0 rounded-lg py-2 pl-3 pr-8 text-slate-600 dark:text-slate-300 focus:ring-1 focus:ring-primary shadow-sm font-medium">
                        <option>All Transactions</option>
                        <option>Cash</option>
                        <option>Transfer</option>
                    </select>
                    <button
                        class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs px-3 py-2 rounded-lg transition-colors flex items-center gap-1 shadow-md shadow-emerald-200 dark:shadow-none">
                        <i class="material-icons-round text-sm">filter_list</i> Filter
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 h-64 relative w-full">
                    <div
                        class="absolute inset-0 flex items-end justify-between px-2 pb-6 border-b border-slate-100 dark:border-slate-700">
                        <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                            <div class="w-full h-px bg-slate-100 dark:bg-slate-700/50"></div>
                            <div class="w-full h-px bg-slate-100 dark:bg-slate-700/50"></div>
                            <div class="w-full h-px bg-slate-100 dark:bg-slate-700/50"></div>
                            <div class="w-full h-px bg-slate-100 dark:bg-slate-700/50"></div>
                            <div class="w-full h-px bg-slate-100 dark:bg-slate-700/50"></div>
                        </div>
                        <div class="z-10 w-full h-full flex justify-around items-end pt-4">
                            <div class="flex gap-1 h-full items-end group">
                                <div
                                    class="w-3 md:w-5 bg-emerald-500 rounded-t-sm h-[45%] hover:bg-emerald-400 transition-all relative">
                                    <div
                                        class="absolute -top-6 left-1/2 -translate-x-1/2 text-[9px] bg-slate-800 text-white px-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                        45M</div>
                                </div>
                                <div
                                    class="w-3 md:w-5 bg-red-400 rounded-t-sm h-[30%] hover:bg-red-300 transition-all relative">
                                    <div
                                        class="absolute -top-6 left-1/2 -translate-x-1/2 text-[9px] bg-slate-800 text-white px-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                        30M</div>
                                </div>
                            </div>
                            <div class="flex gap-1 h-full items-end group">
                                <div
                                    class="w-3 md:w-5 bg-emerald-500 rounded-t-sm h-[55%] hover:bg-emerald-400 transition-all relative">
                                </div>
                                <div
                                    class="w-3 md:w-5 bg-red-400 rounded-t-sm h-[40%] hover:bg-red-300 transition-all relative">
                                </div>
                            </div>
                            <div class="flex gap-1 h-full items-end group">
                                <div
                                    class="w-3 md:w-5 bg-emerald-500 rounded-t-sm h-[65%] hover:bg-emerald-400 transition-all relative">
                                </div>
                                <div
                                    class="w-3 md:w-5 bg-red-400 rounded-t-sm h-[35%] hover:bg-red-300 transition-all relative">
                                </div>
                            </div>
                            <div class="flex gap-1 h-full items-end group">
                                <div
                                    class="w-3 md:w-5 bg-emerald-500 rounded-t-sm h-[75%] hover:bg-emerald-400 transition-all relative">
                                </div>
                                <div
                                    class="w-3 md:w-5 bg-red-400 rounded-t-sm h-[50%] hover:bg-red-300 transition-all relative">
                                </div>
                            </div>
                            <div class="flex gap-1 h-full items-end group">
                                <div
                                    class="w-3 md:w-5 bg-emerald-500 rounded-t-sm h-[85%] hover:bg-emerald-400 transition-all relative">
                                </div>
                                <div
                                    class="w-3 md:w-5 bg-red-400 rounded-t-sm h-[70%] hover:bg-red-300 transition-all relative">
                                </div>
                            </div>
                            <div class="flex gap-1 h-full items-end group">
                                <div
                                    class="w-3 md:w-5 bg-emerald-500 rounded-t-sm h-[60%] hover:bg-emerald-400 transition-all relative">
                                </div>
                                <div
                                    class="w-3 md:w-5 bg-red-400 rounded-t-sm h-[45%] hover:bg-red-300 transition-all relative">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute bottom-0 w-full flex justify-around text-[10px] text-slate-400 font-medium pt-2">
                        <span>Aug</span><span>Sep</span><span>Oct</span><span>Nov</span><span>Dec</span><span>Jan</span>
                    </div>
                    <div class="absolute top-0 right-0 flex gap-3">
                        <div class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-sm bg-emerald-500"></span><span
                                class="text-[10px] text-slate-500">Income</span></div>
                        <div class="flex items-center gap-1.5"><span
                                class="w-2.5 h-2.5 rounded-sm bg-red-400"></span><span
                                class="text-[10px] text-slate-500">Expense</span></div>
                    </div>
                </div>
                <div
                    class="h-64 flex flex-col justify-center items-center relative border-l border-slate-100 dark:border-slate-700/50 pl-0 lg:pl-6 pt-6 lg:pt-0 border-t lg:border-t-0 mt-6 lg:mt-0">
                    <h4 class="absolute top-0 left-6 lg:left-6 font-semibold text-sm text-slate-700 dark:text-slate-300">
                        Pemasukan Composition</h4>
                    <div class="relative w-40 h-40">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" fill="transparent" r="40" stroke="#10b981"
                                stroke-dasharray="188.5 251.2" stroke-width="16"></circle>
                            <circle cx="50" cy="50" fill="transparent" r="40" stroke="#f59e0b"
                                stroke-dasharray="45 251.2" stroke-dashoffset="-188.5" stroke-width="16">
                            </circle>
                            <circle cx="50" cy="50" fill="transparent" r="40" stroke="#3b82f6"
                                stroke-dasharray="17.7 251.2" stroke-dashoffset="-233.5" stroke-width="16">
                            </circle>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span class="text-xs text-slate-400">Total</span>
                            <span class="text-sm font-bold text-slate-800 dark:text-white">100%</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-2 mt-4 w-full px-4">
                        <div class="flex justify-between items-center text-xs">
                            <div class="flex items-center gap-2"><span
                                    class="w-2 h-2 rounded-full bg-emerald-500"></span><span
                                    class="text-slate-600 dark:text-slate-300">SPP Siswa</span></div>
                            <span class="font-bold text-slate-800 dark:text-white">75%</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <div class="flex items-center gap-2"><span
                                    class="w-2 h-2 rounded-full bg-amber-500"></span><span
                                    class="text-slate-600 dark:text-slate-300">Dana BOS</span></div>
                            <span class="font-bold text-slate-800 dark:text-white">18%</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <div class="flex items-center gap-2"><span
                                    class="w-2 h-2 rounded-full bg-blue-500"></span><span
                                    class="text-slate-600 dark:text-slate-300">Lainnya</span></div>
                            <span class="font-bold text-slate-800 dark:text-white">7%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="bg-white dark:bg-surface-dark rounded-3xl shadow-soft border border-slate-100 dark:border-slate-700/50 overflow-hidden">
            <div
                class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center flex-wrap gap-4">
                <div>
                    <h3 class="font-display font-bold text-slate-800 dark:text-white text-lg flex items-center gap-2">
                        <i class="material-icons-round text-red-500">warning</i>
                        Daftar Siswa Menunggak
                    </h3>
                    <p class="text-xs text-slate-400">Students with Outstanding SPP Arrears (&gt; 2 Months)</p>
                </div>
                <div class="flex gap-2">
                    <button
                        class="bg-white hover:bg-slate-50 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-200 border border-slate-200 dark:border-slate-600 text-xs px-3 py-2 rounded-lg transition-colors flex items-center gap-1.5 shadow-sm">
                        <i class="material-icons-round text-sm text-green-600">description</i> Excel
                    </button>
                    <button
                        class="bg-white hover:bg-slate-50 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-200 border border-slate-200 dark:border-slate-600 text-xs px-3 py-2 rounded-lg transition-colors flex items-center gap-1.5 shadow-sm">
                        <i class="material-icons-round text-sm text-red-500">picture_as_pdf</i> PDF
                    </button>
                    <button
                        class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs px-3 py-2 rounded-lg transition-colors flex items-center gap-1.5 shadow-md shadow-emerald-200 dark:shadow-none">
                        <i class="material-icons-round text-sm">send</i> Send Reminder
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50 dark:bg-background-dark/50 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            <th class="px-6 py-4">Student Name</th>
                            <th class="px-6 py-4">Class</th>
                            <th class="px-6 py-4">Parent/Guardian</th>
                            <th class="px-6 py-4">Months</th>
                            <th class="px-6 py-4 text-right">Total Amount</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                        AF</div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800 dark:text-white">Ahmad
                                            Fauzan</p>
                                        <p class="text-[10px] text-slate-400">ID: 2023001</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">Class 5A</td>
                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                                <div class="flex items-center gap-1">
                                    <span>Bpk. Hartono</span>
                                    <button class="text-emerald-500 hover:text-emerald-600"><i
                                            class="material-icons-round text-sm">whatsapp</i></button>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                    3 Months
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-mono text-sm font-bold text-slate-800 dark:text-white">
                                Rp 450.000</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-50 text-red-600 border border-red-100 dark:bg-red-900/20 dark:border-red-900/30">
                                    Overdue
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button
                                    class="text-slate-400 hover:text-emerald-600 transition-colors p-1 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700">
                                    <i class="material-icons-round">more_vert</i>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                        SN</div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800 dark:text-white">Siti
                                            Nurhaliza</p>
                                        <p class="text-[10px] text-slate-400">ID: 2023045</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">Class 3B</td>
                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                                <div class="flex items-center gap-1">
                                    <span>Ibu Rina</span>
                                    <button class="text-emerald-500 hover:text-emerald-600"><i
                                            class="material-icons-round text-sm">whatsapp</i></button>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300">
                                    2 Months
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-mono text-sm font-bold text-slate-800 dark:text-white">
                                Rp 300.000</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-orange-50 text-orange-600 border border-orange-100 dark:bg-orange-900/20 dark:border-orange-900/30">
                                    Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button
                                    class="text-slate-400 hover:text-emerald-600 transition-colors p-1 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700">
                                    <i class="material-icons-round">more_vert</i>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                        BR</div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800 dark:text-white">Budi
                                            Raharjo</p>
                                        <p class="text-[10px] text-slate-400">ID: 2023089</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">Class 6A</td>
                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                                <div class="flex items-center gap-1">
                                    <span>Bpk. Susanto</span>
                                    <button class="text-emerald-500 hover:text-emerald-600"><i
                                            class="material-icons-round text-sm">whatsapp</i></button>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                    4 Months
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-mono text-sm font-bold text-slate-800 dark:text-white">
                                Rp 600.000</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-50 text-red-600 border border-red-100 dark:bg-red-900/20 dark:border-red-900/30">
                                    Critical
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button
                                    class="text-slate-400 hover:text-emerald-600 transition-colors p-1 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700">
                                    <i class="material-icons-round">more_vert</i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div
                class="p-4 border-t border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/30">
                <span class="text-xs text-slate-500 dark:text-slate-400">Showing 3 of 12 students</span>
                <div class="flex gap-1">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-surface-dark text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-700 disabled:opacity-50">
                        <i class="material-icons-round text-sm">chevron_left</i>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-emerald-500 bg-emerald-50 text-emerald-600 font-bold text-xs">1</button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-surface-dark text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-700 text-xs">2</button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-surface-dark text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-700">
                        <i class="material-icons-round text-sm">chevron_right</i>
                    </button>
                </div>
            </div>
        </div>
    </main>
@endsection
