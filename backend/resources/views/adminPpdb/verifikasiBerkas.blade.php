@extends('layouts.ppdb')

@section('content')
    <main class="flex-1 overflow-y-auto bg-[#F8FAFC]">
        <header class="bg-white border-b border-slate-200 px-8 py-6 sticky top-0 z-40">
            <div class="max-w-[1600px] mx-auto flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <div class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></div>
                        <h2 class="text-2xl font-[1000] text-slate-900 tracking-tight">Antrean Verifikasi</h2>
                    </div>
                    <p class="text-sm text-slate-500 font-medium">Prioritaskan validasi dokumen untuk mempercepat proses
                        registrasi.</p>
                </div>

                <div class="flex items-center gap-4">
                    <div class="bg-slate-50 px-6 py-3 rounded-2xl border border-slate-100 flex flex-col items-center">
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Menunggu</span>
                        <span class="text-xl font-black text-amber-600">24</span>
                    </div>
                    <div class="bg-slate-50 px-6 py-3 rounded-2xl border border-slate-100 flex flex-col items-center">
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Revisi</span>
                        <span class="text-xl font-black text-rose-500">12</span>
                    </div>
                    <div class="hidden lg:block h-10 w-[1px] bg-slate-200 mx-2"></div>
                    <button
                        class="px-6 py-3 bg-slate-900 text-white rounded-2xl text-sm font-black uppercase tracking-widest hover:bg-emerald-600 transition-all shadow-xl shadow-slate-200">
                        Refresh Queue
                    </button>
                </div>
            </div>
        </header>

        <div class="max-w-[1600px] mx-auto p-8 space-y-8">

            <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-slate-200/60">
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-[320px] relative group">
                        <i data-lucide="search"
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                        <input type="text" placeholder="Cari nama atau nomor pendaftaran..."
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-emerald-500 outline-none transition-all font-bold text-sm">
                    </div>

                    <div class="relative min-w-[160px]">
                        <select
                            class="w-full px-5 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-emerald-500 outline-none font-black text-[10px] text-slate-600 uppercase tracking-widest appearance-none cursor-pointer">
                            <option value="">Semua Prioritas</option>
                            <option>🔴 Tinggi (Lama Antre)</option>
                            <option>🟡 Normal</option>
                            <option>🔵 Baru Masuk</option>
                        </select>
                        <i data-lucide="chevron-down"
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>

                    <div class="relative min-w-[160px]">
                        <select
                            class="w-full px-5 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-emerald-500 outline-none font-black text-[10px] text-slate-600 uppercase tracking-widest appearance-none cursor-pointer">
                            <option value="">Status Berkas</option>
                            <option>Lengkap (4/4)</option>
                            <option>Belum Lengkap</option>
                            <option>Perlu Revisi</option>
                        </select>
                        <i data-lucide="chevron-down"
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>

                    <button
                        class="w-12 h-12 flex items-center justify-center bg-slate-100 text-slate-500 rounded-2xl hover:bg-rose-50 hover:text-rose-600 transition-all shadow-sm"
                        title="Reset Filter">
                        <i data-lucide="rotate-ccw" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-[3rem] shadow-sm border border-slate-200/60 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Calon
                                Siswa</th>
                            <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Kesiapan
                                Berkas</th>
                            <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Waktu
                                Registrasi</th>
                            <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status
                            </th>
                            <th
                                class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">
                                Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">

                        <tr class="group hover:bg-slate-50 transition-all duration-300">
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-5">
                                    <div class="relative">
                                        <div
                                            class="w-14 h-14 rounded-[1.2rem] bg-slate-100 border-2 border-white shadow-sm overflow-hidden">
                                            <img src="https://ui-avatars.com/api/?name=Muhammad+Akhdan&background=0D9488&color=fff"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div
                                            class="absolute -right-1 -top-1 w-4 h-4 bg-rose-500 border-2 border-white rounded-full">
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-black text-slate-800 tracking-tight text-lg">Muhammad Akhdan</p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">ID: NH3-2024001 • Jalur
                                            Reguler</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between w-40">
                                        <span class="text-[10px] font-black text-slate-800 uppercase tracking-tighter">4
                                            dari 4 Berkas</span>
                                        <span class="text-[10px] font-black text-emerald-600 italic">100%</span>
                                    </div>
                                    <div class="w-40 h-2 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="w-full h-full bg-emerald-500 rounded-full"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-black text-slate-700">Hari ini</span>
                                    <span class="text-[10px] font-bold text-slate-400 italic uppercase">14:20 WIB</span>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <span
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 text-amber-700 rounded-xl text-[10px] font-black uppercase tracking-widest border border-amber-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Waiting Review
                                </span>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <a href="{{ route('adminPpdb.verifikasiDetail') }}"
                                    class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.15em] hover:bg-emerald-600 transition-all shadow-xl shadow-slate-200 group-hover:scale-105 active:scale-95">
                                    Inspeksi Berkas
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </td>
                        </tr>

                        <tr class="group hover:bg-slate-50 transition-all duration-300">
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-5">
                                    <div
                                        class="w-14 h-14 rounded-[1.2rem] bg-slate-100 border-2 border-white shadow-sm overflow-hidden">
                                        <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=F59E0B&color=fff"
                                            class="w-full h-full object-cover opacity-60">
                                    </div>
                                    <div>
                                        <p class="font-black text-slate-800 tracking-tight text-lg">Siti Aminah</p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">ID: NH3-2024002 • Jalur
                                            Prestasi</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between w-40">
                                        <span
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-tighter text-rose-500">2
                                            dari 4 Berkas</span>
                                        <span class="text-[10px] font-black text-rose-500 italic">50%</span>
                                    </div>
                                    <div class="w-40 h-2 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="w-1/2 h-full bg-rose-500 rounded-full"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-black text-slate-700">Kemarin</span>
                                    <span class="text-[10px] font-bold text-slate-400 italic uppercase">09:15 WIB</span>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <span
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-rose-50 text-rose-700 rounded-xl text-[10px] font-black uppercase tracking-widest border border-rose-100">
                                    Perlu Revisi
                                </span>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <a href="#"
                                    class="inline-flex items-center gap-3 px-8 py-4 bg-white border-2 border-slate-200 text-slate-400 rounded-2xl text-[10px] font-black uppercase tracking-[0.15em] hover:border-emerald-500 hover:text-emerald-600 transition-all">
                                    Lihat Detail
                                    <i data-lucide="external-link" class="w-4 h-4"></i>
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <div class="px-10 py-8 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Page 1 of 12 — Results: 240
                    </p>
                    <div class="flex gap-2">
                        <button
                            class="w-12 h-12 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-100 transition-all"><i
                                data-lucide="chevron-left" class="w-5 h-5"></i></button>
                        <button
                            class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center font-black text-xs shadow-lg shadow-emerald-200">1</button>
                        <button
                            class="w-12 h-12 bg-white border border-slate-200 rounded-xl flex items-center justify-center font-black text-xs text-slate-500 hover:bg-slate-100 transition-all">2</button>
                        <button
                            class="w-12 h-12 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-100 transition-all"><i
                                data-lucide="chevron-right" class="w-5 h-5"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script src="/js/admin-ppdb/verifikasi-berkas.js"></script>
    @endpush
@endsection
