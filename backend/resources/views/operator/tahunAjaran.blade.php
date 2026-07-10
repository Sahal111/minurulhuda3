@extends('layouts.operator')

@section('content')
<div x-data="{ viewMode: 'main' }" x-cloak>

    <!-- ==================== ARSIP VIEW ==================== -->
    <div x-show="viewMode === 'arsip'" x-data="arsipTahunPanel()" style="display: none;" class="space-y-6">
    
    <!-- 1. Header Halaman -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800">
        <div>
            <div class="flex items-center gap-3">
                <div class="p-2 bg-slate-100 dark:bg-slate-800 rounded-lg text-slate-500">
                    <i data-lucide="archive" class="w-6 h-6"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-lexend font-bold text-slate-800 dark:text-white leading-tight">Arsip Akademik</h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Akses data historis tahun ajaran yang telah selesai</p>
                </div>
            </div>
        </div>
        <div class="flex gap-2">
            <button @click="viewMode = 'main'" class="btn-prev-siswa">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
                Kembali
            </button>
            <button @click="exportSemuaArsip()" class="btn-next-siswa !bg-blue-600 hover:!bg-blue-700">
                <i data-lucide="download-cloud" class="w-4 h-4 mr-1"></i>
                Backup Semua Arsip
            </button>
        </div>
    </div>

    <!-- 2. Filter & Pencarian -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl p-5 shadow-sm border border-slate-100 dark:border-slate-800">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="space-y-1.5 md:col-span-2">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Cari Data Arsip</label>
                <div class="relative">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="text" x-model="search" placeholder="Cari tahun ajaran atau nama semester..." class="form-input-siswa pl-11 w-full !py-2.5">
                </div>
            </div>
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Urutan</label>
                <select x-model="sortBy" class="form-input-siswa !py-2.5 text-sm font-medium">
                    <option value="newest">Terbaru ke Terlama</option>
                    <option value="oldest">Terlama ke Terbaru</option>
                </select>
            </div>
        </div>
    </div>

    <!-- 3. Grid Arsip (Card Style) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="item in filteredArsip" :key="item.id">
            <div class="bg-white dark:bg-slate-900 rounded-[2rem] p-6 shadow-sm border border-slate-100 dark:border-slate-800 group hover:border-blue-500/50 transition-all duration-300">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:bg-blue-50 group-hover:text-blue-500 transition-colors">
                        <i data-lucide="folder-lock" class="w-7 h-7"></i>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 text-[10px] font-bold uppercase tracking-wider" x-text="item.status"></span>
                </div>

                <div class="space-y-1 mb-6">
                    <h3 class="text-xl font-lexend font-black text-slate-800 dark:text-white" x-text="item.tahun"></h3>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400" x-text="'Semester ' + item.semester"></p>
                </div>

                <!-- Info Stats Kecil -->
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 text-center">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">Siswa</p>
                        <p class="text-sm font-bold text-slate-700 dark:text-slate-300" x-text="item.jumlah_siswa"></p>
                    </div>
                    <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 text-center">
                        <p class="text-[9px] font-bold text-slate-400 uppercase">Lulus</p>
                        <p class="text-sm font-bold text-emerald-600" x-text="item.kelulusan + '%'"></p>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-dashed border-slate-100 dark:border-slate-800">
                    <div class="flex -space-x-2">
                        <div class="w-7 h-7 rounded-full border-2 border-white dark:border-slate-900 bg-blue-100 flex items-center justify-center text-[10px] font-bold">A</div>
                        <div class="w-7 h-7 rounded-full border-2 border-white dark:border-slate-900 bg-emerald-100 flex items-center justify-center text-[10px] font-bold">B</div>
                        <div class="w-7 h-7 rounded-full border-2 border-white dark:border-slate-900 bg-amber-100 flex items-center justify-center text-[10px] font-bold">C</div>
                    </div>
                    <button @click="lihatDetail(item)" class="text-xs font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 group/btn">
                        Detail Arsip
                        <i data-lucide="arrow-right" class="w-3 h-3 transition-transform group-hover/btn:translate-x-1"></i>
                    </button>
                </div>
            </div>
        </template>

        <!-- Empty State -->
        <div x-show="filteredArsip.length === 0" class="col-span-full py-20 bg-white dark:bg-slate-900 rounded-[2rem] border-2 border-dashed border-slate-100 dark:border-slate-800 flex flex-col items-center">
            <i data-lucide="folder-search" class="w-12 h-12 text-slate-300 mb-4"></i>
            <h4 class="text-slate-800 dark:text-white font-bold">Arsip tidak ditemukan</h4>
            <p class="text-sm text-slate-500">Coba kata kunci lain atau periksa filter Anda.</p>
        </div>
    </div>

    <!-- 4. Modal Detail Arsip -->
    <div x-show="activeDetail" style="display: none;">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 transition-opacity" @click="activeDetail = false"></div>
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 pointer-events-none">
            <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl w-full max-w-2xl pointer-events-auto flex flex-col max-h-[90vh] animate-modal border border-slate-100 dark:border-slate-800 overflow-hidden">
                
                <div class="relative h-32 bg-gradient-to-r from-slate-800 to-slate-900 p-8 flex items-end">
                    <button @click="activeDetail = false" class="absolute top-6 right-6 w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white transition-colors">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                    <div class="text-white">
                        <h2 class="text-2xl font-lexend font-bold" x-text="'Arsip TA ' + selectedItem?.tahun"></h2>
                        <p class="text-sm text-slate-300" x-text="'Semester ' + selectedItem?.semester + ' (Data Terkunci)'"></p>
                    </div>
                </div>

                <div class="p-8 overflow-y-auto custom-scrollbar space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800 hover:bg-blue-50 dark:hover:bg-blue-900/20 border border-slate-100 dark:border-slate-800 transition-all text-left">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/50 text-blue-600 flex items-center justify-center">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-white leading-tight">Data Siswa</p>
                                <p class="text-[10px] text-slate-500 mt-1">Lihat rombel & siswa</p>
                            </div>
                        </button>
                        <button class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 border border-slate-100 dark:border-slate-800 transition-all text-left">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 flex items-center justify-center">
                                <i data-lucide="file-text" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-white leading-tight">E-Rapor & Nilai</p>
                                <p class="text-[10px] text-slate-500 mt-1">Export transkrip nilai</p>
                            </div>
                        </button>
                        <button class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800 hover:bg-amber-50 dark:hover:bg-amber-900/20 border border-slate-100 dark:border-slate-800 transition-all text-left">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/50 text-amber-600 flex items-center justify-center">
                                <i data-lucide="user-check" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-white leading-tight">Presensi</p>
                                <p class="text-[10px] text-slate-500 mt-1">Ringkasan kehadiran</p>
                            </div>
                        </button>
                        <button class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800 hover:bg-purple-50 dark:hover:bg-purple-900/20 border border-slate-100 dark:border-slate-800 transition-all text-left">
                            <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/50 text-purple-600 flex items-center justify-center">
                                <i data-lucide="shield-check" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-white leading-tight">Data Kelulusan</p>
                                <p class="text-[10px] text-slate-500 mt-1">Daftar alumni</p>
                            </div>
                        </button>
                    </div>

                    <div class="p-5 rounded-3xl bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800/50 flex gap-4">
                        <div class="text-amber-500 shrink-0">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-amber-800 dark:text-amber-400">Data ini bersifat Read-Only</p>
                            <p class="text-[11px] text-amber-700 dark:text-amber-500/80 leading-relaxed mt-0.5">
                                Tahun ajaran ini telah diarsipkan secara permanen. Anda tidak dapat mengubah data siswa atau nilai pada periode ini.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-slate-100 dark:border-slate-800 flex justify-end bg-slate-50/50 dark:bg-slate-800/30">
                    <button @click="activeDetail = false" class="btn-next-siswa">Tutup Detail</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('arsipTahunPanel', () => ({
            search: '',
            sortBy: 'newest',
            activeDetail: false,
            selectedItem: null,

            // Data Arsip from Backend
            arsipData: @json($arsipData),

            get filteredArsip() {
                let data = this.arsipData.filter(i => {
                    return i.tahun.toLowerCase().includes(this.search.toLowerCase()) || 
                           i.semester.toLowerCase().includes(this.search.toLowerCase());
                });

                if (this.sortBy === 'newest') {
                    return data.sort((a, b) => b.id - a.id);
                } else {
                    return data.sort((a, b) => a.id - b.id);
                }
            },

            lihatDetail(item) {
                this.selectedItem = item;
                this.activeDetail = true;
                setTimeout(() => lucide.createIcons(), 50);
            },

        }));
    });
