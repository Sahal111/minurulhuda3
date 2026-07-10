import React from 'react';
import { Link } from 'react-router-dom';
import { ArrowRight, Layout } from 'lucide-react';

const HERO_IMAGE = 'https://lh3.googleusercontent.com/aida-public/AB6AXuDRo8a8aGzPP97WmnBqWeu5itIWD5LTjstSkPK7JN54mykybK_zsPOJwpf0mh3QkvldaNmaBXKWWxWafQHgzd_6LBXG5BoEools_JwheVLxmIiSX1BzyPd2H49URpMMGXaqtOJz5a3YBjdNDr-_d6iWzewCBKoaH9bLE8LBUVyyEv8BlY3Wy08j_MIOw0hE9L6xiX3t6sr58DSM8PSZnzr5Xlv-EXn7gCXmEVuxHm1fZZAj_cRU32gu1h9BtsWynzCehgbVlqxkUVsq';
const IMG1 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCacB7aOolbGbG2aprspS8pKExudcy9WmHGB-2ppsYQhNu-GomTqMB90Jbbz60vP1IcLymoT0z9mr2J5OGAg27Yg8KoLvDim2LLvu2Ogqhh4lZkU0jjNBAzZz7x50--NTYWHgTSrixbGF57TRSVcqADWNaLSWZFm39BxuGvgbNt3jHvl3kV7-5M9JzSReYe1PItvj4flc8LWbyrZO-t6swyyxSzb7mp-y7iZ1SDJUmNtFSoq9Pr8-sc_5519k7mC4WpZlMhis-pzJtA';
const IMG2 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuAZ28Ex1TbLdZyVmkpaqVM5eT-ZJrvon6g4c_-vT8AUWXXfKhMt0-K7KNuF4SMvakS7NwxLHyHM4U8vuA865DQAIgz4pP2kmkfQenthQKghjO63jUxVNIJwhbFmzyPkOBuLVwS1inQM_kW2vwq1q1J7u-Jylmp0soYbtFWJ_GmHswQLqV-mOY4KEZewjET4CSQE3jvQQoCwGUyFl_ea9k3yclCOC6ME41zYYezsK2xsuHdldxi1c9XNGJm81kYvK_gQSf9_6Kz4jxzy';
const IMG3 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuA3wmCO_gYxV8YJJhSkvEYmL-S0zygLxEiNrbcVnYkttyg_VHHyeuFgy-ZSAZTz7Kyw62LgqAFcWZg1HSxaJgCHoJRVojFa7a-8I2X3IVfU4d4Nh0SC6_K30NfOxU43wEABoOq1ePbSUrzfsQ2sk4WbY4j72exB4JSbyRNO2tNvDm_4HImxaiZEn1kzniP08wL7CWWg3fPu3RLx6rtK1ieJJp_4vCsegAF8QSuZWK0Pc_H5S54gsoOZXmmbKRh1XiB7DWnlXftklbaq';
const IMG4 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuB4QaNcxE8bJSa1Ct3hatwiIQgmCOgkCxPrImx6kKkwQI0DHn8NwuBCO38rq0xKRGOO1HLNnoTpbYtNVJ_1v96HbwoDJTbQ3PRYd53rtTKXMl1qWPOhZp4oAwSk8dumMEWu_Af8GK3zYJ1f868khF6DrgDIaRhy58KGtHp7j--XyqjyNEd-uXd0lTI5lRS36FMugX2ejfX3h_j-0u3x9Gl3ckNBXQzDAd5m2-iAEQUsfyOJq5FMyQnvS8o40vRr1CwnV8wwvamf2q5O';

