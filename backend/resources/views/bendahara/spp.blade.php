@extends('layouts.bendahara')
@section('content')
    <!-- Main Content -->
    <main class="lg:ml-64 min-h-screen p-4 lg:p-8 transition-all">
        <!-- Top Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="flex items-center gap-4">
                <button id="toggleSidebar"
                    class="lg:hidden p-2 bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <div>
                    <h1 class="text-2xl font-bold font-lexend">Pembayaran SPP</h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Kelola tagihan harian dan bulanan siswa.</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="relative">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" placeholder="Cari NIS atau Nama..."
                        class="pl-10 pr-4 py-2.5 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 outline-none text-sm w-full md:w-64 transition-all">
                </div>
                <button id="darkModeToggle"
                    class="p-2.5 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-500 hover:text-emerald-500 transition-colors">
                    <i data-lucide="moon" id="moonIcon" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Table Card -->
        <div
            class="bg-white dark:bg-slate-800 rounded-[2rem] shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div
                class="p-6 border-b border-slate-100 dark:border-slate-700 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 rounded-xl flex items-center justify-center">
                        <i data-lucide="list-checks" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-lexend font-bold text-lg">Daftar Tagihan Maret 2026</h3>
                </div>
                <div class="flex items-center gap-2 overflow-x-auto pb-1 md:pb-0">
                    <button
                        class="whitespace-nowrap px-4 py-2 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 text-xs font-bold border border-emerald-100 dark:border-emerald-800">Semua
                        Kelas</button>
                    <button
                        class="whitespace-nowrap px-4 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 text-slate-500 text-xs font-bold transition-colors">Kelas
                        I</button>
                    <button
                        class="whitespace-nowrap px-4 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 text-slate-500 text-xs font-bold transition-colors">Kelas
                        II</button>
                    <button
                        class="whitespace-nowrap px-4 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 text-slate-500 text-xs font-bold transition-colors">Kelas
                        III</button>
                </div>
            </div>

            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-900/50">
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">NIS
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama
                                Siswa</th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">
                                Kelas</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Bulan
                            </th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">
                                Status</th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        <!-- Item 1 (Lunas) -->
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-5 text-sm font-medium font-lexend">20241001</td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold">
                                        FA</div>
                                    <span class="text-sm font-semibold">Farhan Aditya</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center text-sm">VI - A</td>
                            <td class="px-6 py-5 text-sm font-medium">Maret 2026</td>
                            <td class="px-6 py-5 text-center">
                                <span
                                    class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold rounded-full border border-emerald-200 dark:border-emerald-800 uppercase">Lunas</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <button class="p-2 text-slate-400 hover:text-emerald-500 transition-colors"
                                    title="Lihat Kuitansi">
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Item 2 (Belum Bayar) -->
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-5 text-sm font-medium font-lexend">20241002</td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold">
                                        NS</div>
                                    <span class="text-sm font-semibold">Nadira Syifa</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center text-sm">VI - A</td>
                            <td class="px-6 py-5 text-sm font-medium">Maret 2026</td>
                            <td class="px-6 py-5 text-center">
                                <span
                                    class="px-3 py-1 bg-rose-100 dark:bg-rose-900/40 text-rose-600 dark:text-rose-400 text-[10px] font-bold rounded-full border border-rose-200 dark:border-rose-800 uppercase">Belum
                                    Bayar</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <button onclick="openPaymentModal('Nadira Syifa', '20241002', 'VI - A')"
                                    class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-[10px] font-bold rounded-lg shadow-lg shadow-emerald-500/20 transition-all active:scale-95">Bayar
                                    Sekarang</button>
                            </td>
                        </tr>
                        <!-- Item 3 (Belum Bayar) -->
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-5 text-sm font-medium font-lexend">20241003</td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold">
                                        RK</div>
                                    <span class="text-sm font-semibold">Raka Kurnia</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center text-sm">IV - B</td>
                            <td class="px-6 py-5 text-sm font-medium">Maret 2026</td>
                            <td class="px-6 py-5 text-center">
                                <span
                                    class="px-3 py-1 bg-rose-100 dark:bg-rose-900/40 text-rose-600 dark:text-rose-400 text-[10px] font-bold rounded-full border border-rose-200 dark:border-rose-800 uppercase">Belum
                                    Bayar</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <button onclick="openPaymentModal('Raka Kurnia', '20241003', 'IV - B')"
                                    class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-[10px] font-bold rounded-lg shadow-lg shadow-emerald-500/20 transition-all active:scale-95">Bayar
                                    Sekarang</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal Overlay -->
    <div id="paymentModal"
        class="fixed inset-0 z-[100] flex items-center justify-center opacity-0 pointer-events-none modal-transition">
        <!-- Backdrop -->
        <div onclick="closePaymentModal()" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <!-- Modal Content -->
        <div
            class="relative bg-white dark:bg-slate-800 rounded-[2rem] w-full max-w-lg shadow-2xl scale-95 modal-transition overflow-hidden mx-4">
            <div class="px-8 pt-8 pb-4 flex items-center justify-between border-b border-slate-50 dark:border-slate-700">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 rounded-2xl flex items-center justify-center">
                        <i data-lucide="receipt" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-lexend font-bold text-lg">Input Pembayaran</h4>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Sistem Kasir Pintar
                        </p>
                    </div>
                </div>
                <button onclick="closePaymentModal()"
                    class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200"><i data-lucide="x"
                        class="w-5 h-5"></i></button>
            </div>

            <form id="paymentForm" onsubmit="handlePaymentSubmit(event)" class="p-8 space-y-5">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-tighter">Nama
                            Siswa</label>
                        <input type="text" id="modalStudentName" readonly
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border-none text-sm font-semibold text-slate-500 cursor-not-allowed">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-tighter">Bulan
                            Tagihan</label>
                        <input type="text" value="Maret 2026" readonly
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900 border-none text-sm font-semibold text-slate-500 cursor-not-allowed">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-tighter">Nominal Pembayaran
                        (Rp)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-emerald-600">Rp</span>
                        <input type="number" required placeholder="0"
                            class="w-full pl-12 pr-4 py-3 rounded-xl bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 focus:ring-2 focus:ring-emerald-500 outline-none text-sm font-bold">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-tighter">Metode
                        Pembayaran</label>
                    <select required
                        class="w-full px-4 py-3 rounded-xl bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 focus:ring-2 focus:ring-emerald-500 outline-none text-sm appearance-none">
                        <option value="Tunai">Tunai / Cash</option>
                        <option value="Transfer">Transfer Bank</option>
                        <option value="QRIS">QRIS / E-Wallet</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-tighter">Keterangan
                        Tambahan</label>
                    <textarea rows="2" placeholder="Contoh: Titipan SPP bulan depan..."
                        class="w-full px-4 py-3 rounded-xl bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 focus:ring-2 focus:ring-emerald-500 outline-none text-sm"></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" id="submitBtn"
                        class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-xl shadow-emerald-500/20 flex items-center justify-center gap-3 transition-all">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                        <span>Konfirmasi Pembayaran</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Success -->
    <div id="toast"
        class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[200] flex items-center gap-3 bg-emerald-900 text-white px-6 py-4 rounded-2xl shadow-2xl opacity-0 translate-y-10 transition-all duration-300">
        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
            <i data-lucide="check" class="w-4 h-4"></i>
        </div>
        <div>
            <p class="font-bold text-sm">Pembayaran Berhasil!</p>
            <p class="text-[10px] text-emerald-200">Kuitansi telah tersimpan di sistem.</p>
        </div>
    </div>

    @push('scripts')
        <script src="/js/bendahara/spp.js"></script>
    @endpush
@endsection
