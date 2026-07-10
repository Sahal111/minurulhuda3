@extends('layouts.guru')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <main class="flex-1 p-4 lg:p-8 custom-scrollbar overflow-y-auto h-screen bg-[#f8fafc]">

        <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-6 mb-10">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-indigo-600 font-bold text-[10px] uppercase tracking-[0.2em]">
                    <i data-lucide="pie-chart" class="w-4 h-4"></i>
                    Advanced Data Analytics
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Analitik Performa Kelas</h2>
                <p class="text-slate-500 font-medium">Visualisasi performa akademik dan kedisiplinan siswa.</p>
            </div>

            <div class="flex bg-white p-1.5 rounded-2xl border border-slate-100 shadow-sm">
                <button
                    class="px-6 py-2 text-[10px] font-black bg-slate-900 text-white rounded-xl shadow-lg shadow-slate-200">SEMESTER
                    1</button>
                <button class="px-6 py-2 text-[10px] font-black text-slate-400 hover:text-slate-600 transition-all">SEMESTER
                    2</button>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-8">

            <div class="col-span-12 xl:col-span-8 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-lg font-black text-slate-800 tracking-tight">Tren Performa Nilai</h3>
                        <p class="text-xs text-slate-400 font-medium">Rata-rata nilai ujian bulanan</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-indigo-500 rounded-full"></span>
                        <span class="text-[10px] font-black text-slate-400 uppercase">Matematika</span>
                    </div>
                </div>
                <div class="h-[300px]">
                    <canvas id="lineChartPerkembangan"></canvas>
                </div>
            </div>

            <div class="col-span-12 xl:col-span-4 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <div class="mb-8">
                    <h3 class="text-lg font-black text-slate-800 tracking-tight">Distribusi Nilai</h3>
                    <p class="text-xs text-slate-400 font-medium">Berdasarkan kategori KKM</p>
                </div>
                <div class="h-[250px] flex items-center justify-center">
                    <canvas id="pieChartDistribusi"></canvas>
                </div>
                <div class="mt-8 space-y-3">
                    <div class="flex items-center justify-between text-xs font-bold">
                        <span class="text-slate-400 flex items-center gap-2"><span
                                class="w-2 h-2 bg-emerald-500 rounded-full"></span> Sangat Baik</span>
                        <span class="text-slate-800">65%</span>
                    </div>
                    <div class="flex items-center justify-between text-xs font-bold">
                        <span class="text-slate-400 flex items-center gap-2"><span
                                class="w-2 h-2 bg-indigo-500 rounded-full"></span> Cukup</span>
                        <span class="text-slate-800">25%</span>
                    </div>
                    <div class="flex items-center justify-between text-xs font-bold">
                        <span class="text-slate-400 flex items-center gap-2"><span
                                class="w-2 h-2 bg-rose-500 rounded-full"></span> Remedial</span>
                        <span class="text-slate-800">10%</span>
                    </div>
                </div>
            </div>

            <div class="col-span-12 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-lg font-black text-slate-800 tracking-tight">Statistik Kehadiran Bulanan</h3>
                        <p class="text-xs text-slate-400 font-medium">Total kehadiran seluruh siswa per bulan</p>
                    </div>
                    <button class="p-2 hover:bg-slate-50 rounded-xl transition-all">
                        <i data-lucide="more-vertical" class="w-5 h-5 text-slate-400"></i>
                    </button>
                </div>
                <div class="h-[350px]">
                    <canvas id="barChartKehadiran"></canvas>
                </div>
            </div>

        </div>
    </main>

    @push('scripts')
        <script src="/js/guru/analitik-kelas.js"></script>
    @endpush

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
@endsection
