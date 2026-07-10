@extends('layouts.bendahara')
@section('content')
    <main class="lg:ml-64 min-h-screen p-4 md:p-8 transition-all duration-300">
        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold font-lexend text-slate-800 dark:text-white">Manajemen Transaksi</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 text-pretty">Catat dan pantau arus kas masuk dan keluar
                    secara manual.</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openModal()"
                    class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-lg shadow-emerald-200 dark:shadow-none transition-all active:scale-95">
                    <i data-lucide="plus-circle" class="w-5 h-5"></i>
                    <span>Tambah Transaksi</span>
                </button>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total Pemasukan (Bulan
                            Ini)</p>
                        <h3 class="text-2xl font-bold text-emerald-600 font-lexend">Rp 45.250.000</h3>
                    </div>
                    <div
                        class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 rounded-full flex items-center justify-center text-emerald-600">
                        <i data-lucide="trending-up" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total Pengeluaran
                            (Bulan Ini)</p>
                        <h3 class="text-2xl font-bold text-red-500 font-lexend">Rp 12.800.000</h3>
                    </div>
                    <div
                        class="w-12 h-12 bg-red-50 dark:bg-red-900/30 rounded-full flex items-center justify-center text-red-500">
                        <i data-lucide="trending-down" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Saldo Netto</p>
                        <h3 class="text-2xl font-bold text-blue-600 font-lexend">Rp 32.450.000</h3>
                    </div>
                    <div
                        class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-full flex items-center justify-center text-blue-600">
                        <i data-lucide="wallet" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="p-5 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                <div class="flex flex-wrap items-center gap-4">
                    <div class="relative flex-1 min-w-[200px]">
                        <i data-lucide="calendar"
                            class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="date"
                            class="w-full pl-10 pr-4 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    </div>
                    <div class="relative flex-1 min-w-[200px]">
                        <i data-lucide="filter" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <select
                            class="w-full pl-10 pr-4 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 outline-none appearance-none transition-all">
                            <option value="">Semua Jenis Transaksi</option>
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <button
                        class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-colors">
                        Reset Filter
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">Tanggal</th>
                            <th class="px-6 py-4 font-semibold">Jenis</th>
                            <th class="px-6 py-4 font-semibold">Kategori</th>
                            <th class="px-6 py-4 font-semibold">Nominal</th>
                            <th class="px-6 py-4 font-semibold">Keterangan</th>
                            <th class="px-6 py-4 font-semibold text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-sm">
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-700 dark:text-slate-200">12 Feb 2026</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                                    Pemasukan
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">Infaq Masjid</td>
                            <td class="px-6 py-4 font-bold text-slate-700 dark:text-slate-200">Rp 1.500.000</td>
                            <td class="px-6 py-4 text-slate-500 italic">Sumbangan Hamba Allah</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button
                                        class="p-1.5 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors"
                                        title="Edit">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </button>
                                    <button
                                        class="p-1.5 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                                        title="Hapus">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-700 dark:text-slate-200">10 Feb 2026</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                    Pengeluaran
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">Listrik & Air</td>
                            <td class="px-6 py-4 font-bold text-slate-700 dark:text-slate-200">Rp 850.000</td>
                            <td class="px-6 py-4 text-slate-500 italic">Tagihan PLN Januari</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button
                                        class="p-1.5 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </button>
                                    <button
                                        class="p-1.5 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <span class="text-xs text-slate-500">Menampilkan 1-10 dari 120 transaksi</span>
                <div class="flex gap-2">
                    <button
                        class="px-3 py-1 text-xs font-medium border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 disabled:opacity-50">Prev</button>
                    <button class="px-3 py-1 text-xs font-medium bg-emerald-600 text-white rounded-lg">1</button>
                    <button
                        class="px-3 py-1 text-xs font-medium border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700">2</button>
                    <button
                        class="px-3 py-1 text-xs font-medium border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700">Next</button>
                </div>
            </div>
        </div>
    </main>

    <div id="modalOverlay"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div
            class="bg-white dark:bg-slate-800 w-full max-w-lg rounded-2xl shadow-2xl scale-95 transition-all duration-300 overflow-hidden">
            <div
                class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between bg-emerald-800">
                <h3 class="text-white font-lexend font-bold">Input Transaksi Baru</h3>
                <button onclick="closeModal()" class="text-emerald-200 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1.5">Jenis
                            Transaksi</label>
                        <select
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1.5">Kategori</label>
                        <input type="text" placeholder="Contoh: Operasional"
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1.5">Nominal
                        (Rp)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-medium">Rp</span>
                        <input type="number" placeholder="0"
                            class="w-full pl-12 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl font-bold text-lg focus:ring-2 focus:ring-emerald-500 outline-none transition-all text-emerald-600">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1.5">Tanggal
                        Transaksi</label>
                    <input type="date"
                        class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                </div>

                <div>
                    <label
                        class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1.5">Keterangan</label>
                    <textarea rows="3" placeholder="Tambahkan catatan tambahan..."
                        class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all resize-none"></textarea>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="closeModal()"
                        class="flex-1 py-3 px-4 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-200 rounded-xl font-semibold hover:bg-slate-200 transition-all">Batal</button>
                    <button type="button" id="saveBtn" onclick="handleSave()"
                        class="flex-1 py-3 px-4 bg-emerald-600 text-white rounded-xl font-semibold shadow-lg shadow-emerald-200 dark:shadow-none hover:bg-emerald-700 transition-all flex items-center justify-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

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
