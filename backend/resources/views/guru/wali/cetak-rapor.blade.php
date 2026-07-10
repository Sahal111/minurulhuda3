@extends('layouts.guru')

@section('content')
    <main class="flex-1 p-4 lg:p-10 custom-scrollbar overflow-y-auto h-screen bg-[#f1f5f9]/50">

        <div class="sticky top-0 z-[40] bg-[#f1f5f9]/80 backdrop-blur-md pb-6">
            <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-6">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Report Generator</h2>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-1">Pratinjau & Cetak Hasil
                        Belajar Siswa</p>
                </div>

                <div
                    class="flex flex-col sm:flex-row items-center gap-3 bg-white p-3 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-white w-full xl:w-auto">
                    <div class="flex items-center gap-3 px-4 w-full sm:w-auto border-r border-slate-100">
                        <i data-lucide="user" class="w-4 h-4 text-emerald-600"></i>
                        <select
                            class="bg-transparent border-none text-[11px] font-black text-slate-800 outline-none w-full sm:w-48">
                            <option>Ahmad Rafliansyah</option>
                            <option>Siti Zahra Al-Munawaroh</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-3 px-4 w-full sm:w-auto border-r border-slate-100">
                        <i data-lucide="calendar" class="w-4 h-4 text-emerald-600"></i>
                        <select
                            class="bg-transparent border-none text-[11px] font-black text-slate-800 outline-none w-full sm:w-32">
                            <option>Semester 1</option>
                            <option>Semester 2</option>
                        </select>
                    </div>
                    <button onclick="window.print()"
                        class="w-full sm:w-auto bg-slate-900 hover:bg-emerald-600 text-white px-8 py-3 rounded-2xl font-black text-[11px] transition-all flex items-center justify-center gap-3 shadow-lg shadow-slate-200">
                        <i data-lucide="printer" class="w-4 h-4"></i>
                        CETAK RAPOR
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-[850px] mx-auto bg-white shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-200 rounded-sm overflow-hidden p-[20mm] md:p-[40mm] mb-20 relative print:p-0 print:shadow-none print:border-none"
            id="printable-area">

            <div
                class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-[0.03] rotate-45 print:hidden text-9xl font-black text-slate-900 uppercase">
                Official Copy
            </div>

            <div class="flex items-start justify-between border-b-[3px] border-double border-slate-900 pb-8 mb-10">
                <div class="flex gap-6">
                    <div
                        class="w-20 h-20 bg-emerald-600 rounded-lg flex items-center justify-center text-white text-3xl font-black">
                        NH</div>
                    <div>
                        <h1 class="text-xl font-black text-slate-900 uppercase leading-none mb-1">MI Nurul Huda 3</h1>
                        <p class="text-[10px] font-bold text-slate-500 uppercase leading-relaxed max-w-[300px]">Jl.
                            Pendidikan No. 45, Kec. Citereup, Bogor, Jawa Barat. Terakreditasi A.</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Laporan Hasil Belajar</p>
                    <p class="text-xs font-black text-slate-900">TA 2025/2026</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 mb-10 text-xs">
                <div class="space-y-1">
                    <div class="flex"><span class="w-32 font-bold">Nama Lengkap</span><span class="mr-2">:</span><span
                            class="font-black">Ahmad Rafliansyah</span></div>
                    <div class="flex"><span class="w-32 font-bold">NIS/NISN</span><span
                            class="mr-2">:</span><span>22091102 / 00129384</span></div>
                    <div class="flex"><span class="w-32 font-bold">Kelas</span><span class="mr-2">:</span><span>6A
                            (Unggulan)</span></div>
                </div>
                <div class="space-y-1 md:text-right">
                    <div class="flex md:justify-end"><span class="w-32 font-bold">Semester</span><span
                            class="mr-2">:</span><span>Ganjil (1)</span></div>
                    <div class="flex md:justify-end"><span class="w-32 font-bold">Kurikulum</span><span
                            class="mr-2">:</span><span>Merdeka Belajar</span></div>
                </div>
            </div>

            <div class="mb-10">
                <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest mb-4 flex items-center gap-2">
                    <span class="w-6 h-px bg-slate-900"></span> A. Nilai Akademik
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-slate-900">
                        <thead>
                            <tr class="bg-slate-50">
                                <th
                                    class="border border-slate-900 p-3 text-[10px] font-black text-center uppercase w-12 tracking-widest">
                                    No</th>
                                <th
                                    class="border border-slate-900 p-3 text-[10px] font-black text-left uppercase tracking-widest">
                                    Mata Pelajaran</th>
                                <th
                                    class="border border-slate-900 p-3 text-[10px] font-black text-center uppercase w-20 tracking-widest">
                                    KKM</th>
                                <th
                                    class="border border-slate-900 p-3 text-[10px] font-black text-center uppercase w-20 tracking-widest">
                                    Nilai</th>
                                <th
                                    class="border border-slate-900 p-3 text-[10px] font-black text-center uppercase w-20 tracking-widest">
                                    Predikat</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs">
                            <tr>
                                <td class="border border-slate-900 p-3 text-center">1</td>
                                <td class="border border-slate-900 p-3 font-bold">Pendidikan Agama Islam</td>
                                <td class="border border-slate-900 p-3 text-center italic">75</td>
                                <td class="border border-slate-900 p-3 text-center font-black">92</td>
                                <td class="border border-slate-900 p-3 text-center">A</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-900 p-3 text-center">2</td>
                                <td class="border border-slate-900 p-3 font-bold">Matematika</td>
                                <td class="border border-slate-900 p-3 text-center italic">70</td>
                                <td class="border border-slate-900 p-3 text-center font-black">88</td>
                                <td class="border border-slate-900 p-3 text-center">B</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-900 p-3 text-center">3</td>
                                <td class="border border-slate-900 p-3 font-bold">IPA (Sains)</td>
                                <td class="border border-slate-900 p-3 text-center italic">70</td>
                                <td class="border border-slate-900 p-3 text-center font-black text-rose-600">68</td>
                                <td class="border border-slate-900 p-3 text-center">C</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            @push('scripts')
                <script src="/js/guru/wali/cetak-rapor.js"></script>
            @endpush

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
                <div>
                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="w-4 h-px bg-slate-900"></span> B. Kehadiran
                    </h3>
                    <table class="w-full border-collapse border border-slate-900">
                        <tbody class="text-xs">
                            <tr>
                                <td class="border border-slate-900 p-3 font-bold w-1/2">Sakit</td>
                                <td class="border border-slate-900 p-3 text-center">2 hari</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-900 p-3 font-bold">Izin</td>
                                <td class="border border-slate-900 p-3 text-center">1 hari</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-900 p-3 font-bold">Tanpa Keterangan</td>
                                <td class="border border-slate-900 p-3 text-center font-black">0 hari</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="w-4 h-px bg-slate-900"></span> C. Catatan Wali Kelas
                    </h3>
                    <div class="border border-slate-900 p-4 min-h-[100px] text-xs leading-relaxed italic">
                        "Tingkatkan prestasi belajarmu terutama pada mata pelajaran IPA. Pertahankan sikap santun dan
                        kedisiplinan yang sudah baik."
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-[10px] text-center uppercase font-black">
                <div>
                    <p class="mb-20">Orang Tua / Wali</p>
                    <div class="w-32 h-px bg-slate-900 mx-auto"></div>
                </div>
                <div>
                    <p class="mb-20">Kepala Madrasah</p>
                    <div class="w-32 h-px bg-slate-900 mx-auto"></div>
                    <p class="mt-2 text-slate-400">Dr. M. Ikhwan, M.Pd</p>
                </div>
                <div>
                    <p class="mb-20">Bogor, 18 Feb 2026<br>Wali Kelas</p>
                    <div class="w-32 h-px bg-slate-900 mx-auto"></div>
                    <p class="mt-2 text-slate-400 italic font-black">Hj. Siti Rahmah, S.Pd.I</p>
                </div>
            </div>

        </div>

    </main>

    <style>
        /* PRINT STYLES */
        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            body * {
                visibility: hidden;
            }

            #printable-area,
            #printable-area * {
                visibility: visible;
            }

            #printable-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 20mm;
            }

            .print\:hidden {
                display: none !important;
            }
        }

        /* CUSTOM UI SCROLLBAR */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
    </style>


@endsection
