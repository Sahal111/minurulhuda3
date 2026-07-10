{{-- resources/views/operator/partials/_tableGuru.blade.php --}}
@forelse ($guru as $g)
    <tr class="group hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors"
        data-guru-id="{{ $g->id }}">

        {{-- Nama & Foto --}}
        <td class="px-8 py-5">
            <div class="flex items-center gap-4">
                <div class="relative shrink-0">
                    @if ($g->foto)
                        <img src="{{ asset('storage/' . ltrim($g->foto, '/')) }}"
                            class="w-12 h-12 rounded-xl object-cover ring-2 ring-slate-100 dark:ring-slate-800"
                            alt="{{ $g->nama }}">
                    @else
                        <img src="/assets/default-avatar.svg"
                            class="w-12 h-12 rounded-xl ring-2 ring-slate-100 dark:ring-slate-800">
                    @endif
                    <span
                        class="absolute -bottom-1 -right-1 w-3.5 h-3.5 {{ $g->status_aktif ? 'bg-emerald-500' : 'bg-slate-300' }} border-2 border-white dark:border-slate-900 rounded-full"></span>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-800 dark:text-white">{{ $g->nama }}</p>
                    <p class="text-[11px] text-slate-500 mt-0.5">{{ $g->nip ?? 'Tidak ada NIP' }}</p>
                    @if ($g->mapel)
                        <p class="text-[10px] text-emerald-600 dark:text-emerald-400 font-bold mt-0.5">
                            {{ $g->mapel }}</p>
                    @endif
                </div>
            </div>
        </td>

        {{-- NUPTK + Sertifikasi --}}
        <td class="px-6 py-5">
            <span
                class="px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg text-xs font-bold text-slate-600 dark:text-slate-300 font-mono block mb-1">
                {{ $g->nuptk ?? '-' }}
            </span>
            @if ($g->no_sertifikasi && !in_array(trim($g->no_sertifikasi), ['', '-', '–']))
                <span
                    class="inline-flex items-center gap-1 px-2 py-0.5 bg-amber-50 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 rounded-md text-[10px] font-bold border border-amber-200 dark:border-amber-500/20">
                    <i data-lucide="award" class="w-3 h-3"></i> Sertifikasi {{ $g->tahun_sertifikasi }}
                </span>
            @else
                <span class="text-[10px] text-slate-400 italic">Belum sertifikasi</span>
            @endif
        </td>

        {{-- Jabatan --}}
        <td class="px-6 py-5">
            @php
                $isWali = $g->kelasWali !== null;
                $jabatanLower = strtolower($g->jabatan ?? '');
                $jabatanClass = match (true) {
                    $isWali
                        => 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 border-emerald-100 dark:border-emerald-500/20',
                    str_contains($jabatanLower, 'kepala')
                        => 'bg-purple-50 dark:bg-purple-500/10 text-purple-700 dark:text-purple-400 border-purple-100 dark:border-purple-500/20',
                    str_contains($jabatanLower, 'staf')
                        => 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-slate-600',
                    default
                        => 'bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 border-blue-100 dark:border-blue-500/20',
                };
                $jabatanIcon = match (true) {
                    $isWali => 'home',
                    str_contains($jabatanLower, 'kepala') => 'star',
                    str_contains($jabatanLower, 'staf') => 'clipboard',
                    default => 'briefcase',
                };
            @endphp
            <span
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[10px] font-bold border {{ $jabatanClass }}">
                <i data-lucide="{{ $jabatanIcon }}" class="w-3 h-3"></i>
                @if ($isWali)
                    Wali Kelas {{ $g->kelasWali->tingkat }}{{ $g->kelasWali->nama_kelas }}
                @else
                    {{ $g->jabatan ?? 'Guru' }}
                @endif
            </span>
        </td>

        {{-- Kepegawaian --}}
        <td class="px-6 py-5">
            @php
                $kepClass = match ($g->status_kepegawaian) {
                    'PNS' => 'bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400',
                    'PPPK' => 'bg-teal-50 dark:bg-teal-500/10 text-teal-700 dark:text-teal-400',
                    default => 'bg-amber-50 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400',
                };
            @endphp
            <span class="px-3 py-1 rounded-lg text-[10px] font-bold {{ $kepClass }} block mb-1">
                {{ $g->status_kepegawaian ?? '-' }}
            </span>
            @if ($g->golongan)
                <span class="text-[10px] text-slate-400">Gol. {{ $g->golongan }}</span>
            @endif
        </td>

        {{-- TMT / Masa Bakti --}}
        <td class="px-6 py-5">
            @if ($g->tanggal_bergabung)
                <p class="text-xs font-bold text-slate-700 dark:text-slate-200">
                    {{ \Carbon\Carbon::parse($g->tanggal_bergabung)->translatedFormat('d M Y') }}
                </p>
                <p class="text-[10px] text-slate-400 mt-0.5">{{ $g->masa_bakti }}</p>
            @else
                <span class="text-xs text-slate-400">-</span>
            @endif
        </td>

        {{-- Status --}}
        <td class="px-6 py-5">
            @if ($g->status_aktif)
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-lg text-xs font-bold border border-emerald-100 dark:border-emerald-500/20">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Aktif
                </span>
            @else
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 rounded-lg text-xs font-bold border border-slate-200 dark:border-slate-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Tidak Aktif
                </span>
            @endif
        </td>

        {{-- Aksi --}}
        <td class="px-8 py-5">
            <div class="flex items-center justify-end gap-1.5 opacity-60 group-hover:opacity-100 transition-opacity">
                {{-- Assign User --}}
                <button @click.stop="openAssignUserModal({{ $g->id }}, {{ Js::from($g->nama) }}, {{ $g->user ? Js::from($g->user) : 'null' }})"
                    class="w-8 h-8 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-purple-600 hover:bg-purple-50 dark:hover:bg-purple-500/10 transition-all"
                    title="Assign Akun User">
                    <i data-lucide="user-cog" class="w-4 h-4"></i>
                </button>
                {{-- Inpassing --}}
                {{-- <button @click.stop="openInpassingModal({{ Js::from($g->only(['id','nama','nuptk','foto'])) }})"
                    class="w-8 h-8 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-violet-600 hover:bg-violet-50 dark:hover:bg-violet-500/10 transition-all"
                    title="Riwayat Inpassing">
                    <i data-lucide="scale" class="w-4 h-4"></i>
                </button> --}}
                {{-- Kartu Identitas --}}
                <button @click.stop="openKartuGuru({{ Js::from($g) }})"
                    class="w-8 h-8 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 transition-all"
                    title="Kartu Identitas">
                    <i data-lucide="id-card" class="w-4 h-4"></i>
                </button>
                {{-- Export PDF Kartu --}}
                <a href="{{ route('operator.dataGuru.kartuPdf', $g->id) }}" target="_blank"
                    class="w-8 h-8 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-all"
                    title="Cetak PDF">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                </a>
                {{-- Edit --}}
                <button @click.stop="editGuru({{ $g->id }})"
                    class="w-8 h-8 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-500/10 transition-all"
                    title="Edit Data">
                    <i data-lucide="edit-2" class="w-4 h-4"></i>
                </button>
                {{-- Hapus --}}
                <button @click.stop="deleteGuru({{ $g->id }}, {{ Js::from($g->nama) }})"
                    class="w-8 h-8 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-all"
                    title="Hapus Data">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="px-8 py-16 text-center">
            <div class="flex flex-col items-center gap-4">
                <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center">
                    <i data-lucide="users" class="w-8 h-8 text-slate-300"></i>
                </div>
                <p class="text-sm font-bold text-slate-400">Tidak ada data guru ditemukan</p>
                @if (request()->hasAny(['search', 'jabatan', 'status', 'sertifikasi', 'status_kepegawaian']))
                    <a href="{{ route('operator.dataGuru') }}"
                        class="text-xs text-emerald-600 hover:underline font-bold">Reset filter</a>
                @endif
            </div>
        </td>
    </tr>
@endforelse
