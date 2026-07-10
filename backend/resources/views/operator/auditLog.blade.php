@extends('layouts.operator')
@section('content')
    <div class="space-y-6 max-w-[1600px] mx-auto w-full">

            <!-- Filters Section -->
            <div class="glass-card p-6 rounded-[2rem] shadow-xl flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Filter
                        Rentang Tanggal</label>
                    <div class="relative">
                        <i data-lucide="calendar"
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" placeholder="Pilih Tanggal..."
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all">
                    </div>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Cari
                        Berdasarkan User</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <select
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all appearance-none cursor-pointer">
                            <option>Semua Pengguna</option>
                            <option>Felix Operator (Admin)</option>
                            <option>Siti Aminah (Staf)</option>
                            <option>Budi Santoso (Keuangan)</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button
                        class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-emerald-600/20 flex items-center gap-2">
                        <i data-lucide="search" class="w-4 h-4"></i> Terapkan
                    </button>
                    <button
                        class="p-3 bg-slate-100 dark:bg-slate-800 text-slate-500 rounded-2xl hover:bg-slate-200 transition-all">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- Table Card -->
            <div
                class="glass-card rounded-[2.5rem] shadow-xl overflow-hidden border border-slate-100 dark:border-slate-800">
                <div class="p-8 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between">
                    <div>
                        <h3 class="font-lexend font-black text-lg text-slate-900 dark:text-white uppercase tracking-tight">
                            Log Aktivitas Terbaru</h3>
                        <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest">Menampilkan 50
                            data aktivitas terakhir</p>
                    </div>
                    <button
                        class="p-3 text-emerald-600 bg-emerald-50 dark:bg-emerald-500/10 rounded-xl hover:scale-105 transition-all">
                        <i data-lucide="download" class="w-5 h-5"></i>
                    </button>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-800/50">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    Pengguna</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    Aksi</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    Data Terkait</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    IP Address</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <!-- Log Item 1 -->
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <img src="/assets/default-avatar.svg"
                                            class="w-8 h-8 rounded-lg bg-slate-100">
                                        <div>
                                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">Felix
                                                Operator</p>
                                            <p class="text-[10px] text-slate-400 font-medium">Administrator</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span
                                        class="px-3 py-1 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 text-[10px] font-black rounded-full uppercase tracking-tighter">Login
                                        Berhasil</span>
                                </td>
                                <td class="px-8 py-5 text-xs font-bold text-slate-500">Sistem Portal Utama</td>
                                <td class="px-8 py-5">
                                    <code
                                        class="text-[10px] font-mono bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-md text-slate-500">192.168.1.12</code>
                                </td>
                                <td class="px-8 py-5">
                                    <p class="text-xs font-bold text-slate-700 dark:text-slate-200">13 Feb 2026</p>
                                    <p class="text-[10px] text-slate-400 font-medium tracking-widest">10:35:12 WIB</p>
                                </td>
                            </tr>
                            <!-- Log Item 2 -->
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <img src="/assets/default-avatar.svg"
                                            class="w-8 h-8 rounded-lg bg-slate-100">
                                        <div>
                                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">Siti Aminah
                                            </p>
                                            <p class="text-[10px] text-slate-400 font-medium">Staf PPDB</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span
                                        class="px-3 py-1 bg-blue-50 dark:bg-blue-500/10 text-blue-600 text-[10px] font-black rounded-full uppercase tracking-tighter">Update
                                        Siswa</span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="file-text" class="w-3 h-3 text-slate-300"></i>
                                        <p class="text-xs font-bold text-slate-500">Ahmad Fauzi (PPDB-001)</p>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <code
                                        class="text-[10px] font-mono bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-md text-slate-500">182.25.102.44</code>
                                </td>
                                <td class="px-8 py-5">
                                    <p class="text-xs font-bold text-slate-700 dark:text-slate-200">13 Feb 2026</p>
                                    <p class="text-[10px] text-slate-400 font-medium tracking-widest">09:12:45 WIB</p>
                                </td>
                            </tr>
                            <!-- Log Item 3 -->
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <img src="/assets/default-avatar.svg"
                                            class="w-8 h-8 rounded-lg bg-slate-100">
                                        <div>
                                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">Felix
                                                Operator</p>
                                            <p class="text-[10px] text-slate-400 font-medium">Administrator</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span
                                        class="px-3 py-1 bg-rose-50 dark:bg-rose-500/10 text-rose-600 text-[10px] font-black rounded-full uppercase tracking-tighter">Hapus
                                        Backup</span>
                                </td>
                                <td class="px-8 py-5 text-xs font-bold text-slate-500 italic">db_old_backup_2025.zip
                                </td>
                                <td class="px-8 py-5">
                                    <code
                                        class="text-[10px] font-mono bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-md text-slate-500">192.168.1.12</code>
                                </td>
                                <td class="px-8 py-5">
                                    <p class="text-xs font-bold text-slate-700 dark:text-slate-200">12 Feb 2026</p>
                                    <p class="text-[10px] text-slate-400 font-medium tracking-widest">22:05:01 WIB</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div
                    class="p-8 border-t border-slate-50 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-6">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Halaman 1 dari 24</p>
                    <div class="flex items-center gap-2">
                        <button
                            class="p-2 w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 rounded-xl text-slate-400 hover:text-emerald-500 transition-all border border-slate-100 dark:border-slate-700"><i
                                data-lucide="chevron-left" class="w-4 h-4"></i></button>
                        <button
                            class="w-10 h-10 flex items-center justify-center bg-emerald-600 text-white rounded-xl text-xs font-black shadow-lg shadow-emerald-600/20">1</button>
                        <button
                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 text-slate-500 rounded-xl text-xs font-black hover:bg-emerald-500 hover:text-white transition-all border border-slate-100 dark:border-slate-700">2</button>
                        <button
                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 text-slate-500 rounded-xl text-xs font-black hover:bg-emerald-500 hover:text-white transition-all border border-slate-100 dark:border-slate-700">3</button>
                        <button
                            class="p-2 w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 rounded-xl text-slate-400 hover:text-emerald-500 transition-all border border-slate-100 dark:border-slate-700"><i
                                data-lucide="chevron-right" class="w-4 h-4"></i></button>
                    </div>
                </div>
            </div>

    </div>
@endsection
