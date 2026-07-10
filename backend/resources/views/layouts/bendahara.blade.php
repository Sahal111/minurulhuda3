<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Bendahara | MI Nurul Huda 3</title>
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lexend:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        lexend: ['Lexend', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .font-lexend {
            font-family: 'Lexend', sans-serif;
        }

        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
    </style>
</head>

<body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 transition-colors duration-300">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen sidebar-transition -translate-x-full lg:translate-x-0">
        <div class="h-full px-4 py-6 overflow-y-auto bg-emerald-800 dark:bg-emerald-950 text-white flex flex-col">
            <!-- Logo Section -->
            <div class="flex items-center gap-3 px-2 mb-8">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-emerald-800 font-bold text-xl font-lexend">NH</span>
                </div>
                <div>
                    <h2 class="font-lexend font-bold text-sm leading-tight">MI Nurul Huda 3</h2>
                    <p class="text-[10px] text-emerald-200 uppercase tracking-widest">Bendahara Portal</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-1 flex-1">
                <p class="px-3 text-[10px] font-semibold text-emerald-400 uppercase mb-2">Main Menu</p>

                <a href="{{ route('bendahara.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-emerald-700/50 text-white font-medium border border-emerald-600/50 shadow-sm transition-all">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('bendahara.spp') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-emerald-100 hover:bg-emerald-700/30 hover:text-white transition-all group">
                    <i data-lucide="credit-card" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    <span>Pembayaran SPP</span>
                </a>

                <a href="{{ route('bendahara.transaksi') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-emerald-100 hover:bg-emerald-700/30 hover:text-white transition-all group">
                    <i data-lucide="arrow-left-right" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    <span>Transaksi</span>
                </a>

                <a href="{{ route('bendahara.laporan') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-emerald-100 hover:bg-emerald-700/30 hover:text-white transition-all group">
                    <i data-lucide="file-text" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    <span>Laporan Keuangan</span>
                </a>

                <a href="{{ route('bendahara.rekap') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-emerald-100 hover:bg-emerald-700/30 hover:text-white transition-all group">
                    <i data-lucide="alert-circle" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    <span>Rekap Tunggakan</span>
                </a>

                <p class="px-3 text-[10px] font-semibold text-emerald-400 uppercase mt-6 mb-2">System</p>

                <a href="{{ route('bendahara.audit') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-emerald-100 hover:bg-emerald-700/30 hover:text-white transition-all group">
                    <i data-lucide="shield-check" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    <span>Audit Transaksi</span>
                </a>

                <a href="{{ route('bendahara.setting') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-emerald-100 hover:bg-emerald-700/30 hover:text-white transition-all group">
                    <i data-lucide="settings" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>

            <!-- User Bottom -->
            <div class="mt-auto pt-6 border-t border-emerald-700/50">
                <div class="flex items-center gap-3 px-2 mb-4">
                    <div
                        class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-800 border-2 border-white overflow-hidden">
                        <img src="/assets/default-avatar.svg" alt="avatar">
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold truncate">Usth. Siti Aminah</p>
                        <p class="text-[10px] text-emerald-300">Bendahara</p>
                    </div>
                </div>
                <button
                    class="w-full flex items-center justify-center gap-2 py-2.5 bg-red-500/20 hover:bg-red-500/30 text-red-200 rounded-xl transition-all border border-red-500/20">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span class="text-sm font-medium">Logout</span>
                </button>
            </div>
        </div>
    </aside>

    @yield('content')
    <script src="/js/shared/utils.js"></script>
    <script src="/js/layouts/bendahara.js"></script>
    @stack('scripts')
</body>

</html>
