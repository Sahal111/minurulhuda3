@extends('layouts.operator')
@section('content')
    <div class="space-y-8 max-w-5xl mx-auto w-full">

            <form id="settingsForm" class="space-y-8">
                <!-- Section 1: Identitas Sekolah -->
                <div
                    class="glass-card rounded-[2.5rem] shadow-xl overflow-hidden border border-slate-100 dark:border-slate-800">
                    <div class="p-8 border-b border-slate-50 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-800/20">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center">
                                <i data-lucide="school" class="w-5 h-5"></i>
                            </div>
                            <h3
                                class="font-lexend font-black text-lg text-slate-900 dark:text-white uppercase tracking-tight">
                                Identitas Sekolah</h3>
                        </div>
                    </div>

                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Logo Upload -->
                        <div class="md:col-span-2 flex flex-col md:flex-row items-center gap-8 mb-4">
                            <div class="relative group">
                                <div
                                    class="w-32 h-32 bg-slate-100 dark:bg-slate-800 rounded-[2rem] flex items-center justify-center border-4 border-white dark:border-slate-700 shadow-xl overflow-hidden">
                                    <img id="logoPreview" src="/assets/default-avatar.svg"
                                        class="w-full h-full object-cover">
                                </div>
                                <button type="button"
                                    class="absolute -bottom-2 -right-2 p-3 bg-emerald-600 text-white rounded-2xl shadow-lg hover:scale-110 transition-transform">
                                    <i data-lucide="camera" class="w-4 h-4"></i>
                                </button>
                            </div>
                            <div class="text-center md:text-left">
                                <h4 class="font-bold text-slate-900 dark:text-white">Logo Sekolah</h4>
                                <p class="text-xs text-slate-400 mt-1">Format PNG atau JPG. Maksimal 2MB.</p>
                                <button type="button"
                                    class="mt-3 text-[10px] font-black uppercase tracking-widest text-emerald-600 dark:text-emerald-400 hover:underline">Hapus
                                    Logo</button>
                            </div>
                        </div>

                        <!-- Fields -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama
                                Madrasah / Sekolah</label>
                            <input type="text" value="MI Nurul Huda 3"
                                class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 outline-none">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email
                                Sekolah</label>
                            <input type="email" value="info@minurulhuda3.sch.id"
                                class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 outline-none">
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat
                                Lengkap</label>
                            <textarea rows="3"
                                class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 outline-none resize-none">Jl. Pendidikan No. 123, Kelurahan Damai, Kecamatan Sejahtera, Kota Bogor, Jawa Barat</textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Kepala
                                Sekolah</label>
                            <input type="text" value="H. Muhammad Yusuf, M.Pd"
                                class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 outline-none">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">NIP
                                Kepala Sekolah</label>
                            <input type="text" value="19820512 201001 1 003"
                                class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Preferensi Sistem -->
                <div
                    class="glass-card rounded-[2.5rem] shadow-xl overflow-hidden border border-slate-100 dark:border-slate-800">
                    <div class="p-8 border-b border-slate-50 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-800/20">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-500 text-white rounded-xl flex items-center justify-center">
                                <i data-lucide="sliders" class="w-5 h-5"></i>
                            </div>
                            <h3
                                class="font-lexend font-black text-lg text-slate-900 dark:text-white uppercase tracking-tight">
                                Preferensi Sistem</h3>
                        </div>
                    </div>

                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Tahun
                                Ajaran Default</label>
                            <select
                                class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 outline-none cursor-pointer appearance-none">
                                <option>2024/2025</option>
                                <option selected>2025/2026</option>
                                <option>2026/2027</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Format
                                Rapor</label>
                            <select
                                class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 outline-none cursor-pointer appearance-none">
                                <option selected>Kurikulum Merdeka (Terbaru)</option>
                                <option>K-13 Revisi</option>
                                <option>K-13 Standard</option>
                            </select>
                        </div>

                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Tema
                                Warna Sistem</label>
                            <div class="flex flex-wrap gap-4">
                                <button type="button"
                                    class="w-10 h-10 rounded-full bg-emerald-600 border-4 border-white shadow-lg ring-2 ring-emerald-600/20"></button>
                                <button type="button"
                                    class="w-10 h-10 rounded-full bg-blue-600 border-2 border-transparent hover:scale-110 transition-transform"></button>
                                <button type="button"
                                    class="w-10 h-10 rounded-full bg-indigo-600 border-2 border-transparent hover:scale-110 transition-transform"></button>
                                <button type="button"
                                    class="w-10 h-10 rounded-full bg-rose-600 border-2 border-transparent hover:scale-110 transition-transform"></button>
                                <button type="button"
                                    class="w-10 h-10 rounded-full bg-slate-900 border-2 border-transparent hover:scale-110 transition-transform"></button>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Zona
                                Waktu (Timezone)</label>
                            <select
                                class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 outline-none cursor-pointer appearance-none">
                                <option selected>Asia/Jakarta (WIB)</option>
                                <option>Asia/Makassar (WITA)</option>
                                <option>Asia/Jayapura (WIT)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex items-center justify-end gap-4 pb-10">
                    <button type="button"
                        class="px-8 py-4 bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-slate-200 dark:border-slate-800 hover:bg-slate-50 transition-all">Batalkan</button>
                    <button type="submit"
                        class="px-10 py-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-emerald-600/30 hover:-translate-y-1 transition-all flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
                    </button>
                </div>
            </form>

    </div>
@endsection
