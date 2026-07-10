<!DOCTYPE html>

<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MI Nurul Huda 3 - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#11d452",
                        "primary-dark": "#0da640",
                        "secondary": "#d4af37",
                        "madrasah-green": "#0d3b23",

                        "madrasah-green-deep": "#1B4332",

                        "background-light": "#ffffff",
                        "background-dark": "#102216",
                        "surface-light": "#f8fcf9",
                        "surface-dark": "#1a3324",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"],
                        "body": ["Lexend", "sans-serif"],
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "2xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        /* DEFAULT DESKTOP */
        #wa-fab {
            bottom: 24px;
            right: 24px;
        }

        /* SAAT ADA BOTTOM NAV (MOBILE) */
        @media(max-width:768px) {
            #wa-fab {
                bottom: 110px;
                /* naik di atas nav */
                right: 16px;
                transform: scale(0.95);
            }
        }

        #nav-indicator {
            position: absolute;
            top: -28px;
            width: 64px;
            height: 64px;
            background: #0A1F12;
            border-radius: 50%;
            z-index: 5;
            transition: .45s cubic-bezier(.68, -.55, .27, 1.55);
        }

        .mobile-tab {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 10;
        }

        .icon-wrapper {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .45s;
            color: #111827;
        }

        .tab-label {
            font-size: 11px;
            margin-top: 4px;
            color: #6B7280;
            transition: .3s;
        }

        .mobile-tab.active .icon-wrapper {
            transform: translateY(-30px);
            color: white !important;
        }

        .mobile-tab.active .tab-label {
            color: #166534;
            font-weight: 700;
            transform: translateY(-6px);
        }
    </style>

    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05)
        }

        .dark .glass-nav {
            background: rgba(16, 34, 22, 0.9);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05)
        }

        .hero-pattern {
            background-color: #0d3b23;
            background-image: url(https://lh3.googleusercontent.com/aida-public/AB6AXuAChLMKf_CTbth2VUkyEJhBeVtEVlfA7bet8Jj71oHWVIYxl3f-cIwkTrmMMGYTlH8AiWRU-uP3CRueB4UDXuFAYKEvlQinugyC_q_Sjsy2cemiVhAqfEg-z9TgWzfe4zvtbw3BT4CBkFn5enQq1qMjZPPVqL-qfab7lrLHNdLymW76QkAYaC69v6Dg76zPh5HE-EO3WK7jXmSP2IeOUtNAske-kKS4ze-FnjIRShMYbGR_cUz_sE33ldIiYgtOVCzhigGWxQncTMYS)
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
    @stack('styles')
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-100 font-display antialiased selection:bg-primary selection:text-white">
    <!-- Sticky Navbar -->
    <nav id="main-nav" class="fixed top-0 w-full z-50 transition-all duration-500 pt-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="nav-content"
                class="transition-all duration-500 border border-transparent rounded-2xl px-6 flex justify-between items-center h-[72px]">

                <a href="/" class="flex items-center gap-3 group">
                    <div class="bg-white/20 p-2 rounded-xl group-hover:bg-primary transition-colors duration-300">
                        <span id="nav-logo-icon" class="material-symbols-outlined text-white text-[26px]">school</span>
                    </div>
                    <div class="flex flex-col">
                        <span id="nav-title" class="font-black text-white text-lg tracking-tight leading-none">
                            MI Nurul Huda 3
                        </span>
                        <span id="nav-subtitle" class="text-[10px] font-medium text-white/70 uppercase tracking-widest">
                            Islamic School
                        </span>
                    </div>
                </a>

                <div id="nav-links" class="hidden md:flex items-center gap-8 text-white">
                    <a href="{{ route('index') }}"
                        class="hover:text-primary transition-colors font-semibold text-sm">Beranda</a>
                    <a href="{{ route('profile') }}"
                        class="hover:text-primary transition-colors font-semibold text-sm">Profil</a>
                    <a href="{{ route('program') }}"
                        class="hover:text-primary transition-colors font-semibold text-sm">Program</a>
                    <a href="{{ route('gallery') }}"
                        class="hover:text-primary transition-colors font-semibold text-sm">Galeri</a>

                    <div class="h-6 w-px bg-white/20 mx-2"></div>

                    <div class="flex items-center gap-3">
                        <button onclick="toggleDark()" class="p-2 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[22px] leading-none">dark_mode</span>
                        </button>
                        {{-- ========== AREA AKUN USER ========== --}}
                        @if (auth()->check())

                            <div class="relative group">
                                <button class="p-1 flex items-center gap-2 hover:text-primary transition-colors">

                                    {{-- FOTO PROFIL JIKA ADA --}}
                                    @if (auth()->user()->foto)
                                        <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                                            class="w-8 h-8 rounded-full object-cover border border-slate-200">
                                    @else
                                        {{-- INISIAL JIKA BELUM ADA FOTO --}}
                                        <div
                                            class="w-8 h-8 rounded-full bg-primary/10 
                        flex items-center justify-center 
                        font-bold text-primary">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                    @endif

                                </button>
                                {{-- DROPDOWN MENU --}}
                                <div
                                    class="absolute right-0 mt-2 w-52 z-50
    bg-white dark:bg-surface-dark
    rounded-xl shadow-2xl border border-slate-200 dark:border-slate-700
    text-slate-800 dark:text-slate-100
    opacity-0 invisible 
    group-hover:opacity-100 group-hover:visible 
    transition-all duration-200">

                                    {{-- HEADER USER --}}
                                    <div class="px-4 py-3 border-b border-slate-200 dark:border-slate-700">
                                        <p class="text-sm font-bold text-slate-800 dark:text-white">
                                            {{ auth()->user()->name }}
                                        </p>
                                        <p class="text-xs text-slate-500 capitalize">
                                            {{ auth()->user()->role }}
                                        </p>
                                    </div>

                                    {{-- MENU DASHBOARD --}}
                                    @php
                                        $role = auth()->user()->role ?? null;
                                        $dashboardRoute = $role ? $role . '.dashboard' : null;
                                    @endphp

                                    @if ($dashboardRoute && Route::has($dashboardRoute))
                                        <a href="{{ route($dashboardRoute) }}"
                                            class="flex items-center gap-2 px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-800 text-sm">
                                            <span class="material-symbols-outlined text-[18px]">dashboard</span>
                                            Dashboard
                                        </a>
                                    @endif

                                    {{-- MENU PROFIL --}}
                                    <a href="/profile"
                                        class="flex items-center gap-2 px-4 py-2 
        hover:bg-slate-100 dark:hover:bg-slate-800 
        text-slate-700 dark:text-slate-200 text-sm">

                                        <span class="material-symbols-outlined text-[18px]">
                                            person
                                        </span>
                                        Profil Saya
                                    </a>

                                    {{-- LOGOUT --}}
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button
                                            class="w-full text-left px-4 py-2 
            hover:bg-red-50 dark:hover:bg-red-900/20 
            text-red-600 text-sm
            flex items-center gap-2">

                                            <span class="material-symbols-outlined text-[18px]">
                                                logout
                                            </span>
                                            Logout
                                        </button>
                                    </form>

                                </div>

                            </div>
                        @else
                            {{-- ========== BELUM LOGIN ========== --}}
                            <a href="/login" class="p-2 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[22px]">
                                    account_circle
                                </span>
                            </a>

                        @endif


                        <a href="{{ route('ppdb') }}"
                            class="ml-2 px-6 py-2.5 bg-primary hover:bg-primary-dark text-white text-sm font-bold rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5">
                            Daftar PPDB
                        </a>
                    </div>
                </div>

                <div class="md:hidden flex items-center gap-3">
                    <button id="mobile-icon" class="p-2 text-white">
                        <span class="material-symbols-outlined text-3xl">menu</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')

    <!-- Footer -->
    <footer class="bg-surface-light dark:bg-black pt-16 pb-8 border-t border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="col-span-1 lg:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-3xl text-primary">school</span>
                        <span class="font-bold text-slate-800 dark:text-white text-xl">MI Nurul Huda 3</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 mb-6 leading-relaxed">
                        Membangun generasi cerdas berkarakter Islami. Sekolah dasar Islam terbaik untuk tumbuh kembang
                        anak Anda.
                    </p>
                    <div class="flex gap-4">
                        <a class="w-10 h-10 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-500 hover:text-primary hover:border-primary transition-all"
                            href="#">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 24 24">
                                <path clip-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    fill-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a class="w-10 h-10 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-500 hover:text-pink-500 hover:border-pink-500 transition-all"
                            href="#">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 24 24">
                                <path clip-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468 2.373c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    fill-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- Links 1 -->
                <div>
                    <h4 class="font-bold text-slate-800 dark:text-white mb-6">Tentang Kami</h4>
                    <ul class="space-y-4">
                        <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-colors"
                                href="#">Profil Sekolah</a></li>
                        <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-colors"
                                href="#">Visi &amp; Misi</a></li>
                        <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-colors"
                                href="#">Struktur Organisasi</a></li>
                        <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-colors"
                                href="#">Prestasi</a></li>
                    </ul>
                </div>
                <!-- Links 2 -->
                <div>
                    <h4 class="font-bold text-slate-800 dark:text-white mb-6">Informasi</h4>
                    <ul class="space-y-4">
                        <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-colors"
                                href="#">PPDB 2024</a></li>
                        <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-colors"
                                href="#">Berita Terkini</a></li>
                        <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-colors"
                                href="#">Agenda Sekolah</a></li>
                        <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-colors"
                                href="#">Karir</a></li>
                    </ul>
                </div>
                <!-- Contact -->
                <div>
                    <h4 class="font-bold text-slate-800 dark:text-white mb-6">Kontak</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span
                                class="material-symbols-outlined text-primary text-xl shrink-0 mt-0.5">location_on</span>
                            <span class="text-slate-500 dark:text-slate-400 text-sm">Jl. Raya Pendidikan No. 123, Kota
                                Bandung, Jawa Barat</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl shrink-0">call</span>
                            <span class="text-slate-500 dark:text-slate-400 text-sm">+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl shrink-0">mail</span>
                            <span class="text-slate-500 dark:text-slate-400 text-sm">info@minurulhuda3.sch.id</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div
                class="border-t border-slate-200 dark:border-slate-800 pt-8 text-center text-sm text-slate-400 dark:text-slate-500">
                <p>© 2024 MI Nurul Huda 3. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <div class="md:hidden fixed bottom-6 left-0 right-0 z-50 px-6">
        <div
            class="bg-white/95 dark:bg-surface-dark/95 backdrop-blur-xl 
border border-slate-200/50 dark:border-slate-800/50 
rounded-[35px] shadow-2xl h-20 relative">

            <div class="grid grid-cols-5 h-full relative">


                <div id="nav-indicator"
                    class="absolute bg-background-dark dark:bg-primary w-14 h-14 rounded-full z-0 top-[-20px]"></div>

                <button onclick="changeTab(this, 0)"
                    class="mobile-tab active flex flex-col items-center justify-center w-full h-full z-10">
                    <div class="icon-wrapper flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">home</span>
                    </div>
                    <span class="tab-label text-[11px] mt-1">Beranda</span>
                </button>

                <button onclick="changeTab(this, 1)"
                    class="mobile-tab flex flex-col items-center justify-center w-full h-full z-10">
                    <div class="icon-wrapper flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">description</span>
                    </div>
                    <span class="tab-label text-[11px] mt-1">Berita</span>
                </button>

                <button onclick="changeTab(this, 2)"
                    class="mobile-tab flex flex-col items-center justify-center w-full h-full z-10">
                    <div class="icon-wrapper flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">grid_view</span>
                    </div>
                    <span class="tab-label text-[11px] mt-1">Menu</span>
                </button>

                <button onclick="changeTab(this, 3)"
                    class="mobile-tab flex flex-col items-center justify-center w-full h-full z-10">
                    <div class="icon-wrapper flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">image</span>
                    </div>
                    <span class="tab-label text-[11px] mt-1">Galeri</span>
                </button>

                <button onclick="changeTab(this, 4)"
                    class="mobile-tab flex flex-col items-center justify-center w-full h-full z-10">
                    <div class="icon-wrapper flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">help_center</span>
                    </div>
                    <span class="tab-label text-[11px] mt-1">Kontak</span>
                </button>

            </div>
        </div>
        <!-- Floating Action Button -->
        <script src="/js/layouts/app.js"></script>
        @stack('scripts')
</body>

</html>
