<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Daftar - MI Nurul Huda 3</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
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
</head>

<body
    class="bg-surface-light dark:bg-background-dark text-slate-800 dark:text-slate-100 font-display antialiased min-h-screen flex items-center justify-center relative overflow-x-hidden bg-school">
    <div class="absolute inset-0 z-0 glass-overlay"></div>

    <main class="w-full min-h-screen relative z-10 flex items-center justify-center p-4 sm:p-8 lg:p-12">
        <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-8 items-center">

            <div class="hidden lg:flex flex-col text-white space-y-6 pr-12">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-white shadow-xl mb-4 p-4">
                    <span class="material-symbols-outlined text-5xl text-madrasah-green">person_add</span>
                </div>
                <h1 class="text-5xl font-extrabold leading-tight">
                    Mulai Perjalanan <br />
                    <span class="text-primary">Akademik Anda</span><br />
                    di MI Nurul Huda 3
                </h1>
                <p class="text-xl text-slate-200 font-light max-w-lg">
                    Daftarkan akun Anda untuk mengakses sistem pemantauan siswa dan manajemen kelas yang lebih modern.
                </p>
            </div>

            <div class="flex justify-center">
                <div class="glass-card rounded-[2rem] p-6 md:p-10 w-full max-w-[550px] transition-all duration-300">

                    <div class="text-center mb-6 lg:hidden">
                        <div
                            class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-white dark:bg-surface-dark shadow-md mb-3 text-madrasah-green dark:text-primary">
                            <span class="material-symbols-outlined text-3xl">school</span>
                        </div>
                        <h1 class="text-xl font-bold text-madrasah-green dark:text-white">MI Nurul Huda 3</h1>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-madrasah-green dark:text-white mb-1">Buat Akun Baru</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Pilih peran Anda untuk memulai pendaftaran
                        </p>
                    </div>

                    <form action="/register" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="role" value="ortu">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase ml-1">Nama
                                    Wali</label>
                                <div class="relative group">
                                    <span
                                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-xl">person</span>
                                    <input name="name" type="text" required placeholder="Nama Lengkap"
                                        class="w-full pl-11 pr-4 py-3 bg-white dark:bg-black/20 border-slate-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all text-sm" />
                                </div>
                            </div>
                            <div class="space-y-1.5">
                                <label
                                    class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase ml-1">WhatsApp</label>
                                <div class="relative group">
                                    <span
                                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-xl">chat</span>
                                    <input name="no_wa" type="tel" required placeholder="0812..."
                                        class="w-full pl-11 pr-4 py-3 bg-white dark:bg-black/20 border-slate-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all text-sm" />
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase ml-1">Nama
                                    Siswa</label>
                                <div class="relative group">
                                    <span
                                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-xl">child_care</span>
                                    <input name="nama_siswa" type="text" required placeholder="Nama Anak"
                                        class="w-full pl-11 pr-4 py-3 bg-white dark:bg-black/20 border-slate-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all text-sm" />
                                </div>
                            </div>
                            <div class="space-y-1.5">
                                <label
                                    class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase ml-1">Kelas</label>
                                <div class="relative group">
                                    <span
                                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">school</span>
                                    <select name="kelas" required
                                        class="w-full pl-11 pr-10 py-3 bg-white dark:bg-black/20 border-slate-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all text-sm appearance-none">
                                        <option value="" disabled selected>Pilih Kelas</option>
                                        <option value="1">Kelas 1</option>
                                        <option value="2">Kelas 2</option>
                                        <option value="3">Kelas 3</option>
                                        <option value="4">Kelas 4</option>
                                        <option value="5">Kelas 5</option>
                                        <option value="6">Kelas 6</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label
                                class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase ml-1">Email</label>
                            <div class="relative group">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-xl">mail</span>
                                <input name="email" type="email" required placeholder="email@anda.com"
                                    class="w-full pl-11 pr-4 py-3 bg-white dark:bg-black/20 border-slate-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all text-sm" />
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label
                                class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase ml-1">Password</label>
                            <div class="relative group">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-xl">lock</span>
                                <input name="password" type="password" required placeholder="••••••••"
                                    class="w-full pl-11 pr-4 py-3 bg-white dark:bg-black/20 border-slate-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all text-sm" />
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-madrasah-green hover:bg-black text-white font-bold py-4 rounded-xl shadow-lg transition-all active:scale-[0.98] mt-4">
                            Daftar
                        </button>
                    </form>

                    <div class="mt-8 pt-6 border-t border-slate-200 dark:border-white/10 text-center">
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Sudah memiliki akun?
                            <a href="{{ route('login') }}" class="text-primary font-bold hover:underline ml-1">Masuk
                                sekarang</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
