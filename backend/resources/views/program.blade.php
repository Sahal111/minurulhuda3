@extends('layouts.app')

@section('content')
    <header class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-madrasah-green">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-madrasah-green/90 z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-madrasah-green via-transparent to-transparent z-10">
            </div>
            <img alt="Students reading Quran in a group"
                class="w-full h-full object-cover object-center mix-blend-overlay opacity-40"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuB4QaNcxE8bJSa1Ct3hatwiIQgmCOgkCxPrImx6kKkwQI0DHn8NwuBCO38rq0xKRGOO1HLNnoTpbYtNVJ_1v96HbwoDJTbQ3PRYd53rtTKXMl1qWPOhZp4oAwSk8dumMEWu_Af8GK3zYJ1f868khF6DrgDIaRhy58KGtHp7j--XyqjyNEd-uXd0lTI5lRS36FMugX2ejfX3h_j-0u3x9Gl3ckNBXQzDAd5m2-iAEQUsfyOJq5FMyQnvS8o40vRr1CwnV8wwvamf2q5O" />
        </div>
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white tracking-tight mb-4 drop-shadow-lg">
                Program Unggulan <br />
                <span class="relative inline-block pb-2">
                    Madrasah
                    <span class="absolute bottom-0 left-0 w-full h-1.5 bg-secondary rounded-full"></span>
                </span>
            </h1>
            <p class="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto mt-6 font-light leading-relaxed">
                Membangun fondasi karakter Islami yang kokoh melalui pembiasaan ibadah harian dan kurikulum yang
                terintegrasi.
            </p>
        </div>
    </header>
    <section class="py-16 bg-surface-light dark:bg-background-dark -mt-10 rounded-t-[2.5rem] relative z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-primary font-bold tracking-wider text-sm uppercase mb-2 block">Kurikulum Berbasis
                    Karakter</span>
                <h2 class="text-3xl md:text-4xl font-bold text-madrasah-green dark:text-white">Kegiatan &amp;
                    Pembiasaan Harian</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <div
                    class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-sm hover:shadow-xl hover:shadow-primary/5 border border-slate-100 dark:border-slate-800 transition-all duration-300 hover:-translate-y-1 group">
                    <div
                        class="w-14 h-14 rounded-xl bg-orange-50 dark:bg-orange-900/20 text-orange-500 dark:text-orange-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">sunny</span>
                    </div>
                    <h3
                        class="text-xl font-bold text-slate-800 dark:text-white mb-4 group-hover:text-primary transition-colors">
                        Kegiatan Sholat Dhuha</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Pembiasaan ibadah pagi sebelum memulai pelajaran</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Pembentukan disiplin spiritual siswa</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Pendampingan intensif oleh guru kelas</span>
                        </li>
                    </ul>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-sm hover:shadow-xl hover:shadow-primary/5 border border-slate-100 dark:border-slate-800 transition-all duration-300 hover:-translate-y-1 group">
                    <div
                        class="w-14 h-14 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">menu_book</span>
                    </div>
                    <h3
                        class="text-xl font-bold text-slate-800 dark:text-white mb-4 group-hover:text-primary transition-colors">
                        Pembacaan Ratib &amp; Doa</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Rutin membaca Ratib Al-Haddad</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Dzikir pagi (Al-Ma'tsurat) bersama</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Pengenalan adab berdoa yang baik</span>
                        </li>
                    </ul>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-sm hover:shadow-xl hover:shadow-primary/5 border border-slate-100 dark:border-slate-800 transition-all duration-300 hover:-translate-y-1 group">
                    <div
                        class="w-14 h-14 rounded-xl bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">self_care</span>
                    </div>
                    <h3
                        class="text-xl font-bold text-slate-800 dark:text-white mb-4 group-hover:text-primary transition-colors">
                        Praktik Ibadah</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Praktik wudhu yang benar &amp; tertib</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Praktik gerakan dan bacaan sholat</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Pelatihan Adzan &amp; Iqomah untuk putra</span>
                        </li>
                    </ul>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-sm hover:shadow-xl hover:shadow-primary/5 border border-slate-100 dark:border-slate-800 transition-all duration-300 hover:-translate-y-1 group">
                    <div
                        class="w-14 h-14 rounded-xl bg-teal-50 dark:bg-teal-900/20 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">auto_stories</span>
                    </div>
                    <h3
                        class="text-xl font-bold text-slate-800 dark:text-white mb-4 group-hover:text-primary transition-colors">
                        Hafalan Juz Amma &amp; Asmaul Husna</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Metode Talaqqi (face-to-face)</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Murojaah rutin setiap pagi</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Target setoran hafalan terukur</span>
                        </li>
                    </ul>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-sm hover:shadow-xl hover:shadow-primary/5 border border-slate-100 dark:border-slate-800 transition-all duration-300 hover:-translate-y-1 group">
                    <div
                        class="w-14 h-14 rounded-xl bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">fitness_center</span>
                    </div>
                    <h3
                        class="text-xl font-bold text-slate-800 dark:text-white mb-4 group-hover:text-primary transition-colors">
                        Kegiatan Olahraga</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Senam pagi bersama untuk kebugaran</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Permainan edukatif &amp; kerjasama tim</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Pengembangan kemampuan motorik</span>
                        </li>
                    </ul>
                </div>
                <div
                    class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-sm hover:shadow-xl hover:shadow-primary/5 border border-slate-100 dark:border-slate-800 transition-all duration-300 hover:-translate-y-1 group">
                    <div
                        class="w-14 h-14 rounded-xl bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">groups</span>
                    </div>
                    <h3
                        class="text-xl font-bold text-slate-800 dark:text-white mb-4 group-hover:text-primary transition-colors">
                        Ekstrakurikuler</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Pramuka (Wajib)</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Seni Hadroh &amp; Drumband</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <span
                                class="material-symbols-outlined text-secondary text-lg mt-0.5 shrink-0">check_circle</span>
                            <span>Seni Kaligrafi Islam</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-white dark:bg-background-dark border-t border-slate-100 dark:border-slate-800">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-madrasah-green dark:text-white mb-6">
                Tertarik dengan Program Kami?
            </h2>
            <p class="text-slate-600 dark:text-slate-400 mb-8 max-w-2xl mx-auto">
                Bergabunglah bersama keluarga besar MI Nurul Huda 3 dan berikan pendidikan terbaik yang seimbang antara
                ilmu agama dan umum untuk buah hati Anda.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button
                    class="px-8 py-4 bg-primary hover:bg-primary-dark text-white rounded-xl font-bold shadow-lg shadow-primary/30 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">how_to_reg</span>
                    Daftar Sekarang
                </button>
                <button
                    class="px-8 py-4 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-white rounded-xl font-bold transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-secondary">download</span>
                    Unduh Brosur
                </button>
            </div>
        </div>
    </section>
@endsection
