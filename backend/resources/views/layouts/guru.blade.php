<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Guru - MI Nurul Huda 3</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        @media (max-width: 1024px) {
            .sidebar-hidden {
                transform: translateX(-100%);
            }
        }

        .menu-item {
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background: rgba(16, 185, 129, 0.15);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    <!-- Mobile Header -->
    <header class="lg:hidden bg-emerald-800 text-white p-4 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-emerald-800 font-bold">NH</div>
            <span class="font-semibold tracking-wide">Guru Panel</span>
        </div>
        <button id="toggleMobileSidebar" class="p-2 hover:bg-emerald-700 rounded-lg">
            <i data-lucide="menu"></i>
        </button>
    </header>

    <div class="flex min-h-screen relative">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="sidebar-hidden lg:transform-none fixed lg:static inset-y-0 left-0 w-64 bg-emerald-800 text-white z-50 sidebar-transition shadow-2xl flex flex-col">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-8">
                    <div
                        class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-emerald-800 font-bold shadow-lg">
                        NH</div>
                    <div>
                        <h1 class="font-bold text-sm leading-tight">MI NURUL HUDA 3</h1>
                        <p class="text-[10px] text-emerald-300 tracking-widest uppercase">Teacher Portal</p>
                    </div>
                </div>

                <nav class="space-y-1">
                    <p class="text-[10px] font-bold text-emerald-400 mb-2 px-3 tracking-widest uppercase">Main Menu</p>
                    <a href="{{ route('guru.dashboard') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl bg-emerald-600 shadow-lg text-white group transition-all">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>
                    <a href="{{ route('guru.jadwal') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all group">
                        <i data-lucide="calendar" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium">Jadwal Mengajar</span>
                    </a>
                    <a href="{{ route('guru.absensi') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all group">
                        <i data-lucide="user-check" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium">Absensi Siswa</span>
                    </a>
                    <a href="{{ route('guru.penilaian') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all group">
                        <i data-lucide="edit-3" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium">Penilaian (E-Rapor)</span>
                    </a>
                    <a href="{{ route('guru.materiTugas') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all group">
                        <i data-lucide="book-open" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium">Materi & Tugas</span>
                    </a>

                    <p class="text-[10px] font-bold text-emerald-400 mt-6 mb-2 px-3 tracking-widest uppercase">Reporting
                    </p>
                    <a href="{{ route('guru.analitikKelas') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all">
                        <i data-lucide="bar-chart-2" class="w-5 h-5"></i>
                        <span class="text-sm font-medium">Analitik Kelas</span>
                    </a>
                    <a href="{{ route('guru.rekapAkademik') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all">
                        <i data-lucide="archive" class="w-5 h-5"></i>
                        <span class="text-sm font-medium">Rekap Akademik</span>
                    </a>
                    <!-- WALI KELAS SECTION -->
                    <p class="text-[10px] font-bold text-emerald-400 mt-6 mb-2 px-3 tracking-widest uppercase">
                        Wali Kelas
                    </p>

                    <a href="{{ route('guru.wali.dashboard') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all group">
                        <i data-lucide="users" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium">Dashboard Wali</span>
                    </a>

                    <a href="{{ route('guru.wali.dataSiswa') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all group">
                        <i data-lucide="user" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium">Data Siswa Kelas</span>
                    </a>

                    <a href="{{ route('guru.wali.rekapAbsensi') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all group">
                        <i data-lucide="clipboard-check" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium">Rekap Absensi Kelas</span>
                    </a>

                    <a href="{{ route('guru.wali.rekapNilai') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all group">
                        <i data-lucide="bar-chart-3" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium">Rekap Nilai Kelas</span>
                    </a>

                    <a href="{{ route('guru.wali.catatan') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all group">
                        <i data-lucide="file-text" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium">Catatan Wali</span>
                    </a>

                    <a href="{{ route('guru.wali.monitoringSpp') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all group">
                        <i data-lucide="wallet" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium">Monitoring Tunggakan</span>
                    </a>

                    <a href="{{ route('guru.wali.cetakRapor') }}"
                        class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-xl rounded-xl hover:bg-emerald-700 text-emerald-100 transition-all group">
                        <i data-lucide="printer" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm font-medium">Cetak Rapor</span>
                    </a>

                </nav>
            </div>


            <div class="mt-auto p-4 border-t border-emerald-700/50">
                <a href="{{ route('guru.setting') }}" class="block group transition-all duration-300">

                    <div
                        class="flex items-center gap-3 p-2 bg-emerald-900/30 
                rounded-2xl mb-4 hover:bg-emerald-800/40 
                hover:shadow-lg hover:scale-[1.02] 
                transition-all duration-300 cursor-pointer">

                        <img src="https://ui-avatars.com/api/?name=Ust.+Abdullah&background=059669&color=fff"
                            class="w-10 h-10 rounded-xl object-cover 
                   border border-emerald-600 
                   group-hover:border-emerald-400 
                   transition"
                            alt="Profile">

                        <div class="overflow-hidden">
                            <p
                                class="text-xs font-bold truncate 
                     group-hover:text-white transition">
                                Ust. Abdullah, S.Pd
                            </p>
                            <p
                                class="text-[10px] text-emerald-400 
                     group-hover:text-emerald-300 transition">
                                Guru Kelas 6A
                            </p>
                            <span
                                class="inline-block mt-1 px-2 py-0.5 text-[9px] font-semibold 
      bg-emerald-600/30 text-emerald-200 rounded-full">
                                Wali Kelas
                            </span>

                        </div>

                    </div>
                </a>


                <button
                    class="flex items-center gap-3 w-full px-3 py-2 rounded-xl text-red-300 hover:bg-red-500/10 transition-all">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span class="text-sm font-medium">Logout System</span>
                </button>
            </div>
        </aside>
        <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden lg:hidden z-40"></div>


        <!-- Main Content -->
        @yield('content')
    </div>

    <script src="/js/shared/utils.js"></script>
    <script src="/js/layouts/guru.js"></script>
    @stack('scripts')
</body>

</html>
