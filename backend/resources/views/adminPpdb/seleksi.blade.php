@extends('layouts.ppdb')

@section('content')
    <main class="flex-1 overflow-y-auto bg-[#FBFBFE]">
        <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200 px-8 py-6 sticky top-0 z-40">
            <div class="max-w-[1600px] mx-auto flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <div
                            class="w-10 h-10 bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-slate-200">
                            <i data-lucide="award" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-2xl font-[1000] text-slate-900 tracking-tight">Selection Engine</h2>
                    </div>
                    <p class="text-sm text-slate-500 font-medium">Penentuan kelulusan berdasarkan standarisasi nilai
                        akumulatif.</p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex -space-x-2 mr-4">
                        <div class="w-8 h-8 rounded-full border-2 border-white bg-emerald-500 flex items-center justify-center text-[10px] font-black text-white"
                            title="Lulus">85</div>
                        <div class="w-8 h-8 rounded-full border-2 border-white bg-amber-500 flex items-center justify-center text-[10px] font-black text-white"
                            title="Cadangan">12</div>
                        <div class="w-8 h-8 rounded-full border-2 border-white bg-rose-500 flex items-center justify-center text-[10px] font-black text-white"
                            title="Tidak Lulus">15</div>
                    </div>
                    <button
                        class="px-6 py-3 bg-white border-2 border-slate-200 text-slate-600 rounded-2xl text-xs font-black uppercase tracking-widest hover:border-emerald-500 hover:text-emerald-600 transition-all">
                        <i data-lucide="refresh-cw" class="w-4 h-4 inline mr-2"></i> Recalculate
                    </button>
                    <button
                        class="px-8 py-3 bg-emerald-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition-all flex items-center gap-2">
                        <i data-lucide="send" class="w-4 h-4"></i> Publish Hasil
                    </button>
                </div>
            </div>
        </header>

        <div class="max-w-[1600px] mx-auto p-8 space-y-8">

            <div class="grid grid-cols-12 gap-6">
                <div
                    class="col-span-12 lg:col-span-8 bg-white p-6 rounded-[2.5rem] border border-slate-200/60 shadow-sm flex flex-wrap gap-4 items-center">
                    <div class="flex-1 min-w-[200px] relative">
                        <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" placeholder="Cari pendaftar..."
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl text-sm font-bold focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all">
                    </div>
                    <select
                        class="px-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-black text-slate-500 uppercase tracking-widest outline-none cursor-pointer">
                        <option>Semua Jalur</option>
                        <option>Reguler</option>
                        <option>Prestasi</option>
                    </select>
                    <select
                        class="px-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-black text-slate-500 uppercase tracking-widest outline-none cursor-pointer">
                        <option>Urutkan: Total Nilai</option>
                        <option>Urutkan: Ranking</option>
                        <option>Urutkan: Nama</option>
                    </select>
                </div>

                <div
                    class="col-span-12 lg:col-span-4 bg-emerald-900 rounded-[2.5rem] p-6 text-white flex items-center justify-between relative overflow-hidden shadow-2xl shadow-emerald-200">
                    <div class="relative z-10">
                        <p class="text-[10px] font-black text-emerald-400 uppercase tracking-[0.2em] mb-1">Kuota Tersedia
                        </p>
                        <h4 class="text-3xl font-black">120 <span
                                class="text-sm font-medium text-emerald-500 tracking-normal">/ 200 Siswa</span></h4>
                    </div>
                    <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center relative z-10">
                        <i data-lucide="users" class="w-8 h-8 text-emerald-400"></i>
                    </div>
                    <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-emerald-500/20 rounded-full blur-3xl"></div>
                </div>
            </div>

            <div class="bg-white rounded-[3rem] shadow-sm border border-slate-200/60 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th
                                class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center w-24">
                                Rank</th>
                            <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Nama
                                Lengkap</th>
                            <th
                                class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">
                                Nilai Tes</th>
                            <th
                                class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">
                                Administrasi</th>
                            <th
                                class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">
                                Total Score</th>
                            <th
                                class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">
                                Status</th>
                            <th
                                class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">
                                Keputusan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">

                        <tr class="group hover:bg-slate-50 transition-all duration-300">
                            <td class="px-10 py-6 text-center">
                                <span
                                    class="inline-flex items-center justify-center w-10 h-10 bg-amber-100 text-amber-700 rounded-xl font-[1000] text-lg shadow-sm">1</span>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-slate-100 overflow-hidden border-2 border-white shadow-sm">
                                        <img src="https://ui-avatars.com/api/?name=Zulfikar+Ali&background=random"
                                            alt="">
                                    </div>
                                    <div>
                                        <p class="font-black text-slate-800 tracking-tight">Zulfikar Ali</p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">REG-2024091</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex flex-col items-center gap-1">
                                    <span class="text-sm font-black text-slate-700">98.5</span>
                                    <div class="w-16 h-1 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="w-[98%] h-full bg-emerald-500 rounded-full"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex flex-col items-center gap-1">
                                    <span class="text-sm font-black text-slate-700">100</span>
                                    <div class="w-16 h-1 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="w-full h-full bg-blue-500 rounded-full"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span class="text-lg font-[1000] text-slate-900">99.25</span>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span
                                    class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-lg text-[9px] font-black uppercase tracking-widest">Lulus</span>
                            </td>
                            <td class="px-10 py-6">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        class="px-4 py-2 bg-emerald-50 text-emerald-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all">Lulus</button>
                                    <button
                                        class="px-4 py-2 bg-amber-50 text-amber-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-500 hover:text-white transition-all">Cadangan</button>
                                    <button
                                        class="px-4 py-2 bg-rose-50 text-rose-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all">Gagal</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="group hover:bg-slate-50 transition-all duration-300">
                            <td class="px-10 py-6 text-center">
                                <span
                                    class="inline-flex items-center justify-center w-10 h-10 bg-slate-100 text-slate-500 rounded-xl font-[1000] text-lg">2</span>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-slate-100 overflow-hidden border-2 border-white shadow-sm">
                                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random"
                                            alt="">
                                    </div>
                                    <div>
                                        <p class="font-black text-slate-800 tracking-tight">Budi Santoso</p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">REG-2024102</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-center text-sm font-black text-slate-700">85.0</td>
                            <td class="px-6 py-6 text-center text-sm font-black text-slate-700">90.0</td>
                            <td class="px-6 py-6 text-center text-lg font-[1000] text-slate-900">87.5</td>
                            <td class="px-6 py-6 text-center">
                                <span
                                    class="inline-block px-4 py-1.5 bg-amber-100 text-amber-700 rounded-lg text-[9px] font-black uppercase tracking-widest">Cadangan</span>
                            </td>
                            <td class="px-10 py-6">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        class="px-4 py-2 bg-emerald-50 text-emerald-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all">Lulus</button>
                                    <button
                                        class="px-4 py-2 bg-amber-50 text-amber-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-500 hover:text-white transition-all">Cadangan</button>
                                    <button
                                        class="px-4 py-2 bg-rose-50 text-rose-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all">Gagal</button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    @push('scripts')
        <script src="/js/admin-ppdb/seleksi.js"></script>
    @endpush
@endsection
