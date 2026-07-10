import React, { useState } from 'react';
import { Link } from 'react-router-dom';

const HERO_IMG = 'https://lh3.googleusercontent.com/aida-public/AB6AXuDRo8a8aGzPP97WmnBqWeu5itIWD5LTjstSkPK7JN54mykybK_zsPOJwpf0mh3QkvldaNmaBXKWWxWafQHgzd_6LBXG5BoEools_JwheVLxmIiSX1BzyPd2H49URpMMGXaqtOJz5a3YBjdNDr-_d6iWzewCBKoaH9bLE8LBUVyyEv8BlY3Wy08j_MIOw0hE9L6xiX3t6sr58DSM8PSZnzr5Xlv-EXn7gCXmEVuxHm1fZZAj_cRU32gu1h9BtsWynzCehgbVlqxkUVsq';

const requirements = [
    { title: 'Usia Minimal', desc: 'Berusia minimal 6 tahun pada bulan Juli 2024.' },
    { title: 'Kartu Keluarga (KK)', desc: 'Scan/Foto copy Kartu Keluarga terbaru.' },
    { title: 'Akta Kelahiran', desc: 'Scan/Foto copy Akta Kelahiran calon siswa.' },
    { title: 'Pas Foto', desc: 'Pas foto berwarna ukuran 3x4 (2 lembar) background merah.' },
    { title: 'Ijazah RA/TK (Opsional)', desc: 'Scan/Foto copy Ijazah RA/TK jika sudah ada.' },
];

const faqs = [
    { q: 'Berapa biaya pendaftarannya?', a: 'Biaya pendaftaran sebesar Rp 150.000,- (sudah termasuk formulir dan psikotes awal).' },
    { q: 'Kapan pengumuman hasil seleksi?', a: 'Pengumuman akan diinformasikan 1 minggu setelah tes seleksi melalui WhatsApp dan papan pengumuman sekolah.' },
    { q: 'Apakah ada jemputan sekolah?', a: 'Ya, kami menyediakan fasilitas antar-jemput untuk area sekitar sekolah dengan biaya tambahan.' },
];

