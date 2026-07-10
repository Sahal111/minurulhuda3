@extends('layouts.guru')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <main class="flex-1 p-6 lg:p-10 custom-scrollbar overflow-y-auto h-screen bg-[#f1f5f9]/50">

        <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-6 mb-12">
            <div class="relative">
                <div class="flex items-center gap-3 mb-2">
                    <span
                        class="px-3 py-1 bg-emerald-600 text-white text-[10px] font-black rounded-full tracking-widest uppercase">Official
                        Authority</span>
                    <span class="h-px w-12 bg-slate-300"></span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Academic Year
                        2025/2026</span>
                </div>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight mb-1">Panel Wali Kelas</h2>
                <p class="text-slate-500 font-medium flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-4 h-4 text-emerald-500"></i>
                    MI Nurul Huda 3 <span class="text-slate-300">•</span> <span class="text-emerald-600 font-bold">Kelas 6A
                        (Unggulan)</span>
                </p>
            </div>

            <div
                class="flex items-center gap-4 bg-white p-2 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-white">
                <div class="flex -space-x-3 ml-2">
                    <img class="w-10 h-10 rounded-full border-4 border-white shadow-sm"
                        src="https://ui-avatars.com/api/?name=Siswa+1&background=random" alt="">
                    <img class="w-10 h-10 rounded-full border-4 border-white shadow-sm"
                        src="https://ui-avatars.com/api/?name=Siswa+2&background=random" alt="">
                    <img class="w-10 h-10 rounded-full border-4 border-white shadow-sm"
                        src="https://ui-avatars.com/api/?name=Siswa+3&background=random" alt="">
                    <div
                        class="w-10 h-10 rounded-full border-4 border-white bg-slate-900 text-[10px] font-black text-white flex items-center justify-center shadow-sm">
                        +29</div>
                </div>
                <button
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-2xl font-black text-xs transition-all flex items-center gap-2 shadow-lg shadow-emerald-200">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    INPUT RAPOR
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <div
                class="relative bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-white group overflow-hidden transition-all hover:scale-[1.02]">
                <div class="relative z-10">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Populasi Kelas</p>
                    <div class="flex items-end gap-2">
                        <h3 class="text-5xl font-black text-slate-900 leading-none">32</h3>
                        <span class="text-xs font-bold text-emerald-600 mb-1">Siswa Aktif</span>
                    </div>
                </div>
                <i data-lucide="users"
                    class="absolute -right-4 -bottom-4 w-24 h-24 text-slate-50 group-hover:text-emerald-50 transition-colors"></i>
            </div>

            <div
                class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-white group overflow-hidden transition-all hover:scale-[1.02]">
                <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">GPA Rata-rata</p>
                <div class="flex items-end gap-2">
                    <h3 class="text-5xl font-black text-slate-900 leading-none">88.2</h3>
                    <div class="flex items-center text-emerald-500 font-black text-[10px] mb-1">
                        <i data-lucide="arrow-up-right" class="w-3 h-3"></i> 4%
                    </div>
                </div>
                <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-indigo-500 w-[88%] rounded-full"></div>
                </div>
            </div>

            <div
                class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-white group overflow-hidden transition-all hover:scale-[1.02]">
                <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Presensi Hari Ini</p>
                <div class="flex items-end gap-2">
                    <h3 class="text-5xl font-black text-emerald-600 leading-none">100<span class="text-2xl">%</span></h3>
                </div>
                <p class="mt-4 text-[10px] font-bold text-slate-400 flex items-center gap-1 uppercase tracking-tighter">
                    <i data-lucide="shield-check" class="w-3 h-3 text-emerald-500"></i> Terverifikasi Sistem
                </p>
            </div>

            <div
                class="bg-slate-900 p-8 rounded-[2.5rem] shadow-2xl shadow-slate-300 border border-slate-800 group overflow-hidden transition-all hover:scale-[1.02]">
                <p class="text-[11px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4">Perlu Atensi</p>
                <div class="flex items-end gap-2">
                    <h3 class="text-5xl font-black text-white leading-none">02</h3>
                    <span class="text-xs font-bold text-rose-500 mb-1">Urgent</span>
                </div>
                <button
                    class="mt-6 w-full py-2 bg-white/10 hover:bg-rose-600 text-white text-[10px] font-black rounded-xl transition-all uppercase tracking-widest">Cek
                    Kasus</button>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-8 mb-12">
            <div
                class="col-span-12 xl:col-span-8 bg-white p-10 rounded-[3rem] shadow-xl shadow-slate-200/50 border border-white">
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <h3 class="text-xl font-black text-slate-900 tracking-tight">Kurva Akademik Kelas</h3>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Januari - Juni 2026</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="p-2 bg-slate-50 text-slate-400 rounded-xl hover:text-emerald-600 transition-all"><i
                                data-lucide="maximize-2" class="w-4 h-4"></i></button>
                        <button class="p-2 bg-slate-50 text-slate-400 rounded-xl hover:text-emerald-600 transition-all"><i
                                data-lucide="more-horizontal" class="w-4 h-4"></i></button>
                    </div>
                </div>
                <div class="h-[350px]">
                    <canvas id="classPerformanceChart"></canvas>
                </div>
            </div>

            <div
                class="col-span-12 xl:col-span-4 bg-emerald-600 p-10 rounded-[3rem] shadow-2xl shadow-emerald-200 relative overflow-hidden">
                <div class="relative z-10 h-full flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-black text-white tracking-tight mb-2">Distribusi Kelulusan</h3>
                        <p class="text-emerald-100/70 text-[10px] font-bold uppercase tracking-[0.2em]">Target Ketuntasan
                            100%</p>
                    </div>

                    <div class="flex flex-col items-center py-8">
                        <div class="relative">
                            <svg class="w-48 h-48">
                                <circle cx="96" cy="96" r="88" stroke="rgba(255,255,255,0.1)"
                                    stroke-width="12" fill="none" />
                                <circle cx="96" cy="96" r="88" stroke="white" stroke-width="12" fill="none"
                                    stroke-dasharray="552" stroke-dashoffset="66" stroke-linecap="round"
                                    class="transition-all duration-1000" />
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-4xl font-black text-white leading-none">88%</span>
                                <span
                                    class="text-[8px] font-black text-emerald-100 uppercase tracking-widest">Completed</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/10 p-4 rounded-2xl backdrop-blur-md border border-white/10">
                        <p class="text-white text-[11px] font-medium leading-relaxed italic text-center">"4 Siswa masih
                            berada di bawah KKM pada mata pelajaran Matematika & IPA."</p>
                    </div>
                </div>
                <i data-lucide="award" class="absolute -right-10 -bottom-10 w-48 h-48 text-white/5 rotate-12"></i>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] shadow-xl shadow-slate-200/50 border border-white overflow-hidden">
            <div class="p-10 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Log Aktivitas & Peringatan</h3>
                <button class="text-xs font-black text-emerald-600 hover:underline tracking-widest uppercase">Lihat Log
                    Lengkap</button>
            </div>
            <div class="p-2">
                <table class="w-full">
                    <tbody class="divide-y divide-slate-50">
                        <tr class="group hover:bg-slate-50 transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center">
                                        <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-800">Siti Aminah (NIS 99283)</p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">Pelanggaran Absensi • 3
                                            Hari Alpa</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button
                                    class="px-6 py-3 bg-slate-900 text-white text-[10px] font-black rounded-xl hover:bg-rose-600 transition-all shadow-lg shadow-slate-200">HUBUNGI
                                    WALI MURID</button>
                            </td>
                        </tr>
                        <tr class="group hover:bg-slate-50 transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
                                        <i data-lucide="trending-down" class="w-6 h-6"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-800">Fajar Ramadhan (NIS 99211)</p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">Penurunan Akademik •
                                            Mapel Matematika</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button
                                    class="px-6 py-3 bg-white border border-slate-200 text-slate-900 text-[10px] font-black rounded-xl hover:bg-slate-900 hover:text-white transition-all">REKAP
                                    NILAI</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    @push('scripts')
        <script src="/js/guru/wali/dashboard.js"></script>
    @endpush

    <style>
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        /* Animation untuk Gauge */
        @keyframes progress {
            from {
                stroke-dashoffset: 552;
            }

            to {
                stroke-dashoffset: 66;
            }
        }
    </style>
@endsection
