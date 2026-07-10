@extends('layouts.guru')

@section('content')
    <main class="flex-1 p-4 lg:p-8 custom-scrollbar overflow-y-auto h-screen bg-[#fbfcfd]">

        <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-6 mb-10">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-emerald-600 font-bold text-[10px] uppercase tracking-[0.2em]">
                    <i data-lucide="folder-kanban" class="w-4 h-4"></i>
                    Learning Resources
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Materi & Tugas</h2>
                <p class="text-slate-500 font-medium">Kelola sumber belajar dan pantau pengumpulan tugas siswa.</p>
            </div>

            <div class="flex items-center gap-3">
                <button
                    class="flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-700 rounded-2xl font-bold text-sm hover:bg-slate-50 transition-all shadow-sm">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Tambah Materi
                </button>
                <button
                    class="flex items-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-emerald-600 transition-all shadow-xl shadow-slate-200">
                    <i data-lucide="file-plus" class="w-4 h-4 text-emerald-400"></i>
                    Buat Tugas Baru
                </button>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-8">

            <div class="col-span-12 lg:col-span-7 space-y-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-black text-slate-800 flex items-center gap-2">
                        <span class="w-2 h-6 bg-blue-500 rounded-full"></span>
                        Materi Pembelajaran
                    </h3>
                    <a href="#" class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="group bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div
                            class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i data-lucide="file-text" class="w-6 h-6"></i>
                        </div>
                        <div class="space-y-2 mb-6">
                            <h4 class="font-black text-slate-800 text-lg leading-tight">Operasi Hitung Pecahan</h4>
                            <p class="text-xs text-slate-500 leading-relaxed line-clamp-2">Modul lengkap materi bilangan
                                pecahan desimal dan persen untuk persiapan PH-1.</p>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Diunggah</span>
                                <span class="text-xs font-black text-slate-700">12 Feb 2026</span>
                            </div>
                            <button
                                class="p-3 bg-slate-50 text-slate-400 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all">
                                <i data-lucide="download" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <div
                        class="group bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div
                            class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                            <i data-lucide="video" class="w-6 h-6"></i>
                        </div>
                        <div class="space-y-2 mb-6">
                            <h4 class="font-black text-slate-800 text-lg leading-tight">Video: Akar Pangkat 3</h4>
                            <p class="text-xs text-slate-500 leading-relaxed line-clamp-2">Tutorial cara cepat menghitung
                                akar pangkat tiga untuk angka ribuan.</p>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Diunggah</span>
                                <span class="text-xs font-black text-slate-700">10 Feb 2026</span>
                            </div>
                            <button
                                class="p-3 bg-slate-50 text-slate-400 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all">
                                <i data-lucide="external-link" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-5 space-y-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-black text-slate-800 flex items-center gap-2">
                        <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
                        Daftar Tugas
                    </h3>
                </div>

                <div class="space-y-4">
                    <div
                        class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-4">
                            <div class="space-y-1">
                                <h4 class="font-black text-slate-800">Latihan Bangun Ruang</h4>
                                <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase">
                                    <i data-lucide="users" class="w-3 h-3"></i>
                                    Kelas 6A, 6B
                                </div>
                            </div>
                            <span
                                class="px-3 py-1 bg-emerald-100 text-emerald-600 text-[10px] font-black rounded-lg uppercase tracking-wider">AKTIF</span>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-4 h-4 text-orange-400"></i>
                                <span class="text-xs font-bold text-slate-600">Deadline: <span class="text-slate-900">Besok,
                                        12:00</span></span>
                            </div>
                            <button class="text-xs font-black text-emerald-600 group-hover:underline">Detail →</button>
                        </div>
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-emerald-500"></div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden opacity-75 group">
                        <div class="flex justify-between items-start mb-4">
                            <div class="space-y-1">
                                <h4 class="font-black text-slate-700">Kuis Aljabar Dasar</h4>
                                <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase">
                                    <i data-lucide="users" class="w-3 h-3"></i>
                                    Kelas 6A
                                </div>
                            </div>
                            <span
                                class="px-3 py-1 bg-red-100 text-red-600 text-[10px] font-black rounded-lg uppercase tracking-wider">LEWAT</span>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                            <div class="flex items-center gap-2">
                                <i data-lucide="calendar-x" class="w-4 h-4 text-slate-400"></i>
                                <span class="text-xs font-bold text-slate-400">Selesai pada: 08 Feb 2026</span>
                            </div>
                            <button class="text-xs font-black text-slate-400">Rekap Nilai</button>
                        </div>
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-red-500"></div>
                    </div>
                </div>

                <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-2xl relative overflow-hidden mt-10">
                    <div class="relative z-10">
                        <p class="text-emerald-400 text-[10px] font-black uppercase tracking-[0.2em] mb-4">Summary</p>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-3xl font-black">14</p>
                                <p class="text-xs text-slate-400 font-bold">Materi Aktif</p>
                            </div>
                            <div>
                                <p class="text-3xl font-black">02</p>
                                <p class="text-xs text-slate-400 font-bold">Tugas Berjalan</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>

    </main>
@endsection
