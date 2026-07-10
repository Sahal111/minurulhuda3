@extends('layouts.operator')

@section('content')
@php
    $mapels = $mapels ?? collect([
        ['kode' => 'MP-001', 'nama' => 'Al-Quran Hadis', 'kategori' => 'Keagamaan', 'kelas' => 'I - VI', 'kkm' => 75, 'guru' => 'Ust. Ahmad Zaini', 'jam' => 4, 'status' => 'Aktif'],
        ['kode' => 'MP-002', 'nama' => 'Akidah Akhlak', 'kategori' => 'Keagamaan', 'kelas' => 'I - VI', 'kkm' => 75, 'guru' => 'Ust. Fatimah Azizah', 'jam' => 3, 'status' => 'Aktif'],
        ['kode' => 'MP-003', 'nama' => 'Fikih', 'kategori' => 'Keagamaan', 'kelas' => 'III - VI', 'kkm' => 76, 'guru' => 'Ust. Naufal Hidayat', 'jam' => 3, 'status' => 'Aktif'],
        ['kode' => 'MP-004', 'nama' => 'Bahasa Indonesia', 'kategori' => 'Umum', 'kelas' => 'I - VI', 'kkm' => 78, 'guru' => 'Dewi Lestari, S.Pd', 'jam' => 6, 'status' => 'Aktif'],
        ['kode' => 'MP-005', 'nama' => 'Matematika', 'kategori' => 'Umum', 'kelas' => 'I - VI', 'kkm' => 78, 'guru' => 'Budi Santoso, S.Pd', 'jam' => 6, 'status' => 'Aktif'],
        ['kode' => 'MP-006', 'nama' => 'IPAS', 'kategori' => 'Umum', 'kelas' => 'IV - VI', 'kkm' => 76, 'guru' => 'Rina Kartika, S.Pd', 'jam' => 5, 'status' => 'Draft'],
    ]);

    $totalMapel = $mapels->count();
    $mapelAktif = $mapels->where('status', 'Aktif')->count();
    $mapelDraft = $mapels->where('status', 'Draft')->count();
    $totalJam = $mapels->sum('jam');
@endphp

