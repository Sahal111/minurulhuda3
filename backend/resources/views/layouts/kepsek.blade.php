<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Principal Executive Dashboard - MI Nurul Huda 3</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;family=Lexend:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#10b981", // Emerald 500
                        "primary-dark": "#047857", // Emerald 700
                        "primary-light": "#d1fae5", // Emerald 100
                        "accent": "#f59e0b", // Amber 500 for Islamic warmth
                        "background-light": "#f8fafc", // Slate 50
                        "background-dark": "#0f172a", // Slate 900
                        "sidebar-bg": "#065f46", // Emerald 800 (as requested)
                        "sidebar-hover": "#047857", // Emerald 700
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b", // Slate 800
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"],
                        "body": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "2xl": "1.5rem",
                        "3xl": "2rem",
                        "full": "9999px"
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                        'card': '0 2px 10px rgba(0, 0, 0, 0.03)',
                        'glow': '0 0 15px rgba(16, 185, 129, 0.3)',
                    }
                },
            },
        }
    </script>
    <style>
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .chart-gradient {
            fill: url(#chartGradient);
        }

        .chart-line {
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            animation: dash 2s ease-in-out forwards;
        }

        @keyframes dash {
            to {
                stroke-dashoffset: 0;
            }
        }

        #sidebar-toggle:checked~.sidebar-overlay {
            display: block;
        }

        #sidebar-toggle:checked~.sidebar-menu {
            transform: translateX(0);
        }
    </style>
    <style type="text/tailwindcss">
        @layer utilities {
            .mesh-gradient {
                background-color: #065f46;
                background-image:
                    radial-gradient(at 0% 0%, #10b981 0px, transparent 50%),
                    radial-gradient(at 100% 0%, #059669 0px, transparent 50%),
                    radial-gradient(at 100% 100%, #115e59 0px, transparent 50%),
                    radial-gradient(at 0% 100%, #064e3b 0px, transparent 50%);
            }

            .glass-card {
                @apply backdrop-blur-xl bg-white/70 dark:bg-slate-800/60 border border-white/40 dark:border-white/10;
            }

            .hide-scroll::-webkit-scrollbar {
                display: none;
            }

            .custom-switch:checked+label .dot {
                transform: translateX(1.25rem);
            }

            .custom-switch:checked+label .bg {
                @apply bg-emerald-500;
            }
        }
    </style>
    <style>
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #sidebar-toggle:checked~.sidebar-overlay {
            display: block;
        }

        #sidebar-toggle:checked~.sidebar-menu {
            transform: translateX(0);
        }

        .expand-trigger:checked~.expandable-content {
            max-height: 800px;
            opacity: 1;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
        }

        .expand-trigger:checked~.card-header .expand-icon {
            transform: rotate(180deg);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .dark .glass-card {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .segmented-control {
            background: rgba(241, 245, 249, 0.8);
            border-radius: 9999px;
            padding: 4px;
        }

        .dark .segmented-control {
            background: rgba(15, 23, 42, 0.6);
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-100 font-body min-h-screen transition-colors duration-300 antialiased overflow-x-hidden">
    <input class="hidden" id="sidebar-toggle" type="checkbox" />
    <div class="sidebar-overlay fixed inset-0 bg-black/50 z-40 hidden lg:hidden"
        onclick="document.getElementById('sidebar-toggle').checked = false"></div>
    <aside
        class="sidebar-menu fixed top-0 left-0 bottom-0 w-72 bg-emerald-800 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col shadow-2xl lg:shadow-none overflow-hidden">
        <div class="h-20 flex items-center gap-3 px-6 border-b border-emerald-700/50 bg-emerald-900/20">
            <div
                class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-emerald-700 font-display font-bold text-sm shadow-glow shrink-0">
                NH
            </div>
            <div>
                <h1 class="text-base font-display font-bold text-white leading-none">MI Nurul Huda 3</h1>
                <p class="text-[11px] text-emerald-200/80 font-medium mt-0.5">Principal ERP</p>
            </div>
        </div>
        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1 hide-scroll">
            <div class="mb-4">
                <p class="px-4 text-[10px] font-bold text-emerald-300/60 uppercase tracking-widest mb-2">Main Menu</p>
                <a class="flex items-center gap-3 px-4 py-3 bg-white/10 text-white rounded-xl transition-all group border border-white/10 shadow-lg"
                    href="{{ route('kepsek.dashboard') }}">
                    <i
                        class="material-icons-round text-emerald-300 group-hover:text-white transition-colors">dashboard</i>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-emerald-700/50 hover:text-white rounded-xl transition-all group mt-1"
                    href="{{ route('kepsek.akademik') }}">
                    <i
                        class="material-icons-round text-emerald-300/70 group-hover:text-white transition-colors">school</i>
                    <span class="text-sm font-medium">Monitoring Akademik</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-emerald-700/50 hover:text-white rounded-xl transition-all group mt-1"
                    href="{{ route('kepsek.sdm') }}">
                    <i
                        class="material-icons-round text-emerald-300/70 group-hover:text-white transition-colors">people</i>
                    <span class="text-sm font-medium">Monitoring SDM</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-emerald-700/50 hover:text-white rounded-xl transition-all group mt-1"
                    href="{{ route('kepsek.keuangan') }}">
                    <i
                        class="material-icons-round text-emerald-300/70 group-hover:text-white transition-colors">account_balance_wallet</i>
                    <span class="text-sm font-medium">Monitoring Keuangan</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-emerald-700/50 hover:text-white rounded-xl transition-all group mt-1"
                    href="{{ route('kepsek.ppdb') }}">
                    <i
                        class="material-icons-round text-emerald-300/70 group-hover:text-white transition-colors">how_to_reg</i>
                    <span class="text-sm font-medium">Monitoring PPDB</span>
                </a>
            </div>
            <div class="mb-4">
                <p class="px-4 text-[10px] font-bold text-emerald-300/60 uppercase tracking-widest mb-2">Operations</p>
                <a class="flex items-center justify-between px-4 py-3 text-emerald-100 hover:bg-emerald-700/50 hover:text-white rounded-xl transition-all group"
                    href="{{ route('kepsek.approval') }}">
                    <div class="flex items-center gap-3">
                        <i
                            class="material-icons-round text-emerald-300/70 group-hover:text-white transition-colors">verified_user</i>
                        <span class="text-sm font-medium">Approval &amp; Validasi</span>
                    </div>
                    <span
                        class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm">3</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-emerald-700/50 hover:text-white rounded-xl transition-all group mt-1"
                    href="{{ route('kepsek.laporan') }}">
                    <i
                        class="material-icons-round text-emerald-300/70 group-hover:text-white transition-colors">assignment</i>
                    <span class="text-sm font-medium">Laporan Terpadu</span>
                </a>
                <a class="flex items-center justify-between px-4 py-3 text-emerald-100 hover:bg-emerald-700/50 hover:text-white rounded-xl transition-all group mt-1"
                    href="{{ route('kepsek.notifikasi') }}">
                    <div class="flex items-center gap-3">
                        <i
                            class="material-icons-round text-emerald-300/70 group-hover:text-white transition-colors">notifications_active</i>
                        <span class="text-sm font-medium">Notifikasi</span>
                    </div>
                    <span
                        class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm">5</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-emerald-700/50 hover:text-white rounded-xl transition-all group mt-1"
                    href="{{ route('kepsek.auditLog') }}">
                    <i
                        class="material-icons-round text-emerald-300/70 group-hover:text-white transition-colors">history</i>
                    <span class="text-sm font-medium">Audit Log</span>
                </a>
            </div>
            <div>
                <p class="px-4 text-[10px] font-bold text-emerald-300/60 uppercase tracking-widest mb-2">System</p>
                <a class="flex items-center gap-3 px-4 py-3 text-emerald-100 hover:bg-emerald-700/50 hover:text-white rounded-xl transition-all group"
                    href="{{ route('kepsek.setting') }}">
                    <i
                        class="material-icons-round text-emerald-300/70 group-hover:text-white transition-colors">settings</i>
                    <span class="text-sm font-medium">Profil &amp; Pengaturan</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-red-300 hover:bg-red-900/30 hover:text-red-100 rounded-xl transition-all group mt-1"
                    href="#">
                    <i class="material-icons-round text-red-400 group-hover:text-red-200 transition-colors">logout</i>
                    <span class="text-sm font-medium">Logout</span>
                </a>
            </div>
        </nav>
        <div class="p-4 bg-emerald-900/30 border-t border-emerald-700/50">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-emerald-700 flex items-center justify-center overflow-hidden border-2 border-emerald-500">
                    <img alt="Profile" class="w-full h-full object-cover"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDY7vamtqBK039NU-0nqRTIMnKS1DXXfPIgZoQWlUY9zjMpfq2cbTS7EK4_nCohiGjYdvjfUEKMLy6GRZHl7xQzJg7CG1TBYnfF_diFPXYMSgGZhTYOy274B_iiAjAVbxS1rCKOJDpGgHNNP8J9vFNqpZlogRkgvr-JyV98IgrI5LlncsQLcKW1XpWtfbJJeX021QhAzRhP2LlrpTkL_lSGhuPUFJMRQtor458xuRCydx9-U3zycCs1MS-gkniXyxYBrNBA_0XcKqs" />
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate">Ust. Abdullah</p>
                    <p class="text-[10px] text-emerald-300 truncate">Principal</p>
                </div>
            </div>
        </div>
    </aside>
    <div class="lg:ml-72 flex flex-col min-h-screen">
        <header
            class="sticky top-0 z-30 bg-white/95 dark:bg-surface-dark/95 backdrop-blur-md border-b border-slate-200 dark:border-slate-700 px-6 py-4 flex justify-between items-center shadow-sm">
            <div class="flex items-center gap-4">
                <label
                    class="lg:hidden p-2 -ml-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 transition-colors cursor-pointer"
                    for="sidebar-toggle">
                    <i class="material-icons-round text-2xl">menu</i>
                </label>
                <div>
                    <h1
                        class="text-xl font-display font-bold text-slate-800 dark:text-white leading-none hidden lg:block">
                        Dashboard</h1>
                    <div class="flex items-center gap-2 lg:hidden">
                        <div
                            class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-display font-bold text-xs shadow-glow">
                            NH</div>
                        <h1 class="text-sm font-display font-bold text-slate-800 dark:text-white leading-none">MI Nurul
                            Huda 3</h1>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-500 dark:text-slate-400 transition-colors">
                    <i class="material-icons-round text-xl">dark_mode</i>
                </button>
                <button
                    class="relative p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-500 dark:text-slate-400 transition-colors">
                    <i class="material-icons-round text-xl">notifications</i>
                    <span
                        class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-surface-dark animate-pulse"></span>
                </button>
                <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-700 mx-1"></div>
                <button
                    class="flex items-center gap-2 hover:bg-slate-50 dark:hover:bg-slate-800 p-1.5 rounded-full pr-3 transition-colors">
                    <div
                        class="w-8 h-8 rounded-full overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm">
                        <img alt="Principal profile picture" class="w-full h-full object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDY7vamtqBK039NU-0nqRTIMnKS1DXXfPIgZoQWlUY9zjMpfq2cbTS7EK4_nCohiGjYdvjfUEKMLy6GRZHl7xQzJg7CG1TBYnfF_diFPXYMSgGZhTYOy274B_iiAjAVbxS1rCKOJDpGgHNNP8J9vFNqpZlogRkgvr-JyV98IgrI5LlncsQLcKW1XpWtfbJJeX021QhAzRhP2LlrpTkL_lSGhuPUFJMRQtor458xuRCydx9-U3zycCs1MS-gkniXyxYBrNBA_0XcKqs" />
                    </div>
                    <span class="text-xs font-semibold text-slate-700 dark:text-slate-200 hidden md:block">Ust.
                        Abdullah</span>
                    <i class="material-icons-round text-slate-400 text-lg hidden md:block">expand_more</i>
                </button>
            </div>
        </header>
        @yield('content')
        <footer
            class="mt-auto p-10 flex flex-col items-center gap-6 border-t border-slate-200 dark:border-white/5 bg-white/30 dark:bg-slate-950/30 backdrop-blur-sm">
            <div class="flex items-center gap-8">
                <a class="text-slate-400 hover:text-emerald-500 transition-colors" href="#"><i
                        class="material-icons-round text-xl">facebook</i></a>
                <a class="text-slate-400 hover:text-emerald-500 transition-colors" href="#"><i
                        class="material-icons-round text-xl">language</i></a>
                <a class="text-slate-400 hover:text-emerald-500 transition-colors" href="#"><i
                        class="material-icons-round text-xl">help_outline</i></a>
            </div>
            <div class="text-center space-y-2">
                <p class="text-[10px] text-slate-400 font-bold tracking-[0.3em] uppercase">MI Nurul Huda 3 Smart
                    Management</p>
                <p class="text-[10px] text-slate-500/60 font-medium">Encrypted &amp; Certified Educational
                    Infrastructure © 2024</p>
            </div>
        </footer>
    </div>

    <script src="/js/shared/utils.js"></script>
    @stack('scripts')

</body>

</html>
