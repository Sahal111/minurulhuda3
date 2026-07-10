@extends('layouts.bendahara')
@section('content')
    <main class="lg:ml-64 min-h-screen p-4 md:p-8 transition-all duration-300">
        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span
                        class="px-2 py-0.5 bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 text-[10px] font-bold rounded uppercase tracking-wider">System
                        Security</span>
                </div>
                <h1 class="text-2xl font-bold font-lexend text-slate-800 dark:text-white">Audit Transaksi</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Log aktivitas sistem untuk melacak setiap perubahan
                    data keuangan.</p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="flex items-center gap-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-200 px-4 py-2.5 rounded-xl font-medium shadow-sm hover:bg-slate-50 transition-all">
                    <i data-lucide="file-down" class="w-4 h-4"></i>
                    <span>Export Log (CSV)</span>
                </button>
            </div>
        </header>

        <div
            class="bg-white dark:bg-slate-800 p-4 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex-1 min-w-[250px] relative">
                    <i data-lucide="calendar" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="text" placeholder="Pilih Rentang Tanggal..."
                        class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-500 transition-all">
                </div>
                <div class="w-full md:w-48">
                    <select
                        class="w-full px-4 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm outline-none">
                        <option value="">Semua Aksi</option>
                        <option value="create">Tambah Data</option>
                        <option value="update">Edit Data</option>
                        <option value="delete">Hapus Data</option>
                    </select>
                </div>
                <button
                    class="bg-emerald-600 text-white px-6 py-2 rounded-xl text-sm font-medium hover:bg-emerald-700 transition-all">
                    Filter
                </button>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">User</th>
                            <th class="px-6 py-4 font-semibold">Aksi</th>
                            <th class="px-6 py-4 font-semibold">Nominal Terkait</th>
                            <th class="px-6 py-4 font-semibold">Waktu Eksekusi</th>
                            <th class="px-6 py-4 font-semibold">IP Address</th>
                            <th class="px-6 py-4 font-semibold text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-sm">
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                                        <i data-lucide="user" class="w-4 h-4 text-emerald-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-700 dark:text-slate-200">Usth. Siti Aminah</p>
                                        <p class="text-[10px] text-slate-400">ID: #BND001</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-bold bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-400 border border-blue-100 dark:border-blue-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                    UPDATE_TRANS
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono font-medium text-slate-600 dark:text-slate-300">
                                Rp 250.000
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-700 dark:text-slate-200">16 Feb 2026</div>
                                <div class="text-[11px] text-slate-400 italic">08:45:12 WIB</div>
                            </td>
                            <td class="px-6 py-4">
                                <code
                                    class="text-[11px] bg-slate-100 dark:bg-slate-900 px-2 py-1 rounded text-slate-500">192.168.1.105</code>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button class="text-slate-400 hover:text-emerald-600 transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 text-slate-700 dark:text-slate-200">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                                        <i data-lucide="user" class="w-4 h-4 text-red-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-700 dark:text-slate-200">Admin Utama</p>
                                        <p class="text-[10px] text-slate-400">ID: #ADM099</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-bold bg-red-50 text-red-700 dark:bg-red-900/20 dark:text-red-400 border border-red-100 dark:border-red-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    DELETE_TRANS
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono font-medium text-red-600">
                                Rp 1.200.000
                            </td>
                            <td class="px-6 py-4 text-slate-700 dark:text-slate-200">
                                <div>15 Feb 2026</div>
                                <div class="text-[11px] text-slate-400 italic">22:10:05 WIB</div>
                            </td>
                            <td class="px-6 py-4">
                                <code
                                    class="text-[11px] bg-slate-100 dark:bg-slate-900 px-2 py-1 rounded text-slate-500">36.72.189.44</code>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button class="text-slate-400 hover:text-emerald-600 transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-4 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700">
                <p class="text-[11px] text-slate-500 flex items-center gap-2">
                    <i data-lucide="info" class="w-3 h-3"></i>
                    Data audit disimpan selama 365 hari terakhir sesuai kebijakan keamanan MI Nurul Huda 3.
                </p>
            </div>
        </div>
    </main>
@endsection
