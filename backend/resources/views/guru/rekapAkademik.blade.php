@extends('layouts.guru')

@section('content')
    <main class="flex-1 p-4 lg:p-8 custom-scrollbar overflow-y-auto h-screen bg-[#f8fafc]">

        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-blue-600 font-bold text-[10px] uppercase tracking-[0.2em]">
                    <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                    Academic Insights
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Rekap Nilai Akhir</h2>
                <p class="text-slate-500 font-medium italic">Matematika • Kelas 6A • Semester Ganjil</p>
            </div>

            <div class="flex items-center gap-3">
                <button
                    class="flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-700 rounded-2xl font-bold text-sm hover:bg-slate-50 transition-all shadow-sm">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    Cetak
                </button>
                <button
                    class="flex items-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-emerald-600 transition-all shadow-xl shadow-slate-200 group">
                    <i data-lucide="file-spreadsheet"
                        class="w-4 h-4 text-emerald-400 group-hover:rotate-12 transition-transform"></i>
                    Export Excel
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm relative overflow-hidden group">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Rata-rata Kelas</p>
                <h3 class="text-4xl font-black text-slate-900 tracking-tighter">84.5</h3>
                <div class="mt-4 flex items-center gap-2 text-emerald-600 text-xs font-bold">
                    <i data-lucide="trending-up" class="w-4 h-4"></i>
                    <span>+2.4 dari bulan lalu</span>
                </div>
                <div
                    class="absolute -right-4 -bottom-4 opacity-5 text-slate-900 group-hover:scale-110 transition-transform">
                    <i data-lucide="line-chart" class="w-20 h-20"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nilai Tertinggi</p>
                <h3 class="text-4xl font-black text-blue-600 tracking-tighter">98</h3>
                <div class="mt-4 flex items-center gap-2">
                    <div
                        class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-[10px] font-black text-blue-600">
                        🏆</div>
                    <span class="text-xs font-bold text-slate-600">Ahmad Faisal</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nilai Terendah</p>
                <h3 class="text-4xl font-black text-orange-500 tracking-tighter">62</h3>
                <div class="mt-4 flex items-center gap-2 text-orange-600 text-xs font-bold">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                    <span>3 Siswa di bawah KKM</span>
                </div>
            </div>

            <div class="bg-emerald-600 p-6 rounded-[2.5rem] shadow-xl shadow-emerald-100 relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-emerald-100 text-[10px] font-black uppercase tracking-widest mb-1">Ketuntasan</p>
                    <h3 class="text-4xl font-black text-white tracking-tighter">92%</h3>
                    <div class="mt-4 h-1.5 w-full bg-emerald-800/50 rounded-full overflow-hidden">
                        <div class="h-full bg-white rounded-full" style="width: 92%"></div>
                    </div>
                </div>
                <i data-lucide="check-circle" class="absolute -right-2 -bottom-2 w-24 h-24 text-white/10"></i>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-black text-slate-800">Daftar Rekap Nilai</h3>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-emerald-500 rounded-full"></span>
                    <span class="text-[10px] font-black text-slate-400 uppercase">Tuntas</span>
                </div>
            </div>

            <div class="overflow-x-auto no-scrollbar">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Peringkat
                            </th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Siswa
                            </th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                Harian</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                UTS</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                UAS</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                Nilai Akhir</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @for ($i = 1; $i <= 10; $i++)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-5">
                                    <span
                                        class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center text-xs font-black text-slate-500 group-hover:bg-slate-900 group-hover:text-white transition-all">
                                        {{ $i }}
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-slate-700">Muhammad Rizky Pratama</span>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase">NIS: 1209384</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-center font-bold text-slate-600 italic">85</td>
                                <td class="px-8 py-5 text-center font-bold text-slate-600 italic">80</td>
                                <td class="px-8 py-5 text-center font-bold text-slate-600 italic">90</td>
                                <td class="px-8 py-5 text-center">
                                    <span class="text-sm font-black text-slate-900">85.0</span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <span
                                        class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-lg">
                                        TUNTAS
                                    </span>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
