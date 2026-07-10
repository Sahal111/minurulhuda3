import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../../hooks/useAuth';

const SCHOOL_BG = 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop';

const LoginPage = () => {
    const [credentials, setCredentials] = useState({ email: '', password: '', role: 'guru' });
    const [showPassword, setShowPassword] = useState(false);
    const [error, setError] = useState(null);
    const [isLoading, setIsLoading] = useState(false);
    const { login } = useAuth();
    const navigate = useNavigate();

    const handleChange = (e) => {
        setCredentials({ ...credentials, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError(null);
        setIsLoading(true);
        try {
            const data = await login(credentials);
            if (data.user) {
                const role = data.user.role;
                navigate(`/${role}/dashboard`);
            }
        } catch (err) {
            setError(err.response?.data?.message || 'Login gagal. Periksa email dan password Anda.');
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <div className="min-h-screen flex items-center justify-center relative overflow-hidden" style={{ minHeight: '100dvh' }}>
            {/* Background */}
            <div
                className="absolute inset-0 z-0"
                style={{
                    backgroundImage: `url(${SCHOOL_BG})`,
                    backgroundSize: 'cover',
                    backgroundPosition: 'center',
                }}
            />
            {/* Overlay */}
            <div className="absolute inset-0 z-0" style={{ background: 'linear-gradient(135deg, rgba(13,59,35,0.92) 0%, rgba(13,59,35,0.80) 100%)', backdropFilter: 'blur(8px)' }} />

            <main className="w-full relative z-10 flex items-center justify-center p-4 sm:p-8 lg:p-12 min-h-screen">
                <div className="max-w-6xl w-full grid lg:grid-cols-2 gap-8 items-center">

                    {/* Left Side - Branding (desktop only) */}
                    <div className="hidden lg:flex flex-col text-white space-y-6 pr-12">
                        <div className="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-white shadow-xl mb-4 p-4">
                            <span className="text-5xl">🏫</span>
                        </div>
                        <h1 className="text-5xl font-extrabold leading-tight">
                            Selamat Datang di <br />
                            <span className="text-emerald-400">Portal Akademik</span><br />
                            MI Nurul Huda 3
                        </h1>
                        <p className="text-xl text-slate-200 font-light max-w-lg">
                            Akses layanan pendidikan modern, terintegrasi, dan mudah untuk mewujudkan generasi islami yang unggul dan kompetitif.
                        </p>
                        <div className="flex gap-4 pt-4">
                            <div className="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full border border-white/20">
                                <span className="text-emerald-400">✓</span>
                                <span className="text-sm font-medium">Terakreditasi A</span>
                            </div>
                            <div className="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full border border-white/20">
                                <span className="text-yellow-400">★</span>
                                <span className="text-sm font-medium">Unggulan</span>
                            </div>
                        </div>
                        <div className="pt-4">
                            <Link to="/" className="text-emerald-400 hover:text-emerald-300 text-sm font-medium flex items-center gap-1 w-fit transition-colors">
                                ← Kembali ke Halaman Utama
                            </Link>
                        </div>
                    </div>

                    {/* Right Side - Form Card */}
                    <div className="flex justify-center">
                        <div className="rounded-[2rem] p-8 md:p-12 lg:p-14 w-full max-w-[500px] transition-all duration-300"
                            style={{
                                background: 'rgba(255,255,255,0.95)',
                                backdropFilter: 'blur(16px)',
                                border: '1px solid rgba(255,255,255,0.4)',
                                boxShadow: '0 25px 50px -12px rgba(0,0,0,0.25)',
                            }}>

                            {/* Mobile Header */}
                            <div className="text-center mb-8 lg:hidden">
                                <div className="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#0d3b23] shadow-md mb-4 text-4xl">
                                    🏫
                                </div>
                                <h1 className="text-2xl font-bold text-[#0d3b23]">MI Nurul Huda 3</h1>
                                <p className="text-sm text-slate-500 mt-1">Portal Akademik Madrasah</p>
                                <Link to="/" className="text-emerald-500 hover:text-emerald-600 text-xs font-medium mt-2 inline-block">
                                    ← Kembali ke Beranda
                                </Link>
                            </div>

                            {/* Desktop Header */}
                            <div className="hidden lg:block mb-10">
                                <h2 className="text-3xl font-bold text-[#0d3b23] mb-2">Masuk ke Portal</h2>
                                <p className="text-slate-500">Silakan masukkan detail akun Anda</p>
                            </div>

                            <form onSubmit={handleSubmit} className="space-y-5">
                                {/* Error Message */}
                                {error && (
                                    <div className="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm flex items-start gap-2">
                                        <span className="text-red-500 mt-0.5">⚠️</span>
                                        <span>{error}</span>
                                    </div>
                                )}

                                {/* Role Selector */}
                                <div className="bg-slate-100 p-1.5 rounded-xl flex">
                                    {[
                                        { value: 'guru', label: 'Guru', icon: '🎓' },
                                        { value: 'ortu', label: 'Orang Tua', icon: '👨‍👩‍👧' },
                                    ].map(r => (
                                        <button
                                            key={r.value}
                                            type="button"
                                            onClick={() => setCredentials({ ...credentials, role: r.value })}
                                            className={`flex-1 py-2.5 text-sm font-semibold rounded-lg flex items-center justify-center gap-2 transition-all duration-200 ${
                                                credentials.role === r.value
                                                    ? 'bg-white text-[#0d3b23] shadow-md'
                                                    : 'text-slate-500 hover:text-slate-700'
                                            }`}
                                        >
                                            <span>{r.icon}</span>
                                            <span>{r.label}</span>
                                        </button>
                                    ))}
                                </div>

                                {/* Email */}
                                <div className="relative group">
                                    <div className="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                        ✉️
                                    </div>
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        required
                                        placeholder="Alamat Email"
                                        value={credentials.email}
                                        onChange={handleChange}
                                        className="block w-full pl-12 pr-4 py-3.5 text-sm bg-white/50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none transition-all text-slate-800 placeholder:text-slate-400"
                                    />
                                </div>

                                {/* Password */}
                                <div className="relative group">
                                    <div className="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                        🔒
                                    </div>
                                    <input
                                        id="password"
                                        name="password"
                                        type={showPassword ? 'text' : 'password'}
                                        required
                                        placeholder="Kata Sandi"
                                        value={credentials.password}
                                        onChange={handleChange}
                                        className="block w-full pl-12 pr-12 py-3.5 text-sm bg-white/50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none transition-all text-slate-800 placeholder:text-slate-400"
                                    />
                                    <button
                                        type="button"
                                        onClick={() => setShowPassword(!showPassword)}
                                        className="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors"
                                    >
                                        {showPassword ? '🙈' : '👁️'}
                                    </button>
                                </div>

                                {/* Submit Button */}
                                <div className="pt-1 flex flex-col gap-3">
                                    <button
                                        type="submit"
                                        disabled={isLoading}
                                        className="w-full bg-emerald-500 hover:bg-emerald-600 disabled:opacity-60 disabled:cursor-not-allowed text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-500/30 active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2"
                                    >
                                        {isLoading ? (
                                            <>
                                                <svg className="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                                    <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                                                    <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                                </svg>
                                                <span>Sedang Masuk...</span>
                                            </>
                                        ) : (
                                            <>
                                                <span>Masuk Sekarang</span>
                                                <span>→</span>
                                            </>
                                        )}
                                    </button>

                                    <Link
                                        to="/register"
                                        className="w-full border border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white font-bold py-3 rounded-xl transition-all duration-300 text-center text-sm"
                                    >
                                        Daftar Akun Baru
                                    </Link>
                                </div>
                            </form>

                            <div className="text-center mt-8 pt-6 border-t border-slate-100">
                                <p className="text-xs text-slate-400">© 2024 MI Nurul Huda 3. Sistem Informasi Akademik.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    );
};

export default LoginPage;
