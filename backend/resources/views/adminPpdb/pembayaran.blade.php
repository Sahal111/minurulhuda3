@extends('layouts.ppdb')

@section('content')
    <main class="flex-1 overflow-y-auto bg-[#F8FAFC]">
        <header class="bg-white border-b border-slate-200 px-8 py-6 sticky top-0 z-40">
            <div class="max-w-[1600px] mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-[1000] text-slate-900 tracking-tight">Manajemen Pembayaran</h2>
                    <p class="text-sm text-slate-500 font-medium italic">Otoritasi transaksi pendaftaran dan daftar ulang
                        pendaftar</p>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-[10px] font-black text-slate-600 uppercase tracking-[0.15em] hover:bg-slate-50 transition-all shadow-sm">
                        <i data-lucide="download" class="w-4 h-4 inline mr-2"></i> Export Laporan
                    </button>
                </div>
            </div>
        </header>

        <div class="max-w-[1600px] mx-auto p-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-[2.5rem] border border-slate-200 shadow-sm flex items-center gap-5">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center"><i
                            data-lucide="ticket" class="w-7 h-7"></i></div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Formulir</p>
                        <p class="text-xl font-[1000] text-slate-900">Rp 45.2M</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2.5rem] border border-slate-200 shadow-sm flex items-center gap-5">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center"><i
                            data-lucide="user-check" class="w-7 h-7"></i></div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Daftar Ulang</p>
                        <p class="text-xl font-[1000] text-slate-900">Rp 128.0M</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2.5rem] border border-slate-200 shadow-sm flex items-center gap-5">
                    <div class="w-14 h-14 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center"><i
                            data-lucide="clock-alert" class="w-7 h-7"></i></div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Belum Bayar</p>
                        <p class="text-xl font-[1000] text-slate-900">42 <span
                                class="text-xs font-bold text-slate-400 tracking-normal">Siswa</span></p>
                    </div>
                </div>

                <div
                    class="bg-slate-900 p-6 rounded-[2.5rem] shadow-2xl shadow-slate-200 flex items-center gap-5 relative overflow-hidden text-white">
                    <div
                        class="w-14 h-14 bg-white/10 text-emerald-400 rounded-2xl flex items-center justify-center relative z-10">
                        <i data-lucide="wallet" class="w-7 h-7"></i></div>
                    <div class="relative z-10">
                        <p class="text-[9px] font-black text-white/40 uppercase tracking-widest">Total Pemasukan</p>
                        <p class="text-xl font-[1000]">Rp 173.2M</p>
                    </div>
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl"></div>
                </div>
            </div>

            <div class="bg-white rounded-[3rem] shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="px-10 py-6 border-b border-slate-50 flex flex-wrap items-center gap-4 bg-slate-50/30">
                    <div class="flex-1 min-w-[300px] relative">
                        <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" placeholder="Cari pendaftar..."
                            class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold outline-none focus:ring-4 focus:ring-emerald-500/5 transition-all">
                    </div>
                    <select
                        class="px-4 py-3 bg-white border border-slate-200 rounded-xl text-[10px] font-black text-slate-500 uppercase tracking-widest outline-none">
                        <option>Jenis Bayar</option>
                        <option>Formulir</option>
                        <option>Daftar Ulang</option>
                    </select>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                                <th class="px-10 py-6">Pendaftar</th>
                                <th class="px-6 py-6 text-center">Jenis</th>
                                <th class="px-6 py-6 text-center">Nominal</th>
                                <th class="px-6 py-6 text-center">Status</th>
                                <th class="px-6 py-6 text-center">Tanggal</th>
                                <th class="px-10 py-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 font-bold">
                            <tr class="group hover:bg-slate-50 transition-all">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-[10px] font-black">
                                            MA</div>
                                        <div>
                                            <p class="text-slate-800 tracking-tight">Muhammad Akhdan</p>
                                            <p class="text-[9px] text-slate-400 font-bold uppercase">REG-2024001</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span
                                        class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-blue-100">Formulir</span>
                                </td>
                                <td class="px-6 py-6 text-center text-slate-800 text-sm">Rp 250.000</td>
                                <td class="px-6 py-6 text-center">
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-lg text-[9px] font-black uppercase">
                                        <i data-lucide="check-circle" class="w-3 h-3"></i> Lunas
                                    </span>
                                </td>
                                <td class="px-6 py-6 text-center text-[11px] text-slate-400 italic">12 Feb, 09:30</td>
                                <td class="px-10 py-6 text-right">
                                    <button
                                        onclick="openModal('Muhammad Akhdan', 'REG-2024001', 'Formulir', 'Rp 250.000', '12 Feb 2026, 09:30', 'https://via.placeholder.com/600x800?text=Bukti+Transfer+Formulir')"
                                        class="p-2 text-slate-400 hover:text-emerald-600 transition-colors">
                                        <i data-lucide="file-search" class="w-5 h-5"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr class="bg-amber-50/20 group hover:bg-amber-50 transition-all">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-[10px] font-black">
                                            SA</div>
                                        <div>
                                            <p class="text-slate-800 tracking-tight font-black italic">Siti Aminah</p>
                                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">
                                                REG-2024002</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span
                                        class="px-3 py-1 bg-purple-50 text-purple-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-purple-100">Daftar
                                        Ulang</span>
                                </td>
                                <td class="px-6 py-6 text-center text-slate-900 font-[1000] text-sm">Rp 3.500.000</td>
                                <td class="px-6 py-6 text-center">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg text-[9px] font-black uppercase animate-pulse">
                                        Waiting
                                    </span>
                                </td>
                                <td class="px-6 py-6 text-center text-[11px] text-slate-400 italic font-medium">Hari ini,
                                    10:15</td>
                                <td class="px-10 py-6 text-right">
                                    <button
                                        onclick="openModal('Siti Aminah', 'REG-2024002', 'Daftar Ulang', 'Rp 3.500.000', 'Hari ini, 10:15', 'https://via.placeholder.com/600x800?text=Bukti+Daftar+Ulang')"
                                        class="px-6 py-2.5 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 transition-all shadow-lg shadow-slate-200">
                                        Verifikasi
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div id="modal-verification" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
        <div class="relative bg-white w-full max-w-4xl rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all scale-95 opacity-0 duration-300"
            id="modal-card">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-7 bg-slate-100 p-8 flex flex-col border-r border-slate-100">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Digital Receipt</h4>
                        <button
                            class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-slate-300 hover:text-rose-500 transition-colors shadow-sm"
                            onclick="closeModal()">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div class="flex-1 bg-white rounded-3xl shadow-inner overflow-hidden relative group cursor-zoom-in">
                        <img id="m-img" src=""
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-5 p-10 flex flex-col justify-between">
                    <div>
                        <span id="m-type"
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-[9px] font-black rounded-lg uppercase tracking-widest">Payment</span>
                        <h3 id="m-name" class="text-2xl font-[1000] text-slate-900 tracking-tight mt-4">Pendaftar</h3>
                        <p id="m-id" class="text-xs font-bold text-slate-400 tracking-widest mb-8">ID REG: 000</p>

                        <div class="space-y-4 mb-10">
                            <div class="flex justify-between items-center pb-3 border-b border-slate-50">
                                <span class="text-[10px] font-black text-slate-400 uppercase">Nominal</span>
                                <span id="m-nominal" class="text-lg font-[1000] text-emerald-600 italic">Rp 0</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-black text-slate-400 uppercase">Tanggal</span>
                                <span id="m-date" class="text-xs font-black text-slate-700">00 Jan 2026</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Catatan
                                Verifikasi</label>
                            <textarea
                                class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl p-4 text-xs font-bold outline-none focus:border-emerald-500 transition-all resize-none"
                                rows="3" placeholder="Tulis catatan jika ditolak..."></textarea>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-8">
                        <button
                            class="flex-1 py-4 bg-emerald-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-emerald-100 hover:bg-emerald-700 transition-all active:scale-95">Setujui</button>
                        <button
                            class="px-6 py-4 bg-rose-50 text-rose-600 rounded-2xl text-[10px] font-black uppercase hover:bg-rose-100 transition-all">Tolak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="/js/admin-ppdb/pembayaran.js"></script>
    @endpush
@endsection
