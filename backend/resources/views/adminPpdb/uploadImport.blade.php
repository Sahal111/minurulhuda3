@extends('layouts.ppdb')

@section('content')
    <main class="flex-1 overflow-y-auto bg-[#FBFBFE] p-8">
        <div class="max-w-[1200px] mx-auto">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span
                            class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase tracking-widest rounded-lg">Batch
                            Import</span>
                        <span class="text-slate-300">/</span>
                        <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Excel Engine v2.0</span>
                    </div>
                    <h2 class="text-4xl font-[1000] text-slate-900 tracking-tight leading-none">Sinkronisasi Data</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-[10px] font-bold text-slate-400 uppercase italic">Terakhir diupdate</p>
                        <p class="text-xs font-black text-slate-700">Hari ini, 14:20</p>
                    </div>
                    <a href="#"
                        class="group flex items-center gap-3 px-8 py-4 bg-white border-2 border-slate-200 rounded-[2rem] text-sm font-black text-slate-800 hover:border-emerald-500 hover:shadow-xl hover:shadow-emerald-100 transition-all duration-500">
                        <div
                            class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <i data-lucide="download-cloud" class="w-4 h-4"></i>
                        </div>
                        Download Template
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-10">
                <div class="col-span-12 lg:col-span-7">
                    <div
                        class="bg-white rounded-[3rem] p-10 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.05)] border border-slate-100 relative overflow-hidden">
                        <div
                            class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-emerald-500 via-teal-400 to-blue-500">
                        </div>

                        <div class="mb-10 text-center">
                            <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter">Pusat Unggahan Berkas
                            </h3>
                            <p class="text-sm text-slate-400 mt-1">Sistem akan melakukan validasi skema otomatis</p>
                        </div>

                        <label id="drop-area" class="relative block group cursor-pointer">
                            <input type="file" id="file-input" class="hidden">
                            <div
                                class="border-4 border-dashed border-slate-100 rounded-[2.5rem] p-16 flex flex-col items-center justify-center bg-slate-50/50 group-hover:bg-white group-hover:border-emerald-400 transition-all duration-700 group-hover:shadow-2xl group-hover:shadow-emerald-100/50">

                                <div class="relative mb-8">
                                    <div
                                        class="w-24 h-24 bg-white rounded-[2rem] shadow-xl flex items-center justify-center text-slate-300 group-hover:text-emerald-500 group-hover:rotate-12 transition-all duration-500">
                                        <i data-lucide="file-spreadsheet" class="w-10 h-10"></i>
                                    </div>
                                    <div
                                        class="absolute -right-2 -bottom-2 w-10 h-10 bg-emerald-500 rounded-2xl flex items-center justify-center text-white border-4 border-white animate-bounce">
                                        <i data-lucide="plus" class="w-5 h-5"></i>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <p class="text-lg font-black text-slate-800 tracking-tight">Drop Berkas Excel Disini</p>
                                    <p class="text-xs text-slate-400 font-bold mt-2 uppercase tracking-widest opacity-60">
                                        Atau klik untuk telusuri folder</p>
                                </div>
                            </div>
                        </label>

                        <div id="upload-status" class="hidden mt-10 p-8 bg-slate-900 rounded-[2rem] text-white">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                                    <span
                                        class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-400">Processing
                                        Data</span>
                                </div>
                                <span id="percent-text" class="text-2xl font-black italic">0%</span>
                            </div>
                            <div class="w-full h-2 bg-white/10 rounded-full overflow-hidden">
                                <div id="progress-bar" class="h-full bg-emerald-500 w-0 transition-all duration-300"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-5 space-y-8">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 italic">Total
                                Terbaca</p>
                            <h4 class="text-4xl font-black text-slate-900 tracking-tighter" id="stat-total">0</h4>
                        </div>
                        <div class="bg-emerald-500 p-8 rounded-[2.5rem] shadow-xl shadow-emerald-200">
                            <p class="text-[10px] font-black text-white/60 uppercase tracking-widest mb-4 italic">Siap
                                Import</p>
                            <h4 class="text-4xl font-black text-white tracking-tighter" id="stat-valid">0</h4>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm flex-1">
                        <h3
                            class="text-xs font-black text-slate-800 uppercase tracking-widest mb-8 border-b border-slate-50 pb-4">
                            Aktivitas Validasi</h3>
                        <div class="space-y-6" id="validation-log">
                            <div class="flex gap-4">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center shrink-0">
                                    <i data-lucide="info" class="w-4 h-4 text-slate-400"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-400 italic mt-1 leading-relaxed">Sistem menunggu
                                    berkas diunggah untuk memulai proses pengecekan...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="results-table" class="col-span-12 hidden opacity-0 translate-y-10 transition-all duration-1000">
                    <div class="bg-white rounded-[3rem] overflow-hidden border border-slate-100 shadow-2xl">
                        <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                            <h3 class="text-lg font-black text-slate-800 uppercase tracking-tighter">Hasil Analisis Berkas
                            </h3>
                            <button
                                class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-black text-xs hover:bg-emerald-600 transition-all shadow-xl shadow-slate-200 uppercase tracking-widest">
                                Konfirmasi & Eksekusi Import
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                                        <th class="px-10 py-6 font-black">Baris</th>
                                        <th class="px-6 py-6 font-black">Nama Lengkap</th>
                                        <th class="px-6 py-6 font-black">NIK</th>
                                        <th class="px-6 py-6 font-black text-center">Status</th>
                                        <th class="px-6 py-6 font-black">Analisis Sistem</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50 font-bold text-sm">
                                    <tr class="group hover:bg-slate-50 transition-all">
                                        <td class="px-10 py-6 text-slate-300 italic">002</td>
                                        <td class="px-6 py-6 text-slate-700">Ahmad Zulkarnain</td>
                                        <td class="px-6 py-6 text-slate-500">32012839210002</td>
                                        <td class="px-6 py-6 text-center">
                                            <span
                                                class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-600 rounded-lg text-[9px] font-black uppercase">Pass</span>
                                        </td>
                                        <td class="px-6 py-6 text-slate-400 font-medium">Data memenuhi kriteria skema.</td>
                                    </tr>
                                    <tr class="bg-rose-50/20 group hover:bg-rose-50 transition-all">
                                        <td class="px-10 py-6 text-rose-300 italic">003</td>
                                        <td class="px-6 py-6 text-slate-700">Siti Mariah Ulfa</td>
                                        <td class="px-6 py-6 text-slate-500">3201...</td>
                                        <td class="px-6 py-6 text-center">
                                            <span
                                                class="inline-block px-4 py-1.5 bg-rose-100 text-rose-600 rounded-lg text-[9px] font-black uppercase">Fail</span>
                                        </td>
                                        <td class="px-6 py-6 text-rose-500 font-bold">NIK tidak lengkap (Kurang 4 digit).
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script src="/js/admin-ppdb/upload-import.js"></script>
    @endpush
@endsection
