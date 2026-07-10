@extends('layouts.operator')
@section('content')
<div x-data="kelasPanel()">
    <!-- Page Content: Data Kelas -->
    <div class="p-6 lg:p-10 space-y-10 animate-up">

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                class="glass-card p-6 rounded-[2.5rem] shadow-sm flex items-center gap-5 group hover:bg-emerald-600 transition-all duration-500 cursor-default">
                <div
                    class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-[1.5rem] flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition-all">
                    <i data-lucide="home" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-emerald-100">
                        Total Kelas</p>
                    <h4 class="text-2xl font-black group-hover:text-white">
                        {{ $kelas->whereNotNull('wali_kelas_id')->count() }} <span
                            class="text-xs font-normal opacity-60">Rombel</span></h4>
                </div>
            </div>
            <div
                class="glass-card p-6 rounded-[2.5rem] shadow-sm flex items-center gap-5 group hover:bg-blue-600 transition-all duration-500 cursor-default">
                <div
                    class="w-14 h-14 bg-blue-100 text-blue-600 rounded-[1.5rem] flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition-all">
                    <i data-lucide="users-2" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-blue-100">
                        Total Siswa</p>
                    <h4 class="text-2xl font-black group-hover:text-white">{{ $kelas->sum(fn($k) => $k->siswas->count()) }}
                        <span class="text-xs font-normal opacity-60">Aktif</span>
                    </h4>
                </div>
            </div>
            <div
                class="glass-card p-6 rounded-[2.5rem] shadow-sm flex items-center gap-5 group hover:bg-amber-600 transition-all duration-500 cursor-default">
                <div
                    class="w-14 h-14 bg-amber-100 text-amber-600 rounded-[1.5rem] flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition-all">
                    <i data-lucide="user-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-amber-100">
                        Wali Kelas</p>
                    <h4 class="text-2xl font-black group-hover:text-white">{{ $kelas->count() }} <span
                            class="text-xs font-normal opacity-60">Guru</span></h4>
                </div>
            </div>
            <div
                class="glass-card p-6 rounded-[2.5rem] shadow-sm flex items-center gap-5 group hover:bg-rose-600 transition-all duration-500 cursor-default">
                <div
                    class="w-14 h-14 bg-rose-100 text-rose-600 rounded-[1.5rem] flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition-all">
                    <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-rose-100">
                        Kapasitas</p>
                    <h4 class="text-2xl font-black group-hover:text-white">96% <span
                            class="text-xs font-normal opacity-60">Penuh</span></h4>
                </div>
            </div>
        </div>

        <!-- Enhanced Action Bar -->
        <div
            class="glass-card p-6 rounded-[3rem] flex flex-col lg:flex-row items-center justify-between gap-6 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto flex-1">
                <div class="relative flex-1 lg:max-w-md group">
                    <i data-lucide="search"
                        class="w-5 h-5 absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                    <input type="text" id="search-kelas" @input="filterKelas()"
                        placeholder="Cari nama kelas atau wali..."
                        class="w-full pl-14 pr-6 py-4 bg-slate-100/50 dark:bg-slate-900 border-none rounded-[2rem] text-sm font-medium focus:ring-4 ring-emerald-500/10 transition-all outline-none">
                </div>
                <div class="flex gap-2">
                    <button
                        class="px-6 py-4 bg-slate-100/50 dark:bg-slate-900 rounded-[1.5rem] text-xs font-bold text-slate-500 hover:bg-slate-200 transition-all flex items-center gap-2">
                        <i data-lucide="filter" class="w-4 h-4"></i>
                        Tingkat
                    </button>
                </div>
            </div>
            <div class="flex items-center gap-3 w-full lg:w-auto">
                <button class="p-4 bg-slate-100/50 text-slate-500 rounded-2xl hover:bg-slate-200 transition-all"
                    title="Export Excel">
                    <i data-lucide="download-cloud" class="w-5 h-5"></i>
                </button>
                <button @click="openKelasModal()"
                    class="flex-1 lg:flex-none flex items-center justify-center gap-3 px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-[2rem] text-sm font-black shadow-2xl shadow-emerald-600/30 transition-all active:scale-95 group">
                    <span>Tambah Rombel Baru</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>
        </div>

        <!-- Premium Table Container -->
        <div
            class="glass-card rounded-[3rem] shadow-2xl shadow-slate-200/50 dark:shadow-none overflow-hidden border border-white/40">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 dark:bg-slate-900/80 border-b border-slate-100 dark:border-slate-800">
                            <th class="px-8 py-6 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                Nama Kelas & Kode</th>
                            <th class="px-8 py-6 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                Wali Kelas</th>
                            <th class="px-8 py-6 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                Okupansi Siswa</th>
                            <th
                                class="px-8 py-6 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">
                                Status</th>
                            <th
                                class="px-8 py-6 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">
                                Manajemen</th>
                        </tr>
                    </thead>
                    <tbody id="table-kelas" class="divide-y divide-slate-50 dark:divide-slate-800">

                        @foreach ($kelas as $k)
                            <tr class="row-hover transition-all duration-300">

                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">

                                        <div
                                            class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center font-black text-white text-lg shadow-lg shadow-emerald-500/20">

                                            {{ $k->full_name }}

                                        </div>

                                        <div>
                                            <p class="text-sm font-black text-slate-900 dark:text-white">

                                                Kelas {{ $k->full_name }}

                                            </p>

                                            <p class="text-[10px] font-bold text-slate-400">

                                                ID: ROMBEL-{{ $k->id }} • {{ $k->tahunAjaran->nama ?? $k->tahun_ajaran }}

                                            </p>
                                        </div>

                                    </div>
                                </td>


                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">

                                        <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center">
                                            <i data-lucide="user" class="w-4 h-4 text-slate-400"></i>
                                        </div>

                                        <span class="text-sm font-bold text-slate-700 dark:text-slate-300">

                                            {{ $k->waliKelas?->nama ?? 'Belum ada' }}

                                        </span>

                                    </div>
                                </td>


                                <td class="px-8 py-6">

                                    @php
                                        $total = $k->siswas->count();
                                        $kapasitas = $k->kapasitas ?? 32;
                                        $persen = $kapasitas ? round(($total / $kapasitas) * 100) : 0;
                                    @endphp

                                    <div class="space-y-2">

                                        <div class="flex justify-between text-[10px] font-black uppercase">

                                            <span class="text-emerald-600">

                                                {{ $total }}/{{ $kapasitas }} Kursi

                                            </span>

                                            <span class="text-slate-400">

                                                {{ $persen }}%

                                            </span>

                                        </div>

                                        <div class="w-full h-2 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">

                                            <div class="h-full bg-emerald-500 rounded-full"
                                                style="width: {{ $persen }}%;"></div>

                                        </div>

                                    </div>

                                </td>


                                <td class="px-8 py-6 text-center">

                                    @if ($total >= $kapasitas)
                                        <span
                                            class="status-badge bg-rose-100 text-rose-700 dark:bg-rose-500/10 dark:text-rose-400 border border-rose-200 dark:border-rose-500/20">
                                            Penuh
                                        </span>
                                    @else
                                        <span
                                            class="status-badge bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">
                                            Tersedia
                                        </span>
                                    @endif

                                </td>


                                <td class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button @click="openDetailModal($el)" data-id="{{ $k->id }}"
                                            data-nama="Kelas {{ $k->full_name }}"
                                            data-rombel="ROMBEL-{{ $k->id }}"
                                            data-wali="{{ $k->waliKelas?->nama ?? 'Belum ada' }}"
                                            data-foto="{{ $k->waliKelas?->foto ? asset('storage/' . ltrim($k->waliKelas->foto, '/')) : '' }}"
                                            data-email="{{ $k->waliKelas?->email ?? '—' }}"
                                            data-siswa="{{ $k->siswas->count() }}" 
                                            data-tahun="{{ $k->tahunAjaran->nama ?? $k->tahun_ajaran }}"
                                            data-kapasitas="{{ $k->kapasitas ?? 32 }}"
                                            data-meeting="{{ $k->parent_meeting_at ? $k->parent_meeting_at->format('d M Y • H:i') : '' }}"
                                            data-meeting_raw="{{ $k->parent_meeting_at ? $k->parent_meeting_at->format('Y-m-d\TH:i') : '' }}"
                                            data-performance="{{ $k->performance_index }}"
                                            data-change="{{ $k->performance_change }}"
                                            data-tingkat="{{ $k->tingkat }}"
                                            data-nama_kelas="{{ $k->nama_kelas }}"
                                            data-wali_id="{{ $k->wali_kelas_id }}"
                                            data-tahun_id="{{ $k->tahun_ajaran_id }}"
                                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all">
                                            <i data-lucide="eye" class="w-4 h-4"></i>

                                        </button>
                                        <button @click="openKelasModal({
                                                id: {{ $k->id }},
                                                tingkat: '{{ $k->tingkat }}',
                                                nama_kelas: '{{ $k->nama_kelas }}',
                                                wali_kelas_id: '{{ $k->wali_kelas_id ?? '' }}',
                                                tahun_ajaran_id: '{{ $k->tahun_ajaran_id ?? '' }}',
                                                kapasitas: {{ $k->kapasitas ?? 32 }},
                                                parent_meeting_at: '{{ $k->parent_meeting_at ? $k->parent_meeting_at->format('Y-m-d\TH:i') : '' }}'
                                            })"
                                            class="p-2 hover:bg-amber-50 dark:hover:bg-amber-500/10 text-slate-400 hover:text-amber-500 rounded-lg transition-colors">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </button>
                                        <form action="{{ route('operator.dataKelas.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 hover:bg-rose-50 dark:hover:bg-rose-500/10 text-slate-400 hover:text-rose-500 rounded-lg transition-colors">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Hidden pages template (Siswa, Guru, Dashboard) -->
    <div id="page-dashboard" class="hidden p-8">
        <h2 class="text-2xl font-bold">Dashboard</h2>
    </div>
    <div id="page-siswa" class="hidden p-8">
        <h2 class="text-2xl font-bold">Data Siswa</h2>
    </div>
    <div id="page-guru" class="hidden p-8">
        <h2 class="text-2xl font-bold">Data Guru</h2>
    </div>

    <div id="modalKelas" x-show="showKelasModal"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-xl transition-opacity duration-500"
            @click="showKelasModal = false"></div>

        <div
            class="bg-white/90 dark:bg-slate-900/90 w-full max-w-2xl rounded-[3.5rem] shadow-[0_32px_64px_-15px_rgba(0,0,0,0.2)] dark:shadow-[0_32px_64px_-15px_rgba(0,0,0,0.6)] relative overflow-hidden flex flex-col border border-white/20 dark:border-slate-800/50 animate-up transition-all duration-500">

            <div
                class="px-10 py-10 border-b border-slate-100 dark:border-slate-800/50 flex justify-between items-center relative overflow-hidden">
                <div class="absolute -top-10 -left-10 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl"></div>

                <div class="flex items-center gap-6 relative z-10">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 text-white rounded-[2rem] flex items-center justify-center shadow-2xl shadow-emerald-500/30 ring-4 ring-emerald-500/10 transition-transform hover:scale-110 duration-300">
                        <i data-lucide="plus-square" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <h3
                            class="font-lexend font-black text-3xl text-slate-900 dark:text-white tracking-tight leading-tight"
                            x-text="modalTitle">
                        </h3>
                        <p
                            class="text-[11px] font-black text-emerald-600 dark:text-emerald-400 mt-1 uppercase tracking-[0.2em]">
                            Konfigurasi Akademik
                        </p>
                    </div>
                </div>

                <button @click="showKelasModal = false"
                    class="group p-4 bg-slate-50 dark:bg-slate-800/50 hover:bg-rose-50 dark:hover:bg-rose-500/20 rounded-2xl transition-all duration-300">
                    <i data-lucide="x" class="w-6 h-6 text-slate-400 group-hover:text-rose-500 transition-colors"></i>
                </button>
            </div>
            <form :action="form.id ? '/operator/data-kelas/' + form.id : '{{ route('operator.dataKelas.store') }}'" method="POST">
                @csrf
                <template x-if="form.id">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                <input type="hidden" name="id" x-model="form.id">
                <div class="p-10 space-y-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-3">
                            <label
                                class="flex items-center gap-2 text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest ml-1">
                                <i data-lucide="layers" class="w-3 h-3 text-emerald-500"></i> Tingkatan
                            </label>
                            <div class="relative group/select">
                                <select name="tingkat" x-model="form.tingkat"
                                    class="w-full px-8 py-5 bg-slate-50 dark:bg-slate-950/50 border-2 border-transparent rounded-[2rem] text-sm font-bold text-slate-700 dark:text-slate-200 focus:border-emerald-500 focus:bg-white dark:focus:bg-slate-900 outline-none transition-all appearance-none cursor-pointer shadow-sm">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="1">Kelas 1</option>
                                    <option value="2">Kelas 2</option>
                                    <option value="3">Kelas 3</option>
                                    <option value="4">Kelas 4</option>
                                    <option value="5">Kelas 5</option>
                                    <option value="6">Kelas 6</option>
                                </select>
                                <div
                                    class="absolute right-7 top-1/2 -translate-y-1/2 pointer-events-none group-focus-within/select:rotate-180 transition-transform duration-300">
                                    <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label
                                class="flex items-center gap-2 text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest ml-1">
                                <i data-lucide="hash" class="w-3 h-3 text-emerald-500"></i> Nama Kelas
                            </label>
                            <div class="relative group/select">
                                <select name="nama_kelas" x-model="form.nama_kelas"
                                    class="w-full px-8 py-5 bg-slate-50 dark:bg-slate-950/50 border-2 border-transparent rounded-[2rem] text-sm font-bold text-slate-700 dark:text-slate-200 focus:border-emerald-500 focus:bg-white dark:focus:bg-slate-900 outline-none transition-all appearance-none cursor-pointer shadow-sm">
                                    <option value="A">Abjad A</option>
                                    <option value="B">Abjad B</option>
                                    <option value="C">Abjad C</option>
                                    <option value="D">Abjad D</option>
                                </select>
                                <div
                                    class="absolute right-7 top-1/2 -translate-y-1/2 pointer-events-none group-focus-within/select:rotate-180 transition-transform duration-300">
                                    <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label
                            class="flex items-center gap-2 text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest ml-1">
                            <i data-lucide="user-check" class="w-3 h-3 text-emerald-500"></i> Wali Kelas
                        </label>
                        <div class="relative group/select">
                            <select name="wali_kelas_id" x-model="form.wali_kelas_id"
                                class="w-full px-8 py-5 bg-slate-50 dark:bg-slate-950/50 border-2 border-transparent rounded-[2rem] text-sm font-bold appearance-none cursor-pointer">
                                <option value="">Pilih Wali Kelas</option>
                                @foreach ($guru as $g)
                                    <option value="{{ $g->id }}">
                                        {{ $g->nama }}
                                    </option>
                                @endforeach

                            </select>
                            <div
                                class="absolute right-7 top-1/2 -translate-y-1/2 pointer-events-none group-focus-within/select:rotate-180 transition-transform duration-300">
                                <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400"></i>
                            </div>
                        </div>
                        @error('wali_kelas_id')
                            <p class="text-xs text-rose-500 font-bold mt-2 ml-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-3">
                        <label
                            class="flex items-center gap-2 text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">
                            <i data-lucide="calendar" class="w-3 h-3 text-emerald-500"></i> Tahun Ajaran
                        </label>
                        <div class="relative group/select">
                            <select name="tahun_ajaran_id" x-model="form.tahun_ajaran_id"
                                class="w-full px-8 py-5 bg-slate-50 dark:bg-slate-950/50 border-2 border-transparent rounded-[2rem] text-sm font-bold text-slate-700 focus:border-emerald-500 outline-none transition-all shadow-sm appearance-none cursor-pointer">
                                <option value="">Pilih Tahun Ajaran</option>
                                @foreach ($tahunAjaran as $t)
                                    <option value="{{ $t->id }}" {{ $t->is_active ? 'selected' : '' }}>
                                        {{ $t->nama }} {{ $t->is_active ? '(Aktif)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-7 top-1/2 -translate-y-1/2 pointer-events-none group-focus-within/select:rotate-180 transition-transform duration-300">
                                <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 space-y-3">
                        <label
                            class="flex items-center gap-2 text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest ml-1">
                            <i data-lucide="users" class="w-3 h-3 text-emerald-500"></i> Kapasitas Kursi
                        </label>
                        <div class="relative group/input">
                            <input type="number" name="kapasitas" x-model="form.kapasitas"
                                class="w-full px-8 py-5 bg-slate-50 dark:bg-slate-950/50 border-2 border-transparent rounded-[2rem] text-sm font-bold text-slate-700 dark:text-slate-200 focus:border-emerald-500 focus:bg-white dark:focus:bg-slate-900 outline-none transition-all shadow-sm">
                            <span
                                class="absolute right-8 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase">Siswa</span>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 space-y-3">
                        <label
                            class="flex items-center gap-2 text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest ml-1">
                            <i data-lucide="calendar-clock" class="w-3 h-3 text-emerald-500"></i> Jadwal Pertemuan Wali
                        </label>
                        <div class="relative group/input">
                            <input type="datetime-local" name="parent_meeting_at" x-model="form.parent_meeting_at"
                                class="w-full px-8 py-5 bg-slate-50 dark:bg-slate-950/50 border-2 border-transparent rounded-[2rem] text-sm font-bold text-slate-700 dark:text-slate-200 focus:border-emerald-500 focus:bg-white dark:focus:bg-slate-900 outline-none transition-all shadow-sm">
                        </div>
                    </div>
                </div>

                <div
                    class="px-10 py-10 bg-slate-50/50 dark:bg-slate-950/50 border-t border-slate-100 dark:border-slate-800/50 flex justify-end items-center gap-8 relative overflow-hidden">
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-emerald-500/5 rounded-full blur-3xl"></div>

                    <button @click="showKelasModal = false"
                        class="text-slate-400 dark:text-slate-500 font-black text-sm hover:text-rose-500 transition-all uppercase tracking-widest">
                        Batalkan
                    </button>
                    <button
                        class="relative group/btn overflow-hidden px-12 py-5 bg-emerald-600 text-white rounded-[2rem] text-sm font-black shadow-[0_20px_40px_-10px_rgba(16,185,129,0.4)] hover:shadow-[0_25px_50px_-12px_rgba(16,185,129,0.5)] hover:-translate-y-1.5 active:scale-95 transition-all duration-300">
                        <span class="relative z-10">Simpan Rombel</span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-400 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300">
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- MODAL DETAIL KELAS --}}
    <div id="modalDetail"
        class="fixed inset-0 z-[70] hidden items-center justify-center p-4 md:p-8 bg-[#171c1f]/40 backdrop-blur-sm">
        <div
            class="bg-white w-full max-w-7xl max-h-[90vh] rounded-[2rem] shadow-2xl flex flex-col relative overflow-hidden border border-slate-200/20 animate-up">

            {{-- HEADER --}}
            <header class="flex items-center justify-between px-8 py-6 border-b border-slate-100 bg-white shrink-0">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-800 rounded-2xl flex items-center justify-center text-white">
                        <i data-lucide="school" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h1 id="detail-nama" class="text-2xl font-black tracking-tight text-emerald-900"></h1>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="text-xs font-bold tracking-widest text-slate-400 uppercase">Academic •
                                Classes</span>
                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                            <span id="detail-rombel-header"
                                class="text-xs font-bold text-emerald-600 uppercase tracking-widest"></span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="editCurrentKelas()"
                        class="px-6 py-2 bg-emerald-900 text-white rounded-full font-bold text-sm hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-900/20">
                        Edit Class
                    </button>
                    <button @click="closeDetailModal()"
                        class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 transition-all text-slate-400 hover:text-slate-700">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </header>

            {{-- SCROLLABLE BODY --}}
            <div class="flex-1 overflow-y-auto p-8 lg:p-10"
                style="scrollbar-width:thin;scrollbar-color:#00352720 transparent;">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                    {{-- SIDEBAR KIRI --}}
                    <div class="lg:col-span-4 flex flex-col gap-8">

                        {{-- Kapasitas --}}
                        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm relative overflow-hidden">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-6">Class Capacity</h3>
                            <div class="flex items-baseline gap-2 mb-3">
                                <span id="detail-siswa-count" class="text-4xl font-black text-emerald-900"></span>
                                <span id="detail-kapasitas-header" class="text-lg text-slate-400 font-medium">/ 30 Kursi</span>
                            </div>
                            <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden mb-4">
                                <div id="detail-bar"
                                    class="h-full bg-emerald-600 rounded-full transition-all duration-700"></div>
                            </div>
                            <div class="flex justify-between items-center text-xs font-bold">
                                <span id="detail-persen" class="text-emerald-600"></span>
                                <span id="detail-sisa" class="text-emerald-500"></span>
                            </div>
                        </div>

                        {{-- Wali Kelas --}}
                        <div class="bg-emerald-800 text-white rounded-2xl p-6 shadow-xl relative overflow-hidden">
                            <div class="absolute -right-6 -top-6 opacity-10">
                                <i data-lucide="user" style="width:96px;height:96px;"></i>
                            </div>
                            <h3 class="text-xs font-bold uppercase tracking-widest text-white/70 mb-6">Homeroom Teacher
                            </h3>

                            <div class="flex items-center gap-4 mb-6 relative">
                                {{-- Avatar: foto jika ada, fallback ke inisial --}}
                                <div class="w-16 h-16 rounded-2xl overflow-hidden border-2 border-white/20 shrink-0">
                                    <img id="detail-wali-foto" src="" alt="Foto Wali Kelas"
                                        class="w-full h-full object-cover hidden">
                                    <div id="detail-wali-inisial"
                                        class="w-full h-full bg-white/20 flex items-center justify-center text-white text-xl font-black">
                                        ?
                                    </div>
                                </div>
                                <div>
                                    <h4 id="detail-wali" class="text-lg font-black leading-tight"></h4>
                                    <p class="text-xs text-white/70 font-medium mt-0.5">Wali Kelas Aktif</p>
                                </div>
                            </div>

                            <div class="space-y-3 mb-6 text-sm">
                                <div class="flex items-center gap-3 text-white/80">
                                    <i data-lucide="mail" class="w-4 h-4 opacity-70"></i>
                                    <span id="detail-email">—</span>
                                </div>
                                <div class="flex items-center gap-3 text-white/80">
                                    <i data-lucide="calendar" class="w-4 h-4 opacity-70"></i>
                                    <span>Tahun Ajaran: <span id="detail-tahun-wali"></span></span>
                                </div>
                            </div>

                            <a href="#"
                                class="flex items-center justify-center gap-2 w-full py-2 bg-white/10 hover:bg-white/20 rounded-xl text-sm font-bold transition-all border border-white/10">
                                Lihat Profil Lengkap
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>

                        {{-- Info Kelas --}}
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-5">Location &amp;
                                Details</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                    <span class="text-sm text-slate-400">ID Rombel</span>
                                    <span id="detail-rombel-info" class="font-bold text-emerald-900"></span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                    <span class="text-sm text-slate-400">Wali Kelas</span>
                                    <span id="detail-wali-info" class="font-bold text-emerald-900"></span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-sm text-slate-400">Tahun Ajaran</span>
                                    <span id="detail-tahun-info" class="font-bold text-emerald-900"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KONTEN KANAN --}}
                    <div class="lg:col-span-8 flex flex-col gap-8">

                        {{-- Tabel Siswa --}}
                        <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm flex flex-col">
                            <div
                                class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                                <div>
                                    <h2 class="text-xl font-black text-emerald-900">Student Registry</h2>
                                    <p id="detail-subtitle" class="text-xs text-slate-400 font-medium mt-0.5"></p>
                                </div>
                                <div class="flex gap-2 w-full md:w-auto">
                                    <div class="relative flex-1 md:w-56">
                                        <i data-lucide="search"
                                            class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                        <input id="detail-search" type="text" placeholder="Search student..."
                                            @input="searchSiswa()"
                                            class="w-full pl-10 pr-4 py-2 rounded-full border border-slate-200 bg-slate-50 text-xs focus:ring-2 focus:ring-emerald-500/20 transition-all outline-none">
                                    </div>
                                    <button
                                        class="p-2 border border-slate-200 rounded-full hover:bg-slate-50 transition-all">
                                        <i data-lucide="filter" class="w-5 h-5 text-slate-400"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-slate-50/50">
                                        <tr>
                                            <th
                                                class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-400">
                                                Name</th>
                                            <th
                                                class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-slate-400">
                                                NISN</th>
                                            <th
                                                class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-slate-400">
                                                Gender</th>
                                            <th
                                                class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-slate-400">
                                                Status</th>
                                            <th
                                                class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-400 text-right">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail-siswa-list" class="divide-y divide-slate-50">
                                        <tr>
                                            <td colspan="5" class="px-6 py-10 text-center text-slate-400 text-sm">
                                                <i data-lucide="loader" class="w-5 h-5 mx-auto mb-2 animate-spin"></i>
                                                Memuat data siswa...
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div
                                class="px-6 py-4 bg-slate-50/30 border-t border-slate-100 flex justify-between items-center">
                                <span id="detail-page-info"
                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Page 1</span>
                                <div class="flex gap-1.5">
                                    <button
                                        class="w-8 h-8 rounded-lg flex items-center justify-center border border-slate-200 hover:bg-white transition-all">
                                        <i data-lucide="chevron-left" class="w-4 h-4 text-slate-400"></i>
                                    </button>
                                    <button
                                        class="w-8 h-8 rounded-lg bg-emerald-900 text-white font-bold text-xs">1</button>
                                    <button
                                        class="w-8 h-8 rounded-lg flex items-center justify-center border border-slate-200 hover:bg-white transition-all">
                                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Bottom Cards --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div
                                class="p-6 bg-emerald-700 text-white rounded-2xl flex items-center gap-4 shadow-lg shadow-emerald-700/10">
                                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                                    <i data-lucide="trending-up" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-white/70">Performance
                                        Index</p>
                                    <p id="detail-performance" class="text-lg font-black"></p>
                                    <p id="detail-performance-change" class="text-[10px] font-bold text-white/50"></p>
                                </div>
                            </div>
                            <div class="p-6 bg-white border border-slate-100 rounded-2xl flex items-center gap-4">
                                <div
                                    class="w-10 h-10 bg-emerald-900/10 text-emerald-900 rounded-xl flex items-center justify-center shrink-0">
                                    <i data-lucide="calendar" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Next Parent
                                        Meeting</p>
                                    <p id="detail-meeting" class="text-sm font-bold text-emerald-900">TBA</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- STICKY FOOTER --}}
            <footer class="p-6 border-t border-slate-100 bg-white flex justify-end gap-3 shrink-0">
                <button @click="window.print()"
                    class="px-6 py-2.5 rounded-full border border-slate-200 text-sm font-bold hover:bg-slate-50 transition-all flex items-center gap-2">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    Print Student List
                </button>
            </footer>

        </div>
    </div>
