@extends('layouts.ppdb')

@section('content')
    <main class="flex-1 overflow-y-auto bg-[#F8FAFC] p-6 lg:p-12">
        <div class="max-w-5xl mx-auto">
            <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div>
                    <h2 class="text-4xl font-[1000] text-slate-900 tracking-tight">Settings</h2>
                    <p class="text-slate-500 font-medium mt-2 font-serif italic">Konfigurasi parameter sistem dan identitas
                        administrator.</p>
                </div>
                <div class="flex bg-white p-1.5 rounded-[1.5rem] shadow-sm border border-slate-200">
                    <button onclick="switchTab('system')" id="btn-system"
                        class="tab-btn active px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all duration-300">
                        Sistem PPDB
                    </button>
                    <button onclick="switchTab('account')" id="btn-account"
                        class="tab-btn px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-all duration-300">
                        Akun Admin
                    </button>
                </div>
            </header>

            <form id="settings-form" class="space-y-8">
                <div id="tab-system" class="tab-content space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <div class="bg-white p-10 rounded-[3rem] border border-slate-200/60 shadow-sm relative overflow-hidden">
                        <div class="flex items-center justify-between mb-10 pb-6 border-b border-slate-50">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                                    <i data-lucide="power" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest">Status
                                        Penerimaan</h3>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">Nyalakan untuk membuka
                                        formulir</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div
                                    class="w-16 h-8 bg-slate-200 rounded-full peer peer-checked:bg-emerald-500 transition-all duration-500 after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-7 after:transition-all peer-checked:after:translate-x-full peer-checked:shadow-lg peer-checked:shadow-emerald-100">
                                </div>
                            </label>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Kuota
                                    Per Kelas</label>
                                <div class="relative group">
                                    <i data-lucide="users"
                                        class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-300 group-focus-within:text-emerald-500 transition-colors"></i>
                                    <input type="number" value="32"
                                        class="w-full pl-14 pr-6 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] text-sm font-black focus:border-emerald-500 focus:bg-white transition-all outline-none">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Deadline
                                    Pendaftaran</label>
                                <div class="relative group">
                                    <i data-lucide="calendar"
                                        class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-300 group-focus-within:text-emerald-500 transition-colors"></i>
                                    <input type="date" value="2026-07-20"
                                        class="w-full pl-14 pr-6 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] text-sm font-black focus:border-emerald-500 focus:bg-white transition-all outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="mt-12 space-y-6">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Manajemen
                                Jalur Aktif</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                @foreach (['Reguler', 'Prestasi', 'Afiliasi', 'Beasiswa'] as $jalur)
                                    <div
                                        class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 flex items-center justify-between group hover:bg-white hover:border-emerald-500/20 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300">
                                        <span
                                            class="text-xs font-black text-slate-800 uppercase tracking-tight">{{ $jalur }}</span>
                                        <input type="checkbox" checked
                                            class="w-5 h-5 accent-emerald-500 rounded-lg cursor-pointer">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab-account"
                    class="tab-content hidden space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <div class="bg-white p-10 rounded-[3rem] border border-slate-200/60 shadow-sm">
                        <div class="flex flex-col md:flex-row items-center gap-12 mb-12">
                            <div class="relative group cursor-pointer">
                                <div
                                    class="w-40 h-40 rounded-[3rem] bg-slate-100 overflow-hidden border-4 border-white shadow-2xl relative">
                                    <img src="https://ui-avatars.com/api/?name=Admin+PPDB&background=020617&color=fff&size=200"
                                        class="w-full h-full object-cover">
                                    <div
                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all">
                                        <i data-lucide="camera" class="w-8 h-8 text-white"></i>
                                    </div>
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-12 h-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-xl border-4 border-white">
                                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                                </div>
                            </div>
                            <div class="text-center md:text-left">
                                <h3 class="text-3xl font-[1000] text-slate-900 tracking-tight">Administrator Utama</h3>
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Superadmin Access
                                    • Since 2024</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email
                                    Address</label>
                                <input type="email" value="admin@sekolah.sch.id"
                                    class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] text-sm font-black focus:border-emerald-500 focus:bg-white transition-all outline-none">
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Update
                                    Password</label>
                                <input type="password" placeholder="••••••••"
                                    class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] text-sm font-black focus:border-emerald-500 focus:bg-white transition-all outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between bg-white/50 backdrop-blur-md p-6 rounded-[2.5rem] border border-white shadow-xl shadow-slate-200/40">
                    <div class="flex items-center gap-4 text-slate-400 px-4">
                        <i data-lucide="info" class="w-5 h-5"></i>
                        <p class="text-[10px] font-bold uppercase tracking-widest">Semua perubahan bersifat permanen</p>
                    </div>
                    <div class="flex gap-3">
                        <button type="button"
                            class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] hover:text-slate-900 transition-all">Discard</button>
                        <button type="submit"
                            class="px-12 py-4 bg-slate-900 text-white rounded-[1.5rem] text-[10px] font-black uppercase tracking-[0.3em] hover:bg-emerald-600 hover:shadow-2xl hover:shadow-emerald-100 transition-all active:scale-95 duration-500">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <style>
        .tab-btn.active {
            background-color: #0F172A;
            color: white;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.1);
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    @push('scripts')
        <script src="/js/admin-ppdb/setting.js"></script>
    @endpush
@endsection
