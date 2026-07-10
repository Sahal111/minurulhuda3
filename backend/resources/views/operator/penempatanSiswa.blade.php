@extends('layouts.operator')
@section('content')
<div x-data="penempatanPanel()" x-cloak class="space-y-6 relative">

    <!-- Toast Notification Container -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3 pointer-events-none">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-show="true" x-transition.opacity.duration.300ms class="flex items-center gap-3 px-4 py-3 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 pointer-events-auto" :class="toast.type === 'error' ? 'border-l-4 border-l-red-500' : 'border-l-4 border-l-emerald-500'">
                <div :class="toast.type === 'error' ? 'text-red-500' : 'text-emerald-500'">
                    <i :data-lucide="toast.type === 'error' ? 'alert-circle' : 'check-circle'" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-800 dark:text-white" x-text="toast.title"></h4>
                    <p class="text-xs text-slate-500" x-text="toast.message"></p>
                </div>
            </div>
        </template>
    </div>

    <!-- 1. Header Halaman -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <h1 class="text-2xl font-lexend font-bold text-slate-800 dark:text-white leading-tight">Penempatan Siswa</h1>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-[10px] font-bold uppercase tracking-wider border border-emerald-200 dark:border-emerald-800/50">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    TA {{ $activeTahun->nama }}
                </span>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400">Atur distribusi siswa ke dalam rombongan belajar</p>
        </div>

        <!-- Bonus: Auto Assign Action -->
        <button @click="autoAssign()" class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-sm shadow-blue-600/20 active:scale-95 tooltip-trigger" title="Bagi rata siswa ke rombel tersedia">
            <i data-lucide="wand-2" class="w-5 h-5"></i>
            Auto Assign (AI)
        </button>
    </div>

    <!-- 2. Filter Utama -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl p-5 shadow-sm border border-slate-100 dark:border-slate-800">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-400 uppercase tracking-wider ml-1">Tingkat Kelas</label>
                <!-- Di filter Tingkat Kelas, ganti template statis dengan data dari rombels -->
                <select x-model.number="filters.tingkat" class="form-input-siswa !py-2.5 !rounded-xl text-sm">
                    <template x-for="t in [...new Set(rombels.map(r => r.tingkat))].sort()" :key="t">
                        <option :value="t" x-text="'Kelas ' + t"></option>
                    </template>
                </select>
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-400 uppercase tracking-wider ml-1">Status Penempatan</label>
                <select x-model="filters.status" class="form-input-siswa !py-2.5 !rounded-xl text-sm">
                    <option value="belum">Belum Ditempatkan</option>
                    <option value="sudah">Sudah Ditempatkan</option>
                </select>
            </div>
            <div class="space-y-1.5 md:col-span-2">
                <label class="text-xs font-bold text-slate-400 uppercase tracking-wider ml-1">Cari Siswa</label>
                <div class="relative">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="text" x-model="filters.search" placeholder="Cari NIS atau Nama Siswa..." class="form-input-siswa pl-11 w-full !py-2.5 !rounded-xl">
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Layout Utama (Dual Panel) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        <!-- PANEL KIRI: DAFTAR SISWA (7 Columns) -->
        <div class="lg:col-span-7 bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col h-[700px]">
            <div class="p-5 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/30 flex justify-between items-center rounded-t-3xl">
                <div>
                    <h3 class="font-lexend font-bold text-slate-800 dark:text-white flex items-center gap-2">
                        <i data-lucide="users" class="w-5 h-5 text-emerald-500"></i>
                        Daftar Siswa
                    </h3>
                    <p class="text-xs text-slate-500 mt-1" x-text="filteredSiswa.length + ' Siswa ditemukan'"></p>
                </div>

                <!-- Quick Sort & Gender -->
                <div class="flex gap-2">
                    <select x-model="filters.gender" class="form-input-siswa !py-1.5 !px-3 !rounded-lg text-xs font-medium w-auto border-none shadow-sm">
                        <option value="">Semua Gender</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    <select x-model="filters.sort" class="form-input-siswa !py-1.5 !px-3 !rounded-lg text-xs font-medium w-auto border-none shadow-sm">
                        <option value="nama_asc">Nama A-Z</option>
                        <option value="nis_asc">NIS A-Z</option>
                    </select>
                </div>
            </div>

            <!-- Bulk Action Header (Muncul Jika Ada yang Dipilih) -->
            <div x-show="selectedSiswa.length > 0" x-transition class="bg-emerald-50 dark:bg-emerald-900/20 px-5 py-3 border-b border-emerald-100 dark:border-emerald-800/50 flex justify-between items-center">
                <span class="text-sm font-bold text-emerald-700 dark:text-emerald-400" x-text="selectedSiswa.length + ' Siswa terpilih'"></span>

                <div class="flex gap-2">
                    <button x-show="filters.status === 'sudah'" @click="openModal('remove')" class="px-3 py-1.5 bg-red-100 text-red-600 hover:bg-red-200 rounded-lg text-xs font-bold transition-colors flex items-center gap-1.5">
                        <i data-lucide="user-minus" class="w-4 h-4"></i> Keluarkan
                    </button>
                    <button @click="openModal('assign')" class="px-3 py-1.5 bg-emerald-600 text-white hover:bg-emerald-700 rounded-lg text-xs font-bold transition-colors flex items-center gap-1.5 shadow-sm shadow-emerald-600/20" :disabled="!selectedRombel" :class="!selectedRombel ? 'opacity-50 cursor-not-allowed' : ''">
                        <i data-lucide="arrow-right-circle" class="w-4 h-4"></i> Tempatkan ke Rombel
                    </button>
                </div>
            </div>

            <!-- List Siswa -->
            <div class="flex-1 overflow-y-auto custom-scrollbar p-2">
                <div class="space-y-1">
                    <!-- Select All Checkbox -->
                    <label x-show="filteredSiswa.length > 0" class="flex items-center gap-3 px-4 py-2 hover:bg-slate-50 dark:hover:bg-slate-800/30 rounded-xl cursor-pointer select-none">
                        <input type="checkbox" @change="toggleAll($event)" :checked="selectedSiswa.length === filteredSiswa.length && filteredSiswa.length > 0" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300 dark:border-slate-600 bg-slate-100 dark:bg-slate-700">
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Pilih Semua</span>
                    </label>

                    <template x-for="siswa in filteredSiswa" :key="siswa.id">
                        <label class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50 border border-transparent hover:border-slate-100 dark:hover:border-slate-700 transition-colors cursor-pointer group" :class="selectedSiswa.includes(siswa.id) ? 'bg-emerald-50/50 dark:bg-emerald-900/10 border-emerald-100 dark:border-emerald-800/30' : ''">
                            <div class="flex items-center gap-4">
                                <input type="checkbox" :value="siswa.id" x-model="selectedSiswa" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300 dark:border-slate-600 bg-slate-100 dark:bg-slate-700 ml-1 mt-0.5">

                                <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 border-2" :class="siswa.jk === 'L' ? 'bg-blue-50 border-blue-100 text-blue-600 dark:bg-blue-900/30 dark:border-blue-800' : 'bg-pink-50 border-pink-100 text-pink-600 dark:bg-pink-900/30 dark:border-pink-800'">
                                    <span class="text-sm font-bold" x-text="siswa.nama.charAt(0)"></span>
                                </div>

                                <div>
                                    <p class="font-bold text-sm text-slate-800 dark:text-white group-hover:text-emerald-600 transition-colors" x-text="siswa.nama"></p>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-[10px] font-mono text-slate-500" x-text="'NIS: ' + siswa.nis"></span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                        <span class="text-[10px] font-bold" :class="siswa.jk === 'L' ? 'text-blue-500' : 'text-pink-500'" x-text="siswa.jk === 'L' ? 'Laki-laki' : 'Perempuan'"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <!-- Status Badge -->
                                <span x-show="siswa.status === 'belum'" class="inline-flex items-center px-2 py-0.5 rounded-md bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-[10px] font-bold">
                                    Belum
                                </span>
                                <div x-show="siswa.status === 'sudah'" class="flex flex-col items-end">
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600 dark:text-emerald-400 mb-0.5">
                                        <i data-lucide="check-circle-2" class="w-3 h-3"></i>
                                        Rombel
                                    </span>
                                    <span class="text-xs font-black bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded" x-text="getRombelName(siswa.rombel_id)"></span>
                                </div>
                            </div>
                        </label>
                    </template>

                    <!-- Empty State Siswa -->
                    <div x-show="filteredSiswa.length === 0" class="flex flex-col items-center justify-center py-16 text-slate-400">
                        <i data-lucide="user-search" class="w-12 h-12 mb-3 opacity-50"></i>
                        <p class="text-sm font-medium">Tidak ada siswa sesuai filter.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- PANEL KANAN: ROMBEL TUJUAN (5 Columns) -->
        <div class="lg:col-span-5 bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col h-[700px]">
            <div class="p-5 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/30 rounded-t-3xl">
                <h3 class="font-lexend font-bold text-slate-800 dark:text-white flex items-center gap-2">
                    <i data-lucide="layers" class="w-5 h-5 text-blue-500"></i>
                    Pilih Rombel Tujuan
                </h3>
                <p class="text-xs text-slate-500 mt-1">Klik rombel di bawah untuk menempatkan siswa.</p>
            </div>

            <!-- List Rombel -->
            <div class="flex-1 overflow-y-auto custom-scrollbar p-4 space-y-4">

                <div x-show="filteredRombels.length === 0" class="text-center py-8">
                    <p class="text-xs font-bold text-amber-600 bg-amber-50 rounded-lg p-3">Tidak ada rombel untuk tingkat ini.</p>
                </div>

                <template x-for="rombel in filteredRombels" :key="rombel.id">
                    <!-- Rombel Card -->
                    <div @click="selectedRombel = rombel.id" class="relative rounded-2xl p-5 border-2 transition-all cursor-pointer group" :class="selectedRombel === rombel.id ? 'border-emerald-500 bg-emerald-50/30 dark:bg-emerald-900/10 shadow-md shadow-emerald-500/10' : 'border-slate-100 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-600 bg-white dark:bg-slate-900'">

                        <!-- Selected Indicator -->
                        <div x-show="selectedRombel === rombel.id" class="absolute -top-3 -right-3 w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center text-white shadow-lg animate-bounce">
                            <i data-lucide="check" class="w-4 h-4"></i>
                        </div>

                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-lexend font-black text-xl" x-text="rombel.nama"></div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Wali Kelas</p>
                                    <p class="text-sm font-bold text-slate-800 dark:text-white leading-tight" x-text="rombel.wali || 'Belum Diatur'"></p>
                                </div>
                            </div>

                            <!-- Status Penuh & Detail Button -->
                            <div class="flex flex-col items-end gap-2">
                                <span x-show="rombel.terisi >= rombel.kapasitas" class="px-2 py-1 rounded bg-red-100 text-red-600 text-[9px] font-black uppercase tracking-widest">Penuh</span>
                                <button @click.stop="openDetail(rombel)" class="p-2 bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 rounded-lg transition-all tooltip-trigger" title="Liat Daftar Siswa">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Progress Kapasitas -->
                        <div class="space-y-1.5 mt-2">
                            <div class="flex justify-between items-end">
                                <span class="text-xs font-bold" :class="getCapacityColor(rombel.terisi, rombel.kapasitas)" x-text="rombel.terisi + ' dari ' + rombel.kapasitas + ' Siswa'"></span>
                                <span class="text-[10px] text-slate-500 font-medium" x-text="Math.round((rombel.terisi / rombel.kapasitas) * 100) + '%'"></span>
                            </div>
                            <div class="w-full h-2 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-500"
                                    :class="getCapacityBarColor(rombel.terisi, rombel.kapasitas)"
                                    :style="`width: ${(rombel.terisi / rombel.kapasitas) * 100}%`"></div>
                            </div>

                            <!-- Simulasi penambahan jika dipilih -->
                            <p x-show="selectedRombel === rombel.id && selectedSiswa.length > 0 && filters.status === 'belum'" class="text-[10px] text-emerald-600 font-medium mt-1 animate-pulse">
                                +<span x-text="selectedSiswa.length"></span> siswa akan ditambahkan
                            </p>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Sticky Action Button if Rombel Selected -->
            <div x-show="selectedRombel && selectedSiswa.length > 0 && filters.status === 'belum'" x-transition class="p-4 border-t border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 rounded-b-3xl">
                <button @click="openModal('assign')" class="w-full btn-next-siswa justify-center !py-3 shadow-lg shadow-emerald-600/20">
                    Masukan <span x-text="selectedSiswa.length"></span> Siswa ke Rombel <span x-text="getRombelName(selectedRombel)"></span>
                </button>
            </div>

        </div>
    </div>

    <!-- 5. Modal Konfirmasi -->
    <div x-show="activeModal" style="display: none;">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 transition-opacity" @click="closeModal()"></div>

        <!-- Modal Content -->
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 pointer-events-none">
            <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl w-full max-w-sm pointer-events-auto flex flex-col animate-modal border border-slate-100 dark:border-slate-800 text-center p-8">

                <!-- Icon -->
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" :class="modalType === 'assign' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600'">
                    <i :data-lucide="modalType === 'assign' ? 'arrow-right-circle' : 'user-minus'" class="w-8 h-8"></i>
                </div>

                <h3 class="font-lexend font-bold text-xl text-slate-800 dark:text-white mb-2" x-text="modalType === 'assign' ? 'Konfirmasi Penempatan' : 'Keluarkan Siswa'"></h3>

                <p class="text-sm text-slate-500 mb-6">
                    <span x-show="modalType === 'assign'">Anda akan menempatkan <strong class="text-slate-800 dark:text-white" x-text="selectedSiswa.length"></strong> siswa ke rombel <strong class="text-emerald-600" x-text="getRombelName(selectedRombel)"></strong>. Lanjutkan?</span>
                    <span x-show="modalType === 'remove'">Anda akan mengeluarkan <strong class="text-red-500" x-text="selectedSiswa.length"></strong> siswa dari rombel mereka saat ini. Status mereka akan kembali 'Belum Ditempatkan'.</span>
                </p>

                <div class="flex gap-3 w-full">
                    <button @click="closeModal()" class="flex-1 px-4 py-2.5 rounded-xl text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition-colors">Batal</button>
                    <button @click="confirmAction()" class="flex-1 px-4 py-2.5 rounded-xl text-sm font-bold text-white transition-colors shadow-sm active:scale-95" :class="modalType === 'assign' ? 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-600/20' : 'bg-red-600 hover:bg-red-700 shadow-red-600/20'">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 6. Modal Detail Rombel (List Siswa) -->
    <div x-show="showDetail" style="display: none;" class="fixed inset-0 z-[60]">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click="closeDetail()"></div>

        <!-- Modal Content -->
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-2xl w-full max-w-3xl max-h-[85vh] flex flex-col overflow-hidden border border-slate-100 dark:border-slate-800 animate-modal">

                <!-- Modal Header -->
                <div class="p-8 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/30">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-600/20">
                            <i data-lucide="users" class="w-7 h-7"></i>
                        </div>
                        <div>
                            <h3 class="font-lexend font-bold text-2xl text-slate-800 dark:text-white" x-text="'Daftar Siswa ' + (detailData ? detailData.nama : '')"></h3>
                            <p class="text-xs text-slate-500 font-medium mt-1" x-text="'Wali Kelas: ' + (detailData ? detailData.wali : '-')"></p>
                        </div>
                    </div>
                    <button @click="closeDetail()" class="p-3 bg-white dark:bg-slate-800 hover:bg-red-50 dark:hover:bg-red-900/20 text-slate-400 hover:text-red-500 rounded-2xl transition-all border border-slate-100 dark:border-slate-700">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="flex-1 overflow-hidden flex flex-col p-8 gap-6">

                    <!-- Stats & Search -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        <div class="space-y-2">
                            <div class="flex justify-between items-end">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Okupansi Kelas</span>
                                <span class="text-sm font-black text-emerald-600" x-text="(detailData ? detailData.terisi : 0) + ' / ' + (detailData ? detailData.kapasitas : 0)"></span>
                            </div>
                            <div class="w-full h-2.5 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full transition-all duration-700" :style="`width: ${detailData ? (detailData.terisi / detailData.kapasitas * 100) : 0}%`"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input type="text" x-model="detailSearch" placeholder="Cari nama atau NIS..." class="form-input-siswa pl-11 w-full !py-2.5 !rounded-xl">
                        </div>
                    </div>

                    <!-- Student List Table -->
                    <div class="flex-1 border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden flex flex-col">
                        <div class="overflow-y-auto custom-scrollbar flex-1">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50 dark:bg-slate-800/50 sticky top-0 z-10">
                                    <tr>
                                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Siswa</th>
                                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Gender</th>
                                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                                    <template x-for="s in filteredDetailSiswa" :key="s.id">
                                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-xs" :class="s.jenis_kelamin === 'L' ? 'bg-blue-100 text-blue-600' : 'bg-pink-100 text-pink-600'" x-text="s.nama.charAt(0)"></div>
                                                    <div>
                                                        <p class="text-sm font-bold text-slate-800 dark:text-white" x-text="s.nama"></p>
                                                        <p class="text-[10px] text-slate-400 font-mono" x-text="s.nis"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span class="text-xs font-bold" :class="s.jenis_kelamin === 'L' ? 'text-blue-500' : 'text-pink-500'" x-text="s.jenis_kelamin"></span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <button @click="removeFromRombel(s.id)" class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all">
                                                    <i data-lucide="user-minus" class="w-4 h-4"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr x-show="filteredDetailSiswa.length === 0">
                                        <td colspan="3" class="px-6 py-12 text-center text-slate-400">
                                            <i data-lucide="user-x" class="w-10 h-10 mx-auto mb-2 opacity-20"></i>
                                            <p class="text-sm font-medium">Tidak ada siswa ditemukan.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="p-6 bg-slate-50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                    <button @click="closeDetail()" class="px-6 py-2.5 bg-slate-800 dark:bg-slate-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-slate-900/20 hover:-translate-y-0.5 transition-all active:scale-95">Tutup Detail</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('penempatanPanel', () => ({
            filters: {
                tingkat: 1,
                status: 'belum',
                search: '',
                gender: '',
                sort: 'nama_asc'
            },

            selectedSiswa: [],
            selectedRombel: null,

            activeModal: false,
            modalType: 'assign', // 'assign' | 'remove'
            toasts: [],
            toastCounter: 0,

            // Modal Detail Logic
            showDetail: false,
            detailData: null,
            detailSearch: '',
            detailSiswaList: [],

            // Data Master from DB
            rombels: @json($rombels),
            siswa: @json($siswas),

            init() {
                // Initialize capacity counts based on students explicitly
                this.recalculateCapacity();

                // Reset selections when filters change
                this.$watch('filters.tingkat', () => {
                    this.selectedSiswa = [];
                    this.selectedRombel = null;
                });
                this.$watch('filters.status', () => {
                    this.selectedSiswa = [];
                });
            },

            // Getters / Computed
            get filteredDetailSiswa() {
                if (!this.detailSiswaList) return [];
                return this.detailSiswaList.filter(s => {
                    return s.nama.toLowerCase().includes(this.detailSearch.toLowerCase()) ||
                        (s.nis && s.nis.includes(this.detailSearch));
                });
            },

            get filteredSiswa() {
                return this.siswa.filter(s => {
                    const matchTingkat = s.tingkat == this.filters.tingkat;
                    const matchStatus = s.status === this.filters.status;
                    const matchGender = this.filters.gender === '' || s.jk === this.filters.gender;
                    const matchSearch = s.nama.toLowerCase().includes(this.filters.search.toLowerCase()) || s.nis.includes(this.filters.search);
                    return matchTingkat && matchStatus && matchGender && matchSearch;
                }).sort((a, b) => {
                    if (this.filters.sort === 'nama_asc') return a.nama.localeCompare(b.nama);
                    if (this.filters.sort === 'nis_asc') return a.nis.localeCompare(b.nis);
                    return 0;
                });
            },

            get filteredRombels() {
                return this.rombels.filter(r => r.tingkat == this.filters.tingkat);
            },

            // Helpers UI
            getRombelName(id) {
                const r = this.rombels.find(x => x.id === id);
                return r ? r.nama : '-';
            },

            getCapacityColor(terisi, kapasitas) {
                const rasio = terisi / kapasitas;
                if (rasio >= 1) return 'text-red-600 dark:text-red-400';
                if (rasio >= 0.8) return 'text-amber-600 dark:text-amber-400';
                return 'text-slate-800 dark:text-slate-200';
            },

            getCapacityBarColor(terisi, kapasitas) {
                const rasio = terisi / kapasitas;
                if (rasio >= 1) return 'bg-red-500';
                if (rasio >= 0.8) return 'bg-amber-500';
                return 'bg-emerald-500';
            },

            recalculateCapacity() {
                this.rombels.forEach(r => {
                    r.terisi = this.siswa.filter(s => s.rombel_id === r.id).length;
                });
            },

            // Actions
            toggleAll(e) {
                if (e.target.checked) {
                    this.selectedSiswa = this.filteredSiswa.map(s => s.id);
                } else {
                    this.selectedSiswa = [];
                }
            },

            openModal(type) {
                if (this.selectedSiswa.length === 0) return;

                if (type === 'assign') {
                    if (!this.selectedRombel) {
                        this.showToast('Gagal', 'Pilih rombel tujuan terlebih dahulu.', 'error');
                        return;
                    }
                    // Validate Capacity
                    const rombel = this.rombels.find(r => r.id === this.selectedRombel);
                    if (rombel.terisi + this.selectedSiswa.length > rombel.kapasitas) {
                        this.showToast('Kapasitas Penuh', `Kapasitas rombel ${rombel.nama} tidak mencukupi untuk menampung ${this.selectedSiswa.length} siswa tambahan.`, 'error');
                        return;
                    }
                }

                this.modalType = type;
                this.activeModal = true;
            },

            closeModal() {
                this.activeModal = false;
            },

            openDetail(rombel) {
                this.detailData = rombel;
                this.detailSearch = '';
                this.detailSiswaList = [];
                this.showDetail = true;

                fetch(`/operator/kelas/${rombel.id}/siswa`)
                    .then(res => res.json())
                    .then(data => {
                        this.detailSiswaList = data;
                        this.$nextTick(() => lucide.createIcons());
                    })
                    .catch(err => {
                        console.error(err);
                        this.showToast('Gagal', 'Gagal memuat daftar siswa.', 'error');
                    });
            },

            closeDetail() {
                this.showDetail = false;
                this.detailData = null;
            },

            removeFromRombel(siswaId) {
                if (!confirm('Keluarkan siswa ini dari rombel?')) return;

                this.selectedSiswa = [siswaId];
                this.modalType = 'remove';
                this.confirmAction();

                // Also remove locally from detail list immediately
                this.detailSiswaList = this.detailSiswaList.filter(s => s.id !== siswaId);
            },

            confirmAction() {
                const kelas_id = this.modalType === 'assign' ? this.selectedRombel : null;

                fetch('{{ route("operator.penempatanSiswa.update") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                siswa_ids: this.selectedSiswa,
                                kelas_id: kelas_id
                            })
                        })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Update local state to reflect DB changes
                            this.selectedSiswa.forEach(id => {
                                const s = this.siswa.find(x => x.id === id);
                                if (s) {
                                    s.status = kelas_id ? 'sudah' : 'belum';
                                    s.rombel_id = kelas_id;
                                }
                            });
                            this.showToast('Berhasil', data.message, 'success');
                            this.recalculateCapacity();
                            this.selectedSiswa = [];
                            this.closeModal();

                            // Auto Reload to sync all counts and views
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);

                            setTimeout(() => lucide.createIcons(), 50);
                        } else {
                            this.showToast('Gagal', 'Terjadi kesalahan saat menyimpan data.', 'error');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        this.showToast('Gagal', 'Gagal terhubung ke server.', 'error');
                    });
            },

            // Bonus: Auto Assign
            autoAssign() {
                if (this.filters.status !== 'belum') {
                    this.filters.status = 'belum'; // Switch view first
                }

                const unassigned = this.siswa.filter(s => s.status === 'belum' && s.tingkat == this.filters.tingkat);
                const targetRombels = this.rombels.filter(r => r.tingkat == this.filters.tingkat);

                if (unassigned.length === 0) {
                    this.showToast('Info', 'Tidak ada siswa yang perlu ditempatkan di tingkat ini.', 'success');
                    return;
                }
                if (targetRombels.length === 0) {
                    this.showToast('Gagal', 'Tidak ada rombel tersedia di tingkat ini.', 'error');
                    return;
                }

                if (!confirm(`Bagi rata ${unassigned.length} siswa belum ditempatkan ke dalam ${targetRombels.length} rombel?`)) return;

                let rombelIndex = 0;
                let successCount = 0;

                unassigned.forEach(s => {
                    // Find a rombel that is not full
                    let loopCount = 0;
                    while (targetRombels[rombelIndex].terisi >= targetRombels[rombelIndex].kapasitas && loopCount < targetRombels.length) {
                        rombelIndex = (rombelIndex + 1) % targetRombels.length;
                        loopCount++;
                    }

                    const currentRombel = targetRombels[rombelIndex];
                    if (currentRombel.terisi < currentRombel.kapasitas) {
                        this.selectedSiswa.push(s.id);
                        successCount++;
                        currentRombel.terisi++;
                    }
                    rombelIndex = (rombelIndex + 1) % targetRombels.length;
                });

                if (this.selectedSiswa.length > 0) {
                    this.modalType = 'assign';
                    this.confirmAction();
                }
            },

            // Toast System
            showToast(title, message, type) {
                const id = ++this.toastCounter;
                this.toasts.push({
                    id,
                    title,
                    message,
                    type
                });
                setTimeout(() => {
                    this.toasts = this.toasts.filter(t => t.id !== id);
                }, 4000);
            }
        }));
    });
</script>
@endpush
@endsection