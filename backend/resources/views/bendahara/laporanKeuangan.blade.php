@extends('layouts.bendahara')
@section('content')
    <!-- Content -->
    <main class="lg:ml-64 min-h-screen p-4 md:p-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-lexend font-bold text-slate-800 dark:text-white">Laporan Keuangan</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Rekapitulasi data keuangan madrasah secara
                    periodik.</p>
            </div>
            <div class="flex items-center gap-2 no-print">
                <button
                    class="p-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 rounded-xl hover:bg-slate-50 transition-all"
                    title="Export Excel">
                    <i data-lucide="file-spreadsheet" class="w-5 h-5"></i>
                </button>
                <button
                    class="p-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 rounded-xl hover:bg-slate-50 transition-all"
                    title="Export PDF">
                    <i data-lucide="file-type-2" class="w-5 h-5"></i>
                </button>
                <button onclick="window.print()"
                    class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-emerald-600/20 transition-all active:scale-95">
                    <i data-lucide="printer" class="w-5 h-5"></i>
                    <span class="font-medium">Cetak Laporan</span>
                </button>
            </div>
        </div>

        <!-- Filter Card (Hidden on Print) -->
        <div
            class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700 mb-8 no-print">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Bulan</label>
                    <select
                        class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-600 dark:bg-slate-900 text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5" selected>Mei</option>
                        <option value="6">Juni</option>
                        <!-- ... bulan lainnya -->
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tahun</label>
                    <select
                        class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-600 dark:bg-slate-900 text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                        <option value="2024" selected>2024</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Jenis Transaksi</label>
                    <select
                        class="w-full px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-600 dark:bg-slate-900 text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                        <option value="">Semua Data</option>
                        <option value="pemasukan">Pemasukan Saja</option>
                        <option value="pengeluaran">Pengeluaran Saja</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button
                        class="w-full bg-emerald-50 dark:bg-emerald-900/20 hover:bg-emerald-100 dark:hover:bg-emerald-900/40 text-emerald-700 dark:text-emerald-400 py-2 rounded-lg font-bold transition-colors">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Summary Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div
                class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity">
                    <i data-lucide="trending-up" class="w-32 h-32 text-emerald-600"></i>
                </div>
                <p class="text-xs font-bold text-slate-500 uppercase mb-1">Total Pemasukan</p>
                <h3 class="text-2xl font-lexend font-bold text-emerald-600">Rp 25.450.000</h3>
                <div class="mt-4 flex items-center text-[10px] text-emerald-500 font-medium">
                    <i data-lucide="arrow-up-right" class="w-3 h-3 mr-1"></i>
                    <span>+12% dari bulan lalu</span>
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity">
                    <i data-lucide="trending-down" class="w-32 h-32 text-rose-600"></i>
                </div>
                <p class="text-xs font-bold text-slate-500 uppercase mb-1">Total Pengeluaran</p>
                <h3 class="text-2xl font-lexend font-bold text-rose-600">Rp 12.100.000</h3>
                <div class="mt-4 flex items-center text-[10px] text-rose-500 font-medium">
                    <i data-lucide="arrow-down-right" class="w-3 h-3 mr-1"></i>
                    <span>-5% dari bulan lalu</span>
                </div>
            </div>
            <div class="bg-emerald-600 p-6 rounded-2xl shadow-lg shadow-emerald-600/20 relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i data-lucide="wallet" class="w-32 h-32 text-white"></i>
                </div>
                <p class="text-xs font-bold text-emerald-100 uppercase mb-1">Saldo Akhir</p>
                <h3 class="text-2xl font-lexend font-bold text-white">Rp 13.350.000</h3>
                <p class="mt-4 text-[10px] text-emerald-200">Periode Mei 2024</p>
            </div>
        </div>

        <!-- Recap Table -->
        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
                <h3 class="font-lexend font-bold text-slate-800 dark:text-white">Rekapitulasi Transaksi</h3>
                <span class="text-xs text-slate-400 font-medium">Menampilkan 48 data</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 text-xs uppercase font-bold tracking-wider">
                            <th class="px-6 py-4">Tgl</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Keterangan</th>
                            <th class="px-6 py-4 text-right">Debit (In)</th>
                            <th class="px-6 py-4 text-right">Kredit (Out)</th>
                            <th class="px-6 py-4 text-right">Saldo</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-sm">
                        <!-- Row 1 -->
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30">
                            <td class="px-6 py-4 whitespace-nowrap">01/05</td>
                            <td class="px-6 py-4"><span class="text-[10px] font-bold text-slate-400 uppercase">Saldo
                                    Awal</span></td>
                            <td class="px-6 py-4 font-medium italic">Sisa periode sebelumnya</td>
                            <td class="px-6 py-4 text-right text-emerald-600 font-medium">-</td>
                            <td class="px-6 py-4 text-right text-rose-600 font-medium">-</td>
                            <td class="px-6 py-4 text-right font-bold">Rp 5.000.000</td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30">
                            <td class="px-6 py-4 whitespace-nowrap">10/05</td>
                            <td class="px-6 py-4"><span
                                    class="px-2 py-1 bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 rounded text-[10px] font-bold">SPP</span>
                            </td>
                            <td class="px-6 py-4 font-medium">SPP Kelas 1-6</td>
                            <td class="px-6 py-4 text-right text-emerald-600 font-bold">Rp 10.450.000</td>
                            <td class="px-6 py-4 text-right text-rose-600 font-medium">-</td>
                            <td class="px-6 py-4 text-right font-bold">Rp 15.450.000</td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30">
                            <td class="px-6 py-4 whitespace-nowrap">15/05</td>
                            <td class="px-6 py-4"><span
                                    class="px-2 py-1 bg-purple-50 text-purple-600 dark:bg-purple-900/20 dark:text-purple-400 rounded text-[10px] font-bold">GURU</span>
                            </td>
                            <td class="px-6 py-4 font-medium">Honorarium Pengajar Mei</td>
                            <td class="px-6 py-4 text-right text-emerald-600 font-medium">-</td>
                            <td class="px-6 py-4 text-right text-rose-600 font-bold">Rp 8.000.000</td>
                            <td class="px-6 py-4 text-right font-bold">Rp 7.450.000</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 font-bold text-slate-700 dark:text-white">
                            <td colspan="3" class="px-6 py-4 text-right uppercase text-xs">Total Mutasi & Saldo
                                Akhir</td>
                            <td class="px-6 py-4 text-right text-emerald-600">Rp 10.450.000</td>
                            <td class="px-6 py-4 text-right text-rose-600">Rp 8.000.000</td>
                            <td class="px-6 py-4 text-right bg-emerald-100 dark:bg-emerald-900/40">Rp 13.350.000</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Footer for Print -->
        <div class="hidden print:block mt-12">
            <div class="flex justify-between items-start">
                <div class="text-center">
                    <p class="text-sm mb-16 font-medium">Mengetahui,<br>Kepala Madrasah</p>
                    <p class="font-bold underline">H. Ahmad Fauzi, S.Pd.I</p>
                    <p class="text-xs text-slate-500">NIP. 19750812 200501 1 002</p>
                </div>
                <div class="text-center">
                    <p class="text-sm mb-16 font-medium">Sidoarjo, 31 Mei 2024<br>Bendahara</p>
                    <p class="font-bold underline">Siti Aminah, S.E</p>
                    <p class="text-xs text-slate-500">NIY. 201205 089</p>
                </div>
            </div>
        </div>
    </main>


@endsection

