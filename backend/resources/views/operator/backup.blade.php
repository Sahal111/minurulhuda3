@extends('layouts.operator')
@section('content')
    <div class="space-y-8 max-w-7xl mx-auto w-full">

            <!-- Quick Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card: Manual Backup -->
                <div class="glass-card p-8 rounded-[2.5rem] shadow-xl border-b-4 border-emerald-500 group">
                    <div
                        class="w-14 h-14 bg-emerald-500/10 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="hard-drive" class="w-7 h-7"></i>
                    </div>
                    <h3 class="font-lexend font-bold text-lg text-slate-900 dark:text-white">Backup Manual</h3>
                    <p class="text-xs text-slate-400 mt-2 mb-6">Cadangkan seluruh basis data PPDB ke dalam format
                        terkompresi (.zip) sekarang.</p>
                    <button
                        class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-600/20 transition-all">Mulai
                        Backup</button>
                </div>

                <!-- Card: Automatic Backup -->
                <div class="glass-card p-8 rounded-[2.5rem] shadow-xl border-b-4 border-blue-500 group">
                    <div
                        class="w-14 h-14 bg-blue-500/10 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="refresh-cw" class="w-7 h-7"></i>
                    </div>
                    <div class="flex justify-between items-start">
                        <h3 class="font-lexend font-bold text-lg text-slate-900 dark:text-white">Backup Otomatis</h3>
                        <div class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 mt-2 mb-6">Sistem akan mencadangkan data setiap jam 00:00 WIB ke
                        server cloud.</p>
                    <button
                        class="w-full py-4 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all">Atur
                        Jadwal</button>
                </div>

                <!-- Card: Restore System -->
                <div class="glass-card p-8 rounded-[2.5rem] shadow-xl border-b-4 border-rose-500 group">
                    <div
                        class="w-14 h-14 bg-rose-500/10 text-rose-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="history" class="w-7 h-7"></i>
                    </div>
                    <h3 class="font-lexend font-bold text-lg text-slate-900 dark:text-white">Restore System</h3>
                    <p class="text-xs text-slate-400 mt-2 mb-6 text-rose-500 italic font-medium">Peringatan: Proses ini
                        akan menimpa data saat ini dengan data cadangan.</p>
                    <button
                        class="w-full py-4 bg-rose-50 text-rose-600 dark:bg-rose-500/10 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-rose-100 transition-all border border-rose-100 dark:border-rose-500/20">Unggah
                        File Restore</button>
                </div>
            </div>

            <!-- Backup History Table -->
            <div class="glass-card rounded-[3rem] shadow-xl overflow-hidden">
                <div
                    class="p-8 border-b border-slate-100 dark:border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="font-lexend font-black text-xl text-slate-900 dark:text-white uppercase tracking-tight">
                            Riwayat Backup</h3>
                        <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-wider">Log aktivitas
                            pencadangan 30 hari terakhir</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            class="p-3 bg-slate-50 dark:bg-slate-800 rounded-2xl text-slate-400 hover:text-emerald-500 transition-colors">
                            <i data-lucide="filter" class="w-4 h-4"></i>
                        </button>
                        <button
                            class="px-5 py-3 bg-slate-900 dark:bg-emerald-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all hover:scale-105">Hapus
                            Log Lama</button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-800/50">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    Nama File</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    Ukuran</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    Metode</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    Tanggal</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <!-- Row 1 -->
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center">
                                            <i data-lucide="archive" class="w-5 h-5"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                                db_full_130226.zip</p>
                                            <p class="text-[10px] text-slate-400 font-medium">MD5: e99a18...f22</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-xs font-bold text-slate-600 dark:text-slate-400">2.4 MB</td>
                                <td class="px-8 py-5">
                                    <span
                                        class="px-3 py-1 bg-blue-50 dark:bg-blue-500/10 text-blue-600 text-[10px] font-black rounded-full uppercase tracking-tighter">Otomatis</span>
                                </td>
                                <td class="px-8 py-5 text-xs font-bold text-slate-500">Hari ini, 00:00</td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-2">
                                        <button
                                            class="p-2 hover:bg-emerald-100 dark:hover:bg-emerald-900/40 text-emerald-600 rounded-xl transition-all"><i
                                                data-lucide="download" class="w-4 h-4"></i></button>
                                        <button
                                            class="p-2 hover:bg-rose-100 dark:hover:bg-rose-900/40 text-rose-600 rounded-xl transition-all"><i
                                                data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 2 -->
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center">
                                            <i data-lucide="archive" class="w-5 h-5"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                                manual_pre_import.zip</p>
                                            <p class="text-[10px] text-slate-400 font-medium">MD5: c44b21...a12</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-xs font-bold text-slate-600 dark:text-slate-400">1.8 MB</td>
                                <td class="px-8 py-5">
                                    <span
                                        class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-[10px] font-black rounded-full uppercase tracking-tighter">Manual</span>
                                </td>
                                <td class="px-8 py-5 text-xs font-bold text-slate-500">Kemarin, 14:20</td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-2">
                                        <button
                                            class="p-2 hover:bg-emerald-100 dark:hover:bg-emerald-900/40 text-emerald-600 rounded-xl transition-all"><i
                                                data-lucide="download" class="w-4 h-4"></i></button>
                                        <button
                                            class="p-2 hover:bg-rose-100 dark:hover:bg-rose-900/40 text-rose-600 rounded-xl transition-all"><i
                                                data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
@endsection