</script>
@endpush

    <!-- ==================== MAIN VIEW ==================== -->
    <div x-show="viewMode === 'main'" x-data="tahunAjaranPanel()" class="space-y-6">
    
    <!-- 1. Header Halaman -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800">
        <div>
            <h1 class="text-2xl font-lexend font-bold text-slate-800 dark:text-white leading-tight">Manajemen Tahun Ajaran</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola periode akademik dan status aktif sekolah</p>
        </div>
        <div class="flex gap-2">
            <button @click="viewMode = 'arsip'" class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 sm:px-5 py-2.5 rounded-xl font-medium transition-all shadow-sm active:scale-95">
                <i data-lucide="trash-2" class="w-5 h-5"></i>
                <span class="hidden sm:inline">Recycle Bin</span>
            </button>
            <button @click="viewMode = 'arsip'" class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 sm:px-5 py-2.5 rounded-xl font-medium transition-all shadow-sm active:scale-95">
                <i data-lucide="archive" class="w-5 h-5"></i>
                <span class="hidden sm:inline">Arsip</span>
            </button>
            <button @click="openPromotionModal()" class="flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-sm shadow-amber-600/20 active:scale-95">
                <i data-lucide="trending-up" class="w-5 h-5"></i>
                Kenaikan Kelas Massal
            </button>
            <button @click="openModal()" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-sm shadow-emerald-600/20 active:scale-95">
                <i data-lucide="plus" class="w-5 h-5"></i>
                Tambah Tahun Ajaran
            </button>
        </div>
    </div>

    <!-- 2. Card Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800 flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                <i data-lucide="calendar-days" class="w-7 h-7"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Tahun</p>
                <h3 class="text-3xl font-lexend font-bold text-slate-800 dark:text-white" x-text="totalTahun"></h3>
            </div>
        </div>
        
        <!-- Aktif -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800 flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <i data-lucide="check-circle-2" class="w-7 h-7"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Tahun Aktif</p>
                <h3 class="text-3xl font-lexend font-bold text-slate-800 dark:text-white" x-text="totalAktif"></h3>
            </div>
        </div>

        <!-- Nonaktif -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-800 flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-slate-50 dark:bg-slate-800/50 flex items-center justify-center text-slate-500 dark:text-slate-400">
                <i data-lucide="archive" class="w-7 h-7"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Tahun Nonaktif</p>
                <h3 class="text-3xl font-lexend font-bold text-slate-800 dark:text-white" x-text="totalNonaktif"></h3>
            </div>
        </div>
    </div>

    <!-- 3. Alert (Muncul jika tidak ada yang aktif) -->
    <div x-show="!hasActive()" x-transition class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/50 rounded-2xl p-4 flex items-start sm:items-center gap-4">
        <div class="text-amber-500 mt-0.5 sm:mt-0">
            <i data-lucide="alert-triangle" class="w-6 h-6"></i>
        </div>
        <div>
            <h4 class="text-sm font-bold text-amber-800 dark:text-amber-400">Peringatan Sistem</h4>
            <p class="text-sm text-amber-700 dark:text-amber-500/80 mt-0.5">Belum ada tahun ajaran yang di-set aktif. Proses akademik dan sinkronisasi data mungkin terganggu.</p>
        </div>
    </div>

    <!-- Main Content Table & Filters -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden flex flex-col">
        
        <!-- Filters & Search -->
        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="relative w-full sm:w-72">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                <input type="text" x-model="search" placeholder="Cari tahun ajaran..." class="form-input-siswa pl-11 w-full !py-2.5">
            </div>
            <div class="w-full sm:w-auto flex gap-2">
                <select x-model="filterStatus" class="form-input-siswa !py-2.5 text-sm font-medium">
                    <option value="all">Semua Status</option>
                    <option value="aktif">Aktif Saja</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
        </div>

        <!-- 4. Tabel Data -->
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-800/30 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-widest border-b border-slate-100 dark:border-slate-800">
                        <th class="px-6 py-4 font-bold">Tahun Ajaran</th>
                        <th class="px-6 py-4 font-bold">Semester</th>
                        <th class="px-6 py-4 font-bold text-center">Status</th>
                        <th class="px-6 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50" x-effect="$nextTick(() => lucide.createIcons())">
                    <template x-for="item in filteredData" :key="item.id">
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="font-bold text-sm text-slate-800 dark:text-slate-200" x-text="item.tahun"></span>
                            </td>
                            <td class="px-6 py-4">
                                <template x-if="item.semesters && item.semesters.length > 0">
                                    <div class="flex flex-wrap gap-1">
                                        <template x-for="sem in item.semesters" :key="sem.id">
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold"
                                                :class="sem.is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400'"
                                                x-text="sem.nama"></span>
                                        </template>
                                    </div>
                                </template>
                                <template x-if="!item.semesters || item.semesters.length === 0">
                                    <span class="text-xs text-slate-400 italic">Belum ada</span>
                                </template>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <!-- 5. Badge Status -->
                                <span x-show="item.is_active" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-[10px] font-bold uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Aktif
                                </span>
                                <span x-show="!item.is_active" class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider">
                                    Nonaktif
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <!-- 6. Aksi -->
                                <div class="flex items-center justify-center gap-3">
                                    <button x-show="item.is_active" @click="archiveYear(item.id)" class="text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 transition-colors tooltip-trigger" title="Arsipkan Tahun">
                                        <i data-lucide="archive" class="w-4 h-4"></i>
                                    </button>
                                    <button @click="openModal(item)" class="text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors tooltip-trigger" title="Edit Data">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <button @click="deleteData(item.id, item.tahun)" class="text-slate-400 hover:text-red-600 dark:hover:text-red-400 transition-colors tooltip-trigger" title="Hapus Data">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredData.length === 0">
                        <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center">
                                <i data-lucide="search-x" class="w-8 h-8 mb-3 opacity-50"></i>
                                <p class="text-sm font-medium">Tidak ada data tahun ajaran ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 7. Modal Form -->
    <div x-show="activeModal" style="display: none;">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 transition-opacity" @click="closeModal()"></div>
        
        <!-- Modal Content -->
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 pointer-events-none">
            <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl w-full max-w-lg pointer-events-auto flex flex-col max-h-[90vh] animate-modal border border-slate-100 dark:border-slate-800">
                
                <!-- Header Modal -->
                <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <div>
                        <h3 class="font-lexend font-bold text-xl text-slate-800 dark:text-white" x-text="modalTitle"></h3>
                        <p class="text-xs text-slate-500 mt-1">Lengkapi form di bawah ini dengan benar.</p>
                    </div>
                    <button @click="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-red-500 transition-colors">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Body Modal -->
                <div class="p-8 overflow-y-auto custom-scrollbar space-y-5">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-600 dark:text-slate-400 ml-1">Tahun Ajaran <span class="text-red-500">*</span></label>
                        <input type="text" x-model="form.tahun" placeholder="Contoh: 2025/2026" class="form-input-siswa">
                    </div>



                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-slate-800 dark:text-white">Jadikan Tahun Aktif?</p>
                            <p class="text-[10px] text-slate-500 mt-0.5">Hanya boleh ada 1 tahun yang aktif.</p>
                        </div>
                        <!-- Toggle Switch -->
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" x-model="form.is_active" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-emerald-500"></div>
                        </label>
                    </div>
                </div>

                <!-- Footer Modal (Menggunakan class btn-next-siswa dan btn-prev-siswa) -->
                <div class="px-8 py-5 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end gap-2 bg-slate-50/50 dark:bg-slate-800/30 rounded-b-[2rem]">
                    <button @click="closeModal()" class="btn-prev-siswa">
                        Batal
                    </button>
                    <button @click="saveData()" class="btn-next-siswa">
                        <i data-lucide="save" class="w-4 h-4 mr-1"></i>
                        Simpan Data
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- 8. Modal Kenaikan Kelas Massal -->
    <div x-show="activePromotionModal" style="display: none;">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 transition-opacity" @click="closePromotionModal()"></div>
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 pointer-events-none">
            <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl w-full max-w-xl pointer-events-auto flex flex-col max-h-[90vh] animate-modal border border-slate-100 dark:border-slate-800">
                <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <div>
                        <h3 class="font-lexend font-bold text-xl text-slate-800 dark:text-white">Kenaikan Kelas Massal</h3>
                        <p class="text-xs text-slate-500 mt-1">Naikkan semua siswa ke tahun ajaran baru sekaligus.</p>
                    </div>
                    <button @click="closePromotionModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-red-500 transition-colors">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>

                <div class="p-8 overflow-y-auto custom-scrollbar space-y-6">
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800/50 rounded-2xl flex gap-4">
                        <div class="text-blue-500">
                            <i data-lucide="info" class="w-6 h-6"></i>
                        </div>
                        <p class="text-xs text-blue-700 dark:text-blue-400 leading-relaxed">
                            Fitur ini akan memperbarui status kelas semua siswa aktif ke tingkat berikutnya dan menghubungkannya dengan tahun ajaran baru yang dipilih.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-600 dark:text-slate-400 ml-1">Dari Tahun Ajaran (Sumber)</label>
                            <select class="form-input-siswa" x-model="promotion.fromYear">
                                <template x-for="item in tahunAjaran" :key="item.id">
                                    <option :value="item.tahun" x-text="item.tahun + ' (' + item.semester + ')'"></option>
                                </template>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-600 dark:text-slate-400 ml-1">Ke Tahun Ajaran (Target)</label>
                            <select class="form-input-siswa" x-model="promotion.toYear">
                                <template x-for="item in tahunAjaran" :key="item.id">
                                    <option :value="item.tahun" x-text="item.tahun + ' (' + item.semester + ')'"></option>
                                </template>
                                <option value="2025/2026">2025/2026 (Baru)</option>
                            </select>
                        </div>
                    </div>

                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 space-y-4">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-slate-800 dark:text-white">Naikkan Tingkat Kelas?</p>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="promotion.incrementLevel" class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-emerald-500"></div>
                            </label>
                        </div>
                        <p class="text-[10px] text-slate-500 leading-relaxed">Jika aktif, siswa kelas 1 akan naik ke kelas 2, dsb. Siswa tingkat akhir akan ditandai sebagai Lulus/Alumni.</p>
                    </div>
                </div>

                <div class="px-8 py-5 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end gap-2 bg-slate-50/50 dark:bg-slate-800/30 rounded-b-[2rem]">
                    <button @click="closePromotionModal()" class="btn-prev-siswa">Batal</button>
                    <button @click="executePromotion()" class="btn-next-siswa !bg-amber-500 hover:!bg-amber-600">
                        <i data-lucide="zap" class="w-4 h-4 mr-1"></i>
                        Proses Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div> <!-- End Promotion Modal Background -->

    <!-- 9. Modal Recycle Bin -->
    <div x-show="activeTrashModal" style="display: none;">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 transition-opacity" @click="closeTrashModal()"></div>
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 pointer-events-none">
            <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl w-full max-w-xl pointer-events-auto flex flex-col max-h-[90vh] animate-modal border border-slate-100 dark:border-slate-800">
                <div class="px-8 pt-8 pb-6 flex items-center justify-between shrink-0 border-b border-slate-100 dark:border-slate-800">
                    <div>
                        <h3 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tighter flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-rose-100 dark:bg-rose-900/30 flex items-center justify-center">
                                <i data-lucide="trash-2" class="w-4 h-4 text-rose-500"></i>
                            </div>
                            RECYCLE <span class="text-rose-500">BIN</span>
                        </h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Tahun ajaran yang dihapus — dapat dipulihkan</p>
                    </div>
                    <button @click="closeTrashModal()" class="w-10 h-10 flex items-center justify-center bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-full transition-all">
                        <i data-lucide="x" class="w-5 h-5 text-slate-500"></i>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-8">
                    <template x-if="trashLoading">
                        <div class="flex justify-center py-10">
                            <span class="w-6 h-6 border-2 border-rose-500 border-t-transparent rounded-full animate-spin"></span>
                        </div>
                    </template>
                    <template x-if="!trashLoading && trashData.length === 0">
                        <div class="text-center py-12 text-slate-400">
                            <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="trash-2" class="w-8 h-8 opacity-30"></i>
                            </div>
                            <p class="font-bold text-sm">Recycle Bin kosong</p>
                            <p class="text-xs mt-1">Tidak ada tahun ajaran yang dihapus</p>
                        </div>
                    </template>
                    <template x-if="!trashLoading && trashData.length > 0">
                        <div class="space-y-3">
                            <template x-for="item in trashData" :key="item.id">
                                <div class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-800">
                                    <div class="w-10 h-10 rounded-xl bg-slate-200 dark:bg-slate-700 flex items-center justify-center shrink-0">
                                        <i data-lucide="calendar" class="w-5 h-5 text-slate-400"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-800 dark:text-white truncate" x-text="item.tahun"></p>
                                        <p class="text-[10px] text-slate-400" x-text="'Dihapus: ' + item.deleted_at"></p>
                                        <template x-if="item.semesters && item.semesters.length > 0">
                                            <div class="flex flex-wrap gap-1 mt-1">
                                                <template x-for="sem in item.semesters" :key="sem.id">
                                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400" x-text="sem.nama"></span>
                                                </template>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="flex gap-2 shrink-0">
                                        <button @click="restoreTrash(item.id, item.tahun)" :disabled="trashProcessing === item.id"
                                            class="px-3 py-2 bg-emerald-100 dark:bg-emerald-900/30 hover:bg-emerald-200 dark:hover:bg-emerald-900/50 text-emerald-700 dark:text-emerald-400 rounded-xl text-[10px] font-bold transition-all flex items-center gap-1 disabled:opacity-50">
                                            <i data-lucide="undo-2" class="w-3 h-3"></i> Pulihkan
                                        </button>
                                        <button @click="forceDeleteTrash(item.id, item.tahun)" :disabled="trashProcessing === item.id"
                                            class="px-3 py-2 bg-rose-100 dark:bg-rose-900/30 hover:bg-rose-200 dark:hover:bg-rose-900/50 text-rose-700 dark:text-rose-400 rounded-xl text-[10px] font-bold transition-all flex items-center gap-1 disabled:opacity-50">
                                            <i data-lucide="trash-2" class="w-3 h-3"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>

                    <template x-if="!trashLoading && trashLastPage > 1">
                        <div class="mt-6 flex items-center justify-between">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest" x-text="'Menampilkan ' + trashFrom + '–' + trashTo + ' dari ' + trashTotal"></p>
                            <div class="flex items-center gap-2">
                                <button @click="loadTrash(trashCurrentPage - 1)" :disabled="trashCurrentPage <= 1"
                                    class="px-3 py-2 text-xs font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-all flex items-center gap-1 disabled:opacity-40">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i> Sebelumnya
                                </button>
                                <button @click="loadTrash(trashCurrentPage + 1)" :disabled="trashCurrentPage >= trashLastPage"
                                    class="px-3 py-2 text-xs font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-all flex items-center gap-1 disabled:opacity-40">
                                    Berikutnya <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="px-8 py-5 bg-slate-50/50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800 shrink-0">
                    <p class="text-[10px] text-slate-400 flex items-center gap-1.5">
                        <i data-lucide="info" class="w-3 h-3 shrink-0"></i>
                        Data yang dihapus permanen <strong>tidak dapat dipulihkan</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>

    </div> <!-- END MAIN VIEW -->
