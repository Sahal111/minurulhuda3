@extends('layouts.ortu')

@section('content')
    <main class="flex-1 lg:ml-72 p-4 lg:p-8 bg-slate-50/50" x-data="{ showModal: false, selectedBill: '' }">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Administrasi Keuangan</h2>
                <p class="text-slate-500 text-sm flex items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4 text-emerald-500"></i>
                    Pantau tagihan dan riwayat pembayaran Ananda secara real-time.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="p-2.5 bg-white border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 transition-all shadow-sm">
                    <i data-lucide="printer" class="w-5 h-5"></i>
                </button>
                <button
                    class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold shadow-lg shadow-emerald-200 transition-all flex items-center gap-2">
                    <i data-lucide="help-circle" class="w-4 h-4"></i> Bantuan Kasir
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div
                class="relative overflow-hidden bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 group">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-150 transition-transform duration-700">
                </div>
                <div class="relative">
                    <div class="inline-flex p-3 bg-emerald-500 text-white rounded-2xl mb-4 shadow-lg shadow-emerald-100">
                        <i data-lucide="check-check" class="w-6 h-6"></i>
                    </div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Status Mei 2024</p>
                    <h3 class="text-2xl font-black text-slate-800 uppercase">Lunas</h3>
                </div>
            </div>

            <div
                class="relative overflow-hidden bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 group">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-rose-50 rounded-full group-hover:scale-150 transition-transform duration-700">
                </div>
                <div class="relative">
                    <div class="inline-flex p-3 bg-rose-500 text-white rounded-2xl mb-4 shadow-lg shadow-rose-100">
                        <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                    </div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Tunggakan</p>
                    <h3 class="text-2xl font-black text-rose-600">Rp 500.000</h3>
                </div>
            </div>

            <div
                class="relative overflow-hidden bg-gradient-to-br from-slate-800 to-slate-900 p-6 rounded-[2rem] shadow-xl shadow-slate-300">
                <div class="relative z-10 text-white">
                    <div class="inline-flex p-3 bg-white/10 backdrop-blur-md text-white rounded-2xl mb-4">
                        <i data-lucide="wallet" class="w-6 h-6"></i>
                    </div>
                    <p class="text-xs font-medium text-slate-300 uppercase tracking-widest mb-1">Total Terbayar</p>
                    <h3 class="text-2xl font-black italic">Rp 4.250.000</h3>
                </div>
                <div class="absolute right-0 bottom-0 opacity-10">
                    <i data-lucide="trending-up" class="w-32 h-32 -mb-8 -mr-8"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between">
                <h3 class="font-bold text-lg text-slate-800">Riwayat Transaksi</h3>
                <div class="flex gap-2">
                    <select
                        class="text-sm border-none bg-slate-100 rounded-lg px-3 py-1.5 focus:ring-2 focus:ring-emerald-500">
                        <option>2023/2024</option>
                        <option>2022/2023</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto px-4 pb-4">
                <table class="w-full">
                    <thead>
                        <tr class="text-slate-400 text-[11px] uppercase tracking-[0.2em] font-bold">
                            <th class="px-6 py-5 text-left">Deskripsi Tagihan</th>
                            <th class="px-6 py-5 text-left">Nominal</th>
                            <th class="px-6 py-5 text-left">Status</th>
                            <th class="px-6 py-5 text-left">Metode</th>
                            <th class="px-6 py-5 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="group hover:bg-slate-50/80 transition-all cursor-default">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 font-bold text-xs uppercase group-hover:scale-110 transition-transform">
                                        Mei</div>
                                    <div>
                                        <p class="font-bold text-slate-700">SPP Bulanan - Mei</p>
                                        <p class="text-[10px] text-slate-400 italic">Dibayar: 02/05/2024</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 font-bold text-slate-700">Rp 250.000</td>
                            <td class="px-6 py-5">
                                <span
                                    class="px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-emerald-100">Paid</span>
                            </td>
                            <td
                                class="px-6 py-5 text-xs text-slate-500 font-medium italic underline decoration-emerald-200">
                                Transfer Mandiri</td>
                            <td class="px-6 py-5 text-right">
                                <button
                                    class="p-2 bg-slate-50 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all"><i
                                        data-lucide="download" class="w-4 h-4"></i></button>
                            </td>
                        </tr>

                        <tr class="group hover:bg-rose-50/30 transition-all cursor-default">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center text-rose-600 font-bold text-xs uppercase group-hover:scale-110 transition-transform">
                                        WD</div>
                                    <div>
                                        <p class="font-bold text-slate-700">Biaya Wisuda & Album</p>
                                        <p class="text-[10px] text-rose-400 font-medium">Jatuh tempo: 30/06/2024</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 font-bold text-slate-700">Rp 500.000</td>
                            <td class="px-6 py-5">
                                <span
                                    class="px-3 py-1.5 bg-rose-50 text-rose-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-rose-100 animate-pulse">Unpaid</span>
                            </td>
                            <td class="px-6 py-5 text-xs text-slate-400 italic">-</td>
                            <td class="px-6 py-5 text-right">
                                <button @click="showModal = true; selectedBill = 'Biaya Wisuda'"
                                    class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-lg shadow-emerald-100 transition-all hover:-translate-y-0.5">
                                    Bayar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <template x-if="showModal">
            <div class="fixed inset-0 z-[60] flex items-center justify-center p-4">
                <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showModal = false"></div>

                <div class="relative bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl overflow-hidden animate-[modal-pop_0.3s_ease-out]"
                    @click.stop>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-8">
                            <div>
                                <h4 class="text-2xl font-black text-slate-800">Pilih Metode</h4>
                                <p class="text-slate-500 text-sm">Tagihan: <span class="font-bold text-emerald-600"
                                        x-text="selectedBill"></span></p>
                            </div>
                            <button @click="showModal = false"
                                class="p-2 bg-slate-100 rounded-full hover:bg-rose-50 hover:text-rose-500 transition-colors">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div
                                class="p-4 border-2 border-slate-100 rounded-2xl hover:border-emerald-500 hover:bg-emerald-50/50 cursor-pointer transition-all group">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-8 bg-slate-200 rounded-md flex items-center justify-center font-bold text-[10px] text-slate-500">
                                            BANK</div>
                                        <div>
                                            <p class="font-bold text-slate-700">Virtual Account</p>
                                            <p class="text-xs text-slate-400">Verifikasi Otomatis</p>
                                        </div>
                                    </div>
                                    <i data-lucide="chevron-right"
                                        class="w-5 h-5 text-slate-300 group-hover:text-emerald-500 group-hover:translate-x-1 transition-all"></i>
                                </div>
                            </div>

                            <div
                                class="p-4 border-2 border-slate-100 rounded-2xl hover:border-emerald-500 hover:bg-emerald-50/50 cursor-pointer transition-all group">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-8 bg-emerald-100 rounded-md flex items-center justify-center font-bold text-[10px] text-emerald-600 italic">
                                            QRIS</div>
                                        <div>
                                            <p class="font-bold text-slate-700">QRIS / E-Wallet</p>
                                            <p class="text-xs text-slate-400">Gopay, OVO, Dana</p>
                                        </div>
                                    </div>
                                    <i data-lucide="chevron-right"
                                        class="w-5 h-5 text-slate-300 group-hover:text-emerald-500 group-hover:translate-x-1 transition-all"></i>
                                </div>
                            </div>
                        </div>

                        <div
                            class="mt-8 p-6 bg-slate-50 rounded-[1.5rem] border border-dashed border-slate-200 text-center">
                            <p class="text-xs text-slate-400 mb-1 font-medium">Total yang harus dibayar</p>
                            <p class="text-3xl font-black text-slate-800">Rp 500.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </template>

    </main>

    <style>
        @keyframes modal-pop {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(10px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
    </style>

    @push('scripts')
        <script src="/js/ortu/pembayaran.js"></script>
    @endpush
@endsection