const HomePage = () => {
    return (
        <>
            {/* Hero Section */}
            <header className="relative pt-24 pb-16 lg:pt-32 lg:pb-24 overflow-hidden">
                <div className="absolute inset-0 z-0">
                    <div className="absolute inset-0 bg-gradient-to-b from-[#0d3b23]/90 via-[#0d3b23]/80 to-white dark:to-[#102216] z-10"></div>
                    <img alt="Happy Indonesian elementary students smiling in uniform" className="w-full h-full object-cover object-center" src={HERO_IMAGE} />
                </div>
                <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-xs font-medium mb-6">
                        <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Penerimaan Peserta Didik Baru (PPDB) Telah Dibuka
                    </div>
                    <h1 className="text-4xl md:text-5xl lg:text-7xl font-black text-white tracking-tight leading-tight mb-6 drop-shadow-sm">
                        Membentuk Generasi <span className="text-emerald-400">Qur'ani</span>,{' '}
                        <br className="hidden md:block" />
                        Cerdas & Berakhlak Mulia
                    </h1>
                    <p className="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto mb-10 font-light leading-relaxed">
                        Mewujudkan pendidikan Islam yang unggul, modern, dan berkarakter untuk masa depan buah hati Anda di
                        lingkungan yang asri dan kondusif.
                    </p>
                    <div className="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <Link
                            to="/ppdb"
                            className="w-full sm:w-auto px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-bold text-lg shadow-xl shadow-emerald-500/20 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2 group"
                        >
                            <span>Cek Info PPDB</span>
                            <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
                        </Link>
                        <Link
                            to="/program"
                            className="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white rounded-xl font-bold text-lg transition-all flex items-center justify-center gap-2"
                        >
                            <Layout className="w-5 h-5" />
                            <span>Lihat Fasilitas</span>
                        </Link>
                    </div>
                </div>
            </header>

            {/* Statistics Section */}
            <section className="relative z-20 -mt-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
                <div className="grid grid-cols-1 md:grid-cols-3 gap-4 bg-white dark:bg-[#1a3324] rounded-2xl shadow-xl p-6 border border-slate-100 dark:border-slate-800">
                    <div className="flex items-center gap-4 p-4 rounded-xl hover:bg-slate-50 dark:hover:bg-black/20 transition-colors">
                        <div className="w-14 h-14 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0 text-3xl font-bold">
                            👥
                        </div>
                        <div>
                            <h3 className="text-3xl font-black text-slate-800 dark:text-white">1000+</h3>
                            <p className="text-sm font-medium text-slate-500 dark:text-slate-400">Alumni Berprestasi</p>
                        </div>
                    </div>
                    <div className="flex items-center gap-4 p-4 rounded-xl hover:bg-slate-50 dark:hover:bg-black/20 transition-colors border-t md:border-t-0 md:border-l border-slate-100 dark:border-slate-800">
                        <div className="w-14 h-14 rounded-full bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 shrink-0 text-3xl font-bold">
                            ✅
                        </div>
                        <div>
                            <h3 className="text-3xl font-black text-slate-800 dark:text-white">50+</h3>
                            <p className="text-sm font-medium text-slate-500 dark:text-slate-400">Guru Tersertifikasi</p>
                        </div>
                    </div>
                    <div className="flex items-center gap-4 p-4 rounded-xl hover:bg-slate-50 dark:hover:bg-black/20 transition-colors border-t md:border-t-0 md:border-l border-slate-100 dark:border-slate-800">
                        <div className="w-14 h-14 rounded-full bg-yellow-50 dark:bg-yellow-900/30 flex items-center justify-center text-yellow-500 shrink-0 text-3xl font-bold">
                            🏆
                        </div>
                        <div>
                            <h3 className="text-3xl font-black text-slate-800 dark:text-white">20+</h3>
                            <p className="text-sm font-medium text-slate-500 dark:text-slate-400">Ekstrakurikuler</p>
                        </div>
                    </div>
                </div>
            </section>

            {/* Excellence Section */}
            <section className="py-16 md:py-24 bg-slate-50 dark:bg-[#102216] relative overflow-hidden">
                <div className="absolute -top-24 -right-24 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl"></div>
                <div className="absolute -bottom-24 -left-24 w-64 h-64 bg-yellow-500/5 rounded-full blur-3xl"></div>
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div className="text-center max-w-3xl mx-auto mb-16">
                        <h2 className="text-emerald-500 font-bold tracking-wider text-sm uppercase mb-3">Keunggulan Kami</h2>
                        <h3 className="text-3xl md:text-4xl font-black text-[#0d3b23] dark:text-white mb-6">Kenapa Memilih MI Nurul Huda 3?</h3>
                        <p className="text-slate-600 dark:text-slate-400 text-lg">
                            Kami memadukan kurikulum nasional dengan nilai-nilai keislaman yang kuat untuk mencetak generasi pemimpin masa depan.
                        </p>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                        {[
                            { color: 'green', icon: '📖', title: "Tahfidz Al-Qur'an", desc: "Program unggulan hafalan Juz 30 dan surat pilihan dengan metode talaqqi yang mutqin dan menyenangkan bagi anak." },
                            { color: 'blue', icon: '💻', title: "Digital Classroom", desc: "Fasilitas pembelajaran modern dengan smart TV dan proyektor di setiap kelas untuk menunjang pembelajaran interaktif." },
                            { color: 'orange', icon: '🤝', title: "Character Building", desc: "Pembiasaan sholat dhuha, dzuhur berjamaah, dan adab islami sehari-hari untuk membentuk akhlakul karimah." },
                        ].map((item) => (
                            <div key={item.title} className="group bg-white dark:bg-[#1a3324] rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300 hover:-translate-y-1">
                                <div className="w-14 h-14 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 text-3xl">
                                    {item.icon}
                                </div>
                                <h4 className="text-xl font-bold text-slate-800 dark:text-white mb-3">{item.title}</h4>
                                <p className="text-slate-600 dark:text-slate-400 leading-relaxed">{item.desc}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Gallery Preview */}
            <section className="py-16 bg-white dark:bg-[#102216]">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
                        <div>
                            <h3 className="text-3xl font-black text-[#0d3b23] dark:text-white mb-2">Galeri Kegiatan</h3>
                            <p className="text-slate-600 dark:text-slate-400">Intip keseruan belajar dan bermain di MI Nurul Huda 3</p>
                        </div>
                        <Link to="/gallery" className="text-emerald-500 font-bold flex items-center gap-1 hover:gap-2 transition-all">
                            Lihat Semua <ArrowRight className="w-4 h-4" />
                        </Link>
                    </div>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4 h-96 md:h-80">
                        <div className="col-span-2 row-span-2 rounded-2xl overflow-hidden relative group">
                            <img alt="Students studying together in library" className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src={IMG1} />
                            <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                <p className="text-white font-medium">Kegiatan Membaca Bersama</p>
                            </div>
                        </div>
                        <div className="col-span-1 row-span-1 rounded-2xl overflow-hidden relative group">
                            <img alt="Teacher helping student in classroom" className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src={IMG2} />
                        </div>
                        <div className="col-span-1 row-span-1 rounded-2xl overflow-hidden relative group">
                            <img alt="Students playing sports outside" className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src={IMG3} />
                        </div>
                        <div className="col-span-2 md:col-span-2 row-span-1 rounded-2xl overflow-hidden relative group">
                            <img alt="Islamic studies class session" className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src={IMG4} />
                            <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p className="text-white font-medium text-sm">Praktek Ibadah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* CTA Section */}
            <section className="py-20 bg-[#0d3b23] relative overflow-hidden">
                <div className="absolute inset-0 opacity-10" style={{ backgroundImage: 'radial-gradient(#ffffff 1px, transparent 1px)', backgroundSize: '24px 24px' }}></div>
                <div className="max-w-4xl mx-auto px-4 text-center relative z-10">
                    <h2 className="text-3xl md:text-5xl font-black text-white mb-6 leading-tight">
                        Siap Bergabung Menjadi Bagian Keluarga Besar Kami?
                    </h2>
                    <p className="text-emerald-100 text-lg mb-10 max-w-2xl mx-auto">
                        Kuota terbatas. Segera daftarkan putra-putri Anda untuk mendapatkan pendidikan terbaik berbasis Islam.
                    </p>
                    <div className="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link to="/ppdb" className="px-8 py-4 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl font-bold text-lg shadow-lg transition-all transform hover:-translate-y-1">
                            Daftar Online Sekarang
                        </Link>
                        <a href="tel:+6281234567890" className="px-8 py-4 bg-transparent border-2 border-emerald-400 hover:bg-emerald-800 text-white rounded-xl font-bold text-lg transition-all flex items-center justify-center gap-2">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </section>
        </>
    );
};

export default HomePage;
