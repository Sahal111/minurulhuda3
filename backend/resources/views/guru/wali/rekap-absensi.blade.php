@extends('layouts.guru')

@section('content')
    <main class="flex-1 p-6 lg:p-10 custom-scrollbar overflow-y-auto h-screen bg-[#f1f5f9]/50">

        <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-6 mb-12">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <div class="flex -space-x-2">
                        <span
                            class="w-8 h-8 rounded-full border-2 border-white bg-emerald-500 flex items-center justify-center text-white text-[10px] font-black">6A</span>
                        <span
                            class="w-8 h-8 rounded-full border-2 border-white bg-slate-800 flex items-center justify-center text-white text-[10px] font-black">MI</span>
                    </div>
                    <span class="h-px w-8 bg-slate-300"></span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Attendance Analytics
                        v2.0</span>
                </div>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight">Intelligence Presensi</h2>
                <p class="text-slate-500 font-medium mt-1">Monitor perilaku kehadiran siswa secara real-time.</p>
            </div>

            <div
                class="flex items-center gap-3 bg-white p-2 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-white">
                <div class="flex px-4 py-2 border-r border-slate-100">
                    <div class="text-right mr-3">
                        <p class="text-[8px] font-black text-slate-400 uppercase leading-none">Periode</p>
                        <p class="text-[11px] font-black text-slate-900">Februari 2026</p>
                    </div>
                    <button class="p-2 hover:bg-slate-50 rounded-lg"><i data-lucide="calendar"
                            class="w-4 h-4 text-emerald-600"></i></button>
                </div>
                <button
                    class="bg-slate-900 hover:bg-emerald-600 text-white px-8 py-3 rounded-2xl font-black text-xs transition-all flex items-center gap-3 shadow-lg shadow-slate-200">
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    EXPORT PDF/XLS
                </button>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-8 mb-12">

            <div
                class="col-span-12 lg:col-span-4 bg-emerald-600 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-2xl shadow-emerald-200">
                <div class="relative z-10">
                    <p class="text-emerald-100 text-[10px] font-black uppercase tracking-[0.2em] mb-8">Rata-rata Kehadiran
                    </p>
                    <h3 class="text-7xl font-black tracking-tighter mb-2">98.2<span class="text-2xl opacity-50">%</span>
                    </h3>
                    <div class="flex items-center gap-2 text-emerald-100 text-xs font-bold">
                        <span class="px-2 py-0.5 bg-white/20 rounded-md text-[10px]">+1.2%</span>
                        <span>dari bulan lalu</span>
                    </div>
                </div>
                <i data-lucide="trending-up" class="absolute -right-4 -bottom-4 w-32 h-32 text-white/10 -rotate-12"></i>
            </div>

            <div class="col-span-12 lg:col-span-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-white">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Total Sakit</p>
                    <h4 class="text-4xl font-black text-slate-900">08</h4>
                    <p class="text-[10px] font-bold text-blue-500 mt-2 uppercase tracking-tighter">Dalam observasi medis</p>
                </div>
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-white">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Total Izin</p>
                    <h4 class="text-4xl font-black text-slate-900">05</h4>
                    <p class="text-[10px] font-bold text-slate-400 mt-2 uppercase tracking-tighter">Keperluan keluarga</p>
                </div>
                <div class="bg-rose-50 p-8 rounded-[2.5rem] border border-rose-100">
                    <p class="text-[10px] font-black text-rose-400 uppercase tracking-widest mb-6">Total Alfa</p>
                    <h4 class="text-4xl font-black text-rose-600">03</h4>
                    <p
                        class="text-[10px] font-black text-rose-600/50 mt-2 uppercase tracking-tighter flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i> Tindakan diperlukan
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white p-10 rounded-[3rem] shadow-xl shadow-slate-200/50 border border-white mb-12">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Peta Pola Kehadiran</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Heatmap Distribusi Bulanan</p>
                </div>
                <div class="flex gap-1.5 p-1 bg-slate-50 rounded-xl">
                    <button
                        class="px-4 py-2 text-[10px] font-black bg-white shadow-sm rounded-lg text-slate-900">M1</button>
                    <button class="px-4 py-2 text-[10px] font-black text-slate-400">M2</button>
                    <button class="px-4 py-2 text-[10px] font-black text-slate-400">M3</button>
                    <button class="px-4 py-2 text-[10px] font-black text-slate-400">M4</button>
                </div>
            </div>

            <div class="grid grid-cols-5 lg:grid-cols-10 gap-4">
                @for ($i = 1; $i <= 20; $i++)
                    <div class="group relative">
                        <div
                            class="aspect-video lg:aspect-square rounded-2xl flex flex-col items-center justify-center transition-all duration-300 cursor-help {{ $i == 12 || $i == 15 ? 'bg-rose-500 shadow-lg shadow-rose-200' : 'bg-emerald-50 hover:bg-emerald-100' }}">
                            <span
                                class="text-[10px] font-black {{ $i == 12 || $i == 15 ? 'text-white' : 'text-emerald-700' }}">{{ $i }}
                                Feb</span>
                        </div>
                        <div
                            class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 w-32 p-2 bg-slate-900 rounded-lg text-[8px] text-white opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-20 text-center">
                            {{ $i == 12 || $i == 15 ? '3 Siswa Alfa' : 'Kehadiran 100%' }}
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="bg-white rounded-[3rem] shadow-xl shadow-slate-200/50 border border-white overflow-hidden">
            <div class="p-10 border-b border-slate-50 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Daftar Detail Presensi</h3>
                <div class="flex items-center gap-3">
                    <div class="flex bg-slate-100 p-1 rounded-xl">
                        <button
                            class="px-4 py-2 text-[10px] font-black bg-white rounded-lg text-slate-900 shadow-sm">SEMUA</button>
                        <button class="px-4 py-2 text-[10px] font-black text-slate-400 uppercase">Resiko Tinggi</button>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Siswa &
                                NIS</th>
                            <th
                                class="px-6 py-6 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Hadir</th>
                            <th
                                class="px-6 py-6 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                I/S</th>
                            <th
                                class="px-6 py-6 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Alfa</th>
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status
                                Intelligence</th>
                            <th class="px-10 py-6 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="group hover:bg-rose-50/30 transition-all cursor-pointer">
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-4">
                                    <img src="https://ui-avatars.com/api/?name=Zaki+Fauzan&background=f43f5e&color=fff"
                                        class="w-10 h-10 rounded-xl shadow-sm border-2 border-white" alt="">
                                    <div>
                                        <p class="text-sm font-black text-slate-800">M. Zaki Fauzan</p>
                                        <p class="text-[10px] font-bold text-slate-400 tracking-tighter uppercase italic">
                                            NIS: 22091102</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-center font-black text-slate-400">12</td>
                            <td class="px-6 py-6 text-center font-black text-slate-400">02</td>
                            <td class="px-6 py-6 text-center font-black text-rose-600">04</td>
                            <td class="px-10 py-6">
                                <div class="flex flex-col gap-1">
                                    <span
                                        class="flex items-center gap-1.5 text-[9px] font-black text-rose-500 uppercase italic">
                                        <span class="w-1.5 h-1.5 bg-rose-500 rounded-full animate-pulse"></span> Critical
                                        Risk
                                    </span>
                                    <div class="w-32 h-1 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="w-[60%] h-full bg-rose-500"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <button
                                    class="p-3 bg-white border border-slate-100 text-slate-400 rounded-xl hover:bg-slate-900 hover:text-white transition-all shadow-sm">
                                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>

                        <tr class="group hover:bg-emerald-50/30 transition-all cursor-pointer">
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-4">
                                    <img src="https://ui-avatars.com/api/?name=Siti+Zahra&background=10b981&color=fff"
                                        class="w-10 h-10 rounded-xl shadow-sm border-2 border-white" alt="">
                                    <div>
                                        <p class="text-sm font-black text-slate-800">Siti Zahra Al-Munawaroh</p>
                                        <p class="text-[10px] font-bold text-slate-400 tracking-tighter uppercase italic">
                                            NIS: 22091105</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-center font-black text-slate-800">18</td>
                            <td class="px-6 py-6 text-center font-black text-slate-400">00</td>
                            <td class="px-6 py-6 text-center font-black text-slate-200">00</td>
                            <td class="px-10 py-6">
                                <div class="flex flex-col gap-1">
                                    <span
                                        class="flex items-center gap-1.5 text-[9px] font-black text-emerald-500 uppercase italic">
                                        <i data-lucide="shield-check" class="w-3 h-3"></i> Top Attendance
                                    </span>
                                    <div class="w-32 h-1 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="w-[100%] h-full bg-emerald-500"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <button
                                    class="p-3 bg-white border border-slate-100 text-slate-400 rounded-xl hover:bg-slate-900 hover:text-white transition-all shadow-sm">
                                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
@endsection
