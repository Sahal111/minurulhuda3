import React, { useState } from 'react';
import { Link } from 'react-router-dom';

const HERO_IMG = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCacB7aOolbGbG2aprspS8pKExudcy9WmHGB-2ppsYQhNu-GomTqMB90Jbbz60vP1IcLymoT0z9mr2J5OGAg27Yg8KoLvDim2LLvu2Ogqhh4lZkU0jjNBAzZz7x50--NTYWHgTSrixbGF57TRSVcqADWNaLSWZFm39BxuGvgbNt3jHvl3kV7-5M9JzSReYe1PItvj4flc8LWbyrZO-t6swyyxSzb7mp-y7iZ1SDJUmNtFSoq9Pr8-sc_5519k7mC4WpZlMhis-pzJtA';
const IMG2 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuAZ28Ex1TbLdZyVmkpaqVM5eT-ZJrvon6g4c_-vT8AUWXXfKhMt0-K7KNuF4SMvakS7NwxLHyHM4U8vuA865DQAIgz4pP2kmkfQenthQKghjO63jUxVNIJwhbFmzyPkOBuLVwS1inQM_kW2vwq1q1J7u-Jylmp0soYbtFWJ_GmHswQLqV-mOY4KEZewjET4CSQE3jvQQoCwGUyFl_ea9k3yclCOC6ME41zYYezsK2xsuHdldxi1c9XNGJm81kYvK_gQSf9_6Kz4jxzy';
const IMG3 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuA3wmCO_gYxV8YJJhSkvEYmL-S0zygLxEiNrbcVnYkttyg_VHHyeuFgy-ZSAZTz7Kyw62LgqAFcWZg1HSxaJgCHoJRVojFa7a-8I2X3IVfU4d4Nh0SC6_K30NfOxU43wEABoOq1ePbSUrzfsQ2sk4WbY4j72exB4JSbyRNO2tNvDm_4HImxaiZEn1kzniP08wL7CWWg3fPu3RLx6rtK1ieJJp_4vCsegAF8QSuZWK0Pc_H5S54gsoOZXmmbKRh1XiB7DWnlXftklbaq';
const IMG4 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuB4QaNcxE8bJSa1Ct3hatwiIQgmCOgkCxPrImx6kKkwQI0DHn8NwuBCO38rq0xKRGOO1HLNnoTpbYtNVJ_1v96HbwoDJTbQ3PRYd53rtTKXMl1qWPOhZp4oAwSk8dumMEWu_Af8GK3zYJ1f868khF6DrgDIaRhy58KGtHp7j--XyqjyNEd-uXd0lTI5lRS36FMugX2ejfX3h_j-0u3x9Gl3ckNBXQzDAd5m2-iAEQUsfyOJq5FMyQnvS8o40vRr1CwnV8wwvamf2q5O';
const IMG5 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuDRo8a8aGzPP97WmnBqWeu5itIWD5LTjstSkPK7JN54mykybK_zsPOJwpf0mh3QkvldaNmaBXKWWxWafQHgzd_6LBXG5BoEools_JwheVLxmIiSX1BzyPd2H49URpMMGXaqtOJz5a3YBjdNDr-_d6iWzewCBKoaH9bLE8LBUVyyEv8BlY3Wy08j_MIOw0hE9L6xiX3t6sr58DSM8PSZnzr5Xlv-EXn7gCXmEVuxHm1fZZAj_cRU32gu1h9BtsWynzCehgbVlqxkUVsq';
const IMG6 = 'https://lh3.googleusercontent.com/aida-public/AB6AXuAChLMKf_CTbth2VUkyEJhBeVtEVlfA7bet8Jj71oHWVIYxl3f-cIwkTrmMMGYTlH8AiWRU-uP3CRueB4UDXuFAYKEvlQinugyC_q_Sjsy2cemiVhAqfEg-z9TgWzfe4zvtbw3BT4CBkFn5enQq1qMjZPPVqL-qfab7lrLHNdLymW76QkAYaC69v6Dg76zPh5HE-EO3WK7jXmSP2IeOUtNAske-kKS4ze-FnjIRShMYbGR_cUz_sE33ldIiYgtOVCzhigGWxQncTMYS';

