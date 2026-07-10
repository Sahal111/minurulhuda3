@extends('layouts.ppdb')

@section('content')
    <main class="flex-1 overflow-y-auto bg-[#F8FAFC]">
        <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-xl border-b border-slate-200/60 px-8 py-4">
            <div class="max-w-[1400px] mx-auto flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                        <i data-lucide="user-plus" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-[900] text-slate-900 tracking-tight">Tambah Pendaftar Baru</h2>
                        <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                            Sesi Aktif: Gelombang 1
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button"
                        class="px-6 py-3 rounded-2xl text-sm font-bold text-slate-500 hover:bg-slate-100 transition-all">
                        Batal
                    </button>
                    <button type="submit" form="main-form"
                        class="px-8 py-3 rounded-2xl bg-slate-900 text-white text-sm font-bold hover:bg-emerald-600 transition-all shadow-xl shadow-slate-200 flex items-center gap-2 group">
                        Simpan Data
                        <i data-lucide="chevron-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            </div>
        </header>

        <div class="max-w-[1400px] mx-auto p-8">
            <form id="main-form" action="#" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-12 gap-8">
                @csrf

                <div class="col-span-12 lg:col-span-8 space-y-8">

                    <div
                        class="bg-white rounded-[2.5rem] p-8 md:p-10 shadow-sm border border-slate-200/60 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-8">
                            <span class="text-6xl font-black text-slate-50/80 select-none">01</span>
                        </div>

                        <div class="relative z-10">
                            <h3
                                class="text-lg font-black text-slate-800 uppercase tracking-tighter mb-8 flex items-center gap-3">
                                <span class="w-8 h-[2px] bg-emerald-500"></span>
                                Identitas Peserta Didik
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="md:col-span-2 group">
                                    <label
                                        class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 ml-1">Nama
                                        Lengkap (Sesuai Akta)</label>
                                    <input type="text" name="nama" required
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 outline-none transition-all font-bold text-slate-700 placeholder:text-slate-300"
                                        placeholder="Contoh: Ahmad Dhani">
                                </div>

                                <div class="group">
                                    <label
                                        class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 ml-1">NIK
                                        (Nomor Induk Kependudukan)</label>
                                    <input type="number" name="nik" required
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-emerald-500 outline-none transition-all font-bold text-slate-700"
                                        placeholder="16 Digit NIK">
                                </div>

                                <div class="group">
                                    <label
                                        class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 ml-1">Jalur
                                        Pendaftaran</label>
                                    <div class="relative">
                                        <select name="jalur"
                                            class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-emerald-500 outline-none transition-all font-bold text-slate-700 appearance-none">
                                            <option>Reguler</option>
                                            <option>Prestasi</option>
                                            <option>Yatim/Dhuafa</option>
                                        </select>
                                        <i data-lucide="chevron-down"
                                            class="absolute right-6 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                                    </div>
                                </div>

                                <div class="group">
                                    <label
                                        class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 ml-1">Tempat
                                        Lahir</label>
                                    <input type="text" name="tempat_lahir"
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-emerald-500 outline-none transition-all font-bold text-slate-700"
                                        placeholder="Kota Kelahiran">
                                </div>

                                <div class="group">
                                    <label
                                        class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 ml-1">Tanggal
                                        Lahir</label>
                                    <input type="date" name="tanggal_lahir"
                                        class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-emerald-500 outline-none transition-all font-bold text-slate-700">
                                </div>

                                <div class="md:col-span-2">
                                    <label
                                        class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-4 ml-1">Jenis
                                        Kelamin</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <label class="cursor-pointer">
                                            <input type="radio" name="jk" value="L" class="peer hidden" checked>
                                            <div
                                                class="p-4 border-2 border-slate-100 rounded-2xl flex items-center justify-center gap-3 font-bold text-slate-400 peer-checked:border-emerald-600 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 transition-all hover:bg-slate-50">
                                                <i data-lucide="user" class="w-4 h-4"></i> Laki-laki
                                            </div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input type="radio" name="jk" value="P" class="peer hidden">
                                            <div
                                                class="p-4 border-2 border-slate-100 rounded-2xl flex items-center justify-center gap-3 font-bold text-slate-400 peer-checked:border-emerald-600 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 transition-all hover:bg-slate-50">
                                                <i data-lucide="user" class="w-4 h-4 rotate-180"></i> Perempuan
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-[2.5rem] p-8 md:p-10 shadow-sm border border-slate-200/60 relative overflow-hidden">
                        <h3
                            class="text-lg font-black text-slate-800 uppercase tracking-tighter mb-8 flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-emerald-500"></span>
                            Data Wali & Asal Sekolah
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="md:col-span-2 group">
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 ml-1">Nama
                                    Orang Tua / Wali</label>
                                <input type="text" name="nama_ortu"
                                    class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-emerald-500 outline-none transition-all font-bold text-slate-700"
                                    placeholder="Nama Lengkap Wali">
                            </div>

                            <div class="group">
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 ml-1">No.
                                    HP (WhatsApp Aktif)</label>
                                <div class="relative">
                                    <span
                                        class="absolute left-6 top-1/2 -translate-y-1/2 font-bold text-slate-400">+62</span>
                                    <input type="tel" name="no_hp"
                                        class="w-full pl-16 pr-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-emerald-500 outline-none transition-all font-bold text-slate-700"
                                        placeholder="8123456xxx">
                                </div>
                            </div>

                            <div class="group">
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 ml-1">Email</label>
                                <input type="email" name="email"
                                    class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-emerald-500 outline-none transition-all font-bold text-slate-700"
                                    placeholder="alamat@email.com">
                            </div>

                            <div class="md:col-span-2 group">
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 ml-1">Asal
                                    Sekolah (TK/RA)</label>
                                <input type="text" name="asal_sekolah"
                                    class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-emerald-500 outline-none transition-all font-bold text-slate-700"
                                    placeholder="Contoh: TK Nurul Huda 1">
                            </div>

                            <div class="md:col-span-2 group">
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 ml-1">Alamat
                                    Tinggal Lengkap</label>
                                <textarea name="alamat" rows="3"
                                    class="w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-emerald-500 outline-none transition-all font-bold text-slate-700 resize-none"
                                    placeholder="Nama Jalan, RT/RW, Kec, Kab..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 space-y-8">
                    <div
                        class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-2xl shadow-emerald-200/20 relative overflow-hidden sticky top-32">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-500 opacity-20 blur-[60px]"></div>

                        <h3
                            class="text-lg font-black uppercase tracking-tighter mb-8 flex items-center gap-3 relative z-10">
                            <i data-lucide="folder-up" class="w-5 h-5 text-emerald-400"></i>
                            Berkas Digital
                        </h3>

                        <div class="space-y-6 relative z-10">
                            <div class="group">
                                <p class="text-[9px] font-black text-emerald-400 uppercase tracking-[0.2em] mb-3 ml-1">Pas
                                    Foto 3x4 (Wajib)</p>
                                <label for="foto"
                                    class="relative flex flex-col items-center justify-center w-full h-48 bg-white/5 border-2 border-dashed border-white/20 rounded-3xl hover:border-emerald-400 hover:bg-white/10 transition-all cursor-pointer overflow-hidden group/item">
                                    <div id="preview-container-foto" class="absolute inset-0 hidden">
                                        <img id="preview-foto" class="w-full h-full object-cover">
                                        <div
                                            class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover/item:opacity-100 transition-opacity">
                                            <p class="text-xs font-bold text-white uppercase">Ganti Foto</p>
                                        </div>
                                    </div>
                                    <div id="placeholder-foto" class="flex flex-col items-center">
                                        <i data-lucide="camera"
                                            class="w-8 h-8 text-white/30 mb-2 group-hover/item:scale-110 group-hover/item:text-emerald-400 transition-all"></i>
                                        <span class="text-[10px] font-bold text-white/40 uppercase">Pilih File</span>
                                    </div>
                                    <input type="file" id="foto" name="foto" class="hidden" accept="image/*"
                                        onchange="previewImage(this, 'foto')">
                                </label>
                            </div>

                            <div class="space-y-3">
                                <label for="kk"
                                    class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-emerald-400 transition-all cursor-pointer group/card">
                                    <div
                                        class="w-10 h-10 bg-emerald-500/20 rounded-xl flex items-center justify-center text-emerald-400 group-hover/card:bg-emerald-500 group-hover/card:text-white transition-all">
                                        <i data-lucide="file-text" class="w-5 h-5"></i>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-xs font-black uppercase tracking-tight">Kartu Keluarga</p>
                                        <p id="label-kk" class="text-[10px] text-white/40 truncate italic font-medium">
                                            Belum dipilih</p>
                                    </div>
                                    <input type="file" id="kk" name="kk" class="hidden"
                                        onchange="updateFileName(this, 'label-kk')">
                                </label>

                                <label for="akta"
                                    class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-emerald-400 transition-all cursor-pointer group/card">
                                    <div
                                        class="w-10 h-10 bg-emerald-500/20 rounded-xl flex items-center justify-center text-emerald-400 group-hover/card:bg-emerald-500 group-hover/card:text-white transition-all">
                                        <i data-lucide="scroll" class="w-5 h-5"></i>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-xs font-black uppercase tracking-tight">Akta Lahir</p>
                                        <p id="label-akta" class="text-[10px] text-white/40 truncate italic font-medium">
                                            Belum dipilih</p>
                                    </div>
                                    <input type="file" id="akta" name="akta" class="hidden"
                                        onchange="updateFileName(this, 'label-akta')">
                                </label>

                                <label for="raport"
                                    class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-emerald-400 transition-all cursor-pointer group/card">
                                    <div
                                        class="w-10 h-10 bg-emerald-500/20 rounded-xl flex items-center justify-center text-emerald-400 group-hover/card:bg-emerald-500 group-hover/card:text-white transition-all">
                                        <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-xs font-black uppercase tracking-tight">Ijazah / Raport</p>
                                        <p id="label-raport"
                                            class="text-[10px] text-white/40 truncate italic font-medium">Belum dipilih</p>
                                    </div>
                                    <input type="file" id="raport" name="raport" class="hidden"
                                        onchange="updateFileName(this, 'label-raport')">
                                </label>
                            </div>
                        </div>

                        <div class="mt-8 pt-8 border-t border-white/10 flex gap-4">
                            <i data-lucide="info" class="w-5 h-5 text-emerald-400 shrink-0"></i>
                            <p class="text-[10px] text-white/40 leading-relaxed italic">Pastikan seluruh berkas memiliki
                                resolusi tinggi dan tidak buram saat diunggah.</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    @push('scripts')
        <script src="/js/admin-ppdb/tambah-pendaftar.js"></script>
    @endpush
@endsection
