@extends('layouts.guru')

@section('content')
    <main class="flex-1 p-4 lg:p-8 custom-scrollbar overflow-y-auto h-screen bg-[#f8fafc]">

        <div class="mb-10">
            <div class="flex items-center gap-2 text-slate-400 font-bold text-[10px] uppercase tracking-[0.2em] mb-2">
                <i data-lucide="settings" class="w-4 h-4"></i>
                User Preferences
            </div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Pengaturan Profil</h2>
        </div>

        <div class="grid grid-cols-12 gap-8">

            <div class="col-span-12 lg:col-span-3 space-y-6">
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm text-center">
                    <div class="relative inline-block mb-4">
                        <img src="https://ui-avatars.com/api/?name=Guru+Hebat&background=0f172a&color=fff&size=128"
                            class="w-32 h-32 rounded-[2.5rem] object-cover border-4 border-slate-50 shadow-lg"
                            alt="Profile">
                        <button
                            class="absolute -bottom-2 -right-2 w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center shadow-lg border-4 border-white hover:scale-110 transition-transform">
                            <i data-lucide="camera" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <h3 class="font-black text-slate-800 text-lg">Nama Guru Anda, S.Pd</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">NIP. 19920510201802</p>
                </div>

                <nav class="bg-white p-4 rounded-[2rem] border border-slate-100 shadow-sm hidden lg:block">
                    <ul class="space-y-2">
                        <li><a href="#personal"
                                class="flex items-center gap-3 px-4 py-3 bg-slate-900 text-white rounded-xl text-xs font-black shadow-lg shadow-slate-200"><i
                                    data-lucide="user" class="w-4 h-4"></i> Profil Personal</a></li>
                        <li><a href="#account"
                                class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-50 hover:text-slate-900 rounded-xl text-xs font-black transition-all"><i
                                    data-lucide="shield-check" class="w-4 h-4"></i> Keamanan Akun</a></li>
                        <li><a href="#notif"
                                class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-50 hover:text-slate-900 rounded-xl text-xs font-black transition-all"><i
                                    data-lucide="bell" class="w-4 h-4"></i> Notifikasi</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-span-12 lg:col-span-9 space-y-8">

                <div id="personal" class="bg-white p-8 lg:p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-8 flex items-center gap-3">
                        <span class="w-8 h-1 bg-emerald-500 rounded-full"></span>
                        Informasi Personal
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Nama Lengkap & Gelar</label>
                            <input type="text" value="Nama Guru Anda, S.Pd"
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:bg-white focus:border-emerald-500 transition-all font-bold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Email Instansi</label>
                            <input type="email" value="guru@sekolah.sch.id"
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:bg-white focus:border-emerald-500 transition-all font-bold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Mata Pelajaran Utama</label>
                            <input type="text" value="Matematika"
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:bg-white focus:border-emerald-500 transition-all font-bold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Nomor Telepon</label>
                            <input type="text" value="+62 812 3456 7890"
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:bg-white focus:border-emerald-500 transition-all font-bold text-slate-700">
                        </div>
                    </div>
                </div>

                <div id="account" class="bg-white p-8 lg:p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-8 flex items-center gap-3">
                        <span class="w-8 h-1 bg-rose-500 rounded-full"></span>
                        Pengaturan Akun
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Username</label>
                            <input type="text" value="guru_hebat2026" disabled
                                class="w-full px-6 py-4 bg-slate-100 border border-slate-200 rounded-2xl font-bold text-slate-400 cursor-not-allowed">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Password Baru</label>
                            <input type="password" placeholder="••••••••"
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-4 focus:ring-rose-500/10 focus:bg-white focus:border-rose-500 transition-all font-bold text-slate-700">
                        </div>
                    </div>
                </div>

                <div class="hidden lg:flex justify-end pt-4">
                    <button onclick="openModal()"
                        class="px-12 py-5 bg-slate-900 text-white rounded-[2rem] font-black text-sm hover:bg-emerald-600 transition-all shadow-xl shadow-slate-200">
                        SIMPAN PERUBAHAN
                    </button>
                </div>
            </div>
        </div>

        <div
            class="lg:hidden fixed bottom-0 left-0 right-0 p-4 bg-white/90 backdrop-blur-md border-t border-slate-100 z-50">
            <button onclick="openModal()"
                class="w-full bg-slate-900 text-white py-4 rounded-2xl font-black text-sm shadow-xl">
                SIMPAN PERUBAHAN
            </button>
        </div>

        <div id="modalConfirm"
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
            <div class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl scale-95 transition-all">
                <div
                    class="w-20 h-20 bg-emerald-50 text-emerald-500 rounded-[1.5rem] flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="help-circle" class="w-10 h-10"></i>
                </div>
                <h3 class="text-xl font-black text-slate-900 text-center mb-2">Simpan Perubahan?</h3>
                <p class="text-center text-slate-500 text-sm font-medium mb-8">Pastikan data yang Anda masukkan sudah benar
                    sebelum memperbarui sistem.</p>

                <div class="grid grid-cols-2 gap-4">
                    <button onclick="closeModal()"
                        class="py-4 bg-slate-50 text-slate-400 rounded-2xl font-black text-xs hover:bg-slate-100 transition-all">BATAL</button>
                    <button onclick="handleSave()"
                        class="py-4 bg-emerald-600 text-white rounded-2xl font-black text-xs shadow-lg shadow-emerald-200 hover:bg-emerald-700 transition-all">YA,
                        SIMPAN</button>
                </div>
            </div>
        </div>

    </main>

    @push('scripts')
        <script src="/js/guru/setting.js"></script>
    @endpush
@endsection