const allGallery = [
    { id: 1, cat: 'Ibadah', tagColor: 'text-emerald-500', title: 'Sholat Dhuha Berjamaah', date: '12 Oktober 2023', img: IMG4, desc: 'Rutinitas pagi siswa-siswi dalam mendekatkan diri kepada Allah SWT sebelum memulai kegiatan belajar mengajar.' },
    { id: 2, cat: 'Kegiatan Harian', tagColor: 'text-yellow-500', title: 'Pembacaan Ratib Bersama', date: '10 Oktober 2023', img: HERO_IMG, desc: 'Kegiatan rutin pembacaan Ratib Al-Haddad untuk menanamkan kecintaan kepada dzikir dan doa bersama.' },
    { id: 3, cat: 'Pembelajaran', tagColor: 'text-blue-500', title: 'Praktik Ibadah Sholat', date: '05 Oktober 2023', img: IMG2, desc: 'Pembelajaran fiqih ibadah secara langsung dengan bimbingan guru untuk menyempurnakan gerakan dan bacaan sholat.' },
    { id: 4, cat: 'Tahfidz', tagColor: 'text-purple-500', title: 'Ujian Hafalan Juz Amma', date: '01 Oktober 2023', img: IMG5, desc: 'Mencetak generasi Qur\'ani melalui program tahfidz unggulan dengan target hafalan minimal Juz 30 lulusan.' },
    { id: 5, cat: 'Ekstrakurikuler', tagColor: 'text-orange-500', title: 'Olahraga Futsal Ceria', date: '28 September 2023', img: IMG3, desc: 'Mengembangkan bakat dan minat siswa di bidang olahraga serta melatih kerjasama tim yang solid.' },
    { id: 6, cat: 'Literasi', tagColor: 'text-blue-500', title: 'Kunjungan Perpustakaan', date: '25 September 2023', img: IMG6, desc: 'Meningkatkan minat baca siswa melalui program kunjungan perpustakaan daerah dan sesi dongeng.' },
];

const categories = ['Semua', 'Ibadah', 'Pembelajaran', 'Ekstrakurikuler', 'Tahfidz', 'Kegiatan Harian'];

