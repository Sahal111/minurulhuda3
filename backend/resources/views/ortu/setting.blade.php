@extends('layouts.ortu')

@section('content')
    <main class="flex-1 lg:ml-72 p-4 lg:p-10 bg-slate-50/50">

        <div class="max-w-5xl mx-auto">
            <div class="mb-8">
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Profil & Pengaturan</h2>
                <p class="text-slate-500 text-sm italic">Kelola data ananda dan privasi akun Anda dalam satu tempat.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-1 space-y-6">
                    <div
                        class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative group">
                        <div class="h-32 bg-gradient-to-br from-emerald-500 to-teal-600 relative">
                            <div class="absolute inset-0 opacity-10"
                                style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');">
                            </div>
                        </div>

                        <div class="px-6 pb-8 flex flex-col items-center">
                            <div class="relative -mt-16 mb-4">
                                <div class="w-32 h-32 rounded-[2rem] bg-white p-2 shadow-xl">
                                    <img src="https://ui-avatars.com/api/?name=Ahmad+Zaki&background=059669&color=fff&size=128"
                                        alt="Foto Siswa" class="w-full h-full rounded-[1.5rem] object-cover">
                                </div>
                                <div
                                    class="absolute bottom-2 right-2 w-6 h-6 bg-emerald-500 border-4 border-white rounded-full">
                                </div>
                            </div>

                            <h3 class="text-xl font-black text-slate-800 text-center uppercase tracking-tight">Ahmad Zaki
                                Al-Fatih</h3>
                            <p class="text-emerald-600 font-bold text-sm mb-6 uppercase tracking-[0.2em]">Kelas 4-A</p>

                            <div class="w-full grid grid-cols-2 gap-4">
                                <div class="bg-slate-50 p-4 rounded-2xl text-center">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Kehadiran
                                    </p>
                                    <p class="text-lg font-black text-slate-800">98%</p>
                                </div>
                                <div class="bg-slate-50 p-4 rounded-2xl text-center">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Poin Saku
                                    </p>
                                    <p class="text-lg font-black text-emerald-600">120</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-900 rounded-[2rem] p-6 text-white shadow-xl shadow-slate-300">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Wali Kelas</p>
                        <div class="flex items-center gap-4">
                            <img src="https://ui-avatars.com/api/?name=Ibu+Siti&background=fff&color=000"
                                class="w-12 h-12 rounded-xl" />
                            <div>
                                <p class="font-bold">Ibu Siti Aminah, S.Pd</p>
                                <button
                                    class="text-emerald-400 text-xs font-medium hover:underline flex items-center gap-1 mt-1">
                                    <i data-lucide="phone" class="w-3 h-3"></i> +62 812-3456-7890
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-8">

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 p-8 md:p-10">
                        <div class="flex items-center justify-between mb-10">
                            <h4 class="text-xl font-black text-slate-800 flex items-center gap-3">
                                <i data-lucide="user-check" class="text-emerald-500"></i>
                                Informasi Personal
                            </h4>
                            <span
                                class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase rounded-lg">Data
                                Aktif</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">NIS</p>
                                <p class="text-slate-700 font-bold border-b border-slate-100 pb-2 tracking-widest text-lg">
                                    2021040012</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">HP Orang Tua</p>
                                <p class="text-slate-700 font-bold border-b border-slate-100 pb-2 text-lg">+62 857-9900-1122
                                </p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">TTL</p>
                                <p class="text-slate-700 font-bold border-b border-slate-100 pb-2 text-lg">Bogor, 12 Mei
                                    2014</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Jenis Kelamin
                                </p>
                                <p class="text-slate-700 font-bold border-b border-slate-100 pb-2 text-lg">Laki-laki</p>
                            </div>
                            <div class="md:col-span-2 space-y-1">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Alamat Lengkap
                                </p>
                                <p class="text-slate-700 font-bold border-b border-slate-100 pb-2 text-lg">Jl. Raya Kebon
                                    Pedes No. 45, RT 02/RW 05, Tanah Sareal, Kota Bogor.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden">
                        <div class="p-8 md:p-10">
                            <h4 class="text-xl font-black text-slate-800 flex items-center gap-3 mb-10">
                                <i data-lucide="settings" class="text-emerald-500"></i>
                                Pengaturan Akun
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                                <div class="space-y-6">
                                    <div>
                                        <h5 class="font-bold text-slate-700 mb-1">Keamanan Akun</h5>
                                        <p class="text-xs text-slate-400 italic">Perbarui kata sandi panel orang tua Anda.
                                        </p>
                                    </div>
                                    <div class="space-y-4">
                                        <input type="password"
                                            class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all outline-none text-sm"
                                            placeholder="Password Saat Ini">
                                        <input type="password"
                                            class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all outline-none text-sm"
                                            placeholder="Password Baru">
                                    </div>
                                </div>

                                <div class="space-y-6">
                                    <div>
                                        <h5 class="font-bold text-slate-700 mb-1">Notifikasi</h5>
                                        <p class="text-xs text-slate-400 italic">Metode pengiriman laporan sekolah.</p>
                                    </div>
                                    <div class="space-y-3">
                                        <div
                                            class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                            <span
                                                class="text-xs font-bold text-slate-600 uppercase tracking-tighter">WhatsApp
                                                Blast</span>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" checked class="sr-only peer">
                                                <div
                                                    class="w-10 h-5 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-emerald-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all">
                                                </div>
                                            </label>
                                        </div>
                                        <div
                                            class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                            <span class="text-xs font-bold text-slate-600 uppercase tracking-tighter">Email
                                                Laporan</span>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" class="sr-only peer">
                                                <div
                                                    class="w-10 h-5 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-emerald-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all">
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-8 py-5 bg-rose-50/50 border-t border-rose-100 flex items-center justify-between">
                            <span class="text-[10px] font-black text-rose-600 uppercase tracking-[0.2em]">Privasi
                                Keamanan</span>
                            <button
                                class="text-[10px] font-black text-rose-600 hover:underline uppercase tracking-widest">Logout
                                Semua Perangkat</button>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <button
                            class="px-8 py-4 bg-white border border-slate-200 text-slate-600 rounded-2xl text-sm font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</button>
                        <button
                            class="px-8 py-4 bg-emerald-600 text-white rounded-2xl text-sm font-black uppercase tracking-widest hover:bg-emerald-700 shadow-xl shadow-emerald-200 transition-all">Simpan
                            Data</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
