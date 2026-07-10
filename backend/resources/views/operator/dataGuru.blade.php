@extends('layouts.operator')
@section('content')
    <div x-data="guruPanel()">

        {{-- ==================== ALERTS ==================== --}}
        <div id="page-content" class="p-6 lg:p-10 space-y-6 animate-up w-full">
            @if (session('success'))
                <div id="success-alert"
                    class="bg-emerald-500 text-white px-6 py-4 rounded-2xl mb-2 font-bold flex items-center justify-between shadow-lg shadow-emerald-500/20">
                    <div class="flex items-center gap-3">
                        <i data-lucide="check-circle" class="w-5 h-5 shrink-0"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button @click="$el.parentElement.remove()"
                        class="text-white hover:text-emerald-100 text-xl leading-none shrink-0 ml-4">&times;</button>
                </div>
            @endif

            @if (session('warning'))
                <div
                    class="alert-box bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/20 text-amber-800 dark:text-amber-400 px-6 py-4 rounded-2xl mb-2 text-sm font-semibold flex items-start justify-between gap-3">
                    <div class="flex items-start gap-3">
                        <i data-lucide="alert-triangle" class="w-5 h-5 shrink-0 mt-0.5"></i>
                        <span>{{ session('warning') }}</span>
                    </div>
                    <button @click="$el.parentElement.remove()"
                        class="text-amber-400 hover:text-amber-600 text-xl leading-none shrink-0 ml-4">&times;</button>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="alert-box bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/20 text-rose-800 dark:text-rose-400 px-6 py-4 rounded-2xl mb-2 text-sm font-semibold flex items-start justify-between gap-3">
                    <div class="flex items-start gap-3">
                        <i data-lucide="alert-circle" class="w-5 h-5 shrink-0 mt-0.5"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button @click="$el.parentElement.remove()"
                        class="text-rose-400 hover:text-rose-600 text-xl leading-none shrink-0 ml-4">&times;</button>
                </div>
            @endif

            @if (session('import_skipped') && count(session('import_skipped')) > 0)
                <div
                    class="alert-box bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/20 text-amber-800 dark:text-amber-400 px-6 py-4 rounded-2xl mb-2 text-sm relative">
                    <button @click="$el.parentElement.remove()"
                        class="absolute top-4 right-4 text-amber-400 hover:text-amber-600 text-xl leading-none">&times;</button>
                    <p class="font-bold mb-2 flex items-center gap-2">
                        <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                        Baris yang dilewati saat import:
                    </p>
                    <ul class="text-xs space-y-1 pr-8">
                        @foreach (session('import_skipped') as $skip)
                            <li>• Baris {{ $skip['baris'] }} — <strong>{{ $skip['nama'] }}</strong>: {{ $skip['alasan'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($errors->any())
                <div id="error-alert"
                    class="bg-rose-500 text-white px-6 py-4 rounded-2xl mb-2 font-bold flex items-start justify-between shadow-lg shadow-rose-500/20">
                    <div>
                        <p class="mb-1 uppercase text-xs opacity-75 tracking-widest flex items-center gap-2">
                            <i data-lucide="x-circle" class="w-4 h-4"></i> Terjadi Kesalahan:
                        </p>
                        <ul class="text-sm font-normal space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button @click="$el.parentElement.remove()"
                        class="text-white hover:text-rose-100 text-xl leading-none shrink-0 ml-4">&times;</button>
                </div>
            @endif

            {{-- ==================== STATS CARDS ==================== --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
                @php
                    $statItems = [
                        ['label' => 'Total SDM', 'value' => $stats['total'], 'icon' => 'users', 'color' => 'emerald'],
                        ['label' => 'Aktif', 'value' => $stats['aktif'], 'icon' => 'user-check', 'color' => 'blue'],
                        ['label' => 'PNS', 'value' => $stats['pns'], 'icon' => 'briefcase', 'color' => 'purple'],
                        ['label' => 'Honorer', 'value' => $stats['honorer'], 'icon' => 'file-text', 'color' => 'amber'],
                        ['label' => 'Wali Kelas', 'value' => $stats['wali_kelas'], 'icon' => 'home', 'color' => 'teal'],
                        [
                            'label' => 'Tersertifikasi',
                            'value' => $stats['sertifikasi'],
                            'icon' => 'award',
                            'color' => 'rose',
                        ],
                    ];
                    $colorMap = [
                        'emerald' => 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                        'blue' => 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400',
                        'purple' => 'bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400',
                        'amber' => 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400',
                        'teal' => 'bg-teal-50 dark:bg-teal-500/10 text-teal-600 dark:text-teal-400',
                        'rose' => 'bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400',
                    ];
                @endphp
                @foreach ($statItems as $stat)
                    <div
                        class="glass-card p-4 rounded-2xl border border-slate-100 dark:border-slate-800 flex items-center gap-3">
                        <div class="p-2.5 rounded-xl {{ $colorMap[$stat['color']] }} shrink-0">
                            <i data-lucide="{{ $stat['icon'] }}" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-xl font-black text-slate-900 dark:text-white font-lexend">{{ $stat['value'] }}
                            </p>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">{{ $stat['label'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ==================== ACTION BAR ==================== --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <h2 class="font-lexend font-black text-xl text-slate-900 dark:text-white tracking-tight">
                    Data Guru & Staf
                </h2>

                <div class="flex items-center gap-2 flex-wrap">
                    <button @click="openTrashModal()"
                        class="group px-5 py-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:border-rose-500/50 transition-all shadow-sm">
                        <i data-lucide="trash-2"
                            class="w-4 h-4 text-slate-400 group-hover:text-rose-500 transition-colors"></i>
                        <span class="text-slate-600 dark:text-slate-400">Recycle Bin</span>
                    </button>
                    {{-- ── TOMBOL IMPORT ── --}}
                    <button @click="openImportModal()"
                        class="group px-5 py-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:border-blue-500/50 transition-all shadow-sm">
                        <i data-lucide="upload"
                            class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors"></i>
                        <span class="text-slate-600 dark:text-slate-400">Import</span>
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
                            class="absolute right-0 top-full mt-2 w-80 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none z-50 overflow-hidden">

                            {{-- Header dropdown --}}
                            <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pilih Format
                                    Export</p>
                                <p class="text-[10px] text-slate-400 mt-0.5">Filter aktif akan ikut diterapkan</p>
                            </div>

                            {{-- Pilihan 1: ZIP --}}
                            <a href="{{ route('operator.dataGuru.export', array_merge(request()->only(['search', 'jabatan', 'status', 'status_kepegawaian', 'sertifikasi']), ['mode' => 'zip'])) }}"
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
                                        <code class="bg-slate-100 dark:bg-slate-800 px-1 rounded">foto/</code> per guru.
                                        Bisa langsung re-import.
                                    </p>
                                </div>
                            </a>

                            <div class="mx-4 border-t border-slate-100 dark:border-slate-800"></div>

                            {{-- Pilihan 2: PDF Kartu --}}
                            <a href="{{ route('operator.dataGuru.export', array_merge(request()->only(['search', 'jabatan', 'status', 'status_kepegawaian', 'sertifikasi']), ['mode' => 'pdf'])) }}"
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
                                        PDF berisi kartu identitas lengkap semua guru — foto, data diri,
                                        pendidikan, status kepegawaian, dan mapel.
                                    </p>
                                </div>
                            </a>

                            <div class="mx-4 border-t border-slate-100 dark:border-slate-800"></div>

                            {{-- Pilihan 3: Laporan Rekap --}}
                            <div class="px-4 py-3">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Laporan
                                    Rekap</p>
                                <div class="space-y-1">
                                    <a href="{{ route('operator.dataGuru.exportLaporan', ['type' => 'kepegawaian']) }}"
                                        @click="openExport = false"
                                        class="flex items-center gap-2 px-3 py-2 hover:bg-blue-50 dark:hover:bg-blue-500/5 rounded-lg transition-colors group">
                                        <i data-lucide="briefcase" class="w-3.5 h-3.5 text-blue-500"></i>
                                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Rekap
                                            Kepegawaian</span>
                                    </a>
                                    <a href="{{ route('operator.dataGuru.exportLaporan', ['type' => 'pendidikan']) }}"
                                        @click="openExport = false"
                                        class="flex items-center gap-2 px-3 py-2 hover:bg-teal-50 dark:hover:bg-teal-500/5 rounded-lg transition-colors group">
                                        <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-teal-500"></i>
                                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Rekap
                                            Pendidikan</span>
                                    </a>
                                    <a href="{{ route('operator.dataGuru.exportLaporan', ['type' => 'sertifikasi']) }}"
                                        @click="openExport = false"
                                        class="flex items-center gap-2 px-3 py-2 hover:bg-amber-50 dark:hover:bg-amber-500/5 rounded-lg transition-colors group">
                                        <i data-lucide="award" class="w-3.5 h-3.5 text-amber-500"></i>
                                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Rekap
                                            Sertifikasi</span>
                                    </a>
                                </div>
                            </div>

                            {{-- Footer info --}}
                            <div
                                class="px-4 py-3 bg-slate-50/50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800">
                                <p class="text-[10px] text-slate-400 flex items-center gap-1.5">
                                    <i data-lucide="info" class="w-3 h-3 shrink-0"></i>
                                    PDF satu guru: klik ikon
                                    <i data-lucide="printer" class="w-3 h-3 inline shrink-0"></i>
                                    di baris tabel.
                                </p>
                            </div>

                        </div>
                    </div>

                    {{-- ── TAMBAH GURU ── --}}
                    <button @click="openGuruModal()"
                        class="px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-600/20 hover:-translate-y-1 active:scale-95 transition-all flex items-center gap-3">
                        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Guru
                    </button>

                </div>
            </div>

            {{-- ==================== FILTER & SEARCH ==================== --}}
            <div class="glass-card p-4 rounded-[2rem] border border-slate-100 dark:border-slate-800">
                <form id="filterForm" method="GET" action="{{ route('operator.dataGuru') }}"
                    class="flex flex-col md:flex-row gap-3 items-stretch md:items-center">
                    {{-- Search --}}
                    <div class="relative flex-1">
                        <i data-lucide="search"
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" name="search" id="searchGuru" value="{{ request('search') }}"
                            placeholder="Cari nama, NUPTK, NIP, No. Sertifikasi, email..."
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border-none rounded-[1.5rem] text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                    </div>
                    {{-- Jabatan --}}
                    <select name="jabatan" id="filterJabatan"
                        class="px-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border-none rounded-[1.5rem] text-xs font-bold focus:ring-2 focus:ring-emerald-500/20 outline-none cursor-pointer appearance-none md:w-44">
                        <option value="semua" {{ request('jabatan', 'semua') === 'semua' ? 'selected' : '' }}>Semua
                            Jabatan
                        </option>
                        <option value="guru" {{ request('jabatan') === 'guru' ? 'selected' : '' }}>Guru Kelas</option>
                        <option value="wali" {{ request('jabatan') === 'wali' ? 'selected' : '' }}>Wali Kelas</option>
                        <option value="kepala" {{ request('jabatan') === 'kepala' ? 'selected' : '' }}>Kepala Sekolah
                        </option>
                        <option value="staf" {{ request('jabatan') === 'staf' ? 'selected' : '' }}>Staf TU</option>
                    </select>
                    {{-- Status Kepegawaian --}}
                    <select name="status_kepegawaian" id="filterKepegawaian"
                        class="px-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border-none rounded-[1.5rem] text-xs font-bold focus:ring-2 focus:ring-emerald-500/20 outline-none cursor-pointer appearance-none md:w-44">
                        <option value="semua" {{ request('status_kepegawaian', 'semua') === 'semua' ? 'selected' : '' }}>
                            Semua
                            Kepegawaian</option>
                        <option value="PNS" {{ request('status_kepegawaian') === 'PNS' ? 'selected' : '' }}>PNS
                        </option>
                        <option value="Honorer" {{ request('status_kepegawaian') === 'Honorer' ? 'selected' : '' }}>
                            Honorer
                        </option>
                        <option value="PPPK" {{ request('status_kepegawaian') === 'PPPK' ? 'selected' : '' }}>PPPK
                        </option>
                    </select>
                    {{-- Sertifikasi --}}
                    <select name="sertifikasi" id="filterSertifikasi"
                        class="px-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border-none rounded-[1.5rem] text-xs font-bold focus:ring-2 focus:ring-emerald-500/20 outline-none cursor-pointer appearance-none md:w-44">
                        <option value="" {{ !request('sertifikasi') ? 'selected' : '' }}>Semua Sertifikasi</option>
                        <option value="sudah" {{ request('sertifikasi') === 'sudah' ? 'selected' : '' }}>Sudah
                            Sertifikasi
                        </option>
                        <option value="belum" {{ request('sertifikasi') === 'belum' ? 'selected' : '' }}>Belum
                            Sertifikasi
                        </option>
                    </select>
                    {{-- Status Aktif --}}
                    <select name="status" id="filterStatus"
                        class="px-4 py-3.5 bg-slate-50 dark:bg-slate-900/50 border-none rounded-[1.5rem] text-xs font-bold focus:ring-2 focus:ring-emerald-500/20 outline-none cursor-pointer appearance-none md:w-40">
                        <option value="semua" {{ request('status', 'semua') === 'semua' ? 'selected' : '' }}>Semua Status
                        </option>
                        <option value="tetap" {{ request('status') === 'tetap' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ request('status') === 'tidak aktif' ? 'selected' : '' }}>Tidak
                            Aktif
                        </option>
                    </select>
                    {{-- Tombol reset filter --}}
                    @if (request()->hasAny(['search', 'jabatan', 'status', 'status_kepegawaian', 'sertifikasi']))
                        <a href="{{ route('operator.dataGuru') }}"
                            class="px-4 py-3.5 bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 rounded-[1.5rem] text-[10px] font-black uppercase tracking-widest flex items-center gap-1 shrink-0">
                            <i data-lucide="x" class="w-3 h-3"></i> Reset
                        </a>
                    @endif
                </form>
            </div>

            {{-- ==================== TABLE ==================== --}}
            <div
                class="glass-card rounded-[2.5rem] shadow-xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Guru
                                </th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">NUPTK
                                    / Sertifikasi</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Jabatan</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Kepegawaian</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">TMT /
                                    Masa Bakti</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Status</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="guruTableBody" class="divide-y divide-slate-50 dark:divide-slate-800/50">
                            @include('operator.partials._tableGuru', ['guru' => $guru])
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div
                    class="p-6 border-t border-slate-50 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <p id="infoData" class="text-[10px] text-slate-400 font-black uppercase tracking-widest">
                        Menampilkan {{ $guru->firstItem() ?? 0 }}–{{ $guru->lastItem() ?? 0 }} dari {{ $guru->total() }}
                        Guru
                    </p>
                    <div class="flex items-center gap-2">
                        {{ $guru->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== MODAL IMPORT ==================== --}}
        <div id="importModal" class="fixed inset-0 z-[70] hidden overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative w-full max-w-xl bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden animate-up">

                    {{-- Header --}}
                    <div class="px-8 pt-8 pb-0 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tighter">
                                Import <span class="text-blue-600">Data Guru</span>
                            </h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">
                                Excel biasa atau ZIP dengan foto
                            </p>
                        </div>
                        <button @click="closeImportModal()"
                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 rounded-full transition-all">
                            <i data-lucide="x" class="w-5 h-5 text-slate-500"></i>
                        </button>
                    </div>

                    <div class="p-8 space-y-5">

                        {{-- Tab Pilih Mode --}}
                        <div class="flex gap-2 p-1 bg-slate-100 dark:bg-slate-800 rounded-2xl">
                            <button type="button" @click="importMode='excel'"
                                :class="importMode === 'excel' ?
                                    'bg-white dark:bg-slate-700 text-slate-800 dark:text-white shadow-sm' :
                                    'text-slate-400'"
                                class="flex-1 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all flex items-center justify-center gap-2">
                                <i data-lucide="file-spreadsheet" class="w-3.5 h-3.5"></i>
                                Excel / CSV
                            </button>
                            <button type="button" @click="importMode='zip'"
                                :class="importMode === 'zip' ?
                                    'bg-white dark:bg-slate-700 text-slate-800 dark:text-white shadow-sm' :
                                    'text-slate-400'"
                                class="flex-1 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all flex items-center justify-center gap-2">
                                <i data-lucide="archive" class="w-3.5 h-3.5"></i>
                                ZIP + Foto
                            </button>
                        </div>

                        {{-- INFO: Mode Excel --}}
                        <div x-show="importMode==='excel'" x-transition class="space-y-4">
                            <div class="p-4 bg-blue-50 border border-blue-100 rounded-2xl flex items-start gap-3">
                                <i data-lucide="info" class="w-4 h-4 text-blue-500 shrink-0 mt-0.5"></i>
                                <div class="text-xs text-blue-700 flex-1 space-y-1">
                                    <p class="font-bold">Import data guru tanpa foto.</p>
                                    <p>Foto akan ditampilkan sebagai avatar otomatis dari inisial nama. Foto dapat
                                        diperbarui kapan saja via tombol edit.</p>
                                    <a href="{{ route('operator.dataGuru.exportTemplate') }}"
                                        class="inline-flex items-center gap-1 font-black text-blue-600 hover:underline mt-1">
                                        <i data-lucide="download" class="w-3 h-3"></i>
                                        Download Template Excel
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- INFO: Mode ZIP --}}
                        <div x-show="importMode==='zip'" x-transition class="space-y-4">
                            <div class="p-4 bg-purple-50 border border-purple-100 rounded-2xl space-y-3">
                                <p
                                    class="text-[10px] font-black text-purple-600 uppercase tracking-widest flex items-center gap-2">
                                    <i data-lucide="archive" class="w-3.5 h-3.5"></i>
                                    Struktur ZIP yang benar
                                </p>

                                {{-- Tree struktur folder --}}
                                <div
                                    class="bg-white dark:bg-slate-950 rounded-xl border border-purple-100 p-4 font-mono text-xs text-slate-600 dark:text-slate-400 space-y-1 leading-relaxed">
                                    <p>📦 <span class="text-slate-800 dark:text-white font-bold">import_guru.zip</span></p>
                                    <p class="pl-5">├── 📄 <span
                                            class="text-emerald-600 font-bold">data_guru.xlsx</span></p>
                                    <p class="pl-5">└── 📁 <span class="text-blue-600 font-bold">foto/</span></p>
                                    <p class="pl-12 text-slate-400">├── 🖼 <span
                                            class="text-amber-600">1234567890123456.jpg</span> <span
                                            class="text-slate-300">← NUPTK</span></p>
                                    <p class="pl-12 text-slate-400">├── 🖼 <span
                                            class="text-amber-600">1234567890123457.jpg</span></p>
                                    <p class="pl-12 text-slate-400">└── 🖼 <span
                                            class="text-amber-600">1234567890123458.jpg</span></p>
                                </div>

                                <div class="grid grid-cols-1 gap-2 text-xs text-purple-700">
                                    <div class="flex items-start gap-2">
                                        <span
                                            class="w-4 h-4 rounded-full bg-purple-200 text-purple-700 flex items-center justify-center font-black text-[9px] shrink-0 mt-0.5">1</span>
                                        <p>Nama file foto = <strong>NUPTK guru</strong> (mis. <code
                                                class="bg-purple-100 px-1 rounded">1234567890123456.jpg</code>)</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span
                                            class="w-4 h-4 rounded-full bg-purple-200 text-purple-700 flex items-center justify-center font-black text-[9px] shrink-0 mt-0.5">2</span>
                                        <p>Format foto yang didukung: <strong>JPG, JPEG, PNG, WEBP</strong></p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span
                                            class="w-4 h-4 rounded-full bg-purple-200 text-purple-700 flex items-center justify-center font-black text-[9px] shrink-0 mt-0.5">3</span>
                                        <p>Guru tanpa foto cocok → otomatis pakai <strong>avatar dari nama</strong></p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span
                                            class="w-4 h-4 rounded-full bg-purple-200 text-purple-700 flex items-center justify-center font-black text-[9px] shrink-0 mt-0.5">4</span>
                                        <p>Folder bisa diberi nama: <code class="bg-purple-100 px-1 rounded">foto</code>,
                                            <code class="bg-purple-100 px-1 rounded">photo</code>, atau <code
                                                class="bg-purple-100 px-1 rounded">gambar</code>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Upload Form --}}
                        <form action="{{ route('operator.dataGuru.import') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- Drop zone --}}
                            <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl p-8 flex flex-col items-center gap-3 transition-colors relative"
                                :class="importMode === 'zip' ?
                                    'hover:border-purple-400 dark:hover:border-purple-500' :
                                    'hover:border-blue-400 dark:hover:border-blue-500'"
                                @dragover.prevent @drop.prevent="handleDropImportGuru($event)">

                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center transition-colors"
                                    :class="importMode === 'zip' ?
                                        'bg-purple-50 dark:bg-purple-900/20' :
                                        'bg-blue-50 dark:bg-blue-900/20'">
                                    <i x-show="importMode==='excel'" data-lucide="file-spreadsheet"
                                        class="w-6 h-6 text-blue-500"></i>
                                    <i x-show="importMode==='zip'" data-lucide="archive"
                                        class="w-6 h-6 text-purple-500"></i>
                                </div>

                                <div class="text-center">
                                    <p class="text-sm font-bold text-slate-600 dark:text-slate-300">
                                        Drag & drop file di sini
                                    </p>
                                    <p class="text-[10px] text-slate-400 mt-0.5"
                                        x-text="importMode==='zip'
                                        ? 'Format: .zip — Maks. 20MB'
                                        : 'Format: .xlsx, .xls, .csv — Maks. 20MB'">
                                    </p>
                                </div>

                                <label
                                    class="px-5 py-2.5 rounded-xl text-xs font-bold cursor-pointer hover:opacity-90 transition-all text-white"
                                    :class="importMode === 'zip' ? 'bg-purple-600' : 'bg-blue-600'">
                                    Pilih File
                                    <input type="file" name="file_import" id="fileImportGuruInput"
                                        :accept="importMode === 'zip' ? '.zip' : '.xlsx,.xls,.csv'" class="hidden"
                                        @change="setImportFileGuru($event)">
                                </label>

                                {{-- Badge nama file terpilih --}}
                                <div x-show="importFileNameGuru" x-transition
                                    class="flex items-center gap-2 px-3 py-2 bg-emerald-50 border border-emerald-200 rounded-xl">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                                    <p x-text="importFileNameGuru"
                                        class="text-xs text-emerald-700 font-bold truncate max-w-xs"></p>
                                </div>
                            </div>

                            {{-- Tombol aksi --}}
                            <div class="flex justify-end mt-5 gap-3">
                                <button type="button" @click="closeImportModal()"
                                    class="px-5 py-3 text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-all">
                                    Batal
                                </button>
                                <button type="submit" :disabled="!importFileNameGuru"
                                    :class="!importFileNameGuru ? 'opacity-40 cursor-not-allowed' : 'hover:opacity-90'"
                                    class="px-6 py-3 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center gap-2"
                                    :style="importMode === 'zip' ? 'background:#7c3aed' : 'background:#2563eb'">
                                    <i data-lucide="upload" class="w-4 h-4"></i>
                                    <span x-text="importMode==='zip' ? 'Upload ZIP & Proses' : 'Upload & Proses'"></span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== MODAL FORM GURU (5 STEP) ==================== --}}
        <div id="guruModal" class="fixed inset-0 z-[70] hidden overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div class="flex min-h-full items-start sm:items-center justify-center p-2 sm:p-4 py-4">
                <div
                    class="relative w-full max-w-5xl bg-white dark:bg-slate-900 rounded-[1.5rem] sm:rounded-[2.5rem] shadow-2xl overflow-hidden animate-up">

                    {{-- Header --}}
                    <div class="flex items-center justify-between px-6 sm:px-10 pt-8 pb-0">
                        <div>
                            <h3
                                class="text-xl sm:text-2xl font-black text-slate-800 dark:text-white uppercase tracking-tighter">
                                MASTER DATA <span class="text-emerald-600">GURU</span>
                            </h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Input Informasi
                                Lengkap Pendidik</p>
                        </div>
                        <button @click="closeGuruModal()"
                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 text-slate-500 rounded-full transition-all shrink-0 ml-4">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>

                    {{-- Step Indicator --}}
                    <div class="px-6 sm:px-10 pt-6 pb-4">
                        <div class="relative max-w-2xl mx-auto">
                            <div class="absolute top-5 left-5 right-5 h-[2px] bg-slate-100 dark:bg-slate-800 z-0"></div>
                            <div id="activeLineGuru"
                                class="absolute top-5 left-5 w-0 h-[2px] bg-emerald-500 transition-all duration-500 z-0">
                            </div>
                            <div class="flex justify-between relative z-10">
                                @foreach ([['1', 'Identitas'], ['2', 'Kontak'], ['3', 'Pendidikan'], ['4', 'Sertifikasi'], ['5', 'Kepegawaian']] as $s)
                                    <div class="step-item-guru flex flex-col items-center gap-2">
                                        <div
                                            class="step-circle-guru w-10 h-10 rounded-full {{ $loop->first ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-500/30' : 'bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-400' }} flex items-center justify-center font-bold ring-4 ring-white dark:ring-slate-900 transition-all text-sm">
                                            {{ $s[0] }}
                                        </div>
                                        <span
                                            class="text-[9px] font-black uppercase {{ $loop->first ? 'text-emerald-600' : 'text-slate-400' }} tracking-wider hidden sm:block">{{ $s[1] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form id="formGuruMaster" action="{{ route('operator.dataGuru.store') }}" method="POST"
                        enctype="multipart/form-data" @submit.prevent="validateSubmit">
                        @csrf

                        <div class="flex flex-col lg:flex-row gap-6 px-6 sm:px-10 pb-10">

                            {{-- Foto Upload --}}
                            <div class="w-full lg:w-[200px] shrink-0">
                                <div
                                    class="w-full h-36 lg:h-auto lg:aspect-[3/4] rounded-[1.5rem] border-2 border-dashed border-slate-200 dark:border-slate-700 bg-slate-50/50 flex items-center justify-center relative overflow-hidden">
                                    <img id="previewFoto" class="absolute inset-0 w-full h-full object-cover hidden">
                                    <div id="placeholderFoto" class="flex flex-col items-center gap-2 px-4 text-center">
                                        <i data-lucide="camera" class="w-10 h-10 text-slate-300"></i>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Foto
                                            Guru</span>
                                        <span class="text-[9px] text-slate-300">JPG/PNG, maks 2MB</span>
                                    </div>
                                    <input type="file" name="foto" id="inputFoto"
                                        class="absolute inset-0 opacity-0 cursor-pointer z-[60]"
                                        accept="image/jpeg,image/png,image/jpg" @change="previewImage($event.target)">
                                </div>
                            </div>

                            {{-- Slider Steps (5 step, width 500%) --}}
                            <div class="flex-1 min-w-0 overflow-hidden flex flex-col">
                                <div id="sliderGuru" class="flex transition-transform duration-700 ease-in-out"
                                    style="width:500%">

                                    {{-- STEP 1: IDENTITAS --}}
                                    <div class="flex flex-col justify-between pr-2" style="width:20%">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            @include('operator.partials._formField', [
                                                'name' => 'nip',
                                                'label' => 'NIP (PNS)',
                                                'placeholder' => 'Masukkan NIP',
                                                'type' => 'text',
                                                'optional' => true,
                                            ])
                                            @include('operator.partials._formField', [
                                                'name' => 'nik',
                                                'label' => 'NIK (KTP)',
                                                'placeholder' => '16 digit NIK',
                                                'type' => 'text',
                                                'optional' => true,
                                            ])
                                            @include('operator.partials._formField', [
                                                'name' => 'no_kk',
                                                'label' => 'No. Kartu Keluarga',
                                                'placeholder' => '16 digit No KK',
                                                'type' => 'text',
                                                'optional' => true,
                                            ])
                                            @include('operator.partials._formField', [
                                                'name' => 'nuptk',
                                                'label' => 'NUPTK *',
                                                'placeholder' => '16 digit NUPTK',
                                                'type' => 'text',
                                            ])
                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
                                                    'name' => 'nama',
                                                    'label' => 'Nama Lengkap & Gelar *',
                                                    'placeholder' => 'Contoh: Ahmad Fauzi, S.Pd.',
                                                    'type' => 'text',
                                                ])
                                            </div>
                                            @include('operator.partials._formField', [
                                                'name' => 'tempat_lahir',
                                                'label' => 'Tempat Lahir *',
                                                'placeholder' => 'Kota Lahir',
                                                'type' => 'text',
                                            ])
                                            @include('operator.partials._formField', [
                                                'name' => 'tanggal_lahir',
                                                'label' => 'Tanggal Lahir *',
                                                'placeholder' => 'HH/BB/TTTT',
                                                'type' => 'text',
                                                'id' => 'tanggal_lahir',
                                            ])
                                            @include('operator.partials._formFieldSelect', [
                                                'name' => 'jenis_kelamin',
                                                'label' => 'Jenis Kelamin *',
                                                'id' => 'jenisKelamin',
                                                'placeholder' => 'Pilih',
                                                'options' => [
                                                    'Laki-laki' => 'Laki-laki',
                                                    'Perempuan' => 'Perempuan',
                                                ],
                                            ])
                                            @include('operator.partials._formFieldSelect', [
                                                'name' => 'golongan_darah',
                                                'label' => 'Golongan Darah',
                                                'id' => 'golonganDarah',
                                                'placeholder' => 'Tidak Tahu',
                                                'options' => [
                                                    '-' => 'Tidak Tahu',
                                                    'A' => 'A',
                                                    'B' => 'B',
                                                    'AB' => 'AB',
                                                    'O' => 'O',
                                                ],
                                                'optional' => true,
                                            ])
                                            @include('operator.partials._formFieldSelect', [
                                                'name' => 'agama',
                                                'label' => 'Agama *',
                                                'id' => 'agama',
                                                'placeholder' => 'Pilih',
                                                'options' => [
                                                    'Islam' => 'Islam',
                                                    'Kristen' => 'Kristen',
                                                    'Katolik' => 'Katolik',
                                                    'Hindu' => 'Hindu',
                                                    'Budha' => 'Budha',
                                                    'Khonghucu' => 'Khonghucu',
                                                ],
                                            ])

                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
                                                    'name' => 'nama_ibu_kandung',
                                                    'label' => 'Nama Ibu Kandung',
                                                    'placeholder' => 'Nama lengkap ibu kandung',
                                                    'type' => 'text',
                                                    'optional' => true,
                                                ])
                                            </div>
                                        </div>
                                        @include('operator.partials._stepNav', ['step' => 1, 'max' => 5])
                                    </div>

                                    {{-- STEP 2: KONTAK --}}
                                    <div class="flex flex-col justify-between pr-2" style="width:20%">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
                                                    'name' => 'alamat',
                                                    'label' => 'Alamat Lengkap *',
                                                    'placeholder' =>
                                                        'Jl. Contoh No. 1, RT/RW, Kelurahan, Kecamatan...',
                                                    'type' => 'textarea',
                                                ])
                                            </div>
                                            @include('operator.partials._formField', [
                                                'name' => 'no_hp',
                                                'label' => 'No HP / WhatsApp *',
                                                'placeholder' => '08xxxxxxxxxx',
                                                'type' => 'tel',
                                            ])
                                            @include('operator.partials._formField', [
                                                'name' => 'email',
                                                'label' => 'Email *',
                                                'placeholder' => 'guru@gmail.com',
                                                'type' => 'email',
                                            ])

                                            {{-- Data Keluarga --}}
                                            <div
                                                class="sm:col-span-2 border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Data Keluarga <span class="normal-case font-normal">(opsional)</span>
                                                </p>
                                            </div>

                                            @include('operator.partials._formFieldSelect', [
                                                'name' => 'status_perkawinan',
                                                'label' => 'Status Perkawinan',
                                                'id' => 'statusPerkawinan',
                                                'placeholder' => 'Pilih Status',
                                                'options' => [
                                                    'Belum Menikah' => 'Belum Menikah',
                                                    'Menikah' => 'Menikah',
                                                    'Cerai Hidup' => 'Cerai Hidup',
                                                    'Cerai Mati' => 'Cerai Mati',
                                                ],
                                                'optional' => true,
                                            ])

                                            @include('operator.partials._formField', [
                                                'name' => 'jumlah_anak',
                                                'label' => 'Jumlah Anak',
                                                'placeholder' => '0',
                                                'type' => 'number',
                                                'optional' => true,
                                            ])

                                            {{-- Field Pasangan (conditional) --}}
                                            <div id="dataPasanganSection" class="sm:col-span-2 hidden">
                                                <div
                                                    class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 bg-blue-50 dark:bg-blue-500/10 rounded-2xl border border-blue-100 dark:border-blue-500/20">
                                                    @include('operator.partials._formField', [
                                                        'name' => 'nama_pasangan',
                                                        'label' => 'Nama Suami/Istri',
                                                        'placeholder' => 'Nama lengkap pasangan',
                                                        'type' => 'text',
                                                        'optional' => true,
                                                    ])
                                                    @include('operator.partials._formField', [
                                                        'name' => 'pekerjaan_pasangan',
                                                        'label' => 'Pekerjaan Pasangan',
                                                        'placeholder' => 'Pekerjaan pasangan',
                                                        'type' => 'text',
                                                        'optional' => true,
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                        @include('operator.partials._stepNav', ['step' => 2, 'max' => 5])
                                    </div>

                                    {{-- STEP 3: PENDIDIKAN --}}
                                    <div class="flex flex-col justify-between pr-2" style="width:20%">
                                        <div class="space-y-5">
                                            {{-- Pendidikan Terakhir (Utama) --}}
                                            <div>
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                                                    Pendidikan Terakhir</p>
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                    @include('operator.partials._formFieldSelect', [
                                                        'name' => 'pendidikan',
                                                        'label' => 'Jenjang',
                                                        'id' => 'pendidikanSelect',
                                                        'placeholder' => 'Pilih',
                                                        'options' => [
                                                            'SMA / MA' => 'SMA / MA',
                                                            'D3 - Diploma' => 'D3 - Diploma',
                                                            'S1 - Sarjana' => 'S1 - Sarjana',
                                                            'S2 - Magister' => 'S2 - Magister',
                                                            'S3 - Doktor' => 'S3 - Doktor',
                                                        ],
                                                        'optional' => true,
                                                    ])
                                                    @include('operator.partials._formField', [
                                                        'name' => 'jurusan',
                                                        'label' => 'Jurusan / Prodi',
                                                        'placeholder' => 'Pendidikan Matematika',
                                                        'type' => 'text',
                                                        'optional' => true,
                                                    ])
                                                    <div class="sm:col-span-2">
                                                        @include('operator.partials._formField', [
                                                            'name' => 'kampus',
                                                            'label' => 'Universitas / Sekolah',
                                                            'placeholder' => 'Nama Institusi',
                                                            'type' => 'text',
                                                            'id' => 'kampusInput',
                                                            'optional' => true,
                                                        ])
                                                    </div>
                                                    @include('operator.partials._formField', [
                                                        'name' => 'tahun_lulus',
                                                        'label' => 'Tahun Lulus',
                                                        'placeholder' => '2020',
                                                        'type' => 'number',
                                                        'optional' => true,
                                                    ])
                                                    {{-- Setelah field tahun_lulus --}}
                                                    @include('operator.partials._formField', [
                                                        'name' => 'no_ijazah',
                                                        'label' => 'No. Ijazah',
                                                        'placeholder' => 'Nomor ijazah',
                                                        'type' => 'text',
                                                        'optional' => true,
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                        @include('operator.partials._stepNav', ['step' => 3, 'max' => 5])
                                    </div>

                                    {{-- STEP 4: SERTIFIKASI --}}
                                    <div class="flex flex-col justify-between pr-2" style="width:20%">
                                        <div class="space-y-5">
                                            <div
                                                class="bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/20 rounded-2xl p-4">
                                                <p
                                                    class="text-xs font-bold text-amber-700 dark:text-amber-400 flex items-center gap-2 mb-1">
                                                    <i data-lucide="award" class="w-3.5 h-3.5"></i> Data Sertifikasi Guru
                                                </p>
                                                <p class="text-[11px] text-amber-600/80 dark:text-amber-400/70">Isi jika
                                                    guru sudah memiliki sertifikat pendidik. Kosongkan jika belum.</p>
                                            </div>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                @include('operator.partials._formField', [
                                                    'name' => 'no_sertifikasi',
                                                    'label' => 'Nomor Sertifikasi',
                                                    'placeholder' => 'No. Sertifikat Pendidik',
                                                    'type' => 'text',
                                                    'optional' => true,
                                                ])
                                                @include('operator.partials._formField', [
                                                    'name' => 'tahun_sertifikasi',
                                                    'label' => 'Tahun Sertifikasi',
                                                    'placeholder' => '2020',
                                                    'type' => 'number',
                                                    'optional' => true,
                                                ])
                                                <div class="sm:col-span-2">
                                                    @include('operator.partials._formField', [
                                                        'name' => 'bidang_sertifikasi',
                                                        'label' => 'Bidang Sertifikasi',
                                                        'placeholder' => 'Guru Kelas SD/MI',
                                                        'type' => 'text',
                                                        'optional' => true,
                                                    ])

                                                    {{-- Setelah field bidang_sertifikasi --}}
                                                    @include('operator.partials._formField', [
                                                        'name' => 'nrg',
                                                        'label' => 'NRG (Nomor Registrasi Guru)',
                                                        'placeholder' => 'Nomor Registrasi Guru',
                                                        'type' => 'text',
                                                        'optional' => true,
                                                    ])
                                                    @include('operator.partials._formField', [
                                                        'name' => 'tanggal_terbit_sertifikasi',
                                                        'label' => 'Tanggal Terbit Sertifikasi',
                                                        'placeholder' => 'HH/BB/TTTT',
                                                        'type' => 'text',
                                                        'id' => 'tanggal_terbit_sertifikasi',
                                                        'optional' => true,
                                                    ])
                                                    @include('operator.partials._formField', [
                                                        'name' => 'expired_sertifikasi',
                                                        'label' => 'Expired Sertifikasi',
                                                        'placeholder' => 'HH/BB/TTTT',
                                                        'type' => 'text',
                                                        'id' => 'expired_sertifikasi',
                                                        'optional' => true,
                                                    ])
                                                </div>
                                            </div>

                                            {{-- Mapel, Kelas, Tahun Mengajar --}}
                                            <div
                                                class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-100 dark:border-slate-800">
                                                @include('operator.partials._formFieldSelect', [
                                                    'name' => 'mapel',
                                                    'label' => 'Mata Pelajaran Utama',
                                                    'placeholder' => 'Pilih Mapel',
                                                    'options' => $masterMapel,
                                                    'optional' => true,
                                                ])
                                                @include('operator.partials._formFieldSelect', [
                                                    'name' => 'kelas',
                                                    'label' => 'Kelas Utama',
                                                    'placeholder' => 'Pilih Kelas',
                                                    'options' => $masterKelas,
                                                    'optional' => true,
                                                ])
                                                @include('operator.partials._formField', [
                                                    'name' => 'tahun_mengajar',
                                                    'label' => 'Tahun Mulai Mengajar',
                                                    'placeholder' => 'Contoh: 2015',
                                                    'type' => 'number',
                                                    'optional' => true,
                                                ])
                                            </div>
                                        </div>
                                        @include('operator.partials._stepNav', ['step' => 4, 'max' => 5])
                                    </div>

                                    {{-- STEP 5: KEPEGAWAIAN --}}
                                    <div class="flex flex-col justify-between pr-2" style="width:20%">
                                        <div
                                            class="grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[55vh] pr-2 custom-scrollbar">
                                            @include('operator.partials._formFieldSelect', [
                                                'name' => 'status_kepegawaian',
                                                'label' => 'Status Kepegawaian *',
                                                'id' => 'statusKepegawaian',
                                                'placeholder' => 'Pilih',
                                                'options' => [
                                                    'PNS' => 'PNS',
                                                    'Honorer' => 'Honorer',
                                                    'PPPK' => 'PPPK',
                                                ],
                                                'onchange' => 'toggleFieldPNS()',
                                            ])
                                            @include('operator.partials._formField', [
                                                'name' => 'jabatan',
                                                'label' => 'Jabatan *',
                                                'placeholder' => 'Guru Kelas / Wali Kelas...',
                                                'type' => 'text',
                                            ])

                                            {{-- Field PNS (conditional) --}}
                                            <div id="karpegSection" class="sm:col-span-2 hidden">
                                                <div
                                                    class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 bg-purple-50 dark:bg-purple-500/10 rounded-2xl border border-purple-100 dark:border-purple-500/20">
                                                    @include('operator.partials._formField', [
                                                        'name' => 'no_karpeg',
                                                        'label' => 'No. Karpeg',
                                                        'placeholder' => 'Nomor Karpeg',
                                                        'type' => 'text',
                                                        'optional' => true,
                                                    ])
                                                    @include('operator.partials._formField', [
                                                        'name' => 'no_karis_karsu',
                                                        'label' => 'No. Karis/Karsu',
                                                        'placeholder' => 'Karis/Karsu',
                                                        'type' => 'text',
                                                        'optional' => true,
                                                    ])
                                                    @include('operator.partials._formField', [
                                                        'name' => 'tmt_pns',
                                                        'label' => 'TMT PNS',
                                                        'placeholder' => 'HH/BB/TTTT',
                                                        'type' => 'text',
                                                        'id' => 'tmt_pns',
                                                        'optional' => true,
                                                    ])

                                                    @include('operator.partials._formField', [
                                                        'name' => 'tmt_gty',
                                                        'label' => 'TMT Guru Tetap Yayasan (GTY)',
                                                        'placeholder' => 'HH/BB/TTTT',
                                                        'type' => 'text',
                                                        'id' => 'tmt_gty',
                                                        'optional' => true,
                                                    ])

                                                </div>
                                            </div>

                                            @include('operator.partials._formFieldSelect', [
                                                'name' => 'status_aktif',
                                                'label' => 'Status Aktif *',
                                                'placeholder' => 'Pilih',
                                                'options' => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                                            ])
                                            <div id="golonganField">
                                                @include('operator.partials._formField', [
                                                    'name' => 'golongan',
                                                    'label' => 'Golongan *',
                                                    'placeholder' => 'IV/a',
                                                    'type' => 'text',
                                                    'id' => 'golonganField',
                                                ])
                                            </div>
                                            @include('operator.partials._formField', [
                                                'name' => 'sk_pengangkatan',
                                                'label' => 'No SK Pengangkatan',
                                                'placeholder' => 'SK/2020/...',
                                                'type' => 'text',
                                                'optional' => true,
                                            ])
                                            @include('operator.partials._formField', [
                                                'name' => 'tanggal_sk',
                                                'label' => 'Tanggal SK',
                                                'placeholder' => 'HH/BB/TTTT',
                                                'type' => 'text',
                                                'id' => 'tanggal_sk',
                                                'optional' => true,
                                            ])

                                            @include('operator.partials._formField', [
                                                'name' => 'tanggal_selesai',
                                                'label' => 'Tanggal Selesai Jabatan',
                                                'placeholder' => 'HH/BB/TTTT',
                                                'type' => 'text',
                                                'id' => 'tanggal_selesai',
                                                'optional' => true,
                                            ])

                                            @include('operator.partials._formField', [
                                                'name' => 'tmt_jabatan',
                                                'label' => 'TMT Jabatan',
                                                'placeholder' => 'HH/BB/TTTT',
                                                'type' => 'text',
                                                'id' => 'tmt_jabatan',
                                                'optional' => true,
                                            ])

                                            <div class="sm:col-span-2">
                                                @include('operator.partials._formField', [
                                                    'name' => 'tanggal_bergabung',
                                                    'label' => 'TMT / Tanggal Bergabung *',
                                                    'placeholder' => 'HH/BB/TTTT',
                                                    'type' => 'text',
                                                    'id' => 'tanggal_bergabung',
                                                ])
                                            </div>

                                            {{-- TMT PNS (conditional) --}}
                                            <!-- <div id="tmtPnsField" class="sm:col-span-2 hidden">
                                                                                                                                                                                            <div class="p-4 bg-blue-50 dark:bg-blue-500/10 rounded-2xl border border-blue-100 dark:border-blue-500/20">
                                                                                                                                                                                                @include(
                                                                                                                                                                                                    'operator.partials._formField',
                                                                                                                                                                                                    [
                                                                                                                                                                                                        'name' =>
                                                                                                                                                                                                            'tmt_pns',
                                                                                                                                                                                                        'label' =>
                                                                                                                                                                                                            'TMT PNS (Tanggal Mulai Tugas PNS)',
                                                                                                                                                                                                        'placeholder' =>
                                                                                                                                                                                                            'HH/BB/TTTT',
                                                                                                                                                                                                        'type' =>
                                                                                                                                                                                                            'text',
                                                                                                                                                                                                        'id' =>
                                                                                                                                                                                                            'tmt_pns',
                                                                                                                                                                                                        'optional' => true,
                                                                                                                                                                                                    ]
                                                                                                                                                                                                )
                                                                                                                                                                                            </div>
                                                                                                                                                                                        </div> -->

                                            @include('operator.partials._formField', [
                                                'name' => 'gaji_pokok',
                                                'label' => 'Gaji Pokok',
                                                'placeholder' => 'Contoh: 5000000',
                                                'type' => 'text',
                                                'optional' => true,
                                            ])
                                            {{-- Setelah field gaji_pokok --}}
                                            @include('operator.partials._formField', [
                                                'name' => 'tunjangan_fungsional',
                                                'label' => 'Tunjangan Fungsional',
                                                'placeholder' => 'Contoh: 500000',
                                                'type' => 'text',
                                                'optional' => true,
                                            ])

                                            {{-- Setelah field nama_bank --}}
                                            @include('operator.partials._formField', [
                                                'name' => 'cabang',
                                                'label' => 'Cabang Bank',
                                                'placeholder' => 'Contoh: Cabang Bogor',
                                                'type' => 'text',
                                                'optional' => true,
                                            ])
                                            @include('operator.partials._formField', [
                                                'name' => 'npwp',
                                                'label' => 'NPWP',
                                                'placeholder' => '00.000.000.0-000.000',
                                                'type' => 'text',
                                                'optional' => true,
                                            ])
                                            @include('operator.partials._formField', [
                                                'name' => 'no_rekening',
                                                'label' => 'No. Rekening',
                                                'placeholder' => 'Nomor Rekening',
                                                'type' => 'text',
                                                'optional' => true,
                                            ])
                                            @include('operator.partials._formField', [
                                                'name' => 'nama_bank',
                                                'label' => 'Nama Bank',
                                                'placeholder' => 'BRI, BNI, Mandiri...',
                                                'type' => 'text',
                                                'optional' => true,
                                            ])

                                            @include('operator.partials._formField', [
                                                'name' => 'atas_nama',
                                                'label' => 'Atas Nama Rekening',
                                                'placeholder' => 'Nama pemilik rekening',
                                                'type' => 'text',
                                                'optional' => true,
                                            ])

                                            {{-- Link Akun Login --}}
                                            <div
                                                class="sm:col-span-2 flex flex-col gap-2 pt-2 border-t border-slate-100 dark:border-slate-800">
                                                <label
                                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                                    Akun Login <span
                                                        class="normal-case font-normal text-slate-300">(opsional)</span>
                                                </label>
                                                <select name="user_id" class="field-input">
                                                    <option value="">— Belum dihubungkan ke akun —</option>
                                                    @foreach ($userGuru as $u)
                                                        <option value="{{ $u->id }}">{{ $u->name }}
                                                            ({{ $u->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p class="text-[10px] text-slate-400">Hubungkan guru ini ke akun user agar
                                                    bisa login ke sistem.</p>
                                            </div>
                                        </div>
                                        {{-- Final Step Nav --}}
                                        <div class="flex justify-between items-center mt-6">
                                            <button type="button" @click="goToStep(5, 4)"
                                                class="text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest flex items-center gap-1">
                                                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                                            </button>
                                            <button type="button" @click="validateSubmit()"
                                                class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-lg shadow-emerald-500/30 active:scale-95 transition-all flex items-center gap-2">
                                                <i data-lucide="save" class="w-4 h-4"></i> Simpan Data
                                            </button>
                                        </div>
                                    </div>

                                </div>{{-- /sliderGuru --}}
                            </div>
                        </div>
                    </form>

                    <div id="toastError"
                        class="fixed top-4 right-4 z-[999] hidden bg-rose-500 text-white px-5 py-3 rounded-2xl shadow-lg text-sm font-bold max-w-xs">
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== MODAL KARTU GURU ==================== --}}
        @include('operator.partials._modalKartuGuru')
        @include('operator.partials._modalDokumenGuru')
        @include('operator.partials._modalDiklatGuru')
        @include('operator.partials._modalInpassingGuru')

        {{-- ==================== MODAL ASSIGN USER ==================== --}}
        <div id="assignUserModal" class="fixed inset-0 z-[75] hidden overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative w-full max-w-md bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden animate-up">

                    {{-- Header --}}
                    <div class="px-8 pt-8 pb-0 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tighter">
                                Assign <span class="text-purple-600">Akun User</span>
                            </h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1"
                                id="assignGuruName">
                                Hubungkan guru ke akun login
                            </p>
                        </div>
                        <button @click="closeAssignUserModal()"
                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 rounded-full transition-all">
                            <i data-lucide="x" class="w-5 h-5 text-slate-500"></i>
                        </button>
                    </div>

                    <form id="formAssignUser" method="POST" class="p-8 space-y-5"
                        @submit="
                        const val = document.getElementById('selectUserAssign').value;
                        if (!val) {
                            if (!confirm('Yakin ingin melepas akun user dari guru ini?')) {
                                $event.preventDefault();
                            }
                        }
                    ">
                        @csrf

                        <div class="p-4 bg-purple-50 border border-purple-100 rounded-2xl flex items-start gap-3">
                            <i data-lucide="info" class="w-4 h-4 text-purple-500 shrink-0 mt-0.5"></i>
                            <div class="text-xs text-purple-700 flex-1 space-y-1">
                                <p class="font-bold">Hubungkan guru ke akun user agar bisa login ke sistem.</p>
                                <p>Pilih akun user yang sudah memiliki role <strong>Guru</strong> atau <strong>Wali
                                        Kelas</strong>.</p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                Pilih Akun User
                            </label>
                            <select name="user_id" id="selectUserAssign" class="field-input">
                                <option value="">— Lepas dari akun (unassign) —</option>
                                @foreach ($availableUsers as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-[10px] text-slate-400">Kosongkan untuk melepas hubungan akun.</p>
                        </div>

                        <div class="flex justify-end gap-3 pt-3">
                            <button type="button" @click="closeAssignUserModal()"
                                class="px-5 py-3 text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-all">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center gap-2">
                                <i data-lucide="link" class="w-4 h-4"></i>
                                Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        {{-- ==================== MODAL RECYCLE BIN ==================== --}}
        <div id="trashModal" class="fixed inset-0 z-[70] hidden overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative w-full max-w-4xl bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden animate-up">

                    {{-- Header --}}
                    <div class="px-8 pt-8 pb-0 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tighter">
                                Recycle <span class="text-rose-600">Bin</span>
                            </h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">
                                Data guru yang dihapus — dapat dipulihkan
                            </p>
                        </div>
                        <button @click="closeTrashModal()"
                            class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 rounded-full transition-all">
                            <i data-lucide="x" class="w-5 h-5 text-slate-500"></i>
                        </button>
                    </div>

                    <div class="p-8 space-y-4">
                        {{-- Info banner --}}
                        <div class="p-4 bg-rose-50 border border-rose-100 rounded-2xl flex items-start gap-3">
                            <i data-lucide="info" class="w-4 h-4 text-rose-500 shrink-0 mt-0.5"></i>
                            <div class="text-xs text-rose-700 space-y-1">
                                <p class="font-bold">Data di bawah ini telah dihapus dan tidak muncul di sistem.</p>
                                <p>Klik <strong>Pulihkan</strong> untuk mengembalikan data, atau <strong>Hapus
                                        Permanen</strong> untuk menghapus selamanya beserta semua file terkait.</p>
                            </div>
                        </div>

                        {{-- Loading state --}}
                        <div id="trashLoading" class="py-12 text-center hidden">
                            <div
                                class="w-8 h-8 border-2 border-rose-500 border-t-transparent rounded-full animate-spin mx-auto mb-3">
                            </div>
                            <p class="text-sm text-slate-400">Memuat data...</p>
                        </div>

                        {{-- Empty state --}}
                        <div id="trashEmpty" class="py-12 text-center hidden">
                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="trash-2" class="w-8 h-8 text-slate-300"></i>
                            </div>
                            <p class="text-sm font-bold text-slate-400">Recycle Bin kosong</p>
                            <p class="text-xs text-slate-300 mt-1">Tidak ada data guru yang dihapus</p>
                        </div>

                        {{-- Table --}}
                        <div id="trashTableWrapper" class="hidden">
                            <div class="rounded-2xl border border-slate-100 dark:border-slate-800 overflow-hidden">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr
                                            class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                                            <th
                                                class="px-5 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                Guru</th>
                                            <th
                                                class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                Jabatan</th>
                                            <th
                                                class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                Dihapus Pada</th>
                                            <th
                                                class="px-4 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="trashTableBody" class="divide-y divide-slate-50 dark:divide-slate-800/50">
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div id="trashPagination" class="flex items-center justify-between mt-4">
                                <p id="trashInfo" class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                </p>
                                <div id="trashPaginationBtns" class="flex items-center gap-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Inline CSS untuk field-input helper --}}
    @push('styles')
        <style>
            .field-input {
                @apply w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all text-sm text-slate-700 dark:text-slate-200;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('guruPanel', () => ({
                    // ===== State =====
                    currentStep: 1,
                    totalSteps: 5,
                    fpLahir: null,
                    fpGabung: null,
                    fpSK: null,
                    importMode: 'excel',
                    importFileNameGuru: '',
                    currentGuruForModal: null,

                    // ===== RECYCLE BIN =====
                    trashPage: 1,
                    trashTotal: 0,

                    async openTrashModal() {
                        document.getElementById('trashModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                        await this.loadTrash(1);
                    },

                    closeTrashModal() {
                        document.getElementById('trashModal').classList.add('hidden');
                        document.body.style.overflow = '';
                    },

                    async loadTrash(page = 1) {
                        this.trashPage = page;
                        const loading = document.getElementById('trashLoading');
                        const empty = document.getElementById('trashEmpty');
                        const wrapper = document.getElementById('trashTableWrapper');
                        const body = document.getElementById('trashTableBody');

                        loading.classList.remove('hidden');
                        empty.classList.add('hidden');
                        wrapper.classList.add('hidden');

                        try {
                            const res = await fetch(
                                `{{ route('operator.dataGuru.trash') }}?page=${page}`, {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                });
                            const data = await res.json();

                            loading.classList.add('hidden');

                            if (!data.data || data.data.length === 0) {
                                empty.classList.remove('hidden');
                                return;
                            }

                            wrapper.classList.remove('hidden');
                            this.trashTotal = data.total;

                            body.innerHTML = data.data.map(g => {
                                const namaEscaped = g.nama.replace(/'/g, "\\'");
                                return `
    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
        <td class="px-5 py-4">
            <div class="flex items-center gap-3">
                <img src="${g.foto ? '/storage/' + g.foto : '/assets/default-avatar.svg' + encodeURIComponent(g.nama)}"
                    class="w-9 h-9 rounded-xl object-cover bg-slate-100 opacity-60">
                <div>
                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200 line-through opacity-60">${g.nama}</p>
                    <p class="text-[10px] text-slate-400 font-mono">${g.nuptk ?? '-'}</p>
                </div>
            </div>
        </td>
        <td class="px-4 py-4">
            <span class="text-xs text-slate-500">${g.jabatan}</span>
            <span class="text-[10px] text-slate-400 block">${g.status_kepegawaian}</span>
        </td>
        <td class="px-4 py-4">
            <span class="text-xs text-rose-500 font-bold">${g.deleted_at}</span>
        </td>
        <td class="px-4 py-4 text-right">
            <div class="flex items-center gap-2 justify-end">
                <button onclick="window.guruPanelInstance.restoreGuru(${g.id}, '${namaEscaped}')"
                    class="px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-1">
                    <i data-lucide="rotate-ccw" class="w-3 h-3"></i> Pulihkan
                </button>
                <button onclick="window.guruPanelInstance.forceDeleteGuru(${g.id}, '${namaEscaped}')"
                    class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-1">
                    <i data-lucide="trash" class="w-3 h-3"></i> Permanen
                </button>
            </div>
        </td>
    </tr>
    `;
                            }).join('');

                            // Pagination
                            document.getElementById('trashInfo').textContent =
                                `Total ${data.total} data terhapus`;
                            const paginationEl = document.getElementById('trashPaginationBtns');
                            paginationEl.innerHTML = '';
                            if (data.last_page > 1) {
                                for (let i = 1; i <= data.last_page; i++) {
                                    const btn = document.createElement('button');
                                    btn.textContent = i;
                                    btn.className = `w-8 h-8 rounded-lg text-xs font-bold transition-all ${i === data.current_page
                    ? 'bg-rose-500 text-white'
                    : 'bg-slate-100 text-slate-600 hover:bg-slate-200'}`;
                                    btn.onclick = () => this.loadTrash(i);
                                    paginationEl.appendChild(btn);
                                }
                            }

                            if (typeof lucide !== 'undefined') lucide.createIcons();

                        } catch (e) {
                            loading.classList.add('hidden');
                            this.showToast('Gagal memuat recycle bin.');
                            console.error(e);
                        }
                    },

                    async restoreGuru(id, nama) {
                        if (!confirm(`Pulihkan data guru "${nama}"?`)) return;
                        try {
                            const res = await fetch(`/operator/data-guru/${id}/restore`, {
                                method: 'PATCH',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content,
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });
                            const data = await res.json();
                            if (data.success) {
                                this.showToast(data.message, 'success');
                                await this.loadTrash(this.trashPage);
                            }
                        } catch (e) {
                            this.showToast('Gagal memulihkan data.');
                        }
                    },

                    async forceDeleteGuru(id, nama) {
                        if (!confirm(
                                `HAPUS PERMANEN data guru "${nama}"?\n\nSemua file dan data relasi akan ikut terhapus selamanya.\nTindakan ini TIDAK DAPAT dibatalkan!`
                            )) return;
                        try {
                            const res = await fetch(`/operator/data-guru/${id}/force-delete`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content,
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });
                            const data = await res.json();
                            if (data.success) {
                                this.showToast(data.message, 'success');
                                await this.loadTrash(this.trashPage);
                            }
                        } catch (e) {
                            this.showToast('Gagal menghapus data.');
                        }
                    },
                    openDokumenModal(guru) {
                        // Alpine v3 — gunakan $el atau dispatch event
                        const modalEl = document.getElementById('modalDokumenGuru');
                        if (modalEl && modalEl._x_dataStack) {
                            modalEl._x_dataStack[0].openDokumenModal(guru);
                        }
                    },

                    // ===== INIT =====
                    init() {
                        window.guruPanelInstance = this;
                        this.fpLahir = flatpickr('#tanggal_lahir', {
                            altInput: true,
                            altFormat: 'd/m/Y',
                            dateFormat: 'Y-m-d',
                            allowInput: true,
                            maxDate: 'today'
                        });
                        this.fpTanggalSelesai = flatpickr('#tanggal_selesai', {
                            dateFormat: 'Y-m-d',
                            altInput: true,
                            altFormat: 'd/m/Y',
                            allowInput: true,
                            onClose(_, dateStr) {
                                document.getElementById('tanggal_selesai').value = dateStr;
                            },
                            onChange(_, dateStr) {
                                document.getElementById('tanggal_selesai').value = dateStr;
                            },
                        });
                        this.fpGabung = flatpickr('#tanggal_bergabung', {
                            altInput: true,
                            altFormat: 'd/m/Y',
                            dateFormat: 'Y-m-d',
                            allowInput: true,
                            maxDate: 'today',
                            onClose(_, dateStr) {
                                document.getElementById('tanggal_bergabung').value = dateStr;
                            },
                            onChange(_, dateStr) {
                                document.getElementById('tanggal_bergabung').value = dateStr;
                            },
                        });

                        this.fpSK = flatpickr('#tanggal_sk', {
                            altInput: true,
                            altFormat: 'd/m/Y',
                            dateFormat: 'Y-m-d',
                            allowInput: true,
                            onClose(_, dateStr) {
                                document.getElementById('tanggal_sk').value = dateStr;
                            },
                            onChange(_, dateStr) {
                                document.getElementById('tanggal_sk').value = dateStr;
                            },
                        });

                        this.fpTmtPns = flatpickr('#tmt_pns', {
                            altInput: true,
                            altFormat: 'd/m/Y',
                            dateFormat: 'Y-m-d',
                            allowInput: true,
                            onClose(_, dateStr) {
                                document.getElementById('tmt_pns').value = dateStr;
                            },
                            onChange(_, dateStr) {
                                document.getElementById('tmt_pns').value = dateStr;
                            },
                        });
                        this.fpTanggalTerbitSert = flatpickr('#tanggal_terbit_sertifikasi', {
                            altInput: true,
                            altFormat: 'd/m/Y',
                            dateFormat: 'Y-m-d',
                            allowInput: true,
                        });
                        this.fpExpiredSert = flatpickr('#expired_sertifikasi', {
                            altInput: true,
                            altFormat: 'd/m/Y',
                            dateFormat: 'Y-m-d',
                            allowInput: true,
                        });

                        this.fpTmtGty = flatpickr('#tmt_gty', {
                            altInput: true,
                            altFormat: 'd/m/Y',
                            dateFormat: 'Y-m-d',
                            allowInput: true,
                            onClose(_, dateStr) {
                                document.getElementById('tmt_gty').value = dateStr;
                            },
                            onChange(_, dateStr) {
                                document.getElementById('tmt_gty').value = dateStr;
                            },
                        });

                        this.fpTmtJabatan = flatpickr('#tmt_jabatan', {
                            dateFormat: 'Y-m-d',
                            altInput: true,
                            altFormat: 'd/m/Y',
                            allowInput: true,
                            onClose(selectedDates, dateStr) {
                                // Paksa sync nilai ke input hidden asli
                                document.getElementById('tmt_jabatan').value = dateStr;
                            },
                            onChange(selectedDates, dateStr) {
                                document.getElementById('tmt_jabatan').value = dateStr;
                            },
                        });


                        // Auto-dismiss alerts
                        document.querySelectorAll('#success-alert, #error-alert, .alert-box').forEach(
                            alert => {
                                setTimeout(() => {
                                    alert.style.transition =
                                        'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                                    alert.style.opacity = '0';
                                    alert.style.transform = 'translateY(-10px)';
                                    setTimeout(() => alert.remove(), 600);
                                }, 6000); // 6 seconds
                            });

                        // Live bindings — gunakan event delegation pada form agar selalu aktif
                        document.getElementById('formGuruMaster')?.addEventListener('change', (e) => {
                            if (e.target.id === 'statusKepegawaian') this.toggleFieldPNS();
                            if (e.target.id === 'statusPerkawinan') this.toggleDataPasangan();
                            if (e.target.id === 'pendidikanSelect') this.updateLabelKampus();
                        });

                        this.toggleFieldPNS();
                        this.toggleDataPasangan();
                        this.updateLabelKampus();
                        this.bindLiveValidation();

                        // Auto-submit filter form on select change
                        ['filterJabatan', 'filterStatus', 'filterSertifikasi', 'filterKepegawaian'].forEach(
                            id => {
                                document.getElementById(id)?.addEventListener('change', () => {
                                    document.getElementById('filterForm').submit();
                                });
                            });

                        // Debounced search
                        let searchTimer;
                        document.getElementById('searchGuru')?.addEventListener('input', () => {
                            clearTimeout(searchTimer);
                            searchTimer = setTimeout(() => document.getElementById('filterForm')
                                .submit(), 600);
                        });

                        @if ($errors->any())
                            this.openGuruModal();
                        @endif
                    },

                    // ===== STEP NAVIGATION =====
                    moveGuruSlider(step) {
                        const slider = document.getElementById('sliderGuru');
                        const line = document.getElementById('activeLineGuru');
                        const circles = document.querySelectorAll('.step-circle-guru');
                        const texts = document.querySelectorAll('.step-item-guru span');
                        this.currentStep = step;

                        slider.style.transform = `translateX(-${(step-1) * 20}%)`;
                        const pct = ((step - 1) / (this.totalSteps - 1)) * 100;
                        line.style.width = `${pct}%`;

                        circles.forEach((c, i) => {
                            const n = i + 1;
                            if (n < step) {
                                c.innerHTML = '✓';
                                c.className =
                                    'step-circle-guru w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 flex items-center justify-center font-bold transition-all ring-4 ring-white dark:ring-slate-900';
                                if (texts[i]) texts[i].className =
                                    'text-[9px] font-black uppercase text-emerald-600 tracking-wider hidden sm:block';
                            } else if (n === step) {
                                c.innerHTML = n;
                                c.className =
                                    'step-circle-guru w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold shadow-lg shadow-emerald-500/30 transition-all ring-4 ring-white dark:ring-slate-900';
                                if (texts[i]) texts[i].className =
                                    'text-[9px] font-black uppercase text-emerald-600 tracking-wider hidden sm:block';
                            } else {
                                c.innerHTML = n;
                                c.className =
                                    'step-circle-guru w-10 h-10 rounded-full bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-400 flex items-center justify-center font-bold transition-all ring-4 ring-white dark:ring-slate-900';
                                if (texts[i]) texts[i].className =
                                    'text-[9px] font-black uppercase text-slate-400 tracking-wider hidden sm:block';
                            }
                        });
                    },

                    goToStep(from, to) {
                        if (to > from && !this.validateStep(from)) return;
                        if (to < from) this.clearStepErrors(from);
                        this.moveGuruSlider(to);
                    },

                    // ===== MODAL OPEN/CLOSE =====
                    openGuruModal() {
                        const form = document.getElementById('formGuruMaster');
                        form.action = `{{ route('operator.dataGuru.store') }}`;
                        form.reset();
                        document.getElementById('methodPut')?.remove();
                        document.getElementById('previewFoto').src = '';
                        document.getElementById('previewFoto').classList.add('hidden');
                        document.getElementById('placeholderFoto').classList.remove('hidden');
                        for (let i = 1; i <= this.totalSteps; i++) this.clearStepErrors(i);
                        this.updateLabelKampus();
                        this.toggleFieldPNS();
                        this.toggleDataPasangan();
                        this.moveGuruSlider(1);
                        document.getElementById('guruModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    },

                    closeGuruModal() {
                        document.getElementById('guruModal').classList.add('hidden');
                        document.body.style.overflow = '';
                        document.getElementById('inputFoto').value = '';
                    },

                    openImportModal() {
                        this.importFileNameGuru = '';
                        this.importMode = 'excel';
                        document.getElementById('importModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    },

                    closeImportModal() {
                        document.getElementById('importModal').classList.add('hidden');
                        document.body.style.overflow = '';
                    },

                    setImportFileGuru(e) {
                        this.importFileNameGuru = e.target.files[0]?.name ?? '';
                    },

                    handleDropImportGuru(e) {
                        const file = e.dataTransfer.files[0];
                        if (!file) return;
                        const input = document.getElementById('fileImportGuruInput');
                        const dt = new DataTransfer();
                        dt.items.add(file);
                        input.files = dt.files;
                        this.importFileNameGuru = file.name;
                    },

                    // ===== EDIT GURU =====
                    async editGuru(guruId) {
                        try {
                            const res = await fetch(`/operator/data-guru/${guruId}/show`);
                            if (!res.ok) throw new Error('Gagal fetch data guru');
                            const guru = await res.json();

                            const form = document.getElementById('formGuruMaster');
                            form.reset();

                            const alamatEl = form.querySelector('[name="alamat"]');
                            if (alamatEl) alamatEl.value = '';

                            for (let i = 1; i <= this.totalSteps; i++) this.clearStepErrors(i);

                            const fields = [
                                'nip', 'nik', 'no_kk', 'no_karpeg', 'no_karis_karsu',
                                'nuptk', 'no_sertifikasi', 'tahun_sertifikasi',
                                'bidang_sertifikasi',
                                'nama', 'tempat_lahir', 'jenis_kelamin', 'golongan_darah', 'agama',
                                'status_perkawinan', 'nama_pasangan', 'pekerjaan_pasangan',
                                'jumlah_anak',
                                'nama_ibu_kandung', 'no_hp', 'email',
                                'pendidikan', 'jurusan', 'kampus', 'tahun_lulus',
                                'mapel', 'kelas', 'tahun_mengajar',
                                'status_kepegawaian', 'jabatan', 'golongan', 'status_aktif',
                                'sk_pengangkatan', 'gaji_pokok', 'npwp', 'no_rekening', 'nama_bank',
                                'user_id', 'tmt_gty', 'tmt_jabatan', 'atas_nama', 'tanggal_selesai',
                                'nrg', 'no_ijazah', 'tunjangan_fungsional', 'cabang',
                            ];

                            fields.forEach(f => {
                                const el = form.querySelector(`[name="${f}"]`);
                                if (!el) return;
                                el.value = guru[f] ?? '';
                            });

                            if (alamatEl) alamatEl.value = guru.alamat ?? '';

                            const statusAktifEl = form.querySelector('[name="status_aktif"]');
                            if (statusAktifEl) {
                                statusAktifEl.value = (guru.status_aktif == true || guru.status_aktif ==
                                    1) ? '1' : '0';
                            }

                            this.fpTanggalTerbitSert?.clear();
                            if (guru.tanggal_terbit_sertifikasi) this.fpTanggalTerbitSert?.setDate(guru
                                .tanggal_terbit_sertifikasi);

                            this.fpExpiredSert?.clear();
                            if (guru.expired_sertifikasi) this.fpExpiredSert?.setDate(guru
                                .expired_sertifikasi);

                            this.fpLahir?.clear();
                            if (guru.tanggal_lahir) this.fpLahir?.setDate(guru.tanggal_lahir);

                            this.fpTanggalSelesai?.clear();
                            if (guru.tanggal_selesai) this.fpTanggalSelesai?.setDate(guru
                                .tanggal_selesai);

                            this.fpGabung?.clear();
                            if (guru.tanggal_bergabung) this.fpGabung?.setDate(guru.tanggal_bergabung);

                            this.fpSK?.clear();
                            if (guru.tanggal_sk) this.fpSK?.setDate(guru.tanggal_sk);

                            this.fpTmtPns?.clear();
                            if (guru.tmt_pns) this.fpTmtPns?.setDate(guru.tmt_pns);

                            this.fpTmtGty?.clear();
                            if (guru.tmt_gty) this.fpTmtGty?.setDate(guru.tmt_gty);

                            this.fpTmtJabatan?.clear();
                            if (guru.tmt_jabatan) this.fpTmtJabatan?.setDate(guru.tmt_jabatan);

                            const preview = document.getElementById('previewFoto');
                            preview.src = guru.foto ?
                                `/storage/${guru.foto}` :
                                `/assets/default-avatar.svg`;
                            preview.classList.remove('hidden');
                            document.getElementById('placeholderFoto').classList.add('hidden');

                            this.updateLabelKampus();
                            this.toggleFieldPNS();
                            this.toggleDataPasangan();



                            form.action = `/operator/data-guru/${guru.id}`;
                            if (!document.getElementById('methodPut')) {
                                const m = document.createElement('input');
                                m.type = 'hidden';
                                m.name = '_method';
                                m.value = 'PUT';
                                m.id = 'methodPut';
                                form.appendChild(m);
                            }

                            this.moveGuruSlider(1);
                            document.getElementById('guruModal').classList.remove('hidden');
                            document.body.style.overflow = 'hidden';

                        } catch (e) {
                            this.showToast('Gagal memuat data guru. Silakan coba lagi.');
                            console.error(e);
                        }
                    },

                    // ===== DELETE =====
                    deleteGuru(id, nama) {
                        if (!confirm(
                                `Yakin hapus data guru "${nama}"?\nTindakan ini tidak dapat dibatalkan.`))
                            return;
                        fetch(`/operator/data-guru/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .content
                                }
                            })
                            .then(r => r.json())
                            .then(d => {
                                if (d.success) {
                                    document.querySelector(`tr[data-guru-id="${id}"]`)?.remove();
                                    this.showToast('Data guru berhasil dihapus.', 'success');
                                }
                            })
                            .catch(() => this.showToast('Terjadi kesalahan saat menghapus.'));
                    },

                    // ===== KARTU GURU =====
                    async openKartuGuru(guruOrId) {
                        // Terima ID atau objek guru
                        const guruId = typeof guruOrId === 'object' ? guruOrId.id : guruOrId;

                        // Fetch data lengkap dari server
                        let guru;
                        try {
                            const res = await fetch(`/operator/data-guru/${guruId}/show`);
                            if (!res.ok) throw new Error('Gagal fetch');
                            guru = await res.json();
                        } catch (e) {
                            this.showToast('Gagal memuat data guru.');
                            console.error(e);
                            return;
                        }

                        this.currentGuruForModal = guru;

                        const fmt = (tgl) => tgl ? new Date(tgl).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        }) : '-';

                        const getMasaBakti = (tgl) => {
                            if (!tgl) return '-';
                            const d = new Date(),
                                s = new Date(tgl);
                            let y = d.getFullYear() - s.getFullYear(),
                                m = d.getMonth() - s.getMonth();
                            if (m < 0) {
                                y--;
                                m += 12;
                            }
                            if (y === 0 && m === 0) return 'Baru Bergabung';
                            if (y === 0) return `${m} Bulan Mengajar`;
                            if (m === 0) return `${y} Tahun Mengajar`;
                            return `${y} Thn ${m} Bln Mengajar`;
                        };

                        const set = (id, val) => {
                            document.querySelectorAll(`#${id}`).forEach(e => e.innerText = val ??
                                '-');
                        };

                        const isWali = guru.kelas_wali !== null && guru.kelas_wali !== undefined;
                        const waliStr = isWali ?
                            `Wali Kelas ${guru.kelas_wali?.tingkat}${guru.kelas_wali?.nama_kelas}` :
                            null;

                        document.getElementById('kartu_foto').src = guru.foto ?
                            `/storage/${guru.foto}` :
                            `/assets/default-avatar.svg`;

                        // ── Data Utama
                        set('kartu_nama_lengkap', guru.nama);
                        set('kartu_nip', guru.nip);
                        set('kartu_nuptk', guru.nuptk);
                        set('kartu_jabatan_main', guru.status_kepegawaian ?? '-');
                        set('kartu_status_aktif', guru.status_aktif == 1 ? 'Aktif' : 'Nonaktif');
                        set('kartu_golongan', (guru.status_kepegawaian === 'PNS' && guru.golongan) ?
                            guru.golongan : '-');

                        // ── Sertifikasi (banner kiri)
                        const isCert = guru.no_sertifikasi && !['', '-', '–'].includes(String(guru
                            .no_sertifikasi).trim());
                        set('kartu_no_sertifikasi', isCert ?
                            `${guru.no_sertifikasi} (${guru.tahun_sertifikasi ?? '–'})` :
                            'Belum Sertifikasi');

                        // ── Data Pribadi
                        set('kartu_jk', guru.jenis_kelamin);
                        set('kartu_agama', guru.agama);
                        set('kartu_tempat_lahir', guru.tempat_lahir);
                        set('kartu_tgl_lahir', fmt(guru.tanggal_lahir));
                        set('kartu_nik', guru.nik);
                        set('kartu_no_kk', guru.no_kk);
                        set('kartu_golongan_darah', guru.golongan_darah);
                        set('kartu_nama_ibu_kandung', guru.nama_ibu_kandung);

                        // ── Pendidikan
                        set('kartu_pendidikan', guru.pendidikan);
                        set('kartu_jurusan', guru.jurusan);
                        set('kartu_kampus', guru.kampus);
                        set('kartu_no_ijazah', guru.no_ijazah);
                        set('kartu_tahun_lulus', guru.tahun_lulus ?? '-');
                        // Badge pendidikan
                        const badge = document.getElementById('kartu_pendidikan_badge');
                        if (badge) {
                            const match = guru.pendidikan ? guru.pendidikan.match(
                                /(S1|S2|S3|D3|SMA)/i) : null;
                            const short = match ? match[0].toUpperCase() : null;
                            if (short) {
                                badge.innerText = short;
                                badge.classList.remove('hidden');
                                const colors = {
                                    'S1': 'bg-blue-100 text-blue-700',
                                    'S2': 'bg-purple-100 text-purple-700',
                                    'S3': 'bg-amber-100 text-amber-700',
                                    'D3': 'bg-emerald-100 text-emerald-700',
                                    'SMA': 'bg-slate-100 text-slate-700'
                                };
                                badge.className =
                                    `px-1.5 py-0.5 rounded-md text-[9px] font-black mr-1 uppercase ${colors[short] || 'bg-slate-100 text-slate-700'}`;
                            } else {
                                badge.classList.add('hidden');
                            }
                        }

                        // ── Keluarga
                        set('kartu_status_perkawinan', guru.status_perkawinan);
                        set('kartu_nama_pasangan', guru.nama_pasangan);
                        set('kartu_jumlah_anak', guru.jumlah_anak ? guru.jumlah_anak + ' Anak' :
                            '0 Anak');
                        set('kartu_pekerjaan_pasangan', guru.pekerjaan_pasangan);

                        // ── Kepegawaian
                        set('kartu_no_karpeg', guru.no_karpeg);
                        set('kartu_no_karis_karsu', guru.no_karis_karsu);
                        set('kartu_tmt_pns', fmt(guru.tmt_pns));
                        set('kartu_tmt_gty', fmt(guru.tmt_gty));
                        set('kartu_tmt_jabatan', fmt(guru.tmt_jabatan));
                        set('kartu_tanggal_selesai_jabatan', fmt(guru.tanggal_selesai));
                        set('kartu_sk_pengangkatan', guru.sk_pengangkatan);
                        set('kartu_tanggal_sk', fmt(guru.tanggal_sk));
                        set('kartu_status_kepegawaian', guru.status_kepegawaian);
                        set('kartu_tanggal_bergabung', fmt(guru.tanggal_bergabung));

                        // ── Sertifikasi (field grid)
                        set('kartu_no_sertifikasi_field', guru.no_sertifikasi);
                        set('kartu_bidang_sertifikasi', guru.bidang_sertifikasi);
                        set('kartu_nrg', guru.nrg);
                        set('kartu_tanggal_terbit_sertifikasi', fmt(guru.tanggal_terbit_sertifikasi));
                        set('kartu_expired_sertifikasi', fmt(guru.expired_sertifikasi));
                        set('kartu_tahun_sertifikasi', guru.tahun_sertifikasi ?? '-');

                        // ── Kontak
                        set('kartu_alamat', guru.alamat);
                        set('kartu_email', guru.email);
                        set('kartu_no_hp', guru.no_hp);

                        // ── Mengajar
                        set('kartu_mapel', guru.mapel ?? 'Belum Ditentukan');
                        set('kartu_jabatan', isWali ? waliStr : guru.jabatan);
                        set('kartu_kelas', isWali ? waliStr : (guru.kelas ?? '-'));
                        set('kartu_tahun_mengajar', getMasaBakti(guru.tanggal_bergabung));

                        // ── Keuangan
                        set('kartu_npwp', guru.npwp ?? '-');
                        set('kartu_gaji_pokok', guru.gaji_pokok ? 'Rp ' + parseInt(guru.gaji_pokok)
                            .toLocaleString('id-ID') : '-');
                        set('kartu_tunjangan_fungsional', guru.tunjangan_fungsional ?
                            'Rp ' + parseInt(guru.tunjangan_fungsional).toLocaleString('id-ID') :
                            '-');
                        set('kartu_rekening', guru.no_rekening ?
                            `${guru.no_rekening} (${guru.nama_bank ?? ''})` : '-');
                        set('kartu_cabang_bank', guru.cabang);
                        set('kartu_jenis_sertifikasi', guru.jenis_sertifikasi);

                        // ── Berkas Digital — ijazah
                        const linkIjazah = document.getElementById('kartu_link_ijazah');
                        if (linkIjazah) {
                            if (guru.file_ijazah_url) {
                                linkIjazah.href = guru.file_ijazah_url;
                                linkIjazah.style.display = 'inline-flex';
                                linkIjazah.style.alignItems = 'center';
                                linkIjazah.style.gap = '4px';
                            } else {
                                linkIjazah.style.display = 'none';
                            }
                        }

                        // ── Berkas Digital — sertifikat
                        const linkSertifikat = document.getElementById('kartu_link_sertifikat');
                        if (linkSertifikat) {
                            if (guru.file_sertifikat_url) {
                                linkSertifikat.href = guru.file_sertifikat_url;
                                linkSertifikat.style.display = 'inline-flex';
                                linkSertifikat.style.alignItems = 'center';
                                linkSertifikat.style.gap = '4px';
                            } else {
                                linkSertifikat.style.display = 'none';
                            }
                        }

                        // ── Kehadiran & Beban JP (dinamis — fallback ke placeholder jika null)
                        const persen = guru.persen_kehadiran;
                        const totalJP = guru.total_jp;

                        const persenLabel = document.getElementById('kartu_persen_kehadiran_label');
                        const persenBar = document.getElementById('kartu_kehadiran_bar');
                        const jpLabel = document.getElementById('kartu_total_jp');

                        if (persenLabel) persenLabel.textContent = persen !== null ? `${persen}%` :
                            'N/A';
                        if (persenBar) persenBar.style.width = persen !== null ?
                            `${Math.min(persen, 100)}%` : '0%';
                        if (jpLabel) jpLabel.textContent = totalJP !== null ? `${totalJP} JP` : '— JP';
                        set('kartu_atas_nama_rekening', guru.atas_nama);
                        set('kartu_rekening', guru.no_rekening ?? '-');
                        set('kartu_nama_bank', guru.nama_bank ?? '-');
                        set('kartu_cabang_bank', guru.cabang ?? '-');
                        set('kartu_atas_nama_rekening', guru.atas_nama ?? '-');
                        // ── PERBAIKAN 2: Badge verified dinamis
                        const verifiedIcon = document.getElementById('kartu_verified_icon');
                        const verifiedLabel = document.getElementById('kartu_verified_label');
                        const auditTrail = document.getElementById('kartu_audit_trail');
                        if (verifiedIcon && verifiedLabel) {
                            if (guru.is_verified) {
                                verifiedIcon.classList.replace('text-slate-300', 'text-emerald-500');
                                verifiedLabel.textContent = 'Verified ID';
                                verifiedLabel.classList.replace('text-slate-400', 'text-emerald-600');
                                if (auditTrail) {
                                    auditTrail.classList.remove('hidden');
                                    document.getElementById('kartu_verified_by').textContent = guru
                                        .verified_by_name ?? '—';
                                    document.getElementById('kartu_verified_time').textContent = guru
                                        .verified_at ?? '—';
                                }
                            } else {
                                verifiedIcon.classList.replace('text-emerald-500', 'text-slate-300');
                                verifiedLabel.textContent = 'Belum Diverifikasi';
                                verifiedLabel.classList.replace('text-emerald-600', 'text-slate-400');
                                if (auditTrail) auditTrail.classList.add('hidden');
                            }
                        }

                        // ── PERBAIKAN 5: Semua riwayat pendidikan
                        const pendLainWrapper = document.getElementById(
                            'kartu_pendidikan_lain_wrapper');
                        const pendLainEl = document.getElementById('kartu_pendidikan_lain');
                        if (pendLainEl && guru.semua_pendidikan?.length > 1) {
                            pendLainWrapper?.classList.remove('hidden');
                            // tampilkan semua kecuali yang sudah ditampilkan di field utama
                            const lain = guru.semua_pendidikan.slice(1);
                            pendLainEl.innerHTML = lain.map(p => `
        <div class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2 text-[11px]">
            <span class="font-black text-slate-700 dark:text-white">${p.jenjang}</span>
            <span class="text-slate-400 mx-1">·</span>
            <span class="text-slate-500">${p.jurusan ?? '-'}</span>
            <span class="text-slate-300 mx-1">·</span>
            <span class="text-slate-400">${p.nama_sekolah ?? '-'} (${p.tahun_lulus ?? '-'})</span>
        </div>
    `).join('');
                        } else {
                            pendLainWrapper?.classList.add('hidden');
                        }

                        // ── PERBAIKAN 4: Render riwayat jabatan
                        const jabatanList = document.getElementById('kartu_jabatan_list');
                        const jabatanEmpty = document.getElementById('kartu_jabatan_empty');
                        if (jabatanList) {
                            jabatanList.innerHTML = '';
                            const riwayat = guru.riwayat_jabatan ?? [];
                            if (riwayat.length === 0) {
                                jabatanList.classList.add('hidden');
                                jabatanEmpty?.classList.remove('hidden');
                            } else {
                                jabatanList.classList.remove('hidden');
                                jabatanEmpty?.classList.add('hidden');
                                riwayat.forEach(j => {
                                    const isCurrent = j.is_current;
                                    const card = document.createElement('div');
                                    card.className = `p-4 rounded-2xl border ${isCurrent
                ? 'border-blue-200 bg-blue-50/50 dark:bg-blue-500/5'
                : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50'} flex flex-col gap-2`;
                                    card.innerHTML = `
                <div class="flex items-start justify-between gap-2">
                    <span class="text-[13px] font-black ${isCurrent ? 'text-blue-700 dark:text-blue-300' : 'text-slate-600 dark:text-slate-300'} leading-tight">${j.jabatan}</span>
                    ${isCurrent ? '<span class="text-[9px] font-black bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full uppercase tracking-wider shrink-0">Aktif</span>' : ''}
                </div>
                <div class="flex flex-wrap gap-1.5 text-[10px]">
                    ${j.status_kepegawaian ? `<span class="bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-0.5 rounded-md font-bold">${j.status_kepegawaian}</span>` : ''}
                    ${j.golongan ? `<span class="bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-md font-bold">Gol. ${j.golongan}</span>` : ''}
                </div>
                <div class="text-[10px] text-slate-400 mt-1">
                    <span>TMT: ${j.tmt_jabatan ? new Date(j.tmt_jabatan).toLocaleDateString('id-ID', {day:'numeric',month:'short',year:'numeric'}) : '—'}</span>
                    ${j.tanggal_selesai ? `<span class="mx-1">·</span><span>s/d ${new Date(j.tanggal_selesai).toLocaleDateString('id-ID', {day:'numeric',month:'short',year:'numeric'})}</span>` : ''}
                </div>
                ${j.sk_nomor ? `<p class="font-mono text-[10px] text-slate-400 bg-slate-50 dark:bg-slate-900 px-2 py-1 rounded-md border border-slate-100 dark:border-slate-700">SK: ${j.sk_nomor}</p>` : ''}
            `;
                                    jabatanList.appendChild(card);
                                });
                            }
                        }

                        // ── PERBAIKAN 7: Tahun mengajar — tampilkan manual jika ada, fallback ke masa bakti
                        const tahunMengajarEl = document.getElementById('kartu_tahun_mengajar');
                        if (tahunMengajarEl) {
                            const manual = guru.tahun_mengajar_manual;
                            const masaBaktiStr = getMasaBakti(guru
                                .tanggal_bergabung); // nama variabel juga diganti
                            tahunMengajarEl.textContent = manual ? `Sejak ${manual} · ${masaBaktiStr}` :
                                masaBaktiStr;
                        }

                        // ── QR & ID
                        const idSystem =
                            `NH3-${new Date().getFullYear()}-${String(guru.id).padStart(4, '0')}`;
                        set('kartu_id_system', idSystem);
                        document.getElementById('kartu_qr_code').src =
                            `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(`GURU:${guru.nama}|NIP:${guru.nip}|ID:${idSystem}`)}`;

                        document.getElementById('btnUbahDataKartu').onclick = () => {
                            this.closeKartuGuru();
                            this.editGuru(guru.id);
                        };

                        // ── Buka modal
                        const modal = document.getElementById('modalKartuGuru');
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                        setTimeout(() => modal.classList.add('opacity-100'), 10);
                        setTimeout(() => {
                            if (typeof lucide !== 'undefined') lucide.createIcons();
                        }, 50);

                        // ── Load diklat & inpassing
                        this.loadKartuDiklat(guru.id);
                        this.loadKartuInpassing(guru.id);
                    },

                    closeKartuGuru() {
                        const m = document.getElementById('modalKartuGuru');
                        m.classList.remove('opacity-100');
                        setTimeout(() => {
                            m.classList.add('hidden');
                            m.classList.remove('flex');
                            document.body.style.overflow = '';
                        }, 300);
                    },

                    openDiklatModal(guru) {
                        const modalEl = document.getElementById('modalDiklatGuru');
                        if (modalEl?._x_dataStack?.[0]) {
                            modalEl._x_dataStack[0].openDiklatModal(guru);
                        }
                    }, // ← tambahkan penutup ini

                    openInpassingModal(guru) {
                        const modalEl = document.getElementById('modalInpassingGuru');
                        if (modalEl?._x_dataStack?.[0]) {
                            modalEl._x_dataStack[0].openInpassingModal(guru);
                        }
                    },

                    async loadKartuInpassing(guruId) {
                        try {
                            const res = await fetch(`/operator/data-guru/${guruId}/inpassing`, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });
                            const data = await res.json();

                            // Map data to helper format
                            const items = (data.inpassings || []).map(ip => ({
                                nama_pangkat: ip.jabatan_fungsional,
                                golongan: ip.golongan_sesudah,
                                tmt: ip.tmt_inpassing_fmt,
                                no_sk: ip.no_sk,
                                is_aktif: ip.status === 'aktif'
                            }));

                            if (typeof renderInpassingList === 'function') {
                                renderInpassingList(items);
                            }
                        } catch (e) {
                            console.error('Gagal load inpassing kartu:', e);
                        }
                    },

                    // async loadKartuDiklat(guruId) {
                    //     try {
                    //         const res = await fetch(`/operator/data-guru/${guruId}/diklat`, {
                    //             headers: {
                    //                 'X-Requested-With': 'XMLHttpRequest'
                    //             }
                    //         });
                    //         const data = await res.json();

                    //         // Map data to helper format
                    //         const items = (data.diklats || []).map(d => ({
                    //             nama: d.nama_diklat,
                    //             penyelenggara: d.penyelenggara,
                    //             jp: d.jp,
                    //             tahun: d.tahun
                    //         }));

                    //         if (typeof renderDiklatList === 'function') {
                    //             renderDiklatList(items);
                    //         }
                    //     } catch (e) {
                    //         console.error('Gagal load diklat kartu:', e);
                    //     }
                    // },

                    // ===== ASSIGN USER =====
                    openAssignUserModal(guruId, guruName, userObj) {
                        const form = document.getElementById('formAssignUser');
                        form.action = `/operator/data-guru/${guruId}/assign-user`;
                        document.getElementById('assignGuruName').innerText = `Guru: ${guruName}`;

                        const select = document.getElementById('selectUserAssign');
                        const currentUserId = userObj ? userObj.id : '';

                        // Cek apakah user saat ini sudah ada di dropdown
                        let exists = false;
                        Array.from(select.options).forEach(opt => {
                            if (opt.value == currentUserId) exists = true;
                        });

                        // Jika tidak ada (dan userObj valid), tambahkan secara dinamis
                        if (!exists && userObj) {
                            const opt = document.createElement('option');
                            opt.value = userObj.id;
                            opt.text = `${userObj.name} (${userObj.email}) — [User Saat Ini]`;
                            select.add(opt);
                        }

                        select.value = currentUserId;

                        document.getElementById('assignUserModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    },

                    closeAssignUserModal() {
                        document.getElementById('assignUserModal').classList.add('hidden');
                        document.body.style.overflow = '';
                    },

                    // ===== IMAGE PREVIEW =====
                    previewImage(input) {
                        if (input.files?.[0]) {
                            const r = new FileReader();
                            r.onload = e => {
                                document.getElementById('previewFoto').src = e.target.result;
                                document.getElementById('previewFoto').classList.remove('hidden');
                                document.getElementById('placeholderFoto').classList.add('hidden');
                            };
                            r.readAsDataURL(input.files[0]);
                        }
                    },

                    // ===== UI HELPERS =====
                    toggleFieldPNS() {
                        const statusKepegawaian = document.getElementById('statusKepegawaian');
                        const golonganField = document.getElementById('golonganField');
                        const karpegSection = document.getElementById('karpegSection');

                        if (!statusKepegawaian) return; // guard

                        const val = statusKepegawaian.value;
                        if (val === 'PNS' || val === 'PPPK') {
                            golonganField?.classList.remove('hidden');
                            karpegSection?.classList.remove('hidden');
                        } else {
                            golonganField?.classList.add('hidden');
                            karpegSection?.classList.add('hidden');
                        }
                    },

                    toggleDataPasangan() {
                        const status = document.getElementById('statusPerkawinan');
                        const section = document.getElementById('dataPasanganSection');
                        if (!status || !section) return;

                        if (status.value === 'Menikah') {
                            section.style.display = '';
                            section.classList.remove('hidden');
                        } else {
                            section.style.display = 'none';
                            section.classList.add('hidden');
                        }
                    },

                    updateLabelKampus() {
                        const sel = document.getElementById('pendidikanSelect');
                        const input = document.getElementById('kampusInput');
                        if (!sel || !input) return;
                        const label = input.closest('.flex.flex-col')?.querySelector('label');
                        if (label) label.innerText = sel.value === 'SMA / MA' ? 'Asal Sekolah' :
                            'Universitas / Kampus';
                    },

                    showToast(message, type = 'error') {
                        const t = document.getElementById('toastError');
                        t.innerText = message;
                        t.className =
                            `fixed top-4 right-4 z-[999] text-white px-5 py-3 rounded-2xl shadow-lg text-sm font-bold max-w-xs ${type==='success' ? 'bg-emerald-500' : 'bg-rose-500'}`;
                        t.classList.remove('hidden');
                        clearTimeout(t._timer);
                        t._timer = setTimeout(() => t.classList.add('hidden'), 3500);
                    },

                    // ===== VALIDATION =====
                    STEP_RULES: {
                        1: [{
                                name: 'nuptk',
                                label: 'NUPTK',
                                type: 'required'
                            },
                            {
                                name: 'nama',
                                label: 'Nama Lengkap',
                                type: 'required'
                            },
                            {
                                name: 'tempat_lahir',
                                label: 'Tempat Lahir',
                                type: 'required'
                            },
                            {
                                name: 'tanggal_lahir',
                                label: 'Tanggal Lahir',
                                type: 'required'
                            },
                            {
                                name: 'jenis_kelamin',
                                label: 'Jenis Kelamin',
                                type: 'select'
                            },
                            {
                                name: 'agama',
                                label: 'Agama',
                                type: 'select'
                            },
                            {
                                name: 'nik',
                                label: 'NIK',
                                type: 'nik_optional'
                            }, // tambah
                            {
                                name: 'no_kk',
                                label: 'No KK',
                                label: 'No KK',
                                type: 'nokk_optional'
                            }, // tambah
                        ],

                        2: [{
                                name: 'alamat',
                                label: 'Alamat',
                                type: 'required'
                            },
                            {
                                name: 'no_hp',
                                label: 'No HP',
                                type: 'phone'
                            },
                            {
                                name: 'email',
                                label: 'Email',
                                type: 'email'
                            },
                        ],
                        3: [],
                        4: [],
                        5: [{
                                name: 'jabatan',
                                label: 'Jabatan',
                                type: 'required'
                            },
                            {
                                name: 'tanggal_bergabung',
                                label: 'Tanggal Bergabung',
                                type: 'required'
                            },
                        ],
                    },

                    getErrorMessage(rule, value) {
                        switch (rule.type) {
                            case 'required':
                                return !value?.trim() ? `${rule.label} wajib diisi.` : null;
                            case 'select':
                                return !value ? `${rule.label} wajib dipilih.` : null;
                            case 'nik':
                                if (!value?.trim()) return 'NIK wajib diisi.';
                                return !/^[0-9]{16}$/.test(value.trim()) ? 'NIK harus 16 digit angka.' :
                                    null;
                            case 'email':
                                if (!value?.trim()) return 'Email wajib diisi.';
                                return !/^[^\s@]+@[^\s@]+\.[a-z]{2,}$/i.test(value) ?
                                    'Format email tidak valid.' : null;
                            case 'phone':
                                if (!value?.trim()) return 'No HP wajib diisi.';
                                return !/^[0-9]{8,15}$/.test(value.trim()) ?
                                    'No HP hanya angka, 8–15 digit.' : null;

                            case 'nik_optional':
                                if (!value?.trim()) return null; // boleh kosong
                                return !/^[0-9]{16}$/.test(value.trim()) ?
                                    'NIK harus tepat 16 digit angka.' : null;

                            case 'nokk_optional':
                                if (!value?.trim()) return null; // boleh kosong
                                return value.trim().length > 20 ? 'No KK maksimal 20 karakter.' : null;
                        }
                        return null;
                    },

                    setFieldError(el, msg) {
                        el.classList.add('border-red-400', 'bg-red-50', 'focus:border-red-400');
                        el.classList.remove('border-slate-200');
                        el.parentElement.querySelector('.field-error')?.remove();
                        const err = document.createElement('p');
                        err.className =
                            'field-error text-[10px] text-red-500 font-bold mt-1 flex items-center gap-1';
                        err.innerHTML =
                            `<svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>${msg}`;
                        el.parentElement.appendChild(err);
                    },

                    clearFieldError(el) {
                        el.classList.remove('border-red-400', 'bg-red-50', 'focus:border-red-400');
                        el.classList.add('border-slate-200');
                        el.parentElement.querySelector('.field-error')?.remove();
                    },

                    validateStep(step) {
                        const rules = this.STEP_RULES[step] ?? [];
                        const errs = [];
                        rules.forEach(rule => {
                            const el = document.querySelector(`[name="${rule.name}"]`);
                            if (!el) return;
                            const msg = this.getErrorMessage(rule, el.value);
                            msg ? (this.setFieldError(el, msg), errs.push(msg)) : this
                                .clearFieldError(el);
                        });
                        if (errs.length) {
                            this.showToast(`${errs.length} field belum valid.`);
                            return false;
                        }
                        return true;
                    },

                    clearStepErrors(step) {
                        (this.STEP_RULES[step] ?? []).forEach(rule => {
                            const el = document.querySelector(`[name="${rule.name}"]`);
                            if (el) this.clearFieldError(el);
                        });
                    },

                    bindLiveValidation() {
                        Object.values(this.STEP_RULES).flat().forEach(rule => {
                            const el = document.querySelector(`[name="${rule.name}"]`);
                            if (!el) return;
                            const ev = el.tagName === 'SELECT' ? 'change' : 'input';
                            el.addEventListener(ev, () => {
                                if (el.classList.contains('border-red-400')) {
                                    const m = this.getErrorMessage(rule, el.value);
                                    m ? this.setFieldError(el, m) : this.clearFieldError(
                                        el);
                                }
                            });
                        });
                    },

                    validateSubmit() {
                        this.fpTmtGty?.close();
                        this.fpLahir?.close();
                        this.fpGabung?.close();
                        this.fpTmtJabatan?.close();
                        this.fpTanggalSelesai?.close(); // ← pastikan ada
                        this.fpSK?.close();

                        const syncFp = (id, fp) => {
                            if (!fp) return; // ← guard jika fp belum terinit
                            const el = document.getElementById(id);
                            if (!el) return; // ← guard jika element tidak ada
                            if (fp.selectedDates?.length) {
                                el.value = fp.formatDate(fp.selectedDates[0], 'Y-m-d');
                            }
                            // Jika tidak ada selectedDates, biarkan nilai input apa adanya
                        };

                        syncFp('tmt_jabatan', this.fpTmtJabatan);
                        syncFp('tanggal_selesai', this.fpTanggalSelesai); // ← tambah
                        syncFp('tanggal_bergabung', this.fpGabung);
                        syncFp('tanggal_sk', this.fpSK);
                        syncFp('tmt_pns', this.fpTmtPns);
                        syncFp('tmt_gty', this.fpTmtGty);
                        syncFp('tanggal_lahir', this.fpLahir);
                        syncFp('tanggal_terbit_sertifikasi', this.fpTanggalTerbitSert);
                        syncFp('expired_sertifikasi', this.fpExpiredSert);
                        for (let i = 1; i <= this.totalSteps; i++) {
                            if (!this.validateStep(i)) {
                                this.moveGuruSlider(i);
                                return;
                            }
                        }
                        document.getElementById('formGuruMaster').submit();
                    },



                    async loadKartuDiklat(guruId) {
                        const section = document.getElementById('kartu_diklat_section');
                        const list = document.getElementById('kartu_diklat_list');
                        const empty = document.getElementById('kartu_diklat_empty');
                        const statsEl = document.getElementById('kartu_diklat_stats');

                        list.innerHTML = '';
                        empty.classList.add('hidden');

                        try {
                            const res = await fetch(`/operator/data-guru/${guruId}/diklat`, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });
                            const data = await res.json();

                            if (data.total === 0) {
                                section.classList.remove('hidden');
                                empty.classList.remove('hidden');
                                return;
                            }

                            section.classList.remove('hidden');
                            statsEl.innerText = `${data.total} Kegiatan · ${data.total_jp} JP Total`;

                            const jenisColors = {
                                'Diklat Fungsional': 'blue',
                                'Workshop': 'purple',
                                'Seminar': 'teal',
                                'Bimtek': 'amber',
                                'Pelatihan': 'emerald',
                                'Magang': 'rose',
                                'Lainnya': 'slate'
                            };

                            // Flatten semua diklat dari semua group
                            const allDiklats = Object.values(data.diklats).flat();

                            allDiklats.forEach((d, index) => {
                                const isActive = index === 0;
                                const el = document.createElement('div');
                                el.className = 'flex gap-4 relative group';
                                el.innerHTML = `
        <div class="flex flex-col items-center">
            <div class="w-3.5 h-3.5 rounded-full ${isActive ? 'bg-secondary' : 'bg-outline-variant'} z-10 mt-1 shrink-0 group-hover:scale-125 transition-transform" style="box-shadow: ${isActive ? '0 0 0 4px white' : 'none'}"></div>
            <div class="w-px flex-1 bg-surface-variant mt-1"></div>
        </div>
        <div class="flex-1 ${isActive ? 'bg-surface' : 'bg-surface-container-lowest'} rounded-2xl p-4 border border-outline-variant/30 flex flex-col gap-3 hover:border-secondary/40 hover:shadow-sm hover:-translate-y-0.5 transition-all mb-1">
            <div>
                <p class="font-bold text-[14px] text-on-surface leading-tight">${d.nama_diklat}</p>
                <p class="text-[12px] text-outline mt-1">Penyelenggara: ${d.penyelenggara || '-'}</p>
            </div>
            <div class="flex items-center justify-between border-t border-surface-variant/50 pt-2">
                <span class="px-2.5 py-1 ${isActive ? 'bg-secondary/10 text-secondary' : 'bg-surface-variant text-on-surface-variant'} text-[11px] rounded-md font-bold uppercase tracking-wider">
                    ${d.jumlah_jam || d.jp || 0} JP
                </span>
                <span class="text-[12px] text-outline font-bold flex items-center gap-1.5 bg-surface-container px-2 py-1 rounded-md">
                    <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                    ${d.tahun || (d.tanggal_mulai_fmt ? d.tanggal_mulai_fmt.split(' ').pop() : '-')}
                </span>
            </div>
        </div>
    `;
                                list.appendChild(el);
                            });

                            if (typeof lucide !== 'undefined') lucide.createIcons();

                        } catch (e) {
                            console.error('Gagal load diklat kartu:', e);
                        }
                    },
                }));
            });
        </script>
    @endpush
@endsection
