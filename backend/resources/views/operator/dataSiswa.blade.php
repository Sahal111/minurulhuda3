@extends('layouts.operator')

@section('content')
    <div x-data="siswaPanel()">
        <div id="page-content" class="p-6 lg:p-8 space-y-8 animate-up">

            {{-- ── STATS ROW ── --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
                @php
                    $statItems = [
                        ['label' => 'Total Siswa', 'value' => $stats['total'], 'icon' => 'users', 'color' => 'emerald'],
                        ['label' => 'Aktif', 'value' => $stats['aktif'], 'icon' => 'user-check', 'color' => 'blue'],
                        ['label' => 'Laki-laki', 'value' => $stats['laki'], 'icon' => 'user', 'color' => 'sky'],
                        ['label' => 'Perempuan', 'value' => $stats['perempuan'], 'icon' => 'user', 'color' => 'pink'],
                        [
                            'label' => 'Lulus',
                            'value' => $stats['lulus'],
                            'icon' => 'graduation-cap',
                            'color' => 'purple',
                        ],
                        ['label' => 'Pindah', 'value' => $stats['pindah'], 'icon' => 'log-out', 'color' => 'amber'],
                    ];
                    $colorMap = [
                        'emerald' => 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                        'blue' => 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400',
                        'sky' => 'bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400',
                        'pink' => 'bg-pink-50 dark:bg-pink-500/10 text-pink-600 dark:text-pink-400',
                        'purple' => 'bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400',
                        'amber' => 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400',
                    ];
                @endphp
                @foreach ($statItems as $stat)
                    <div
                        class="glass-card p-4 rounded-2xl border border-slate-100 dark:border-slate-800 flex items-center gap-3">
                        <div class="p-2.5 rounded-xl {{ $colorMap[$stat['color']] }} shrink-0">
                            <i data-lucide="{{ $stat['icon'] }}" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-xl font-black text-slate-900 dark:text-white font-lexend">{{ $stat['value'] }}</p>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">{{ $stat['label'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ── ACTION BAR ── --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <h2 class="font-lexend font-black text-xl text-slate-900 dark:text-white tracking-tight">
                    Data Siswa
                </h2>
                <div class="flex items-center gap-2 flex-wrap">

                    {{-- Import --}}
                    <button @click="openImportModal()"
                        class="group px-5 py-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:border-blue-500/50 transition-all shadow-sm">
                        <i data-lucide="upload"
                            class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors"></i>
                        <span class="text-slate-600 dark:text-slate-400">Import</span>
                    </button>

                    {{-- Recycle Bin --}}
                    <button @click="openTrashModal()"
                        class="group relative px-5 py-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:border-rose-500/50 transition-all shadow-sm">
                        <i data-lucide="trash-2"
                            class="w-4 h-4 text-slate-400 group-hover:text-rose-500 transition-colors"></i>
                        <span class="text-slate-600 dark:text-slate-400">RECYCLE BIN</span>
                    </button>

                    {{-- ── DROPDOWN EXPORT ── --}}
                    <div class="relative" x-data="{ openExport: false }" @click.outside="openExport = false">

                        {{-- Trigger --}}
                        <button @click="openExport = !openExport"
                            class="group px-5 py-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:border-emerald-500/50 transition-all shadow-sm">
                            <i data-lucide="download"
                                class="w-4 h-4 text-slate-400 group-hover:text-emerald-500 transition-colors"></i>
                            <span class="text-slate-600 dark:text-slate-400">Export</span>
                            <i data-lucide="chevron-down"
                                class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200"
                                :class="openExport ? 'rotate-180' : ''"></i>
                        </button>

                        {{-- Dropdown panel --}}
                        <div x-show="openExport" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="absolute right-0 top-full mt-2 w-72 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none z-50 overflow-hidden">

                            {{-- Header dropdown --}}
                            <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pilih Format
                                    Export</p>
                                <p class="text-[10px] text-slate-400 mt-0.5">Filter aktif akan ikut diterapkan</p>
                            </div>

                            {{-- Pilihan 1: ZIP --}}
                            <a href="{{ route('operator.dataSiswa.export', array_merge(request()->only(['q', 'kelas', 'status']), ['mode' => 'zip'])) }}"
                                @click="openExport = false"
                                class="flex items-start gap-3 px-4 py-4 hover:bg-emerald-50 dark:hover:bg-emerald-500/5 transition-colors group">
                                <div
                                    class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center shrink-0 group-hover:bg-emerald-200 transition-colors">
                                    <i data-lucide="archive" class="w-4 h-4 text-emerald-600 dark:text-emerald-400"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-black text-slate-800 dark:text-white">Export ZIP</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5 leading-relaxed">
                                        File <code class="bg-slate-100 dark:bg-slate-800 px-1 rounded">.zip</code> berisi
                                        Excel + folder
                                        <code class="bg-slate-100 dark:bg-slate-800 px-1 rounded">foto/</code> per siswa.
                                        Bisa langsung re-import.
                                    </p>
                                </div>
                            </a>

                            <div class="mx-4 border-t border-slate-100 dark:border-slate-800"></div>

                            {{-- Pilihan 2: PDF massal --}}
                            <a href="{{ route('operator.dataSiswa.export', array_merge(request()->only(['q', 'kelas', 'status']), ['mode' => 'pdf'])) }}"
                                @click="openExport = false"
                                class="flex items-start gap-3 px-4 py-4 hover:bg-purple-50 dark:hover:bg-purple-500/5 transition-colors group">
                                <div
                                    class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-500/10 flex items-center justify-center shrink-0 group-hover:bg-purple-200 transition-colors">
                                    <i data-lucide="file-text" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-black text-slate-800 dark:text-white">Export PDF Kartu Identitas
                                    </p>
                                    <p class="text-[10px] text-slate-400 mt-0.5 leading-relaxed">
                                        PDF berisi kartu identitas lengkap semua siswa — foto, data diri, orang tua, kelas.
                                        2 kartu per halaman A4.
                                    </p>
                                </div>
                            </a>

                            {{-- Footer info --}}
                            <div
                                class="px-4 py-3 bg-slate-50/50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800">
                                <p class="text-[10px] text-slate-400 flex items-center gap-1.5">
                                    <i data-lucide="info" class="w-3 h-3 shrink-0"></i>
                                    PDF satu siswa: klik ikon
                                    <i data-lucide="file-text" class="w-3 h-3 inline shrink-0"></i>
                                    di baris tabel.
                                </p>
                            </div>

                        </div>
                    </div>

                    {{-- Tambah Siswa --}}
                    <button @click="openSiswaModal()"
                        class="px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-600/20 hover:-translate-y-1 active:scale-95 transition-all flex items-center gap-3">
                        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Siswa
                    </button>
                </div>
            </div>

            {{-- Flash messages --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                    class="px-5 py-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm font-semibold flex items-center gap-3 mb-6">
                    <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('warning'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                    class="px-5 py-4 bg-amber-50 border border-amber-200 text-amber-700 rounded-2xl text-sm font-semibold flex items-center gap-3 mb-6">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-500 shrink-0"></i>
                    {{ session('warning') }}
                </div>
            @endif
            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                    class="px-5 py-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-sm font-semibold flex items-center gap-3 mb-6">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-rose-500 shrink-0"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="px-5 py-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-sm font-semibold flex items-start gap-3 mb-6">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-rose-500 shrink-0 mt-0.5"></i>
                    <div>
                        <p class="font-bold mb-1">Terdapat kesalahan:</p>
                        <ul class="list-disc list-inside text-xs font-medium space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- ── SEARCH & FILTER ── --}}
            <form method="GET" action="{{ route('operator.dataSiswa.index') }}"
                class="bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm p-3 rounded-[2.5rem] border border-slate-200/50 dark:border-slate-800/50 flex flex-col md:flex-row gap-3 items-center">

                <div class="relative flex-1 w-full group">
                    <i data-lucide="search"
                        class="absolute left-6 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors"></i>
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Cari berdasarkan Nama, NISN, NIS, atau NIK..."
                        class="w-full pl-14 pr-6 py-4 bg-white dark:bg-slate-950 border border-slate-100 dark:border-slate-800 focus:border-emerald-500/50 rounded-[1.8rem] text-sm focus:ring-4 focus:ring-emerald-500/5 outline-none transition-all placeholder:text-slate-400">
                </div>

                <div class="flex items-center gap-3 w-full md:w-auto pr-2">
                    <div class="relative flex-1 md:w-44">
                        <select name="kelas"
                            class="w-full pl-5 pr-10 py-4 bg-white dark:bg-slate-950 border border-slate-100 dark:border-slate-800 rounded-[1.5rem] text-xs font-bold text-slate-600 dark:text-slate-400 outline-none appearance-none cursor-pointer focus:border-emerald-500/50">
                            <option value="all">Semua Kelas</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" {{ request('kelas') == $k->id ? 'selected' : '' }}>
                                    Kelas {{ $k->full_name }}
                                </option>
                            @endforeach
                        </select>
                        <i data-lucide="chevron-down"
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>

                    <div class="relative flex-1 md:w-44">
                        <select name="status"
                            class="w-full pl-5 pr-10 py-4 bg-white dark:bg-slate-950 border border-slate-100 dark:border-slate-800 rounded-[1.5rem] text-xs font-bold text-slate-600 dark:text-slate-400 outline-none appearance-none cursor-pointer focus:border-emerald-500/50">
                            <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>Semua Status
                            </option>
                            <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="lulus" {{ request('status') === 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="pindah" {{ request('status') === 'pindah' ? 'selected' : '' }}>Pindah
                            </option>
                            <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Non-Aktif
                            </option>
                        </select>
                        <i data-lucide="chevron-down"
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>

                    <div class="relative flex-1 md:w-44">
                        <select name="jenis_masuk"
                            class="w-full pl-5 pr-10 py-4 bg-white dark:bg-slate-950 border border-slate-100 dark:border-slate-800 rounded-[1.5rem] text-xs font-bold text-slate-600 dark:text-slate-400 outline-none appearance-none cursor-pointer focus:border-emerald-500/50">
                            <option value="all" {{ request('jenis_masuk', 'all') === 'all' ? 'selected' : '' }}>Semua Jenis</option>
                            <option value="baru" {{ request('jenis_masuk') === 'baru' ? 'selected' : '' }}>Siswa Baru</option>
                            <option value="mutasi" {{ request('jenis_masuk') === 'mutasi' ? 'selected' : '' }}>Mutasi Masuk</option>
                        </select>
                        <i data-lucide="chevron-down"
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>

                    <button type="submit"
                        class="px-5 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-[1.5rem] text-xs font-black uppercase tracking-widest transition-all flex items-center gap-2 shrink-0">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        <span class="hidden sm:inline">Cari</span>
                    </button>
                </div>
            </form>

            {{-- ── TABEL ── --}}
            <div
                class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-sm border border-slate-200/60 dark:border-slate-800/60 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-slate-200/50 dark:hover:shadow-none">
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-800/30 border-b border-slate-100 dark:border-slate-800">
                                <th
                                    class="pl-10 pr-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">
                                    Siswa</th>
                                <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">
                                    Identitas</th>
                                <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">
                                    Kelas</th>
                                <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">
                                    Gender</th>
                                <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">
                                    Status</th>
                                <th
                                    class="pl-6 pr-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] text-right">
                                    Manajemen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswa as $s)
                                <tr
                                    class="table-row-hover transition-all border-b border-slate-50 dark:border-slate-800/50 last:border-0">

                                    {{-- SISWA --}}
                                    <td class="pl-10 pr-6 py-5">
                                        <div class="flex items-center gap-4">
                                            @if ($s->foto)
                                                <img src="{{ Storage::url($s->foto) }}"
                                                    class="w-10 h-10 rounded-xl object-cover border border-slate-200"
                                                    alt="{{ $s->nama }}">
                                            @else
                                                <img src="/assets/default-avatar.svg" class="w-10 h-10 rounded-xl bg-emerald-50">
                                            @endif
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <p class="text-sm font-bold text-slate-900 dark:text-white">
                                                        {{ $s->nama }}
                                                    </p>
                                                    @if ($s->is_mutasi_masuk)
                                                        <span 
                                                            class="px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400"
                                                            title="Siswa Mutasi dari {{ $s->sekolah_asal_mutasi }}">
                                                            <i data-lucide="arrow-right-circle" class="w-3 h-3 inline -mt-0.5"></i>
                                                            MUTASI
                                                        </span>
                                                    @endif
                                                </div>
                                                <p class="text-[10px] text-slate-400 font-medium">{{ $s->nisn ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- IDENTITAS --}}
                                    <td class="px-6 py-5">
                                        <p class="text-xs font-mono font-bold text-slate-600 dark:text-slate-400">
                                            {{ $s->nis ?? '-' }}
                                        </p>
                                        <p class="text-[10px] text-slate-400 italic">NIS</p>
                                    </td>

                                    {{-- KELAS --}}
                                    <td class="px-6 py-5">
                                        <span
                                            class="px-3 py-1 rounded-lg text-[10px] font-bold bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                                            {{ $s->kelas_nama ?? 'Belum ada' }}
                                        </span>
                                    </td>

                                    {{-- GENDER --}}
                                    <td class="px-6 py-5">
                                        @php
                                            $genderClass =
                                                $s->jenis_kelamin == 'L'
                                                ? 'bg-sky-50 text-sky-600 dark:bg-sky-500/10 dark:text-sky-400'
                                                : 'bg-pink-50 text-pink-600 dark:bg-pink-500/10 dark:text-pink-400';
                                        @endphp
                                        <span class="px-3 py-1 rounded-lg text-[10px] font-bold {{ $genderClass }}">
                                            {{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </td>

                                    {{-- STATUS --}}
                                    <td class="px-6 py-5">
                                        @php
                                            $statusMap = [
                                                'aktif' => ['text-emerald-500', 'bg-emerald-500'],
                                                'lulus' => ['text-blue-500', 'bg-blue-500'],
                                                'pindah' => ['text-amber-500', 'bg-amber-500'],
                                                'nonaktif' => ['text-rose-500', 'bg-rose-500'],
                                            ];
                                            [$statusClass, $dot] = $statusMap[$s->status] ?? [
                                                'text-slate-500',
                                                'bg-slate-500',
                                            ];
                                        @endphp
                                        <span
                                            class="flex items-center gap-1.5 text-[10px] font-black uppercase tracking-widest {{ $statusClass }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $dot }}"></span>
                                            {{ ucfirst($s->status) }}
                                        </span>
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="pl-6 pr-10 py-5 text-right">
                                        <div class="flex items-center justify-end gap-1">

                                            {{-- Cetak PDF satu siswa --}}
                                            <a href="{{ route('operator.dataSiswa.pdf', $s->id) }}" target="_blank"
                                                class="p-2 hover:bg-purple-50 dark:hover:bg-purple-500/10 text-slate-400 hover:text-purple-500 rounded-lg transition-colors"
                                                title="Cetak Kartu PDF">
                                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                            </a>

                                            {{-- Lihat Kartu --}}
                                            <button @click='openKartuSiswa(@json($s))'
                                                class="p-2 hover:bg-blue-50 dark:hover:bg-blue-500/10 text-slate-400 hover:text-blue-500 rounded-lg transition-colors"
                                                title="Kartu Identitas">
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                            </button>

                                            {{-- Mutasi --}}
                                            @if ($s->status === 'aktif')
                                                <button @click='openMutasiModal({{ $s->id }}, {{ json_encode($s->nama) }})'
                                                    class="p-2 hover:bg-amber-50 dark:hover:bg-amber-500/10 text-slate-400 hover:text-amber-500 rounded-lg transition-colors"
                                                    title="Mutasi / Kelulusan">
                                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                                </button>
                                            @endif

                                            {{-- Aktifkan Kembali (untuk siswa non-aktif) --}}
                                            @if (in_array($s->status, ['pindah', 'lulus', 'nonaktif']))
                                                <button @click='openReactivateModal({{ $s->id }}, {{ json_encode($s->nama) }})'
                                                    class="p-2 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors"
                                                    title="Aktifkan Kembali">
                                                    <i data-lucide="undo-2" class="w-4 h-4"></i>
                                                </button>
                                            @endif

                                            {{-- Edit --}}
                                            <button @click='editSiswa(@json($s))'
                                                class="p-2 hover:bg-amber-50 dark:hover:bg-amber-500/10 text-slate-400 hover:text-amber-500 rounded-lg transition-colors"
                                                title="Edit Data">
                                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                                            </button>

                                            {{-- Hapus --}}
                                            <button @click="deleteSiswa({{ $s->id }})" :disabled="isDeleting === {{ $s->id }}"
                                                class="p-2 hover:bg-rose-50 dark:hover:bg-rose-500/10 text-slate-400 hover:text-rose-500 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                                title="Hapus">
                                                <i x-show="isDeleting !== {{ $s->id }}" data-lucide="trash-2"
                                                    class="w-4 h-4"></i>
                                                <i x-show="isDeleting === {{ $s->id }}" data-lucide="loader-2"
                                                    class="w-4 h-4 animate-spin" x-cloak></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-20 text-center">
                                        <div class="flex flex-col items-center gap-3 text-slate-400">
                                            <i data-lucide="users" class="w-12 h-12 opacity-30"></i>
                                            <p class="font-bold text-sm">Tidak ada data siswa ditemukan</p>
                                            <p class="text-xs">Coba ubah filter pencarian</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div
                    class="px-10 py-8 bg-slate-50/30 dark:bg-slate-800/20 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">
                        Menampilkan <span
                            class="text-slate-900 dark:text-white">{{ $siswa->total() > 0 ? $siswa->firstItem() . '–' . $siswa->lastItem() : '0' }}</span>
                        dari {{ number_format($siswa->total()) }} Siswa
                    </p>
                    <div class="flex items-center gap-1.5">
                        {{ $siswa->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>


        {{-- ============================================================ --}}
        @include('operator.partials.siswa._modalImport')





        {{-- ============================================================ --}}
        @include('operator.partials.siswa._modalMutasi')


        {{-- ============================================================ --}}
        @include('operator.partials.siswa._modalBerkasSiswa')

        {{-- ============================================================ --}}
        @include('operator.partials.siswa._modalPrestasiSiswa')

        {{-- ============================================================ --}}
        @include('operator.partials.siswa._modalBeasiswaSiswa')

        {{-- ============================================================ --}}
        @include('operator.partials.siswa._modalReactivate')


        {{-- ============================================================ --}}
        @include('operator.partials.siswa._modalTrash')


        @include('operator.partials.siswa._modalFormSiswa')

        {{-- =========================================================== = --}}
        {{-- MODAL KARTU IDENTITAS SISWA (tidak berubah) --}}
        {{-- ============================================================ --}}
        <div id="modalKartuSiswaWrapper">
            @include('operator.partials._modalKartuSiswa')
        </div>


    </div>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('siswaPanel', () => ({
                    currentSiswaForModal: null,
                    isDeleting: null,
                    importFileName: '',
                    importMode: 'excel',
                    fpLahirSiswa: null,
                    fpMasukSiswa: null,
                    fpMutasi: null,

                    init() {
                        window.appDataSiswa = this;
                        this.fpLahirSiswa = flatpickr("#tanggal_lahir_siswa", {
                            altInput: true,
                            altFormat: "d/m/Y",
                            dateFormat: "Y-m-d",
                            allowInput: true,
                            maxDate: "today"
                        });
                        this.fpMasukSiswa = flatpickr("#tanggal_masuk_siswa", {
                            altInput: true,
                            altFormat: "d/m/Y",
                            dateFormat: "Y-m-d",
                            allowInput: true,
                            maxDate: "today"
                        });
                        this.fpMutasi = flatpickr("#tanggal_keluar_mutasi", {
                            altInput: true,
                            altFormat: "d/m/Y",
                            dateFormat: "Y-m-d",
                            allowInput: true,
                            maxDate: "today"
                        });
                        this.bindLiveValidation();

                        // Toggle sekolah_tujuan berdasarkan jenis mutasi
                        document.getElementById('jenis_mutasi_select')?.addEventListener('change', (e) => {
                            const wrap = document.getElementById('sekolah_tujuan_wrap');
                            wrap.style.display = e.target.value === 'mutasi_keluar' ? '' : 'none';
                        });

                        document.addEventListener('keydown', e => {
                            if (e.key === 'Escape') {
                                this.closeSiswaModal();
                                this.closeKartuSiswa();
                                this.closeRiwayatModal();
                                this.closeMutasiModal();
                                this.closeImportModal();
                            }
                        });

                        // TAB LOGIC UNTUK KARTU SISWA
                        setTimeout(() => {
                            const tabBtns = document.querySelectorAll('.kartu-siswa-tab-btn');
                            const tabContents = document.querySelectorAll(
                                '.kartu-siswa-tab-content');
                            tabBtns.forEach(btn => {
                                btn.addEventListener('click', () => {
                                    tabBtns.forEach(b => b.classList.remove(
                                        'active'));
                                    tabContents.forEach(c => c.classList.remove(
                                        'active'));
                                    btn.classList.add('active');
                                    document.getElementById(btn.dataset.target)
                                        .classList.add('active');
                                });
                            });
                        }, 500);
                    },

                    // ── IMPORT MODAL ─────────────────────────────
                    openImportModal() {
                        document.getElementById('importModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    },
                    closeImportModal() {
                        document.getElementById('importModal').classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    },
                    setImportFile(e) {
                        this.importFileName = e.target.files[0]?.name ?? '';
                    },
                    handleDropImport(e) {
                        const file = e.dataTransfer.files[0];
                        if (!file) return;
                        const input = document.getElementById('fileImportInput');
                        const dt = new DataTransfer();
                        dt.items.add(file);
                        input.files = dt.files;
                        this.importFileName = file.name;
                    },



                    // ── MUTASI MODAL ──────────────────────────────
                    openMutasiModal(siswaId, siswaNama) {
                        document.getElementById('mutasi_siswa_nama').textContent = siswaNama;
                        document.getElementById('formMutasi').action =
                            `/operator/data-siswa/${siswaId}/mutasi`;
                        document.getElementById('mutasiModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    },
                    closeMutasiModal() {
                        document.getElementById('mutasiModal').classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    },

                    // ── REACTIVATE MODAL ─────────────────────────
                    openReactivateModal(siswaId, siswaNama) {
                        document.getElementById('reactivate_nama').textContent = siswaNama;
                        document.getElementById('formReactivate').action =
                            `/operator/data-siswa/${siswaId}/reactivate`;
                        document.getElementById('reactivateModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';

                        // Init flatpickr untuk tanggal masuk kembali
                        if (!this.fpReactivate) {
                            this.fpReactivate = flatpickr('#tanggal_masuk_reactivate', {
                                dateFormat: 'Y-m-d',
                                altInput: true,
                                altFormat: 'j F Y',
                                defaultDate: new Date(),
                                locale: 'id',
                            });
                        }
                        this.fpReactivate.setDate(new Date());
                    },
                    closeReactivateModal() {
                        document.getElementById('reactivateModal').classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    },

                    // ── BERKAS DIGITAL MODAL ─────────────────────
                    openBerkasModal(siswaId, siswaNama) {
                        this.currentSiswaId = siswaId;
                        document.getElementById('berkas_siswa_nama').textContent = siswaNama;
                        document.getElementById('berkas_siswa_id').value = siswaId;
                        document.getElementById('formUploadBerkas').action =
                            `/operator/data-siswa/${siswaId}/berkas`;
                        document.getElementById('berkasSiswaModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';

                        this.loadBerkas(siswaId);
                    },
                    closeBerkasModal() {
                        document.getElementById('berkasSiswaModal').classList.add('hidden');
                        document.body.style.overflow = 'auto';
                        document.getElementById('formUploadBerkas').reset();
                    },
                    loadBerkas(siswaId) {
                        const tbody = document.getElementById('berkasTableBody');
                        tbody.innerHTML = `
                                                                                    <tr>
                                                                                        <td colspan="4" class="px-5 py-10 text-center">
                                                                                            <div class="flex flex-col items-center justify-center gap-2">
                                                                                                <i data-lucide="loader-2" class="w-6 h-6 text-violet-500 animate-spin"></i>
                                                                                                <p class="text-xs text-slate-500 font-medium">Memuat data berkas...</p>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                `;
                        lucide.createIcons();

                        fetch(`/operator/data-siswa/${siswaId}/berkas`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            credentials: 'same-origin'
                        })
                            .then(res => res.json())
                            .then(data => {
                                if (!data.berkas || data.berkas.length === 0) {
                                    tbody.innerHTML = `
                                                                                            <tr>
                                                                                                <td colspan="4" class="px-5 py-10 text-center">
                                                                                                    <div class="flex flex-col items-center gap-3 text-slate-400">
                                                                                                        <i data-lucide="file-question" class="w-10 h-10 opacity-30"></i>
                                                                                                        <p class="font-bold text-sm">Belum ada berkas digital</p>
                                                                                                        <p class="text-xs">Silakan unggah berkas melalui form di atas</p>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        `;
                                    lucide.createIcons();
                                    return;
                                }

                                tbody.innerHTML = data.berkas.map(b => `
                                                                                        <tr class="border-b border-slate-50 dark:border-slate-800/50 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                                                                            <td class="px-5 py-4 w-1/3">
                                                                                                <div class="flex items-center gap-3">
                                                                                                    <div class="w-8 h-8 rounded-lg bg-violet-50 dark:bg-violet-500/10 flex items-center justify-center shrink-0">
                                                                                                        <i data-lucide="file" class="w-4 h-4 text-violet-500"></i>
                                                                                                    </div>
                                                                                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-widest whitespace-nowrap">${b.jenis_label}</span>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="px-5 py-4 w-1/3">
                                                                                                <p class="text-xs font-medium text-slate-700 dark:text-slate-300 max-w-[250px] truncate" title="${b.nama_file_asli}">${b.nama_file_asli}</p>
                                                                                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-1">Diperbarui: ${b.updated_at}</p>
                                                                                            </td>
                                                                                            <td class="px-5 py-4">
                                                                                                <span class="px-2 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                                                                                                    ${b.ukuran}
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="px-5 py-4 text-right">
                                                                                                <div class="flex items-center justify-end gap-1">
                                                                                                    <a href="/operator/data-siswa/${siswaId}/berkas/${b.id}/view" target="_blank"
                                                                                                        class="p-2 hover:bg-blue-50 dark:hover:bg-blue-500/10 text-slate-400 hover:text-blue-500 rounded-lg transition-colors" title="Lihat">
                                                                                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                                                                                    </a>
                                                                                                    <a href="/operator/data-siswa/${siswaId}/berkas/${b.id}/download"
                                                                                                        class="p-2 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors" title="Unduh">
                                                                                                        <i data-lucide="download" class="w-4 h-4"></i>
                                                                                                    </a>
                                                                                                    <form action="/operator/data-siswa/${siswaId}/berkas/${b.id}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berkas ini secara permanen?')">
                                                                                                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                                                        <button type="submit" class="p-2 hover:bg-rose-50 dark:hover:bg-rose-500/10 text-slate-400 hover:text-rose-500 rounded-lg transition-colors" title="Hapus">
                                                                                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                                                                        </button>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    `).join('');
                                lucide.createIcons();
                            })
                            .catch(err => {
                                tbody.innerHTML =
                                    `<tr><td colspan="4" class="px-5 py-4 text-center text-xs text-rose-500 font-medium">Gagal memuat data berkas.</td></tr>`;
                            });
                    },


                    // ── STEP SLIDER ───────────────────────────────
                    moveSiswaSlider(step) {
                        const slider = document.getElementById('sliderSiswa');
                        const line = document.getElementById('activeLineSiswa');
                        const circles = document.querySelectorAll('.step-circle-siswa');
                        const texts = document.querySelectorAll('.step-item-siswa span');
                        slider.style.transform = `translateX(-${(step - 1) * 20}%)`;
                        line.style.width = `${((step - 1) / 4) * 100}%`;
                        circles.forEach((circle, i) => {
                            if (i + 1 < step) {
                                circle.innerHTML = '✓';
                                circle.className =
                                    'step-circle-siswa w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold transition-all';
                                if (texts[i]) texts[i].className =
                                    'text-[8px] font-black uppercase text-emerald-600 tracking-wider hidden xs:block';
                            } else if (i + 1 === step) {
                                circle.innerHTML = step;
                                circle.className =
                                    'step-circle-siswa w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-bold shadow-lg shadow-emerald-500/30 transition-all';
                                if (texts[i]) texts[i].className =
                                    'text-[8px] font-black uppercase text-emerald-600 tracking-wider hidden xs:block';
                            } else {
                                circle.innerHTML = i + 1;
                                circle.className =
                                    'step-circle-siswa w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-400 flex items-center justify-center font-bold transition-all';
                                if (texts[i]) texts[i].className =
                                    'text-[8px] font-black uppercase text-slate-400 tracking-wider hidden xs:block';
                            }
                        });
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    },

                    STEP_RULES_SISWA: {
                        1: [
                            { name: 'nis', label: 'NIS', type: 'required', max_length: 20 },
                            { name: 'nisn', label: 'NISN', type: 'optional_digits', exact_length: 10 },
                            { name: 'nama', label: 'Nama Lengkap', type: 'required', max_length: 255 },
                            { name: 'tempat_lahir', label: 'Tempat Lahir', type: 'required' },
                            { name: 'tanggal_lahir', label: 'Tanggal Lahir', type: 'required' },
                            { name: 'jenis_kelamin', label: 'Jenis Kelamin', type: 'select' },
                            { name: 'agama', label: 'Agama', type: 'select' },          // ← WAJIB
                            { name: 'kewarganegaraan', label: 'Kewarganegaraan', type: 'optional' },
                            { name: 'no_registrasi_akta_kelahiran', label: 'No Registrasi Akta', type: 'optional', max_length: 100 },
                            { name: 'asal_sekolah', label: 'Asal Sekolah', type: 'optional', max_length: 255 },
                        ],
                        2: [
                            { name: 'nik_ayah', label: 'NIK Ayah', type: 'optional_digits', exact_length: 16 },
                            { name: 'nik_ibu', label: 'NIK Ibu', type: 'optional_digits', exact_length: 16 },
                            { name: 'nik_wali', label: 'NIK Wali', type: 'optional_digits', exact_length: 16 },
                            { name: 'no_hp_ortu', label: 'No HP Orang Tua', type: 'required_phone' },  // ← WAJIB
                            { name: 'alamat', label: 'Alamat Orang Tua', type: 'required' },        // ← WAJIB
                            { name: 'kebutuhan_khusus_ayah', label: 'Kebutuhan Khusus Ayah', type: 'optional', max_length: 100 },
                            { name: 'kebutuhan_khusus_ibu', label: 'Kebutuhan Khusus Ibu', type: 'optional', max_length: 100 },
                            // Kondisional: no_hp_wali wajib jika nama_wali diisi — ditangani di validateStepSiswa
                        ],
                        3: [
                            { name: 'alamat_siswa', label: 'Alamat Siswa', type: 'required' },        // ← WAJIB
                            { name: 'kelurahan', label: 'Kelurahan', type: 'required' },        // ← WAJIB
                            { name: 'kecamatan', label: 'Kecamatan', type: 'required' },        // ← WAJIB
                            { name: 'rt', label: 'RT', type: 'optional', max_length: 5 },
                            { name: 'rw', label: 'RW', type: 'optional', max_length: 5 },
                            { name: 'kode_pos', label: 'Kode Pos', type: 'optional', max_length: 10 },
                            { name: 'lintang', label: 'Lintang', type: 'optional', min_value: -90, max_value: 90 },
                            { name: 'bujur', label: 'Bujur', type: 'optional', min_value: -180, max_value: 180 },
                            { name: 'anak_ke', label: 'Anak Ke', type: 'optional', max_value: 20 },
                            { name: 'jumlah_saudara', label: 'Jumlah Saudara', type: 'optional', max_value: 20 },
                            { name: 'jarak_tempat_tinggal', label: 'Jarak (km)', type: 'optional', max_value: 999 },
                            { name: 'waktu_tempuh', label: 'Waktu Tempuh', type: 'optional', max_value: 999 },
                            { name: 'moda_transportasi', label: 'Moda Transportasi', type: 'optional' },
                            { name: 'hobi', label: 'Hobi', type: 'optional', max_length: 100 },
                            { name: 'cita_cita', label: 'Cita-cita', type: 'optional', max_length: 100 },
                            { name: 'no_telp_siswa', label: 'No Telp Siswa', type: 'optional', max_length: 20 },
                            { name: 'hp_siswa', label: 'HP Siswa', type: 'optional', max_length: 20 },
                            { name: 'email_siswa', label: 'Email Siswa', type: 'optional_email' },
                        ],
                        4: [
                            { name: 'kelas_id', label: 'Kelas', type: 'optional' },
                            { name: 'tahun_ajaran_id', label: 'Tahun Ajaran', type: 'select' },
                            { name: 'status', label: 'Status Siswa', type: 'select' },
                            { name: 'tanggal_masuk', label: 'Tanggal Masuk', type: 'required' },    // ← WAJIB
                            { name: 'nik', label: 'NIK', type: 'optional_digits', exact_length: 16 },
                            { name: 'no_kk', label: 'No KK', type: 'optional_digits', exact_length: 16 },
                            { name: 'golongan_darah', label: 'Golongan Darah', type: 'optional' },
                            { name: 'tinggi_badan', label: 'Tinggi Badan (cm)', type: 'optional', max_value: 250 },
                            { name: 'berat_badan', label: 'Berat Badan (kg)', type: 'optional', max_value: 200 },
                            { name: 'lingkar_kepala', label: 'Lingkar Kepala', type: 'optional', max_value: 99.99 },
                            { name: 'no_kps_pkh', label: 'No KPS/PKH', type: 'optional', max_length: 100 },
                            { name: 'no_kip', label: 'No KIP', type: 'optional', max_length: 100 },
                            { name: 'nama_tertera_di_kip', label: 'Nama di KIP', type: 'optional', max_length: 150 },
                            // Kondisional KPS/KIP/PIP ditangani di validateStepSiswa
                        ],
                        5: []
                    },

                    // ── GANTI bagian getErrMsgSiswa dengan versi ini ──
                    getErrMsgSiswa(rule, value) {
                        const valStr = (value ?? '').toString().trim();
                        const isOptional = ['optional', 'optional_phone', 'optional_email', 'optional_digits'].includes(rule.type);
                        if (isOptional && !valStr) return null;

                        switch (rule.type) {
                            case 'required':
                                if (!valStr) return `${rule.label} wajib diisi.`;
                                break;
                            case 'select':
                                if (!valStr) return `${rule.label} wajib dipilih.`;
                                break;
                            case 'required_phone':                                                      // ← BARU
                                if (!valStr) return `${rule.label} wajib diisi.`;
                                if (!/^[0-9]{8,15}$/.test(valStr)) return `${rule.label} hanya angka, 8–15 digit.`;
                                break;
                            case 'optional_phone':
                                if (!valStr) return null;
                                if (!/^[0-9]{8,15}$/.test(valStr)) return `${rule.label} hanya angka, 8–15 digit.`;
                                break;
                            case 'optional_email':
                                if (!valStr) return null;
                                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valStr)) return `${rule.label} tidak valid.`;
                                break;
                            case 'optional_digits':                                                     // ← BARU
                                if (!valStr) return null;
                                if (!/^\d+$/.test(valStr) || valStr.length !== rule.exact_length)
                                    return `${rule.label} harus tepat ${rule.exact_length} digit angka.`;
                                break;
                        }

                        if (valStr) {
                            if (rule.max_length && valStr.length > rule.max_length)
                                return `${rule.label} maksimal ${rule.max_length} karakter.`;
                            if (rule.max_value !== undefined) {
                                const num = parseFloat(valStr);
                                if (isNaN(num)) return `${rule.label} harus berupa angka.`;
                                if (num > rule.max_value) return `${rule.label} maksimal ${rule.max_value}.`;
                            }
                            if (rule.min_value !== undefined) {
                                const num = parseFloat(valStr);
                                if (isNaN(num)) return `${rule.label} harus berupa angka.`;
                                if (num < rule.min_value) return `${rule.label} minimal ${rule.min_value}.`;
                            }
                        }
                        return null;
                    },

                    setFieldErrSiswa(el, msg) {
                        el.classList.add('border-red-400', 'bg-red-50');
                        el.classList.remove('border-slate-200');
                        const old = el.parentElement.querySelector('.field-error-siswa');
                        if (old) old.remove();
                        const err = document.createElement('p');
                        err.className = 'field-error-siswa text-[10px] text-red-500 font-bold mt-1';
                        err.textContent = msg;
                        el.parentElement.appendChild(err);
                    },

                    clearFieldErrSiswa(el) {
                        el.classList.remove('border-red-400', 'bg-red-50');
                        el.classList.add('border-slate-200');
                        el.parentElement.querySelector('.field-error-siswa')?.remove();
                    },

                    validateStepSiswa(step) {
                        const rules = this.STEP_RULES_SISWA[step] || [];
                        let errors = [];
                        rules.forEach(rule => {
                            const el = document.querySelector(`#formSiswaMaster [name="${rule.name}"]`);
                            if (!el) return;
                            const msg = this.getErrMsgSiswa(rule, el.value);
                            if (msg) { this.setFieldErrSiswa(el, msg); errors.push(msg); }
                            else this.clearFieldErrSiswa(el);
                        });

                        // ── Step 2: Kondisional orang tua ──────────────────────────────────
                        if (step === 2) {
                            const ayah = document.querySelector(`#formSiswaMaster [name="nama_ayah"]`);
                            const ibu = document.querySelector(`#formSiswaMaster [name="nama_ibu"]`);
                            const wali = document.querySelector(`#formSiswaMaster [name="nama_wali"]`);
                            const hpWali = document.querySelector(`#formSiswaMaster [name="no_hp_wali"]`);

                            // Minimal satu orang tua atau wali
                            if (!ayah?.value.trim() && !ibu?.value.trim() && !wali?.value.trim()) {
                                const msg = 'Wajib mengisi Nama Wali jika Nama Ayah & Ibu kosong.';
                                [ayah, ibu, wali].forEach(el => el && this.setFieldErrSiswa(el, 'Wajib diisi atau isi Nama Wali'));
                                errors.push(msg);
                            } else {
                                [ayah, ibu, wali].forEach(el => el && this.clearFieldErrSiswa(el));
                            }

                            // No HP Wali wajib jika Nama Wali diisi                               // ← BARU
                            if (wali?.value.trim() && hpWali && !hpWali.value.trim()) {
                                this.setFieldErrSiswa(hpWali, 'No HP Wali wajib diisi jika ada data Wali.');
                                errors.push('No HP Wali wajib diisi.');
                            } else if (hpWali) {
                                this.clearFieldErrSiswa(hpWali);
                            }
                        }

                        // ── Step 4: Kondisional program kesejahteraan ───────────────────────
                        if (step === 4) {                                                           // ← BARU
                            const getVal = name => document.querySelector(`#formSiswaMaster [name="${name}"]`)?.value ?? '';

                            // No KPS/PKH wajib jika penerima_kps_pkh = 1
                            if (getVal('penerima_kps_pkh') === '1') {
                                const el = document.querySelector(`#formSiswaMaster [name="no_kps_pkh"]`);
                                if (el && !el.value.trim()) {
                                    this.setFieldErrSiswa(el, 'No KPS/PKH wajib diisi jika penerima KPS/PKH.');
                                    errors.push('No KPS/PKH wajib diisi.');
                                }
                            }

                            // No KIP & Nama di KIP wajib jika penerima_kip = 1
                            if (getVal('penerima_kip') === '1') {
                                ['no_kip', 'nama_tertera_di_kip'].forEach(name => {
                                    const el = document.querySelector(`#formSiswaMaster [name="${name}"]`);
                                    const label = name === 'no_kip' ? 'No KIP' : 'Nama Tertera di KIP';
                                    if (el && !el.value.trim()) {
                                        this.setFieldErrSiswa(el, `${label} wajib diisi jika penerima KIP.`);
                                        errors.push(`${label} wajib diisi.`);
                                    }
                                });
                            }

                            // Alasan Layak PIP wajib jika layak_pip = 1
                            if (getVal('layak_pip') === '1') {
                                const el = document.querySelector(`#formSiswaMaster [name="alasan_layak_pip"]`);
                                if (el && !el.value.trim()) {
                                    this.setFieldErrSiswa(el, 'Alasan Layak PIP wajib diisi jika layak PIP.');
                                    errors.push('Alasan Layak PIP wajib diisi.');
                                }
                            }
                        }

                        if (errors.length > 0) {
                            this.showToastSiswa(`${errors.length} field belum valid.`);
                            return false;
                        }
                        return true;
                    },

                    validateSubmitSiswa() {
                        let valid = true;
                        for (let i = 1; i <= 5; i++) {
                            if (!this.validateStepSiswa(i)) {
                                valid = false;
                                this.moveSiswaSlider(i);
                                break; // go to the first invalid step
                            }
                        }
                        if (valid) {
                            document.getElementById('formSiswaMaster').submit();
                        } else {
                            this.showToastSiswa('Terdapat field yang belum valid. Mohon periksa kembali.');
                        }
                    },

                    clearStepErrSiswa(step) {
                        (this.STEP_RULES_SISWA[step] || []).forEach(rule => {
                            const el = document.querySelector(
                                `#formSiswaMaster [name="${rule.name}"]`);
                            if (el) this.clearFieldErrSiswa(el);
                        });
                    },

                    goToStepSiswa(from, to) {
                        if (to > from && !this.validateStepSiswa(from)) return;
                        if (to < from) this.clearStepErrSiswa(from);
                        if (to === 5) {
                            const get = name => document.querySelector(`#formSiswaMaster [name="${name}"]`)
                                ?.value ?? '—';
                            const getText = name => {
                                const el = document.querySelector(`#formSiswaMaster [name="${name}"]`);
                                if (!el) return '—';
                                if (el.tagName === 'SELECT') return el.options[el.selectedIndex]
                                    ?.text || '—';
                                return el.value || '—';
                            };
                            const set = (id, v) => {
                                const el = document.getElementById(id);
                                if (el) el.textContent = v || '—';
                            };
                            const jkVal = get('jenis_kelamin');

                            set('review_nama_siswa', get('nama'));
                            set('review_nisn_siswa', [get('nisn'), get('nis')].filter(v => v && v !== '—')
                                .join(' / '));
                            set('review_ttl_siswa', [get('tempat_lahir'), get('tanggal_lahir')].filter(
                                Boolean).join(', '));
                            set('review_jk_siswa', jkVal === 'L' ? 'Laki-laki' : jkVal === 'P' ?
                                'Perempuan' : '—');
                            set('review_ayah_siswa', get('nama_ayah'));
                            set('review_ibu_siswa', get('nama_ibu'));
                            set('review_pendidikan_ayah', getText('pendidikan_ayah'));
                            set('review_pendidikan_ibu', getText('pendidikan_ibu'));
                            set('review_hp_siswa', get('no_hp_ortu'));
                            // Domisili & Periodik
                            set('review_alamat_siswa', get('alamat_siswa'));
                            set('review_kelurahan', get('kelurahan'));
                            set('review_kecamatan', get('kecamatan'));
                            const anakKe = get('anak_ke');
                            const jmlSaudara = get('jumlah_saudara');
                            set('review_anak_saudara', [anakKe !== '—' ? `Ke-${anakKe}` : null,
                            jmlSaudara !== '—' ? `${jmlSaudara} saudara` : null
                            ].filter(Boolean).join(' dari ') || '—');
                            set('review_transportasi', getText('moda_transportasi'));
                            set('review_koordinat', [get('lintang'), get('bujur')].filter(v => v && v !== '—')
                                .join(', ') || '—');
                            set('review_hobi_cita', [get('hobi'), get('cita_cita')].filter(v => v && v !== '—')
                                .join(' / ') || '—');
                            // Akademik
                            set('review_kelas_siswa', getText('kelas_id'));
                            set('review_status_siswa', getText('status'));
                            set('review_ta_siswa', getText('tahun_ajaran_id'));
                            set('review_masuk_siswa', get('tanggal_masuk'));
                        }
                        this.moveSiswaSlider(to);
                    },

                    showToastSiswa(msg) {
                        const t = document.getElementById('toastErrorSiswa');
                        t.innerText = msg;
                        t.classList.remove('hidden');
                        clearTimeout(t._timer);
                        t._timer = setTimeout(() => t.classList.add('hidden'), 3000);
                    },

                    previewImageSiswa(input) {
                        const preview = document.getElementById('previewFotoSiswa');
                        const placeholder = document.getElementById('placeholderFotoSiswa');
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = e => {
                                preview.src = e.target.result;
                                preview.classList.remove('hidden');
                                placeholder.classList.add('hidden');
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    },

                    openSiswaModal() {
                        const form = document.getElementById('formSiswaMaster');
                        form.action = `{{ route('operator.dataSiswa.store') }}`;
                        form.reset();
                        document.getElementById('methodPutSiswa')?.remove();
                        document.getElementById('previewFotoSiswa').classList.add('hidden');
                        document.getElementById('placeholderFotoSiswa').classList.remove('hidden');
                        for (let i = 1; i <= 5; i++) this.clearStepErrSiswa(i);
                        if (this.fpLahirSiswa) this.fpLahirSiswa.clear();
                        if (this.fpMasukSiswa) this.fpMasukSiswa.clear();
                        this.moveSiswaSlider(1);

                        // ← TAMBAHKAN INI: reset cache options agar toggleMutasiFields rebuild dari awal
                        const kelasSelect = document.querySelector('select[name="kelas_id"]');
                        if (kelasSelect) delete kelasSelect.dataset.allOptions;

                        document.getElementById('siswaModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                        setTimeout(toggleMutasiFields, 100);
                    },

                    closeSiswaModal() {
                        document.getElementById('siswaModal').classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    },

                    editSiswa(siswa) {
                        const form = document.getElementById('formSiswaMaster');
                        form.reset();
                        for (let i = 1; i <= 5; i++) this.clearStepErrSiswa(i);
                        form.action = `/operator/data-siswa/${siswa.id}`;
                        document.getElementById('methodPutSiswa')?.remove();
                        const method = document.createElement('input');
                        method.type = 'hidden';
                        method.name = '_method';
                        method.value = 'PUT';
                        method.id = 'methodPutSiswa';
                        form.appendChild(method);

                        const fields = ['nisn', 'nis', 'nama', 'tempat_lahir', 'jenis_kelamin', 'agama',
                            'kewarganegaraan', 'no_registrasi_akta_kelahiran',
                            'nama_ayah', 'pekerjaan_ayah', 'penghasilan_ayah',
                            'nik_ayah', 'tahun_lahir_ayah', 'pendidikan_ayah', 'kebutuhan_khusus_ayah',
                            'nama_ibu', 'pekerjaan_ibu', 'penghasilan_ibu',
                            'nik_ibu', 'tahun_lahir_ibu', 'pendidikan_ibu', 'kebutuhan_khusus_ibu',
                            'no_hp_ortu', 'alamat', 'nama_wali',
                            'pekerjaan_wali', 'penghasilan_wali', 'pendidikan_wali', 'nik_wali',
                            'tahun_lahir_wali',
                            'no_hp_wali', 'alamat_wali',
                            'kelas_id', 'status', 'nik', 'no_kk', 'asal_sekolah', 'golongan_darah',
                            'tinggi_badan', 'berat_badan', 'lingkar_kepala', 'kebutuhan_khusus', 'tahun_ajaran_id',
                            'riwayat_penyakit', 'catatan_kesehatan', 'user_id',
                            'alamat_siswa', 'rt', 'rw', 'kelurahan', 'kecamatan', 'kode_pos',
                            'lintang', 'bujur', 'hobi', 'cita_cita', 'no_telp_siswa', 'hp_siswa', 'email_siswa',
                            'anak_ke', 'jumlah_saudara',
                            'jarak_tempat_tinggal', 'waktu_tempuh', 'moda_transportasi',
                            'penerima_kps_pkh', 'no_kps_pkh', 'layak_pip', 'alasan_layak_pip',
                            'penerima_kip', 'no_kip', 'nama_tertera_di_kip'
                        ];
                        fields.forEach(f => {
                            const el = document.querySelector(`#formSiswaMaster [name="${f}"]`);
                            if (el) el.value = siswa[f] ?? '';
                        });

                        if (siswa.tanggal_lahir) this.fpLahirSiswa.setDate(siswa.tanggal_lahir);
                        if (siswa.tanggal_masuk) this.fpMasukSiswa.setDate(siswa.tanggal_masuk);

                        const preview = document.getElementById('previewFotoSiswa');
                        const placeholder = document.getElementById('placeholderFotoSiswa');
                        preview.src = siswa.foto ?
                            `/storage/${siswa.foto}` :
                            `/assets/default-avatar.svg`;
                        preview.classList.remove('hidden');
                        placeholder.classList.add('hidden');

                        this.moveSiswaSlider(1);
                        document.getElementById('siswaModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    },

                    deleteSiswa(id) {
                        if (!confirm('Yakin hapus data siswa ini? Data akan dipindahkan ke Recycle Bin.'))
                            return;
                        this.isDeleting = id;
                        fetch(`/operator/data-siswa/${id}`, {
                            method: 'DELETE',
                            credentials: 'same-origin',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            }
                        }).then(() => location.reload()).finally(() => { this.isDeleting = null; });
                    },

                    openKartuSiswa(siswa) {
                        this.currentSiswaForModal = siswa;

                        const fmt = tgl => tgl ? new Date(tgl).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        }) : '-';
                        const set = (id, val) => {
                            const el = document.getElementById(id);
                            if (el) el.innerText = val ?? '-';
                        };

                        document.getElementById('kartu_siswa_foto').src = siswa.foto ?
                            `/storage/${siswa.foto}` :
                            `/assets/default-avatar.svg`;

                        // QR Code Siswa
                        const qrCode = document.getElementById('kartu_siswa_qr');
                        if (qrCode) {
                            if (siswa.nis) {
                                qrCode.src =
                                    `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Siswa-${siswa.nis}&color=0f172a&bgcolor=ffffff`;
                            } else {
                                qrCode.src = '';
                            }
                        }

                        set('kartu_siswa_nama_pendek', siswa.nama);
                        set('kartu_siswa_nama_lengkap', siswa.nama);
                        set('kartu_siswa_nisn', siswa.nisn || '-');
                        set('kartu_siswa_nisn_full', siswa.nisn || '-');
                        set('kartu_siswa_nis', siswa.nis || '-');
                        set('kartu_siswa_nis_banner', siswa.nis || '-');
                        set('kartu_siswa_nik', siswa.nik || '-');
                        set('kartu_siswa_no_kk', siswa.no_kk || '-');
                        set('kartu_siswa_kewarganegaraan', siswa.kewarganegaraan || '-');
                        set('kartu_siswa_no_registrasi_akta_kelahiran', siswa.no_registrasi_akta_kelahiran || '-');
                        set('kartu_siswa_jk', siswa.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
                        set('kartu_siswa_agama', siswa.agama);
                        set('kartu_siswa_tempat_lahir', siswa.tempat_lahir || '-');
                        set('kartu_siswa_tgl_lahir', fmt(siswa.tanggal_lahir));
                        set('kartu_siswa_golongan_darah', siswa.golongan_darah || '-');
                        set('kartu_siswa_tinggi_badan', siswa.tinggi_badan ? `${siswa.tinggi_badan} cm` :
                            '-');
                        set('kartu_siswa_berat_badan', siswa.berat_badan ? `${siswa.berat_badan} kg` : '-');
                        set('kartu_siswa_lingkar_kepala', siswa.lingkar_kepala ? `${siswa.lingkar_kepala} cm` : '-');
                        set('kartu_siswa_kebutuhan_khusus', siswa.kebutuhan_khusus || 'Tidak Ada');
                        set('kartu_siswa_riwayat_penyakit', siswa.riwayat_penyakit || 'Tidak Ada');
                        set('kartu_siswa_catatan_kesehatan', siswa.catatan_kesehatan || 'Tidak Ada');

                        set('kartu_siswa_ayah', siswa.nama_ayah || '-');
                        set('kartu_siswa_pekerjaan_ayah', siswa.pekerjaan_ayah || '-');
                        set('kartu_siswa_ibu', siswa.nama_ibu || '-');
                        set('kartu_siswa_pekerjaan_ibu', siswa.pekerjaan_ibu || '-');
                        set('kartu_siswa_hp', siswa.no_hp_ortu || '-');
                        set('kartu_siswa_penghasilan_ayah', siswa.penghasilan_ayah || '-');
                        set('kartu_siswa_penghasilan_ibu', siswa.penghasilan_ibu || '-');
                        set('kartu_siswa_alamat', siswa.alamat || '-');

                        // Dapodik: Domisili Siswa
                        set('kartu_siswa_alamat_siswa', siswa.alamat_siswa || '-');
                        set('kartu_siswa_rt_rw', [siswa.rt, siswa.rw].filter(Boolean).join('/') || '-');
                        set('kartu_siswa_kelurahan', siswa.kelurahan || '-');
                        set('kartu_siswa_kecamatan', siswa.kecamatan || '-');
                        set('kartu_siswa_kode_pos', siswa.kode_pos || '-');
                        set('kartu_siswa_lintang', siswa.lintang || '-');
                        set('kartu_siswa_bujur', siswa.bujur || '-');
                        set('kartu_siswa_anak_ke', siswa.anak_ke ? `Anak ke-${siswa.anak_ke}` : '-');
                        set('kartu_siswa_jumlah_saudara', siswa.jumlah_saudara != null ?
                            `${siswa.jumlah_saudara} saudara` : '-');
                        set('kartu_siswa_jarak', siswa.jarak_tempat_tinggal ?
                            `${siswa.jarak_tempat_tinggal} km` : '-');
                        set('kartu_siswa_waktu_tempuh', siswa.waktu_tempuh ? `${siswa.waktu_tempuh} menit` :
                            '-');
                        set('kartu_siswa_moda_transportasi', siswa.moda_transportasi || '-');
                        set('kartu_siswa_hobi', siswa.hobi || '-');
                        set('kartu_siswa_cita_cita', siswa.cita_cita || '-');
                        set('kartu_siswa_no_telp_siswa', siswa.no_telp_siswa || '-');
                        set('kartu_siswa_hp_siswa', siswa.hp_siswa || '-');
                        set('kartu_siswa_email_siswa', siswa.email_siswa || '-');

                        // Dapodik: Data Orang Tua tambahan
                        set('kartu_siswa_nik_ayah', siswa.nik_ayah || '-');
                        set('kartu_siswa_tahun_lahir_ayah', siswa.tahun_lahir_ayah || '-');
                        set('kartu_siswa_pendidikan_ayah', siswa.pendidikan_ayah || '-');
                        set('kartu_siswa_kebutuhan_khusus_ayah', siswa.kebutuhan_khusus_ayah || 'Tidak Ada');
                        set('kartu_siswa_nik_ibu', siswa.nik_ibu || '-');
                        set('kartu_siswa_tahun_lahir_ibu', siswa.tahun_lahir_ibu || '-');
                        set('kartu_siswa_pendidikan_ibu', siswa.pendidikan_ibu || '-');
                        set('kartu_siswa_kebutuhan_khusus_ibu', siswa.kebutuhan_khusus_ibu || 'Tidak Ada');
                        set('kartu_siswa_pendidikan_wali', siswa.pendidikan_wali || '-');

                        // Dapodik: Program kesejahteraan
                        set('kartu_siswa_penerima_kps_pkh', Number(siswa.penerima_kps_pkh) === 1 ? 'Ya' : 'Tidak');
                        set('kartu_siswa_no_kps_pkh', siswa.no_kps_pkh || '-');
                        set('kartu_siswa_layak_pip', Number(siswa.layak_pip) === 1 ? 'Ya' : 'Tidak');
                        set('kartu_siswa_alasan_layak_pip', siswa.alasan_layak_pip || '-');
                        set('kartu_siswa_penerima_kip', Number(siswa.penerima_kip) === 1 ? 'Ya' : 'Tidak');
                        set('kartu_siswa_no_kip', siswa.no_kip || '-');
                        set('kartu_siswa_nama_tertera_di_kip', siswa.nama_tertera_di_kip || '-');

                        if (siswa.nama_wali) {
                            document.getElementById('section_kartu_wali').style.display = 'grid';
                            set('kartu_siswa_wali_nama', siswa.nama_wali);
                            set('kartu_siswa_pekerjaan_wali', siswa.pekerjaan_wali || '-');
                            set('kartu_siswa_nik_wali', siswa.nik_wali || '-');
                            set('kartu_siswa_tahun_lahir_wali', siswa.tahun_lahir_wali || '-');
                            set('kartu_siswa_hp_wali', siswa.no_hp_wali || '-');
                            set('kartu_siswa_penghasilan_wali', siswa.penghasilan_wali || '-');
                            set('kartu_siswa_alamat_wali', siswa.alamat_wali || '-');
                        } else {
                            document.getElementById('section_kartu_wali').style.display = 'none';
                        }

                        set('kartu_siswa_kelas', siswa.kelas_nama || '-');
                        set('kartu_siswa_kelas_banner', siswa.kelas_nama || '-');
                        set('kartu_siswa_wali', siswa.wali_kelas || '-');
                        set('kartu_siswa_tahun_ajaran_banner', siswa.tahun_ajaran || '-');

                        set('kartu_siswa_asal_sekolah', siswa.asal_sekolah || '-');
                        set('kartu_siswa_tanggal_masuk', fmt(siswa.tanggal_masuk));

                        // ── DATA MUTASI — dinamis per status ─────────────────────────
                        const MUTASI_CFG = {
                            lulus: {
                                iconEl: 'school',
                                iconBg: 'background:#eff6ff; color:#1d4ed8;',
                                judul: 'Data Kelulusan',
                                subjudul: 'Siswa telah menyelesaikan pendidikan di sekolah ini',
                            },
                            pindah: {
                                iconEl: 'transfer_within_a_station',
                                iconBg: 'background:#fff7ed; color:#c2410c;',
                                judul: 'Data Mutasi / Pindah Sekolah',
                                subjudul: 'Siswa pindah ke sekolah lain',
                            },
                            nonaktif: {
                                iconEl: 'person_off',
                                iconBg: 'background:#fff1f2; color:#be123c;',
                                judul: 'Data Penonaktifan / Drop Out',
                                subjudul: 'Siswa dinyatakan tidak aktif atau dikeluarkan',
                            },
                        };

                        const JENIS_LABEL = {
                            lulus: 'Lulus / Tamat',
                            mutasi_keluar: 'Pindah Sekolah',
                            nonaktif: 'Non-Aktif / DO',
                        };

                        const sectionMutasi = document.getElementById('section_siswa_mutasi');
                        if (siswa.status !== 'aktif') {
                            const cfg = MUTASI_CFG[siswa.status] ?? MUTASI_CFG.pindah;

                            // Update icon & teks header section
                            const iconEl = sectionMutasi.querySelector('.kartu-modern-icon');
                            const judulEl = sectionMutasi.querySelector('.kartu-modern-header h3');
                            const subjudulEl = sectionMutasi.querySelector('.kartu-modern-header p');
                            if (iconEl) {
                                iconEl.style.cssText = cfg.iconBg;
                                const span = iconEl.querySelector('span');
                                if (span) span.textContent = cfg.iconEl;
                            }
                            if (judulEl) judulEl.textContent = cfg.judul;
                            if (subjudulEl) subjudulEl.textContent = cfg.subjudul;

                            // Isi field-field mutasi keluar
                            set('kartu_siswa_tanggal_keluar', fmt(siswa.tanggal_keluar));
                            set('kartu_siswa_jenis_mutasi_keluar', JENIS_LABEL[siswa.jenis_mutasi_keluar] ??
                                siswa.jenis_mutasi_keluar ?? '-');
                            set('kartu_siswa_no_surat_mutasi', siswa.no_surat_mutasi || '-');
                            set('kartu_siswa_sekolah_tujuan', siswa.sekolah_tujuan || '-');
                            set('kartu_siswa_alasan_mutasi', siswa.alasan_mutasi || '-');

                            sectionMutasi.style.display = 'block';
                        } else {
                            sectionMutasi.style.display = 'none';
                        }

                        // Section: Mutasi Masuk (untuk siswa pindahan)
                        const sectionMutasiMasuk = document.getElementById('section_siswa_mutasi_masuk');
                        if (sectionMutasiMasuk && siswa.is_mutasi_masuk) {
                            set('kartu_siswa_tanggal_mutasi_masuk', fmt(siswa.tanggal_mutasi_masuk));
                            set('kartu_siswa_sekolah_asal_mutasi', siswa.sekolah_asal_mutasi || '-');
                            set('kartu_siswa_no_surat_masuk', siswa.no_surat_masuk || '-');
                            set('kartu_siswa_alasan_mutasi_masuk', siswa.alasan_mutasi_masuk || '-');
                            sectionMutasiMasuk.style.display = 'block';
                        } else if (sectionMutasiMasuk) {
                            sectionMutasiMasuk.style.display = 'none';
                        }

                        // Data Akademik Dasar (Kehadiran & Nilai)
                        const persenHadir = siswa.persen_kehadiran !== undefined ? siswa.persen_kehadiran :
                            100;
                        set('kartu_siswa_persen_kehadiran_label', `${persenHadir}%`);
                        set('kartu_siswa_rata_nilai', siswa.rata_nilai || '-');
                        if (document.getElementById('kartu_siswa_kehadiran_bar')) {
                            document.getElementById('kartu_siswa_kehadiran_bar').style.width =
                                `${persenHadir}%`;
                        }

                        // Memuat Riwayat Kelas ke dalam Tab
                        if (typeof renderKenaikanKelasList === 'function') {
                            renderKenaikanKelasList(
                                []); // Atur ke array kosong untuk sementara (loading/reset)

                            fetch(`/operator/data-siswa/${siswa.id}/riwayat-kelas`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                }
                            })
                                .then(r => r.json())
                                .then(data => {
                                    if (data.riwayat && data.riwayat.length > 0) {
                                        const items = data.riwayat.map(r => ({
                                            kelas: r.nama_kelas_snapshot,
                                            tahun_ajaran: r.tahun_ajaran,
                                            status: r.jenis_label,
                                            rata_nilai: '-',
                                            tanggal_masuk: r.tanggal_masuk,
                                            tanggal_keluar: r.tanggal_keluar,
                                            tanggal_masuk_label: r.tanggal_masuk_label,
                                            tanggal_keluar_label: r.tanggal_keluar_label,
                                            semester: r.semester,
                                            keterangan: r.keterangan
                                        }));
                                        renderKenaikanKelasList(items);
                                    }
                                })
                                .catch(e => console.error('Gagal memuat riwayat kelas', e));
                        }
                        // Load Prestasi untuk Kartu Siswa
                        const prestasiList = document.getElementById('kartu_siswa_prestasi_list');
                        const prestasiEmpty = document.getElementById('kartu_siswa_prestasi_empty');
                        if (prestasiList) prestasiList.innerHTML = '';
                        if (prestasiEmpty) prestasiEmpty.classList.add('hidden');

                        fetch(`/operator/data-siswa/${siswa.id}/prestasi`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            credentials: 'same-origin'
                        })
                            .then(r => r.json())
                            .then(data => {
                                if (data.prestasi && data.prestasi.length > 0) {
                                    if (prestasiList) {
                                        prestasiList.innerHTML = data.prestasi.map(p => `
                                                                                                    <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-4 border border-slate-100 dark:border-slate-700 hover:border-amber-200 dark:hover:border-amber-700/50 transition-colors flex items-start gap-3">
                                                                                                        <div class="w-10 h-10 shrink-0 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-amber-500 shadow-sm mt-0.5">
                                                                                                            <span class="material-symbols-outlined text-[20px]">emoji_events</span>
                                                                                                        </div>
                                                                                                        <div class="min-w-0 flex-1">
                                                                                                            <h4 class="text-[13px] font-bold text-slate-700 dark:text-slate-200 uppercase truncate leading-tight">${p.nama}</h4>
                                                                                                            <div class="flex items-center gap-1.5 mt-1.5">
                                                                                                                <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 uppercase tracking-widest">${p.tingkat || 'Sekolah'}</span>
                                                                                                                <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-slate-200 dark:bg-slate-700 text-slate-500 dark:text-slate-400">${p.tahun || '-'}</span>
                                                                                                            </div>
                                                                                                            <p class="text-[10px] text-slate-400 font-medium mt-1.5 truncate">${p.penyelenggara || 'Sekolah'}</p>
                                                                                                            ${p.file_bukti ? `<a href="/operator/data-siswa/${siswa.id}/prestasi/${p.id}/view" target="_blank" class="inline-flex items-center gap-1 mt-2 text-[10px] font-bold text-emerald-600 hover:text-emerald-700 uppercase tracking-widest"><span class="material-symbols-outlined text-[14px]">attachment</span> Lihat Bukti</a>` : ''}
                                                                                                        </div>
                                                                                                    </div>
                                                                                                `).join('');
                                    }
                                } else {
                                    if (prestasiEmpty) prestasiEmpty.classList.remove('hidden');
                                }
                            }).catch(e => console.error('Gagal memuat prestasi:', e));

                        // Load Beasiswa untuk Kartu Siswa
                        const beasiswaList = document.getElementById('kartu_siswa_beasiswa_list');
                        const beasiswaStats = document.getElementById('kartu_siswa_beasiswa_stats');
                        const beasiswaEmpty = document.getElementById('kartu_siswa_beasiswa_empty');
                        if (beasiswaList) beasiswaList.innerHTML = '';
                        if (beasiswaStats) beasiswaStats.textContent = 'Memuat beasiswa...';
                        if (beasiswaEmpty) beasiswaEmpty.classList.add('hidden');

                        fetch(`/operator/data-siswa/${siswa.id}/beasiswa`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            credentials: 'same-origin'
                        })
                            .then(r => r.json())
                            .then(data => {
                                const beasiswas = data.beasiswa || [];
                                if (beasiswaStats) beasiswaStats.textContent =
                                    `${beasiswas.length} Beasiswa`;

                                if (beasiswas.length > 0) {
                                    if (beasiswaList) {
                                        beasiswaList.innerHTML = beasiswas.map(b => {
                                            const nominal = b.nominal ? Number(b.nominal)
                                                .toLocaleString('id-ID', {
                                                    style: 'currency',
                                                    currency: 'IDR',
                                                    maximumFractionDigits: 0
                                                }) : '-';
                                            const periode = [b.tahun_mulai, b.tahun_selesai]
                                                .filter(Boolean).join(' - ') || '-';

                                            return `
                                                                                                        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-4 border border-slate-100 dark:border-slate-700 hover:border-emerald-200 dark:hover:border-emerald-700/50 transition-colors">
                                                                                                            <div class="flex items-start gap-3">
                                                                                                                <div class="w-10 h-10 shrink-0 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-emerald-600 shadow-sm">
                                                                                                                    <span class="material-symbols-outlined text-[20px]">workspace_premium</span>
                                                                                                                </div>
                                                                                                                <div class="min-w-0 flex-1">
                                                                                                                    <h4 class="text-[13px] font-bold text-slate-700 dark:text-slate-200 uppercase truncate leading-tight">${b.nama || 'Beasiswa'}</h4>
                                                                                                                    <div class="flex items-center gap-1.5 mt-1.5 flex-wrap">
                                                                                                                        <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 uppercase tracking-widest">${b.jenis || 'Umum'}</span>
                                                                                                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-slate-200 dark:bg-slate-700 text-slate-500 dark:text-slate-400">${periode}</span>
                                                                                                                    </div>
                                                                                                                    <p class="text-[11px] text-slate-600 dark:text-slate-300 font-bold mt-2">${nominal}</p>
                                                                                                                    ${b.keterangan ? `<p class="text-[10px] text-slate-400 font-medium mt-1.5 line-clamp-2">${b.keterangan}</p>` : ''}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    `;
                                        }).join('');
                                    }
                                } else {
                                    if (beasiswaEmpty) beasiswaEmpty.classList.remove('hidden');
                                }

                                if (typeof lucide !== 'undefined') lucide.createIcons();
                            })
                            .catch(e => {
                                console.error('Gagal memuat beasiswa:', e);
                                if (beasiswaStats) beasiswaStats.textContent = 'Gagal memuat beasiswa';
                                if (beasiswaEmpty) beasiswaEmpty.classList.remove('hidden');
                            });

                        const statusLabel = {
                            aktif: 'Aktif',
                            lulus: 'Lulus',
                            pindah: 'Pindah',
                            nonaktif: 'Non-Aktif'
                        };
                        set('kartu_siswa_status', statusLabel[siswa.status] ?? siswa.status ?? '-');

                        const idSystem =
                            `NH3-SISWA-${new Date().getFullYear()}-${String(siswa.id).padStart(4, '0')}`;
                        set('kartu_siswa_id_system', idSystem);

                        document.getElementById('kartu_siswa_qr').src =
                            `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(`SISWA:${siswa.nama}|NISN:${siswa.nisn || '-'}|ID:${idSystem}`)}`;

                        const btnUbah = document.getElementById('btnUbahDataKartuSiswa') || document
                            .getElementById('btnUbahDataKartuSiswaFooter');
                        if (btnUbah) {
                            btnUbah.onclick = () => {
                                this.closeKartuSiswa();
                                this.editSiswa(siswa);
                            };
                        }

                        const btnCetak = document.getElementById('btnCetakKartuSiswaPdf');
                        if (btnCetak) {
                            btnCetak.href = `/operator/data-siswa/${siswa.id}/pdf`;
                        }

                        const modal = document.getElementById('modalKartuSiswa');
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                        document.body.style.overflow = 'hidden';

                        const statusMap = {
                            aktif: {
                                text: 'Peserta Didik Aktif',
                                color: '#006c49',
                                icon: 'check-circle'
                            },
                            lulus: {
                                text: 'Peserta Didik Telah Lulus',
                                color: '#2563eb',
                                icon: 'graduation-cap'
                            },
                            pindah: {
                                text: 'Peserta Didik Pindah Sekolah',
                                color: '#d97706',
                                icon: 'arrow-right-circle'
                            },
                            nonaktif: {
                                text: 'Peserta Didik Tidak Aktif',
                                color: '#dc2626',
                                icon: 'x-circle'
                            },
                        };
                        const st = statusMap[siswa.status] || {
                            text: siswa.status ?? '-',
                            color: '#6b7280',
                            icon: 'help-circle'
                        };
                        const label = document.getElementById('kartu_siswa_status_label');
                        label.innerHTML =
                            `${st.text} <i data-lucide="${st.icon}" style="width:16px;height:16px;"></i>`;
                        label.style.color = st.color;

                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    },

                    closeKartuSiswa() {
                        const modal = document.getElementById('modalKartuSiswa');
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                        document.body.style.overflow = 'auto';
                        this.currentSiswaForModal = null;
                    },

                    openDokumenSiswaModal(siswa) {
                        this.openBerkasModal(siswa.id, siswa.nama);
                    },
                    openPrestasiSiswaModal(siswa) {
                        this.currentSiswaForModal = siswa;
                        document.getElementById('prestasi_siswa_nama').textContent = siswa.nama;
                        document.getElementById('prestasi_siswa_id').value = siswa.id;
                        document.getElementById('formTambahPrestasi').action =
                            `/operator/data-siswa/${siswa.id}/prestasi`;
                        document.getElementById('prestasiSiswaModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';

                        this.loadPrestasi(siswa.id);
                    },
                    closePrestasiSiswaModal() {
                        document.getElementById('prestasiSiswaModal').classList.add('hidden');
                        document.body.style.overflow = 'auto';
                        this.cancelEditPrestasi();
                    },
                    cancelEditPrestasi() {
                        const form = document.getElementById('formTambahPrestasi');
                        form.reset();
                        const siswaId = document.getElementById('prestasi_siswa_id').value;
                        form.action = `/operator/data-siswa/${siswaId}/prestasi`;
                        document.getElementById('prestasi_edit_id').value = '';
                        document.getElementById('textSubmitPrestasi').textContent = 'Tambah Data';
                        document.getElementById('iconSubmitPrestasi').setAttribute('data-lucide', 'plus');
                        document.getElementById('btnSubmitPrestasi').classList.remove('bg-emerald-600',
                            'hover:bg-emerald-500');
                        document.getElementById('btnSubmitPrestasi').classList.add('bg-amber-600',
                            'hover:bg-amber-500');
                        document.getElementById('btnCancelEditPrestasi').style.display = 'none';
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    },
                    editPrestasi(p) {
                        const siswaId = document.getElementById('prestasi_siswa_id').value;
                        const form = document.getElementById('formTambahPrestasi');
                        form.action = `/operator/data-siswa/${siswaId}/prestasi/${p.id}`;
                        document.getElementById('prestasi_edit_id').value = p.id;
                        document.getElementById('prestasi_nama').value = p.nama;
                        document.getElementById('prestasi_jenis').value = p.jenis || '';
                        document.getElementById('prestasi_tingkat').value = p.tingkat || '';
                        document.getElementById('prestasi_tahun').value = p.tahun || '';
                        document.getElementById('prestasi_penyelenggara').value = p.penyelenggara || '';
                        document.getElementById('prestasi_keterangan').value = p.keterangan || '';

                        document.getElementById('textSubmitPrestasi').textContent = 'Simpan Perubahan';
                        document.getElementById('iconSubmitPrestasi').setAttribute('data-lucide', 'save');
                        document.getElementById('btnSubmitPrestasi').classList.remove('bg-amber-600',
                            'hover:bg-amber-500');
                        document.getElementById('btnSubmitPrestasi').classList.add('bg-emerald-600',
                            'hover:bg-emerald-500');
                        document.getElementById('btnCancelEditPrestasi').style.display = 'flex';
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    },
                    loadPrestasi(siswaId) {
                        const tbody = document.getElementById('prestasiTableBody');
                        tbody.innerHTML =
                            `<tr><td colspan="4" class="px-5 py-10 text-center"><div class="flex flex-col items-center justify-center gap-2"><i data-lucide="loader-2" class="w-6 h-6 text-amber-500 animate-spin"></i><p class="text-xs text-slate-500 font-medium">Memuat data prestasi...</p></div></td></tr>`;
                        if (typeof lucide !== 'undefined') lucide.createIcons();

                        fetch(`/operator/data-siswa/${siswaId}/prestasi`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            credentials: 'same-origin'
                        })
                            .then(res => res.json())
                            .then(data => {
                                if (!data.prestasi || data.prestasi.length === 0) {
                                    tbody.innerHTML =
                                        `<tr><td colspan="4" class="px-5 py-10 text-center"><div class="flex flex-col items-center gap-3 text-slate-400"><i data-lucide="award" class="w-10 h-10 opacity-30"></i><p class="font-bold text-sm">Belum ada data prestasi</p></div></td></tr>`;
                                    if (typeof lucide !== 'undefined') lucide.createIcons();
                                    return;
                                }
                                tbody.innerHTML = data.prestasi.map(p => {
                                    let actionButtons = '';
                                    if (p.file_bukti) {
                                        actionButtons += `
                                                                                                <a href="/operator/data-siswa/${siswaId}/prestasi/${p.id}/view" target="_blank" class="p-2 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors" title="Lihat Bukti">
                                                                                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                                                                                </a>
                                                                                                <a href="/operator/data-siswa/${siswaId}/prestasi/${p.id}/download" target="_blank" class="p-2 hover:bg-blue-50 dark:hover:bg-blue-500/10 text-slate-400 hover:text-blue-500 rounded-lg transition-colors" title="Unduh Bukti">
                                                                                                    <i data-lucide="download" class="w-4 h-4"></i>
                                                                                                </a>
                                                                                            `;
                                    }
                                    actionButtons += `
                                                                                            <button type="button" onclick='window.appDataSiswa.editPrestasi(${JSON.stringify(p).replace(/'/g, "&#39;")})' class="p-2 hover:bg-amber-50 dark:hover:bg-amber-500/10 text-slate-400 hover:text-amber-500 rounded-lg transition-colors" title="Edit">
                                                                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                                                                            </button>
                                                                                        `;

                                    return `
                                                                                        <tr class="border-b border-slate-50 dark:border-slate-800/50 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                                                                            <td class="px-5 py-4 w-1/4"><span class="px-2 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-500 uppercase tracking-widest">${p.tahun || '-'}</span></td>
                                                                                            <td class="px-5 py-4">
                                                                                                <p class="text-xs font-bold text-slate-700 dark:text-slate-200 uppercase">${p.nama}</p>
                                                                                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-1">${p.jenis || '-'} • ${p.penyelenggara || '-'}</p>
                                                                                                ${p.file_bukti ? '<span class="inline-block mt-2 px-2 py-0.5 rounded text-[9px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200 uppercase tracking-widest"><i data-lucide="paperclip" class="w-3 h-3 inline"></i> Bukti Tersedia</span>' : ''}
                                                                                            </td>
                                                                                            <td class="px-5 py-4 w-1/4"><span class="px-2 py-1 rounded-md bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400 text-[10px] font-bold uppercase tracking-widest border border-amber-200 dark:border-amber-500/20">${p.tingkat || '-'}</span></td>
                                                                                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                                                                                <div class="flex items-center justify-end gap-1">
                                                                                                    ${actionButtons}
                                                                                                    <form action="/operator/data-siswa/${siswaId}/prestasi/${p.id}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data prestasi ini?')">
                                                                                                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                                                        <button type="submit" class="p-2 hover:bg-rose-50 dark:hover:bg-rose-500/10 text-slate-400 hover:text-rose-500 rounded-lg transition-colors" title="Hapus"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    `;
                                }).join('');
                                if (typeof lucide !== 'undefined') lucide.createIcons();
                            });
                    },
                    openBeasiswaSiswaModal(siswa) {
                        this.currentSiswaForModal = siswa;
                        document.getElementById('beasiswa_siswa_nama').textContent = siswa.nama;
                        document.getElementById('beasiswa_siswa_id').value = siswa.id;
                        document.getElementById('formTambahBeasiswa').action =
                            `/operator/data-siswa/${siswa.id}/beasiswa`;
                        document.getElementById('beasiswaSiswaModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';

                        this.loadBeasiswa(siswa.id);
                    },
                    closeBeasiswaSiswaModal() {
                        document.getElementById('beasiswaSiswaModal').classList.add('hidden');
                        document.body.style.overflow = 'auto';
                        document.getElementById('formTambahBeasiswa').reset();
                    },
                    loadBeasiswa(siswaId) {
                        const tbody = document.getElementById('beasiswaTableBody');
                        tbody.innerHTML =
                            `<tr><td colspan="4" class="px-5 py-10 text-center"><div class="flex flex-col items-center justify-center gap-2"><i data-lucide="loader-2" class="w-6 h-6 text-emerald-500 animate-spin"></i><p class="text-xs text-slate-500 font-medium">Memuat data beasiswa...</p></div></td></tr>`;
                        if (typeof lucide !== 'undefined') lucide.createIcons();

                        fetch(`/operator/data-siswa/${siswaId}/beasiswa`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            credentials: 'same-origin'
                        })
                            .then(res => res.json())
                            .then(data => {
                                if (!data.beasiswa || data.beasiswa.length === 0) {
                                    tbody.innerHTML =
                                        `<tr><td colspan="4" class="px-5 py-10 text-center"><div class="flex flex-col items-center gap-3 text-slate-400"><i data-lucide="gem" class="w-10 h-10 opacity-30"></i><p class="font-bold text-sm">Belum ada data beasiswa</p></div></td></tr>`;
                                    if (typeof lucide !== 'undefined') lucide.createIcons();
                                    return;
                                }
                                tbody.innerHTML = data.beasiswa.map(b => `
                                                                                        <tr class="border-b border-slate-50 dark:border-slate-800/50 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                                                                            <td class="px-5 py-4 w-1/4"><span class="px-2 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-500 uppercase tracking-widest">${b.tahun_mulai || '-'} s/d ${b.tahun_selesai || '-'}</span></td>
                                                                                            <td class="px-5 py-4"><p class="text-xs font-bold text-slate-700 dark:text-slate-200 uppercase">${b.nama}</p><p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-1">${b.jenis || '-'}</p></td>
                                                                                            <td class="px-5 py-4 w-1/4"><span class="px-2 py-1 rounded-md bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 text-[10px] font-bold uppercase tracking-widest border border-emerald-200 dark:border-emerald-500/20">Rp ${new Intl.NumberFormat('id-ID').format(b.nominal || 0)}</span></td>
                                                                                            <td class="px-5 py-4 text-right">
                                                                                                <form action="/operator/data-siswa/${siswaId}/beasiswa/${b.id}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data beasiswa ini?')">
                                                                                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                                                    <button type="submit" class="p-2 hover:bg-rose-50 dark:hover:bg-rose-500/10 text-slate-400 hover:text-rose-500 rounded-lg transition-colors" title="Hapus"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                                                                                </form>
                                                                                            </td>
                                                                                        </tr>
                                                                                    `).join('');
                                if (typeof lucide !== 'undefined') lucide.createIcons();
                            });
                    },

                    bindLiveValidation() {
                        Object.values(this.STEP_RULES_SISWA).flat().forEach(rule => {
                            const el = document.querySelector(
                                `#formSiswaMaster [name="${rule.name}"]`);
                            if (!el) return;
                            const event = el.tagName === 'SELECT' ? 'change' : 'input';
                            el.addEventListener(event, () => {
                                if (el.classList.contains('border-red-400')) {
                                    const msg = this.getErrMsgSiswa(rule, el.value);
                                    msg ? this.setFieldErrSiswa(el, msg) : this
                                        .clearFieldErrSiswa(el);
                                }
                            });
                        });
                    },

                    openTrashModal() {
                        document.getElementById('trashModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                        loadTrash(1);
                    },
                }));
            });

            // ================================================================
            // RECYCLE BIN — Siswa Terhapus
            // ================================================================
            let trashCurrentPage = 1;
            let trashLastPage = 1;

            function openTrashModal() {
                document.getElementById('trashModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                loadTrash(1);
            }

            function closeTrashModal() {
                document.getElementById('trashModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            function loadTrash(page = 1) {
                if (page < 1) return;
                if (trashLastPage > 1 && page > trashLastPage) return; // hanya block jika lastPage sudah diketahui
                trashCurrentPage = page;

                const loading = document.getElementById('trash_loading');
                const list = document.getElementById('trash_list');
                const empty = document.getElementById('trash_empty');
                const pagination = document.getElementById('trash_pagination');

                loading.classList.remove('hidden');
                list.classList.add('hidden');
                empty.classList.add('hidden');
                pagination.classList.add('hidden');

                fetch(`{{ route('operator.dataSiswa.trash') }}?page=${page}`, {
                    credentials: 'same-origin',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                    .then(res => {
                        if (!res.ok) throw new Error(`HTTP ${res.status}: ${res.statusText}`);
                        return res.json();
                    })
                    .then(data => {
                        loading.classList.add('hidden');
                        trashLastPage = data.last_page ?? 1;

                        if (data.data.length === 0) {
                            empty.classList.remove('hidden');
                            return;
                        }

                        list.innerHTML = data.data.map(s => {
                            const fotoSrc = s.foto ?
                                `/storage/${s.foto}` :
                                `/assets/default-avatar.svg`;

                            return `
                                                                        <div class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-800 group">
                                                                            <img src="${fotoSrc}" class="w-10 h-10 rounded-xl object-cover border border-slate-200 shrink-0" onerror="this.src='/assets/default-avatar.svg'">
                                                                            <div class="flex-1 min-w-0">
                                                                                <p class="text-sm font-bold text-slate-800 dark:text-white truncate">${s.nama}</p>
                                                                                <p class="text-[10px] text-slate-400 font-medium">${s.nis ?? '-'} · Kelas ${s.kelas}</p>
                                                                                <p class="text-[10px] text-rose-400 font-bold mt-0.5 flex items-center gap-1">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                                                                    Dihapus ${s.deleted_at}
                                                                                </p>
                                                                            </div>
                                                                            <div class="flex items-center gap-2 shrink-0">
                                                                                {{-- Pulihkan --}}
                                                                                <button onclick="restoreSiswa(${s.id}, '${s.nama.replace(/'/g, "\\'")}', this)"
                                                                                    class="px-3 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-1.5"
                                                                                    title="Pulihkan">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                                                                                    Pulihkan
                                                                                </button>
                                                                                {{-- Hapus Permanen --}}
                                                                                <button onclick="forceDeleteSiswa(${s.id}, '${s.nama.replace(/'/g, "\\'")}', this)"
                                                                                    class="px-3 py-2 bg-rose-50 hover:bg-rose-100 text-rose-500 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-1.5"
                                                                                    title="Hapus Permanen">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                                                                    Permanen
                                                                                </button>
                                                                            </div>
                                                                        </div>`;
                        }).join('');

                        list.classList.remove('hidden');

                        // Pagination
                        document.getElementById('trash_info').textContent =
                            `Halaman ${data.current_page} dari ${data.last_page} — Total: ${data.total} siswa`;
                        document.getElementById('trash_prev').disabled = (page <= 1);
                        document.getElementById('trash_next').disabled = (page >= data.last_page);

                        if (data.last_page > 1) pagination.classList.remove('hidden');

                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    })
                    .catch((err) => {
                        loading.classList.add('hidden');
                        console.error('[Recycle Bin] Fetch error:', err);
                        empty.innerHTML =
                            `<div class="w-16 h-16 bg-rose-50 rounded-2xl flex items-center justify-center mx-auto mb-4"><svg class="w-8 h-8 text-rose-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div><p class="font-bold text-sm text-rose-500">Gagal memuat data</p><p class="text-xs mt-1">${err.message}</p>`;
                        empty.classList.remove('hidden');
                    });
            }

            function restoreSiswa(id, nama, btn) {
                if (!confirm(`Pulihkan data siswa "${nama}"?`)) return;
                btn.disabled = true;
                btn.textContent = 'Memulihkan...';

                fetch(`/operator/data-siswa/${id}/restore`, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Reload trash list
                            loadTrash(trashCurrentPage);
                            // Show a brief toast notification
                            showTrashToast(data.message, 'emerald');
                        } else {
                            alert(data.message || 'Gagal memulihkan data.');
                            btn.disabled = false;
                            btn.textContent = 'Pulihkan';
                        }
                    });
            }

            function forceDeleteSiswa(id, nama, btn) {
                if (!confirm(
                    `⚠️ HAPUS PERMANEN data siswa "${nama}"?\n\nSELURUH data terkait (nilai, absen, riwayat) akan ikut terhapus secara permanen dan TIDAK DAPAT dipulihkan!`
                )) return;
                btn.disabled = true;
                btn.textContent = 'Menghapus...';

                fetch(`/operator/data-siswa/${id}/force`, {
                    method: 'DELETE',
                    credentials: 'same-origin',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            loadTrash(trashCurrentPage);
                            showTrashToast(data.message, 'rose');
                        } else {
                            alert(data.message || 'Gagal menghapus data.');
                            btn.disabled = false;
                            btn.textContent = 'Permanen';
                        }
                    });
            }

            function showTrashToast(msg, color = 'emerald') {
                const colors = {
                    emerald: 'bg-emerald-50 border-emerald-200 text-emerald-700',
                    rose: 'bg-rose-50 border-rose-200 text-rose-700',
                };
                const toast = document.createElement('div');
                toast.className =
                    `fixed bottom-6 right-6 z-[999] px-5 py-3.5 rounded-2xl border shadow-lg text-sm font-bold flex items-center gap-2 transition-all ${colors[color] ?? colors.emerald}`;
                toast.innerHTML =
                    `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>${msg}`;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 4000);
            }
        </script>
    @endpush
@endsection