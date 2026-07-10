@extends('layouts.bendahara')
@section('content')
    <main class="lg:ml-64 min-h-screen p-4 md:p-8 transition-all duration-300">
        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold font-lexend text-slate-800 dark:text-white">Rekap Tunggakan Siswa</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Daftar siswa yang memiliki kewajiban pembayaran yang
                    belum terselesaikan.</p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="flex items-center gap-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-200 px-4 py-2.5 rounded-xl font-medium shadow-sm hover:bg-slate-50 transition-all">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    <span>Cetak Rekap</span>
                </button>
                <button
                    class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-lg shadow-red-200 dark:shadow-none transition-all active:scale-95">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    <span>Blast Reminder (All)</span>
                </button>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-900/30 p-5 rounded-2xl">
                <p class="text-[10px] font-bold text-red-600 dark:text-red-400 uppercase tracking-wider">Total Nominal
                    Tunggakan</p>
                <h3 class="text-xl font-bold text-red-700 dark:text-red-300 font-lexend">Rp 12.450.000</h3>
            </div>
            <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 p-5 rounded-2xl">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Siswa Menunggak</p>
                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 font-lexend">42 Siswa</h3>
            </div>
            <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 p-5 rounded-2xl">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kelas Paling Banyak</p>
                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 font-lexend">Kelas 4-B</h3>
            </div>
            <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 p-5 rounded-2xl">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tertua</p>
                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 font-lexend">5 Bulan</h3>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div
                class="p-5 border-b border-slate-100 dark:border-slate-700 flex flex-col md:flex-row gap-4 justify-between items-center">
                <div class="relative w-full md:w-96">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="text" placeholder="Cari nama siswa atau kelas..."
                        class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-red-500 transition-all">
                </div>
                <div class="flex gap-2 w-full md:w-auto">
                    <select
                        class="flex-1 md:w-40 px-3 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm outline-none">
                        <option>Semua Kelas</option>
                        <option>Kelas 1</option>
                        <option>Kelas 2</option>
                    </select>
                    <select
                        class="flex-1 md:w-40 px-3 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm outline-none">
                        <option>Urutkan Terbesar</option>
                        <option>Urutkan Terlama</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="bg-slate-50/50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">Nama Siswa</th>
                            <th class="px-6 py-4 font-semibold">Kelas</th>
                            <th class="px-6 py-4 font-semibold">Bulan Belum Bayar</th>
                            <th class="px-6 py-4 font-semibold">Total Tunggakan</th>
                            <th class="px-6 py-4 font-semibold text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-sm">
                        <tr class="hover:bg-red-50/30 dark:hover:bg-red-900/10 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center font-bold text-slate-500 text-xs">
                                        AA</div>
                                    <div class="font-medium text-slate-700 dark:text-slate-200"> Ahmad Alfian</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">4-A</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    <span
                                        class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded text-[10px] font-medium">Januari</span>
                                    <span
                                        class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded text-[10px] font-medium">Februari</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right md:text-left">
                                <span
                                    class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300">
                                    Rp 500.000
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="showToast('Reminder WhatsApp terkirim ke Wali Murid Ahmad Alfian')"
                                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-xs font-medium transition-all">
                                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                    WhatsApp
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-red-50/30 dark:hover:bg-red-900/10 transition-colors">
                            <td class="px-6 py-4 text-slate-700 dark:text-slate-200 font-medium">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center font-bold text-slate-500 text-xs">
                                        SF</div>
                                    <div class="font-medium text-slate-700 dark:text-slate-200"> Siti Fatimah</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">2-C</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    <span
                                        class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded text-[10px] font-medium">Desember</span>
                                    <span
                                        class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded text-[10px] font-medium">Januari</span>
                                    <span
                                        class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded text-[10px] font-medium">Februari</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300">
                                    Rp 750.000
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="showToast('Reminder WhatsApp terkirim ke Wali Murid Siti Fatimah')"
                                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-xs font-medium transition-all">
                                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                    WhatsApp
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="toast"
        class="fixed bottom-8 right-8 z-[100] transform translate-y-20 opacity-0 transition-all duration-500">
        <div class="bg-slate-900 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
            <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center">
                <i data-lucide="check" class="w-5 h-5 text-white"></i>
            </div>
            <div>
                <p id="toastMsg" class="font-medium text-sm"></p>
            </div>
        </div>
    </div>
@endsection
