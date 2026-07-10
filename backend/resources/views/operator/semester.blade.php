@extends('layouts.operator')

@section('content')
    <div x-data="semesterManager()" class="space-y-6 pb-10"
        x-init="$nextTick(() => { if (window.lucide) lucide.createIcons() })">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-lexend font-bold text-slate-800 dark:text-white">Manajemen Semester</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola semester, tahun ajaran, dan tentukan
                    semester aktif sistem.</p>
            </div>
            <button @click="openModal('add')"
                class="bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-3 rounded-2xl text-sm font-semibold flex items-center gap-2 shadow-sm shadow-emerald-500/20 transition-all active:scale-95">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                Tambah Semester
            </button>
        </div>

        <div x-show="!hasActiveSemester" x-transition.scale.origin.top
            class="bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-800/50 rounded-2xl p-4 flex items-start gap-3 shadow-sm">
            <div class="p-2 bg-amber-100 dark:bg-amber-900/30 rounded-xl shrink-0 text-amber-600 dark:text-amber-500">
                <i data-lucide="alert-triangle" class="w-5 h-5"></i>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-amber-800 dark:text-amber-400">Peringatan Sistem Akademik</h3>
                <p class="text-xs text-amber-700 dark:text-amber-500/80 mt-0.5">Belum ada semester yang ditandai sebagai
                    <b>Aktif</b>. Beberapa fitur sistem akademik mungkin tidak berjalan semestinya.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200/60 dark:border-slate-800 rounded-3xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center shrink-0">
                    <i data-lucide="calendar" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Semester</p>
                    <p class="text-2xl font-lexend font-bold text-slate-800 dark:text-white mt-1" x-text="totalSemesters"></p>
                </div>
            </div>
            <div class="bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200/60 dark:border-slate-800 rounded-3xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center shrink-0">
                    <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Semester Aktif</p>
                    <p class="text-2xl font-lexend font-bold text-emerald-600 dark:text-emerald-400 mt-1" x-text="activeCount"></p>
                </div>
            </div>
            <div class="bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200/60 dark:border-slate-800 rounded-3xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-slate-50 dark:bg-slate-800/50 text-slate-400 rounded-2xl flex items-center justify-center shrink-0">
                    <i data-lucide="archive" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Nonaktif</p>
                    <p class="text-2xl font-lexend font-bold text-slate-800 dark:text-white mt-1" x-text="inactiveCount"></p>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-between gap-4">
            <div class="relative w-full sm:max-w-xs">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                <input type="text" x-model="search" placeholder="Cari tahun ajaran / semester..."
                    class="w-full pl-11 pr-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
            </div>
            <div class="relative w-full sm:w-48 shrink-0">
                <i data-lucide="filter" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                <select x-model="filterStatus"
                    class="w-full pl-11 pr-8 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-sm appearance-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all cursor-pointer">
                    <option value="all">Semua Status</option>
                    <option value="active">Aktif Saja</option>
                    <option value="inactive">Nonaktif Saja</option>
                </select>
                <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/20 border-b border-slate-200 dark:border-slate-800 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                            <th class="p-4 pl-6">Tahun Ajaran</th>
                            <th class="p-4">Semester</th>
                            <th class="p-4">Tanggal Mulai</th>
                            <th class="p-4">Tanggal Selesai</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 pr-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                        <template x-for="sem in filteredSemesters" :key="sem.id">
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors group">
                                <td class="p-4 pl-6 text-sm font-medium text-slate-800 dark:text-slate-200" x-text="sem.tahun_ajaran"></td>
                                <td class="p-4 text-sm text-slate-600 dark:text-slate-400" x-text="sem.nama"></td>
                                <td class="p-4 text-sm text-slate-600 dark:text-slate-400" x-text="formatDate(sem.start)"></td>
                                <td class="p-4 text-sm text-slate-600 dark:text-slate-400" x-text="formatDate(sem.end)"></td>
                                <td class="p-4">
                                    <template x-if="sem.is_active">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            AKTIF
                                        </span>
                                    </template>
                                    <template x-if="!sem.is_active">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400 border border-slate-200 dark:border-slate-700/50">
                                            NONAKTIF
                                        </span>
                                    </template>
                                </td>
                                <td class="p-4 pr-6">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button @click="setActive(sem.id)" x-show="!sem.is_active" title="Set sebagai Aktif"
                                            class="p-2 text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 rounded-xl transition-colors">
                                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                                        </button>
                                        <button @click="openModal('edit', sem)" title="Edit"
                                            class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-xl transition-colors">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </button>
                                        <button @click="deleteSemester(sem.id)" title="Hapus"
                                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-colors">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <div x-show="filteredSemesters.length === 0" class="p-12 text-center flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4 text-slate-400">
                        <i data-lucide="search-x" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-lg font-lexend font-medium text-slate-800 dark:text-slate-200">Belum ada data semester</h3>
                    <p class="text-sm text-slate-500 mt-1">Gunakan tombol tambah untuk membuat semester baru.</p>
                </div>
            </div>
        </div>

        <!-- Modal Tambah/Edit -->
        <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center px-4">
            <div x-show="isModalOpen" x-transition.opacity class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="closeModal"></div>
            <div x-show="isModalOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                class="relative w-full max-w-lg bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/20">
                    <h3 class="text-lg font-lexend font-bold text-slate-800 dark:text-white"
                        x-text="modalMode === 'add' ? 'Tambah Semester Baru' : 'Edit Data Semester'"></h3>
                    <button @click="closeModal" class="p-2 text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-xl transition-colors">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-600 dark:text-slate-400">Tahun Ajaran</label>
                            <select x-model="form.tahun_ajaran_id"
                                class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                                <option value="">Pilih TA...</option>
                                <template x-for="ta in tahunAjarans" :key="ta.id">
                                    <option :value="ta.id" x-text="ta.tahun"></option>
                                </template>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-600 dark:text-slate-400">Semester</label>
                            <select x-model="form.nama"
                                class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-600 dark:text-slate-400">Tanggal Mulai</label>
                            <input type="date" x-model="form.start" placeholder="Pilih tanggal"
                                class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-600 dark:text-slate-400">Tanggal Selesai</label>
                            <input type="date" x-model="form.end" placeholder="Pilih tanggal"
                                class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 dark:bg-slate-800/40 rounded-2xl border border-slate-200 dark:border-slate-800 mt-2">
                        <label class="flex items-center justify-between cursor-pointer group">
                            <div>
                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Jadikan Semester Aktif</p>
                                <p class="text-[11px] text-slate-500 mt-0.5">Sistem hanya mengizinkan 1 semester aktif.</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" x-model="form.is_active" class="sr-only">
                                <div class="w-12 h-6 bg-slate-300 dark:bg-slate-700 rounded-full transition-colors duration-300 ease-in-out"
                                    :class="form.is_active ? 'bg-emerald-500 dark:bg-emerald-500' : ''"></div>
                                <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform duration-300 ease-in-out shadow-sm"
                                    :class="form.is_active ? 'translate-x-6' : 'translate-x-0'"></div>
                            </div>
                        </label>
                        <div x-show="form.is_active" x-collapse>
                            <p class="text-xs text-amber-600 dark:text-amber-400 mt-3 pt-3 border-t border-slate-200 dark:border-slate-700 flex items-center gap-1.5">
                                <i data-lucide="info" class="w-3 h-3"></i>
                                Semester aktif sebelumnya otomatis akan dinonaktifkan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end gap-3 bg-slate-50/50 dark:bg-slate-800/20">
                    <button @click="closeModal" class="px-5 py-2.5 rounded-2xl text-sm font-medium text-slate-600 hover:bg-slate-200 dark:text-slate-300 dark:hover:bg-slate-800 transition-colors">
                        Batal
                    </button>
                    <button @click="saveSemester" class="px-6 py-2.5 rounded-2xl text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-500 shadow-sm shadow-emerald-500/20 active:scale-95 transition-all">
                        Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('semesterManager', () => ({
                // Data Real dari Backend
                semesters: @json($semesters),
                tahunAjarans: @json($tahunAjarans),

                search: '',
                filterStatus: 'all',

                // Modal State
                isModalOpen: false,
                modalMode: 'add',
                form: {
                    id: null,
                    tahun_ajaran_id: '',
                    nama: 'Ganjil',
                    start: '',
                    end: '',
                    is_active: false,
                },

                // Getters / Computed Properties
                get hasActiveSemester() {
                    return this.semesters.some(s => s.is_active);
                },
                get totalSemesters() {
                    return this.semesters.length;
                },
                get activeCount() {
                    return this.semesters.filter(s => s.is_active).length;
                },
                get inactiveCount() {
                    return this.semesters.filter(s => !s.is_active).length;
                },
                get filteredSemesters() {
                    return this.semesters.filter(s => {
                        const matchSearch = s.tahun_ajaran.toLowerCase().includes(this.search.toLowerCase()) ||
                            s.nama.toLowerCase().includes(this.search.toLowerCase());
                        const matchFilter = this.filterStatus === 'all' ? true :
                            (this.filterStatus === 'active' ? s.is_active : !s.is_active);
                        return matchSearch && matchFilter;
                    });
                },

                // Actions
                openModal(mode = 'add', semester = null) {
                    this.modalMode = mode;
                    if (mode === 'edit' && semester) {
                        this.form = JSON.parse(JSON.stringify(semester));
                    } else {
                        this.form = {
                            id: null,
                            tahun_ajaran_id: this.tahunAjarans[0]?.id || '',
                            nama: 'Ganjil',
                            start: '',
                            end: '',
                            is_active: false
                        };
                    }
                    this.isModalOpen = true;
                    this.$nextTick(() => lucide.createIcons());
                },

                closeModal() {
                    this.isModalOpen = false;
                },

                async saveSemester() {
                    const isUpdate = !!this.form.id;
                    const url = isUpdate
                        ? `/operator/semester/${this.form.id}`
                        : '{{ route("operator.semester.store") }}';
                    const method = isUpdate ? 'PUT' : 'POST';

                    try {
                        const response = await fetch(url, {
                            method: method,
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                tahun_ajaran_id: this.form.tahun_ajaran_id,
                                nama: this.form.nama,
                                tgl_mulai: this.form.start,
                                tgl_selesai: this.form.end,
                                is_active: this.form.is_active,
                            })
                        });
                        const result = await response.json();
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Error: ' + (result.message || 'Gagal menyimpan'));
                        }
                    } catch (error) {
                        alert('Gagal menyimpan data semester.');
                    }
                },

                async setActive(id) {
                    if (confirm('Set semester ini menjadi Aktif? Semester aktif sebelumnya akan dinonaktifkan.')) {
                        try {
                            await fetch(`/operator/semester/${id}/aktif`, {
                                method: 'PATCH',
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                            });
                            location.reload();
                        } catch (error) {
                            alert('Gagal mengaktifkan semester.');
                        }
                    }
                },

                async deleteSemester(id) {
                    if (confirm('Apakah Anda yakin ingin menghapus semester ini?')) {
                        try {
                            await fetch(`/operator/semester/${id}`, {
                                method: 'DELETE',
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                            });
                            location.reload();
                        } catch (error) {
                            alert('Gagal menghapus data.');
                        }
                    }
                },

                // Formatter
                formatDate(dateStr) {
                    if (!dateStr) return '-';
                    const date = new Date(dateStr);
                    return date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                    });
                }
            }));
        });
    </script>
@endpush
