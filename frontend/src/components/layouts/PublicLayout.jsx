import React, { useState, useEffect } from 'react';
import { Outlet, Link, useLocation } from 'react-router-dom';
import { useAuth } from '../../hooks/useAuth';

const PublicLayout = () => {
    const { user, logout } = useAuth();
    const location = useLocation();
    const [isDarkMode, setIsDarkMode] = useState(false);
    const [isScrolled, setIsScrolled] = useState(false);
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    
    // Listen to scroll to add glassmorphism to nav
    useEffect(() => {
        const handleScroll = () => {
            if (window.scrollY > 20) {
                setIsScrolled(true);
            } else {
                setIsScrolled(false);
            }
        };
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    // Scroll to top on route change
    useEffect(() => {
        window.scrollTo(0, 0);
        setMobileMenuOpen(false);
    }, [location.pathname]);

    const toggleDark = () => setIsDarkMode(!isDarkMode);

    const isActive = (path) => location.pathname === path;

    return (
        <div className={`min-h-screen bg-white dark:bg-[#102216] text-slate-800 dark:text-slate-100 font-sans ${isDarkMode ? 'dark' : ''}`}>
            {/* Sticky Navbar */}
            <nav className={`fixed top-0 w-full z-50 transition-all duration-500 pt-6`}>
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className={`transition-all duration-500 border border-transparent rounded-2xl px-6 flex justify-between items-center h-[72px] ${isScrolled ? 'bg-white/95 dark:bg-[#1a3324]/90 backdrop-blur-md shadow-sm border-slate-200 dark:border-slate-800' : ''}`}>
                        
                        <Link to="/" className="flex items-center gap-3 group">
                            <div className="bg-emerald-500/20 p-2 rounded-xl group-hover:bg-emerald-500 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 text-emerald-600 dark:text-white group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                </svg>
                            </div>
                            <div className="flex flex-col">
                                <span className={`font-black text-lg tracking-tight leading-none ${isScrolled ? 'text-slate-800 dark:text-white' : (location.pathname === '/' ? 'text-white' : 'text-slate-800 dark:text-white')}`}>
                                    MI Nurul Huda 3
                                </span>
                                <span className={`text-[10px] font-medium uppercase tracking-widest ${isScrolled ? 'text-slate-500' : (location.pathname === '/' ? 'text-white/70' : 'text-slate-500')}`}>
                                    Islamic School
                                </span>
                            </div>
                        </Link>

                        <div className="hidden md:flex items-center gap-8">
                            <Link to="/" className={`font-semibold text-sm transition-colors hover:text-emerald-500 ${isActive('/') ? 'text-emerald-500' : (isScrolled ? 'text-slate-700 dark:text-slate-200' : (location.pathname === '/' ? 'text-white' : 'text-slate-700 dark:text-slate-200'))}`}>Beranda</Link>
                            <Link to="/profile" className={`font-semibold text-sm transition-colors hover:text-emerald-500 ${isActive('/profile') ? 'text-emerald-500' : (isScrolled ? 'text-slate-700 dark:text-slate-200' : (location.pathname === '/' ? 'text-white' : 'text-slate-700 dark:text-slate-200'))}`}>Profil</Link>
                            <Link to="/program" className={`font-semibold text-sm transition-colors hover:text-emerald-500 ${isActive('/program') ? 'text-emerald-500' : (isScrolled ? 'text-slate-700 dark:text-slate-200' : (location.pathname === '/' ? 'text-white' : 'text-slate-700 dark:text-slate-200'))}`}>Program</Link>
                            <Link to="/gallery" className={`font-semibold text-sm transition-colors hover:text-emerald-500 ${isActive('/gallery') ? 'text-emerald-500' : (isScrolled ? 'text-slate-700 dark:text-slate-200' : (location.pathname === '/' ? 'text-white' : 'text-slate-700 dark:text-slate-200'))}`}>Galeri</Link>

                            <div className="h-6 w-px bg-slate-300 dark:bg-slate-700 mx-2"></div>

                            <div className="flex items-center gap-3">
                                <button onClick={toggleDark} className={`p-2 transition-colors hover:text-emerald-500 ${isScrolled ? 'text-slate-700 dark:text-slate-200' : (location.pathname === '/' ? 'text-white' : 'text-slate-700 dark:text-slate-200')}`}>
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        {isDarkMode ? (
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                        ) : (
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                        )}
                                    </svg>
                                </button>
                                
                                {user ? (
                                    <Link to={`/${user.role}/dashboard`} className="flex items-center gap-2 text-sm font-medium hover:text-emerald-500">
                                        <div className="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center font-bold text-emerald-600">
                                            {user.name.charAt(0).toUpperCase()}
                                        </div>
                                    </Link>
                                ) : (
                                    <Link to="/login" className={`p-2 transition-colors hover:text-emerald-500 ${isScrolled ? 'text-slate-700 dark:text-slate-200' : (location.pathname === '/' ? 'text-white' : 'text-slate-700 dark:text-slate-200')}`}>
                                        <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </Link>
                                )}

                                <Link to="/ppdb" className="ml-2 px-6 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-bold rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5">
                                    Daftar PPDB
                                </Link>
                            </div>
                        </div>

                        {/* Mobile Menu Toggle */}
                        <div className="md:hidden flex items-center gap-3">
                            <button onClick={() => setMobileMenuOpen(!mobileMenuOpen)} className={`p-2 ${isScrolled ? 'text-slate-800 dark:text-white' : (location.pathname === '/' ? 'text-white' : 'text-slate-800 dark:text-white')}`}>
                                <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>

            {/* Mobile Dropdown Menu (Simple version for now) */}
            {mobileMenuOpen && (
                <div className="fixed inset-0 z-40 bg-white dark:bg-slate-900 pt-24 px-6 flex flex-col gap-6 text-lg font-semibold">
                    <Link to="/" onClick={() => setMobileMenuOpen(false)}>Beranda</Link>
                    <Link to="/profile" onClick={() => setMobileMenuOpen(false)}>Profil</Link>
                    <Link to="/program" onClick={() => setMobileMenuOpen(false)}>Program</Link>
                    <Link to="/gallery" onClick={() => setMobileMenuOpen(false)}>Galeri</Link>
                    <Link to="/ppdb" className="text-emerald-500" onClick={() => setMobileMenuOpen(false)}>Daftar PPDB</Link>
                    {user ? (
                        <Link to={`/${user.role}/dashboard`} onClick={() => setMobileMenuOpen(false)}>Dashboard Saya</Link>
                    ) : (
                        <Link to="/login" onClick={() => setMobileMenuOpen(false)}>Login</Link>
                    )}
                </div>
            )}

            {/* Main Content Area */}
            <main>
                <Outlet />
            </main>

            {/* Footer */}
            <footer className="bg-slate-50 dark:bg-black pt-16 pb-8 border-t border-slate-200 dark:border-slate-800">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                        {/* Brand */}
                        <div className="col-span-1 lg:col-span-1">
                            <div className="flex items-center gap-2 mb-6">
                                <span className="font-bold text-slate-800 dark:text-white text-xl">MI Nurul Huda 3</span>
                            </div>
                            <p className="text-slate-500 dark:text-slate-400 mb-6 leading-relaxed">
                                Membangun generasi cerdas berkarakter Islami. Sekolah dasar Islam terbaik untuk tumbuh kembang anak Anda.
                            </p>
                        </div>
                        {/* Links 1 */}
                        <div>
                            <h4 className="font-bold text-slate-800 dark:text-white mb-6">Tentang Kami</h4>
                            <ul className="space-y-4">
                                <li><Link to="/profile" className="text-slate-500 dark:text-slate-400 hover:text-emerald-500 transition-colors">Profil Sekolah</Link></li>
                                <li><Link to="/program" className="text-slate-500 dark:text-slate-400 hover:text-emerald-500 transition-colors">Program Unggulan</Link></li>
                            </ul>
                        </div>
                        {/* Links 2 */}
                        <div>
                            <h4 className="font-bold text-slate-800 dark:text-white mb-6">Informasi</h4>
                            <ul className="space-y-4">
                                <li><Link to="/ppdb" className="text-slate-500 dark:text-slate-400 hover:text-emerald-500 transition-colors">PPDB 2024</Link></li>
                                <li><Link to="/gallery" className="text-slate-500 dark:text-slate-400 hover:text-emerald-500 transition-colors">Galeri</Link></li>
                            </ul>
                        </div>
                        {/* Contact */}
                        <div>
                            <h4 className="font-bold text-slate-800 dark:text-white mb-6">Kontak</h4>
                            <ul className="space-y-4">
                                <li className="flex items-start gap-3">
                                    <span className="text-slate-500 dark:text-slate-400 text-sm">Jl. Raya Pendidikan No. 123, Kota Bandung, Jawa Barat</span>
                                </li>
                                <li className="flex items-center gap-3">
                                    <span className="text-slate-500 dark:text-slate-400 text-sm">+62 812-3456-7890</span>
                                </li>
                                <li className="flex items-center gap-3">
                                    <span className="text-slate-500 dark:text-slate-400 text-sm">info@minurulhuda3.sch.id</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div className="border-t border-slate-200 dark:border-slate-800 pt-8 text-center text-sm text-slate-400 dark:text-slate-500">
                        <p>© 2024 MI Nurul Huda 3. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    );
};

export default PublicLayout;
