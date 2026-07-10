@extends('layouts.guru')
@section('content')
    <main class="flex-1 p-4 lg:p-8 overflow-y-auto max-h-screen custom-scrollbar">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Dashboard Guru</h2>
                <p class="text-slate-500 text-sm">Assalamualaikum, Selamat bertugas hari ini Ust. Abdullah!</p>
            </div>
            <div class="flex items-center gap-3 bg-white p-1.5 rounded-2xl shadow-sm border border-slate-100">
                <div class="flex flex-col items-end px-3">
                    <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-tighter">Semester
                        Ganjil</span>
                    <span class="text-xs font-semibold text-slate-500">TP 2024/2025</span>
                </div>
                <div class="h-8 w-[1px] bg-slate-200"></div>
                <div class="px-3 py-1 flex flex-col items-center">
                    <span class="text-xs font-bold text-slate-800" id="currentDate">--</span>
                    <span class="text-[10px] text-slate-400 uppercase" id="hijriDate">14 Rajab 1446H</span>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Card 1 -->
            <div
                class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:scale-[1.02] transition-all cursor-default group">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full">+2
                        Smt Ini</span>
                </div>
                <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Total Siswa Binaan</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">32 <span
                        class="text-sm font-normal text-slate-400">Siswa</span></h3>
            </div>
            <!-- Card 2 -->
            <div
                class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:scale-[1.02] transition-all cursor-default group">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="p-2.5 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-1 bg-blue-100 text-blue-700 rounded-full">3 Jam
                        Lagi</span>
                </div>
                <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Jadwal Hari Ini</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">4 <span
                        class="text-sm font-normal text-slate-400">Mapel</span></h3>
            </div>
            <!-- Card 3 -->
            <div
                class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:scale-[1.02] transition-all cursor-default group">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="p-2.5 bg-amber-50 text-amber-600 rounded-xl group-hover:bg-amber-600 group-hover:text-white transition-colors">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-1 bg-amber-100 text-amber-700 rounded-full">3 Perlu
                        Dinilai</span>
                </div>
                <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Tugas Aktif</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">12 <span
                        class="text-sm font-normal text-slate-400">Siswa</span></h3>
            </div>
            <!-- Card 4 -->
            <div
                class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:scale-[1.02] transition-all cursor-default group">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="p-2.5 bg-rose-50 text-rose-600 rounded-xl group-hover:bg-rose-600 group-hover:text-white transition-colors">
                        <i data-lucide="user-x" class="w-5 h-5"></i>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-1 bg-rose-100 text-rose-700 rounded-full">94.5%
                        Avg</span>
                </div>
                <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Absensi Hari Ini</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">2 <span
                        class="text-sm font-normal text-slate-400">Alpha</span></h3>
            </div>
        </div>

        <!-- Middle Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Timeline Jadwal -->
            <div class="lg:col-span-1 flex flex-col gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex-1">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="font-bold text-slate-800">Timeline Mengajar</h4>
                        <button class="text-emerald-600 text-xs font-bold hover:underline">Lihat Semua</button>
                    </div>

                    <div
                        class="space-y-6 relative before:absolute before:inset-y-0 before:left-3.5 before:w-[2px] before:bg-slate-100">
                        <!-- Item 1 -->
                        <div class="relative pl-10">
                            <div
                                class="absolute left-0 top-1 w-7 h-7 bg-emerald-100 border-4 border-white rounded-full flex items-center justify-center text-emerald-600 z-10 shadow-sm">
                                <div class="w-1.5 h-1.5 bg-emerald-600 rounded-full"></div>
                            </div>
                            <div>
                                <span
                                    class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded uppercase">07:30
                                    - 09:00</span>
                                <h5 class="text-sm font-bold text-slate-800 mt-1 uppercase">Matematika</h5>
                                <p class="text-xs text-slate-500">Kelas 6A - Lab Komputer</p>
                                <div class="mt-2 flex items-center gap-2">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                    <span class="text-[10px] font-medium text-emerald-600">Sedang
                                        Berlangsung</span>
                                </div>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="relative pl-10 opacity-60">
                            <div
                                class="absolute left-0 top-1 w-7 h-7 bg-slate-100 border-4 border-white rounded-full flex items-center justify-center text-slate-400 z-10">
                                <div class="w-1.5 h-1.5 bg-slate-400 rounded-full"></div>
                            </div>
                            <div>
                                <span
                                    class="text-[10px] font-bold text-slate-400 bg-slate-50 px-2 py-0.5 rounded uppercase">09:30
                                    - 11:00</span>
                                <h5 class="text-sm font-bold text-slate-800 mt-1 uppercase">Bahasa Arab</h5>
                                <p class="text-xs text-slate-500">Kelas 6A - Ruang Utama</p>
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="relative pl-10 opacity-60">
                            <div
                                class="absolute left-0 top-1 w-7 h-7 bg-slate-100 border-4 border-white rounded-full flex items-center justify-center text-slate-400 z-10">
                                <div class="w-1.5 h-1.5 bg-slate-400 rounded-full"></div>
                            </div>
                            <div>
                                <span
                                    class="text-[10px] font-bold text-slate-400 bg-slate-50 px-2 py-0.5 rounded uppercase">11:15
                                    - 12:30</span>
                                <h5 class="text-sm font-bold text-slate-800 mt-1 uppercase">Fiqih</h5>
                                <p class="text-xs text-slate-500">Kelas 6B - Lantai 2</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mini Info -->
                <div
                    class="bg-emerald-600 p-6 rounded-2xl shadow-lg shadow-emerald-200 text-white relative overflow-hidden">
                    <i data-lucide="sparkles" class="absolute -right-4 -top-4 w-24 h-24 text-white/10 rotate-12"></i>
                    <h4 class="font-bold mb-2">Pesan Untuk Ustaz:</h4>
                    <p class="text-xs text-emerald-100 leading-relaxed italic">"Pendidikan bukan hanya soal mengisi
                        ember, tetapi menyalakan api."</p>
                    <p class="text-[10px] mt-4 font-bold uppercase tracking-widest text-emerald-200">- W.B. Yeats
                    </p>
                </div>
            </div>

            <!-- Charts & Stats -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Attendance Chart -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h4 class="font-bold text-slate-800">Tren Kehadiran Siswa</h4>
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-tight">Rata-rata
                                kehadiran mingguan</p>
                        </div>
                        <div class="flex gap-2">
                            <select
                                class="text-xs border-none bg-slate-50 rounded-lg px-3 py-1.5 focus:ring-2 focus:ring-emerald-500 outline-none font-semibold">
                                <option>Bulan Ini</option>
                                <option>Bulan Lalu</option>
                            </select>
                        </div>
                    </div>
                    <div class="h-[250px]">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>

                <!-- Bottom Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Grade Distribution -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h4 class="font-bold text-slate-800 mb-6 text-sm uppercase tracking-wide">Distribusi Nilai
                            (MTK)</h4>
                        <div class="h-[200px] flex items-center justify-center">
                            <canvas id="gradeDistributionChart"></canvas>
                        </div>
                        <div class="mt-4 grid grid-cols-2 gap-2">
                            <div class="p-2 bg-slate-50 rounded-xl flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                <span class="text-[10px] font-bold text-slate-600">Tuntas: 28</span>
                            </div>
                            <div class="p-2 bg-slate-50 rounded-xl flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-rose-500"></div>
                                <span class="text-[10px] font-bold text-slate-600">Remed: 4</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tasks/Materials -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h4 class="font-bold text-slate-800 mb-6 text-sm uppercase tracking-wide">Materi & Tugas
                            Terbaru</h4>
                        <div class="space-y-4">
                            <div
                                class="flex items-center gap-4 p-3 hover:bg-slate-50 rounded-xl transition-all cursor-pointer border border-transparent hover:border-slate-100 group">
                                <div
                                    class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i data-lucide="file-text" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1 overflow-hidden">
                                    <p class="text-xs font-bold text-slate-800 truncate">Aljabar Sederhana</p>
                                    <p class="text-[10px] text-slate-400 uppercase">Tugas • 6A • 2 Hari lagi</p>
                                </div>
                                <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300"></i>
                            </div>
                            <div
                                class="flex items-center gap-4 p-3 hover:bg-slate-50 rounded-xl transition-all cursor-pointer border border-transparent hover:border-slate-100 group">
                                <div
                                    class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i data-lucide="video" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1 overflow-hidden">
                                    <p class="text-xs font-bold text-slate-800 truncate">Tata Cara Shalat Gerhana
                                    </p>
                                    <p class="text-[10px] text-slate-400 uppercase">Materi • Video • Selesai</p>
                                </div>
                                <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300"></i>
                            </div>
                            <div
                                class="flex items-center gap-4 p-3 hover:bg-slate-50 rounded-xl transition-all cursor-pointer border border-transparent hover:border-slate-100 group">
                                <div
                                    class="w-10 h-10 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i data-lucide="layers" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1 overflow-hidden">
                                    <p class="text-xs font-bold text-slate-800 truncate">Latihan Kuis Fiqih 02</p>
                                    <p class="text-[10px] text-slate-400 uppercase">Kuis • Online • Aktif</p>
                                </div>
                                <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