<div x-data="mapelPanel()" class="space-y-6">
    <section class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-emerald-600">
                <i data-lucide="book-open-check" class="w-4 h-4"></i>
                Master Data
            </div>
            <h1 class="mt-2 text-2xl lg:text-3xl font-lexend font-bold text-slate-900 dark:text-white">
                Mata Pelajaran
            </h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Kelola daftar mapel, KKM, alokasi jam, dan guru pengampu untuk setiap tingkat kelas.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <button type="button"
                class="inline-flex items-center gap-2 px-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm font-bold text-slate-600 dark:text-slate-200 hover:border-emerald-300 hover:text-emerald-700 transition-all">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
            </button>
            <button type="button" @click="showModal = true"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold shadow-lg shadow-emerald-600/20 active:scale-95 transition-all">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Mapel
            </button>
        </div>
    </section>

    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-[1.75rem] p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                    <i data-lucide="library" class="w-6 h-6"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600">Total</span>
            </div>
            <p class="mt-5 text-xs font-black uppercase tracking-widest text-slate-400">Mata Pelajaran</p>
            <div class="mt-1 flex items-end gap-2">
                <span class="text-3xl font-lexend font-bold text-slate-900 dark:text-white">{{ $totalMapel }}</span>
                <span class="mb-1 text-xs font-bold text-slate-400">mapel</span>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-[1.75rem] p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center">
                    <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest text-blue-600">Aktif</span>
            </div>
            <p class="mt-5 text-xs font-black uppercase tracking-widest text-slate-400">Siap Digunakan</p>
            <div class="mt-1 flex items-end gap-2">
                <span class="text-3xl font-lexend font-bold text-slate-900 dark:text-white">{{ $mapelAktif }}</span>
                <span class="mb-1 text-xs font-bold text-slate-400">mapel</span>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-[1.75rem] p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center">
                    <i data-lucide="clock-3" class="w-6 h-6"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest text-amber-600">Draft</span>
            </div>
            <p class="mt-5 text-xs font-black uppercase tracking-widest text-slate-400">Perlu Review</p>
            <div class="mt-1 flex items-end gap-2">
                <span class="text-3xl font-lexend font-bold text-slate-900 dark:text-white">{{ $mapelDraft }}</span>
                <span class="mb-1 text-xs font-bold text-slate-400">mapel</span>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-[1.75rem] p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-violet-100 text-violet-700 flex items-center justify-center">
                    <i data-lucide="calendar-clock" class="w-6 h-6"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest text-violet-600">JP</span>
            </div>
            <p class="mt-5 text-xs font-black uppercase tracking-widest text-slate-400">Total Jam/Minggu</p>
            <div class="mt-1 flex items-end gap-2">
                <span class="text-3xl font-lexend font-bold text-slate-900 dark:text-white">{{ $totalJam }}</span>
                <span class="mb-1 text-xs font-bold text-slate-400">jam</span>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 2xl:grid-cols-[1fr_360px] gap-6">
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-[2rem] shadow-sm overflow-hidden">
            <div class="p-5 lg:p-6 border-b border-slate-100 dark:border-slate-800 flex flex-col xl:flex-row gap-4 xl:items-center xl:justify-between">
                <div>
                    <h2 class="text-lg font-lexend font-bold text-slate-900 dark:text-white">Daftar Mata Pelajaran</h2>
                    <p class="mt-1 text-xs text-slate-400 font-medium">Data mapel aktif untuk tahun ajaran berjalan.</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative">
                        <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input id="search-mapel" @input="filterTable()" type="text" placeholder="Cari mapel, kode, guru..."
                            class="w-full sm:w-72 pl-11 pr-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-transparent text-sm text-slate-700 dark:text-white placeholder:text-slate-400 focus:bg-white dark:focus:bg-slate-900 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all">
                    </div>
                    <select id="filter-kategori" @change="filterTable()"
                        class="px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-transparent text-sm font-bold text-slate-600 dark:text-slate-200 focus:bg-white dark:focus:bg-slate-900 focus:border-emerald-500 outline-none">
                        <option value="">Semua Kategori</option>
                        <option value="Umum">Umum</option>
                        <option value="Keagamaan">Keagamaan</option>
                        <option value="Muatan Lokal">Muatan Lokal</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[980px]">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-950/60 text-left">
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Kode</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Mata Pelajaran</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Kelas</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">KKM</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">JP</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Guru Pengampu</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                            <th class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-widest text-slate-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-mapel" class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach ($mapels as $mapel)
                            <tr data-kategori="{{ $mapel['kategori'] }}" class="hover:bg-emerald-50/50 dark:hover:bg-emerald-950/20 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs font-bold text-slate-500 dark:text-slate-400">{{ $mapel['kode'] }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                                            <i data-lucide="book-open" class="w-5 h-5"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $mapel['nama'] }}</p>
                                            <p class="text-xs text-slate-400">{{ $mapel['kategori'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-slate-600 dark:text-slate-300">{{ $mapel['kelas'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center w-11 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 text-sm font-black text-slate-700 dark:text-slate-200">{{ $mapel['kkm'] }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm font-black text-slate-700 dark:text-slate-200">{{ $mapel['jam'] }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $mapel['guru'] }}</td>
                                <td class="px-6 py-4">
                                    @if ($mapel['status'] === 'Aktif')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase tracking-widest">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-100 text-amber-700 text-[10px] font-black uppercase tracking-widest">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button" class="w-9 h-9 rounded-xl text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-950/30 transition-colors" title="Edit">
                                            <i data-lucide="pencil" class="w-4 h-4 mx-auto"></i>
                                        </button>
                                        <button type="button" class="w-9 h-9 rounded-xl text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30 transition-colors" title="Hapus">
                                            <i data-lucide="trash-2" class="w-4 h-4 mx-auto"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="bg-emerald-900 text-white rounded-[2rem] p-6 shadow-xl shadow-emerald-900/10">
                <div class="flex items-center justify-between">
                    <h2 class="font-lexend font-bold text-lg">Ringkasan Kurikulum</h2>
                    <i data-lucide="sparkles" class="w-5 h-5 text-emerald-300"></i>
                </div>
                <div class="mt-6 space-y-4">
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold text-emerald-100">
                            <span>Mapel Umum</span>
                            <span>52%</span>
                        </div>
                        <div class="mt-2 h-2 rounded-full bg-white/10 overflow-hidden">
                            <div class="h-full w-[52%] rounded-full bg-emerald-300"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold text-emerald-100">
                            <span>Keagamaan</span>
                            <span>38%</span>
                        </div>
                        <div class="mt-2 h-2 rounded-full bg-white/10 overflow-hidden">
                            <div class="h-full w-[38%] rounded-full bg-amber-300"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold text-emerald-100">
                            <span>Muatan Lokal</span>
                            <span>10%</span>
                        </div>
                        <div class="mt-2 h-2 rounded-full bg-white/10 overflow-hidden">
                            <div class="h-full w-[10%] rounded-full bg-blue-300"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-[2rem] p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <h2 class="font-lexend font-bold text-lg text-slate-900 dark:text-white">Validasi Data</h2>
                    <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase tracking-widest">Baik</span>
                </div>
                <div class="mt-5 space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                            <i data-lucide="check" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800 dark:text-slate-100">Kode mapel unik</p>
                            <p class="text-xs text-slate-400">Tidak ada duplikasi kode.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                            <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800 dark:text-slate-100">1 mapel draft</p>
                            <p class="text-xs text-slate-400">Lengkapi guru pengampu sebelum dipakai di jadwal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </section>
</div>

<div x-show="showModal" style="display: none;" class="fixed inset-0 z-[80]">
    <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" @click="showModal = false"></div>
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="animate-modal w-full max-w-3xl bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl border border-white/20 overflow-hidden">
            <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-emerald-600">Form Master Data</p>
                    <h2 class="mt-1 text-xl font-lexend font-bold text-slate-900 dark:text-white">Tambah Mata Pelajaran</h2>
                </div>
                <button type="button" @click="showModal = false"
                    class="w-10 h-10 rounded-2xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-400 transition-colors">
                    <i data-lucide="x" class="w-5 h-5 mx-auto"></i>
                </button>
            </div>

            <form class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block mb-2 text-xs font-black uppercase tracking-widest text-slate-400">Kode Mapel</label>
                    <input type="text" placeholder="MP-007"
                        class="w-full px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-transparent text-sm dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none">
                </div>
                <div>
                    <label class="block mb-2 text-xs font-black uppercase tracking-widest text-slate-400">Nama Mapel</label>
                    <input type="text" placeholder="Bahasa Arab"
                        class="w-full px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-transparent text-sm dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none">
                </div>
                <div>
                    <label class="block mb-2 text-xs font-black uppercase tracking-widest text-slate-400">Kategori</label>
                    <select class="w-full px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-transparent text-sm dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-emerald-500 outline-none">
                        <option>Umum</option>
                        <option>Keagamaan</option>
                        <option>Muatan Lokal</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-xs font-black uppercase tracking-widest text-slate-400">Tingkat Kelas</label>
                    <input type="text" placeholder="I - VI"
                        class="w-full px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-transparent text-sm dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none">
                </div>
                <div>
                    <label class="block mb-2 text-xs font-black uppercase tracking-widest text-slate-400">KKM</label>
                    <input type="number" min="0" max="100" placeholder="75"
                        class="w-full px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-transparent text-sm dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none">
                </div>
                <div>
                    <label class="block mb-2 text-xs font-black uppercase tracking-widest text-slate-400">Jam/Minggu</label>
                    <input type="number" min="1" placeholder="4"
                        class="w-full px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-transparent text-sm dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-2 text-xs font-black uppercase tracking-widest text-slate-400">Guru Pengampu</label>
                    <select class="w-full px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-transparent text-sm dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-emerald-500 outline-none">
                        <option>Pilih guru pengampu</option>
                        <option>Ust. Ahmad Zaini</option>
                        <option>Dewi Lestari, S.Pd</option>
                        <option>Budi Santoso, S.Pd</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 pt-2">
                    <button type="button" @click="showModal = false"
                        class="px-5 py-3 rounded-2xl text-sm font-bold text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        Batal
                    </button>
                    <button type="button"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold shadow-lg shadow-emerald-600/20 transition-all">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Simpan Mapel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('mapelPanel', () => ({
            showModal: false,
            filterTable() {
                const keyword = document.getElementById('search-mapel').value.toLowerCase();
                const kategori = document.getElementById('filter-kategori').value;
                const rows = document.querySelectorAll('#table-mapel tr');
                rows.forEach(row => {
                    const matchKeyword = row.textContent.toLowerCase().includes(keyword);
                    const matchKategori = !kategori || row.dataset.kategori === kategori;
                    row.style.display = matchKeyword && matchKategori ? '' : 'none';
                });
            }
        }));
    });
</script>
@endpush
@endsection
