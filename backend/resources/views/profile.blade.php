@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-24 lg:pt-40 lg:pb-32 overflow-hidden bg-slate-50 dark:bg-background-dark">
        <div class="absolute inset-0 opacity-[0.03]"
            style="background-image: radial-gradient(#0f766e 1px, transparent 1px); background-size: 32px 32px;"></div>

        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-primary/20 rounded-full blur-[120px] -z-10">
        </div>
        <div class="absolute bottom-0 right-0 w-[300px] h-[300px] bg-secondary/10 rounded-full blur-[80px] -z-10"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            {{-- Breadcrumb (Dibuat seperti Badge/Pill agar lebih rapi) --}}
            <div
                class="inline-flex items-center gap-2 px-3 py-1 mb-8 rounded-full bg-white border border-slate-200 shadow-sm text-sm font-medium text-slate-500">
                <a href="/" class="hover:text-primary transition-colors">Beranda</a>
                <span class="text-slate-300">/</span>
                <span class="text-primary font-bold">Profil Madrasah</span>
            </div>

            {{-- Main Title --}}
            <h1 class="text-4xl md:text-6xl font-black text-slate-900 dark:text-white mb-6 tracking-tight leading-tight">
                Mengenal Lebih Dekat <br class="hidden md:block" />
                <span class="text-madrasah-green relative inline-block">
                    Nurul Huda 3
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-secondary opacity-60" viewBox="0 0 200 9"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.00025 6.99997C25.7501 9.77491 55.986 3.2309 83 2.99999C114.735 2.72866 142.484 7.00003 197 7"
                            stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                    </svg>
                </span>
            </h1>

            <p class="text-lg md:text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
                Sebuah ikhtiar merawat tradisi keilmuan Islam sambil menyongsong kemajuan zaman dengan integritas dan
                inovasi.
            </p>
        </div>
    </section>

    {{-- BAGIAN 2: FILOSOFI / SAMBUTAN (EDITORIAL STYLE) --}}
    {{-- <section class="relative py-20 bg-white dark:bg-background-dark">
        <div class="max-w-3xl mx-auto px-6 relative">
            <div
                class="absolute -top-10 -left-10 text-9xl text-slate-100 dark:text-slate-800 font-serif opacity-70 select-none">
                &ldquo;
            </div>

            <div class="relative z-10 text-center">
                <span
                    class="inline-block py-1 px-3 rounded bg-secondary/10 text-secondary text-xs font-bold uppercase tracking-widest mb-6">
                    Filosofi Kami
                </span>

                <h3
                    class="text-2xl md:text-4xl font-bold text-slate-900 dark:text-white mb-8 leading-snug font-serif italic">
                    "Mewarisi Tradisi, <br /><span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-madrasah-green">Menginspirasi
                        Masa Depan.</span>"
                </h3>

                <div class="w-16 h-1 bg-slate-200 mx-auto mb-8 rounded-full"></div>

                <div
                    class="prose prose-lg prose-slate dark:prose-invert mx-auto text-slate-600 dark:text-slate-400 leading-relaxed md:text-justify">
                    <p class="mb-6">
                        Lebih dari sekadar sekolah, kami adalah <strong class="text-primary font-semibold">ekosistem
                            pertumbuhan</strong> yang memadukan kedalaman spiritual dengan ketajaman intelektual. Di sini,
                        setiap jengkal tanah didedikasikan untuk menumbuhkan benih-benih peradaban yang berakhlak mulia.
                    </p>
                    <p>
                        Kami percaya bahwa pendidikan bukan hanya tentang mengisi bejana dengan air pengetahuan, tetapi
                        menyalakan api keingintahuan dan ketakwaan dalam jiwa setiap peserta didik.
                    </p>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- Sejarah Section --}}
    <section class="py-20 lg:py-28 bg-white dark:bg-background-dark relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative group order-2 lg:order-1">
                    <div
                        class="absolute inset-0 bg-secondary rounded-3xl rotate-3 opacity-20 group-hover:rotate-6 transition-transform duration-500">
                    </div>
                    <div
                        class="relative aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl border-4 border-white dark:border-slate-800">
                        <img alt="Sejarah Pendirian"
                            class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-105"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCacB7aOolbGbG2aprspS8pKExudcy9WmHGB-2ppsYQhNu-GomTqMB90Jbbz60vP1IcLymoT0z9mr2J5OGAg27Yg8KoLvDim2LLvu2Ogqhh4lZkU0jjNBAzZz7x50--NTYWHgTSrixbGF57TRSVcqADWNaLSWZFm39BxuGvgbNt3jHvl3kV7-5M9JzSReYe1PItvj4flc8LWbyrZO-t6swyyxSzb7mp-y7iZ1SDJUmNtFSoq9Pr8-sc_5519k7mC4WpZlMhis-pzJtA" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>
                        <div class="absolute bottom-8 left-8 text-white">
                            <p class="text-sm uppercase tracking-widest opacity-80 mb-1">Established</p>
                            <p class="text-4xl font-black font-serif">1985</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-8 order-1 lg:order-2">
                    <div class="inline-block">
                        <h2 class="text-secondary font-bold tracking-widest text-sm uppercase mb-2">Sejarah Singkat</h2>
                        <h3 class="text-4xl md:text-5xl font-black text-madrasah-green dark:text-white leading-tight">
                            Perjalanan Keilmuan & <span class="text-primary italic">Pengabdian.</span>
                        </h3>
                    </div>

                    <div class="prose prose-lg text-slate-600 dark:text-slate-400 leading-relaxed text-justify">
                        <p>
                            MI Nurul Huda 3 didirikan pada tahun 1985 oleh para tokoh agama setempat yang memiliki visi
                            besar untuk menghadirkan pendidikan dasar Islam berkualitas. Berawal dari bangunan sederhana,
                            madrasah ini bertransformasi menjadi pusat peradaban kecil di lingkungan kami.
                        </p>
                        <p>
                            Selama puluhan tahun, kami konsisten menjaga nilai-nilai luhur kepesantrenan
                            (<em>At-Turats</em>) yang dipadukan harmonis dengan kurikulum modern. Perjalanan ini telah
                            melahirkan ribuan alumni yang kini berkiprah membawa misi <em>Rahmatan lil 'Alamin</em>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Visi & Misi Section (Modern Card Style) --}}
    <section class="py-24 bg-surface-light dark:bg-surface-dark relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-madrasah-green dark:text-white mb-4">Komitmen Kami</h2>
                <div class="w-20 h-1.5 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                <div
                    class="lg:col-span-2 bg-gradient-to-br from-madrasah-green to-[#0f4c3a] rounded-[2.5rem] p-10 text-white relative overflow-hidden flex flex-col justify-center shadow-xl">
                    <div class="absolute top-0 right-0 p-8 opacity-10">
                        <span class="material-symbols-outlined text-9xl">verified</span>
                    </div>
                    <span
                        class="inline-block py-1 px-3 rounded-lg bg-white/20 backdrop-blur-sm text-xs font-bold uppercase tracking-widest w-fit mb-6">Visi</span>
                    <h3 class="text-3xl md:text-4xl font-black leading-tight mb-6 italic">
                        "Terwujudnya generasi Qur'ani, Berakhlak Mulia, Cerdas, dan Unggul."
                    </h3>
                    <p class="text-white/80 font-medium">
                        Menjadi mercusuar pendidikan yang menyeimbangkan IMTAQ dan IPTEK.
                    </p>
                </div>

                <div
                    class="lg:col-span-3 bg-white dark:bg-background-dark rounded-[2.5rem] p-10 shadow-lg border border-slate-100 dark:border-slate-800 flex flex-col justify-center">
                    <span class="text-primary font-bold uppercase tracking-widest text-xs mb-8 block">Misi Utama</span>
                    <div class="grid gap-6">
                        <div class="flex group">
                            <div class="flex-shrink-0 mr-6">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold text-xl group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                    1</div>
                            </div>
                            <div>
                                <h5 class="font-bold text-slate-800 dark:text-white text-lg mb-1">Pendidikan Qur'ani</h5>
                                <p class="text-slate-500 dark:text-slate-400 text-sm">Pendidikan berbasis nilai-nilai
                                    Al-Qur'an dan As-Sunnah yang terintegrasi.</p>
                            </div>
                        </div>
                        <div class="flex group">
                            <div class="flex-shrink-0 mr-6">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-secondary/10 text-secondary flex items-center justify-center font-bold text-xl group-hover:bg-secondary group-hover:text-white transition-colors duration-300">
                                    2</div>
                            </div>
                            <div>
                                <h5 class="font-bold text-slate-800 dark:text-white text-lg mb-1">Potensi Optimal</h5>
                                <p class="text-slate-500 dark:text-slate-400 text-sm">Mengembangkan potensi akademik dan
                                    non-akademik siswa secara seimbang.</p>
                            </div>
                        </div>
                        <div class="flex group">
                            <div class="flex-shrink-0 mr-6">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-madrasah-green/10 text-madrasah-green flex items-center justify-center font-bold text-xl group-hover:bg-madrasah-green group-hover:text-white transition-colors duration-300">
                                    3</div>
                            </div>
                            <div>
                                <h5 class="font-bold text-slate-800 dark:text-white text-lg mb-1">Karakter Islami</h5>
                                <p class="text-slate-500 dark:text-slate-400 text-sm">Membentuk adab melalui pembiasaan
                                    ibadah harian yang terpantau.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Organisasi Section --}}
    <section class="py-24 bg-white dark:bg-background-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-secondary font-bold tracking-wider text-sm uppercase">Tim Manajemen</span>
                <h2 class="text-3xl md:text-4xl font-black text-madrasah-green dark:text-white mt-2">Struktur Organisasi
                </h2>
            </div>

            <div class="flex justify-center mb-16">
                <div class="relative group">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-primary to-secondary rounded-full blur opacity-20 group-hover:opacity-40 transition-opacity">
                    </div>
                    <div
                        class="relative flex flex-col items-center bg-white dark:bg-surface-dark p-8 rounded-3xl shadow-xl border border-slate-100 dark:border-slate-800 max-w-sm text-center">
                        <div class="w-32 h-32 rounded-full p-1 border-2 border-dashed border-primary mb-6">
                            <img alt="Kepala Madrasah" class="w-full h-full object-cover rounded-full"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAZ28Ex1TbLdZyVmkpaqVM5eT-ZJrvon6g4c_-vT8AUWXXfKhMt0-K7KNuF4SMvakS7NwxLHyHM4U8vuA865DQAIgz4pP2kmkfQenthQKghjO63jUxVNIJwhbFmzyPkOBuLVwS1inQM_kW2vwq1q1J7u-Jylmp0soYbtFWJ_GmHswQLqV-mOY4KEZewjET4CSQE3jvQQoCwGUyFl_ea9k3yclCOC6ME41zYYezsK2xsuHdldxi1c9XNGJm81kYvK_gQSf9_6Kz4jxzy" />
                        </div>
                        <h4 class="text-2xl font-bold text-slate-800 dark:text-white mb-1">H. Ahmad Syarifuddin, M.Pd</h4>
                        <p class="text-primary font-medium mb-4">Kepala Madrasah</p>
                        <p class="text-slate-500 text-sm italic">"Memimpin dengan hati, mendidik dengan keteladanan."</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8">
                @foreach ([
            ['name' => 'Siti Aminah, S.Ag', 'role' => 'Waka Kurikulum', 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB4QaNcxE8bJSa1Ct3hatwiIQgmCOgkCxPrImx6kKkwQI0DHn8NwuBCO38rq0xKRGOO1HLNnoTpbYtNVJ_1v96HbwoDJTbQ3PRYd53rtTKXMl1qWPOhZp4oAwSk8dumMEWu_Af8GK3zYJ1f868khF6DrgDIaRhy58KGtHp7j--XyqjyNEd-uXd0lTI5lRS36FMugX2ejfX3h_j-0u3x9Gl3ckNBXQzDAd5m2-iAEQUsfyOJq5FMyQnvS8o40vRr1CwnV8wwvamf2q5O'],
            ['name' => 'Rahmat Hidayat, S.Pd', 'role' => 'Waka Kesiswaan', 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA3wmCO_gYxV8YJJhSkvEYmL-S0zygLxEiNrbcVnYkttyg_VHHyeuFgy-ZSAZTz7Kyw62LgqAFcWZg1HSxaJgCHoJRVojFa7a-8I2X3IVfU4d4Nh0SC6_K30NfOxU43wEABoOq1ePbSUrzfsQ2sk4WbY4j72exB4JSbyRNO2tNvDm_4HImxaiZEn1kzniP08wL7CWWg3fPu3RLx6rtK1ieJJp_4vCsegAF8QSuZWK0Pc_H5S54gsoOZXmmbKRh1XiB7DWnlXftklbaq'],
            ['name' => 'Fatimah Zahra, S.E', 'role' => 'Bendahara', 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDRo8a8aGzPP97WmnBqWeu5itIWD5LTjstSkPK7JN54mykybK_zsPOJwpf0mh3QkvldaNmaBXKWWxWafQHgzd_6LBXG5BoEools_JwheVLxmIiSX1BzyPd2H49URpMMGXaqtOJz5a3YBjdNDr-_d6iWzewCBKoaH9bLE8LBUVyyEv8BlY3Wy08j_MIOw0hE9L6xiX3t6sr58DSM8PSZnzr5Xlv-EXn7gCXmEVuxHm1fZZAj_cRU32gu1h9BtsWynzCehgbVlqxkUVsq'],
            ['name' => 'Budi Santoso, S.Kom', 'role' => 'Tata Usaha', 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCacB7aOolbGbG2aprspS8pKExudcy9WmHGB-2ppsYQhNu-GomTqMB90Jbbz60vP1IcLymoT0z9mr2J5OGAg27Yg8KoLvDim2LLvu2Ogqhh4lZkU0jjNBAzZz7x50--NTYWHgTSrixbGF57TRSVcqADWNaLSWZFm39BxuGvgbNt3jHvl3kV7-5M9JzSReYe1PItvj4flc8LWbyrZO-t6swyyxSzb7mp-y7iZ1SDJUmNtFSoq9Pr8-sc_5519k7mC4WpZlMhis-pzJtA'],
        ] as $staff)
                    <div
                        class="group bg-surface-light dark:bg-surface-dark rounded-2xl p-6 text-center hover:bg-white dark:hover:bg-slate-800 hover:shadow-lg transition-all duration-300 border border-transparent hover:border-slate-100 dark:hover:border-slate-700">
                        <div
                            class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 grayscale group-hover:grayscale-0 transition-all duration-500">
                            <img alt="{{ $staff['name'] }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform"
                                src="{{ $staff['img'] }}" />
                        </div>
                        <h5 class="font-bold text-slate-800 dark:text-white text-sm md:text-base mb-1">{{ $staff['name'] }}
                        </h5>
                        <p class="text-xs text-secondary font-medium uppercase tracking-wide">{{ $staff['role'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Fasilitas Section --}}
    <section class="py-24 bg-surface-light dark:bg-surface-dark overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-3xl md:text-4xl font-black text-madrasah-green dark:text-white">Fasilitas Unggulan</h2>
                    <p class="text-slate-500 mt-2 text-lg">Infrastruktur modern untuk menunjang kenyamanan belajar.</p>
                </div>
                <div class="flex gap-2 hidden md:flex">
                    <button
                        class="w-10 h-10 rounded-full border border-slate-300 flex items-center justify-center text-slate-500 hover:bg-primary hover:text-white hover:border-primary transition-colors">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </button>
                    <button
                        class="w-10 h-10 rounded-full border border-slate-300 flex items-center justify-center text-slate-500 hover:bg-primary hover:text-white hover:border-primary transition-colors">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </div>
            </div>

            <div class="flex overflow-x-auto gap-8 pb-12 hide-scrollbar snap-x snap-mandatory -mx-4 px-4 sm:mx-0 sm:px-0">
                <div
                    class="min-w-[300px] md:min-w-[400px] snap-center bg-white dark:bg-background-dark rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 group border border-slate-100 dark:border-slate-800">
                    <div class="h-56 overflow-hidden relative">
                        <div
                            class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur text-primary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                            Literasi</div>
                        <img alt="Perpustakaan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCacB7aOolbGbG2aprspS8pKExudcy9WmHGB-2ppsYQhNu-GomTqMB90Jbbz60vP1IcLymoT0z9mr2J5OGAg27Yg8KoLvDim2LLvu2Ogqhh4lZkU0jjNBAzZz7x50--NTYWHgTSrixbGF57TRSVcqADWNaLSWZFm39BxuGvgbNt3jHvl3kV7-5M9JzSReYe1PItvj4flc8LWbyrZO-t6swyyxSzb7mp-y7iZ1SDJUmNtFSoq9Pr8-sc_5519k7mC4WpZlMhis-pzJtA" />
                    </div>
                    <div class="p-8">
                        <h4
                            class="text-2xl font-bold text-slate-800 dark:text-white mb-3 group-hover:text-primary transition-colors">
                            Perpustakaan Digital</h4>
                        <p class="text-slate-500 dark:text-slate-400 leading-relaxed mb-6">Akses ribuan buku digital dan
                            fisik dalam ruangan yang nyaman, ber-AC, dan ramah anak.</p>
                        <a href="#"
                            class="inline-flex items-center text-sm font-bold text-secondary hover:text-secondary-dark">
                            Lihat Detail <span class="material-symbols-outlined text-base ml-1">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <div
                    class="min-w-[300px] md:min-w-[400px] snap-center bg-white dark:bg-background-dark rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 group border border-slate-100 dark:border-slate-800">
                    <div class="h-56 overflow-hidden relative">
                        <div
                            class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur text-primary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                            Teknologi</div>
                        <img alt="Lab Komputer"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAZ28Ex1TbLdZyVmkpaqVM5eT-ZJrvon6g4c_-vT8AUWXXfKhMt0-K7KNuF4SMvakS7NwxLHyHM4U8vuA865DQAIgz4pP2kmkfQenthQKghjO63jUxVNIJwhbFmzyPkOBuLVwS1inQM_kW2vwq1q1J7u-Jylmp0soYbtFWJ_GmHswQLqV-mOY4KEZewjET4CSQE3jvQQoCwGUyFl_ea9k3yclCOC6ME41zYYezsK2xsuHdldxi1c9XNGJm81kYvK_gQSf9_6Kz4jxzy" />
                    </div>
                    <div class="p-8">
                        <h4
                            class="text-2xl font-bold text-slate-800 dark:text-white mb-3 group-hover:text-primary transition-colors">
                            Laboratorium Komputer</h4>
                        <p class="text-slate-500 dark:text-slate-400 leading-relaxed mb-6">Pusat pelatihan IT dengan
                            perangkat terbaru untuk menunjang kecakapan digital (Coding & Office).</p>
                        <a href="#"
                            class="inline-flex items-center text-sm font-bold text-secondary hover:text-secondary-dark">
                            Lihat Detail <span class="material-symbols-outlined text-base ml-1">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <div
                    class="min-w-[300px] md:min-w-[400px] snap-center bg-white dark:bg-background-dark rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 group border border-slate-100 dark:border-slate-800">
                    <div class="h-56 overflow-hidden relative">
                        <div
                            class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur text-primary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                            Ibadah</div>
                        <img alt="Masjid"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuB4QaNcxE8bJSa1Ct3hatwiIQgmCOgkCxPrImx6kKkwQI0DHn8NwuBCO38rq0xKRGOO1HLNnoTpbYtNVJ_1v96HbwoDJTbQ3PRYd53rtTKXMl1qWPOhZp4oAwSk8dumMEWu_Af8GK3zYJ1f868khF6DrgDIaRhy58KGtHp7j--XyqjyNEd-uXd0lTI5lRS36FMugX2ejfX3h_j-0u3x9Gl3ckNBXQzDAd5m2-iAEQUsfyOJq5FMyQnvS8o40vRr1CwnV8wwvamf2q5O" />
                    </div>
                    <div class="p-8">
                        <h4
                            class="text-2xl font-bold text-slate-800 dark:text-white mb-3 group-hover:text-primary transition-colors">
                            Masjid Sekolah</h4>
                        <p class="text-slate-500 dark:text-slate-400 leading-relaxed mb-6">Pusat kegiatan keagamaan, shalat
                            berjamaah Dhuha & Dhuhur, serta tahfidz Al-Qur'an harian.</p>
                        <a href="#"
                            class="inline-flex items-center text-sm font-bold text-secondary hover:text-secondary-dark">
                            Lihat Detail <span class="material-symbols-outlined text-base ml-1">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
