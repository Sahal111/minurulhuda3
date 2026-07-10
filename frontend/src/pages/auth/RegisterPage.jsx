import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axios from 'axios';

const SCHOOL_BG = 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop';

const RegisterPage = () => {
    const navigate = useNavigate();
    const [formData, setFormData] = useState({
        name: '',
        no_wa: '',
        nama_siswa: '',
        kelas: '',
        email: '',
        password: '',
        password_confirmation: '',
        role: 'ortu',
    });
    const [showPassword, setShowPassword] = useState(false);
    const [errors, setErrors] = useState({});
    const [serverError, setServerError] = useState(null);
    const [isLoading, setIsLoading] = useState(false);

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
        // Clear field error on change
        if (errors[e.target.name]) {
            setErrors({ ...errors, [e.target.name]: null });
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setServerError(null);
        setErrors({});

        // Client-side validation
        const newErrors = {};
        if (formData.password !== formData.password_confirmation) {
            newErrors.password_confirmation = 'Konfirmasi password tidak cocok.';
        }
        if (formData.password.length < 8) {
            newErrors.password = 'Password minimal 8 karakter.';
        }
        if (Object.keys(newErrors).length > 0) {
            setErrors(newErrors);
            return;
        }

        setIsLoading(true);
        try {
            await axios.post('/api/register', formData, {
                withCredentials: true,
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            });
            // Redirect to login after successful registration
            navigate('/login', { state: { registered: true } });
        } catch (err) {
            if (err.response?.status === 422) {
                setErrors(err.response.data.errors || {});
            } else {
                setServerError(err.response?.data?.message || 'Pendaftaran gagal. Silakan coba lagi.');
            }
        } finally {
            setIsLoading(false);
        }
    };

    const InputField = ({ name, label, type = 'text', placeholder, icon, required = true, children }) => (
        <div className="space-y-1.5">
            <label className="text-xs font-bold text-slate-600 uppercase ml-1">{label}</label>
            <div className="relative group">
                <span className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors text-base pointer-events-none">
                    {icon}
                </span>
                {children || (
                    <input
                        name={name}
                        type={type}
                        required={required}
                        placeholder={placeholder}
                        value={formData[name]}
                        onChange={handleChange}
                        className={`w-full pl-11 pr-4 py-3 bg-white/60 border rounded-xl focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none transition-all text-sm text-slate-800 placeholder:text-slate-400 ${
                            errors[name] ? 'border-red-400 bg-red-50' : 'border-slate-200'
                        }`}
                    />
                )}
            </div>
            {errors[name] && (
                <p className="text-xs text-red-500 ml-1 flex items-center gap-1">
                    <span>⚠</span> {Array.isArray(errors[name]) ? errors[name][0] : errors[name]}
                </p>
            )}
        </div>
    );

    return (
        <div className="min-h-screen flex items-center justify-center relative overflow-x-hidden" style={{ minHeight: '100dvh' }}>
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

            <main className="w-full relative z-10 flex items-center justify-center p-4 sm:p-8 lg:p-12 min-h-screen py-12">
                <div className="max-w-6xl w-full grid lg:grid-cols-2 gap-8 items-center">

                    {/* Left Side - Branding */}
                    <div className="hidden lg:flex flex-col text-white space-y-6 pr-12">
                        <div className="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-white shadow-xl mb-4 p-4 text-5xl">
                            👤
                        </div>
                        <h1 className="text-5xl font-extrabold leading-tight">
                            Mulai Perjalanan <br />
                            <span className="text-emerald-400">Akademik Anda</span><br />
                            di MI Nurul Huda 3
                        </h1>
                        <p className="text-xl text-slate-200 font-light max-w-lg">
                            Daftarkan akun Anda untuk mengakses sistem pemantauan siswa dan manajemen kelas yang lebih modern.
                        </p>
                        <div className="pt-4">
                            <Link to="/" className="text-emerald-400 hover:text-emerald-300 text-sm font-medium flex items-center gap-1 w-fit transition-colors">
                                ← Kembali ke Halaman Utama
                            </Link>
                        </div>
                    </div>

                    {/* Right Side - Form Card */}
                    <div className="flex justify-center">
                        <div className="rounded-[2rem] p-6 md:p-10 w-full max-w-[550px] transition-all duration-300"
                            style={{
                                background: 'rgba(255,255,255,0.95)',
                                backdropFilter: 'blur(16px)',
                                border: '1px solid rgba(255,255,255,0.4)',
                                boxShadow: '0 25px 50px -12px rgba(0,0,0,0.25)',
                            }}>

                            {/* Mobile Header */}
                            <div className="text-center mb-6 lg:hidden">
                                <div className="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#0d3b23] shadow-md mb-3 text-3xl">
                                    🏫
                                </div>
                                <h1 className="text-xl font-bold text-[#0d3b23]">MI Nurul Huda 3</h1>
                                <Link to="/" className="text-emerald-500 hover:text-emerald-600 text-xs font-medium mt-2 inline-block">
                                    ← Kembali ke Beranda
                                </Link>
                            </div>

                            {/* Desktop Header */}
                            <div className="mb-6">
                                <h2 className="text-2xl font-bold text-[#0d3b23] mb-1">Buat Akun Baru</h2>
                                <p className="text-sm text-slate-500">Isi data berikut untuk mendaftar sebagai Orang Tua Siswa.</p>
                            </div>

                            {/* Server Error */}
                            {serverError && (
                                <div className="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm mb-5 flex items-start gap-2">
                                    <span className="mt-0.5">⚠️</span>
                                    <span>{serverError}</span>
                                </div>
                            )}

                            <form onSubmit={handleSubmit} className="space-y-4">
                                {/* Nama Wali & WhatsApp */}
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <InputField name="name" label="Nama Wali" placeholder="Nama Lengkap" icon="👤" />
                                    <InputField name="no_wa" label="WhatsApp" type="tel" placeholder="0812..." icon="💬" />
                                </div>

                                {/* Nama Siswa & Kelas */}
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <InputField name="nama_siswa" label="Nama Siswa" placeholder="Nama Anak" icon="🧒" />
                                    <div className="space-y-1.5">
                                        <label className="text-xs font-bold text-slate-600 uppercase ml-1">Kelas</label>
                                        <div className="relative group">
                                            <span className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-base pointer-events-none">🏫</span>
                                            <select
                                                name="kelas"
                                                required
                                                value={formData.kelas}
                                                onChange={handleChange}
                                                className={`w-full pl-11 pr-10 py-3 bg-white/60 border rounded-xl focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none transition-all text-sm appearance-none text-slate-800 ${
                                                    errors.kelas ? 'border-red-400 bg-red-50' : 'border-slate-200'
                                                }`}
                                            >
                                                <option value="" disabled>Pilih Kelas</option>
                                                {[1, 2, 3, 4, 5, 6].map(k => (
                                                    <option key={k} value={k}>Kelas {k}</option>
                                                ))}
                                            </select>
                                        </div>
                                        {errors.kelas && <p className="text-xs text-red-500 ml-1">⚠ {errors.kelas}</p>}
                                    </div>
                                </div>

                                {/* Email */}
                                <InputField name="email" label="Email" type="email" placeholder="email@anda.com" icon="✉️" />

                                {/* Password */}
                                <div className="space-y-1.5">
                                    <label className="text-xs font-bold text-slate-600 uppercase ml-1">Password</label>
                                    <div className="relative group">
                                        <span className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-base pointer-events-none">🔒</span>
                                        <input
                                            name="password"
                                            type={showPassword ? 'text' : 'password'}
                                            required
                                            placeholder="Minimal 8 karakter"
                                            value={formData.password}
                                            onChange={handleChange}
                                            className={`w-full pl-11 pr-12 py-3 bg-white/60 border rounded-xl focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none transition-all text-sm text-slate-800 placeholder:text-slate-400 ${
                                                errors.password ? 'border-red-400 bg-red-50' : 'border-slate-200'
                                            }`}
                                        />
                                        <button type="button" onClick={() => setShowPassword(!showPassword)}
                                            className="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                                            {showPassword ? '🙈' : '👁️'}
                                        </button>
                                    </div>
                                    {errors.password && <p className="text-xs text-red-500 ml-1">⚠ {Array.isArray(errors.password) ? errors.password[0] : errors.password}</p>}
                                </div>

                                {/* Konfirmasi Password */}
                                <div className="space-y-1.5">
                                    <label className="text-xs font-bold text-slate-600 uppercase ml-1">Konfirmasi Password</label>
                                    <div className="relative group">
                                        <span className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-base pointer-events-none">🔑</span>
                                        <input
                                            name="password_confirmation"
                                            type={showPassword ? 'text' : 'password'}
                                            required
                                            placeholder="Ulangi password"
                                            value={formData.password_confirmation}
                                            onChange={handleChange}
                                            className={`w-full pl-11 pr-4 py-3 bg-white/60 border rounded-xl focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none transition-all text-sm text-slate-800 placeholder:text-slate-400 ${
                                                errors.password_confirmation ? 'border-red-400 bg-red-50' : 'border-slate-200'
                                            }`}
                                        />
                                    </div>
                                    {errors.password_confirmation && <p className="text-xs text-red-500 ml-1">⚠ {errors.password_confirmation}</p>}
                                </div>

                                {/* Submit */}
                                <button
                                    type="submit"
                                    disabled={isLoading}
                                    className="w-full bg-[#0d3b23] hover:bg-black disabled:opacity-60 disabled:cursor-not-allowed text-white font-bold py-4 rounded-xl shadow-lg transition-all active:scale-[0.98] mt-2 flex items-center justify-center gap-2"
                                >
                                    {isLoading ? (
                                        <>
                                            <svg className="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                                <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                                                <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                            </svg>
                                            <span>Mendaftarkan...</span>
                                        </>
                                    ) : (
                                        'Daftar Sekarang'
                                    )}
                                </button>
                            </form>

                            {/* Link ke Login */}
                            <div className="mt-8 pt-6 border-t border-slate-200 text-center">
                                <p className="text-sm text-slate-500">
                                    Sudah memiliki akun?{' '}
                                    <Link to="/login" className="text-emerald-500 font-bold hover:underline ml-1">
                                        Masuk sekarang
                                    </Link>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    );
};

export default RegisterPage;
