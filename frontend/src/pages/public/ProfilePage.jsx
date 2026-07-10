import React from 'react';
import { Link } from 'react-router-dom';

const IMG1 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCacB7aOolbGbG2aprspS8pKExudcy9WmHGB-2ppsYQhNu-GomTqMB90Jbbz60vP1IcLymoT0z9mr2J5OGAg27Yg8KoLvDim2LLvu2Ogqhh4lZkU0jjNBAzZz7x50--NTYWHgTSrixbGF57TRSVcqADWNaLSWZFm39BxuGvgbNt3jHvl3kV7-5M9JzSReYe1PItvj4flc8LWbyrZO-t6swyyxSzb7mp-y7iZ1SDJUmNtFSoq9Pr8-sc_5519k7mC4WpZlMhis-pzJtA';
const IMG2 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuAZ28Ex1TbLdZyVmkpaqVM5eT-ZJrvon6g4c_-vT8AUWXXfKhMt0-K7KNuF4SMvakS7NwxLHyHM4U8vuA865DQAIgz4pP2kmkfQenthQKghjO63jUxVNIJwhbFmzyPkOBuLVwS1inQM_kW2vwq1q1J7u-Jylmp0soYbtFWJ_GmHswQLqV-mOY4KEZewjET4CSQE3jvQQoCwGUyFl_ea9k3yclCOC6ME41zYYezsK2xsuHdldxi1c9XNGJm81kYvK_gQSf9_6Kz4jxzy';
const IMG3 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuA3wmCO_gYxV8YJJhSkvEYmL-S0zygLxEiNrbcVnYkttyg_VHHyeuFgy-ZSAZTz7Kyw62LgqAFcWZg1HSxaJgCHoJRVojFa7a-8I2X3IVfU4d4Nh0SC6_K30NfOxU43wEABoOq1ePbSUrzfsQ2sk4WbY4j72exB4JSbyRNO2tNvDm_4HImxaiZEn1kzniP08wL7CWWg3fPu3RLx6rtK1ieJJp_4vCsegAF8QSuZWK0Pc_H5S54gsoOZXmmbKRh1XiB7DWnlXftklbaq';
const IMG4 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuB4QaNcxE8bJSa1Ct3hatwiIQgmCOgkCxPrImx6kKkwQI0DHn8NwuBCO38rq0xKRGOO1HLNnoTpbYtNVJ_1v96HbwoDJTbQ3PRYd53rtTKXMl1qWPOhZp4oAwSk8dumMEWu_Af8GK3zYJ1f868khF6DrgDIaRhy58KGtHp7j--XyqjyNEd-uXd0lTI5lRS36FMugX2ejfX3h_j-0u3x9Gl3ckNBXQzDAd5m2-iAEQUsfyOJq5FMyQnvS8o40vRr1CwnV8wwvamf2q5O';

const staff = [
    { name: 'Siti Aminah, S.Ag', role: 'Waka Kurikulum', img: IMG4 },
    { name: 'Rahmat Hidayat, S.Pd', role: 'Waka Kesiswaan', img: IMG3 },
    { name: 'Fatimah Zahra, S.E', role: 'Bendahara', img: IMG1 },
    { name: 'Budi Santoso, S.Kom', role: 'Tata Usaha', img: IMG2 },
];

const facilities = [
    { tag: 'Literasi', title: 'Perpustakaan Digital', desc: 'Akses ribuan buku digital dan fisik dalam ruangan yang nyaman, ber-AC, dan ramah anak.', img: IMG1 },
    { tag: 'Teknologi', title: 'Laboratorium Komputer', desc: 'Pusat pelatihan IT dengan perangkat terbaru untuk menunjang kecakapan digital (Coding & Office).', img: IMG2 },
    { tag: 'Ibadah', title: 'Masjid Sekolah', desc: "Pusat kegiatan keagamaan, shalat berjamaah Dhuha & Dhuhur, serta tahfidz Al-Qur'an harian.", img: IMG4 },
];

