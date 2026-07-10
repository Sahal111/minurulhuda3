@extends('layouts.operator')
@section('content')
    <div class="space-y-12">

            <!-- Stats Grid (Consistent style with Kepsek Monitoring) -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <div class="glass-card p-6 rounded-[2.5rem] shadow-sm flex flex-col items-center text-center">
                    <div
                        class="w-12 h-12 bg-emerald-500/10 text-emerald-600 rounded-2xl flex items-center justify-center mb-4">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <p class="text-3xl font-lexend font-black text-slate-900 dark:text-white">248</p>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Total Pendaftar</p>
                </div>
                <div class="glass-card p-6 rounded-[2.5rem] shadow-sm flex flex-col items-center text-center">
                    <div class="w-12 h-12 bg-amber-500/10 text-amber-600 rounded-2xl flex items-center justify-center mb-4">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                    <p class="text-3xl font-lexend font-black text-slate-900 dark:text-white">12</p>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Pending Review</p>
                </div>
                <div class="glass-card p-6 rounded-[2.5rem] shadow-sm flex flex-col items-center text-center">
                    <div class="w-12 h-12 bg-blue-500/10 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                        <i data-lucide="check-circle" class="w-6 h-6"></i>
                    </div>
                    <p class="text-3xl font-lexend font-black text-slate-900 dark:text-white">180</p>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Lulus Seleksi</p>
                </div>
                <div class="glass-card p-6 rounded-[2.5rem] shadow-sm flex flex-col items-center text-center">
                    <div class="w-12 h-12 bg-rose-500/10 text-rose-600 rounded-2xl flex items-center justify-center mb-4">
                        <i data-lucide="x-circle" class="w-6 h-6"></i>
                    </div>
                    <p class="text-3xl font-lexend font-black text-slate-900 dark:text-white">56</p>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Tidak Lulus</p>
                </div>
            </div>

            <!-- Main Management Table -->
            <div class="glass-card rounded-[3rem] overflow-hidden shadow-xl">
                <div
                    class="p-8 border-b border-slate-100 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto">
                        <div class="relative w-full md:w-80">
                            <i data-lucide="search"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input type="text" placeholder="Cari nama atau sekolah asal..."
                                class="w-full pl-12 pr-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border-none rounded-2xl text-xs font-bold outline-none ring-2 ring-transparent focus:ring-emerald-500/20 transition-all">
                        </div>
                        <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0 custom-scrollbar">
                            <select
                                class="px-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border-none rounded-xl text-[10px] font-black uppercase tracking-widest outline-none">
                                <option>Semua Jalur</option>
                                <option>Zonasi</option>
                                <option>Prestasi</option>
                                <option>Afirmasi</option>
                            </select>
                            <select
                                class="px-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border-none rounded-xl text-[10px] font-black uppercase tracking-widest outline-none">
                                <option>Semua Status</option>
                                <option>Lulus</option>
                                <option>Pending</option>
                                <option>Cadangan</option>
                                <option>Tidak Lulus</option>
                            </select>
                        </div>
                    </div>
                    <button
                        class="w-full md:w-auto px-8 py-4 bg-emerald-600 text-white rounded-2xl text-sm font-black shadow-lg shadow-emerald-600/20 flex items-center justify-center gap-3">
                        <i data-lucide="download" class="w-5 h-5"></i> Export Data Excel
                    </button>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse min-w-[900px]">
                        <thead class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-800">
                            <tr>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Nama Pendaftar</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Asal Sekolah</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Jalur</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Status Seleksi</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Pembayaran</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            <!-- Row 1: Lulus -->
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-all">
                                <td class="px-8 py-6">
                                    <div>
                                        <p class="text-sm font-black text-slate-900 dark:text-white">Ahmad Fauzi</p>
                                        <p class="text-[10px] font-bold text-slate-400">REG-2024-001</p>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-xs font-bold text-slate-600 dark:text-slate-400 uppercase">TK
                                    Islam Amanah</td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg text-[10px] font-black uppercase tracking-tighter">Zonasi</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-4 py-1.5 bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 rounded-full text-[10px] font-black uppercase tracking-widest">Lulus</span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2 text-emerald-500">
                                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                                        <span class="text-[10px] font-black uppercase">Lunas</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-end gap-2">
                                        <button title="Lihat Detail"
                                            class="p-3 bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-emerald-500 rounded-xl transition-all"><i
                                                data-lucide="eye" class="w-4 h-4"></i></button>
                                        <button title="Update Status"
                                            class="p-3 bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-blue-500 rounded-xl transition-all"><i
                                                data-lucide="refresh-cw" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 2: Pending -->
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-all">
                                <td class="px-8 py-6">
                                    <div>
                                        <p class="text-sm font-black text-slate-900 dark:text-white">Siti Aminah</p>
                                        <p class="text-[10px] font-bold text-slate-400">REG-2024-002</p>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-xs font-bold text-slate-600 dark:text-slate-400 uppercase">RA
                                    Nurul Iman</td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg text-[10px] font-black uppercase tracking-tighter">Prestasi</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-4 py-1.5 bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400 rounded-full text-[10px] font-black uppercase tracking-widest">Pending</span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2 text-amber-500">
                                        <i data-lucide="alert-circle" class="w-4 h-4"></i>
                                        <span class="text-[10px] font-black uppercase">Belum Bayar</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-end gap-2">
                                        <button title="Lihat Detail"
                                            class="p-3 bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-emerald-500 rounded-xl transition-all"><i
                                                data-lucide="eye" class="w-4 h-4"></i></button>
                                        <button title="Update Status"
                                            class="p-3 bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-blue-500 rounded-xl transition-all"><i
                                                data-lucide="refresh-cw" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 3: Cadangan -->
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-all">
                                <td class="px-8 py-6">
                                    <div>
                                        <p class="text-sm font-black text-slate-900 dark:text-white">Budi Santoso</p>
                                        <p class="text-[10px] font-bold text-slate-400">REG-2024-003</p>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-xs font-bold text-slate-600 dark:text-slate-400 uppercase">TK
                                    Kartika</td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg text-[10px] font-black uppercase tracking-tighter">Zonasi</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-4 py-1.5 bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400 rounded-full text-[10px] font-black uppercase tracking-widest">Cadangan</span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2 text-emerald-500">
                                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                                        <span class="text-[10px] font-black uppercase">Lunas</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-end gap-2">
                                        <button title="Lihat Detail"
                                            class="p-3 bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-emerald-500 rounded-xl transition-all"><i
                                                data-lucide="eye" class="w-4 h-4"></i></button>
                                        <button title="Update Status"
                                            class="p-3 bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-blue-500 rounded-xl transition-all"><i
                                                data-lucide="refresh-cw" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 4: Tidak Lulus -->
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-all">
                                <td class="px-8 py-6">
                                    <div>
                                        <p class="text-sm font-black text-slate-900 dark:text-white">Laila Sari</p>
                                        <p class="text-[10px] font-bold text-slate-400">REG-2024-004</p>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-xs font-bold text-slate-600 dark:text-slate-400 uppercase">TK
                                    Melati</td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg text-[10px] font-black uppercase tracking-tighter">Afirmasi</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-4 py-1.5 bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400 rounded-full text-[10px] font-black uppercase tracking-widest">Tidak
                                        Lulus</span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2 text-slate-400">
                                        <i data-lucide="minus-circle" class="w-4 h-4"></i>
                                        <span class="text-[10px] font-black uppercase">Dibatalkan</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-end gap-2">
                                        <button title="Lihat Detail"
                                            class="p-3 bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-emerald-500 rounded-xl transition-all"><i
                                                data-lucide="eye" class="w-4 h-4"></i></button>
                                        <button title="Update Status"
                                            class="p-3 bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-blue-500 rounded-xl transition-all"><i
                                                data-lucide="refresh-cw" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-8 bg-slate-50/30 dark:bg-slate-900/30 flex justify-between items-center">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Menampilkan 4 dari 248
                        Pendaftar</p>
                    <div class="flex gap-2">
                        <button
                            class="p-3 bg-white dark:bg-slate-800 rounded-xl shadow-sm hover:bg-emerald-500 hover:text-white transition-all"><i
                                data-lucide="chevron-left" class="w-4 h-4"></i></button>
                        <button
                            class="p-3 bg-white dark:bg-slate-800 rounded-xl shadow-sm hover:bg-emerald-500 hover:text-white transition-all"><i
                                data-lucide="chevron-right" class="w-4 h-4"></i></button>
                    </div>
                </div>
            </div>

            <!-- Management Notice Card -->
            <div
                class="p-8 bg-emerald-600 rounded-[3rem] text-white flex flex-col md:flex-row items-center gap-8 shadow-xl shadow-emerald-600/20">
                <div class="w-20 h-20 bg-white/20 rounded-[2rem] flex items-center justify-center shrink-0"><i
                        data-lucide="info" class="w-10 h-10"></i></div>
                <div class="flex-1 text-center md:text-left">
                    <h3 class="font-lexend font-black text-xl">Butuh Bantuan Verifikasi?</h3>
                    <p class="text-sm font-medium opacity-80 mt-1">Pastikan semua dokumen pembayaran telah diverifikasi
                        sebelum mengubah status pendaftar menjadi "Lulus Seleksi".</p>
                </div>
                <button
                    class="px-8 py-4 bg-white text-emerald-700 rounded-2xl text-sm font-black shadow-lg shadow-black/10 hover:bg-slate-50 transition-all">Lihat
                    Panduan Verifikasi</button>
            </div>

    </div>
@endsection
