@extends('layouts.ppdb')
@section('content')
    <main class="flex-1 overflow-y-auto">
        <header class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center sticky top-0 z-10">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Dashboard PPDB</h2>
                <p class="text-sm text-slate-500">Gelombang I - Tahun Ajaran 2024/2025</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-semibold">Ust. Abdullah</p>
                    <p class="text-xs text-emerald-600">Administrator</p>
                </div>
                <div
                    class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center border-2 border-emerald-500">
                    <i data-lucide="user" class="w-6 h-6 text-emerald-600"></i>
                </div>
            </div>
        </header>

        <div class="p-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <div class="bg-white p-5 rounded-2xl shadow-lg border border-slate-100 relative overflow-hidden">
                    <div class="flex justify-between items-start mb-2">
                        <div class="p-2 bg-emerald-100 rounded-lg"><i data-lucide="users"
                                class="w-5 h-5 text-emerald-600"></i></div>
                        <span class="text-[10px] font-bold text-emerald-600">+12%</span>
                    </div>
                    <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Total Pendaftar</p>
                    <h3 class="text-2xl font-bold">1,284</h3>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-lg border border-slate-100 relative overflow-hidden">
                    <div class="flex justify-between items-start mb-2">
                        <div class="p-2 bg-blue-100 rounded-lg"><i data-lucide="user-plus"
                                class="w-5 h-5 text-blue-600"></i></div>
                        <span class="text-[10px] font-bold text-blue-600">Baru</span>
                    </div>
                    <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Pendaftar Hari Ini</p>
                    <h3 class="text-2xl font-bold">42</h3>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-lg border border-slate-100 relative overflow-hidden">
                    <div class="flex justify-between items-start mb-2">
                        <div class="p-2 bg-emerald-500 rounded-lg"><i data-lucide="check-circle"
                                class="w-5 h-5 text-white"></i></div>
                        <span class="text-[10px] font-bold text-emerald-600">75%</span>
                    </div>
                    <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Lulus Seleksi</p>
                    <h3 class="text-2xl font-bold">850</h3>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-lg border border-slate-100 relative overflow-hidden">
                    <div class="flex justify-between items-start mb-2">
                        <div class="p-2 bg-amber-100 rounded-lg"><i data-lucide="clock" class="w-5 h-5 text-amber-600"></i>
                        </div>
                        <span class="text-[10px] font-bold text-amber-600">Action Req.</span>
                    </div>
                    <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Pending Verifikasi</p>
                    <h3 class="text-2xl font-bold">112</h3>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-lg border border-slate-100 relative overflow-hidden">
                    <div class="flex justify-between items-start mb-2">
                        <div class="p-2 bg-emerald-50 rounded-lg"><i data-lucide="banknote"
                                class="w-5 h-5 text-emerald-700"></i></div>
                    </div>
                    <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Total Bayar (Jt)</p>
                    <h3 class="text-2xl font-bold">342.5</h3>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-lg border border-slate-100 relative overflow-hidden">
                    <div class="flex justify-between items-start mb-2">
                        <div class="p-2 bg-rose-100 rounded-lg"><i data-lucide="door-closed"
                                class="w-5 h-5 text-rose-600"></i></div>
                    </div>
                    <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Sisa Kuota</p>
                    <h3 class="text-2xl font-bold text-rose-600">28</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-lg border border-slate-100">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="font-bold text-lg">Tren Pendaftar Harian</h4>
                        <select class="text-xs bg-slate-100 border-none rounded-lg px-3 py-2 outline-none">
                            <option>7 Hari Terakhir</option>
                            <option>30 Hari Terakhir</option>
                        </select>
                    </div>
                    <div class="h-64 flex items-end gap-2 w-full pt-4">
                        <div
                            class="flex-1 bg-emerald-100 rounded-t-lg h-[40%] transition-all hover:bg-emerald-500 cursor-pointer">
                        </div>
                        <div
                            class="flex-1 bg-emerald-100 rounded-t-lg h-[60%] transition-all hover:bg-emerald-500 cursor-pointer">
                        </div>
                        <div
                            class="flex-1 bg-emerald-100 rounded-t-lg h-[45%] transition-all hover:bg-emerald-500 cursor-pointer">
                        </div>
                        <div
                            class="flex-1 bg-emerald-500 rounded-t-lg h-[85%] transition-all hover:bg-emerald-500 cursor-pointer">
                        </div>
                        <div
                            class="flex-1 bg-emerald-100 rounded-t-lg h-[55%] transition-all hover:bg-emerald-500 cursor-pointer">
                        </div>
                        <div
                            class="flex-1 bg-emerald-100 rounded-t-lg h-[70%] transition-all hover:bg-emerald-500 cursor-pointer">
                        </div>
                        <div
                            class="flex-1 bg-emerald-100 rounded-t-lg h-[95%] transition-all hover:bg-emerald-500 cursor-pointer">
                        </div>
                    </div>
                    <div class="flex justify-between mt-4 text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                        <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-emerald-600 p-6 rounded-2xl shadow-lg text-white">
                        <h4 class="font-bold mb-4">Aksi Cepat</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <button
                                class="flex flex-col items-center justify-center p-3 bg-white/10 hover:bg-white/20 rounded-xl transition-all border border-white/20">
                                <i data-lucide="user-plus" class="mb-2"></i>
                                <span class="text-xs">Tambah</span>
                            </button>
                            <button
                                class="flex flex-col items-center justify-center p-3 bg-white/10 hover:bg-white/20 rounded-xl transition-all border border-white/20">
                                <i data-lucide="file-spreadsheet" class="mb-2"></i>
                                <span class="text-xs">Excel</span>
                            </button>
                            <button
                                class="flex flex-col items-center justify-center p-3 bg-white/10 hover:bg-white/20 rounded-xl transition-all border border-white/20">
                                <i data-lucide="layers" class="mb-2"></i>
                                <span class="text-xs">Set Kuota</span>
                            </button>
                            <button
                                class="flex flex-col items-center justify-center p-3 bg-rose-500 hover:bg-rose-600 rounded-xl transition-all shadow-lg">
                                <i data-lucide="power" class="mb-2"></i>
                                <span class="text-xs">Tutup Pendaftaran</span>
                            </button>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100">
                        <h4 class="font-bold text-slate-800 mb-4">Realisasi Target</h4>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span>Target: 1,500 Siswa</span>
                                    <span class="font-bold">85%</span>
                                </div>
                                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-emerald-500 h-full w-[85%] rounded-full"></div>
                                </div>
                            </div>
                            <div class="bg-amber-50 p-3 rounded-xl border border-amber-100 flex items-center gap-3">
                                <i data-lucide="info" class="text-amber-600 w-5 h-5"></i>
                                <p class="text-[10px] text-amber-800 leading-tight">Kurang 216 pendaftar lagi untuk
                                    mencapai target tahunan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="font-bold text-lg text-slate-800">Distribusi Jalur Pendaftaran</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-3 h-12 bg-emerald-500 rounded-full"></div>
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Reguler</p>
                            <p class="text-xl font-bold">842</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-3 h-12 bg-blue-500 rounded-full"></div>
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Prestasi</p>
                            <p class="text-xl font-bold">215</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-3 h-12 bg-purple-500 rounded-full"></div>
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Yatim/Dhuafa</p>
                            <p class="text-xl font-bold">127</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-3 h-12 bg-amber-500 rounded-full"></div>
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Pindahan</p>
                            <p class="text-xl font-bold">100</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
