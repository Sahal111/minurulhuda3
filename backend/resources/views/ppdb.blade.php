@extends('layouts.app')
@section('content')
    <header class="relative pt-24 pb-16 lg:pt-32 lg:pb-24 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-madrasah-green-deep/90 z-10"></div>
            <img alt="Students in classroom learning" class="w-full h-full object-cover object-center"
                data-alt="Students in classroom learning"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDRo8a8aGzPP97WmnBqWeu5itIWD5LTjstSkPK7JN54mykybK_zsPOJwpf0mh3QkvldaNmaBXKWWxWafQHgzd_6LBXG5BoEools_JwheVLxmIiSX1BzyPd2H49URpMMGXaqtOJz5a3YBjdNDr-_d6iWzewCBKoaH9bLE8LBUVyyEv8BlY3Wy08j_MIOw0hE9L6xiX3t6sr58DSM8PSZnzr5Xlv-EXn7gCXmEVuxHm1fZZAj_cRU32gu1h9BtsWynzCehgbVlqxkUVsq" />
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-secondary/20 backdrop-blur-sm border border-secondary/40 text-secondary text-sm font-bold mb-6">
                <span class="material-symbols-outlined text-sm">campaign</span>
                Penerimaan Peserta Didik Baru 2024/2025
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight mb-6">
                Bergabunglah Menjadi Generasi <br class="hidden md:block" /><span class="text-secondary">Berprestasi
                    &amp; Islami</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto mb-10 font-light leading-relaxed">
                Daftarkan putra-putri Anda dengan mudah melalui formulir online resmi MI Nurul Huda 3. Mari wujudkan
                masa depan cerilang bersama kami.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center w-full sm:w-auto">
                <a class="w-full sm:w-auto px-8 py-4 bg-primary hover:bg-primary-dark text-white rounded-xl font-bold text-lg shadow-xl shadow-primary/20 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3 group"
                    href="https://docs.google.com/forms" target="_blank">
                    <span class="material-symbols-outlined">edit_document</span>
                    <span>Isi Formulir PPDB</span>
                </a>
                <button
                    class="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white rounded-xl font-bold text-lg transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">download</span>
                    <span>Unduh Brosur</span>
                </button>
            </div>
        </div>
    </header>
    <section class="relative z-20 -mt-10 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="bg-white dark:bg-surface-dark rounded-2xl shadow-xl p-6 border-b-4 border-primary flex flex-col items-center text-center transform transition hover:-translate-y-1">
                <div class="w-16 h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-4xl">calendar_month</span>
                </div>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">Gelombang 1</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm">
                    1 Januari - 31 Maret 2024<br />
                    <span class="text-primary font-medium">Diskon Uang Gedung 20%</span>
                </p>
            </div>
            <div
                class="bg-white dark:bg-surface-dark rounded-2xl shadow-xl p-6 border-b-4 border-secondary flex flex-col items-center text-center transform transition hover:-translate-y-1">
                <div class="w-16 h-16 rounded-full bg-secondary/10 text-secondary flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-4xl">schedule</span>
                </div>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">Gelombang 2</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm">
                    1 April - 30 Juni 2024<br />
                    <span class="text-secondary font-medium">Kuota Terbatas</span>
                </p>
            </div>
            <div
                class="bg-white dark:bg-surface-dark rounded-2xl shadow-xl p-6 border-b-4 border-madrasah-green flex flex-col items-center text-center transform transition hover:-translate-y-1">
                <div
                    class="w-16 h-16 rounded-full bg-madrasah-green/10 text-madrasah-green dark:text-green-400 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-4xl">support_agent</span>
                </div>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">Kontak Panitia</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm">
                    Butuh bantuan pendaftaran?<br />
                    <a class="text-madrasah-green dark:text-green-400 font-bold hover:underline" href="#">Chat
                        WhatsApp Panitia</a>
                </p>
            </div>
        </div>
    </section>
    <section class="py-16 bg-surface-light dark:bg-background-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-8 space-y-12">
                    <div>
                        <div class="flex items-center gap-3 mb-8">
                            <span class="w-1.5 h-8 bg-secondary rounded-full"></span>
                            <h2 class="text-2xl font-black text-madrasah-green dark:text-white">Alur Pendaftaran</h2>
                        </div>
                        <div class="relative">
                            <div
                                class="hidden md:block absolute top-8 left-0 w-full h-1 bg-slate-200 dark:bg-slate-700 rounded-full -z-0">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                                <div class="relative z-10 flex flex-col items-center text-center group">
                                    <div
                                        class="w-16 h-16 rounded-full bg-white dark:bg-surface-dark border-4 border-secondary flex items-center justify-center text-secondary font-bold text-2xl shadow-lg mb-4 group-hover:bg-secondary group-hover:text-white transition-colors">
                                        1
                                    </div>
                                    <h4 class="font-bold text-slate-800 dark:text-white mb-2">Isi Formulir</h4>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Klik tombol daftar dan isi
                                        data diri calon siswa secara online.</p>
                                </div>
                                <div class="relative z-10 flex flex-col items-center text-center group">
                                    <div
                                        class="w-16 h-16 rounded-full bg-white dark:bg-surface-dark border-4 border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 font-bold text-2xl shadow-lg mb-4 group-hover:border-secondary group-hover:text-secondary transition-colors">
                                        2
                                    </div>
                                    <h4 class="font-bold text-slate-800 dark:text-white mb-2">Lengkapi Data</h4>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Lengkapi biodata dan data
                                        orang tua/wali dengan benar.</p>
                                </div>
                                <div class="relative z-10 flex flex-col items-center text-center group">
                                    <div
                                        class="w-16 h-16 rounded-full bg-white dark:bg-surface-dark border-4 border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 font-bold text-2xl shadow-lg mb-4 group-hover:border-secondary group-hover:text-secondary transition-colors">
                                        3
                                    </div>
                                    <h4 class="font-bold text-slate-800 dark:text-white mb-2">Upload Berkas</h4>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Unggah foto KK, Akta
                                        Kelahiran, dan Pas Foto terbaru.</p>
                                </div>
                                <div class="relative z-10 flex flex-col items-center text-center group">
                                    <div
                                        class="w-16 h-16 rounded-full bg-white dark:bg-surface-dark border-4 border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 font-bold text-2xl shadow-lg mb-4 group-hover:border-secondary group-hover:text-secondary transition-colors">
                                        4
                                    </div>
                                    <h4 class="font-bold text-slate-800 dark:text-white mb-2">Verifikasi</h4>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Panitia akan memverifikasi
                                        data dan menghubungi Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-surface-dark rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="material-symbols-outlined text-primary text-3xl">fact_check</span>
                            <h2 class="text-2xl font-black text-madrasah-green dark:text-white">Syarat Pendaftaran</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div
                                class="flex items-start gap-3 p-3 rounded-lg hover:bg-surface-light dark:hover:bg-slate-800/50 transition-colors">
                                <span class="material-symbols-outlined text-primary mt-0.5">check_circle</span>
                                <div>
                                    <h5 class="font-bold text-slate-800 dark:text-white">Usia Minimal</h5>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Berusia minimal 6 tahun pada
                                        bulan Juli 2024.</p>
                                </div>
                            </div>
                            <div
                                class="flex items-start gap-3 p-3 rounded-lg hover:bg-surface-light dark:hover:bg-slate-800/50 transition-colors">
                                <span class="material-symbols-outlined text-primary mt-0.5">check_circle</span>
                                <div>
                                    <h5 class="font-bold text-slate-800 dark:text-white">Kartu Keluarga (KK)</h5>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Scan/Foto copy Kartu Keluarga
                                        terbaru.</p>
                                </div>
                            </div>
                            <div
                                class="flex items-start gap-3 p-3 rounded-lg hover:bg-surface-light dark:hover:bg-slate-800/50 transition-colors">
                                <span class="material-symbols-outlined text-primary mt-0.5">check_circle</span>
                                <div>
                                    <h5 class="font-bold text-slate-800 dark:text-white">Akta Kelahiran</h5>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Scan/Foto copy Akta Kelahiran
                                        calon siswa.</p>
                                </div>
                            </div>
                            <div
                                class="flex items-start gap-3 p-3 rounded-lg hover:bg-surface-light dark:hover:bg-slate-800/50 transition-colors">
                                <span class="material-symbols-outlined text-primary mt-0.5">check_circle</span>
                                <div>
                                    <h5 class="font-bold text-slate-800 dark:text-white">Pas Foto</h5>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Pas foto berwarna ukuran 3x4
                                        (2 lembar) background merah.</p>
                                </div>
                            </div>
                            <div
                                class="flex items-start gap-3 p-3 rounded-lg hover:bg-surface-light dark:hover:bg-slate-800/50 transition-colors">
                                <span class="material-symbols-outlined text-primary mt-0.5">check_circle</span>
                                <div>
                                    <h5 class="font-bold text-slate-800 dark:text-white">Ijazah RA/TK (Opsional)</h5>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Scan/Foto copy Ijazah RA/TK
                                        jika sudah ada.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-4 space-y-8">
                    <div class="sticky top-24">
                        <div class="bg-madrasah-green dark:bg-surface-dark rounded-2xl p-6 text-white shadow-xl mb-6">
                            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined">quiz</span>
                                Pertanyaan Umum
                            </h3>
                            <div class="space-y-4">
                                <div class="border-b border-white/10 pb-4">
                                    <button
                                        class="flex justify-between items-center w-full text-left font-semibold text-sm hover:text-secondary transition-colors">
                                        Berapa biaya pendaftarannya?
                                        <span class="material-symbols-outlined text-lg">expand_more</span>
                                    </button>
                                    <p class="mt-2 text-xs text-slate-300 leading-relaxed">
                                        Biaya pendaftaran sebesar Rp 150.000,- (sudah termasuk formulir dan psikotes
                                        awal).
                                    </p>
                                </div>
                                <div class="border-b border-white/10 pb-4">
                                    <button
                                        class="flex justify-between items-center w-full text-left font-semibold text-sm hover:text-secondary transition-colors">
                                        Kapan pengumuman hasil seleksi?
                                        <span class="material-symbols-outlined text-lg">expand_more</span>
                                    </button>
                                    <p class="mt-2 text-xs text-slate-300 leading-relaxed">
                                        Pengumuman akan diinformasikan 1 minggu setelah tes seleksi melalui WhatsApp dan
                                        papan pengumuman sekolah.
                                    </p>
                                </div>
                                <div>
                                    <button
                                        class="flex justify-between items-center w-full text-left font-semibold text-sm hover:text-secondary transition-colors">
                                        Apakah ada jemputan sekolah?
                                        <span class="material-symbols-outlined text-lg">expand_more</span>
                                    </button>
                                    <p class="mt-2 text-xs text-slate-300 leading-relaxed">
                                        Ya, kami menyediakan fasilitas antar-jemput untuk area sekitar sekolah dengan
                                        biaya tambahan.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-white dark:bg-surface-dark rounded-2xl p-6 border border-slate-200 dark:border-slate-800 text-center">
                            <h3 class="font-bold text-slate-800 dark:text-white mb-2">Masih ada pertanyaan?</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Silakan hubungi admin PPDB kami
                                pada jam kerja (08.00 - 14.00).</p>
                            <a class="inline-flex items-center justify-center gap-2 w-full py-3 bg-green-100 hover:bg-green-200 text-green-700 dark:bg-green-900/30 dark:text-green-300 dark:hover:bg-green-900/50 rounded-xl font-bold transition-colors"
                                href="#">
                                <span class="material-symbols-outlined">chat</span>
                                Chat via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
