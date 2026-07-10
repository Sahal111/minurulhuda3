        {{-- MODAL IMPORT EXCEL / ZIP --}}
        <div id="importModal" class="fixed inset-0 z-[75] hidden overflow-y-auto bg-slate-900/80 backdrop-blur-md">
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative w-full max-w-xl bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden animate-up">

                    {{-- Header --}}
                    <div class="px-8 pt-8 pb-0 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tighter">
                                Import <span class="text-blue-600">Data Siswa</span>
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
                                    <p class="font-bold">Import data siswa tanpa foto.</p>
                                    <p>Foto akan ditampilkan sebagai avatar otomatis dari inisial nama. Foto dapat
                                        diperbarui kapan saja via tombol edit.</p>
                                    <a href="{{ route('operator.dataSiswa.template') }}"
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

                                {{-- Struktur folder bergaya tree --}}
                                <div
                                    class="bg-white dark:bg-slate-950 rounded-xl border border-purple-100 p-4 font-mono text-xs text-slate-600 dark:text-slate-400 space-y-1 leading-relaxed">
                                    <p>📦 <span class="text-slate-800 dark:text-white font-bold">import_siswa.zip</span>
                                    </p>
                                    <p class="pl-5">├── 📄 <span
                                            class="text-emerald-600 font-bold">data_siswa.xlsx</span></p>
                                    <p class="pl-5">└── 📁 <span class="text-blue-600 font-bold">foto/</span></p>
                                    <p class="pl-12 text-slate-400">├── 🖼 <span
                                            class="text-amber-600">0012345678.jpg</span> <span class="text-slate-300">←
                                            NISN</span></p>
                                    <p class="pl-12 text-slate-400">├── 🖼 <span
                                            class="text-amber-600">0012345679.jpg</span></p>
                                    <p class="pl-12 text-slate-400">└── 🖼 <span
                                            class="text-amber-600">0012345680.jpg</span></p>
                                </div>

                                <div class="grid grid-cols-1 gap-2 text-xs text-purple-700">
                                    <div class="flex items-start gap-2">
                                        <span
                                            class="w-4 h-4 rounded-full bg-purple-200 text-purple-700 flex items-center justify-center font-black text-[9px] shrink-0 mt-0.5">1</span>
                                        <p>Nama file foto = <strong>NISN siswa</strong> (mis. <code
                                                class="bg-purple-100 px-1 rounded">0012345678.jpg</code>)</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span
                                            class="w-4 h-4 rounded-full bg-purple-200 text-purple-700 flex items-center justify-center font-black text-[9px] shrink-0 mt-0.5">2</span>
                                        <p>Format foto yang didukung: <strong>JPG, JPEG, PNG, WEBP</strong></p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span
                                            class="w-4 h-4 rounded-full bg-purple-200 text-purple-700 flex items-center justify-center font-black text-[9px] shrink-0 mt-0.5">3</span>
                                        <p>Siswa tanpa foto cocok → otomatis pakai <strong>avatar dari nama</strong></p>
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
                        <form action="{{ route('operator.dataSiswa.import') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- Drop zone --}}
                            <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl p-8 flex flex-col items-center gap-3 hover:border-blue-400 dark:hover:border-blue-500 transition-colors relative"
                                :class="importMode === 'zip' ? 'hover:border-purple-400 dark:hover:border-purple-500' : ''"
                                @dragover.prevent @drop.prevent="handleDropImport($event)">

                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center"
                                    :class="importMode === 'zip' ? 'bg-purple-50 dark:bg-purple-900/20' :
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
                                    <input type="file" name="file_import" id="fileImportInput"
                                        :accept="importMode === 'zip' ? '.zip' : '.xlsx,.xls,.csv'" class="hidden"
                                        @change="setImportFile($event)">
                                </label>

                                {{-- Nama file terpilih --}}
                                <div x-show="importFileName" x-transition
                                    class="flex items-center gap-2 px-3 py-2 bg-emerald-50 border border-emerald-200 rounded-xl">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                                    <p x-text="importFileName"
                                        class="text-xs text-emerald-700 font-bold truncate max-w-xs"></p>
                                </div>
                            </div>

                            {{-- Tombol aksi --}}
                            <div class="flex justify-end mt-5 gap-3">
                                <button type="button" @click="closeImportModal()"
                                    class="px-5 py-3 text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-all">
                                    Batal
                                </button>
                                <button type="submit" :disabled="!importFileName"
                                    :class="!importFileName ? 'opacity-40 cursor-not-allowed' : 'hover:opacity-90'"
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
