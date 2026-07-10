@extends('layouts.operator')

@section('content')
<div x-data="pengampuManager()" x-init="initData()" class="space-y-6">

    <!-- 1. HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-lexend font-bold text-slate-800 dark:text-white">Pengampu Mata Pelajaran</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Atur guru pengajar untuk setiap mata pelajaran</p>
        </div>
        
        <!-- 9. QUICK ACTIONS -->
        <div class="flex flex-wrap items-center gap-3">
            <button @click="autoAssign()" class="px-4 py-2.5 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-bold text-xs uppercase tracking-wider transition-colors flex items-center gap-2">
                <i data-lucide="bot" class="w-4 h-4"></i> Auto Assign
            </button>
            <button @click="openQuickAssign()" class="px-4 py-2.5 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 font-bold text-xs uppercase tracking-wider transition-colors flex items-center gap-2">
                <i data-lucide="zap" class="w-4 h-4"></i> Assign Cepat
            </button>
            <button @click="openModal('add')" class="btn-next-siswa !px-5 !py-2.5 !text-xs !rounded-xl !bg-emerald-600 hover:!bg-emerald-700">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah Pengampu
            </button>
        </div>
    </div>

    <!-- 3. CARD SUMMARY -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 shadow-sm border border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Pengampu</p>
                    <p class="text-xl font-lexend font-bold text-slate-800 dark:text-white" x-text="pengampu.length"></p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 shadow-sm border border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                    <i data-lucide="user-check" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Guru Aktif</p>
                    <p class="text-xl font-lexend font-bold text-slate-800 dark:text-white" x-text="stats.guruAktif"></p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 shadow-sm border border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center text-purple-600 dark:text-purple-400">
                    <i data-lucide="book-open" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Mapel Aktif</p>
                    <p class="text-xl font-lexend font-bold text-slate-800 dark:text-white" x-text="stats.mapelAktif"></p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 shadow-sm border border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center text-amber-600 dark:text-amber-400">
                    <i data-lucide="layout-grid" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Rombel Terisi</p>
                    <p class="text-xl font-lexend font-bold text-slate-800 dark:text-white" x-text="stats.rombelTerisi"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. FILTER UTAMA -->
    <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <h3 class="text-sm font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <i data-lucide="filter" class="w-4 h-4 text-slate-400"></i> Filter Data
            </h3>
            
            <!-- Bonus: Toggle View -->
            <button @click="viewMode = viewMode === 'list' ? 'grouped' : 'list'" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1 bg-emerald-50 px-3 py-1.5 rounded-lg">
                <i :data-lucide="viewMode === 'list' ? 'layers' : 'list'" class="w-4 h-4"></i>
                <span x-text="viewMode === 'list' ? 'Group by Rombel' : 'List View'"></span>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3">
            <select x-model="filters.ta" class="form-input-siswa !py-2 !px-3 appearance-none">
                <option value="semua">Semua TA</option>
                <option value="2024/2025">2024/2025</option>
                <option value="2025/2026">2025/2026</option>
            </select>
            <select x-model="filters.semester" class="form-input-siswa !py-2 !px-3 appearance-none">
                <option value="semua">Semua Semester</option>
                <option value="Ganjil">Ganjil</option>
                <option value="Genap">Genap</option>
            </select>
            <select x-model="filters.rombel" class="form-input-siswa !py-2 !px-3 appearance-none">
                <option value="semua">Semua Rombel</option>
                <option value="1A">1A</option>
                <option value="2A">2A</option>
                <option value="3B">3B</option>
                <option value="6A">6A</option>
            </select>
            <select x-model="filters.mapel" class="form-input-siswa !py-2 !px-3 appearance-none">
                <option value="semua">Semua Mapel</option>
                <option value="Tematik">Tematik</option>
                <option value="Matematika">Matematika</option>
                <option value="PJOK">PJOK</option>
                <option value="PAI">PAI</option>
            </select>
            <select x-model="filters.guru" class="form-input-siswa !py-2 !px-3 appearance-none">
                <option value="semua">Semua Guru</option>
                <template x-for="g in daftarGuru" :key="g">
                    <option :value="g" x-text="g"></option>
                </template>
            </select>
        </div>
    </div>

    <!-- 4. TABEL DATA PENGAMPU -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
        
        <!-- List View -->
        <div x-show="viewMode === 'list'" class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 font-medium text-xs uppercase tracking-wider border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="p-4">Guru</th>
                        <th class="p-4">Mata Pelajaran</th>
                        <th class="p-4">Rombel</th>
                        <th class="p-4">TA / Semester</th>
                        <th class="p-4 text-center">Jam</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                    <template x-for="p in filteredData" :key="p.id">
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">
                            <td class="p-4">
                                <div class="font-bold text-slate-800 dark:text-white" x-text="p.guru"></div>
                                <div x-show="isOverload(p.guru)" class="text-[10px] text-rose-500 font-medium flex items-center gap-1 mt-0.5">
                                    <i data-lucide="alert-triangle" class="w-3 h-3"></i> Jam berlebih (>24j)
                                </div>
                            </td>
                            <td class="p-4 font-medium text-slate-600 dark:text-slate-300" x-text="p.mapel"></td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg text-xs font-bold text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700" x-text="p.rombel"></span>
                            </td>
                            <td class="p-4">
                                <div class="text-sm font-medium text-slate-800 dark:text-slate-200" x-text="p.ta"></div>
                                <div class="text-[10px] text-slate-400 uppercase tracking-wider" x-text="p.semester"></div>
                            </td>
                            <td class="p-4 text-center">
                                <span class="font-lexend font-bold text-indigo-600 dark:text-indigo-400" x-text="p.jam + ' JP'"></span>
                            </td>
                            <td class="p-4">
                                <!-- 5. STATUS -->
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold"
                                    :class="p.status === 'aktif' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-slate-200 text-slate-600 dark:bg-slate-800 dark:text-slate-400'">
                                    <span x-text="p.status === 'aktif' ? 'Aktif' : 'Nonaktif'"></span>
                                </span>
                            </td>
                            <td class="p-4 text-right space-x-1">
                                <!-- 6. AKSI -->
                                <button @click="openModal('edit', p)" class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </button>
                                <button @click="deleteData(p.id)" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus">
                                    <i data-lucide="trash" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredData.length === 0">
                        <td colspan="7" class="p-8 text-center text-slate-400">Tidak ada pengampu yang sesuai filter.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Bonus: Grouped View (By Rombel) -->
        <div x-show="viewMode === 'grouped'" class="p-4 space-y-4" x-cloak>
            <template x-for="(items, rombel) in groupedData" :key="rombel">
                <div class="border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden">
                    <div class="bg-slate-50 dark:bg-slate-800/50 p-3 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
                        <h4 class="font-lexend font-bold text-slate-800 dark:text-white flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Rombel <span x-text="rombel"></span>
                        </h4>
                        <span class="text-xs font-medium text-slate-500" x-text="items.length + ' Mapel Terisi'"></span>
                    </div>
                    <div class="p-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        <template x-for="p in items" :key="p.id">
                            <div class="flex items-start gap-3 p-3 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm relative group">
                                <div class="w-8 h-8 rounded-full bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 shrink-0">
                                    <i data-lucide="book" class="w-4 h-4"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-slate-800 dark:text-white truncate" x-text="p.mapel"></p>
                                    <p class="text-xs text-slate-500 truncate" x-text="p.guru"></p>
                                    <p class="text-[10px] text-slate-400 mt-1" x-text="p.jam + ' Jam Pelajaran'"></p>
                                </div>
                                <button @click="openModal('edit', p)" class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 p-1 bg-slate-100 hover:bg-blue-100 text-blue-600 rounded transition-all">
                                    <i data-lucide="pencil" class="w-3 h-3"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- 7. MODAL TAMBAH / EDIT PENGAMPU -->
    <div x-show="activeModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm modal-active" x-cloak>
        <div x-show="activeModal" @click.away="closeModal()" class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-lg animate-modal overflow-hidden flex flex-col max-h-[90vh]">
            
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/20">
                <h2 class="text-lg font-lexend font-bold text-slate-800 dark:text-white flex items-center gap-2">
                    <i :data-lucide="modalMode === 'add' ? 'plus-circle' : 'edit-3'" class="w-5 h-5 text-emerald-500"></i>
                    <span x-text="modalMode === 'add' ? 'Tambah Pengampu' : 'Edit Pengampu'"></span>
                </h2>
                <button @click="closeModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto custom-scrollbar flex-1">
                
                <!-- 8. VALIDASI LOGIKA (Error Alert) -->
                <div x-show="formError" class="mb-4 p-3 bg-rose-50 text-rose-600 border border-rose-200 rounded-xl text-xs font-medium flex items-start gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 mt-0.5"></i>
                    <span x-text="formError"></span>
                </div>

                <form @submit.prevent="saveData()" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-2">Guru Pengajar <span class="text-rose-500">*</span></label>
                        <select x-model="form.guru" class="form-input-siswa w-full appearance-none" required>
                            <option value="">Pilih Guru...</option>
                            <template x-for="g in daftarGuru" :key="g">
                                <option :value="g" x-text="g"></option>
                            </template>
                        </select>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Mata Pelajaran <span class="text-rose-500">*</span></label>
                            <select x-model="form.mapel" class="form-input-siswa w-full appearance-none" required>
                                <option value="">Pilih Mapel...</option>
                                <option value="Tematik">Tematik</option>
                                <option value="Matematika">Matematika</option>
                                <option value="PJOK">PJOK</option>
                                <option value="PAI">PAI</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Rombel <span class="text-rose-500">*</span></label>
                            <select x-model="form.rombel" class="form-input-siswa w-full appearance-none" required>
                                <option value="">Pilih Rombel...</option>
                                <option value="1A">1A</option>
                                <option value="2A">2A</option>
                                <option value="3B">3B</option>
                                <option value="6A">6A</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Tahun Ajaran <span class="text-rose-500">*</span></label>
                            <select x-model="form.ta" class="form-input-siswa w-full appearance-none" required>
                                <option value="2024/2025">2024/2025</option>
                                <option value="2025/2026">2025/2026</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Semester <span class="text-rose-500">*</span></label>
                            <select x-model="form.semester" class="form-input-siswa w-full appearance-none" required>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Jumlah Jam (JP) <span class="text-rose-500">*</span></label>
                            <input type="number" x-model.number="form.jam" min="1" max="40" class="form-input-siswa" required placeholder="Cth: 4">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">Status</label>
                            <select x-model="form.status" class="form-input-siswa w-full appearance-none" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3 bg-slate-50/50 dark:bg-slate-800/20">
                <button type="button" @click="closeModal()" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 font-bold text-xs uppercase tracking-wider hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Batal
                </button>
                <button @click="saveData()" class="btn-next-siswa">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Data
                </button>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
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
        Alpine.data('pengampuManager', () => ({
            // State 
            activeModal: false,
            modalMode: 'add',
            viewMode: 'list', // list or grouped
            formError: '',
            toast: { show: false, message: '' },
            
            // Daftar Referensi (Biasanya dari DB)
            daftarGuru: ['Ahmad Fauzi, S.Pd', 'Siti Aminah, M.Pd', 'Budi Santoso, S.Or', 'Dewi Lestari, S.Pd.I'],
            
            // 10. STATE ALPINE (pengampu array)
            pengampu: [
                { id: 1, guru: 'Ahmad Fauzi, S.Pd', mapel: 'Tematik', rombel: '1A', ta: '2024/2025', semester: 'Ganjil', jam: 24, status: 'aktif' },
                { id: 2, guru: 'Siti Aminah, M.Pd', mapel: 'Matematika', rombel: '6A', ta: '2024/2025', semester: 'Ganjil', jam: 6, status: 'aktif' },
                { id: 3, guru: 'Budi Santoso, S.Or', mapel: 'PJOK', rombel: '1A', ta: '2024/2025', semester: 'Ganjil', jam: 4, status: 'aktif' },
                { id: 4, guru: 'Budi Santoso, S.Or', mapel: 'PJOK', rombel: '2A', ta: '2024/2025', semester: 'Ganjil', jam: 4, status: 'aktif' },
                { id: 5, guru: 'Dewi Lestari, S.Pd.I', mapel: 'PAI', rombel: '3B', ta: '2024/2025', semester: 'Ganjil', jam: 4, status: 'nonaktif' },
            ],

            filters: {
                ta: 'semua',
                semester: 'semua',
                rombel: 'semua',
                mapel: 'semua',
                guru: 'semua'
            },

            form: {
                id: null, guru: '', mapel: '', rombel: '', ta: '2024/2025', semester: 'Ganjil', jam: 4, status: 'aktif'
            },

            initData() {
                this.$watch('filters', () => {
                    this.$nextTick(() => { lucide.createIcons(); });
                }, { deep: true });
                
                this.$watch('viewMode', () => {
                    this.$nextTick(() => { lucide.createIcons(); });
                });
            },

            // Computeds
            get filteredData() {
                return this.pengampu.filter(p => {
                    return (this.filters.ta === 'semua' || p.ta === this.filters.ta) &&
                           (this.filters.semester === 'semua' || p.semester === this.filters.semester) &&
                           (this.filters.rombel === 'semua' || p.rombel === this.filters.rombel) &&
                           (this.filters.mapel === 'semua' || p.mapel === this.filters.mapel) &&
                           (this.filters.guru === 'semua' || p.guru === this.filters.guru);
                });
            },

            get groupedData() {
                return this.filteredData.reduce((acc, obj) => {
                    let key = obj.rombel;
                    if (!acc[key]) acc[key] = [];
                    acc[key].push(obj);
                    return acc;
                }, {});
            },

            get stats() {
                let aktif = this.pengampu.filter(p => p.status === 'aktif');
                let mapelUnik = new Set(aktif.map(p => p.mapel));
                let guruUnik = new Set(aktif.map(p => p.guru));
                let rombelUnik = new Set(aktif.map(p => p.rombel));

                return {
                    guruAktif: guruUnik.size,
                    mapelAktif: mapelUnik.size,
                    rombelTerisi: rombelUnik.size
                };
            },

            // Validasi Jam Berlebih
            isOverload(guruName) {
                let totalJam = this.pengampu
                    .filter(p => p.guru === guruName && p.status === 'aktif' && p.ta === this.filters.ta)
                    .reduce((sum, current) => sum + parseInt(current.jam), 0);
                return totalJam > 24;
            },

            // Actions
            openModal(mode, data = null) {
                this.modalMode = mode;
                this.formError = '';
                
                if (mode === 'edit' && data) {
                    this.form = { ...data };
                } else {
                    this.form = { id: null, guru: '', mapel: '', rombel: '', ta: '2024/2025', semester: 'Ganjil', jam: 4, status: 'aktif' };
                }
                
                this.activeModal = true;
                this.$nextTick(() => { lucide.createIcons(); });
            },

            closeModal() {
                this.activeModal = false;
            },

            saveData() {
                this.formError = '';

                // Validasi Kosong
                if(!this.form.guru || !this.form.mapel || !this.form.rombel) {
                    this.formError = "Guru, Mapel, dan Rombel wajib diisi.";
                    return;
                }

                // 8. VALIDASI LOGIKA: 1 Rombel + 1 Mapel = Hanya boleh 1 Guru (di TA/Semester yang sama)
                const isDuplicate = this.pengampu.find(p => 
                    p.rombel === this.form.rombel && 
                    p.mapel === this.form.mapel && 
                    p.ta === this.form.ta && 
                    p.semester === this.form.semester && 
                    p.id !== this.form.id // Kecualikan diri sendiri saat edit
                );

                if (isDuplicate) {
                    this.formError = `Bentrok! Rombel ${this.form.rombel} sudah memiliki guru untuk mapel ${this.form.mapel} di Semester ini.`;
                    return;
                }

                // Proses Simpan
                if (this.modalMode === 'add') {
                    this.form.id = Date.now();
                    this.pengampu.unshift({ ...this.form });
                    this.showToast('Pengampu berhasil ditambahkan.');
                } else {
                    const index = this.pengampu.findIndex(p => p.id === this.form.id);
                    if(index !== -1) {
                        this.pengampu[index] = { ...this.form };
                        this.showToast('Data pengampu berhasil diperbarui.');
                    }
                }

                this.closeModal();
                this.$nextTick(() => { lucide.createIcons(); });
            },

            deleteData(id) {
                if(confirm('Apakah Anda yakin ingin menghapus data pengampu ini?')) {
                    this.pengampu = this.pengampu.filter(p => p.id !== id);
                    this.showToast('Data berhasil dihapus.');
                }
            },

            // 9. FITUR CEPAT
            autoAssign() {
                // Dummy logic for Auto Assign (Mapping Guru PJOK ke rombel yang kosong)
                if(confirm('Jalankan Auto-Assign? Sistem akan memetakan guru berdasarkan sisa jam mengajar yang tersedia.')) {
                    // Cek jika Rombel 3B belum ada PJOK
                    let exist = this.pengampu.find(p => p.rombel === '3B' && p.mapel === 'PJOK');
                    if(!exist) {
                        this.pengampu.push({
                            id: Date.now(), guru: 'Budi Santoso, S.Or', mapel: 'PJOK', rombel: '3B', ta: '2024/2025', semester: 'Ganjil', jam: 4, status: 'aktif'
                        });
                        this.showToast('Auto-assign berhasil dijalankan (1 Mapel dipetakan).');
                        this.$nextTick(() => { lucide.createIcons(); });
                    } else {
                        alert('Tidak ada mapel kosong yang bisa dipetakan secara otomatis saat ini.');
                    }
                }
            },

            openQuickAssign() {
                alert('Fitur Quick Assign: Fitur ini akan membuka antarmuka khusus untuk memilih 1 Rombel lalu men-checklist beberapa guru & mapel sekaligus. (Bisa dikembangkan lebih lanjut)');
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