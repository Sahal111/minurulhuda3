@extends('layouts.guru')

@section('content')
    <main class="flex-1 p-4 lg:p-8 custom-scrollbar overflow-y-auto h-screen bg-[#fbfcfd]">

        <div class="mb-8 space-y-6">
            <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-6">
                <div class="space-y-1">
                    <div class="flex items-center gap-2 text-emerald-600 font-bold text-[10px] uppercase tracking-[0.2em]">
                        <i data-lucide="award" class="w-4 h-4"></i>
                        Academic Grading System
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight">E-Rapor Penilaian</h2>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <div class="relative min-w-[160px]">
                        <select
                            class="w-full pl-4 pr-10 py-3 bg-white border border-slate-100 rounded-2xl shadow-sm appearance-none focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 font-bold text-slate-700 text-xs transition-all cursor-pointer">
                            <option value="" disabled>Pilih Kelas</option>
                            <option value="6a" selected>Kelas 6A</option>
                            <option value="6b">Kelas 6B</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>

                    <div class="relative min-w-[200px]">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                            <i data-lucide="book" class="w-4 h-4 text-emerald-500"></i>
                        </div>
                        <select
                            class="w-full pl-11 pr-10 py-3 bg-white border border-slate-100 rounded-2xl shadow-sm appearance-none focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 font-bold text-slate-700 text-xs transition-all cursor-pointer">
                            <option value="" disabled>Pilih Pelajaran</option>
                            <option value="mtk" selected>Matematika</option>
                            <option value="akidah">Akidah Akhlak</option>
                            <option value="bindo">Bahasa Indonesia</option>
                            <option value="ipa">IPA</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="flex bg-white p-1.5 rounded-2xl border border-slate-100 shadow-sm w-fit overflow-x-auto no-scrollbar">
                <button
                    class="px-6 py-2 text-[10px] font-black bg-slate-900 text-white rounded-xl transition-all whitespace-nowrap">HARIAN</button>
                <button
                    class="px-6 py-2 text-[10px] font-black text-slate-400 hover:text-slate-600 rounded-xl transition-all whitespace-nowrap">TUGAS</button>
                <button
                    class="px-6 py-2 text-[10px] font-black text-slate-400 hover:text-slate-600 rounded-xl transition-all whitespace-nowrap">UTS</button>
                <button
                    class="px-6 py-2 text-[10px] font-black text-slate-400 hover:text-slate-600 rounded-xl transition-all whitespace-nowrap">UAS</button>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden mb-24 lg:mb-10">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center w-16">
                                No</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Siswa
                            </th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                Nilai Angka</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Keterangan
                                / Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50/50">
                        @for ($i = 1; $i <= 10; $i++)
                            <tr class="hover:bg-slate-50/30 transition-colors group">
                                <td class="px-8 py-5 text-center font-black text-slate-300">{{ $i }}</td>
                                <td class="px-8 py-5 font-bold text-slate-700 text-sm">Ahmad Rafliansyah Putra</td>
                                <td class="px-8 py-5 text-center">
                                    <input type="number" oninput="validateScore(this)" placeholder="0"
                                        class="score-input w-20 px-3 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-center font-black text-slate-800 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:bg-white focus:border-emerald-500 transition-all">
                                </td>
                                <td class="px-8 py-5">
                                    <input type="text" placeholder="Tulis catatan..."
                                        class="w-full bg-transparent border-b border-transparent focus:border-slate-200 focus:outline-none text-[11px] font-medium text-slate-500 transition-all">
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <div class="hidden lg:flex justify-end mt-4 mb-10">
            <button onclick="saveGrades()" id="btnSave"
                class="group relative flex items-center gap-3 px-12 py-4 bg-slate-900 text-white rounded-[2rem] font-black text-sm hover:bg-emerald-600 transition-all shadow-xl shadow-slate-200 overflow-hidden">
                <span id="btnText" class="relative z-10 flex items-center gap-2">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Simpan Nilai
                </span>
                <span id="loadingState" class="hidden absolute inset-0 bg-emerald-600 flex items-center justify-center">
                    <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </span>
            </button>
        </div>

        <div
            class="lg:hidden fixed bottom-0 left-0 right-0 p-4 bg-white/90 backdrop-blur-lg border-t border-slate-100 z-[60]">
            <button onclick="saveGrades()"
                class="w-full bg-slate-900 text-white py-4 rounded-2xl font-black text-sm shadow-xl flex items-center justify-center gap-3">
                <i data-lucide="save" class="w-5 h-5 text-emerald-400"></i>
                SIMPAN NILAI
            </button>
        </div>

        <div id="toastSuccess"
            class="fixed top-8 left-1/2 -translate-x-1/2 flex items-center gap-4 bg-slate-900 text-white p-2 pr-6 rounded-full shadow-2xl opacity-0 -translate-y-24 transition-all duration-500 z-[100]">
            <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center text-white">
                <i data-lucide="check" class="w-5 h-5"></i>
            </div>
            <p class="text-[11px] font-black tracking-wider uppercase">Berhasil Disimpan!</p>
        </div>

    </main>

    @push('scripts')
        <script src="/js/guru/penilaian.js"></script>
    @endpush

    <style>
        .score-input::-webkit-outer-spin-button,
        .score-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
@endsection