</div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('kelasPanel', () => ({
                showKelasModal: false,
                showDetailModal: false,
                modalTitle: 'Rombel Baru',
                currentKelas: null,
                form: { id: null, tingkat: '', nama_kelas: 'A', wali_kelas_id: '', tahun_ajaran_id: '{{ $tahunAjaran->where('is_active', true)->first()->id ?? '' }}', kapasitas: 32, parent_meeting_at: '' },
                
                init() {
                    @if($errors->any())
                        this.showKelasModal = true;
                        this.modalTitle = '{{ old('id') ? 'Edit Rombel' : 'Rombel Baru' }}';
                        this.form = {
                            id: '{{ old('id') }}',
                            tingkat: '{{ old('tingkat') }}',
                            nama_kelas: '{{ old('nama_kelas') }}',
                            wali_kelas_id: '{{ old('wali_kelas_id') }}',
                            tahun_ajaran_id: '{{ old('tahun_ajaran_id') }}',
                            kapasitas: '{{ old('kapasitas', 32) }}',
                            parent_meeting_at: '{{ old('parent_meeting_at') }}'
                        };
                    @endif
                },
                openKelasModal(item = null) {
                    if (item) {
                        this.modalTitle = 'Edit Rombel';
                        this.form = { ...item };
                    } else {
                        this.modalTitle = 'Rombel Baru';
                        this.form = { id: null, tingkat: '', nama_kelas: 'A', wali_kelas_id: '', tahun_ajaran_id: '{{ $tahunAjaran->where('is_active', true)->first()->id ?? '' }}', kapasitas: 32, parent_meeting_at: '' };
                    }
                    this.showKelasModal = true;
                },
                filterKelas() {
                    const input = document.getElementById('search-kelas');
                    const tableBody = document.getElementById('table-kelas');
                    if (!input || !tableBody) return;
                    const filter = input.value.toLowerCase();
                    tableBody.querySelectorAll('tr').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
                    });
                },
                openDetailModal(btn) {
                    var id = btn.dataset.id;
                    var nama = btn.dataset.nama;
                    var rombel = btn.dataset.rombel;
                    var wali = btn.dataset.wali;
                    var email = btn.dataset.email;
                    var foto = btn.dataset.foto;
                    var total = parseInt(btn.dataset.siswa);
                    var tahun = btn.dataset.tahun;
                    var kapasitas = parseInt(btn.dataset.kapasitas) || 32;
                    var meeting = btn.dataset.meeting;
                    var performance = btn.dataset.performance;
                    var change = btn.dataset.change;

                    // Store current kelas for editing from detail modal
                    this.currentKelas = {
                        id: id,
                        tingkat: btn.dataset.tingkat,
                        nama_kelas: btn.dataset.nama_kelas,
                        wali_kelas_id: btn.dataset.wali_id,
                        tahun_ajaran_id: btn.dataset.tahun_id,
                        kapasitas: kapasitas,
                        parent_meeting_at: btn.dataset.meeting_raw
                    };
                    var persen = Math.round((total / kapasitas) * 100);
                    var sisa = kapasitas - total;

                    document.getElementById('detail-kapasitas-header').textContent = '/ ' + kapasitas + ' Kursi';
                    document.getElementById('detail-meeting').textContent = meeting || 'Belum Dijadwalkan';
                    document.getElementById('detail-performance').textContent = performance + ' Average Score';
                    document.getElementById('detail-performance-change').textContent = change + ' vs last month';

                    document.getElementById('detail-nama').textContent = nama;
                    document.getElementById('detail-rombel-header').textContent = rombel;
                    document.getElementById('detail-rombel-info').textContent = rombel;
                    document.getElementById('detail-wali').textContent = wali;
                    document.getElementById('detail-wali-info').textContent = wali;
                    document.getElementById('detail-tahun-wali').textContent = tahun;
                    document.getElementById('detail-tahun-info').textContent = tahun;
                    document.getElementById('detail-siswa-count').textContent = total;
                    document.getElementById('detail-persen').textContent = persen + '% Occupancy';
                    document.getElementById('detail-sisa').textContent = sisa + ' Seats Available';
                    document.getElementById('detail-bar').style.width = persen + '%';
                    document.getElementById('detail-subtitle').textContent = 'Enrolled Students in ' + nama;
                    document.getElementById('detail-email').textContent = email || '\u2014';

                    var imgEl = document.getElementById('detail-wali-foto');
                    var inisialEl = document.getElementById('detail-wali-inisial');
                    if (foto) {
                        imgEl.src = foto;
                        imgEl.classList.remove('hidden');
                        inisialEl.classList.add('hidden');
                    } else {
                        imgEl.classList.add('hidden');
                        inisialEl.classList.remove('hidden');
                        var inisial = wali.split(' ').slice(0, 2).map(w => w[0]).join('').toUpperCase();
                        inisialEl.textContent = inisial || '?';
                    }

                    var modal = document.getElementById('modalDetail');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.style.overflow = 'hidden';

                    fetch('/operator/kelas/' + id + '/siswa')
                        .then(res => res.json())
                        .then(data => {
                            window.currentSiswaData = data; // Store for search
                            this.renderSiswaList(data);
                        })
                        .catch(err => console.error(err));

                    this.$nextTick(() => lucide.createIcons());
                },
                renderSiswaList(data) {
                    var tbody = document.getElementById('detail-siswa-list');
                    tbody.innerHTML = '';
                    if (data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="5" class="text-center py-10 text-slate-400">Tidak ada siswa terdaftar di kelas ini</td></tr>';
                        return;
                    }
                    data.forEach(siswa => {
                        const statusClass = siswa.status === 'Aktif' ? 'text-emerald-600' : 'text-amber-600';
                        const avatar = siswa.foto ? `/storage/${siswa.foto}` : null;
                        
                        tbody.innerHTML += `
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 overflow-hidden border-2 border-white shadow-sm flex items-center justify-center shrink-0">
                                            ${avatar ? `<img src="${avatar}" class="w-full h-full object-cover">` : 
                                                `<span class="text-xs font-black text-slate-400">${siswa.nama.split(' ').slice(0, 2).map(w => w[0]).join('').toUpperCase()}</span>`}
                                        </div>
                                        <span class="font-bold text-slate-700">${siswa.nama}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm text-slate-500 font-medium">${siswa.nisn || '—'}</td>
                                <td class="px-4 py-4 text-sm text-slate-500 font-medium">${siswa.jenis_kelamin}</td>
                                <td class="px-4 py-4">
                                    <span class="${statusClass} text-[10px] font-black uppercase tracking-widest bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100">
                                        ${siswa.status || 'Aktif'}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="/operator/data-siswa?search=${siswa.nama}" class="text-blue-500 hover:text-blue-700 font-bold text-xs uppercase tracking-widest">Detail</a>
                                </td>
                            </tr>
                        `;
                    });
                },
                editCurrentKelas() {
                    if (!this.currentKelas) return;
                    this.closeDetailModal();
                    this.openKelasModal(this.currentKelas);
                },
                searchSiswa() {
                    const term = document.getElementById('detail-search').value.toLowerCase();
                    if (!window.currentSiswaData) return;
                    const filtered = window.currentSiswaData.filter(s => 
                        s.nama.toLowerCase().includes(term) || (s.nisn && s.nisn.toLowerCase().includes(term))
                    );
                    this.renderSiswaList(filtered);
                },
                closeDetailModal() {
                    var modal = document.getElementById('modalDetail');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.style.overflow = '';
                }
            }));
        });
    </script>
    @endpush
    <style>
        @keyframes up {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-up {
            animation: up 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
@endsection
