import React from 'react';
import { Link } from 'react-router-dom';

const HERO_IMG = 'https://lh3.googleusercontent.com/aida-public/AB6AXuB4QaNcxE8bJSa1Ct3hatwiIQgmCOgkCxPrImx6kKkwQI0DHn8NwuBCO38rq0xKRGOO1HLNnoTpbYtNVJ_1v96HbwoDJTbQ3PRYd53rtTKXMl1qWPOhZp4oAwSk8dumMEWu_Af8GK3zYJ1f868khF6DrgDIaRhy58KGtHp7j--XyqjyNEd-uXd0lTI5lRS36FMugX2ejfX3h_j-0u3x9Gl3ckNBXQzDAd5m2-iAEQUsfyOJq5FMyQnvS8o40vRr1CwnV8wwvamf2q5O';

const programs = [
    {
        color: 'orange', icon: '☀️', title: 'Kegiatan Sholat Dhuha',
        items: ['Pembiasaan ibadah pagi sebelum memulai pelajaran', 'Pembentukan disiplin spiritual siswa', 'Pendampingan intensif oleh guru kelas']
    },
    {
        color: 'emerald', icon: '📖', title: 'Pembacaan Ratib & Doa',
        items: ['Rutin membaca Ratib Al-Haddad', 'Dzikir pagi (Al-Ma\'tsurat) bersama', 'Pengenalan adab berdoa yang baik']
    },
    {
        color: 'blue', icon: '🙏', title: 'Praktik Ibadah',
        items: ['Praktik wudhu yang benar & tertib', 'Praktik gerakan dan bacaan sholat', 'Pelatihan Adzan & Iqomah untuk putra']
    },
    {
        color: 'teal', icon: '📚', title: 'Hafalan Juz Amma & Asmaul Husna',
        items: ['Metode Talaqqi (face-to-face)', 'Murojaah rutin setiap pagi', 'Target setoran hafalan terukur']
    },
    {
        color: 'red', icon: '⚽', title: 'Kegiatan Olahraga',
        items: ['Senam pagi bersama untuk kebugaran', 'Permainan edukatif & kerjasama tim', 'Pengembangan kemampuan motorik']
    },
    {
        color: 'indigo', icon: '👥', title: 'Ekstrakurikuler',
        items: ['Pramuka (Wajib)', 'Seni Hadroh & Drumband', 'Seni Kaligrafi Islam']
    },
];

const ProgramPage = () => {
    return (
        <>
            {/* Hero Section */}
            <header className="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-[#0d3b23]">
                <div className="absolute inset-0 z-0">
                    <div className="absolute inset-0 bg-[#0d3b23]/90 z-10"></div>
                    <div className="absolute inset-0 bg-gradient-to-t from-[#0d3b23] via-transparent to-transparent z-10"></div>
                    <img alt="Students reading Quran in a group" className="w-full h-full object-cover object-center mix-blend-overlay opacity-40" src={HERO_IMG} />
                </div>
                <div className="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight mb-4 drop-shadow-lg">
                        Program Unggulan <br />
                        <span className="relative inline-block pb-2">
                            Madrasah
                            <span className="absolute bottom-0 left-0 w-full h-1.5 bg-yellow-500 rounded-full"></span>
                        </span>
                    </h1>
                    <p className="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto mt-6 font-light leading-relaxed">
                        Membangun fondasi karakter Islami yang kokoh melalui pembiasaan ibadah harian dan kurikulum yang terintegrasi.
                    </p>
                </div>
            </header>

            {/* Programs Grid */}
            <section className="py-16 bg-slate-50 dark:bg-[#102216] -mt-10 rounded-t-[2.5rem] relative z-30">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="text-center mb-12">
                        <span className="text-emerald-500 font-bold tracking-wider text-sm uppercase mb-2 block">Kurikulum Berbasis Karakter</span>
                        <h2 className="text-3xl md:text-4xl font-bold text-[#0d3b23] dark:text-white">Kegiatan & Pembiasaan Harian</h2>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        {programs.map(prog => (
                            <div key={prog.title} className="bg-white dark:bg-[#1a3324] rounded-2xl p-6 shadow-sm hover:shadow-xl hover:shadow-emerald-500/5 border border-slate-100 dark:border-slate-800 transition-all duration-300 hover:-translate-y-1 group">
                                <div className="w-14 h-14 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 text-3xl">
                                    {prog.icon}
                                </div>
                                <h3 className="text-xl font-bold text-slate-800 dark:text-white mb-4 group-hover:text-emerald-500 transition-colors">{prog.title}</h3>
                                <ul className="space-y-3">
                                    {prog.items.map(item => (
                                        <li key={item} className="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                                            <span className="text-yellow-500 mt-0.5 shrink-0">✓</span>
                                            <span>{item}</span>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* CTA Section */}
            <section className="py-16 bg-white dark:bg-[#102216] border-t border-slate-100 dark:border-slate-800">
                <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 className="text-2xl md:text-3xl font-bold text-[#0d3b23] dark:text-white mb-6">
                        Tertarik dengan Program Kami?
                    </h2>
                    <p className="text-slate-600 dark:text-slate-400 mb-8 max-w-2xl mx-auto">
                        Bergabunglah bersama keluarga besar MI Nurul Huda 3 dan berikan pendidikan terbaik yang seimbang antara
                        ilmu agama dan umum untuk buah hati Anda.
                    </p>
                    <div className="flex flex-col sm:flex-row justify-center gap-4">
                        <Link to="/ppdb" className="px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-bold shadow-lg shadow-emerald-500/30 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            Daftar Sekarang
                        </Link>
                        <button className="px-8 py-4 bg-white dark:bg-[#1a3324] border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-white rounded-xl font-bold transition-all flex items-center justify-center gap-2">
                            Unduh Brosur
                        </button>
                    </div>
                </div>
            </section>
        </>
    );
};

export default ProgramPage;
