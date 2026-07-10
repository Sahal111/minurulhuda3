@extends('layouts.guru')

@section('content')
    <main class="flex-1 p-6 lg:p-10 custom-scrollbar overflow-y-auto h-screen bg-[#f8fafc] relative">

        <div class="mb-8">
            <div class="flex items-center gap-2 text-emerald-600 font-bold text-[10px] uppercase tracking-[0.2em] mb-2">
                <i data-lucide="database" class="w-4 h-4"></i>
                Student Information System
            </div>
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Database Siswa Kelas 6A</h2>
                <div class="flex items-center gap-3">
                    <button
                        class="bg-white border border-slate-200 p-3 rounded-xl hover:bg-slate-50 transition-all shadow-sm">
                        <i data-lucide="printer" class="w-5 h-5 text-slate-500"></i>
                    </button>
                    <button
                        class="bg-emerald-600 text-white px-6 py-3 rounded-xl font-black text-xs flex items-center gap-2 shadow-lg shadow-emerald-200">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        TAMBAH SISWA
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 mb-8 overflow-x-auto no-scrollbar">
            <div class="flex flex-col lg:flex-row items-center gap-4 min-w-max lg:min-w-0">
                <div class="relative w-full lg:w-72">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="text" placeholder="Cari nama atau NIS..."
                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-transparent rounded-xl focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/5 transition-all text-xs font-bold text-slate-600">
                </div>

                <select
                    class="px-4 py-3 bg-slate-50 border border-transparent rounded-xl text-xs font-bold text-slate-600 focus:bg-white transition-all outline-none">
                    <option value="">Semua Akademik</option>
                    <option value="tuntas">Tuntas KKM</option>
                    <option value="remedial">Perlu Remedial</option>
                </select>

                <select
                    class="px-4 py-3 bg-slate-50 border border-transparent rounded-xl text-xs font-bold text-slate-600 focus:bg-white transition-all outline-none">
                    <option value="">Status Pembayaran</option>
                    <option value="lunas">Lunas SPP</option>
                    <option value="tunggakan">Ada Tunggakan</option>
                </select>

                <div class="flex bg-slate-50 p-1 rounded-xl">
                    <button
                        class="px-4 py-2 text-[10px] font-black bg-white shadow-sm rounded-lg text-emerald-600">SEMUA</button>
                    <button class="px-4 py-2 text-[10px] font-black text-slate-400">L</button>
                    <button class="px-4 py-2 text-[10px] font-black text-slate-400">P</button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-white overflow-hidden mb-10">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Siswa</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                NIS</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                WA Orang Tua</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                Akademik</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                Pembayaran</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @for ($i = 1; $i <= 8; $i++)
                            <tr class="group hover:bg-emerald-50/30 transition-all">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <img src="https://ui-avatars.com/api/?name=Siswa+{{ $i }}&background=random"
                                                class="w-12 h-12 rounded-xl shadow-md border-2 border-white" alt="">
                                            <span
                                                class="absolute -top-1 -right-1 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full shadow-sm"></span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-800">Ahmad Rafliansyah</p>
                                            <p class="text-[10px] font-bold text-slate-400 italic uppercase">Laki-laki</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-center text-xs font-bold text-slate-500">
                                    2209384{{ $i }}</td>
                                <td class="px-8 py-5 text-center">
                                    <a href="#"
                                        class="text-xs font-black text-emerald-600 hover:underline flex items-center justify-center gap-1">
                                        <i data-lucide="phone" class="w-3 h-3"></i> 0812-3456-{{ $i }}
                                    </a>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span
                                        class="px-3 py-1 bg-emerald-100 text-emerald-600 text-[9px] font-black rounded-lg uppercase">TUNTAS</span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span
                                        class="px-3 py-1 bg-rose-50 text-rose-500 text-[9px] font-black rounded-lg uppercase">TUNGGAKAN</span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <button onclick="toggleDrawer()"
                                        class="p-3 bg-slate-50 text-slate-400 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-sm">
                                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                    </button>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <div class="p-8 bg-slate-50/50 flex items-center justify-between">
                <p class="text-[10px] font-black text-slate-400 uppercase">Showing 8 of 32 Students</p>
                <div class="flex gap-2">
                    <button class="p-2 bg-white border border-slate-200 rounded-lg text-slate-400 opacity-50"><i
                            data-lucide="arrow-left" class="w-4 h-4"></i></button>
                    <button class="p-2 bg-emerald-600 text-white rounded-lg"><i data-lucide="arrow-right"
                            class="w-4 h-4"></i></button>
                </div>
            </div>
        </div>

        <div id="detailDrawer"
            class="fixed top-0 right-0 h-screen w-full lg:w-[450px] bg-white shadow-[-20px_0_50px_rgba(0,0,0,0.05)] z-[100] translate-x-full transition-transform duration-500 ease-in-out border-l border-slate-100 overflow-y-auto">
            <div class="p-8">
                <div class="flex items-center justify-between mb-8">
                    <button onclick="toggleDrawer()" class="p-2 hover:bg-slate-100 rounded-xl transition-all">
                        <i data-lucide="x" class="w-6 h-6 text-slate-400"></i>
                    </button>
                    <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Student Profile
                        Details</span>
                </div>

                <div class="text-center mb-10">
                    <img src="https://ui-avatars.com/api/?name=Ahmad+Rafliansyah&size=120"
                        class="w-24 h-24 rounded-[2rem] mx-auto mb-4 border-4 border-emerald-50 shadow-xl" alt="">
                    <h3 class="text-xl font-black text-slate-900 leading-tight">Ahmad Rafliansyah</h3>
                    <p class="text-xs font-bold text-slate-400">NIS: 22093841</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-10">
                    <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-100">
                        <p class="text-[9px] font-black text-emerald-600 uppercase mb-1">Rata-rata Nilai</p>
                        <p class="text-xl font-black text-emerald-700">89.2</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-2xl border border-blue-100">
                        <p class="text-[9px] font-black text-blue-600 uppercase mb-1">Peringkat</p>
                        <p class="text-xl font-black text-blue-700">#04 <span class="text-[10px]">/ 32</span></p>
                    </div>
                </div>

                <div class="space-y-4 mb-10">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="sticky-note" class="w-4 h-4 text-emerald-500"></i> Catatan Wali
                    </h4>
                    <div
                        class="p-5 bg-slate-50 rounded-2xl border border-slate-100 italic text-xs text-slate-500 leading-relaxed">
                        "Siswa menunjukkan minat tinggi pada pelajaran Matematika. Perlu pendampingan lebih di bagian
                        hafalan Al-Qur'an (Tahfidz)."
                    </div>
                    <button
                        class="w-full py-3 border-2 border-dashed border-slate-200 rounded-2xl text-[10px] font-black text-slate-400 hover:border-emerald-500 hover:text-emerald-600 transition-all">
                        EDIT CATATAN
                    </button>
                </div>

                <div class="space-y-4">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="award" class="w-4 h-4 text-emerald-500"></i> Nilai Utama
                    </h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between p-4 bg-white border border-slate-100 rounded-xl">
                            <span class="text-xs font-bold text-slate-700">Matematika</span>
                            <span class="text-xs font-black text-emerald-600">92</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-white border border-slate-100 rounded-xl">
                            <span class="text-xs font-bold text-slate-700">B. Indonesia</span>
                            <span class="text-xs font-black text-emerald-600">88</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-white border border-slate-100 rounded-xl">
                            <span class="text-xs font-bold text-slate-700">IPA</span>
                            <span class="text-xs font-black text-amber-600">75</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    @push('scripts')
        <script src="/js/guru/wali/data-siswa.js"></script>
    @endpush

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
@endsection
