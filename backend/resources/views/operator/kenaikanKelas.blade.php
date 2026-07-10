@extends('layouts.operator')

@section('content')
<div x-data="kenaikanKelas()" x-init="initKenaikan()" class="space-y-6">

    <!-- 1. HEADER & BADGE -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-lexend font-bold text-slate-800 dark:text-white">Kenaikan Kelas</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Proses kenaikan siswa ke tingkat berikutnya</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex flex-col items-end">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">TA Asal</span>
                <span class="px-3 py-1 bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400 rounded-full text-xs font-bold border border-rose-200 dark:border-rose-800">
                    2024/2025
                </span>
            </div>
            <i data-lucide="arrow-right" class="w-4 h-4 text-slate-400"></i>
            <div class="flex flex-col items-start">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">TA Tujuan</span>
                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-full text-xs font-bold border border-emerald-200 dark:border-emerald-800">
                    2025/2026
                </span>
            </div>
        </div>
    </div>

    <!-- 2. FILTER -->
    <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-wide">Tahun Ajaran Asal</label>
                <div class="px-4 py-3 bg-slate-50 dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 rounded-2xl text-sm font-bold text-slate-700 dark:text-slate-200">
                    {{ $activeTahun->tahun }} ({{ $activeTahun->semester }})
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-wide">Tahun Ajaran Tujuan</label>
                <select x-model="taTujuanId" class="form-input-siswa w-full appearance-none">
                    <option value="">Pilih TA Tujuan...</option>
                    @foreach($tahunAjarans as $ta)
                        @if($ta->id !== $activeTahun->id)
                            <option value="{{ $ta->id }}">{{ $ta->tahun }} ({{ $ta->semester }})</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-wide">Tingkat</label>
                <select x-model="filterTingkat" class="form-input-siswa w-full appearance-none">
                    <option value="semua">Semua Tingkat</option>
                    @foreach([1,2,3,4,5,6] as $t)
                        <option value="{{ $t }}">Tingkat {{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-wide">Rombel Asal</label>
                <select x-model="filterRombel" class="form-input-siswa w-full appearance-none">
                    <option value="semua">Semua Rombel</option>
                    <template x-for="r in [...new Set(siswa.map(s => s.rombelAsal))].filter(x => x !== '-').sort()" :key="r">
                        <option :value="r" x-text="r"></option>
                    </template>
                </select>
            </div>
        </div>
    </div>

    <!-- ... rest of the HTML remains mostly same, just updating Alpine.js script ... -->

    <!-- ... (Keep same HTML structure but make sure it uses the new Alpine data) ... -->
    
    <!-- 3 & 8. GLOBAL ACTIONS & SUMMARY CARD (BONUS: PROGRESS BAR) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Summary & Progress -->
        <div class="col-span-1 lg:col-span-1 bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-5">
            <h3 class="text-sm font-bold text-slate-800 dark:text-white mb-4">Progress Kenaikan</h3>
            
            <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2 mb-4 overflow-hidden">
                <div class="bg-emerald-500 h-2 rounded-full transition-all duration-500" :style="`width: ${progressPercentage}%`"></div>
            </div>

            <div class="grid grid-cols-2 gap-3 text-center">
                <div class="bg-slate-50 dark:bg-slate-800/50 p-2 rounded-xl">
                    <p class="text-xs text-slate-500 mb-1">Total</p>
                    <p class="text-lg font-bold font-lexend text-slate-800 dark:text-white" x-text="siswa.length"></p>
                </div>
                <div class="bg-emerald-50 dark:bg-emerald-900/20 p-2 rounded-xl">
                    <p class="text-xs text-emerald-600 dark:text-emerald-400 mb-1">Naik</p>
                    <p class="text-lg font-bold font-lexend text-emerald-700 dark:text-emerald-300" x-text="stats.naik"></p>
                </div>
                <div class="bg-blue-50 dark:bg-blue-900/20 p-2 rounded-xl">
                    <p class="text-xs text-blue-600 dark:text-blue-400 mb-1">Lulus</p>
                    <p class="text-lg font-bold font-lexend text-blue-700 dark:text-blue-300" x-text="stats.lulus"></p>
                </div>
                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-2 rounded-xl">
                    <p class="text-xs text-yellow-600 dark:text-yellow-400 mb-1">Tinggal</p>
                    <p class="text-lg font-bold font-lexend text-yellow-700 dark:text-yellow-300" x-text="stats.tinggal"></p>
                </div>
            </div>
        </div>

        <!-- Global Action Buttons -->
        <div class="col-span-1 lg:col-span-2 flex flex-col justify-center gap-3 bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-5">
            <h3 class="text-sm font-bold text-slate-800 dark:text-white mb-2">Aksi Global</h3>
            <div class="flex flex-wrap gap-3">
                <button @click="autoPromote()" class="flex-1 min-w-[150px] btn-next-siswa justify-center !bg-indigo-600 hover:!bg-indigo-700 group">
                    <i data-lucide="bot" class="w-4 h-4 group-hover:animate-bounce"></i> Proses Otomatis
                </button>
                <button @click="naikkanSemua()" class="flex-1 min-w-[150px] btn-next-siswa justify-center group">
                    <i data-lucide="chevrons-up" class="w-4 h-4 group-hover:-translate-y-1 transition-transform"></i> Naikkan Semua
                </button>
                <button @click="resetData()" class="flex-1 min-w-[150px] px-6 py-3 rounded-2xl bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-[10px] uppercase tracking-widest transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i> Reset Data
                </button>
            </div>
            <p class="text-[10px] text-slate-400 mt-2">
                <i data-lucide="info" class="w-3 h-3 inline pb-0.5"></i> <b>Proses Otomatis</b> akan menggeser siswa naik tingkat secara logic, auto-mapping rombel (ex: 1A -> 2A), dan otomatis meluluskan kelas 6.
            </p>
        </div>
    </div>

    <!-- 4. TABEL SISWA -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 font-medium text-xs uppercase tracking-wider border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="p-4 w-10">
                            <input type="checkbox" @change="toggleAll($event)" class="rounded text-emerald-500 focus:ring-emerald-500 border-slate-300 bg-slate-100 dark:bg-slate-800 dark:border-slate-600">
                        </th>
                        <th class="p-4">Siswa & NIS</th>
                        <th class="p-4">Tingkat & Rombel Asal</th>
                        <th class="p-4 text-center">Aksi Status</th>
                        <th class="p-4">Tujuan (Tingkat - Rombel)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                    <template x-for="s in filteredSiswa" :key="s.id">
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors" :class="{'bg-rose-50/30 dark:bg-rose-900/10': s.status === 'naik' && !s.rombelTujuan}">
                            <td class="p-4">
                                <input type="checkbox" x-model="selectedSiswa" :value="s.id" class="rounded text-emerald-500 focus:ring-emerald-500 border-slate-300 bg-slate-100 dark:bg-slate-800 dark:border-slate-600">
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-slate-800 dark:text-white" x-text="s.nama"></div>
                                <div class="text-[10px] text-slate-400" x-text="s.nis"></div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-xs font-bold text-slate-600 dark:text-slate-300" x-text="s.tingkat"></span>
                                    <span class="font-medium text-slate-600 dark:text-slate-400" x-text="s.rombelAsal"></span>
                                </div>
                            </td>
                            
                            <!-- 6. INTERAKSI PER SISWA -->
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">
                                    <select x-model="s.status" @change="handleStatusChange(s)" 
                                        class="form-input-siswa !py-1.5 !px-3 !text-xs !w-auto cursor-pointer font-bold"
                                        :class="{
                                            '!bg-emerald-100 !text-emerald-700 !border-emerald-200': s.status === 'naik',
                                            '!bg-yellow-100 !text-yellow-700 !border-yellow-200': s.status === 'tinggal',
                                            '!bg-blue-100 !text-blue-700 !border-blue-200': s.status === 'lulus',
                                            '!bg-slate-200 !text-slate-600 !border-slate-300': s.status === 'belum'
                                        }">
                                        <option value="belum" class="bg-white text-slate-800">Belum Diproses</option>
                                        <option value="naik" class="bg-white text-slate-800">Naik Kelas</option>
                                        <option value="tinggal" class="bg-white text-slate-800">Tinggal Kelas</option>
                                        <option value="lulus" class="bg-white text-slate-800" x-show="s.tingkat === 6">Lulus</option>
                                    </select>
                                </div>
                            </td>

                            <td class="p-4">
                                <div x-show="s.status === 'lulus'" class="text-xs font-bold text-blue-500 flex items-center gap-2">
                                    <i data-lucide="graduation-cap" class="w-4 h-4"></i> Lulus (Keluar Sistem)
                                </div>
                                <div x-show="s.status === 'belum'" class="text-xs italic text-slate-400">
                                    Menunggu proses...
                                </div>
                                
                                <div x-show="s.status === 'naik' || s.status === 'tinggal'" class="flex items-center gap-3">
                                    <div class="flex flex-col items-center">
                                        <span class="text-[9px] font-bold text-slate-400 uppercase mb-1">Tingkat</span>
                                        <span class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-sm font-bold text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800" x-text="s.tingkatTujuan"></span>
                                    </div>
                                    
                                    <div class="flex flex-col flex-1">
                                        <span class="text-[9px] font-bold text-slate-400 uppercase mb-1">Rombel Tujuan</span>
                                        <div class="relative group">
                                            <select x-model="s.rombelTujuan" 
                                                class="form-input-siswa !py-1.5 !pl-3 !pr-8 !text-xs w-full appearance-none cursor-pointer hover:border-emerald-400 transition-colors" 
                                                :class="{'!border-red-400 !bg-red-50 dark:!bg-red-900/10': (s.status === 'naik' || s.status === 'tinggal') && !s.rombelTujuan}">
                                                <option value="">Pilih Rombel...</option>
                                                <template x-for="r in getAvailableRombels(s.tingkatTujuan)" :key="r.id">
                                                    <option :value="r.id" x-text="r.nama"></option>
                                                </template>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400 group-hover:text-emerald-500">
                                                <i data-lucide="chevron-down" class="w-3 h-3"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Alert for missing selection -->
                                    <div x-show="(s.status === 'naik' || s.status === 'tinggal') && !s.rombelTujuan" 
                                        class="animate-pulse" 
                                        title="Rombel tujuan wajib diisi">
                                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-500"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredSiswa.length === 0">
                        <td colspan="5" class="p-8 text-center text-slate-400">Tidak ada data siswa sesuai filter.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-slate-100 dark:border-slate-800 flex justify-end">
            <button @click="openModal()" :disabled="stats.belum === siswa.length" class="btn-next-siswa disabled:opacity-50 disabled:cursor-not-allowed">
                Simpan & Validasi <i data-lucide="save" class="w-4 h-4"></i>
            </button>
        </div>
    </div>

    <!-- 9. MODAL KONFIRMASI -->
    <div x-show="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-cloak>
        <div x-show="isModalOpen" @click.away="isModalOpen = false" class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md animate-modal overflow-hidden">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="check-circle" class="w-8 h-8 text-emerald-600 dark:text-emerald-400"></i>
                </div>
                <h2 class="text-xl font-lexend font-bold text-slate-800 dark:text-white mb-2">Konfirmasi Simpan</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Anda akan memproses perubahan status kenaikan siswa dengan rincian berikut:</p>
                
                <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4 mb-6 space-y-2 text-left">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500 font-medium">Total Diproses</span>
                        <span class="font-bold text-slate-800 dark:text-white" x-text="siswa.length - stats.belum + ' Siswa'"></span>
                    </div>
                    <hr class="border-slate-200 dark:border-slate-700">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500 flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-emerald-500"></div> Naik Kelas</span>
                        <span class="font-bold text-emerald-600 dark:text-emerald-400" x-text="stats.naik"></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500 flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-blue-500"></div> Lulus</span>
                        <span class="font-bold text-blue-600 dark:text-blue-400" x-text="stats.lulus"></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500 flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-yellow-500"></div> Tinggal Kelas</span>
                        <span class="font-bold text-yellow-600 dark:text-yellow-400" x-text="stats.tinggal"></span>
                    </div>
                </div>

                <div x-show="unassignedCount > 0 || !taTujuanId" class="mb-6 p-3 bg-red-50 text-red-600 border border-red-200 rounded-xl text-xs font-medium text-left flex gap-2">
                    <i data-lucide="alert-triangle" class="w-4 h-4 shrink-0"></i>
                    <span x-show="!taTujuanId">Pilih Tahun Ajaran Tujuan terlebih dahulu!</span>
                    <span x-show="taTujuanId && unassignedCount > 0">Terdapat <b x-text="unassignedCount"></b> siswa (Naik/Tinggal) yang belum memiliki rombel tujuan. Lengkapi terlebih dahulu!</span>
                </div>

                <div class="flex gap-3">
                    <button @click="isModalOpen = false" class="flex-1 px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-bold text-xs uppercase tracking-wider hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Batal</button>
                    <button @click="submitData()" :disabled="unassignedCount > 0 || !taTujuanId" class="flex-1 btn-next-siswa justify-center disabled:opacity-50 disabled:cursor-not-allowed">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION BONUS -->
    <div x-show="toast.show" x-transition.opacity.duration.300ms class="fixed bottom-6 right-6 z-50" x-cloak>
        <div class="bg-slate-800 text-white px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3">
            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400"></i>
            <span class="text-sm font-medium" x-text="toast.message"></span>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('kenaikanKelas', () => ({
            // State
            isModalOpen: false,
            filterTingkat: 'semua',
            filterRombel: 'semua',
            taTujuanId: '',
            selectedSiswa: [],
            toast: { show: false, message: '' },
            
            // Data Real dari Backend
            siswa: @json($siswas),
            rombels: @json($rombels),

            initKenaikan() {
                this.$nextTick(() => { lucide.createIcons(); });
                
                // Refresh icons whenever filteredSiswa changes
                this.$watch('filterTingkat', () => this.$nextTick(() => lucide.createIcons()));
                this.$watch('filterRombel', () => this.$nextTick(() => lucide.createIcons()));
            },

            // Getters & Computed
            get filteredSiswa() {
                return this.siswa.filter(s => {
                    let matchTingkat = this.filterTingkat === 'semua' || s.tingkat == this.filterTingkat;
                    let matchRombel = this.filterRombel === 'semua' || s.rombelAsal == this.filterRombel;
                    return matchTingkat && matchRombel;
                });
            },

            get stats() {
                return {
                    naik: this.siswa.filter(s => s.status === 'naik').length,
                    lulus: this.siswa.filter(s => s.status === 'lulus').length,
                    tinggal: this.siswa.filter(s => s.status === 'tinggal').length,
                    belum: this.siswa.filter(s => s.status === 'belum').length,
                };
            },

            get progressPercentage() {
                let diproses = this.stats.naik + this.stats.lulus + this.stats.tinggal;
                return this.siswa.length === 0 ? 0 : Math.round((diproses / this.siswa.length) * 100);
            },

            get unassignedCount() {
                return this.siswa.filter(s => (s.status === 'naik' || s.status === 'tinggal') && !s.rombelTujuan).length;
            },

            getAvailableRombels(tingkatTarget) {
                if (!this.taTujuanId) return [];
                return this.rombels
                    .filter(r => r.tingkat == tingkatTarget && r.tahun_ajaran_id == this.taTujuanId);
            },

            // Logic Handling
            handleStatusChange(s) {
                if (s.status === 'naik') {
                    s.tingkatTujuan = s.tingkat + 1;
                } else if (s.status === 'tinggal') {
                    s.tingkatTujuan = s.tingkat;
                } else if (s.status === 'lulus') {
                    s.tingkatTujuan = '-';
                    s.rombelTujuan = '-';
                    return;
                } else {
                    s.tingkatTujuan = '';
                    s.rombelTujuan = '';
                    return;
                }

                // Auto map rombel based on current rombel asal
                this.$nextTick(() => {
                    let rombelHuruf = s.rombelAsal.replace(/[0-9]/g, '');
                    let targetRombelName = s.tingkatTujuan + rombelHuruf;
                    
                    let available = this.getAvailableRombels(s.tingkatTujuan);
                    let match = available.find(r => r.nama === targetRombelName);
                    s.rombelTujuan = match ? match.id : (available[0] ? available[0].id : '');
                    
                    lucide.createIcons();
                });
            },

            autoPromote() {
                this.filteredSiswa.forEach(s => {
                    if (s.tingkat === 6) {
                        s.status = 'lulus';
                        s.tingkatTujuan = '-';
                        s.rombelTujuan = '-';
                    } else {
                        s.status = 'naik';
                        s.tingkatTujuan = s.tingkat + 1;
                        
                        let rombelHuruf = s.rombelAsal.replace(/[0-9]/g, '');
                        let targetRombelName = s.tingkatTujuan + rombelHuruf;
                        
                        let available = this.getAvailableRombels(s.tingkatTujuan);
                        let match = available.find(r => r.nama === targetRombelName);
                        s.rombelTujuan = match ? match.id : (available[0] ? available[0].id : '');
                    }
                });
                this.showToast('Proses Otomatis Berhasil!');
            },

            naikkanSemua() {
                this.filteredSiswa.forEach(s => {
                    if (s.tingkat === 6) {
                        s.status = 'lulus';
                        s.tingkatTujuan = '-';
                        s.rombelTujuan = '-';
                    } else {
                        s.status = 'naik';
                        s.tingkatTujuan = s.tingkat + 1;
                        s.rombelTujuan = '';
                    }
                });
                this.showToast('Semua siswa di set Naik Kelas/Lulus.');
            },

            resetData() {
                this.filteredSiswa.forEach(s => {
                    s.status = 'belum';
                    s.tingkatTujuan = '';
                    s.rombelTujuan = '';
                });
                this.showToast('Status siswa di-reset kembali.');
            },

            toggleAll(e) {
                if (e.target.checked) {
                    this.selectedSiswa = this.filteredSiswa.map(s => s.id);
                } else {
                    this.selectedSiswa = [];
                }
            },

            openModal() {
                this.isModalOpen = true;
            },

            submitData() {
                if (!this.taTujuanId) return;
                
                this.isModalOpen = false;
                
                fetch('{{ route('operator.tahunAjaran.promote') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        siswa: this.siswa.filter(s => s.status !== 'belum'),
                        ta_tujuan_id: this.taTujuanId
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        this.showToast(data.message);
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        this.showToast('Gagal: ' + data.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    this.showToast('Terjadi kesalahan koneksi.');
                });
            },

            showToast(msg) {
                this.toast.message = msg;
                this.toast.show = true;
                setTimeout(() => { this.toast.show = false; }, 3000);
            }
        }));
    });
</script>
@endpush
@endsection