const PPDBPage = () => {
    const [openFaq, setOpenFaq] = useState(0);

    return (
        <>
            {/* Hero Section */}
            <header className="relative pt-24 pb-16 lg:pt-32 lg:pb-24 overflow-hidden">
                <div className="absolute inset-0 z-0">
                    <div className="absolute inset-0 bg-[#1B4332]/90 z-10"></div>
                    <img alt="Students in classroom learning" className="w-full h-full object-cover object-center" src={HERO_IMG} />
                </div>
                <div className="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-yellow-500/20 backdrop-blur-sm border border-yellow-400/40 text-yellow-400 text-sm font-bold mb-6">
                        📢 Penerimaan Peserta Didik Baru 2024/2025
                    </div>
                    <h1 className="text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight mb-6">
                        Bergabunglah Menjadi Generasi <br className="hidden md:block" />
                        <span className="text-yellow-400">Berprestasi & Islami</span>
                    </h1>
                    <p className="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto mb-10 font-light leading-relaxed">
                        Daftarkan putra-putri Anda dengan mudah melalui formulir online resmi MI Nurul Huda 3.
                    </p>
                    <div className="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="https://docs.google.com/forms" target="_blank" rel="noopener noreferrer"
                            className="w-full sm:w-auto px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-bold text-lg shadow-xl transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3">
                            📝 Isi Formulir PPDB
                        </a>
                        <button className="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white rounded-xl font-bold text-lg transition-all flex items-center justify-center gap-2">
                            ⬇️ Unduh Brosur
                        </button>
                    </div>
                </div>
            </header>

            {/* Gelombang Cards */}
            <section className="relative z-20 -mt-10 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
                <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div className="bg-white dark:bg-[#1a3324] rounded-2xl shadow-xl p-6 border-b-4 border-emerald-500 flex flex-col items-center text-center transform transition hover:-translate-y-1">
                        <div className="w-16 h-16 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mb-4 text-4xl">📅</div>
                        <h3 className="text-xl font-bold text-slate-800 dark:text-white mb-2">Gelombang 1</h3>
                        <p className="text-slate-500 dark:text-slate-400 text-sm">
                            1 Januari - 31 Maret 2024<br />
                            <span className="text-emerald-500 font-medium">Diskon Uang Gedung 20%</span>
                        </p>
                    </div>
                    <div className="bg-white dark:bg-[#1a3324] rounded-2xl shadow-xl p-6 border-b-4 border-yellow-500 flex flex-col items-center text-center transform transition hover:-translate-y-1">
                        <div className="w-16 h-16 rounded-full bg-yellow-50 text-yellow-500 flex items-center justify-center mb-4 text-4xl">⏰</div>
                        <h3 className="text-xl font-bold text-slate-800 dark:text-white mb-2">Gelombang 2</h3>
                        <p className="text-slate-500 dark:text-slate-400 text-sm">
                            1 April - 30 Juni 2024<br />
                            <span className="text-yellow-500 font-medium">Kuota Terbatas</span>
                        </p>
                    </div>
                    <div className="bg-white dark:bg-[#1a3324] rounded-2xl shadow-xl p-6 border-b-4 border-[#0d3b23] flex flex-col items-center text-center transform transition hover:-translate-y-1">
                        <div className="w-16 h-16 rounded-full bg-green-50 text-[#0d3b23] dark:text-green-400 flex items-center justify-center mb-4 text-4xl">🎧</div>
                        <h3 className="text-xl font-bold text-slate-800 dark:text-white mb-2">Kontak Panitia</h3>
                        <p className="text-slate-500 dark:text-slate-400 text-sm">
                            Butuh bantuan pendaftaran?<br />
                            <a href="#" className="text-[#0d3b23] dark:text-green-400 font-bold hover:underline">Chat WhatsApp Panitia</a>
                        </p>
                    </div>
                </div>
            </section>

            {/* Main Content */}
            <section className="py-16 bg-slate-50 dark:bg-[#102216]">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="grid grid-cols-1 lg:grid-cols-12 gap-12">
                        {/* Left - Alur & Syarat */}
                        <div className="lg:col-span-8 space-y-12">
                            {/* Alur Pendaftaran */}
                            <div>
                                <div className="flex items-center gap-3 mb-8">
                                    <span className="w-1.5 h-8 bg-yellow-500 rounded-full"></span>
                                    <h2 className="text-2xl font-black text-[#0d3b23] dark:text-white">Alur Pendaftaran</h2>
                                </div>
                                <div className="relative">
                                    <div className="hidden md:block absolute top-8 left-0 w-full h-1 bg-slate-200 dark:bg-slate-700 rounded-full -z-0"></div>
                                    <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
                                        {['Isi Formulir', 'Lengkapi Data', 'Upload Berkas', 'Verifikasi'].map((step, idx) => (
                                            <div key={step} className="relative z-10 flex flex-col items-center text-center group">
                                                <div className={`w-16 h-16 rounded-full bg-white dark:bg-[#1a3324] border-4 flex items-center justify-center font-bold text-2xl shadow-lg mb-4 transition-colors ${idx === 0 ? 'border-yellow-500 text-yellow-500 group-hover:bg-yellow-500 group-hover:text-white' : 'border-slate-200 dark:border-slate-700 text-slate-400 group-hover:border-yellow-500 group-hover:text-yellow-500'}`}>
                                                    {idx + 1}
                                                </div>
                                                <h4 className="font-bold text-slate-800 dark:text-white mb-2">{step}</h4>
                                            </div>
                                        ))}
                                    </div>
                                </div>
                            </div>

                            {/* Syarat Pendaftaran */}
                            <div className="bg-white dark:bg-[#1a3324] rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                                <div className="flex items-center gap-3 mb-6">
                                    <span className="text-3xl">📋</span>
                                    <h2 className="text-2xl font-black text-[#0d3b23] dark:text-white">Syarat Pendaftaran</h2>
                                </div>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    {requirements.map(req => (
                                        <div key={req.title} className="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                            <span className="text-emerald-500 mt-0.5 text-lg">✅</span>
                                            <div>
                                                <h5 className="font-bold text-slate-800 dark:text-white">{req.title}</h5>
                                                <p className="text-sm text-slate-500 dark:text-slate-400">{req.desc}</p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>

                        {/* Right - FAQ & Contact */}
                        <div className="lg:col-span-4 space-y-8">
                            <div className="sticky top-24">
                                {/* FAQ */}
                                <div className="bg-[#0d3b23] dark:bg-[#1a3324] rounded-2xl p-6 text-white shadow-xl mb-6">
                                    <h3 className="text-xl font-bold mb-6 flex items-center gap-2">
                                        ❓ Pertanyaan Umum
                                    </h3>
                                    <div className="space-y-4">
                                        {faqs.map((faq, idx) => (
                                            <div key={idx} className={idx < faqs.length - 1 ? 'border-b border-white/10 pb-4' : ''}>
                                                <button
                                                    onClick={() => setOpenFaq(openFaq === idx ? -1 : idx)}
                                                    className="flex justify-between items-center w-full text-left font-semibold text-sm hover:text-yellow-400 transition-colors"
                                                >
                                                    {faq.q}
                                                    <span className="ml-2 text-lg">{openFaq === idx ? '▲' : '▼'}</span>
                                                </button>
                                                {openFaq === idx && (
                                                    <p className="mt-2 text-xs text-slate-300 leading-relaxed">{faq.a}</p>
                                                )}
                                            </div>
                                        ))}
                                    </div>
                                </div>

                                {/* Contact */}
                                <div className="bg-white dark:bg-[#1a3324] rounded-2xl p-6 border border-slate-200 dark:border-slate-800 text-center">
                                    <h3 className="font-bold text-slate-800 dark:text-white mb-2">Masih ada pertanyaan?</h3>
                                    <p className="text-sm text-slate-500 dark:text-slate-400 mb-6">Silakan hubungi admin PPDB kami pada jam kerja (08.00 - 14.00).</p>
                                    <a href="https://wa.me/628123456789" target="_blank" rel="noopener noreferrer"
                                        className="inline-flex items-center justify-center gap-2 w-full py-3 bg-green-100 hover:bg-green-200 text-green-700 dark:bg-green-900/30 dark:text-green-300 dark:hover:bg-green-900/50 rounded-xl font-bold transition-colors">
                                        💬 Chat via WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    );
};

export default PPDBPage;