const GalleryPage = () => {
    const [activeCategory, setActiveCategory] = useState('Semua');

    const filteredGallery = activeCategory === 'Semua'
        ? allGallery
        : allGallery.filter(item => item.cat === activeCategory);

    return (
        <>
            {/* Hero Section */}
            <header className="relative pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden">
                <div className="absolute inset-0 z-0">
                    <div className="absolute inset-0 bg-gradient-to-b from-[#0d3b23]/95 via-[#0d3b23]/80 to-white dark:to-[#102216] z-10"></div>
                    <img alt="Students doing group activity" className="w-full h-full object-cover object-center" src={HERO_IMG} />
                </div>
                <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-tight mb-4 drop-shadow-lg">
                        Galeri Kegiatan
                        <span className="block text-emerald-400 mt-2">MI Nurul Huda 3</span>
                    </h1>
                    <div className="w-24 h-1.5 bg-yellow-500 mx-auto rounded-full mb-6"></div>
                    <p className="text-lg text-slate-200 max-w-2xl mx-auto font-light leading-relaxed">
                        Dokumentasi perjalanan pendidikan, keceriaan, dan ibadah para siswa dalam membentuk generasi yang berakhlak mulia.
                    </p>
                </div>
            </header>

            {/* Category Filter */}
            <div className="sticky top-16 z-40 bg-white/95 dark:bg-[#102216]/95 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 shadow-sm">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div className="flex overflow-x-auto gap-3 pb-2" style={{ scrollbarWidth: 'none' }}>
                        {categories.map(cat => (
                            <button
                                key={cat}
                                onClick={() => setActiveCategory(cat)}
                                className={`whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold transition-all ${
                                    activeCategory === cat
                                        ? 'bg-emerald-500 text-white shadow-md ring-2 ring-emerald-500 ring-offset-2 dark:ring-offset-[#102216]'
                                        : 'text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-[#1a3324] hover:bg-slate-200 dark:hover:bg-slate-700'
                                }`}
                            >
                                {cat}
                            </button>
                        ))}
                    </div>
                </div>
            </div>

            {/* Gallery Grid */}
            <main className="py-12 bg-slate-50 dark:bg-[#102216] min-h-screen">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        {filteredGallery.map(item => (
                            <div key={item.id} className="group relative bg-white dark:bg-[#1a3324] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 transition-all duration-300 border border-slate-100 dark:border-slate-800">
                                <div className="relative h-64 overflow-hidden">
                                    <img alt={item.title} className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src={item.img} />
                                    <div className="absolute inset-0 bg-[#0d3b23]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                                        <span className="text-white text-5xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">🔍</span>
                                    </div>
                                    <div className="absolute top-4 left-4">
                                        <span className={`px-3 py-1 bg-white/90 dark:bg-black/80 backdrop-blur-sm text-xs font-bold ${item.tagColor} rounded-full uppercase tracking-wide`}>{item.cat}</span>
                                    </div>
                                </div>
                                <div className="p-6">
                                    <div className="flex items-center gap-2 text-slate-400 text-xs mb-3 font-medium">
                                        <span>📅</span>
                                        <span>{item.date}</span>
                                    </div>
                                    <h3 className="text-xl font-bold text-slate-800 dark:text-white mb-2 group-hover:text-emerald-500 transition-colors">{item.title}</h3>
                                    <p className="text-slate-600 dark:text-slate-400 text-sm leading-relaxed line-clamp-2">{item.desc}</p>
                                </div>
                            </div>
                        ))}
                    </div>

                    {/* Pagination */}
                    <div className="mt-16 flex justify-center">
                        <nav className="flex items-center gap-2">
                            <button className="w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 dark:border-slate-700 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800">‹</button>
                            <button className="w-10 h-10 flex items-center justify-center rounded-full bg-emerald-500 text-white font-bold shadow-lg shadow-emerald-500/30">1</button>
                            <button className="w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 dark:border-slate-700 text-slate-600 hover:text-emerald-500 hover:border-emerald-300">2</button>
                            <button className="w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 dark:border-slate-700 text-slate-600 hover:text-emerald-500 hover:border-emerald-300">3</button>
                            <span className="text-slate-400">...</span>
                            <button className="w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 dark:border-slate-700 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800">›</button>
                        </nav>
                    </div>
                </div>
            </main>

            {/* CTA Section */}
            <section className="py-20 bg-[#0d3b23] relative overflow-hidden">
                <div className="absolute inset-0 opacity-10" style={{ backgroundImage: 'radial-gradient(#ffffff 1px, transparent 1px)', backgroundSize: '24px 24px' }}></div>
                <div className="max-w-4xl mx-auto px-4 text-center relative z-10">
                    <h2 className="text-3xl md:text-5xl font-black text-white mb-6 leading-tight">Tertarik dengan Kegiatan Kami?</h2>
                    <p className="text-emerald-100 text-lg mb-10 max-w-2xl mx-auto">Bergabunglah bersama keluarga besar MI Nurul Huda 3 dan berikan pendidikan terbaik untuk buah hati Anda.</p>
                    <Link to="/ppdb" className="px-8 py-4 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl font-bold text-lg shadow-lg transition-all transform hover:-translate-y-1 inline-block">
                        Daftar Sekarang
                    </Link>
                </div>
            </section>
        </>
    );
};

export default GalleryPage;
