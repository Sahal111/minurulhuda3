<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Master Data Orang Tua / Wali - MI Nurul Huda 3</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Lexend:wght@500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "error-container": "#ffdad6",
                        "on-background": "#191c1e",
                        "on-error": "#ffffff",
                        "tertiary": "#1f2f43",
                        "surface-container": "#eceef0",
                        "on-secondary-fixed-variant": "#005236",
                        "inverse-surface": "#2d3133",
                        "primary": "#003527",
                        "tertiary-fixed": "#d3e4fe",
                        "surface-container-high": "#e6e8ea",
                        "on-primary-container": "#80bea6",
                        "surface-container-highest": "#e0e3e5",
                        "on-primary-fixed": "#002117",
                        "on-tertiary-fixed-variant": "#38485d",
                        "on-tertiary": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-tertiary-fixed": "#0b1c30",
                        "inverse-primary": "#95d3ba",
                        "surface-dim": "#d8dadc",
                        "surface-container-low": "#f2f4f6",
                        "on-primary": "#ffffff",
                        "on-surface": "#191c1e",
                        "on-surface-variant": "#404944",
                        "error": "#ba1a1a",
                        "tertiary-container": "#35455a",
                        "secondary-fixed-dim": "#4edea3",
                        "on-tertiary-container": "#a2b2cb",
                        "on-primary-fixed-variant": "#0b513d",
                        "tertiary-fixed-dim": "#b7c8e1",
                        "secondary-fixed": "#6ffbbe",
                        "on-secondary-fixed": "#002113",
                        "surface-tint": "#2b6954",
                        "primary-fixed-dim": "#95d3ba",
                        "primary-container": "#064e3b",
                        "surface-bright": "#f7f9fb",
                        "secondary-container": "#6cf8bb",
                        "outline-variant": "#bfc9c3",
                        "inverse-on-surface": "#eff1f3",
                        "on-secondary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#006c49",
                        "surface": "#f7f9fb",
                        "primary-fixed": "#b0f0d6",
                        "on-secondary-container": "#00714d",
                        "outline": "#707974",
                        "surface-variant": "#e0e3e5",
                        "background": "#f7f9fb"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px",
                        "2xl": "1rem"
                    },
                    "spacing": {
                        "margin_page": "2rem",
                        "header_height": "72px",
                        "gutter": "1.5rem",
                        "density_padding": "0.75rem",
                        "sidebar_width": "260px",
                        "container_max_width": "1440px"
                    },
                    "fontFamily": {
                        "body-sm": ["Inter"],
                        "stat-number": ["Lexend"],
                        "body-md": ["Inter"],
                        "h1": ["Lexend"],
                        "h3": ["Lexend"],
                        "display": ["Lexend"],
                        "body-lg": ["Inter"],
                        "label-caps": ["Inter"],
                        "h2": ["Lexend"]
                    },
                    "fontSize": {
                        "body-sm": ["14px", {
                            "lineHeight": "1.5",
                            "fontWeight": "400"
                        }],
                        "stat-number": ["28px", {
                            "lineHeight": "1.2",
                            "fontWeight": "700"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "1.5",
                            "fontWeight": "400"
                        }],
                        "h1": ["32px", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }],
                        "h3": ["20px", {
                            "lineHeight": "1.4",
                            "fontWeight": "500"
                        }],
                        "display": ["42px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "label-caps": ["12px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "0.05em",
                            "fontWeight": "600"
                        }],
                        "h2": ["24px", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }]
                    }
                }
            }
        }
    </script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(191, 201, 195, 0.3);
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.04);
        }

        .status-glow-success {
            box-shadow: 0 0 8px rgba(108, 248, 187, 0.3);
        }

        .status-glow-warning {
            box-shadow: 0 0 8px rgba(255, 179, 0, 0.3);
        }

        .status-glow-error {
            box-shadow: 0 0 8px rgba(186, 26, 26, 0.3);
        }
    </style>
</head>

