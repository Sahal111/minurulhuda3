@extends('layouts.guru')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <main class="flex-1 p-6 lg:p-10 custom-scrollbar overflow-y-auto h-screen bg-[#f8fafc]">

        <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-8 mb-10">
            <div class="space-y-1">
                <div class="flex items-center gap-2 text-emerald-600 font-bold text-[10px] uppercase tracking-[0.2em]">
                    <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                    Academic Performance Control
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Rekapitulasi Nilai Kolektif</h2>
                <p class="text-slate-500 font-medium italic">Kelas 6A • Tahun Ajaran 2025/2026</p>
            </div>

            <div
                class="bg-white p-3 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-white flex flex-wrap items-center gap-3">
                <div class="relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="text" placeholder="Cari siswa..."
                        class="pl-9 pr-4 py-2 bg-slate-50 border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-emerald-500 transition-all w-48">
                </div>
                <select class="px-4 py-2 bg-slate-50 border-none rounded-xl text-xs font-black text-slate-700 outline-none">
                    <option>Semua Mapel</option>
                    <option>Matematika</option>
                    <option>IPA</option>
                </select>
                <div class="h-8 w-px bg-slate-100 hidden md:block"></div>
                <div class="flex bg-slate-50 p-1 rounded-xl">
                    <button class="px-4 py-2 text-[10px] font-black bg-white shadow-sm rounded-lg text-emerald-600">PER
                        MAPEL</button>
                    <button class="px-4 py-2 text-[10px] font-black text-slate-400">KOLEKTIF</button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Rata-rata Kelas</p>
                <h3 class="text-4xl font-black text-slate-900">86.4</h3>
                <div class="mt-4 flex items-center gap-2 text-emerald-600 text-[10px] font-black italic">
                    <i data-lucide="trending-up" class="w-3 h-3"></i> +2.1 Poin Semester Ini
                </div>
                <div
                    class="absolute -right-4 -bottom-4 opacity-5 text-slate-900 group-hover:scale-110 transition-transform">
                    <i data-lucide="line-chart" class="w-20 h-20"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nilai Tertinggi</p>
                <h3 class="text-4xl font-black text-indigo-600">98.0</h3>
                <p class="mt-4 text-[10px] font-bold text-slate-500 uppercase tracking-tighter">Ahmad Rafliansyah</p>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nilai Terendah</p>
                <h3 class="text-4xl font-black text-rose-500">64.5</h3>
                <p class="mt-4 text-[10px] font-bold text-slate-500 uppercase tracking-tighter italic">2 Siswa di bawah KKM
                </p>
            </div>

            <div class="bg-emerald-600 p-6 rounded-3xl shadow-lg shadow-emerald-100 relative overflow-hidden">
                <p class="text-emerald-100 text-[10px] font-black uppercase tracking-widest mb-1">Ketuntasan %</p>
                <h3 class="text-4xl font-black text-white">92.5%</h3>
                <div class="mt-4 h-1.5 w-full bg-emerald-800/30 rounded-full overflow-hidden">
                    <div class="h-full bg-white w-[92%] rounded-full"></div>
                </div>
                <i data-lucide="check-circle" class="absolute -right-2 -bottom-2 w-16 h-16 text-white/10"></i>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-8 mb-10">
            <div class="col-span-12 xl:col-span-7 bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-8">Top 5 Performa Siswa</h3>
                <div class="h-64">
                    <canvas id="topStudentChart"></canvas>
                </div>
            </div>
            <div
                class="col-span-12 xl:col-span-5 bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col justify-center">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-8 text-center">Distribusi Nilai
                </h3>
                <div class="h-56">
                    <canvas id="gradeDistChart"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] shadow-xl shadow-slate-200/50 border border-white overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Ranking & Detail Capaian</h3>
                <button class="text-[10px] font-black text-emerald-600 uppercase tracking-widest hover:underline">Download
                    Report Card</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Rank</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Siswa
                            </th>
                            <th
                                class="px-4 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Harian</th>
                            <th
                                class="px-4 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                UTS</th>
                            <th
                                class="px-4 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                UAS</th>
                            <th
                                class="px-8 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Nilai Akhir</th>
                            <th
                                class="px-8 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Predikat</th>
                            <th
                                class="px-8 py-5 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @for ($i = 1; $i <= 5; $i++)
                            <tr class="group hover:bg-slate-50 transition-all cursor-pointer">
                                <td class="px-8 py-5">
                                    <div
                                        class="w-10 h-10 rounded-full {{ $i <= 3 ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center font-black text-xs shadow-md">
                                        {{ $i }}
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <p class="text-sm font-black text-slate-800">Muhammad Zaki Fauzan</p>
                                    <p class="text-[10px] font-bold text-slate-400 italic">NIS: 220938{{ $i }}
                                    </p>
                                </td>
                                <td class="px-4 py-5 text-center text-xs font-bold text-slate-600">92</td>
                                <td class="px-4 py-5 text-center text-xs font-bold text-slate-600">88</td>
                                <td class="px-4 py-5 text-center text-xs font-bold text-slate-600">95</td>
                                <td class="px-8 py-5 text-center">
                                    <span class="text-sm font-black text-slate-900 tracking-tight">91.6</span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span class="text-xs font-black text-emerald-600">A+</span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <span
                                        class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[9px] font-black rounded-lg border border-emerald-100">TUNTAS</span>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    @push('scripts')
        <script src="/js/guru/wali/rekap-nilai.js"></script>
    @endpush
@endsection
