@extends('layouts.operator')

@section('content')
<div x-data="jadwalSystem()" x-init="initJadwal()" class="space-y-6">

    <!-- 1. HEADER & STATUS AKADEMIK -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-lexend font-bold text-slate-800 dark:text-white">Jadwal Pelajaran</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Atur jadwal mengajar dan manajemen konflik guru</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-right hidden md:block">
                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status Sistem</span>
                <span :class="isSystemActive ? 'text-emerald-500' : 'text-rose-500'" class="text-xs font-bold flex items-center justify-end gap-1">
                    <span class="w-2 h-2 rounded-full animate-pulse" :class="isSystemActive ? 'bg-emerald-500' : 'bg-rose-500'"></span>
                    <span x-text="isSystemActive ? 'Akademik Aktif' : 'Akademik Nonaktif'"></span>
                </span>
            </div>
            <!-- TOMBOL AKTIVASI SISTEM -->
            <button @click="openActivationModal()"
                :class="isSystemActive ? 'bg-rose-100 text-rose-600 border-rose-200' : 'bg-emerald-600 text-white border-emerald-700'"
                class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider border-b-4 active:border-b-0 transition-all flex items-center gap-2">
                <i :data-lucide="isSystemActive ? 'power-off' : 'play-circle'" class="w-4 h-4"></i>
                <span x-text="isSystemActive ? 'Matikan Sistem' : 'Aktifkan Jadwal'"></span>
            </button>
        </div>
    </div>

    <!-- 2. ALERT VALIDASI GLOBAL -->
    <template x-if="conflicts.length > 0">
        <div class="bg-rose-50 border border-rose-200 rounded-2xl p-4 flex items-start gap-3 animate-pulse">
            <i data-lucide="alert-octagon" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5"></i>
            <div>
                <h4 class="text-sm font-bold text-rose-800">Ditemukan <span x-text="conflicts.length"></span> Bentrok Jadwal!</h4>
                <p class="text-xs text-rose-600 mt-1">Sistem mendeteksi guru yang mengajar di dua kelas pada jam yang sama. Perbaiki sebelum mengaktifkan sistem.</p>
            </div>
        </div>
    </template>

    <div x-show="!isSystemActive" class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-center gap-3">
        <i data-lucide="info" class="w-5 h-5 text-amber-600"></i>
        <p class="text-xs text-amber-700 font-medium">Jadwal belum diaktifkan. Sistem absensi dan jurnal kelas belum dapat dimulai.</p>
    </div>

    <!-- 4. FILTER UTAMA -->
    <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">Rombel Fokus</label>
                <select x-model="viewRombel" class="form-input-siswa w-full appearance-none">
                    <template x-for="r in listRombel" :key="r">
                        <option :value="r" x-text="'Kelas ' + r"></option>
                    </template>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">Hari</label>
                <select x-model="viewHari" class="form-input-siswa w-full appearance-none">
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
            </div>
            <div class="md:col-span-2 flex items-end gap-2">
                <button @click="copyJadwal()" class="flex-1 py-3 px-4 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 rounded-xl text-xs font-bold text-slate-600 dark:text-slate-300 transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="copy" class="w-4 h-4"></i> Copy Jadwal
                </button>
                <button @click="autoGenerate()" class="flex-1 py-3 px-4 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-xl text-xs font-bold transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="sparkles" class="w-4 h-4"></i> Auto Fill
                </button>
            </div>
        </div>
    </div>

    <!-- 5. GRID JADWAL (INTERAKTIF) -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50">
                        <th class="p-4 text-xs font-bold text-slate-400 uppercase w-20 border-b border-slate-100 dark:border-slate-800">Jam Ke</th>
                        <th class="p-4 text-xs font-bold text-slate-400 uppercase border-b border-slate-100 dark:border-slate-800">Waktu</th>
                        <th class="p-4 text-xs font-bold text-slate-400 uppercase border-b border-slate-100 dark:border-slate-800 text-center">Mata Pelajaran & Guru</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                    <template x-for="jam in 10" :key="jam">
                        <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">
                            <td class="p-4 text-center font-lexend font-bold text-slate-400" x-text="jam"></td>
                            <td class="p-4 text-xs font-medium text-slate-500" x-text="getWaktu(jam)"></td>
                            <td class="p-2">
                                <div @click="openSlot(jam)"
                                    class="min-h-[70px] rounded-xl border-2 border-dashed flex flex-col items-center justify-center cursor-pointer transition-all p-3"
                                    :class="getJadwalClass(jam)">

                                    <template x-if="getJadwalAt(jam)">
                                        <div class="text-center">
                                            <p class="text-sm font-bold" x-text="getJadwalAt(jam).mapel"></p>
                                            <p class="text-[10px] font-medium opacity-80 mt-1" x-text="getJadwalAt(jam).guru"></p>

                                            <!-- BENTROK INDICATOR -->
                                            <template x-if="isBentrok(getJadwalAt(jam))">
                                                <div class="mt-2 px-2 py-1 bg-white/20 rounded-lg text-[9px] font-black uppercase flex items-center gap-1 justify-center">
                                                    <i data-lucide="alert-triangle" class="w-3 h-3"></i> Bentrok: Kelas <span x-text="getBentrokInfo(getJadwalAt(jam)).withRombel"></span>
                                                </div>
                                            </template>
                                        </div>
                                    </template>

                                    <template x-if="!getJadwalAt(jam)">
                                        <span class="text-[10px] font-bold text-slate-300 dark:text-slate-600 uppercase group-hover:text-emerald-500">+ Isi Jadwal</span>
                                    </template>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 7. MODAL INPUT JADWAL & VALIDASI BENTROK -->
    <div x-show="activeModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-cloak>
        <div x-show="activeModal" @click.away="activeModal = false" class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl w-full max-w-lg animate-modal overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-lexend font-bold text-slate-800 dark:text-white">Atur Jadwal Pelajaran</h3>
                    <button @click="activeModal = false" class="p-2 hover:bg-slate-100 rounded-full"><i data-lucide="x" class="w-5 h-5 text-slate-400"></i></button>
                </div>

                <div class="space-y-4">
                    <div class="flex gap-4 p-4 bg-slate-50 dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 mb-4">
                        <div class="flex-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Hari</p>
                            <p class="font-bold text-slate-800 dark:text-white" x-text="viewHari"></p>
                        </div>
                        <div class="flex-1 border-l pl-4 border-slate-200 dark:border-slate-700">
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Jam Ke-</p>
                            <p class="font-bold text-slate-800 dark:text-white" x-text="selectedJam"></p>
                        </div>
                        <div class="flex-1 border-l pl-4 border-slate-200 dark:border-slate-700">
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Rombel</p>
                            <p class="font-bold text-slate-800 dark:text-white" x-text="viewRombel"></p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">Mata Pelajaran</label>
                        <select x-model="formData.mapel" class="form-input-siswa w-full appearance-none" @change="syncGuru()">
                            <option value="">Pilih Mata Pelajaran...</option>
                            <template x-for="m in listMapel" :key="m.nama">
                                <option :value="m.nama" x-text="m.nama"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-2 uppercase">Guru Pengampu</label>
                        <select x-model="formData.guru" class="form-input-siswa w-full appearance-none" :disabled="!formData.mapel">
                            <option value="">Pilih Guru...</option>
                            <template x-for="g in getGuruByMapel(formData.mapel)" :key="g">
                                <option :value="g" x-text="g"></option>
                            </template>
                        </select>
                    </div>

                    <!-- REAL-TIME BENTROK NOTIFICATION IN MODAL -->
                    <template x-if="checkBentrok(formData.guru, viewHari, selectedJam)">
                        <div class="p-3 bg-rose-50 border border-rose-200 rounded-xl flex items-center gap-2 text-rose-600 text-[10px] font-bold">
                            <i data-lucide="alert-circle" class="w-4 h-4"></i>
                            <span>BENTROK: Guru tersebut sudah memiliki jadwal di Kelas <span x-text="checkBentrok(formData.guru, viewHari, selectedJam).rombel"></span> di jam yang sama!</span>
                        </div>
                    </template>
                </div>

                <div class="flex gap-3 mt-8">
                    <button @click="deleteJadwal()" x-show="getJadwalAt(selectedJam)" class="px-6 py-3 rounded-2xl bg-rose-50 text-rose-600 font-bold text-[10px] uppercase tracking-widest hover:bg-rose-100 transition-colors">Hapus</button>
                    <button @click="activeModal = false" class="flex-1 px-6 py-3 rounded-2xl border-2 border-slate-100 dark:border-slate-800 text-slate-400 font-bold text-[10px] uppercase tracking-widest">Batal</button>
                    <button @click="saveJadwal()" :disabled="!formData.guru || checkBentrok(formData.guru, viewHari, selectedJam)" class="flex-1 btn-next-siswa justify-center disabled:opacity-50">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 11. MODAL KONFIRMASI AKTIVASI -->
    <div x-show="activationModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-cloak>
        <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl w-full max-w-md animate-modal overflow-hidden text-center p-8">
            <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="check-circle" class="w-10 h-10 text-emerald-600"></i>
            </div>
            <h3 class="text-xl font-lexend font-bold text-slate-800 dark:text-white mb-2">Aktivasi Sistem Akademik</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Apakah Anda yakin ingin mengaktifkan jadwal ini? Absensi siswa dan guru akan segera mengikuti jadwal ini.</p>

            <div class="grid grid-cols-2 gap-3 mb-8">
                <div class="bg-slate-50 dark:bg-slate-800 p-3 rounded-2xl">
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Total Slot</p>
                    <p class="text-lg font-bold text-slate-800 dark:text-white" x-text="jadwal.length"></p>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800 p-3 rounded-2xl">
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Bentrok</p>
                    <p class="text-lg font-bold text-rose-500" x-text="conflicts.length"></p>
                </div>
            </div>

            <div class="flex gap-3">
                <button @click="activationModal = false" class="flex-1 px-6 py-4 rounded-2xl border-2 border-slate-100 dark:border-slate-800 text-slate-400 font-bold text-[10px] uppercase">Batal</button>
                <button @click="toggleSystem()" :disabled="conflicts.length > 0" class="flex-1 btn-next-siswa justify-center disabled:opacity-50">Lanjutkan</button>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('jadwalSystem', () => ({
            isSystemActive: false,
            activationModal: false,
            activeModal: false,
            viewRombel: '1A',
            viewHari: 'Senin',
            selectedJam: null,
            listRombel: ['1A', '1B', '2A', '3A', '6A'],

            // Dummy Master Data
            listMapel: [{
                    nama: 'Matematika',
                    guru: ['Ahmad Fauzi, S.Pd', 'Siti Aminah, M.Pd']
                },
                {
                    nama: 'Bahasa Indonesia',
                    guru: ['Dewi Lestari, S.Pd']
                },
                {
                    nama: 'PJOK',
                    guru: ['Budi Santoso, S.Or']
                },
                {
                    nama: 'PAI',
                    guru: ['Ustadz Yusuf, S.Pd.I']
                }
            ],

            // 9. STATE JADWAL CORE
            jadwal: [{
                    id: 1,
                    rombel: '1A',
                    hari: 'Senin',
                    jam: 1,
                    mapel: 'Matematika',
                    guru: 'Ahmad Fauzi, S.Pd'
                },
                {
                    id: 2,
                    rombel: '1B',
                    hari: 'Senin',
                    jam: 1,
                    mapel: 'Matematika',
                    guru: 'Siti Aminah, M.Pd'
                },
                {
                    id: 3,
                    rombel: '2A',
                    hari: 'Senin',
                    jam: 1,
                    mapel: 'PJOK',
                    guru: 'Budi Santoso, S.Or'
                },
            ],

            formData: {
                mapel: '',
                guru: ''
            },
            conflicts: [],

            initJadwal() {
                this.detectConflicts();
                this.$watch('jadwal', () => this.detectConflicts(), {
                    deep: true
                });
                this.$nextTick(() => lucide.createIcons());
            },

            // LOGIC VALIDASI BENTROK (CORE 🔥)
            checkBentrok(guru, hari, jam, excludeId = null) {
                if (!guru) return false;
                return this.jadwal.find(j =>
                    j.guru === guru &&
                    j.hari === hari &&
                    j.jam === jam &&
                    j.rombel !== this.viewRombel && // Berbeda kelas
                    j.id !== excludeId
                );
            },

            detectConflicts() {
                this.conflicts = [];
                this.jadwal.forEach(j => {
                    let c = this.checkBentrok(j.guru, j.hari, j.jam, j.id);
                    if (c) this.conflicts.push({
                        origin: j,
                        with: c
                    });
                });
            },

            isBentrok(j) {
                return this.conflicts.some(c => c.origin.id === j.id);
            },

            getBentrokInfo(j) {
                let c = this.conflicts.find(c => c.origin.id === j.id);
                return c ? {
                    withRombel: c.with.rombel
                } : null;
            },

            // GRID HELPERS
            getJadwalAt(jam) {
                return this.jadwal.find(j => j.rombel === this.viewRombel && j.hari === this.viewHari && j.jam === jam);
            },

            getJadwalClass(jam) {
                let j = this.getJadwalAt(jam);
                if (!j) return 'border-slate-100 bg-transparent hover:border-emerald-300 hover:bg-emerald-50/30';
                if (this.isBentrok(j)) return 'bg-rose-50 border-rose-200 text-rose-700 shadow-sm';
                return 'bg-emerald-50 border-emerald-100 text-emerald-700 shadow-sm';
            },

            getWaktu(jam) {
                const times = ["", "07:00 - 07:35", "07:35 - 08:10", "08:10 - 08:45", "09:00 - 09:35", "09:35 - 10:10", "10:10 - 10:45", "11:00 - 11:35", "11:35 - 12:10", "12:10 - 12:45", "12:45 - 13:20"];
                return times[jam];
            },

            // ACTIONS
            openSlot(jam) {
                this.selectedJam = jam;
                let existing = this.getJadwalAt(jam);
                if (existing) {
                    this.formData = {
                        mapel: existing.mapel,
                        guru: existing.guru
                    };
                } else {
                    this.formData = {
                        mapel: '',
                        guru: ''
                    };
                }
                this.activeModal = true;
                this.$nextTick(() => lucide.createIcons());
            },

            saveJadwal() {
                let existingIndex = this.jadwal.findIndex(j => j.rombel === this.viewRombel && j.hari === this.viewHari && j.jam === this.selectedJam);

                if (existingIndex !== -1) {
                    this.jadwal[existingIndex] = {
                        ...this.jadwal[existingIndex],
                        ...this.formData
                    };
                } else {
                    this.jadwal.push({
                        id: Date.now(),
                        rombel: this.viewRombel,
                        hari: this.viewHari,
                        jam: this.selectedJam,
                        ...this.formData
                    });
                }
                this.activeModal = false;
            },

            deleteJadwal() {
                this.jadwal = this.jadwal.filter(j => !(j.rombel === this.viewRombel && j.hari === this.viewHari && j.jam === this.selectedJam));
                this.activeModal = false;
            },

            getGuruByMapel(mapelNama) {
                let m = this.listMapel.find(x => x.nama === mapelNama);
                return m ? m.guru : [];
            },

            syncGuru() {
                let gurus = this.getGuruByMapel(this.formData.mapel);
                this.formData.guru = gurus.length === 1 ? gurus[0] : '';
            },

            openActivationModal() {
                this.activationModal = true;
                this.$nextTick(() => lucide.createIcons());
            },

            toggleSystem() {
                this.isSystemActive = !this.isSystemActive;
                this.activationModal = false;
                this.$nextTick(() => lucide.createIcons());
            },

            autoGenerate() {
                alert("AI Auto-Fill: Menyeimbangkan slot kosong berdasarkan beban kerja guru...");
            },

            copyJadwal() {
                alert("Pilih Rombel sumber untuk disalin ke " + this.viewRombel);
            }
        }));
    });
</script>
@endpush
@endsection