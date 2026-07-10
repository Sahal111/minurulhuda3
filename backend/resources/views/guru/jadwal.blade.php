@extends('layouts.guru')

@section('content')
    <main class="flex-1 p-4 lg:p-8 custom-scrollbar overflow-y-auto h-screen bg-[#fbfcfd]">

        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-8">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-emerald-600 font-bold text-xs uppercase tracking-[0.2em]">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    Academic Schedule
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Jadwal Mengajar</h2>
                <p class="text-slate-500 font-medium">Tahun Ajaran 2025/2026 • Semester Ganjil</p>
            </div>

            <div class="flex items-center gap-3">
                <button onclick="window.print()"
                    class="flex items-center gap-2 px-5 py-3 bg-white border border-slate-200 text-slate-700 rounded-2xl font-bold text-sm hover:bg-slate-50 transition-all shadow-sm">
                    <i data-lucide="printer" class="w-4 h-4 text-slate-500"></i>
                    Cetak Jadwal
                </button>
                <button
                    class="flex items-center gap-2 px-5 py-3 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-emerald-600 transition-all shadow-lg shadow-slate-200">
                    <i data-lucide="file-down" class="w-4 h-4"></i>
                    Export PDF
                </button>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-8">

            <div class="col-span-12 xl:col-span-9 space-y-6">

                <div
                    class="bg-white p-2 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex bg-slate-100 p-1.5 rounded-[1.4rem] w-full md:w-auto">
                        <button id="btnHarian" onclick="switchView('harian')"
                            class="flex-1 md:flex-none px-8 py-2.5 text-xs font-black rounded-xl transition-all bg-white text-emerald-700 shadow-sm">
                            HARI INI
                        </button>
                        <button id="btnMingguan" onclick="switchView('mingguan')"
                            class="flex-1 md:flex-none px-8 py-2.5 text-xs font-black rounded-xl transition-all text-slate-500 hover:text-slate-800">
                            MINGGUAN
                        </button>
                    </div>
                    <div class="hidden md:flex items-center gap-6 px-6">
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-400 uppercase leading-none mb-1">Total Sesi</p>
                            <p class="text-sm font-black text-slate-800">24 Jam / Minggu</p>
                        </div>
                        <div class="w-px h-8 bg-slate-100"></div>
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-400 uppercase leading-none mb-1">Status Kuota</p>
                            <span
                                class="text-[10px] font-bold px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-md">TERPENUHI</span>
                        </div>
                    </div>
                </div>

                <div id="viewHarian" class="space-y-4 transition-all duration-300">
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-slate-50/50 border-b border-slate-100">
                                    <tr>
                                        <th
                                            class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-left">
                                            Jam Ke</th>
                                        <th
                                            class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-left">
                                            Waktu & Mapel</th>
                                        <th
                                            class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-left">
                                            Kelas</th>
                                        <th
                                            class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-left">
                                            Status</th>
                                        <th
                                            class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    <tr class="group bg-emerald-50/30">
                                        <td class="px-8 py-6">
                                            <span
                                                class="w-10 h-10 rounded-full bg-white border border-emerald-200 flex items-center justify-center font-black text-emerald-700 shadow-sm italic text-sm">1-2</span>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-100">
                                                    <i data-lucide="book-open" class="w-6 h-6"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-black text-slate-800 leading-tight">Aqidah Akhlak
                                                    </p>
                                                    <p class="text-xs font-bold text-emerald-600 mt-0.5 italic">Sedang
                                                        Berlangsung</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div
                                                class="inline-flex items-center gap-2 bg-white px-3 py-1.5 rounded-xl border border-emerald-100 shadow-sm">
                                                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                                <span class="text-sm font-black text-slate-700 tracking-tighter">Kelas
                                                    6A</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <span
                                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">07:00
                                                - 08:10</span>
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <button
                                                class="bg-slate-900 text-white px-6 py-2.5 rounded-xl text-xs font-black hover:bg-emerald-600 transition-all shadow-md">ABSENSI</button>
                                        </td>
                                    </tr>
                                    <tr class="group hover:bg-slate-50/50 transition-all">
                                        <td class="px-8 py-6 italic font-bold text-slate-400">3-4</td>
                                        <td class="px-8 py-6">
                                            <div
                                                class="flex items-center gap-4 opacity-70 group-hover:opacity-100 transition-opacity">
                                                <div
                                                    class="w-12 h-12 bg-slate-100 text-slate-400 rounded-2xl flex items-center justify-center">
                                                    <i data-lucide="calculator" class="w-6 h-6"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-bold text-slate-700">Matematika</p>
                                                    <p class="text-xs text-slate-400">08:10 - 09:20</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 italic font-bold text-slate-500">Kelas 6A</td>
                                        <td
                                            class="px-8 py-6 text-[10px] font-bold text-slate-300 uppercase tracking-widest italic">
                                            Mendatang</td>
                                        <td class="px-8 py-6 text-right">
                                            <button class="text-slate-300 hover:text-slate-600 p-2"><i
                                                    data-lucide="more-horizontal" class="w-5 h-5"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="viewMingguan" class="hidden space-y-6 transition-all duration-300">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)

                            <div
                                class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 hover:border-emerald-200 transition-all group">
                                <div class="flex justify-between items-center mb-6 border-b border-slate-50 pb-4">
                                    <h4 class="font-black text-slate-800 uppercase tracking-widest text-sm">
                                        {{ $hari }}</h4>
                                    <span
                                        class="text-[10px] font-bold bg-slate-100 px-2 py-1 rounded-lg text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-700 transition-colors">4
                                        SESI</span>
                                </div>
                                <div class="space-y-4">
                                    <div
                                        class="flex gap-4 p-3 rounded-2xl bg-slate-50/50 hover:bg-white border border-transparent hover:border-slate-100 transition-all shadow-sm shadow-transparent hover:shadow-slate-100">
                                        <div
                                            class="text-[10px] font-black text-slate-400 flex flex-col justify-center border-r pr-3">
                                            <span>07:00</span>
                                            <span class="text-emerald-500 uppercase">1-2</span>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-slate-700">Aqidah Akhlak</p>
                                            <p class="text-[10px] font-bold text-slate-400">Kelas 6A</p>
                                        </div>
                                    </div>
                                    <div
                                        class="flex gap-4 p-3 rounded-2xl bg-slate-50/50 hover:bg-white border border-transparent hover:border-slate-100 transition-all shadow-sm shadow-transparent hover:shadow-slate-100">
                                        <div
                                            class="text-[10px] font-black text-slate-400 flex flex-col justify-center border-r pr-3">
                                            <span>08:10</span>
                                            <span class="text-emerald-500 uppercase">3-4</span>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-slate-700">Matematika</p>
                                            <p class="text-[10px] font-bold text-slate-400">Kelas 6A</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="col-span-12 xl:col-span-3 space-y-6">
                <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-2xl">
                    <div class="relative z-10">
                        <p class="text-emerald-400 text-[10px] font-black uppercase tracking-[0.2em] mb-4">Statistik Guru
                        </p>
                        <div class="flex items-end gap-2 mb-8">
                            <span class="text-5xl font-black italic tracking-tighter">24</span>
                            <span class="text-slate-400 font-bold text-sm mb-2">Jam/Minggu</span>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-400 font-bold uppercase">Progres Mengajar</span>
                                <span class="font-black text-emerald-400">75%</span>
                            </div>
                            <div class="h-2.5 bg-slate-800 rounded-full overflow-hidden border border-slate-700">
                                <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-400 rounded-full"
                                    style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl"></div>
                </div>

                <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
                        Pengingat
                    </h4>
                    <div class="space-y-4">
                        <div class="p-4 rounded-2xl bg-orange-50 border border-orange-100 flex items-start gap-3">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-orange-500 shrink-0"></i>
                            <p class="text-xs font-bold text-orange-700 leading-relaxed">Jangan lupa input nilai harian
                                Matematika untuk kelas 6A!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script src="/js/guru/jadwal.js"></script>
    @endpush

    <style>
        @media print {

            aside,
            header,
            .no-print,
            button,
            .sidebar-hidden {
                display: none !important;
            }

            main {
                padding: 0 !important;
                background: white !important;
            }

            .bg-white {
                border: 1px solid #eee !important;
                box-shadow: none !important;
            }
        }
    </style>
@endsection
