@extends('layouts.operator')
@section('content')
    <div x-data="importPanel()" class="p-6 lg:p-10 space-y-10 animate-up max-w-6xl mx-auto w-full">

            <div class="grid lg:grid-cols-5 gap-8">
                <!-- Left: Upload Section -->
                <div class="lg:col-span-3 space-y-6">
                    <div class="glass-card p-8 rounded-[3rem] shadow-xl relative overflow-hidden">
                        <div class="flex justify-between items-start mb-8">
                            <div>
                                <h3 class="font-lexend font-black text-xl text-slate-900 dark:text-white">Upload Data
                                    Pendaftar</h3>
                                <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-wider">Format: .XLSX,
                                    .CSV (Maks. 10MB)</p>
                            </div>
                            <button
                                class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400 font-black text-[10px] uppercase tracking-widest hover:underline">
                                <i data-lucide="download-cloud" class="w-4 h-4"></i> Download Template
                            </button>
                        </div>

                        <!-- Drag and Drop Zone -->
                        <div x-ref="dropZone"
                            @click="$refs.fileInput.click()"
                            @dragover.prevent="isDragging = true"
                            @dragleave.prevent="isDragging = false"
                            @drop.prevent="isDragging = false; handleFile($event.dataTransfer.files[0])"
                            :class="isDragging ? 'border-emerald-500 bg-emerald-50/30' : ''"
                            class="border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-[2rem] p-12 flex flex-col items-center justify-center text-center transition-all cursor-pointer group hover:border-emerald-500/50">
                            <input type="file" x-ref="fileInput" class="hidden" accept=".xlsx, .csv" @change="handleFile($event.target.files[0])">
                            <div
                                class="w-20 h-20 bg-emerald-500/10 text-emerald-600 rounded-[1.5rem] flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i data-lucide="upload-cloud" class="w-10 h-10"></i>
                            </div>
                            <p class="font-bold text-slate-700 dark:text-slate-200">Klik atau seret file ke sini</p>
                            <p class="text-xs text-slate-400 mt-2">Pastikan data sesuai dengan kolom pada template
                                pendaftaran.</p>
                        </div>

                        <!-- Upload Progress (Hidden by default) -->
                        <div x-show="showProgress" x-transition class="mt-8 space-y-3">
                            <div class="flex justify-between items-end">
                                <div class="flex items-center gap-3">
                                    <i data-lucide="file-spreadsheet" class="w-5 h-5 text-emerald-500"></i>
                                    <span x-text="fileName"
                                        class="text-xs font-black text-slate-700 dark:text-slate-300"></span>
                                </div>
                                <span x-text="progress + '%'"
                                    class="text-xs font-black text-emerald-600 uppercase tracking-widest"></span>
                            </div>
                            <div class="h-3 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 transition-all duration-300"
                                    :style="'width:' + progress + '%'"></div>
                            </div>
                        </div>

                        <div x-show="showError" x-transition
                            class="mt-8 hidden p-6 bg-rose-50 dark:bg-rose-500/10 border border-rose-100 dark:border-rose-500/20 rounded-3xl">
                            <div class="flex items-center gap-3 text-rose-600 mb-3">
                                <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                                <span class="text-xs font-black uppercase tracking-widest">Error Ditemukan (3
                                    Baris)</span>
                            </div>
                            <ul class="text-[10px] font-bold text-rose-500/80 space-y-1 list-disc ml-5">
                                <li>Baris 12: Format tanggal lahir tidak valid.</li>
                                <li>Baris 45: NISN harus berupa angka 10 digit.</li>
                                <li>Baris 102: Kolom Alamat tidak boleh kosong.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Export Selection -->
                    <div class="glass-card p-8 rounded-[3rem] shadow-xl">
                        <h3 class="font-lexend font-black text-xl text-slate-900 dark:text-white mb-6">Export Laporan
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div
                                class="p-6 bg-slate-50 dark:bg-slate-900/50 rounded-3xl border border-transparent hover:border-emerald-500/30 transition-all cursor-pointer group">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-white dark:bg-slate-800 shadow-sm rounded-2xl flex items-center justify-center text-emerald-600">
                                        <i data-lucide="users"></i>
                                    </div>
                                    <div>
                                        <p
                                            class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tighter">
                                            Data Pendaftar</p>
                                        <p class="text-[10px] font-bold text-slate-400 italic">Format: .xlsx (Excel)
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="p-6 bg-slate-50 dark:bg-slate-900/50 rounded-3xl border border-transparent hover:border-blue-500/30 transition-all cursor-pointer group">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-white dark:bg-slate-800 shadow-sm rounded-2xl flex items-center justify-center text-blue-600">
                                        <i data-lucide="credit-card"></i>
                                    </div>
                                    <div>
                                        <p
                                            class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tighter">
                                            Laporan Keuangan</p>
                                        <p class="text-[10px] font-bold text-slate-400 italic">Format: .pdf (Document)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: History Section -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="glass-card p-8 rounded-[3rem] shadow-xl flex flex-col h-full">
                        <h3 class="font-lexend font-black text-xl text-slate-900 dark:text-white mb-8">Riwayat
                            Aktivitas</h3>

                        <div class="space-y-8 flex-1">
                            <!-- History Item 1 -->
                            <div class="relative pl-8 border-l-2 border-emerald-500/30">
                                <div
                                    class="absolute -left-[9px] top-0 w-4 h-4 bg-emerald-500 rounded-full ring-4 ring-emerald-500/20">
                                </div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">12
                                    Feb, 14:20</p>
                                <p class="text-sm font-black text-slate-800 dark:text-white">Import 124 Siswa Baru</p>
                                <p
                                    class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400 mt-1 flex items-center gap-1">
                                    <i data-lucide="check" class="w-3 h-3"></i> Berhasil diimpor oleh Admin
                                </p>
                            </div>

                            <!-- History Item 2 -->
                            <div class="relative pl-8 border-l-2 border-slate-200 dark:border-slate-800">
                                <div class="absolute -left-[9px] top-0 w-4 h-4 bg-slate-300 dark:bg-slate-700 rounded-full">
                                </div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">10
                                    Feb, 09:15</p>
                                <p class="text-sm font-black text-slate-800 dark:text-white">Export Data Gelombang 1
                                </p>
                                <p class="text-[10px] font-bold text-slate-400 mt-1">Laporan PDF Terunduh</p>
                            </div>

                            <!-- History Item 3 -->
                            <div class="relative pl-8 border-l-2 border-rose-500/30">
                                <div
                                    class="absolute -left-[9px] top-0 w-4 h-4 bg-rose-500 rounded-full ring-4 ring-rose-500/20">
                                </div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">08
                                    Feb, 16:45</p>
                                <p class="text-sm font-black text-slate-800 dark:text-white">Gagal Import: Format Salah
                                </p>
                                <p class="text-[10px] font-bold text-rose-500 mt-1 italic underline cursor-pointer">
                                    Lihat Detail Error</p>
                            </div>
                        </div>

                        <button
                            class="mt-12 w-full py-4 bg-slate-100 dark:bg-slate-800 rounded-2xl text-[10px] font-black text-slate-500 uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">Lihat
                            Semua Riwayat</button>
                    </div>
                </div>
            </div>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('importPanel', () => ({
                isDragging: false,
                showProgress: false,
                showError: false,
                progress: 0,
                fileName: '',
                handleFile(file) {
                    if (!file) return;
                    this.fileName = file.name;
                    this.showProgress = true;
                    this.showError = false;
                    this.progress = 0;

                    const interval = setInterval(() => {
                        this.progress += Math.floor(Math.random() * 15) + 5;
                        if (this.progress >= 100) {
                            this.progress = 100;
                            clearInterval(interval);
                            if (file.name.toLowerCase().includes('error')) {
                                this.showError = true;
                            }
                            this.$nextTick(() => lucide.createIcons());
                        }
                    }, 200);
                }
            }));
        });
    </script>
    @endpush
@endsection
