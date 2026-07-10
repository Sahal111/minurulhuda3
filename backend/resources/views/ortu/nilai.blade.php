@extends('layouts.ortu') 
@section('content')
    <main class="flex-1 lg:ml-72 p-4 lg:p-10">

        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Nilai Akademik</h2>
                <p class="text-slate-500">Laporan capaian belajar <b>Ahmad Fathoni</b></p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <div class="inline-flex bg-white p-1 rounded-xl shadow-sm border border-slate-200">
                    <button
                        class="px-4 py-2 text-xs font-bold bg-emerald-600 text-white rounded-lg transition-all">Ganjil</button>
                    <button
                        class="px-4 py-2 text-xs font-medium text-slate-500 hover:bg-slate-50 rounded-lg transition-all">Genap</button>
                </div>
                <button
                    class="flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50 transition-all font-semibold text-sm shadow-sm">
                    <i data-lucide="download" class="w-4 h-4 text-emerald-600"></i>
                    Download Rapor
                </button>
            </div>
        </header>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div
                class="bg-white p-5 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50 relative overflow-hidden group">
                <div class="absolute -right-2 -top-2 text-emerald-50 opacity-10 transition-transform group-hover:scale-110">
                    <i data-lucide="award" class="w-20 h-20"></i>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Rata-rata</p>
                <p class="text-3xl font-bold text-emerald-600">88.5</p>
            </div>

            <div
                class="bg-white p-5 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50 relative overflow-hidden group">
                <div class="absolute -right-2 -top-2 text-blue-50 opacity-20">
                    <i data-lucide="trending-up" class="w-20 h-20"></i>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Tertinggi</p>
                <p class="text-3xl font-bold text-blue-600">98</p>
            </div>

            <div
                class="bg-white p-5 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50 relative overflow-hidden group">
                <div class="absolute -right-2 -top-2 text-rose-50 opacity-20">
                    <i data-lucide="trending-down" class="w-20 h-20"></i>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Terendah</p>
                <p class="text-3xl font-bold text-rose-500">75</p>
            </div>

            <div
                class="bg-white p-5 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-50 relative overflow-hidden group">
                <div class="absolute -right-2 -top-2 text-amber-50 opacity-20">
                    <i data-lucide="medal" class="w-20 h-20"></i>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Peringkat</p>
                <p class="text-3xl font-bold text-amber-500">05<span class="text-sm text-slate-300 ml-1 font-medium">/
                        32</span></p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex items-center justify-between bg-white">
                <h3 class="font-bold text-slate-800 tracking-tight">Daftar Nilai Mata Pelajaran</h3>
                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase rounded-full">Tahun
                    Ajaran 2023/2024</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-slate-400 text-[11px] uppercase tracking-widest font-bold">
                            <th class="px-6 py-4">Mata Pelajaran</th>
                            <th class="px-6 py-4 text-center">Harian</th>
                            <th class="px-6 py-4 text-center">UTS</th>
                            <th class="px-6 py-4 text-center">UAS</th>
                            <th class="px-6 py-4 text-center">Nilai Akhir</th>
                            <th class="px-6 py-4 text-center">Predikat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-700 group-hover:text-emerald-700 transition-colors">
                                    Pendidikan Agama Islam</p>
                                <p class="text-[10px] text-slate-400 font-medium uppercase">Ust. Abdullah, S.Pd</p>
                            </td>
                            <td class="px-6 py-4 text-center font-medium">90</td>
                            <td class="px-6 py-4 text-center font-medium">88</td>
                            <td class="px-6 py-4 text-center font-medium">92</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-block px-3 py-1 bg-emerald-50 text-emerald-600 font-bold rounded-lg">91</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="text-xs font-bold text-emerald-500 bg-emerald-50 w-8 h-8 inline-flex items-center justify-center rounded-full border border-emerald-100 italic">A</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-700 group-hover:text-emerald-700 transition-colors">
                                    Matematika</p>
                                <p class="text-[10px] text-slate-400 font-medium uppercase">Ibu Siti Aminah</p>
                            </td>
                            <td class="px-6 py-4 text-center font-medium">82</td>
                            <td class="px-6 py-4 text-center font-medium">75</td>
                            <td class="px-6 py-4 text-center font-medium">80</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-block px-3 py-1 bg-slate-50 text-slate-600 font-bold rounded-lg">78</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="text-xs font-bold text-amber-500 bg-amber-50 w-8 h-8 inline-flex items-center justify-center rounded-full border border-amber-100 italic">B</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-700 group-hover:text-emerald-700 transition-colors">Bahasa
                                    Indonesia</p>
                                <p class="text-[10px] text-slate-400 font-medium uppercase">Bpk. Rahmat Hidayat</p>
                            </td>
                            <td class="px-6 py-4 text-center font-medium">88</td>
                            <td class="px-6 py-4 text-center font-medium">90</td>
                            <td class="px-6 py-4 text-center font-medium">85</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-block px-3 py-1 bg-emerald-50 text-emerald-600 font-bold rounded-lg">87</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="text-xs font-bold text-emerald-500 bg-emerald-50 w-8 h-8 inline-flex items-center justify-center rounded-full border border-emerald-100 italic">A</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-700 group-hover:text-emerald-700 transition-colors">Bahasa
                                    Arab</p>
                                <p class="text-[10px] text-slate-400 font-medium uppercase">Ust. Syarifuddin</p>
                            </td>
                            <td class="px-6 py-4 text-center font-medium">95</td>
                            <td class="px-6 py-4 text-center font-medium">98</td>
                            <td class="px-6 py-4 text-center font-medium">96</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-block px-3 py-1 bg-emerald-50 text-emerald-600 font-bold rounded-lg">97</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="text-xs font-bold text-emerald-500 bg-emerald-50 w-8 h-8 inline-flex items-center justify-center rounded-full border border-emerald-100 italic">A</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-4 bg-slate-50/30 border-t border-slate-50">
                <p class="text-[11px] text-slate-400 flex items-center gap-2">
                    <i data-lucide="info" class="w-3.5 h-3.5"></i>
                    Nilai ini adalah nilai sementara sebelum dilakukan verifikasi akhir oleh Wali Kelas.
                </p>
            </div>
        </div>
    </main>
@endsection
