@extends('layouts.guru')

@section('content')
    <main class="flex-1 p-4 lg:p-8 custom-scrollbar overflow-y-auto h-screen bg-[#f8fafc]">

        <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-6 mb-8">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-emerald-600 font-bold text-[10px] uppercase tracking-[0.2em]">
                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                    Attendance System v3.0
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Presensi Kehadiran</h2>
                <p class="text-slate-500 font-medium italic">Klik status untuk memperbarui kehadiran siswa secara cepat.</p>
            </div>

            <div class="flex flex-wrap items-center gap-4 bg-white p-3 rounded-[2rem] shadow-sm border border-slate-100">
                <div class="flex items-center gap-2 px-4 border-r border-slate-100">
                    <i data-lucide="layers" class="w-4 h-4 text-slate-400"></i>
                    <select
                        class="text-sm font-bold text-slate-700 focus:outline-none bg-transparent appearance-none cursor-pointer">
                        <option>Kelas 6A</option>
                        <option>Kelas 6B</option>
                        <option>Kelas 5A</option>
                    </select>
                </div>
                <div class="flex items-center gap-2 px-4">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i>
                    <input type="date" value="2026-02-18"
                        class="text-sm font-bold text-slate-700 focus:outline-none bg-transparent cursor-pointer">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden relative">

            <div
                class="p-6 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/30">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Cari Nama Siswa..."
                            class="pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all w-64">
                        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mr-2">Set Semua ke:</span>
                    <button
                        class="px-3 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-lg hover:bg-emerald-600 hover:text-white transition-all">HADIR</button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b border-slate-50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Siswa</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                Status Kehadiran</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50/50">

                        @for ($i = 1; $i <= 5; $i++)
                            <tr class="group hover:bg-slate-50/80 transition-all cursor-pointer attendance-row">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <img src="https://ui-avatars.com/api/?name=Siswa+{{ $i }}&background=random"
                                                class="w-10 h-10 rounded-xl object-cover" alt="">
                                            <div
                                                class="absolute -top-1 -right-1 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">Nama Siswa Contoh
                                                #{{ $i }}</p>
                                            <p class="text-[10px] font-medium text-slate-400">NISN:
                                                0098231{{ $i }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <div
                                        class="flex justify-center items-center gap-1 bg-slate-100/50 p-1 rounded-xl w-fit mx-auto border border-slate-100">
                                        <label class="cursor-pointer group/radio">
                                            <input type="radio" name="status_{{ $i }}" value="H"
                                                class="hidden peer" checked>
                                            <span
                                                class="px-4 py-1.5 rounded-lg text-[10px] font-black block transition-all peer-checked:bg-emerald-600 peer-checked:text-white text-slate-400 hover:text-emerald-600">H</span>
                                        </label>
                                        <label class="cursor-pointer group/radio">
                                            <input type="radio" name="status_{{ $i }}" value="I"
                                                class="hidden peer">
                                            <span
                                                class="px-4 py-1.5 rounded-lg text-[10px] font-black block transition-all peer-checked:bg-orange-500 peer-checked:text-white text-slate-400 hover:text-orange-500">I</span>
                                        </label>
                                        <label class="cursor-pointer group/radio">
                                            <input type="radio" name="status_{{ $i }}" value="S"
                                                class="hidden peer">
                                            <span
                                                class="px-4 py-1.5 rounded-lg text-[10px] font-black block transition-all peer-checked:bg-blue-500 peer-checked:text-white text-slate-400 hover:text-blue-500">S</span>
                                        </label>
                                        <label class="cursor-pointer group/radio">
                                            <input type="radio" name="status_{{ $i }}" value="A"
                                                class="hidden peer">
                                            <span
                                                class="px-4 py-1.5 rounded-lg text-[10px] font-black block transition-all peer-checked:bg-red-500 peer-checked:text-white text-slate-400 hover:text-red-500">A</span>
                                        </label>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <input type="text" placeholder="Catatan..."
                                        class="bg-transparent border-b border-transparent focus:border-emerald-500 focus:outline-none text-[11px] font-medium text-slate-500 text-right w-full transition-all">
                                </td>
                            </tr>
                        @endfor

                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button id="btnSimpan" onclick="simpanAbsensi()"
                class="group relative flex items-center gap-3 px-10 py-4 bg-slate-900 text-white rounded-2xl font-black text-sm hover:bg-emerald-600 transition-all shadow-xl shadow-slate-200 overflow-hidden">
                <span id="btnText" class="relative z-10 flex items-center gap-2">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    Simpan Presensi
                </span>
                <span id="loadingState" class="hidden absolute inset-0 bg-emerald-600 flex items-center justify-center">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </span>
            </button>
        </div>

        <div id="toastSuccess"
            class="fixed bottom-8 right-8 flex items-center gap-4 bg-[#1e293b] text-white p-4 rounded-2xl shadow-2xl translate-y-24 opacity-0 transition-all duration-500 z-[100]">
            <div
                class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
                <i data-lucide="badge-check" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="font-bold text-sm">Berhasil Disimpan!</p>
                <p class="text-[10px] text-slate-400">Data presensi telah masuk ke sistem E-Rapor.</p>
            </div>
            <button onclick="closeToast()" class="ml-4 text-slate-500 hover:text-white">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

    </main>

    @push('scripts')
        <script src="/js/guru/absensi.js"></script>
    @endpush

    <style>
        /* Radio Button Custom Styling */
        input[type="radio"]:checked+span {
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            transform: scale(1.05);
        }

        /* Smooth transition for table rows */
        .attendance-row {
            transition: background-color 0.3s ease;
        }
    </style>
@endsection
