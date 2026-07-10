@extends('layouts.ppdb')

@section('content')
    <main class="flex-1 overflow-y-auto bg-[#F8FAFC]">
        <header class="bg-white border-b border-slate-200 px-8 py-6 sticky top-0 z-40">
            <div class="max-w-[1600px] mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <div
                            class="w-10 h-10 bg-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-100">
                            <i data-lucide="user-plus" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-2xl font-[1000] text-slate-900 tracking-tight">Konversi Siswa Aktif</h2>
                    </div>
                    <p class="text-sm text-slate-500 font-medium">Langkah akhir untuk meresmikan pendaftar menjadi siswa
                        sekolah.</p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="bg-amber-50 border border-amber-100 px-4 py-2 rounded-xl flex items-center gap-3">
                        <i data-lucide="info" class="w-4 h-4 text-amber-600"></i>
                        <p class="text-[10px] font-bold text-amber-700 uppercase tracking-tight">Hanya menampilkan siswa
                            berstatus <span class="font-black">Lulus</span></p>
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-[1600px] mx-auto p-8 space-y-8">

            <div
                class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-slate-200/60 flex flex-wrap items-center gap-4">
                <div class="flex-1 min-w-[300px] relative">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="text" placeholder="Cari calon siswa..."
                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl text-sm font-bold focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all">
                </div>
                <button
                    class="px-8 py-3 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-emerald-600 transition-all shadow-xl shadow-slate-200">
                    Konversi Masal
                </button>
            </div>

            <div class="bg-white rounded-[3rem] shadow-sm border border-slate-200/60 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                            <th class="px-10 py-6">Informasi Siswa</th>
                            <th class="px-6 py-6 text-center">Jalur</th>
                            <th class="px-6 py-6 text-center">Status Bayar</th>
                            <th class="px-6 py-6 text-center">Kelas Penempatan</th>
                            <th class="px-10 py-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 font-bold text-sm">

                        <tr class="group hover:bg-slate-50 transition-all">
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-black">
                                        ZA
                                    </div>
                                    <div>
                                        <p class="text-slate-800 tracking-tight text-base">Zulfikar Ali</p>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">NISN:
                                            009281726</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span class="text-xs font-black text-slate-600 uppercase">Prestasi</span>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[9px] font-black uppercase">
                                    <i data-lucide="check" class="w-3 h-3"></i> Lunas
                                </span>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <select
                                    class="bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-2 text-[11px] font-black text-slate-600 outline-none focus:border-emerald-500 transition-all">
                                    <option>Pilih Kelas</option>
                                    <option>Kelas 1-A</option>
                                    <option>Kelas 1-B</option>
                                    <option>Kelas 1-C</option>
                                </select>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <button onclick="confirmConversion('Zulfikar Ali', 'Kelas 1-A')"
                                    class="px-6 py-3 bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">
                                    Konversi
                                </button>
                            </td>
                        </tr>

                        <tr class="group hover:bg-slate-50 transition-all">
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center font-black">
                                        BS
                                    </div>
                                    <div>
                                        <p class="text-slate-800 tracking-tight text-base">Budi Santoso</p>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">NISN:
                                            009281788</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-center text-xs font-black text-slate-600 uppercase">Reguler</td>
                            <td class="px-6 py-6 text-center">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-100 text-amber-700 rounded-lg text-[9px] font-black uppercase">
                                    Sebagian
                                </span>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <select
                                    class="bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-2 text-[11px] font-black text-slate-600 outline-none">
                                    <option>Pilih Kelas</option>
                                    <option>Kelas 1-A</option>
                                    <option>Kelas 1-B</option>
                                </select>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <button onclick="confirmConversion('Budi Santoso', 'Belum Ditentukan')"
                                    class="px-6 py-3 bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">
                                    Konversi
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="modal-confirm" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
        <div class="relative bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-10 transform transition-all scale-95 opacity-0 duration-300"
            id="card-confirm">
            <div
                class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <i data-lucide="shield-check" class="w-10 h-10"></i>
            </div>
            <div class="text-center mb-8">
                <h3 class="text-xl font-[1000] text-slate-900 tracking-tight">Konfirmasi Aktivasi</h3>
                <p class="text-sm text-slate-500 font-medium mt-2">Anda akan memindahkan <span id="target-name"
                        class="text-emerald-600 font-black">Siswa</span> ke data Siswa Aktif di <span id="target-class"
                        class="font-black text-slate-800">Kelas</span>.</p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-5 mb-8 border border-slate-100">
                <div class="flex items-start gap-3 text-left text-xs text-slate-500 leading-relaxed font-bold">
                    <i data-lucide="alert-circle" class="w-8 h-8 text-amber-500 shrink-0"></i>
                    Data ini akan menghapus status pendaftar dan menerbitkan NIS (Nomor Induk Siswa) otomatis.
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <button
                    class="w-full py-4 bg-emerald-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-emerald-100 hover:bg-emerald-700 transition-all">
                    Ya, Konversi Sekarang
                </button>
                <button onclick="closeModal()"
                    class="w-full py-4 bg-slate-100 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-slate-200 transition-all">
                    Batalkan
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="/js/admin-ppdb/konversi.js"></script>
    @endpush
@endsection
