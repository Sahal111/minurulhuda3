@extends('layouts.ppdb')

@section('content')
    <main class="flex-1 overflow-y-auto bg-[#F8FAFC]">
        <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200 px-8 py-5 sticky top-0 z-40">
            <div class="max-w-[1400px] mx-auto flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <a href="{{ route('adminPpdb.verifikasiBerkas') }}"
                        class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-slate-50 transition-all">
                        <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    </a>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span
                                class="px-2 py-0.5 bg-amber-100 text-amber-700 text-[9px] font-black uppercase rounded">Menunggu
                                Verifikasi</span>
                            <span class="text-slate-300 text-xs">/</span>
                            <span class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">Reg-ID:
                                NH3-2024001</span>
                        </div>
                        <h2 class="text-xl font-[1000] text-slate-900 tracking-tight">Verifikasi Berkas: Muhammad Akhdan
                        </h2>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button
                        class="px-6 py-2.5 rounded-xl bg-rose-50 text-rose-600 text-sm font-bold hover:bg-rose-100 transition-all">Tolak
                        Semua</button>
                    <button
                        class="px-8 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-100 transition-all">Setujui
                        Semua</button>
                </div>
            </div>
        </header>

        <div class="max-w-[1400px] mx-auto p-8">
            <div class="grid grid-cols-12 gap-8">

                <div class="col-span-12 lg:col-span-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div
                            class="bg-white rounded-[2rem] border border-slate-200 overflow-hidden group hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500">
                            <div class="p-5 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-emerald-600">
                                        <i data-lucide="file-text" class="w-4 h-4"></i>
                                    </div>
                                    <span class="text-xs font-black text-slate-700 uppercase tracking-tight">Kartu
                                        Keluarga</span>
                                </div>
                                <span
                                    class="px-2 py-1 bg-emerald-100 text-emerald-700 text-[9px] font-black rounded uppercase">Valid</span>
                            </div>
                            <div class="aspect-[4/3] bg-slate-200 relative overflow-hidden group/img">
                                <img src="https://via.placeholder.com/800x600?text=Preview+KK"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover/img:scale-110 cursor-zoom-in"
                                    onclick="openLightbox(this.src)">
                                <div
                                    class="absolute inset-0 bg-black/20 opacity-0 group-hover/img:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                    <div
                                        class="px-4 py-2 bg-white/20 backdrop-blur-md rounded-full text-white text-xs font-bold border border-white/30">
                                        Klik untuk perbesar</div>
                                </div>
                            </div>
                            <div class="p-5 flex gap-2">
                                <button
                                    class="flex-1 py-3 bg-emerald-50 text-emerald-600 rounded-xl text-xs font-black hover:bg-emerald-600 hover:text-white transition-all uppercase tracking-widest">Approve</button>
                                <button
                                    class="flex-1 py-3 bg-rose-50 text-rose-600 rounded-xl text-xs font-black hover:bg-rose-600 hover:text-white transition-all uppercase tracking-widest">Reject</button>
                            </div>
                        </div>

                        <div
                            class="bg-white rounded-[2rem] border border-slate-200 overflow-hidden group hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500">
                            <div class="p-5 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-blue-600">
                                        <i data-lucide="fingerprint" class="w-4 h-4"></i>
                                    </div>
                                    <span class="text-xs font-black text-slate-700 uppercase tracking-tight">Akta
                                        Kelahiran</span>
                                </div>
                                <span
                                    class="px-2 py-1 bg-amber-100 text-amber-700 text-[9px] font-black rounded uppercase">Pending</span>
                            </div>
                            <div class="aspect-[4/3] bg-slate-200 relative overflow-hidden group/img">
                                <img src="https://via.placeholder.com/800x600?text=Preview+Akta"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover/img:scale-110 cursor-zoom-in"
                                    onclick="openLightbox(this.src)">
                            </div>
                            <div class="p-5 flex gap-2">
                                <button
                                    class="flex-1 py-3 bg-emerald-50 text-emerald-600 rounded-xl text-xs font-black hover:bg-emerald-600 hover:text-white transition-all uppercase tracking-widest">Approve</button>
                                <button
                                    class="flex-1 py-3 bg-rose-50 text-rose-600 rounded-xl text-xs font-black hover:bg-rose-600 hover:text-white transition-all uppercase tracking-widest">Reject</button>
                            </div>
                        </div>

                        <div
                            class="bg-white rounded-[2rem] border border-slate-200 overflow-hidden group hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500">
                            <div class="p-5 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-amber-600">
                                        <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                    </div>
                                    <span class="text-xs font-black text-slate-700 uppercase tracking-tight">Ijazah /
                                        Raport</span>
                                </div>
                            </div>
                            <div class="aspect-[4/3] bg-slate-200 relative overflow-hidden group/img">
                                <img src="https://via.placeholder.com/800x600?text=Preview+Raport"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover/img:scale-110 cursor-zoom-in"
                                    onclick="openLightbox(this.src)">
                            </div>
                            <div class="p-5 flex gap-2">
                                <button
                                    class="flex-1 py-3 bg-emerald-50 text-emerald-600 rounded-xl text-xs font-black hover:bg-emerald-600 hover:text-white transition-all uppercase tracking-widest">Approve</button>
                                <button
                                    class="flex-1 py-3 bg-rose-50 text-rose-600 rounded-xl text-xs font-black hover:bg-rose-600 hover:text-white transition-all uppercase tracking-widest">Reject</button>
                            </div>
                        </div>

                        <div
                            class="bg-white rounded-[2rem] border border-slate-200 overflow-hidden group hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500">
                            <div class="p-5 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-rose-600">
                                        <i data-lucide="image" class="w-4 h-4"></i>
                                    </div>
                                    <span class="text-xs font-black text-slate-700 uppercase tracking-tight">Pas Foto
                                        Siswa</span>
                                </div>
                            </div>
                            <div class="aspect-[4/3] bg-slate-100 flex items-center justify-center">
                                <img src="https://via.placeholder.com/400x400?text=Foto+Siswa"
                                    class="w-40 h-40 object-cover rounded-2xl border-4 border-white shadow-xl cursor-zoom-in"
                                    onclick="openLightbox(this.src)">
                            </div>
                            <div class="p-5 flex gap-2">
                                <button
                                    class="flex-1 py-3 bg-emerald-50 text-emerald-600 rounded-xl text-xs font-black hover:bg-emerald-600 hover:text-white transition-all uppercase tracking-widest">Approve</button>
                                <button
                                    class="flex-1 py-3 bg-rose-50 text-rose-600 rounded-xl text-xs font-black hover:bg-rose-600 hover:text-white transition-all uppercase tracking-widest">Reject</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <div class="sticky top-32 space-y-6">
                        <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-2xl shadow-slate-200">
                            <h3 class="text-lg font-black uppercase tracking-tighter mb-6 flex items-center gap-3">
                                <i data-lucide="message-square" class="w-5 h-5 text-emerald-400"></i>
                                Catatan Verifikator
                            </h3>
                            <textarea rows="6"
                                class="w-full bg-white/5 border border-white/10 rounded-2xl p-5 text-sm text-white placeholder:text-white/20 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all resize-none mb-6"
                                placeholder="Tulis alasan jika ada dokumen yang ditolak atau instruksi untuk wali murid..."></textarea>

                            <div class="space-y-4">
                                <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.2em] mb-2">Templat
                                    Cepat</p>
                                <div class="flex flex-wrap gap-2">
                                    <button onclick="addNote('Dokumen kurang jelas/buram.')"
                                        class="px-3 py-1.5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-[10px] font-bold transition-all">Gambar
                                        Buram</button>
                                    <button onclick="addNote('Data NIK di KK dan Akta tidak sinkron.')"
                                        class="px-3 py-1.5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-[10px] font-bold transition-all">Data
                                        Tidak Sinkron</button>
                                    <button onclick="addNote('Lampirkan ijazah asli, bukan fotokopi.')"
                                        class="px-3 py-1.5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-[10px] font-bold transition-all">Butuh
                                        Berkas Asli</button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm">
                            <h3
                                class="text-xs font-black text-slate-800 uppercase tracking-widest mb-6 border-b border-slate-50 pb-4">
                                Info Pendaftar</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-slate-400 font-bold uppercase">Wali Murid</span>
                                    <span class="text-xs font-black text-slate-800">Abdurrahman Wahid</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-slate-400 font-bold uppercase">No. WhatsApp</span>
                                    <span class="text-xs font-black text-emerald-600">+62 812 3456 7890</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-slate-400 font-bold uppercase">Asal Sekolah</span>
                                    <span class="text-xs font-black text-slate-800 italic">TK Al-Azhar 2</span>
                                </div>
                            </div>
                            <button
                                class="w-full mt-8 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl text-xs font-black uppercase tracking-widest transition-all">Kirim
                                Notifikasi WA</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="lightbox"
        class="fixed inset-0 bg-slate-900/95 z-[100] hidden items-center justify-center p-10 backdrop-blur-sm">
        <button onclick="closeLightbox()" class="absolute top-10 right-10 text-white/50 hover:text-white transition-all">
            <i data-lucide="x" class="w-10 h-10"></i>
        </button>
        <img id="lightbox-img" src="" class="max-w-full max-h-full rounded-xl shadow-2xl">
    </div>

    @push('scripts')
        <script src="/js/admin-ppdb/verifikasi-detail.js"></script>
    @endpush
@endsection