<body
    class="bg-background text-on-background font-body-sm antialiased overflow-x-hidden selection:bg-primary/20 selection:text-primary">
    <!-- SideNavBar -->
    <aside
        class="bg-primary dark:bg-primary-container text-on-primary dark:text-on-primary-container w-[260px] h-screen fixed left-0 top-0 border-r border-outline-variant/10 shadow-xl flex flex-col py-6 z-50">
        <!-- Brand -->
        <div class="px-6 mb-8 flex items-center gap-3">
            <div
                class="w-10 h-10 bg-on-primary text-primary rounded-lg flex items-center justify-center font-bold text-lg">
                NH</div>
            <div>
                <h1 class="text-h3 font-h3 font-bold text-on-primary dark:text-on-primary-container leading-tight">MI
                    Nurul Huda 3</h1>
                <p class="font-label-caps text-label-caps text-on-primary/70 mt-1">OPERATOR PORTAL</p>
            </div>
        </div>
        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto custom-scrollbar">
            <div class="px-4 mb-2">
                <span class="font-label-caps text-label-caps text-on-primary/50 px-2">MAIN MENU</span>
            </div>
            <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/20 px-4 py-3 flex items-center gap-3 transition-all mx-2 rounded-lg group"
                href="#">
                <span
                    class="material-symbols-outlined text-xl group-hover:text-secondary-fixed transition-colors">dashboard</span>
                <span class="font-body-sm text-body-sm">Dashboard</span>
            </a>
            <!-- Active Master Data with Sub-menu -->
            <div class="mt-2">
                <button
                    class="bg-secondary-container/10 border-l-4 border-secondary-fixed text-on-primary font-bold px-4 py-3 flex items-center justify-between w-full transition-all group">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-xl text-secondary-fixed"
                            style="font-variation-settings: 'FILL' 1;">database</span>
                        <span class="font-body-sm text-body-sm">Master Data</span>
                    </div>
                    <span class="material-symbols-outlined text-sm text-on-primary/70">expand_more</span>
                </button>
                <div class="bg-primary-fixed/5 py-2">
                    <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/30 px-12 py-2 flex items-center gap-3 transition-all text-sm"
                        href="#">
                        <span class="material-symbols-outlined text-[16px]">person</span> Data Siswa
                    </a>
                    <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/30 px-12 py-2 flex items-center gap-3 transition-all text-sm"
                        href="#">
                        <span class="material-symbols-outlined text-[16px]">badge</span> Data Guru
                    </a>
                    <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/30 px-12 py-2 flex items-center gap-3 transition-all text-sm"
                        href="#">
                        <span class="material-symbols-outlined text-[16px]">meeting_room</span> Data Kelas
                    </a>
                    <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/30 px-12 py-2 flex items-center gap-3 transition-all text-sm"
                        href="#">
                        <span class="material-symbols-outlined text-[16px]">book</span> Mata Pelajaran
                    </a>
                    <a class="text-secondary-fixed hover:text-secondary-fixed bg-primary-container/40 px-12 py-2 flex items-center gap-3 transition-all text-sm font-medium border-r-2 border-secondary-fixed"
                        href="#">
                        <span class="material-symbols-outlined text-[16px]"
                            style="font-variation-settings: 'FILL' 1;">family_restroom</span> Orang Tua/Wali
                    </a>
                </div>
            </div>
            <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/20 px-4 py-3 flex items-center justify-between transition-all mx-2 rounded-lg mt-2 group"
                href="#">
                <div class="flex items-center gap-3">
                    <span
                        class="material-symbols-outlined text-xl group-hover:text-secondary-fixed transition-colors">school</span>
                    <span class="font-body-sm text-body-sm">Akademik</span>
                </div>
                <span class="material-symbols-outlined text-sm text-on-primary/50">chevron_right</span>
            </a>
            <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/20 px-4 py-3 flex items-center justify-between transition-all mx-2 rounded-lg mt-1 group"
                href="#">
                <div class="flex items-center gap-3">
                    <span
                        class="material-symbols-outlined text-xl group-hover:text-secondary-fixed transition-colors">group</span>
                    <span class="font-body-sm text-body-sm">Manajemen User</span>
                </div>
                <span class="bg-error text-on-error text-xs font-bold px-1.5 rounded-full">3</span>
            </a>
            <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/20 px-4 py-3 flex items-center gap-3 transition-all mx-2 rounded-lg mt-1 group"
                href="#">
                <span
                    class="material-symbols-outlined text-xl group-hover:text-secondary-fixed transition-colors">app_registration</span>
                <span class="font-body-sm text-body-sm">PPDB Management</span>
            </a>
            <div class="px-4 mt-6 mb-2">
                <span class="font-label-caps text-label-caps text-on-primary/50 px-2">OPERATIONS</span>
            </div>
            <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/20 px-4 py-3 flex items-center gap-3 transition-all mx-2 rounded-lg group"
                href="#">
                <span
                    class="material-symbols-outlined text-xl group-hover:text-secondary-fixed transition-colors">import_export</span>
                <span class="font-body-sm text-body-sm">Import &amp; Export</span>
            </a>
            <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/20 px-4 py-3 flex items-center gap-3 transition-all mx-2 rounded-lg mt-1 group"
                href="#">
                <span
                    class="material-symbols-outlined text-xl group-hover:text-secondary-fixed transition-colors">hub</span>
                <span class="font-body-sm text-body-sm">Integrasi Sistem</span>
            </a>
            <div class="px-4 mt-6 mb-2">
                <span class="font-label-caps text-label-caps text-on-primary/50 px-2">SYSTEM</span>
            </div>
            <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/20 px-4 py-3 flex items-center gap-3 transition-all mx-2 rounded-lg group"
                href="#">
                <span
                    class="material-symbols-outlined text-xl group-hover:text-secondary-fixed transition-colors">backup</span>
                <span class="font-body-sm text-body-sm">Backup &amp; Restore</span>
            </a>
            <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/20 px-4 py-3 flex items-center gap-3 transition-all mx-2 rounded-lg mt-1 group"
                href="#">
                <span
                    class="material-symbols-outlined text-xl group-hover:text-secondary-fixed transition-colors">history_edu</span>
                <span class="font-body-sm text-body-sm">Audit Log</span>
            </a>
            <a class="text-on-primary/70 hover:text-on-primary hover:bg-primary-container/20 px-4 py-3 flex items-center gap-3 transition-all mx-2 rounded-lg mt-1 group"
                href="#">
                <span
                    class="material-symbols-outlined text-xl group-hover:text-secondary-fixed transition-colors">settings</span>
                <span class="font-body-sm text-body-sm">Pengaturan Sistem</span>
            </a>
        </nav>
        <!-- Footer -->
        <div class="px-6 mt-auto pt-6 border-t border-primary-container">
            <button
                class="text-error/90 hover:text-error hover:bg-error/10 px-4 py-3 flex items-center gap-3 transition-all w-full rounded-lg">
                <span class="material-symbols-outlined text-xl">logout</span>
                <span class="font-body-sm text-body-sm font-medium">Logout</span>
            </button>
        </div>
    </aside>
    <!-- Main Content Area -->
    <main class="ml-[260px] min-h-screen flex flex-col">
        <!-- TopNavBar -->
        <header
            class="bg-surface/70 dark:bg-surface-container/70 backdrop-blur-md h-[72px] sticky top-0 z-40 w-full border-b border-outline-variant/30 shadow-sm flex justify-between items-center px-8 transition-all">
            <div class="flex items-center gap-4">
                <button class="md:hidden text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
                <div class="flex items-center gap-3 text-on-surface-variant/60 font-body-sm text-sm">
                    <span class="hover:text-primary cursor-pointer transition-colors">Dashboard</span>
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                    <span class="hover:text-primary cursor-pointer transition-colors">Master Data</span>
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                    <span class="text-primary font-medium">Orang Tua/Wali</span>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative focus-within:ring-2 focus-within:ring-primary/20 rounded-full transition-all">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/50 text-lg">search</span>
                    <input
                        class="bg-surface-container-low border-none rounded-full pl-10 pr-4 py-2 text-sm font-body-sm text-on-surface w-64 focus:outline-none focus:ring-0 placeholder:text-on-surface-variant/50 transition-all"
                        placeholder="Cari secara global..." type="text" />
                </div>
                <div class="flex items-center gap-4 border-l border-outline-variant/30 pl-6">
                    <button
                        class="text-on-surface-variant hover:text-primary hover:bg-surface-container-low p-2 rounded-full transition-colors relative">
                        <span class="material-symbols-outlined">notifications</span>
                        <span
                            class="absolute top-1.5 right-1.5 w-2 h-2 bg-error rounded-full ring-2 ring-surface"></span>
                    </button>
                    <div
                        class="flex items-center gap-3 cursor-pointer hover:bg-surface-container-low p-1.5 pr-3 rounded-full transition-colors border border-transparent hover:border-outline-variant/30">
                        <div class="text-right hidden md:block">
                            <p class="font-body-sm text-sm font-semibold text-on-surface leading-tight">Aris Munandar
                            </p>
                            <p class="font-label-caps text-[10px] text-primary mt-0.5">SYSTEM OPERATOR</p>
                        </div>
                        <img alt="Aris Munandar"
                            class="w-9 h-9 rounded-full object-cover border border-outline-variant/30"
                            data-alt="A small, circular avatar portrait of a professional male system operator, lit with soft, neutral light. The subject is casually dressed, suggesting a modern school administration environment."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDq3WbqRPCiPy1RiIKgT2AAevJafABYQa7Brvu6wWQ1LUBXut6EprZBJhVgYgcw-GZfXStyVEvaRC03yiLfeZpc_Jyh_zaPsERui7PdmbZWfbYhU4UBqT712eJSbs6a-J7B2lbwpinc4VhBOd7ltWLnVSTI3PQ_xAjjq2Gb924wi_5YY6iT2oDECj2tcD9sY_1fRLtshUYMy1kUy1k0lg1WsrO_qCk8mHIQGi9cpeaGh8QMJvWKQkk6xnmHX7FHuA65CdF-ZQu042ht" />
                    </div>
                </div>
            </div>
        </header>
        <!-- Page Content -->
        <div class="flex-1 p-8 max-w-[1440px] mx-auto w-full">
            <!-- Page Header Section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                <div>
                    <h2 class="font-h1 text-h1 text-on-surface font-semibold tracking-tight">Master Data Orang Tua /
                        Wali</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-1">Kelola dan monitor data keluarga
                        serta relasi siswa MI Nurul Huda 3.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="bg-surface-container hover:bg-surface-container-high text-on-surface font-body-sm text-sm font-medium py-2.5 px-4 rounded-xl transition-all border border-outline-variant/30 flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">print</span>
                        Print Data
                    </button>
                    <button
                        class="bg-surface-container hover:bg-surface-container-high text-on-surface font-body-sm text-sm font-medium py-2.5 px-4 rounded-xl transition-all border border-outline-variant/30 flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg text-primary">download</span>
                        Export Excel
                    </button>
                    <button
                        class="bg-gradient-to-r from-primary to-primary-container hover:from-primary-container hover:to-primary text-on-primary font-body-sm text-sm font-medium py-2.5 px-5 rounded-xl transition-all shadow-md shadow-primary/20 flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">link</span>
                        Link Siswa ke Wali
                    </button>
                </div>
            </div>
            <!-- Summary Cards (Bento Grid Style) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card 1 -->
                <div
                    class="glass-card rounded-2xl p-5 relative overflow-hidden group hover:border-primary/30 transition-colors">
                    <div
                        class="absolute -right-4 -top-4 w-24 h-24 bg-primary/5 rounded-full blur-xl group-hover:bg-primary/10 transition-colors">
                    </div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings: 'FILL' 1;">family_restroom</span>
                        </div>
                        <span
                            class="bg-secondary-container text-on-secondary-container text-xs font-bold px-2 py-1 rounded-md flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">trending_up</span> +12
                        </span>
                    </div>
                    <div class="relative z-10">
                        <p
                            class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider mb-1">
                            Total Keluarga</p>
                        <h3 class="font-stat-number text-stat-number text-on-surface">845</h3>
                        <p class="font-body-sm text-xs text-on-surface-variant mt-1">Terdaftar dalam sistem</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div
                    class="glass-card rounded-2xl p-5 relative overflow-hidden group hover:border-primary/30 transition-colors">
                    <div
                        class="absolute -right-4 -top-4 w-24 h-24 bg-tertiary-fixed/30 rounded-full blur-xl group-hover:bg-tertiary-fixed/50 transition-colors">
                    </div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div
                            class="w-10 h-10 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings: 'FILL' 1;">man</span>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <p
                            class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider mb-1">
                            Total Ayah Terdata</p>
                        <h3 class="font-stat-number text-stat-number text-on-surface">832</h3>
                        <p class="font-body-sm text-xs text-on-surface-variant mt-1">98.4% dari total keluarga</p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div
                    class="glass-card rounded-2xl p-5 relative overflow-hidden group hover:border-primary/30 transition-colors">
                    <div
                        class="absolute -right-4 -top-4 w-24 h-24 bg-secondary-fixed/20 rounded-full blur-xl group-hover:bg-secondary-fixed/40 transition-colors">
                    </div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div
                            class="w-10 h-10 rounded-xl bg-secondary-fixed-dim/20 text-secondary flex items-center justify-center">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings: 'FILL' 1;">supervisor_account</span>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <p
                            class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider mb-1">
                            Total Wali Aktif</p>
                        <h3 class="font-stat-number text-stat-number text-on-surface">45</h3>
                        <p class="font-body-sm text-xs text-on-surface-variant mt-1">Menggantikan peran ortu</p>
                    </div>
                </div>
                <!-- Card 4 -->
                <div
                    class="glass-card rounded-2xl p-5 relative overflow-hidden group border-error-container/50 hover:border-error/50 transition-colors status-glow-error">
                    <div
                        class="absolute -right-4 -top-4 w-24 h-24 bg-error-container/50 rounded-full blur-xl group-hover:bg-error-container transition-colors">
                    </div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div
                            class="w-10 h-10 rounded-xl bg-error-container text-error flex items-center justify-center">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings: 'FILL' 1;">warning</span>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <p class="font-label-caps text-label-caps text-error uppercase tracking-wider mb-1">Data Belum
                            Lengkap</p>
                        <h3 class="font-stat-number text-stat-number text-on-surface">18</h3>
                        <p class="font-body-sm text-xs text-error/80 mt-1 font-medium hover:underline cursor-pointer">
                            Review sekarang →</p>
                    </div>
                </div>
            </div>
            <!-- Controls & Table Area -->
            <div class="glass-card rounded-2xl overflow-hidden flex flex-col">
                <!-- Filter Bar -->
                <div
                    class="p-5 border-b border-outline-variant/30 bg-surface-container-lowest/50 flex flex-col lg:flex-row gap-4 justify-between items-center">
                    <div
                        class="relative w-full lg:w-96 focus-within:ring-2 focus-within:ring-primary/20 rounded-xl transition-all">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/50">search</span>
                        <input
                            class="bg-surface border border-outline-variant/30 rounded-xl pl-10 pr-4 py-2.5 text-sm font-body-sm text-on-surface w-full focus:outline-none focus:border-primary/50 transition-all"
                            placeholder="Cari nama ayah, ibu, wali, atau NIK..." type="text" />
                    </div>
                    <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                        <button
                            class="bg-surface border border-outline-variant/30 hover:bg-surface-container-low text-on-surface-variant font-body-sm text-sm py-2 px-3 rounded-lg transition-all flex items-center gap-2">
                            Pekerjaan <span class="material-symbols-outlined text-sm">arrow_drop_down</span>
                        </button>
                        <button
                            class="bg-surface border border-outline-variant/30 hover:bg-surface-container-low text-on-surface-variant font-body-sm text-sm py-2 px-3 rounded-lg transition-all flex items-center gap-2">
                            Status Data <span class="material-symbols-outlined text-sm">arrow_drop_down</span>
                        </button>
                        <div class="h-6 w-px bg-outline-variant/30 mx-1 hidden sm:block"></div>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input
                                class="rounded border-outline-variant text-primary focus:ring-primary bg-surface w-4 h-4 transition-all cursor-pointer"
                                type="checkbox" />
                            <span
                                class="font-body-sm text-sm text-on-surface-variant group-hover:text-on-surface transition-colors">Punya
                                &gt;1 Anak</span>
                        </label>
                        <button
                            class="ml-auto lg:ml-2 text-primary font-body-sm text-sm font-medium hover:underline flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">filter_list_off</span> Reset
                        </button>
                    </div>
                </div>
                <!-- Table -->
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low border-b border-outline-variant/30">
                                <th class="font-label-caps text-label-caps text-on-surface-variant py-4 px-5 w-16">NO
                                </th>
                                <th class="font-label-caps text-label-caps text-on-surface-variant py-4 px-5">KEPALA
                                    KELUARGA / AYAH</th>
                                <th class="font-label-caps text-label-caps text-on-surface-variant py-4 px-5">DATA IBU
                                </th>
                                <th class="font-label-caps text-label-caps text-on-surface-variant py-4 px-5">KONTAK
                                    UTAMA</th>
                                <th class="font-label-caps text-label-caps text-on-surface-variant py-4 px-5">ANAK
                                    TERKAIT</th>
                                <th class="font-label-caps text-label-caps text-on-surface-variant py-4 px-5">STATUS
                                </th>
                                <th
                                    class="font-label-caps text-label-caps text-on-surface-variant py-4 px-5 text-right">
                                    AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="font-body-sm text-sm text-on-surface divide-y divide-outline-variant/20">
                            <!-- Row 1: Complete Data, 2 Kids -->
                            <tr class="hover:bg-surface-container-lowest/80 transition-colors group">
                                <td class="py-4 px-5 text-on-surface-variant">1</td>
                                <td class="py-4 px-5">
                                    <div class="font-semibold text-on-surface">Budi Santoso</div>
                                    <div class="text-xs text-on-surface-variant/70 mt-0.5 font-mono">3271012345670001
                                    </div>
                                    <div class="text-xs text-on-surface-variant mt-1 flex items-center gap-1"><span
                                            class="material-symbols-outlined text-[14px]">work</span> PNS</div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="font-medium text-on-surface">Siti Aminah</div>
                                    <div class="text-xs text-on-surface-variant/70 mt-0.5 font-mono">3271012345670002
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono text-sm">0812-3456-7890</span>
                                        <button
                                            class="text-[#25D366] hover:bg-[#25D366]/10 p-1 rounded-md transition-colors"
                                            title="Hubungi via WhatsApp">
                                            <span class="material-symbols-outlined text-[18px]">chat</span>
                                        </button>
                                    </div>
                                    <div class="text-xs text-on-surface-variant mt-0.5">Ayah</div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex flex-col gap-1.5">
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-tertiary-fixed/30 text-on-tertiary-fixed px-2.5 py-1 rounded-md text-xs font-medium border border-tertiary-fixed/50 w-max">
                                            <span class="material-symbols-outlined text-[14px]">face</span> Muhammad
                                            Ali (3A)
                                        </span>
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-tertiary-fixed/30 text-on-tertiary-fixed px-2.5 py-1 rounded-md text-xs font-medium border border-tertiary-fixed/50 w-max">
                                            <span class="material-symbols-outlined text-[14px]">face</span> Fatimah
                                            Azzahra (1B)
                                        </span>
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <span
                                        class="inline-flex items-center gap-1 bg-secondary-container/30 text-on-secondary-container px-2.5 py-1 rounded-full text-xs font-bold border border-secondary/20 status-glow-success">
                                        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span> Lengkap
                                    </span>
                                </td>
                                <td class="py-4 px-5">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button
                                            class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                            title="Detail Data">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </button>
                                        <button
                                            class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                            title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 2: Incomplete Data, Error State -->
                            <tr class="hover:bg-surface-container-lowest/80 transition-colors group bg-error/5">
                                <td class="py-4 px-5 text-on-surface-variant">2</td>
                                <td class="py-4 px-5">
                                    <div class="font-semibold text-on-surface">Agus Pratama</div>
                                    <div class="text-xs text-error/80 mt-0.5 font-mono italic">NIK Belum diisi</div>
                                    <div class="text-xs text-on-surface-variant mt-1 flex items-center gap-1"><span
                                            class="material-symbols-outlined text-[14px]">work</span> Wiraswasta</div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="font-medium text-on-surface">Dewi Lestari</div>
                                    <div class="text-xs text-on-surface-variant/70 mt-0.5 font-mono">3271098765430002
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono text-sm">0856-7890-1234</span>
                                        <button
                                            class="text-[#25D366] hover:bg-[#25D366]/10 p-1 rounded-md transition-colors"
                                            title="Hubungi via WhatsApp">
                                            <span class="material-symbols-outlined text-[18px]">chat</span>
                                        </button>
                                    </div>
                                    <div class="text-xs text-on-surface-variant mt-0.5">Ibu</div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex flex-col gap-1.5">
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-tertiary-fixed/30 text-on-tertiary-fixed px-2.5 py-1 rounded-md text-xs font-medium border border-tertiary-fixed/50 w-max">
                                            <span class="material-symbols-outlined text-[14px]">face</span> Rizky
                                            Pratama (5C)
                                        </span>
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <span
                                        class="inline-flex items-center gap-1 bg-error-container/50 text-error px-2.5 py-1 rounded-full text-xs font-bold border border-error/20 status-glow-error">
                                        <span class="w-1.5 h-1.5 rounded-full bg-error"></span> Belum Lengkap
                                    </span>
                                </td>
                                <td class="py-4 px-5">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button
                                            class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                            title="Detail Data">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </button>
                                        <button
                                            class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                            title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 3: Has Guardian (Wali) -->
                            <tr class="hover:bg-surface-container-lowest/80 transition-colors group">
                                <td class="py-4 px-5 text-on-surface-variant">3</td>
                                <td class="py-4 px-5 text-on-surface-variant/50 italic text-sm">
                                    Almarhum
                                </td>
                                <td class="py-4 px-5 text-on-surface-variant/50 italic text-sm">
                                    Almarhum
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono text-sm">0877-1122-3344</span>
                                        <button
                                            class="text-[#25D366] hover:bg-[#25D366]/10 p-1 rounded-md transition-colors"
                                            title="Hubungi via WhatsApp">
                                            <span class="material-symbols-outlined text-[18px]">chat</span>
                                        </button>
                                    </div>
                                    <div class="text-xs text-on-surface-variant mt-0.5">Wali (Paman)</div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex flex-col gap-1.5">
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-tertiary-fixed/30 text-on-tertiary-fixed px-2.5 py-1 rounded-md text-xs font-medium border border-tertiary-fixed/50 w-max">
                                            <span class="material-symbols-outlined text-[14px]">face</span> Ahmad
                                            Syauqi (6A)
                                        </span>
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex flex-col gap-1 items-start">
                                        <span
                                            class="inline-flex items-center gap-1 bg-surface-variant/50 text-on-surface-variant px-2.5 py-1 rounded-full text-xs font-bold border border-outline-variant/30">
                                            <span class="material-symbols-outlined text-[14px]">shield_person</span>
                                            Via Wali
                                        </span>
                                        <span class="text-[10px] text-on-surface-variant/70 font-medium ml-1">Hendro
                                            Purnomo</span>
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button
                                            class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                            title="Detail Data">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </button>
                                        <button
                                            class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                            title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 4: Needs Review -->
                            <tr class="hover:bg-surface-container-lowest/80 transition-colors group">
                                <td class="py-4 px-5 text-on-surface-variant">4</td>
                                <td class="py-4 px-5">
                                    <div class="font-semibold text-on-surface">Rahmat Hidayat</div>
                                    <div class="text-xs text-on-surface-variant/70 mt-0.5 font-mono">327105556667778
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="font-medium text-on-surface">Nurhayati</div>
                                    <div class="text-xs text-on-surface-variant/70 mt-0.5 font-mono">327105556667779
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono text-sm">0899-4444-5555</span>
                                    </div>
                                    <div class="text-xs text-on-surface-variant mt-0.5">Ibu</div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex flex-col gap-1.5">
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-tertiary-fixed/30 text-on-tertiary-fixed px-2.5 py-1 rounded-md text-xs font-medium border border-tertiary-fixed/50 w-max">
                                            <span class="material-symbols-outlined text-[14px]">face</span> Siti Aisyah
                                            (2B)
                                        </span>
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <span
                                        class="inline-flex items-center gap-1 bg-surface-container-highest text-on-surface-variant px-2.5 py-1 rounded-full text-xs font-bold border border-outline-variant/50 status-glow-warning">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#FFB300]"></span> Perlu Review
                                    </span>
                                </td>
                                <td class="py-4 px-5">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button
                                            class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                            title="Detail Data">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </button>
                                        <button
                                            class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                            title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div
                    class="p-4 border-t border-outline-variant/30 flex items-center justify-between bg-surface-container-lowest/50">
                    <p class="font-body-sm text-sm text-on-surface-variant">Menampilkan <span
                            class="font-semibold text-on-surface">1</span> - <span
                            class="font-semibold text-on-surface">10</span> dari <span
                            class="font-semibold text-on-surface">845</span> data</p>
                    <div class="flex items-center gap-1">
                        <button
                            class="p-2 text-on-surface-variant hover:bg-surface-container-low rounded-lg transition-colors disabled:opacity-50"
                            disabled="">
                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                        </button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-on-primary font-medium text-sm">1</button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container-low text-on-surface font-medium text-sm transition-colors">2</button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container-low text-on-surface font-medium text-sm transition-colors">3</button>
                        <span class="text-on-surface-variant mx-1">...</span>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-surface-container-low text-on-surface font-medium text-sm transition-colors">85</button>
                        <button
                            class="p-2 text-on-surface-variant hover:bg-surface-container-low rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Implicit Detail Modal Template (Hidden by default, structure provided as requested) -->
    <div class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" id="detail-modal">
        <div class="absolute inset-0 bg-inverse-surface/40 backdrop-blur-sm"></div>
        <div
            class="relative bg-surface rounded-2xl shadow-2xl w-full max-w-4xl max-h-[921px] flex flex-col overflow-hidden border border-outline-variant/30 glass-card">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-outline-variant/30 flex justify-between items-center bg-surface/50">
                <div>
                    <h3 class="font-h2 text-h2 text-on-surface font-semibold">Detail Keluarga Santoso</h3>
                    <p class="font-body-sm text-sm text-on-surface-variant mt-1">ID Keluarga: KEL-2023-0845</p>
                </div>
                <button
                    class="text-on-surface-variant hover:text-error hover:bg-error-container/50 p-2 rounded-full transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <!-- Modal Body (Scrollable) -->
            <div class="p-6 overflow-y-auto flex-1 custom-scrollbar">
                <!-- Content goes here based on design system -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Ayah Data Section -->
                    <div class="space-y-4">
                        <h4
                            class="font-h3 text-h3 text-on-surface font-medium border-b border-outline-variant/20 pb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">man</span> Data Ayah
                        </h4>
                        <!-- Form read-only fields would go here -->
                    </div>
                    <!-- Ibu Data Section -->
                    <div class="space-y-4">
                        <h4
                            class="font-h3 text-h3 text-on-surface font-medium border-b border-outline-variant/20 pb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">woman</span> Data Ibu
                        </h4>
                        <!-- Form read-only fields would go here -->
                    </div>
                </div>
                <!-- Relasi Anak Section -->
                <div class="mt-8">
                    <h4
                        class="font-h3 text-h3 text-on-surface font-medium border-b border-outline-variant/20 pb-2 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">face</span> Relasi Anak (Siswa)
                    </h4>
                    <!-- Cards for students would go here -->
                </div>
            </div>
            <!-- Modal Footer -->
            <div
                class="px-6 py-4 border-t border-outline-variant/30 flex justify-end gap-3 bg-surface-container-lowest/50">
                <button
                    class="px-4 py-2 rounded-xl text-on-surface font-medium hover:bg-surface-container-low transition-colors border border-outline-variant/50">Tutup</button>
                <button
                    class="px-4 py-2 rounded-xl bg-primary text-on-primary font-medium hover:bg-primary-container transition-colors shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">edit</span> Edit Data
                </button>
            </div>
        </div>
    </div>
</body>

</html>