const ProfilePage = () => {
    return (
        <>
            {/* Hero Section */}
            <section className="relative pt-32 pb-24 lg:pt-40 lg:pb-32 overflow-hidden bg-slate-50 dark:bg-[#102216]">
                <div className="absolute inset-0 opacity-[0.03]" style={{ backgroundImage: 'radial-gradient(#0f766e 1px, transparent 1px)', backgroundSize: '32px 32px' }}></div>
                <div className="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-emerald-500/20 rounded-full blur-[120px] -z-10"></div>

                <div className="relative z-10 max-w-4xl mx-auto px-6 text-center">
                    <div className="inline-flex items-center gap-2 px-3 py-1 mb-8 rounded-full bg-white border border-slate-200 shadow-sm text-sm font-medium text-slate-500">
                        <Link to="/" className="hover:text-emerald-500 transition-colors">Beranda</Link>
                        <span className="text-slate-300">/</span>
                        <span className="text-emerald-500 font-bold">Profil Madrasah</span>
                    </div>

                    <h1 className="text-4xl md:text-6xl font-black text-slate-900 dark:text-white mb-6 tracking-tight leading-tight">
                        Mengenal Lebih Dekat <br className="hidden md:block" />
                        <span className="text-[#0d3b23] dark:text-emerald-400">Nurul Huda 3</span>
                    </h1>

                    <p className="text-lg md:text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
                        Sebuah ikhtiar merawat tradisi keilmuan Islam sambil menyongsong kemajuan zaman dengan integritas dan inovasi.
                    </p>
                </div>
            </section>

            {/* Sejarah Section */}
            <section className="py-20 lg:py-28 bg-white dark:bg-[#102216] relative overflow-hidden">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div className="relative group order-2 lg:order-1">
                            <div className="absolute inset-0 bg-yellow-500 rounded-3xl rotate-3 opacity-20 group-hover:rotate-6 transition-transform duration-500"></div>
                            <div className="relative aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl border-4 border-white dark:border-slate-800">
                                <img alt="Sejarah Pendirian" className="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-105" src={IMG1} />
                                <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>
                                <div className="absolute bottom-8 left-8 text-white">
                                    <p className="text-sm uppercase tracking-widest opacity-80 mb-1">Established</p>
                                    <p className="text-4xl font-black">1985</p>
                                </div>
                            </div>
                        </div>

                        <div className="space-y-8 order-1 lg:order-2">
                            <div>
                                <h2 className="text-yellow-600 font-bold tracking-widest text-sm uppercase mb-2">Sejarah Singkat</h2>
                                <h3 className="text-4xl md:text-5xl font-black text-[#0d3b23] dark:text-white leading-tight">
                                    Perjalanan Keilmuan & <span className="text-emerald-500 italic">Pengabdian.</span>
                                </h3>
                            </div>

                            <div className="text-slate-600 dark:text-slate-400 leading-relaxed space-y-4 text-justify">
                                <p>
                                    MI Nurul Huda 3 didirikan pada tahun 1985 oleh para tokoh agama setempat yang memiliki visi
                                    besar untuk menghadirkan pendidikan dasar Islam berkualitas. Berawal dari bangunan sederhana,
                                    madrasah ini bertransformasi menjadi pusat peradaban kecil di lingkungan kami.
                                </p>
                                <p>
                                    Selama puluhan tahun, kami konsisten menjaga nilai-nilai luhur kepesantrenan (<em>At-Turats</em>) yang
                                    dipadukan harmonis dengan kurikulum modern. Perjalanan ini telah melahirkan ribuan alumni yang kini
                                    berkiprah membawa misi <em>Rahmatan lil 'Alamin</em>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Visi & Misi */}
            <section className="py-24 bg-slate-50 dark:bg-[#1a3324] relative">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="text-center mb-16">
                        <h2 className="text-3xl md:text-4xl font-black text-[#0d3b23] dark:text-white mb-4">Komitmen Kami</h2>
                        <div className="w-20 h-1.5 bg-gradient-to-r from-emerald-500 to-yellow-500 mx-auto rounded-full"></div>
                    </div>

                    <div className="grid grid-cols-1 lg:grid-cols-5 gap-8">
                        <div className="lg:col-span-2 bg-gradient-to-br from-[#0d3b23] to-[#0f4c3a] rounded-[2.5rem] p-10 text-white relative overflow-hidden flex flex-col justify-center shadow-xl">
                            <div className="absolute top-0 right-0 p-8 opacity-10 text-9xl font-bold select-none">✓</div>
                            <span className="inline-block py-1 px-3 rounded-lg bg-white/20 backdrop-blur-sm text-xs font-bold uppercase tracking-widest w-fit mb-6">Visi</span>
                            <h3 className="text-3xl md:text-4xl font-black leading-tight mb-6 italic">
                                "Terwujudnya generasi Qur'ani, Berakhlak Mulia, Cerdas, dan Unggul."
                            </h3>
                            <p className="text-white/80 font-medium">Menjadi mercusuar pendidikan yang menyeimbangkan IMTAQ dan IPTEK.</p>
                        </div>

                        <div className="lg:col-span-3 bg-white dark:bg-[#102216] rounded-[2.5rem] p-10 shadow-lg border border-slate-100 dark:border-slate-800 flex flex-col justify-center">
                            <span className="text-emerald-500 font-bold uppercase tracking-widest text-xs mb-8 block">Misi Utama</span>
                            <div className="grid gap-6">
                                {[
                                    { num: 1, color: 'emerald', title: "Pendidikan Qur'ani", desc: "Pendidikan berbasis nilai-nilai Al-Qur'an dan As-Sunnah yang terintegrasi." },
                                    { num: 2, color: 'yellow', title: "Potensi Optimal", desc: "Mengembangkan potensi akademik dan non-akademik siswa secara seimbang." },
                                    { num: 3, color: 'green', title: "Karakter Islami", desc: "Membentuk adab melalui pembiasaan ibadah harian yang terpantau." },
                                ].map(m => (
                                    <div key={m.num} className="flex group">
                                        <div className="flex-shrink-0 mr-6">
                                            <div className="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-xl group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">{m.num}</div>
                                        </div>
                                        <div>
                                            <h5 className="font-bold text-slate-800 dark:text-white text-lg mb-1">{m.title}</h5>
                                            <p className="text-slate-500 dark:text-slate-400 text-sm">{m.desc}</p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Struktur Organisasi */}
            <section className="py-24 bg-white dark:bg-[#102216]">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="text-center mb-16">
                        <span className="text-yellow-600 font-bold tracking-wider text-sm uppercase">Tim Manajemen</span>
                        <h2 className="text-3xl md:text-4xl font-black text-[#0d3b23] dark:text-white mt-2">Struktur Organisasi</h2>
                    </div>

                    <div className="flex justify-center mb-16">
                        <div className="relative group max-w-sm text-center">
                            <div className="relative flex flex-col items-center bg-white dark:bg-[#1a3324] p-8 rounded-3xl shadow-xl border border-slate-100 dark:border-slate-800">
                                <div className="w-32 h-32 rounded-full p-1 border-2 border-dashed border-emerald-500 mb-6">
                                    <img alt="Kepala Madrasah" className="w-full h-full object-cover rounded-full" src={IMG2} />
                                </div>
                                <h4 className="text-2xl font-bold text-slate-800 dark:text-white mb-1">H. Ahmad Syarifuddin, M.Pd</h4>
                                <p className="text-emerald-500 font-medium mb-4">Kepala Madrasah</p>
                                <p className="text-slate-500 text-sm italic">"Memimpin dengan hati, mendidik dengan keteladanan."</p>
                            </div>
                        </div>
                    </div>

                    <div className="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8">
                        {staff.map(s => (
                            <div key={s.name} className="group bg-slate-50 dark:bg-[#1a3324] rounded-2xl p-6 text-center hover:bg-white dark:hover:bg-slate-800 hover:shadow-lg transition-all duration-300 border border-transparent hover:border-slate-100 dark:hover:border-slate-700">
                                <div className="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 grayscale group-hover:grayscale-0 transition-all duration-500">
                                    <img alt={s.name} className="w-full h-full object-cover transform group-hover:scale-110 transition-transform" src={s.img} />
                                </div>
                                <h5 className="font-bold text-slate-800 dark:text-white text-sm md:text-base mb-1">{s.name}</h5>
                                <p className="text-xs text-yellow-600 font-medium uppercase tracking-wide">{s.role}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Fasilitas */}
            <section className="py-24 bg-slate-50 dark:bg-[#1a3324] overflow-hidden">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                        <div>
                            <h2 className="text-3xl md:text-4xl font-black text-[#0d3b23] dark:text-white">Fasilitas Unggulan</h2>
                            <p className="text-slate-500 mt-2 text-lg">Infrastruktur modern untuk menunjang kenyamanan belajar.</p>
                        </div>
                    </div>

                    <div className="flex overflow-x-auto gap-8 pb-12 snap-x snap-mandatory -mx-4 px-4 sm:mx-0 sm:px-0" style={{ scrollbarWidth: 'none' }}>
                        {facilities.map(f => (
                            <div key={f.title} className="min-w-[300px] md:min-w-[400px] snap-center bg-white dark:bg-[#102216] rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 group border border-slate-100 dark:border-slate-800">
                                <div className="h-56 overflow-hidden relative">
                                    <div className="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur text-emerald-500 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">{f.tag}</div>
                                    <img alt={f.title} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src={f.img} />
                                </div>
                                <div className="p-8">
                                    <h4 className="text-2xl font-bold text-slate-800 dark:text-white mb-3 group-hover:text-emerald-500 transition-colors">{f.title}</h4>
                                    <p className="text-slate-500 dark:text-slate-400 leading-relaxed mb-6">{f.desc}</p>
                                    <a href="#" className="inline-flex items-center text-sm font-bold text-yellow-600 hover:text-yellow-700">
                                        Lihat Detail →
                                    </a>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>
        </>
    );
};

export default ProfilePage;