</div> <!-- END WRAPPER -->

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('tahunAjaranPanel', () => ({
            // State
            search: '',
            filterStatus: 'all',
            activeModal: false,
            activePromotionModal: false,
            activeTrashModal: false,
            modalTitle: 'Tambah Tahun Ajaran',

            // Trash State
            trashData: [],
            trashLoading: false,
            trashProcessing: null,
            trashCurrentPage: 1,
            trashLastPage: 1,
            trashTotal: 0,
            trashFrom: 0,
            trashTo: 0,
            
            // Real Data from Backend
            tahunAjaran: @json($tahunAjarans),
            
            form: { id: null, tahun: '', is_active: false },
            promotion: { fromYear: '2024/2025', toYear: '2025/2026', incrementLevel: true },

            // Computed / Getters
            get filteredData() {
                return this.tahunAjaran.filter(item => {
                    const matchSearch = item.tahun.toLowerCase().includes(this.search.toLowerCase());
                    const matchFilter = this.filterStatus === 'all' || 
                                      (this.filterStatus === 'aktif' && item.is_active) || 
                                      (this.filterStatus === 'nonaktif' && !item.is_active);
                    return matchSearch && matchFilter;
                });
            },
            get totalTahun() { return this.tahunAjaran.length; },
            get totalAktif() { return this.tahunAjaran.filter(i => i.is_active).length; },
            get totalNonaktif() { return this.totalTahun - this.totalAktif; },
            
            // Helpers
            hasActive() { return this.totalAktif > 0; },
            formatDate(dateString) {
                if (!dateString) return '-';
                const options = { year: 'numeric', month: 'short', day: 'numeric' };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            },

            // Actions
            openModal(item = null) {
                if (item) {
                    this.modalTitle = 'Edit Tahun Ajaran';
                    // Format tanggal agar sesuai dengan Flatpickr (Y-m-d)
                    this.form = { 
                        ...item,
                        tgl_mulai: item.tgl_mulai ? item.tgl_mulai.split('T')[0] : '',
                        tgl_selesai: item.tgl_selesai ? item.tgl_selesai.split('T')[0] : ''
                    };
                } else {
                    this.modalTitle = 'Tambah Tahun Ajaran';
                    this.form = { id: null, tahun: '', is_active: false };
                }
                this.activeModal = true;


                // Dispatch event untuk update layout jika ada class listener di body
                this.$dispatch('modal-open'); 
            },
            closeModal() {
                this.activeModal = false;
                this.$dispatch('modal-close');
            },
            openPromotionModal() {
                this.activePromotionModal = true;
                this.$dispatch('modal-open');
            },
            closePromotionModal() {
                this.activePromotionModal = false;
                this.$dispatch('modal-close');
            },
            async executePromotion() {
                if(confirm(`Yakin ingin menaikkan semua siswa dari ${this.promotion.fromYear} ke ${this.promotion.toYear}?`)) {
                    try {
                        const response = await fetch('{{ route('operator.tahunAjaran.promote') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.promotion)
                        });
                        const result = await response.json();
                        alert(result.message);
                        this.closePromotionModal();
                    } catch (error) {
                        alert('Gagal memproses kenaikan kelas.');
                    }
                }
            },
            async saveData() {
                const isUpdate = !!this.form.id;
                const url = isUpdate ? `/operator/tahun-ajaran/${this.form.id}` : '{{ route('operator.tahunAjaran.store') }}';
                const method = isUpdate ? 'PUT' : 'POST';

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(this.form)
                    });
                    const result = await response.json();
                    
                    // Reload to get fresh data or update locally
                    location.reload(); 
                } catch (error) {
                    alert('Gagal menyimpan data.');
                }
            },
            async deleteData(id, tahun) {
                if(confirm(`Yakin hapus tahun ajaran ${tahun}? Data akan dipindahkan ke Recycle Bin.`)) {
                    try {
                        const response = await fetch(`/operator/tahun-ajaran/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        location.reload();
                    } catch (error) {
                        alert('Gagal menghapus data.');
                    }
                }
            },

            // ── Recycle Bin ─────────────────────────────
            openTrashModal() {
                this.activeTrashModal = true;
                this.$dispatch('modal-open');
                this.loadTrash(1);
            },
            closeTrashModal() {
                this.activeTrashModal = false;
                this.$dispatch('modal-close');
            },
            async loadTrash(page = 1) {
                this.trashLoading = true;
                try {
                    const response = await fetch(`/operator/tahun-ajaran/trash?page=${page}`, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                    });
                    const result = await response.json();
                    const ta = result.tahun_ajarans || { data: [], total: 0, current_page: 1, last_page: 1, from: 0, to: 0 };
                    this.trashData = ta.data || [];
                    this.trashCurrentPage = ta.current_page || 1;
                    this.trashLastPage = ta.last_page || 1;
                    this.trashTotal = ta.total || 0;
                    this.trashFrom = ta.from || 0;
                    this.trashTo = ta.to || 0;
                    setTimeout(() => lucide.createIcons(), 50);
                } catch (error) {
                    console.error('Gagal memuat Recycle Bin', error);
                } finally {
                    this.trashLoading = false;
                }
            },
            async restoreTrash(id, tahun) {
                if (!confirm(`Pulihkan tahun ajaran "${tahun}"?`)) return;
                this.trashProcessing = id;
                try {
                    const response = await fetch(`/operator/tahun-ajaran/${id}/restore`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });
                    const result = await response.json();
                    alert(result.message);
                    this.loadTrash(this.trashCurrentPage);
                } catch (error) {
                    alert('Gagal memulihkan data.');
                } finally {
                    this.trashProcessing = null;
                }
            },
            async forceDeleteTrash(id, tahun) {
                if (!confirm(`Hapus permanen "${tahun}"? Data TIDAK dapat dipulihkan!`)) return;
                if (!confirm(`KONFIRMASI: Hapus permanen tahun ajaran "${tahun}"? Semua data terkait akan ikut terhapus!`)) return;
                this.trashProcessing = id;
                try {
                    const response = await fetch(`/operator/tahun-ajaran/${id}/force`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });
                    const result = await response.json();
                    alert(result.message);
                    this.loadTrash(this.trashCurrentPage);
                } catch (error) {
                    alert('Gagal menghapus permanen.');
                } finally {
                    this.trashProcessing = null;
                }
            },
            async archiveYear(id) {
                if(confirm('Arsipkan tahun ajaran ini? Tahun ajaran dan semesternya akan menjadi nonaktif.')) {
                    try {
                        const response = await fetch(`/operator/tahun-ajaran/${id}/archive`, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        location.reload();
                    } catch (error) {
                        alert('Gagal mengarsipkan tahun ajaran.');
                    }
                }
            }
        }));
    });
</script>
@endpush
@endsection

