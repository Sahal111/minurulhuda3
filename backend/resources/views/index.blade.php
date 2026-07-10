@extends('layouts.app')
@section('content')
    <!-- Hero Section -->
    <header class="relative pt-24 pb-16 lg:pt-32 lg:pb-24 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div
                class="absolute inset-0 bg-gradient-to-b from-madrasah-green/90 via-madrasah-green/80 to-background-light dark:to-background-dark z-10">
            </div>
            <img alt="Happy Indonesian elementary students smiling in uniform"
                class="w-full h-full object-cover object-center"
                data-alt="Happy Indonesian elementary students smiling in uniform"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDRo8a8aGzPP97WmnBqWeu5itIWD5LTjstSkPK7JN54mykybK_zsPOJwpf0mh3QkvldaNmaBXKWWxWafQHgzd_6LBXG5BoEools_JwheVLxmIiSX1BzyPd2H49URpMMGXaqtOJz5a3YBjdNDr-_d6iWzewCBKoaH9bLE8LBUVyyEv8BlY3Wy08j_MIOw0hE9L6xiX3t6sr58DSM8PSZnzr5Xlv-EXn7gCXmEVuxHm1fZZAj_cRU32gu1h9BtsWynzCehgbVlqxkUVsq" />
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-xs font-medium mb-6 animate-fade-in-up">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                Penerimaan Peserta Didik Baru (PPDB) Telah Dibuka
            </div>
            <h1
                class="text-4xl md:text-5xl lg:text-7xl font-black text-white tracking-tight leading-tight mb-6 drop-shadow-sm">
                Membentuk Generasi <span class="text-primary">Qur'ani</span>, <br class="hidden md:block" />Cerdas &amp;
                Berakhlak Mulia
            </h1>
            <p class="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto mb-10 font-light leading-relaxed">
                Mewujudkan pendidikan Islam yang unggul, modern, dan berkarakter untuk masa depan buah hati Anda di
                lingkungan yang asri dan kondusif.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center w-full sm:w-auto">
                <button
                    class="w-full sm:w-auto px-8 py-4 bg-primary hover:bg-primary-dark text-white rounded-xl font-bold text-lg shadow-xl shadow-primary/20 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2 group">
                    <span>Cek Info PPDB</span>
                    <span
                        class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>
                <button
                    class="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white rounded-xl font-bold text-lg transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">grid_view</span>
                    <span>Lihat Fasilitas</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Statistics Section -->
    <section class="relative z-20 -mt-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div
            class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-white dark:bg-surface-dark rounded-2xl shadow-xl p-6 border border-slate-100 dark:border-slate-800">
            <!-- Stat 1 -->
            <div
                class="flex items-center gap-4 p-4 rounded-xl hover:bg-surface-light dark:hover:bg-black/20 transition-colors">
                <div
                    class="w-14 h-14 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0">
                    <span class="material-symbols-outlined text-3xl">groups</span>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white">1000+</h3>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Alumni Berprestasi</p>
                </div>
            </div>
            <!-- Stat 2 -->
            <div
                class="flex items-center gap-4 p-4 rounded-xl hover:bg-surface-light dark:hover:bg-black/20 transition-colors border-t md:border-t-0 md:border-l border-slate-100 dark:border-slate-800">
                <div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0">
                    <span class="material-symbols-outlined text-3xl">verified_user</span>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white">50+</h3>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Guru Tersertifikasi</p>
                </div>
            </div>
            <!-- Stat 3 -->
            <div
                class="flex items-center gap-4 p-4 rounded-xl hover:bg-surface-light dark:hover:bg-black/20 transition-colors border-t md:border-t-0 md:border-l border-slate-100 dark:border-slate-800">
                <div
                    class="w-14 h-14 rounded-full bg-secondary/10 flex items-center justify-center text-secondary shrink-0">
                    <span class="material-symbols-outlined text-3xl">trophy</span>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white">20+</h3>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Ekstrakurikuler</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Excellence Section -->
    <section class="py-16 md:py-24 bg-surface-light dark:bg-background-dark relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-primary/30 to-transparent">
        </div>
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-secondary/5 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-primary font-bold tracking-wider text-sm uppercase mb-3">Keunggulan Kami</h2>
                <h3 class="text-3xl md:text-4xl font-black text-madrasah-green dark:text-white mb-6">Kenapa Memilih MI
                    Nurul Huda 3?</h3>
                <p class="text-slate-600 dark:text-slate-400 text-lg">
                    Kami memadukan kurikulum nasional dengan nilai-nilai keislaman yang kuat untuk mencetak generasi
                    pemimpin masa depan.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Card 1 -->
                <div
                    class="group bg-white dark:bg-surface-dark rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 hover:-translate-y-1">
                    <div
                        class="w-14 h-14 rounded-xl bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">auto_stories</span>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 dark:text-white mb-3">Tahfidz Al-Qur'an</h4>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                        Program unggulan hafalan Juz 30 dan surat pilihan dengan metode talaqqi yang mutqin dan
                        menyenangkan bagi anak.
                    </p>
                </div>
                <!-- Card 2 -->
                <div
                    class="group bg-white dark:bg-surface-dark rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 hover:-translate-y-1">
                    <div
                        class="w-14 h-14 rounded-xl bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">devices</span>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 dark:text-white mb-3">Digital Classroom</h4>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                        Fasilitas pembelajaran modern dengan smart TV dan proyektor di setiap kelas untuk menunjang
                        pembelajaran interaktif.
                    </p>
                </div>
                <!-- Card 3 -->
                <div
                    class="group bg-white dark:bg-surface-dark rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 hover:-translate-y-1">
                    <div
                        class="w-14 h-14 rounded-xl bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">diversity_1</span>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 dark:text-white mb-3">Character Building</h4>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                        Pembiasaan sholat dhuha, dzuhur berjamaah, dan adab islami sehari-hari untuk membentuk akhlakul
                        karimah.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery Preview -->
    <section class="py-16 bg-white dark:bg-background-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
                <div>
                    <h3 class="text-3xl font-black text-madrasah-green dark:text-white mb-2">Galeri Kegiatan</h3>
                    <p class="text-slate-600 dark:text-slate-400">Intip keseruan belajar dan bermain di MI Nurul Huda 3
                    </p>
                </div>
                <a class="text-primary font-bold flex items-center gap-1 hover:gap-2 transition-all" href="#">
                    Lihat Semua <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 h-96 md:h-80">
                <div class="col-span-2 row-span-2 rounded-2xl overflow-hidden relative group">
                    <img alt="Students studying together in library"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Students studying together in library"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCacB7aOolbGbG2aprspS8pKExudcy9WmHGB-2ppsYQhNu-GomTqMB90Jbbz60vP1IcLymoT0z9mr2J5OGAg27Yg8KoLvDim2LLvu2Ogqhh4lZkU0jjNBAzZz7x50--NTYWHgTSrixbGF57TRSVcqADWNaLSWZFm39BxuGvgbNt3jHvl3kV7-5M9JzSReYe1PItvj4flc8LWbyrZO-t6swyyxSzb7mp-y7iZ1SDJUmNtFSoq9Pr8-sc_5519k7mC4WpZlMhis-pzJtA" />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                        <p class="text-white font-medium">Kegiatan Membaca Bersama</p>
                    </div>
                </div>
                <div class="col-span-1 row-span-1 rounded-2xl overflow-hidden relative group">
                    <img alt="Teacher helping student in classroom"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Teacher helping student in classroom"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAZ28Ex1TbLdZyVmkpaqVM5eT-ZJrvon6g4c_-vT8AUWXXfKhMt0-K7KNuF4SMvakS7NwxLHyHM4U8vuA865DQAIgz4pP2kmkfQenthQKghjO63jUxVNIJwhbFmzyPkOBuLVwS1inQM_kW2vwq1q1J7u-Jylmp0soYbtFWJ_GmHswQLqV-mOY4KEZewjET4CSQE3jvQQoCwGUyFl_ea9k3yclCOC6ME41zYYezsK2xsuHdldxi1c9XNGJm81kYvK_gQSf9_6Kz4jxzy" />
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors"></div>
                </div>
                <div class="col-span-1 row-span-1 rounded-2xl overflow-hidden relative group">
                    <img alt="Students playing sports outside"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Students playing sports outside"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA3wmCO_gYxV8YJJhSkvEYmL-S0zygLxEiNrbcVnYkttyg_VHHyeuFgy-ZSAZTz7Kyw62LgqAFcWZg1HSxaJgCHoJRVojFa7a-8I2X3IVfU4d4Nh0SC6_K30NfOxU43wEABoOq1ePbSUrzfsQ2sk4WbY4j72exB4JSbyRNO2tNvDm_4HImxaiZEn1kzniP08wL7CWWg3fPu3RLx6rtK1ieJJp_4vCsegAF8QSuZWK0Pc_H5S54gsoOZXmmbKRh1XiB7DWnlXftklbaq" />
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors"></div>
                </div>
                <div class="col-span-2 md:col-span-2 row-span-1 rounded-2xl overflow-hidden relative group">
                    <img alt="Islamic studies class session"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Islamic studies class session"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuB4QaNcxE8bJSa1Ct3hatwiIQgmCOgkCxPrImx6kKkwQI0DHn8NwuBCO38rq0xKRGOO1HLNnoTpbYtNVJ_1v96HbwoDJTbQ3PRYd53rtTKXMl1qWPOhZp4oAwSk8dumMEWu_Af8GK3zYJ1f868khF6DrgDIaRhy58KGtHp7j--XyqjyNEd-uXd0lTI5lRS36FMugX2ejfX3h_j-0u3x9Gl3ckNBXQzDAd5m2-iAEQUsfyOJq5FMyQnvS8o40vRr1CwnV8wwvamf2q5O" />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                        <p class="text-white font-medium text-sm">Praktek Ibadah</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA Section -->
    <section class="py-20 bg-madrasah-green relative overflow-hidden">
        <!-- Abstract Pattern -->
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <div class="inline-block p-3 rounded-full bg-white/10 mb-6">
                <span class="material-symbols-outlined text-4xl text-secondary">school</span>
            </div>
            <h2 class="text-3xl md:text-5xl font-black text-white mb-6 leading-tight">Siap Bergabung Menjadi Bagian
                Keluarga Besar Kami?</h2>
            <p class="text-emerald-100 text-lg mb-10 max-w-2xl mx-auto">Kuota terbatas. Segera daftarkan putra-putri
                Anda untuk mendapatkan pendidikan terbaik berbasis Islam.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button
                    class="px-8 py-4 bg-secondary hover:bg-yellow-600 text-white rounded-xl font-bold text-lg shadow-lg shadow-yellow-900/20 transition-all transform hover:-translate-y-1">
                    Daftar Online Sekarang
                </button>
                <button
                    class="px-8 py-4 bg-transparent border-2 border-emerald-400 hover:bg-emerald-800 text-white rounded-xl font-bold text-lg transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">call</span>
                    Hubungi Kami
                </button>
            </div>
        </div>
    </section>
@endsection
