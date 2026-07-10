@extends('layouts.ppdb')

@section('content')
    <main class="flex-1 overflow-y-auto bg-[#F8FAFC]">
        <header class="bg-white border-b border-slate-200 px-8 py-6 sticky top-0 z-30">
            <div class="max-w-[1600px] mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-[1000] text-slate-900 tracking-tight">Manajemen Pendaftar</h2>
                    <p class="text-sm text-slate-500 font-medium">Total <span class="text-emerald-600 font-bold">1,284</span>
                        siswa terdaftar pada sistem</p>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-50 transition-all">
                        <i data-lucide="download" class="w-4 h-4"></i> Export .xlsx
                    </button>
                    <a href="{{ route('adminPpdb.tambahPendaftar') }}"
                        class="flex items-center gap-2 px-6 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-100 transition-all">
                        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Manual
                    </a>
                </div>
            </div>
        </header>

        <div class="max-w-[1600px] mx-auto p-8 space-y-6">

            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-200/60">
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-[300px] relative group">
                        <i data-lucide="search"
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                        <input type="text" placeholder="Cari Nama, No. Pendaftaran atau NIK..."
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl focus:bg-white focus:border-emerald-500 outline-none transition-all font-medium text-sm">
                    </div>

                    <select
                        class="px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl focus:border-emerald-500 outline-none font-bold text-xs text-slate-600 appearance-none min-w-[140px]">
                        <option value="">Semua Jalur</option>
                        <option>Reguler</option>
                        <option>Prestasi</option>
                        <option>Afirmasi</option>
                    </select>

                    <select
                        class="px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl focus:border-emerald-500 outline-none font-bold text-xs text-slate-600 appearance-none min-w-[140px]">
                        <option value="">Semua Status</option>
                        <option>Pending</option>
                        <option>Terverifikasi</option>
                        <option>Ditolak</option>
                    </select>

                    <select
                        class="px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl focus:border-emerald-500 outline-none font-bold text-xs text-slate-600 appearance-none min-w-[140px]">
                        <option value="">Gelombang</option>
                        <option>Gelombang 1</option>
                        <option>Gelombang 2</option>
                    </select>

                    <div class="relative">
                        <input type="date"
                            class="px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl focus:border-emerald-500 outline-none font-bold text-[11px] text-slate-600">
                    </div>

                    <button class="p-3 bg-slate-900 text-white rounded-xl hover:bg-emerald-600 transition-all shadow-md">
                        <i data-lucide="filter" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">No.
                                    Pendaftaran</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">Nama
                                    Calon Siswa</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">
                                    Jalur & Asal Sekolah</th>
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] text-center">
                                    Status</th>
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] text-center">
                                    Pembayaran</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <tr class="group hover:bg-slate-50/80 transition-all cursor-default">
                                <td class="px-8 py-6">
                                    <span class="font-black text-slate-800 tracking-tighter">NH3-2024001</span>
                                    <p class="text-[10px] text-slate-400 font-bold">12 Feb 2024, 09:12</p>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-black text-xs border-2 border-white shadow-sm">
                                            MA
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 leading-tight">Muhammad Akhdan</p>
                                            <p class="text-[11px] text-slate-400 font-medium">320128xxxxxxx001</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <span
                                        class="text-xs font-black text-slate-700 uppercase tracking-tighter block">Reguler</span>
                                    <span class="text-[11px] text-slate-400 italic">TK Nurul Huda 1</span>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-lg text-[9px] font-black uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Terverifikasi
                                    </span>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="text-[10px] font-black text-slate-800 italic">LUNAS</span>
                                        <div class="w-16 h-1 bg-emerald-500 rounded-full mt-1"></div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button
                                            class="p-2 bg-white border border-slate-200 rounded-lg text-slate-400 hover:text-blue-600 hover:border-blue-200 transition-all shadow-sm"
                                            title="Detail">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </button>
                                        <button
                                            class="p-2 bg-white border border-slate-200 rounded-lg text-slate-400 hover:text-emerald-600 hover:border-emerald-200 transition-all shadow-sm"
                                            title="Verifikasi">
                                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                                        </button>
                                        <div class="relative group/menu">
                                            <button
                                                class="p-2 bg-white border border-slate-200 rounded-lg text-slate-400 hover:bg-slate-50 transition-all shadow-sm">
                                                <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                            </button>
                                            <div
                                                class="absolute right-0 top-full mt-2 w-40 bg-white rounded-xl shadow-xl border border-slate-100 hidden group-hover/menu:block z-50 overflow-hidden">
                                                <button
                                                    class="w-full px-4 py-2.5 text-left text-xs font-bold text-slate-600 hover:bg-slate-50 flex items-center gap-2">
                                                    <i data-lucide="edit-3" class="w-3.5 h-3.5 text-slate-400"></i> Edit
                                                    Data
                                                </button>
                                                <button
                                                    class="w-full px-4 py-2.5 text-left text-xs font-bold text-rose-600 hover:bg-rose-50 flex items-center gap-2">
                                                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5 text-rose-400"></i> Ubah
                                                    Status
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr class="group hover:bg-slate-50/80 transition-all cursor-default">
                                <td class="px-8 py-6">
                                    <span class="font-black text-slate-800 tracking-tighter">NH3-2024002</span>
                                    <p class="text-[10px] text-slate-400 font-bold">12 Feb 2024, 10:45</p>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center font-black text-xs border-2 border-white shadow-sm">
                                            SA
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 leading-tight">Siti Aminah</p>
                                            <p class="text-[11px] text-slate-400 font-medium">320128xxxxxxx024</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <span
                                        class="text-xs font-black text-slate-700 uppercase tracking-tighter block">Prestasi</span>
                                    <span class="text-[11px] text-slate-400 italic">RA Perwanida II</span>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg text-[9px] font-black uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Pending
                                    </span>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="text-[10px] font-black text-slate-400 italic">BELUM BAYAR</span>
                                        <div class="w-16 h-1 bg-slate-100 rounded-full mt-1 overflow-hidden">
                                            <div class="w-1/3 h-full bg-amber-400"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button
                                            class="p-2 bg-white border border-slate-200 rounded-lg text-slate-400 hover:text-blue-600 transition-all shadow-sm">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </button>
                                        <button
                                            class="p-2 bg-white border border-slate-200 rounded-lg text-slate-400 hover:text-emerald-600 transition-all shadow-sm">
                                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                                        </button>
                                        <button
                                            class="p-2 bg-white border border-slate-200 rounded-lg text-slate-400 hover:bg-slate-50 transition-all shadow-sm">
                                            <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="px-8 py-5 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
                    <p class="text-xs font-bold text-slate-500">Menampilkan <span class="text-slate-800">10</span> dari
                        <span class="text-slate-800">1,284</span> pendaftar</p>
                    <div class="flex gap-2">
                        <button
                            class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl text-slate-400 hover:bg-slate-50 transition-all">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </button>
                        <button
                            class="w-10 h-10 flex items-center justify-center bg-emerald-600 text-white rounded-xl font-bold text-xs shadow-lg shadow-emerald-100">1</button>
                        <button
                            class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-600 hover:bg-slate-50">2</button>
                        <button
                            class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-600 hover:bg-slate-50">3</button>
                        <button
                            class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl text-slate-400 hover:bg-slate-50 transition-all">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        /* Custom style for clean table interaction */
        .group:hover .group-hover\:opacity-100 {
            opacity: 1;
        }
    </style>

    @push('scripts')
        <script src="/js/admin-ppdb/data-pendaftar.js"></script>
    @endpush
@endsection
