<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login - MI Nurul Huda 3</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
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
                        "background-light": "#ffffff",
                        "background-dark": "#102216",
                        "surface-light": "#f8fcf9",
                        "surface-dark": "#1a3324",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"],
                        "body": ["Lexend", "sans-serif"],
                    },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .glass-overlay {
                background: linear-gradient(135deg, rgba(13, 59, 35, 0.92) 0%, rgba(13, 59, 35, 0.8) 100%);
                backdrop-filter: blur(8px);
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.4);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            }

            .dark .glass-card {
                background: rgba(26, 51, 36, 0.9);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .bg-school {
                background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop');
                background-size: cover;
                background-position: center;
            }
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body
    class="bg-surface-light dark:bg-background-dark text-slate-800 dark:text-slate-100 font-display antialiased min-h-screen flex items-center justify-center relative overflow-hidden bg-school">
    <div class="absolute inset-0 z-0 glass-overlay"></div>
    <main class="w-full h-full min-h-screen relative z-10 flex items-center justify-center p-4 sm:p-8 lg:p-12">
        <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-8 items-center">
            <div class="hidden lg:flex flex-col text-white space-y-6 pr-12">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-white shadow-xl mb-4 p-4">
                    <span class="material-symbols-outlined text-6xl text-madrasah-green">school</span>
                </div>
                <h1 class="text-5xl font-extrabold leading-tight">
                    Selamat Datang di <br />
                    <span class="text-primary">Portal Akademik</span><br />
                    MI Nurul Huda 3
                </h1>
                <p class="text-xl text-slate-200 font-light max-w-lg">
                    Akses layanan pendidikan modern, terintegrasi, dan mudah untuk mewujudkan generasi islami yang
                    unggul dan kompetitif.
                </p>
                <div class="flex gap-4 pt-4">
                    <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full border border-white/20">
                        <span class="material-symbols-outlined text-primary">verified_user</span>
                        <span class="text-sm font-medium">Terakreditasi A</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full border border-white/20">
                        <span class="material-symbols-outlined text-secondary">stars</span>
                        <span class="text-sm font-medium">Unggulan</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div
                    class="glass-card rounded-[2rem] p-8 md:p-12 lg:p-14 w-full max-w-[500px] transition-all duration-300">
                    <div class="text-center mb-8 lg:hidden">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white dark:bg-surface-dark shadow-md mb-4 text-madrasah-green dark:text-primary">
                            <span class="material-symbols-outlined text-4xl">school</span>
                        </div>
                        <h1 class="text-2xl font-bold text-madrasah-green dark:text-white">MI Nurul Huda 3</h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Portal Akademik Madrasah</p>
                    </div>
                    <div class="hidden lg:block mb-10">
                        <h2 class="text-3xl font-bold text-madrasah-green dark:text-white mb-2">Masuk ke Portal</h2>
                        <p class="text-slate-500 dark:text-slate-400">Silakan masukkan detail akun Anda</p>
                    </div>
                    <form method="POST" action="{{ route('login.proses') }}">
                        @csrf


                        <input type="hidden" name="role" id="role_input" value="guru">

                        <!-- PILIH ROLE -->
                        <div class="bg-slate-100 dark:bg-black/20 p-1.5 rounded-xl flex relative">

                            <div class="w-1/2 text-center relative z-10">
                                <input checked class="peer sr-only" id="role_guru" name="pilih_role" type="radio"
                                    value="guru" />

                                <label for="role_guru"
                                    class="block w-full py-2 sm:py-2.5 text-xs sm:text-sm font-semibold rounded-lg cursor-pointer
                            transition-colors duration-200 text-slate-500
                            peer-checked:text-madrasah-green peer-checked:bg-white
                            dark:peer-checked:bg-surface-dark dark:peer-checked:text-white
                            shadow-sm peer-checked:shadow-md">

                                    <div class="flex items-center justify-center gap-1 sm:gap-2">
                                        <span class="material-symbols-outlined text-base sm:text-lg">school</span>
                                        <span>Guru</span>
                                    </div>
                                </label>
                            </div>

                            <div class="w-1/2 text-center relative z-10">
                                <input class="peer sr-only" id="role_orangtua" name="pilih_role" type="radio"
                                    value="ortu" />

                                <label for="role_orangtua"
                                    class="block w-full py-2 sm:py-2.5 text-xs sm:text-sm font-semibold rounded-lg cursor-pointer
                            transition-colors duration-200 text-slate-500
                            peer-checked:text-madrasah-green peer-checked:bg-white
                            dark:peer-checked:bg-surface-dark dark:peer-checked:text-white
                            shadow-sm peer-checked:shadow-md">

                                    <div class="flex items-center justify-center gap-1 sm:gap-2">
                                        <span
                                            class="material-symbols-outlined text-base sm:text-lg">family_restroom</span>
                                        <span>Orang Tua</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- INPUT -->
                        <div class="space-y-3 sm:space-y-4">

                            <!-- EMAIL -->
                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none text-slate-400">
                                    <span class="material-symbols-outlined text-lg sm:text-xl">mail</span>
                                </div>

                                <input name="email"
                                    class="block w-full pl-10 sm:pl-12 pr-4 py-3 sm:py-3.5 text-sm sm:text-base
                            bg-white/50 dark:bg-black/20 border border-slate-200 dark:border-slate-700
                            rounded-xl focus:ring-2 focus:ring-primary/50 focus:border-primary"
                                    placeholder="Alamat Email" type="email" required />
                            </div>

                            <!-- PASSWORD -->
                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none text-slate-400">
                                    <span class="material-symbols-outlined text-lg sm:text-xl">lock</span>
                                </div>

                                <input name="password"
                                    class="block w-full pl-10 sm:pl-12 pr-12 py-3 sm:py-3.5 text-sm sm:text-base
                            bg-white/50 dark:bg-black/20 border border-slate-200 dark:border-slate-700
                            rounded-xl focus:ring-2 focus:ring-primary/50 focus:border-primary"
                                    id="password" placeholder="Kata Sandi" type="password" required />
                            </div>
                        </div>

                        <!-- BUTTON -->
                        <div class="pt-1 sm:pt-2 flex flex-col gap-3 sm:gap-4">

                            <button
                                class="w-full bg-primary hover:bg-primary-dark text-white font-bold
                        py-3.5 sm:py-4 text-sm sm:text-base
                        rounded-xl shadow-lg shadow-primary/30
                        active:scale-[0.98] transition-all duration-200
                        flex items-center justify-center gap-2"
                                type="submit">

                                <span>Masuk Sekarang</span>
                                <span class="material-symbols-outlined text-lg sm:text-xl">login</span>
                            </button>

                            <a class="w-full bg-white dark:bg-transparent border border-secondary text-secondary
                        hover:bg-secondary hover:text-white font-bold
                        py-3 sm:py-3.5 text-sm sm:text-base
                        rounded-xl transition-all duration-300 text-center"
                                href="{{ route('register') }}">
                                <span>Daftar Akun Baru</span>
                            </a>
                        </div>

                    </form>
                    <div class="text-center mt-8">
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                            © 2024 MI Nurul Huda 3. <br class="sm:hidden" />Sistem Informasi Akademik.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- <script>
        const togglePassword = document.querySelector('button[type="button"]');
        const passwordInput = document.querySelector('#password');
        const icon = togglePassword.querySelector('span');
        togglePassword.addEventListener('click', function(e) {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            icon.innerText = type === 'password' ? 'visibility_off' : 'visibility';
        });
    </script> --}}

</body>

</html>
