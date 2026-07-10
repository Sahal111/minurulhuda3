@extends('layouts.operator')
@section('content')


        <!-- PAGE CONTAINER: DASHBOARD -->
        <div id="page-dashboard" class="page-content p-4 lg:p-8 space-y-8 animate-modal">

            <!-- Alerts Section -->
            <div class="grid grid-cols-1 gap-4">
                <div
                    class="bg-amber-50 dark:bg-amber-950/20 border border-amber-200 dark:border-amber-900/50 rounded-3xl p-5 flex items-start gap-4 shadow-sm border-l-4 border-l-amber-500">
                    <div
                        class="p-2.5 bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 rounded-2xl shrink-0">
                        <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-lexend font-bold text-amber-800 dark:text-amber-400 text-sm">System Alert
                            (Action Required)</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
                            <div class="flex items-center gap-2 text-xs text-amber-700 dark:text-amber-500/80">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                12 Siswa belum punya kelas
                            </div>
                            <div class="flex items-center gap-2 text-xs text-amber-700 dark:text-amber-500/80">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                5 Guru belum assign mapel
                            </div>
                            <div class="flex items-center gap-2 text-xs text-amber-700 dark:text-amber-500/80">
                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                Tahun Ajaran 2025/2026 Belum Aktif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
                <!-- Siswa -->
                <div
                    class="bg-white dark:bg-slate-800 p-5 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all group">
                    <div
                        class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Total Siswa</p>
                    <h3 class="text-3xl font-lexend font-bold text-slate-800 dark:text-white mt-1">1,248</h3>
                    <p class="text-[10px] text-emerald-600 font-bold mt-2">+12 bulan ini</p>
                </div>
                <!-- Guru -->
                <div
                    class="bg-white dark:bg-slate-800 p-5 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all group">
                    <div
                        class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-all">
                        <i data-lucide="user-check" class="w-6 h-6"></i>
                    </div>
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Total Guru</p>
                    <h3 class="text-3xl font-lexend font-bold text-slate-800 dark:text-white mt-1">42</h3>
                    <p class="text-[10px] text-blue-600 font-bold mt-2">Aktif mengajar</p>
                </div>
                <!-- Kelas -->
                <div
                    class="bg-white dark:bg-slate-800 p-5 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all group">
                    <div
                        class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:text-white transition-all">
                        <i data-lucide="door-open" class="w-6 h-6"></i>
                    </div>
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Total Kelas</p>
                    <h3 class="text-3xl font-lexend font-bold text-slate-800 dark:text-white mt-1">18</h3>
                    <p class="text-[10px] text-purple-600 font-bold mt-2">Kapasitas penuh</p>
                </div>
                <!-- User Aktif -->
                <div
                    class="bg-white dark:bg-slate-800 p-5 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all group">
                    <div
                        class="w-12 h-12 bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-orange-600 group-hover:text-white transition-all">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                    </div>
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">User Aktif</p>
                    <h3 class="text-3xl font-lexend font-bold text-slate-800 dark:text-white mt-1">156</h3>
                    <p class="text-[10px] text-orange-600 font-bold mt-2">Login hari ini</p>
                </div>
                <!-- TA Aktif -->
                <div
                    class="bg-white dark:bg-slate-800 p-5 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all group">
                    <div
                        class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <i data-lucide="calendar" class="w-6 h-6"></i>
                    </div>
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">TA Aktif</p>
                    <h3 class="text-3xl font-lexend font-bold text-slate-800 dark:text-white mt-1">24/25</h3>
                    <p class="text-[10px] text-indigo-600 font-bold mt-2">Semester Ganjil</p>
                </div>
                <!-- Belum Lengkap -->
                <div
                    class="bg-white dark:bg-slate-800 p-5 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all group">
                    <div
                        class="w-12 h-12 bg-rose-50 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-rose-600 group-hover:text-white transition-all">
                        <i data-lucide="file-warning" class="w-6 h-6"></i>
                    </div>
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Data Error</p>
                    <h3 class="text-3xl font-lexend font-bold text-slate-800 dark:text-white mt-1">24</h3>
                    <p class="text-[10px] text-rose-600 font-bold mt-2">Validasi segera</p>
                </div>
            </div>

            <!-- Dashboard Charts / Feeds -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Aktivitas Sistem -->
                <div
                    class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-slate-50 dark:border-slate-700 flex justify-between items-center">
                        <h3 class="font-lexend font-bold text-slate-800 dark:text-white">Aktivitas Sistem Terbaru</h3>
                        <div class="flex gap-2">
                            <button class="p-2 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-xl transition-all">
                                <i data-lucide="refresh-cw" class="w-4 h-4 text-slate-400"></i>
                            </button>
                            <button
                                class="text-xs font-bold text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 px-4 py-2 rounded-xl transition-all">Filter</button>
                        </div>
                    </div>
                    <div class="p-6 flex-1 overflow-y-auto max-h-[450px] custom-scrollbar">
                        <div class="space-y-6">
                            <!-- Activity 1 -->
                            <div class="flex gap-4 group">
                                <div
                                    class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-xl flex items-center justify-center shrink-0">
                                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1 border-b border-slate-50 dark:border-slate-700 pb-4">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm font-bold text-slate-800 dark:text-slate-200">Siswa Baru
                                            Ditambahkan</p>
                                        <span class="text-[10px] text-slate-400 font-medium">Baru saja</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">Operator <span
                                            class="text-emerald-600 font-bold">Aris</span> mendaftarkan Muhammad Rehan
                                        (NIS: 23144)</p>
                                </div>
                            </div>
                            <!-- Activity 2 -->
                            <div class="flex gap-4 group">
                                <div
                                    class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-xl flex items-center justify-center shrink-0">
                                    <i data-lucide="file-check" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1 border-b border-slate-50 dark:border-slate-700 pb-4">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm font-bold text-slate-800 dark:text-slate-200">Import Berhasil
                                        </p>
                                        <span class="text-[10px] text-slate-400 font-medium">12 menit lalu</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">Berhasil mengimpor 45 data Nilai Semester
                                        dari file template_nilai.xlsx</p>
                                </div>
                            </div>
                            <!-- Activity 3 -->
                            <div class="flex gap-4 group">
                                <div
                                    class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 rounded-xl flex items-center justify-center shrink-0">
                                    <i data-lucide="lock" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1 border-b border-slate-50 dark:border-slate-700 pb-4">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm font-bold text-slate-800 dark:text-slate-200">Perubahan Hak
                                            Akses</p>
                                        <span class="text-[10px] text-slate-400 font-medium">1 jam lalu</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">Role 'Guru Piket' ditambahkan ke user
                                        Fatimah Az-Zahra</p>
                                </div>
                            </div>
                            <!-- Activity 4 -->
                            <div class="flex gap-4 group">
                                <div
                                    class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-xl flex items-center justify-center shrink-0">
                                    <i data-lucide="cloud-upload" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm font-bold text-slate-800 dark:text-slate-200">Backup Otomatis
                                            Selesai</p>
                                        <span class="text-[10px] text-slate-400 font-medium">04:00 AM</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">Database berhasil dicadangkan ke Google
                                        Drive (Size: 24.5 MB)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Server / Widget Kanan -->
                <div class="space-y-6">
                    <div class="bg-emerald-900 text-white rounded-[2.5rem] p-8 shadow-xl relative overflow-hidden group">
                        <div
                            class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-800 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700">
                        </div>
                        <h4 class="text-lg font-lexend font-bold mb-4 relative z-10">Integrasi Dapodik</h4>
                        <div class="space-y-4 relative z-10">
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-emerald-300">Terakhir Sinkron</span>
                                <span class="font-bold">Hari ini, 08:30</span>
                            </div>
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-emerald-300">Status Koneksi</span>
                                <span class="flex items-center gap-1.5 font-bold text-emerald-400">
                                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                                    Terhubung
                                </span>
                            </div>
                            <button
                                class="w-full py-3 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl text-xs font-bold transition-all backdrop-blur-sm mt-4">Sinkronisasi
                                Sekarang</button>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-slate-800 rounded-[2.5rem] p-6 shadow-sm border border-slate-100 dark:border-slate-700">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-sm font-bold text-slate-800 dark:text-white">Storage Usage</h4>
                            <span
                                class="text-[10px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-0.5 rounded-lg">Optimized</span>
                        </div>
                        <div class="space-y-4">
                            <div class="w-full h-3 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 w-[65%]" title="Database"></div>
                                <div class="h-full bg-blue-500 w-[15%]" title="Assets"></div>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="flex items-center gap-2 text-[10px] text-slate-500">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Database (15GB)
                                </div>
                                <div class="flex items-center gap-2 text-[10px] text-slate-500">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Files (3.2GB)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
