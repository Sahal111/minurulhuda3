<!DOCTYPE html>
<html lang="id" x-data="operatorPanel()" :class="{ dark: isDarkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Operator Panel - MI Nurul Huda 3' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        };
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lexend:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        .font-lexend {
            font-family: 'Lexend', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
        }

        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }

        .modal-active {
            overflow: hidden;
        }

        .glass-header-kartu {
            background: rgba(246, 250, 254, 0.85);
            backdrop-filter: blur(20px);
        }

        .glow-status-kartu {
            box-shadow: 0 0 15px rgba(108, 248, 187, 0.3);
        }

        .ghost-border-kartu {
            border: 1px solid rgba(191, 201, 195, 0.15);
        }

        @keyframes modalShow {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-modal {
            animation: modalShow 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        .form-input-siswa {
            width: 100%;
            border-radius: 1rem;
            border: 2px solid #e2e8f0;
            background: #f1f5f9;
            padding: 0.875rem 1.25rem;
            font-size: 0.875rem;
            color: #334155;
            outline: none;
            transition: all 0.2s ease;
        }

        .dark .form-input-siswa {
            border-color: #334155;
            background: #1e293b;
            color: #fff;
        }

        .form-input-siswa::placeholder {
            color: #94a3b8;
        }

        .form-input-siswa:focus {
            border-color: #10b981;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .btn-next-siswa {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: 1rem;
            background: #059669;
            padding: 1rem 2.5rem;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #fff;
            transition: all 0.2s ease;
        }

        .btn-next-siswa:hover {
            background: #047857;
        }

        .btn-next-siswa:active {
            transform: scale(0.95);
        }

        .btn-prev-siswa {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #94a3b8;
            transition: color 0.2s ease;
        }

        .btn-prev-siswa:hover {
            color: #475569;
        }

        .input-error {
            border-color: #ef4444 !important;
        }

        .error-text {
            margin-top: 4px;
            font-size: 10px;
            font-weight: 600;
            color: #ef4444;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body
    class="min-h-screen flex flex-col bg-slate-50 text-slate-800 transition-colors duration-300 dark:bg-slate-950 dark:text-slate-100"
    :class="{ 'modal-active': activeModal }" x-init="init()">

    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-black/50 z-40 lg:hidden"
        @click="sidebarOpen = false" x-cloak></div>

    <aside
        class="fixed top-0 left-0 h-full bg-emerald-900 text-white z-50 sidebar-transition overflow-hidden flex flex-col shadow-2xl"
        :class="[
            sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
            sidebarCollapsed ? 'w-20' : 'w-72'
        ]">
        <div class="p-6 flex items-center gap-4">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg shrink-0">
                <span class="text-emerald-800 font-bold text-xl">NH</span>
            </div>
            <div class="truncate" x-show="!sidebarCollapsed" x-transition.opacity>
                <h1 class="font-lexend font-bold text-sm leading-tight">MI Nurul Huda 3</h1>
                <p class="text-[10px] text-emerald-300 uppercase tracking-widest">Operator Portal</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto custom-scrollbar">
            <p class="px-4 text-[10px] font-semibold text-emerald-400 uppercase tracking-widest mb-2"
                x-show="!sidebarCollapsed">
                Main Menu
            </p>

            <a href="{{ route('operator.dashboard') }}"
                class="nav-link flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('operator.dashboard') ? 'bg-emerald-600 text-white shadow-md' : 'text-emerald-100/80 hover:bg-emerald-800/50 hover:text-white' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>
                <span class="font-medium text-sm" x-show="!sidebarCollapsed">Dashboard</span>
            </a>

            <div class="space-y-1">
                <button type="button" @click="toggleSubmenu('masterData')"
                    class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-800/50 rounded-2xl transition-all text-emerald-100/80 hover:text-white group">
                    <i data-lucide="database" class="w-5 h-5 shrink-0"></i>
                    <span class="text-sm flex-1 text-left" x-show="!sidebarCollapsed">Master Data</span>
                    <i data-lucide="chevron-down" class="w-4 h-4 transition-transform" x-show="!sidebarCollapsed"
                        :class="{ 'rotate-180': submenus.masterData }"></i>
                </button>

                <div class="pl-10 space-y-1" x-show="submenus.masterData && !sidebarCollapsed">
                    <a href="{{ route('operator.dataSiswa.index') }}"
                        class="flex items-center gap-2 py-2 text-xs text-emerald-200/70 hover:text-white">
                        <i data-lucide="users" class="w-3 h-3"></i>
                        Data Siswa
                    </a>
                    <a href="{{ route('operator.dataGuru') }}"
                        class="flex items-center gap-2 py-2 text-xs text-emerald-200/70 hover:text-white">
                        <i data-lucide="user-check" class="w-3 h-3"></i>
                        Data Guru
                    </a>
                    <a href="{{ route('operator.dataKelas') }}"
                        class="flex items-center gap-2 py-2 text-xs text-emerald-200/70 hover:text-white">
                        <i data-lucide="home" class="w-3 h-3"></i>
                        Data Kelas
                    </a>
                    <a href="{{ route('operator.mataPelajaran') }}"
                        class="flex items-center gap-2 py-2 text-xs text-emerald-200/70 hover:text-white">
                        <i data-lucide="book-open" class="w-3 h-3"></i>
                        Mata Pelajaran
                    </a>
                    <a href="#" class="flex items-center gap-2 py-2 text-xs text-emerald-200/70 hover:text-white">
                        <i data-lucide="users-2" class="w-3 h-3"></i>
                        Orang Tua/Wali
                    </a>
                </div>
            </div>

            <div class="space-y-1">
                <button type="button" @click="toggleSubmenu('akademik')"
                    class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-800/50 rounded-2xl transition-all text-emerald-100/80 hover:text-white group">
                    <i data-lucide="settings-2" class="w-5 h-5 shrink-0"></i>
                    <span class="text-sm flex-1 text-left" x-show="!sidebarCollapsed">Akademik</span>
                    <i data-lucide="chevron-down" class="w-4 h-4 transition-transform" x-show="!sidebarCollapsed"
                        :class="{ 'rotate-180': submenus.akademik }"></i>
                </button>

                <div class="pl-10 space-y-1" x-show="submenus.akademik && !sidebarCollapsed">
                    <p class="text-[9px] text-emerald-400 uppercase tracking-widest mt-2">Setup</p>
                    <template x-for="item in akademikSetup" :key="item.label">
                        <a :href="item.href"
                            class="flex items-center gap-2 py-2 text-xs text-emerald-200/70 hover:text-white">
                            <i :data-lucide="item.icon" class="w-3 h-3"></i>
                            <span x-text="item.label"></span>
                        </a>
                    </template>

                    <p class="text-[9px] text-emerald-400 uppercase tracking-widest mt-3">Proses</p>
                    <template x-for="item in akademikProses" :key="item.label">
                        <a :href="item.href"
                            class="flex items-center gap-2 py-2 text-xs text-emerald-200/70 hover:text-white">
                            <i :data-lucide="item.icon" class="w-3 h-3"></i>
                            <span x-text="item.label"></span>
                        </a>
                    </template>
                </div>
            </div>

            <a href="{{ route('operator.manajemenAkun') }}"
                class="nav-link flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('operator.manajemenAkun') ? 'bg-emerald-600 text-white shadow-md' : 'text-emerald-100/80 hover:bg-emerald-800/50 hover:text-white' }}">
                <i data-lucide="users" class="w-5 h-5 shrink-0"></i>
                <span class="text-sm flex-1 font-medium" x-show="!sidebarCollapsed">Manajemen User</span>
                <span class="bg-amber-500 text-[10px] px-1.5 py-0.5 rounded-full text-white"
                    x-show="!sidebarCollapsed">3</span>
            </a>

            <a href="{{ route('operator.manajementPPDB') }}"
                class="nav-link flex items-center gap-3 px-4 py-3 rounded-2xl transition-all group {{ request()->routeIs('operator.manajementPPDB') ? 'bg-emerald-600 text-white shadow-md' : 'text-emerald-100/80 hover:bg-emerald-800/50 hover:text-white' }}">
                <i data-lucide="graduation-cap" class="w-5 h-5 shrink-0"></i>
                <span class="text-sm font-medium" x-show="!sidebarCollapsed">PPDB Management</span>
            </a>

            <p class="px-4 text-[10px] font-semibold text-emerald-400 uppercase tracking-widest mt-6 mb-2"
                x-show="!sidebarCollapsed">
                Operations
            </p>

            <a href="{{ route('operator.importExport') }}"
                class="nav-link flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('operator.importExport') ? 'bg-emerald-600 text-white shadow-md' : 'text-emerald-100/80 hover:bg-emerald-800/50 hover:text-white' }}">
                <i data-lucide="file-up" class="w-5 h-5 shrink-0"></i>
                <span class="text-sm" x-show="!sidebarCollapsed">Import & Export</span>
            </a>
            <a href="{{ route('operator.integrasiSistem') }}"
                class="nav-link flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('operator.integrasiSistem') ? 'bg-emerald-600 text-white shadow-md' : 'text-emerald-100/80 hover:bg-emerald-800/50 hover:text-white' }}">
                <i data-lucide="share-2" class="w-5 h-5 shrink-0"></i>
                <span class="text-sm" x-show="!sidebarCollapsed">Integrasi Sistem</span>
            </a>

            <p class="px-4 text-[10px] font-semibold text-emerald-400 uppercase tracking-widest mt-6 mb-2"
                x-show="!sidebarCollapsed">
                System
            </p>

            <a href="{{ route('operator.backup') }}"
                class="nav-link flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('operator.backup') ? 'bg-emerald-600 text-white shadow-md' : 'text-emerald-100/80 hover:bg-emerald-800/50 hover:text-white' }}">
                <i data-lucide="hard-drive" class="w-5 h-5 shrink-0"></i>
                <span class="text-sm" x-show="!sidebarCollapsed">Backup & Restore</span>
            </a>
            <a href="{{ route('operator.auditLog') }}"
                class="nav-link flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('operator.auditLog') ? 'bg-emerald-600 text-white shadow-md' : 'text-emerald-100/80 hover:bg-emerald-800/50 hover:text-white' }}">
                <i data-lucide="history" class="w-5 h-5 shrink-0"></i>
                <span class="text-sm" x-show="!sidebarCollapsed">Audit Log</span>
            </a>
            <a href="{{ route('operator.setting') }}"
                class="nav-link flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('operator.setting') ? 'bg-emerald-600 text-white shadow-md' : 'text-emerald-100/80 hover:bg-emerald-800/50 hover:text-white' }}">
                <i data-lucide="settings" class="w-5 h-5 shrink-0"></i>
                <span class="text-sm" x-show="!sidebarCollapsed">Pengaturan Sistem</span>
            </a>
        </nav>

        <div class="p-4 bg-emerald-950/50 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-red-500/10 rounded-2xl transition-all group">
                    <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                    <span class="text-sm font-medium" x-show="!sidebarCollapsed">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="min-h-screen transition-all duration-300 flex flex-col"
        :class="sidebarCollapsed ? 'lg:ml-20' : 'lg:ml-72'">
        <header
            class="sticky top-0 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 px-4 lg:px-8 py-4 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-4">
                <button type="button" @click="sidebarOpen = true"
                    class="lg:hidden p-2.5 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-colors">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <div class="hidden lg:block">
                    <button type="button" @click="sidebarCollapsed = !sidebarCollapsed; refreshIcons()"
                        class="p-2.5 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-colors">
                        <i data-lucide="panel-left" class="w-5 h-5 text-slate-500"></i>
                    </button>
                </div>
                <h2 class="text-xl font-lexend font-bold text-slate-800 dark:text-white">
                    {{ $pageTitle ?? 'Dashboard Operator' }}
                </h2>
            </div>

            <div class="flex items-center gap-2 md:gap-4">
                <button type="button" @click="toggleDarkMode()"
                    class="p-2.5 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-colors">
                    <i :data-lucide="isDarkMode ? 'sun' : 'moon'" class="w-5 h-5"></i>
                </button>

                <button type="button"
                    class="p-2.5 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl relative transition-colors">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <span
                        class="absolute top-3 right-3 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white dark:ring-slate-900"></span>
                </button>

                <div class="flex items-center gap-3 pl-4 border-l border-slate-200 dark:border-slate-800 ml-2">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800 dark:text-slate-200 leading-none">
                            {{ auth()->user()->name ?? 'Aris Munandar' }}
                        </p>
                        <p class="text-[10px] text-emerald-600 font-bold uppercase mt-1">System Operator</p>
                    </div>
                    <button type="button"
                        class="w-10 h-10 rounded-xl bg-emerald-100 border-2 border-emerald-500 flex items-center justify-center overflow-hidden focus:ring-4 ring-emerald-500/20">
                        <img src="/assets/default-avatar.svg"
                            alt="Avatar">
                    </button>
                </div>
            </div>
        </header>

        <div class="flex-1 p-4 lg:p-8">
            {{ $slot ?? '' }}
            @yield('content')
        </div>


        <footer class="p-10 text-center mt-auto border-t border-slate-200/50 dark:border-slate-800/50">
            <div class="flex flex-col items-center gap-2">
                <div class="h-1 w-12 bg-emerald-500 rounded-full mb-2"></div>
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.4em]">MI Nurul Huda 3</p>
                <p class="text-[9px] text-slate-300 dark:text-slate-500 font-medium">
                    Student Management System • Ecosystem v2.4.0
                </p>
            </div>
        </footer>
    </main>

    <script src="/js/shared/utils.js"></script>
    <script src="/js/layouts/operator.js"></script>
    @stack('scripts')

</body>

</html>