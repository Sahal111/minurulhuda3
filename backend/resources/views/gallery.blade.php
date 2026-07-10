@extends('layouts.app')
@section('content')
    <header class="relative pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div
                class="absolute inset-0 bg-gradient-to-b from-madrasah-green/95 via-madrasah-green/80 to-background-light dark:to-background-dark z-10">
            </div>
            <img alt="Students doing group activity" class="w-full h-full object-cover object-center"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCacB7aOolbGbG2aprspS8pKExudcy9WmHGB-2ppsYQhNu-GomTqMB90Jbbz60vP1IcLymoT0z9mr2J5OGAg27Yg8KoLvDim2LLvu2Ogqhh4lZkU0jjNBAzZz7x50--NTYWHgTSrixbGF57TRSVcqADWNaLSWZFm39BxuGvgbNt3jHvl3kV7-5M9JzSReYe1PItvj4flc8LWbyrZO-t6swyyxSzb7mp-y7iZ1SDJUmNtFSoq9Pr8-sc_5519k7mC4WpZlMhis-pzJtA" />
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1
                class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-tight mb-4 drop-shadow-lg">
                Galeri Kegiatan
                <span class="block text-primary mt-2">MI Nurul Huda 3</span>
            </h1>
            <div class="w-24 h-1.5 bg-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-slate-200 max-w-2xl mx-auto font-light leading-relaxed">
                Dokumentasi perjalanan pendidikan, keceriaan, dan ibadah para siswa dalam membentuk generasi yang
                berakhlak mulia.
            </p>
        </div>
    </header>
    <div
        class="sticky top-16 z-40 bg-white/95 dark:bg-background-dark/95 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex overflow-x-auto gap-3 pb-2 hide-scrollbar">
                <button
                    class="whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold transition-all shadow-md bg-primary text-white ring-2 ring-primary ring-offset-2 dark:ring-offset-background-dark">
                    Semua
                </button>
                <button
                    class="whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-surface-dark hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    Ibadah
                </button>
                <button
                    class="whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-surface-dark hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    Pembelajaran
                </button>
                <button
                    class="whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-surface-dark hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    Ekstrakurikuler
                </button>
                <button
                    class="whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-surface-dark hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    Lomba
                </button>
                <button
                    class="whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-surface-dark hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    Kegiatan Harian
                </button>
            </div>
        </div>
    </div>
    <main class="py-12 bg-surface-light dark:bg-background-dark min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <div
                    class="group relative bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 border border-slate-100 dark:border-slate-800">
                    <div class="relative h-64 overflow-hidden">
                        <img alt="Sholat Dhuha Berjamaah"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuB4QaNcxE8bJSa1Ct3hatwiIQgmCOgkCxPrImx6kKkwQI0DHn8NwuBCO38rq0xKRGOO1HLNnoTpbYtNVJ_1v96HbwoDJTbQ3PRYd53rtTKXMl1qWPOhZp4oAwSk8dumMEWu_Af8GK3zYJ1f868khF6DrgDIaRhy58KGtHp7j--XyqjyNEd-uXd0lTI5lRS36FMugX2ejfX3h_j-0u3x9Gl3ckNBXQzDAd5m2-iAEQUsfyOJq5FMyQnvS8o40vRr1CwnV8wwvamf2q5O" />
                        <div
                            class="absolute inset-0 bg-madrasah-green/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                            <span
                                class="material-symbols-outlined text-white text-5xl drop-shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">zoom_in</span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1 bg-white/90 dark:bg-black/80 backdrop-blur-sm text-xs font-bold text-primary rounded-full uppercase tracking-wide">Ibadah</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 text-slate-400 text-xs mb-3 font-medium">
                            <span class="material-symbols-outlined text-sm">calendar_today</span>
                            <span>12 Oktober 2023</span>
                        </div>
                        <h3
                            class="text-xl font-bold text-slate-800 dark:text-white mb-2 group-hover:text-primary transition-colors">
                            Sholat Dhuha Berjamaah</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm line-clamp-2 leading-relaxed">
                            Rutinitas pagi siswa-siswi dalam mendekatkan diri kepada Allah SWT sebelum memulai kegiatan
                            belajar mengajar.
                        </p>
                    </div>
                </div>
                <div
                    class="group relative bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 border border-slate-100 dark:border-slate-800">
                    <div class="relative h-64 overflow-hidden">
                        <img alt="Pembacaan Ratib"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCacB7aOolbGbG2aprspS8pKExudcy9WmHGB-2ppsYQhNu-GomTqMB90Jbbz60vP1IcLymoT0z9mr2J5OGAg27Yg8KoLvDim2LLvu2Ogqhh4lZkU0jjNBAzZz7x50--NTYWHgTSrixbGF57TRSVcqADWNaLSWZFm39BxuGvgbNt3jHvl3kV7-5M9JzSReYe1PItvj4flc8LWbyrZO-t6swyyxSzb7mp-y7iZ1SDJUmNtFSoq9Pr8-sc_5519k7mC4WpZlMhis-pzJtA" />
                        <div
                            class="absolute inset-0 bg-madrasah-green/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                            <span
                                class="material-symbols-outlined text-white text-5xl drop-shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">zoom_in</span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1 bg-white/90 dark:bg-black/80 backdrop-blur-sm text-xs font-bold text-secondary rounded-full uppercase tracking-wide">Kegiatan
                                Harian</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 text-slate-400 text-xs mb-3 font-medium">
                            <span class="material-symbols-outlined text-sm">calendar_today</span>
                            <span>10 Oktober 2023</span>
                        </div>
                        <h3
                            class="text-xl font-bold text-slate-800 dark:text-white mb-2 group-hover:text-primary transition-colors">
                            Pembacaan Ratib Bersama</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm line-clamp-2 leading-relaxed">
                            Kegiatan rutin pembacaan Ratib Al-Haddad untuk menanamkan kecintaan kepada dzikir dan doa
                            bersama.
                        </p>
                    </div>
                </div>
                <div
                    class="group relative bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 border border-slate-100 dark:border-slate-800">
                    <div class="relative h-64 overflow-hidden">
                        <img alt="Praktik Ibadah"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAZ28Ex1TbLdZyVmkpaqVM5eT-ZJrvon6g4c_-vT8AUWXXfKhMt0-K7KNuF4SMvakS7NwxLHyHM4U8vuA865DQAIgz4pP2kmkfQenthQKghjO63jUxVNIJwhbFmzyPkOBuLVwS1inQM_kW2vwq1q1J7u-Jylmp0soYbtFWJ_GmHswQLqV-mOY4KEZewjET4CSQE3jvQQoCwGUyFl_ea9k3yclCOC6ME41zYYezsK2xsuHdldxi1c9XNGJm81kYvK_gQSf9_6Kz4jxzy" />
                        <div
                            class="absolute inset-0 bg-madrasah-green/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                            <span
                                class="material-symbols-outlined text-white text-5xl drop-shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">zoom_in</span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1 bg-white/90 dark:bg-black/80 backdrop-blur-sm text-xs font-bold text-blue-500 rounded-full uppercase tracking-wide">Pembelajaran</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 text-slate-400 text-xs mb-3 font-medium">
                            <span class="material-symbols-outlined text-sm">calendar_today</span>
                            <span>05 Oktober 2023</span>
                        </div>
                        <h3
                            class="text-xl font-bold text-slate-800 dark:text-white mb-2 group-hover:text-primary transition-colors">
                            Praktik Ibadah Sholat</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm line-clamp-2 leading-relaxed">
                            Pembelajaran fiqih ibadah secara langsung dengan bimbingan guru untuk menyempurnakan gerakan
                            dan bacaan sholat.
                        </p>
                    </div>
                </div>
                <div
                    class="group relative bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 border border-slate-100 dark:border-slate-800">
                    <div class="relative h-64 overflow-hidden">
                        <img alt="Hafalan Juz Amma"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDRo8a8aGzPP97WmnBqWeu5itIWD5LTjstSkPK7JN54mykybK_zsPOJwpf0mh3QkvldaNmaBXKWWxWafQHgzd_6LBXG5BoEools_JwheVLxmIiSX1BzyPd2H49URpMMGXaqtOJz5a3YBjdNDr-_d6iWzewCBKoaH9bLE8LBUVyyEv8BlY3Wy08j_MIOw0hE9L6xiX3t6sr58DSM8PSZnzr5Xlv-EXn7gCXmEVuxHm1fZZAj_cRU32gu1h9BtsWynzCehgbVlqxkUVsq" />
                        <div
                            class="absolute inset-0 bg-madrasah-green/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                            <span
                                class="material-symbols-outlined text-white text-5xl drop-shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">zoom_in</span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1 bg-white/90 dark:bg-black/80 backdrop-blur-sm text-xs font-bold text-purple-500 rounded-full uppercase tracking-wide">Tahfidz</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 text-slate-400 text-xs mb-3 font-medium">
                            <span class="material-symbols-outlined text-sm">calendar_today</span>
                            <span>01 Oktober 2023</span>
                        </div>
                        <h3
                            class="text-xl font-bold text-slate-800 dark:text-white mb-2 group-hover:text-primary transition-colors">
                            Ujian Hafalan Juz Amma</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm line-clamp-2 leading-relaxed">
                            Mencetak generasi Qur'ani melalui program tahfidz unggulan dengan target hafalan minimal Juz
                            30 lulusan.
                        </p>
                    </div>
                </div>
                <div
                    class="group relative bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 border border-slate-100 dark:border-slate-800">
                    <div class="relative h-64 overflow-hidden">
                        <img alt="Olahraga Pagi"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuA3wmCO_gYxV8YJJhSkvEYmL-S0zygLxEiNrbcVnYkttyg_VHHyeuFgy-ZSAZTz7Kyw62LgqAFcWZg1HSxaJgCHoJRVojFa7a-8I2X3IVfU4d4Nh0SC6_K30NfOxU43wEABoOq1ePbSUrzfsQ2sk4WbY4j72exB4JSbyRNO2tNvDm_4HImxaiZEn1kzniP08wL7CWWg3fPu3RLx6rtK1ieJJp_4vCsegAF8QSuZWK0Pc_H5S54gsoOZXmmbKRh1XiB7DWnlXftklbaq" />
                        <div
                            class="absolute inset-0 bg-madrasah-green/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                            <span
                                class="material-symbols-outlined text-white text-5xl drop-shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">zoom_in</span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1 bg-white/90 dark:bg-black/80 backdrop-blur-sm text-xs font-bold text-orange-500 rounded-full uppercase tracking-wide">Ekstrakurikuler</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 text-slate-400 text-xs mb-3 font-medium">
                            <span class="material-symbols-outlined text-sm">calendar_today</span>
                            <span>28 September 2023</span>
                        </div>
                        <h3
                            class="text-xl font-bold text-slate-800 dark:text-white mb-2 group-hover:text-primary transition-colors">
                            Olahraga Futsal Ceria</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm line-clamp-2 leading-relaxed">
                            Mengembangkan bakat dan minat siswa di bidang olahraga serta melatih kerjasama tim yang
                            solid.
                        </p>
                    </div>
                </div>
                <div
                    class="group relative bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 border border-slate-100 dark:border-slate-800">
                    <div class="relative h-64 overflow-hidden">
                        <img alt="Kunjungan Perpustakaan"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAChLMKf_CTbth2VUkyEJhBeVtEVlfA7bet8Jj71oHWVIYxl3f-cIwkTrmMMGYTlH8AiWRU-uP3CRueB4UDXuFAYKEvlQinugyC_q_Sjsy2cemiVhAqfEg-z9TgWzfe4zvtbw3BT4CBkFn5enQq1qMjZPPVqL-qfab7lrLHNdLymW76QkAYaC69v6Dg76zPh5HE-EO3WK7jXmSP2IeOUtNAske-kKS4ze-FnjIRShMYbGR_cUz_sE33ldIiYgtOVCzhigGWxQncTMYS" />
                        <div
                            class="absolute inset-0 bg-madrasah-green/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                            <span
                                class="material-symbols-outlined text-white text-5xl drop-shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">zoom_in</span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1 bg-white/90 dark:bg-black/80 backdrop-blur-sm text-xs font-bold text-blue-500 rounded-full uppercase tracking-wide">Literasi</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 text-slate-400 text-xs mb-3 font-medium">
                            <span class="material-symbols-outlined text-sm">calendar_today</span>
                            <span>25 September 2023</span>
                        </div>
                        <h3
                            class="text-xl font-bold text-slate-800 dark:text-white mb-2 group-hover:text-primary transition-colors">
                            Kunjungan Perpustakaan</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm line-clamp-2 leading-relaxed">
                            Meningkatkan minat baca siswa melalui program kunjungan perpustakaan daerah dan sesi
                            dongeng.
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-16 flex justify-center">
                <nav aria-label="Pagination" class="flex items-center gap-2">
                    <a class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 dark:border-slate-700 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </a>
                    <a class="w-10 h-10 flex items-center justify-center rounded-full bg-primary text-white font-bold shadow-lg shadow-primary/30"
                        href="#">1</a>
                    <a class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary transition-colors"
                        href="#">2</a>
                    <a class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary transition-colors"
                        href="#">3</a>
                    <span class="text-slate-400">...</span>
                    <a class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 dark:border-slate-700 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                </nav>
            </div>
        </div>
    </main>
    <section class="py-20 bg-madrasah-green relative overflow-hidden">
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl md:text-5xl font-black text-white mb-6 leading-tight">Tertarik dengan Kegiatan Kami?
            </h2>
            <p class="text-emerald-100 text-lg mb-10 max-w-2xl mx-auto">Bergabunglah bersama keluarga besar MI Nurul
                Huda 3 dan berikan pendidikan terbaik untuk buah hati Anda.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button
                    class="px-8 py-4 bg-secondary hover:bg-yellow-600 text-white rounded-xl font-bold text-lg shadow-lg shadow-yellow-900/20 transition-all transform hover:-translate-y-1">
                    Daftar Sekarang
                </button>
            </div>
        </div>
    </section>
@endsection
