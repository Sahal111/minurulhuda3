@extends('layouts.ppdb')

@section('content')
    <main class="flex-1 overflow-y-auto bg-[#F6F8FA] p-4 lg:p-10">
        <div class="max-w-[1600px] mx-auto mb-10">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="space-y-1">
                    <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.3em] text-emerald-600">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        Live Data Intelligence
                    </div>
                    <h2 class="text-4xl font-[1000] text-slate-900 tracking-tight">PPDB Analytics <span
                            class="text-slate-400">&</span> Reports</h2>
                </div>

                <div
                    class="flex items-center gap-3 bg-white p-2 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-white">
                    <div class="relative group">
                        <button
                            class="flex items-center gap-3 px-8 py-4 bg-slate-900 text-white rounded-[1.5rem] text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 transition-all duration-500 shadow-lg shadow-slate-200">
                            <i data-lucide="download-cloud" class="w-4 h-4"></i>
                            Export Dataset
                        </button>
                        <div
                            class="absolute right-0 mt-3 w-64 bg-white rounded-[2rem] shadow-2xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 p-3">
                            <div
                                class="px-4 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 mb-2">
                                Pilih Kategori Export</div>
                            <a href="#"
                                class="flex items-center justify-between px-5 py-3 hover:bg-slate-50 rounded-xl text-xs font-bold text-slate-700 group/item transition-all">
                                Semua Data <i data-lucide="file-spreadsheet"
                                    class="w-4 h-4 text-slate-400 group-hover/item:text-emerald-500"></i>
                            </a>
                            <a href="#"
                                class="flex items-center justify-between px-5 py-3 hover:bg-emerald-50 rounded-xl text-xs font-bold text-emerald-700 group/item transition-all">
                                Data Lulus <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
                            </a>
                            <a href="#"
                                class="flex items-center justify-between px-5 py-3 hover:bg-rose-50 rounded-xl text-xs font-bold text-rose-700 group/item transition-all">
                                Data Tidak Lulus <i data-lucide="x-circle" class="w-4 h-4 text-rose-400"></i>
                            </a>
                        </div>
                    </div>
                    <button onclick="window.print()"
                        class="w-14 h-14 flex items-center justify-center rounded-full bg-white text-slate-400 hover:text-slate-900 hover:bg-slate-50 transition-all border border-slate-100 shadow-sm">
                        <i data-lucide="printer" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-[1600px] mx-auto grid grid-cols-12 gap-8">

            <div class="col-span-12 lg:col-span-4 space-y-8">

                <div
                    class="bg-white p-10 rounded-[3.5rem] border border-slate-200/60 shadow-sm flex flex-col items-center text-center relative overflow-hidden group">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-10">Rasio Kelulusan</p>
                    <div class="relative w-48 h-48 mb-8">
                        <svg class="w-full h-full -rotate-90">
                            <circle cx="96" cy="96" r="80" stroke="currentColor" stroke-width="16"
                                fill="transparent" class="text-slate-50" />
                            <circle cx="96" cy="96" r="80" stroke="currentColor" stroke-width="16"
                                fill="transparent" stroke-dasharray="502" stroke-dashoffset="150"
                                class="text-emerald-500 transition-all duration-1000 group-hover:stroke-emerald-600" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-5xl font-[1000] text-slate-900">72%</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Approved</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 w-full gap-4 pt-8 border-t border-slate-50">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Total Lulus</p>
                            <p class="text-xl font-black text-slate-800">152</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Total Daftar</p>
                            <p class="text-xl font-black text-slate-800">210</p>
                        </div>
                    </div>
                </div>

                <div class="bg-indigo-900 p-10 rounded-[3.5rem] text-white shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                    <h4 class="text-[10px] font-black text-indigo-300 uppercase tracking-[0.3em] mb-12">Vs Periode 2025</h4>
                    <div class="space-y-6">
                        <div class="flex items-end gap-3">
                            <span class="text-6xl font-[1000] leading-none">+24%</span>
                            <i data-lucide="trending-up" class="w-8 h-8 text-emerald-400 mb-1"></i>
                        </div>
                        <p class="text-indigo-100/60 text-sm font-medium leading-relaxed">Peningkatan volume pendaftar
                            secara signifikan dipengaruhi oleh jalur <span
                                class="text-white font-black italic">Prestasi</span>.</p>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8 space-y-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-10 rounded-[3.5rem] border border-slate-200/60 shadow-sm">
                        <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-10">Jalur Pendaftaran
                        </h3>
                        <div class="space-y-8">
                            @foreach ([['Reguler', 75, 'bg-slate-900'], ['Prestasi', 45, 'bg-emerald-500'], ['Afilasi', 20, 'bg-blue-500']] as $jalur)
                                <div class="group cursor-default">
                                    <div class="flex justify-between items-end mb-3">
                                        <span
                                            class="text-xs font-black text-slate-800 uppercase tracking-widest">{{ $jalur[0] }}</span>
                                        <span class="text-sm font-black text-slate-400 italic">{{ $jalur[1] }}
                                            Siswa</span>
                                    </div>
                                    <div class="w-full h-2.5 bg-slate-50 rounded-full overflow-hidden">
                                        <div class="h-full {{ $jalur[2] }} rounded-full transition-all duration-1000"
                                            style="width: {{ $jalur[1] }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white p-10 rounded-[3.5rem] border border-slate-200/60 shadow-sm">
                        <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-10">Top Origin
                            Schools</h3>
                        <div class="space-y-6">
                            @foreach ([['TK Al-Azhar', 42], ['TK Negeri 01', 35], ['TK Islam Terpadu', 28]] as $school)
                                <div
                                    class="flex items-center gap-5 p-4 hover:bg-slate-50 rounded-2xl transition-all border border-transparent hover:border-slate-100">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-xs font-black text-slate-400 group-hover:bg-slate-900 transition-all">
                                        0{{ $loop->iteration }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs font-black text-slate-800 uppercase tracking-tight">
                                            {{ $school[0] }}</p>
                                        <div class="w-full h-1 bg-slate-100 rounded-full mt-2">
                                            <div class="h-full bg-indigo-500 rounded-full"
                                                style="width: {{ $school[1] * 2 }}%"></div>
                                        </div>
                                    </div>
                                    <span class="text-xs font-black text-slate-400 italic">{{ $school[1] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white p-10 rounded-[4rem] border border-slate-200/60 shadow-sm relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-16">
                        <div>
                            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-1">Trend Analysis
                            </h3>
                            <p class="text-2xl font-[1000] text-slate-900">Weekly Registration Flow</p>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="px-5 py-2.5 bg-slate-900 text-white text-[9px] font-black uppercase rounded-xl tracking-widest">Growth</button>
                            <button
                                class="px-5 py-2.5 bg-slate-50 text-slate-400 text-[9px] font-black uppercase rounded-xl tracking-widest hover:text-slate-900 transition-all">Volume</button>
                        </div>
                    </div>

                    <div class="relative h-64 w-full flex items-end gap-2 px-2">
                        @foreach (range(1, 15) as $i)
                            <div class="flex-1 bg-slate-50 hover:bg-emerald-500 rounded-t-xl transition-all duration-500 cursor-pointer relative group/bar"
                                style="height: {{ rand(20, 100) }}%">
                                <div
                                    class="absolute -top-10 left-1/2 -translate-x-1/2 px-3 py-1 bg-slate-900 text-white text-[9px] font-black rounded opacity-0 group-hover/bar:opacity-100 transition-all shadow-xl whitespace-nowrap z-10">
                                    Day {{ $i }}: {{ rand(10, 30) }} New
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div
                        class="absolute inset-0 pointer-events-none opacity-[0.02] bg-[size:30px_30px] bg-[linear-gradient(to_right,#000_1px,transparent_1px),linear-gradient(to_bottom,#000_1px,transparent_1px)]">
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script src="/js/admin-ppdb/statistik-laporan.js"></script>
    @endpush

    <style>
        @media print {

            header,
            .action-hub,
            button,
            nav {
                display: none !important;
            }

            main {
                background: white !important;
                p: 0 !important;
            }

            .rounded-\[3\.5rem\],
            .rounded-\[4rem\] {
                border-radius: 1rem !important;
                border: 1px solid #eee !important;
                shadow: none !important;
            }
        }
    </style>
@endsection
