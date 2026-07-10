{{-- resources/views/operator/partials/_modalDokumenGuru.blade.php --}}
{{-- Dipanggil via: @include('operator.partials._modalDokumenGuru') --}}
{{-- Dibuka via JS: openDokumenModal(guru) --}}

<div id="modalDokumenGuru"
    x-data="dokumenPanel()"
    class="fixed inset-0 z-[80] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm overflow-y-auto transition-all duration-300">

    {{-- Main Modal Container --}}
    <div class="relative w-full max-w-5xl mx-auto my-4 bg-white dark:bg-slate-900 rounded-[2rem] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] overflow-hidden flex flex-col max-h-[95vh] border border-slate-100 dark:border-slate-800">

        {{-- ===== HEADER ===== --}}
        <div class="flex items-center justify-between px-8 py-6 border-b border-slate-100/80 dark:border-slate-800 shrink-0 bg-white/50 backdrop-blur-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-700 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-700/20">
                    <i data-lucide="folder-open" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white tracking-tight">
                        Berkas & Dokumen
                    </h3>
                    <p id="dokumenGuruNama" class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-widest mt-1">—</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                {{-- Stats badges --}}
                <div id="dokumenStatBadges" class="hidden sm:flex items-center gap-2">
                    <span id="badgeTotalDokumen"
                        class="px-4 py-1.5 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 text-slate-600 dark:text-slate-300 rounded-full text-[11px] font-bold uppercase tracking-wider">
                        0 Dokumen
                    </span>
                    <span id="badgeExpired"
                        class="hidden px-4 py-1.5 bg-rose-50 border border-rose-100 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 rounded-full text-[11px] font-bold uppercase tracking-wider">
                        0 Expired
                    </span>
                </div>
                <div class="h-8 w-px bg-slate-200 dark:bg-slate-700 hidden sm:block mx-1"></div>
                <button @click="closeDokumenModal()"
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-all duration-200">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        {{-- ===== BODY ===== --}}
        <div class="flex flex-col lg:flex-row flex-1 min-h-0 overflow-hidden bg-slate-50/30 dark:bg-slate-900/50">

            {{-- ── PANEL KIRI: Upload Form ── --}}
            <div class="w-full lg:w-[360px] shrink-0 border-b lg:border-b-0 lg:border-r border-slate-100 dark:border-slate-800 overflow-y-auto bg-white dark:bg-slate-900/80">
                <div class="p-6 space-y-5">
                    <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                        <div class="w-6 h-6 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center">
                            <i data-lucide="cloud-upload" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                        </div>
                        <p class="text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">
                            Upload Dokumen Baru
                        </p>
                    </div>

                    <form id="formUploadDokumen" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">

                            {{-- Kategori --}}
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-semibold text-slate-500">Kategori Dokumen <span class="text-rose-500">*</span></label>
                                <select name="kategori" id="selectKategoriDokumen" 
                                    class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none" required
                                    x-model="selectedKategori">
                                    <option value="">— Pilih Kategori —</option>
                                    <optgroup label="📋 Identitas Diri">
                                        <option value="ktp">KTP</option>
                                        <option value="kk">Kartu Keluarga</option>
                                        <option value="akta_lahir">Akta Kelahiran</option>
                                        <option value="pas_foto">Pas Foto</option>
                                    </optgroup>
                                    <optgroup label="🏛️ Kepegawaian">
                                        <option value="sk_pengangkatan">SK Pengangkatan</option>
                                        <option value="sk_cpns">SK CPNS</option>
                                        <option value="sk_pns">SK PNS</option>
                                        <option value="sk_pppk">SK PPPK</option>
                                        <option value="sk_jabatan">SK Jabatan</option>
                                        <option value="sk_berkala">SK Kenaikan Berkala</option>
                                        <option value="sk_golongan">SK Kenaikan Golongan</option>
                                        <option value="sk_mengajar">SK Mengajar</option>
                                        <option value="karpeg">Karpeg</option>
                                        <option value="karis_karsu">Karis/Karsu</option>
                                    </optgroup>
                                    <optgroup label="🎓 Pendidikan">
                                        <option value="ijazah_s1">Ijazah S1</option>
                                        <option value="transkrip_s1">Transkrip S1</option>
                                        <option value="ijazah_s2">Ijazah S2</option>
                                        <option value="transkrip_s2">Transkrip S2</option>
                                        <option value="ijazah_sma">Ijazah SMA/MA</option>
                                    </optgroup>
                                    <optgroup label="🏅 Sertifikasi & Profesi">
                                        <option value="sertifikat_pendidik">Sertifikat Pendidik</option>
                                        <option value="sertifikat_pelatihan">Sertifikat Pelatihan/Diklat</option>
                                        <option value="sertifikat_lainnya">Sertifikat Lainnya</option>
                                        <option value="npwp">NPWP</option>
                                    </optgroup>
                                    <optgroup label="💰 Keuangan">
                                        <option value="buku_rekening">Buku Rekening Bank</option>
                                        <option value="slip_gaji">Slip Gaji</option>
                                    </optgroup>
                                    <optgroup label="👨‍👩‍👧 Keluarga">
                                        <option value="akta_nikah">Akta Nikah / Buku Nikah</option>
                                        <option value="akta_cerai">Akta Cerai</option>
                                        <option value="akta_anak">Akta Kelahiran Anak</option>
                                    </optgroup>
                                    <optgroup label="🏥 Kesehatan">
                                        <option value="surat_sehat">Surat Keterangan Sehat</option>
                                        <option value="bpjs">Kartu BPJS Kesehatan</option>
                                    </optgroup>
                                    <optgroup label="📁 Lainnya">
                                        <option value="lainnya">Dokumen Lainnya</option>
                                    </optgroup>
                                </select>
                            </div>

                            {{-- Nama Dokumen --}}
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-semibold text-slate-500">Nama Dokumen <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama_dokumen" 
                                    class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none"
                                    placeholder="Contoh: SK Pengangkatan 2020" required>
                            </div>

                            {{-- Nomor Dokumen --}}
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-semibold text-slate-500">Nomor Dokumen <span class="font-normal text-slate-400">(opsional)</span></label>
                                <input type="text" name="nomor_dokumen" 
                                    class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none"
                                    placeholder="Nomor SK, Ijazah, dll">
                            </div>

                            {{-- Penerbit --}}
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-semibold text-slate-500">Instansi Penerbit <span class="font-normal text-slate-400">(opsional)</span></label>
                                <input type="text" name="penerbit" 
                                    class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none"
                                    placeholder="Kemenag, Universitas, dll">
                            </div>

                            {{-- Tanggal --}}
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[11px] font-semibold text-slate-500">Tgl Terbit</label>
                                    <input type="text" name="tanggal_dokumen" id="tgl_dokumen"
                                        class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none" placeholder="dd/mm/yyyy">
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[11px] font-semibold text-slate-500">Tgl Berlaku</label>
                                    <input type="text" name="tanggal_berlaku" id="tgl_berlaku"
                                        class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none" placeholder="dd/mm/yyyy">
                                </div>
                            </div>

                            {{-- Kadaluarsa (kondisional untuk dokumen tertentu) --}}
                            <div class="flex flex-col gap-1.5 p-3 bg-amber-50 dark:bg-amber-500/10 rounded-xl border border-amber-100 dark:border-amber-500/20" id="kadaluarsaField"
                                x-show="['bpjs','surat_sehat','sertifikat_pelatihan','sertifikat_lainnya'].includes(selectedKategori)"
                                x-transition>
                                <label class="text-[11px] font-bold text-amber-600 flex items-center gap-1.5">
                                    <i data-lucide="alert-triangle" class="w-3.5 h-3.5"></i>
                                    Tanggal Kadaluarsa
                                </label>
                                <input type="text" name="tanggal_kadaluarsa" id="tgl_kadaluarsa"
                                    class="w-full px-3 py-2.5 bg-white border border-amber-200 rounded-lg text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-400 outline-none" placeholder="dd/mm/yyyy">
                            </div>

                            {{-- Keterangan --}}
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-semibold text-slate-500">Keterangan <span class="font-normal text-slate-400">(opsional)</span></label>
                                <textarea name="keterangan" rows="2" 
                                    class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none resize-none"
                                    placeholder="Keterangan tambahan..."></textarea>
                            </div>

                            {{-- Drop zone upload --}}
                            <div class="group border-2 border-dashed border-slate-200 dark:border-slate-700 bg-slate-50/50 hover:bg-emerald-50/50 rounded-2xl p-6 flex flex-col items-center gap-3 hover:border-emerald-400 transition-all relative"
                                @dragover.prevent @drop.prevent="handleDropDokumen($event)">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <i data-lucide="file-up" class="w-6 h-6 text-emerald-600"></i>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm font-semibold text-slate-600">
                                        Drag & drop file di sini
                                    </p>
                                    <p class="text-[11px] text-slate-400 mt-1">PDF, JPG, PNG (Maks. 10MB)</p>
                                </div>
                                
                                <div class="w-full relative mt-2">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-slate-200"></div>
                                    </div>
                                    <div class="relative flex justify-center text-[10px]">
                                        <span class="bg-slate-50 px-2 text-slate-400 font-medium">ATAU</span>
                                    </div>
                                </div>

                                <label class="w-full py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl text-xs font-bold text-center cursor-pointer hover:bg-slate-50 hover:border-emerald-300 transition-all shadow-sm">
                                    Pilih File Dokumen
                                    <input type="file" name="dokumen" id="inputFileDokumen"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        class="hidden"
                                        @change="setFileDokumen($event)" required>
                                </label>

                                {{-- Selected file indicator --}}
                                <div x-show="fileNameDokumen" x-transition
                                    class="absolute inset-0 bg-white/95 backdrop-blur-sm rounded-2xl border-2 border-emerald-400 flex flex-col items-center justify-center p-4">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center mb-2">
                                        <i data-lucide="check" class="w-5 h-5 text-emerald-600"></i>
                                    </div>
                                    <p class="text-xs font-bold text-slate-700 text-center w-full truncate px-2" x-text="fileNameDokumen"></p>
                                    <button type="button" @click.prevent="clearFile()" class="mt-2 text-[10px] text-rose-500 font-semibold hover:underline">Hapus File</button>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <button type="submit"
                                :disabled="!fileNameDokumen"
                                :class="!fileNameDokumen ? 'opacity-50 cursor-not-allowed bg-slate-400' : 'bg-emerald-700 hover:bg-emerald-800 shadow-lg shadow-emerald-700/20'"
                                class="w-full py-3.5 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition-all flex items-center justify-center gap-2 mt-2">
                                <i data-lucide="save" class="w-4 h-4"></i>
                                Simpan Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── PANEL KANAN: Daftar Dokumen ── --}}
            <div class="flex-1 overflow-y-auto">
                <div class="p-6 md:p-8">

                    {{-- Loading state --}}
                    <div id="dokumenLoading" class="flex items-center justify-center py-20 hidden">
                        <div class="flex flex-col items-center gap-4">
                            <div class="w-10 h-10 border-4 border-emerald-100 border-t-emerald-600 rounded-full animate-spin"></div>
                            <p class="text-sm text-slate-500 font-medium">Memuat data dokumen...</p>
                        </div>
                    </div>

                    {{-- Empty state --}}
                    <div id="dokumenEmpty" class="flex flex-col items-center justify-center py-20 hidden">
                        <div class="w-20 h-20 bg-white shadow-sm border border-slate-100 rounded-full flex items-center justify-center mb-5">
                            <i data-lucide="folder-search" class="w-10 h-10 text-slate-300"></i>
                        </div>
                        <h4 class="text-base font-bold text-slate-700">Belum Ada Dokumen</h4>
                        <p class="text-sm text-slate-400 mt-1 max-w-xs text-center">Silakan unggah dokumen pertama melalui form di sebelah kiri.</p>
                    </div>

                    {{-- Daftar dokumen (rendered dari JS) --}}
                    <div id="dokumenList" class="space-y-8 hidden"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== MODAL PREVIEW DOKUMEN ===== --}}
<div id="modalPreviewDokumen"
    class="fixed inset-0 z-[90] hidden items-center justify-center bg-slate-900/80 backdrop-blur-md">
    <div class="relative w-full max-w-4xl mx-4 bg-white dark:bg-slate-900 rounded-[2rem] overflow-hidden shadow-2xl flex flex-col max-h-[90vh]">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 dark:border-slate-800 shrink-0">
            <p id="previewDokumenNama" class="text-base font-bold text-slate-800 dark:text-white truncate"></p>
            <div class="flex items-center gap-3 shrink-0 ml-4">
                <a id="previewDokumenDownload" href="#" target="_blank"
                    class="px-4 py-2 bg-emerald-50 text-emerald-700 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-emerald-100 transition-all">
                    <i data-lucide="download" class="w-4 h-4"></i> Unduh
                </a>
                <div class="w-px h-6 bg-slate-200"></div>
                <button onclick="document.getElementById('modalPreviewDokumen').classList.add('hidden'); document.getElementById('modalPreviewDokumen').classList.remove('flex');"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-all">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
        <div id="previewDokumenContent" class="flex-1 overflow-auto bg-slate-100 dark:bg-slate-950 flex items-center justify-center min-h-[500px] p-6">
            {{-- Isi diisi JS: iframe untuk PDF, img untuk gambar --}}
        </div>
    </div>
</div>

@push('scripts')
<script>
// ===== Alpine Component: dokumenPanel =====
document.addEventListener('alpine:init', () => {
    Alpine.data('dokumenPanel', () => ({
        selectedKategori: '',
        fileNameDokumen: '',
        currentGuruId: null,
        dokumens: [],

        initDatepickers() {
            const opts = { altInput: true, altFormat: 'd/m/Y', dateFormat: 'Y-m-d', allowInput: true };
            flatpickr('#tgl_dokumen',    opts);
            flatpickr('#tgl_berlaku',    opts);
            flatpickr('#tgl_kadaluarsa', { ...opts, minDate: 'today' });
        },

        openDokumenModal(guru) {
            this.currentGuruId = guru.id;
            document.getElementById('dokumenGuruNama').innerText = guru.nama ?? '—';
            document.getElementById('formUploadDokumen').action =
                `/operator/data-guru/${guru.id}/dokumen`;

            this.resetForm();
            this.loadDokumens(guru.id);

            const modal = document.getElementById('modalDokumenGuru');
            modal.classList.remove('hidden');
            // Sedikit delay untuk efek transisi
            setTimeout(() => modal.classList.add('flex', 'opacity-100'), 10);
            document.body.style.overflow = 'hidden';

            this.$nextTick(() => {
                this.initDatepickers();
                if (typeof lucide !== 'undefined') lucide.createIcons();
            });
        },

        closeDokumenModal() {
            const modal = document.getElementById('modalDokumenGuru');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        },

        resetForm() {
            document.getElementById('formUploadDokumen').reset();
            this.fileNameDokumen = '';
            this.selectedKategori = '';
        },

        setFileDokumen(e) {
            this.fileNameDokumen = e.target.files[0]?.name ?? '';
        },

        clearFile() {
            this.fileNameDokumen = '';
            document.getElementById('inputFileDokumen').value = '';
        },

        handleDropDokumen(e) {
            const file = e.dataTransfer.files[0];
            if (!file) return;
            const input = document.getElementById('inputFileDokumen');
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
            this.fileNameDokumen = file.name;
        },

        async loadDokumens(guruId) {
            document.getElementById('dokumenLoading').classList.remove('hidden');
            document.getElementById('dokumenEmpty').classList.add('hidden');
            document.getElementById('dokumenList').classList.add('hidden');

            try {
                const res = await fetch(`/operator/data-guru/${guruId}/dokumen`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await res.json();

                this.renderDokumens(data);

                // Update badges
                document.getElementById('badgeTotalDokumen').innerText = `${data.total} Dokumen`;
                document.getElementById('dokumenStatBadges').classList.remove('hidden');

                if (data.expired > 0) {
                    const badge = document.getElementById('badgeExpired');
                    badge.innerText = `${data.expired} Expired`;
                    badge.classList.remove('hidden');
                } else {
                     document.getElementById('badgeExpired').classList.add('hidden');
                }
            } catch (e) {
                console.error(e);
            } finally {
                document.getElementById('dokumenLoading').classList.add('hidden');
            }
        },

        renderDokumens(data) {
            const list = document.getElementById('dokumenList');
            const empty = document.getElementById('dokumenEmpty');

            if (data.total === 0) {
                empty.classList.remove('hidden');
                list.classList.add('hidden');
                return;
            }

            empty.classList.add('hidden');
            list.classList.remove('hidden');
            list.innerHTML = '';

            const groupIcons = {
                'Identitas Diri':       'fingerprint',
                'Kepegawaian':          'briefcase',
                'Pendidikan':           'graduation-cap',
                'Sertifikasi & Profesi':'award',
                'Keuangan':             'wallet',
                'Keluarga':             'users',
                'Kesehatan':            'heart-pulse',
                'Lainnya':              'folder',
            };

            const groupColors = {
                'Identitas Diri':       'emerald',
                'Kepegawaian':          'indigo',
                'Pendidikan':           'sky',
                'Sertifikasi & Profesi':'amber',
                'Keuangan':             'teal',
                'Keluarga':             'rose',
                'Kesehatan':            'red',
                'Lainnya':              'slate',
            };

            Object.entries(data.dokumens).forEach(([group, dokumens]) => {
                const color  = groupColors[group] ?? 'slate';
                const icon   = groupIcons[group]  ?? 'folder';
                const section = document.createElement('div');
                section.innerHTML = `
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 rounded-xl bg-${color}-50 dark:bg-${color}-500/10 flex items-center justify-center border border-${color}-100 dark:border-${color}-500/20">
                            <i data-lucide="${icon}" class="w-4 h-4 text-${color}-600 dark:text-${color}-400"></i>
                        </div>
                        <h5 class="text-sm font-bold text-slate-700 dark:text-slate-200 tracking-tight">${group}</h5>
                        <div class="h-px flex-1 bg-slate-100 dark:bg-slate-800 ml-2"></div>
                        <span class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-500">${dokumens.length}</span>
                    </div>
                    <div class="grid grid-cols-1 gap-3">
                        ${dokumens.map(d => this.renderDokumenCard(d)).join('')}
                    </div>
                `;
                list.appendChild(section);
            });

            this.$nextTick(() => {
                if (typeof lucide !== 'undefined') lucide.createIcons();
            });
        },

        renderDokumenCard(d) {
            const isExpired  = d.is_expired;
            const isExpiring = d.is_expiring_soon;
            const isPdf      = d.file_type === 'pdf';

            const statusBadge = isExpired
                ? `<span class="px-2 py-1 bg-rose-50 text-rose-600 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-rose-100">Expired</span>`
                : isExpiring
                    ? `<span class="px-2 py-1 bg-amber-50 text-amber-600 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-amber-100">Segera Expired</span>`
                    : d.is_verified
                        ? `<span class="px-2 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-emerald-100 flex items-center gap-1"><i data-lucide="check-circle-2" class="w-3 h-3"></i>Verified</span>`
                        : '';

            const fileIcon = isPdf
                ? `<div class="w-12 h-12 bg-rose-50 dark:bg-rose-500/10 rounded-2xl flex items-center justify-center shrink-0 border border-rose-100"><i data-lucide="file-text" class="w-6 h-6 text-rose-500"></i></div>`
                : `<div class="w-12 h-12 bg-sky-50 dark:bg-sky-500/10 rounded-2xl flex items-center justify-center shrink-0 border border-sky-100"><i data-lucide="image" class="w-6 h-6 text-sky-500"></i></div>`;

            return `
                <div class="group relative flex items-start gap-4 p-4 bg-white dark:bg-slate-800/50 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-emerald-300 dark:hover:border-emerald-500/30 hover:shadow-lg hover:shadow-emerald-900/5 transition-all duration-300"
                    data-dokumen-id="${d.id}">
                    ${fileIcon}
                    <div class="flex-1 min-w-0 py-0.5">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-800 dark:text-slate-100 truncate pr-2">${d.nama_dokumen}</p>
                                ${d.nomor_dokumen ? `<p class="text-xs text-slate-500 font-mono mt-1">${d.nomor_dokumen}</p>` : ''}
                            </div>
                            <div class="flex items-center shrink-0">
                                ${statusBadge}
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-2.5 text-[11px] text-slate-500">
                            ${d.penerbit ? `<span class="flex items-center gap-1.5"><i data-lucide="building-2" class="w-3.5 h-3.5 text-slate-400"></i>${d.penerbit}</span>` : ''}
                            ${d.tanggal_dokumen ? `<span class="flex items-center gap-1.5"><i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>${d.tanggal_dokumen_fmt}</span>` : ''}
                            <span class="flex items-center gap-1.5 bg-slate-50 px-2 py-0.5 rounded-md border border-slate-100"><i data-lucide="hard-drive" class="w-3 h-3 text-slate-400"></i> ${d.file_size_human}</span>
                        </div>
                        
                        ${d.tanggal_kadaluarsa ? `
                        <div class="mt-2.5 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-medium ${isExpired ? 'bg-rose-50 text-rose-600' : isExpiring ? 'bg-amber-50 text-amber-600' : 'bg-slate-50 text-slate-500'}">
                            <i data-lucide="clock" class="w-3 h-3"></i>
                            Berlaku s/d: ${d.tanggal_kadaluarsa_fmt}
                        </div>` : ''}
                    </div>

                    {{-- Action buttons (Muncul saat Hover di Desktop) --}}
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 flex flex-col sm:flex-row items-center gap-2 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity bg-white/90 backdrop-blur-sm p-1.5 rounded-xl shadow-sm border border-slate-100">
                        <button onclick="previewDokumen(${d.id}, '${d.nama_dokumen}', '${d.file_type}', ${this.currentGuruId})"
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-white text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition-all border border-transparent hover:border-emerald-100"
                            title="Preview">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </button>
                        <a href="/operator/data-guru/${this.currentGuruId}/dokumen/${d.id}/download"
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-white text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-all border border-transparent hover:border-blue-100"
                            title="Download">
                            <i data-lucide="download" class="w-4 h-4"></i>
                        </a>
                        <div class="w-full sm:w-px h-px sm:h-5 bg-slate-200 my-1 sm:my-0"></div>
                        <button onclick="verifyDokumen(${d.id}, ${this.currentGuruId})"
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-white text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition-all border border-transparent hover:border-emerald-100"
                            title="${d.is_verified ? 'Batalkan Verifikasi' : 'Verifikasi Dokumen'}">
                            <i data-lucide="${d.is_verified ? 'shield-x' : 'shield-check'}" class="w-4 h-4"></i>
                        </button>
                        <button onclick="deleteDokumen(${d.id}, '${d.nama_dokumen}', ${this.currentGuruId})"
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-white text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-all border border-transparent hover:border-rose-100"
                            title="Hapus">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            `;
        },
    }));
});

// ===== Global functions =====

function previewDokumen(dokumenId, nama, tipe, guruId) {
    const modal   = document.getElementById('modalPreviewDokumen');
    const content = document.getElementById('previewDokumenContent');
    const url     = `/operator/data-guru/${guruId}/dokumen/${dokumenId}/view`;

    document.getElementById('previewDokumenNama').innerText = nama;
    document.getElementById('previewDokumenDownload').href  =
        `/operator/data-guru/${guruId}/dokumen/${dokumenId}/download`;

    content.innerHTML = tipe === 'pdf'
        ? `<iframe src="${url}" class="w-full h-full min-h-[600px] rounded-xl shadow-inner border border-slate-200" frameborder="0"></iframe>`
        : `<img src="${url}" class="max-w-full max-h-[75vh] object-contain rounded-xl shadow-md border border-slate-200 bg-white" alt="${nama}">`;

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    if (typeof lucide !== 'undefined') lucide.createIcons();
}

function deleteDokumen(dokumenId, nama, guruId) {
    if (!confirm(`Yakin hapus dokumen "${nama}"?\nFile akan dihapus permanen.`)) return;

    fetch(`/operator/data-guru/${guruId}/dokumen/${dokumenId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) {
            const el = document.querySelector(`[data-dokumen-id="${dokumenId}"]`);
            if (el) {
                el.style.opacity = '0';
                el.style.transform = 'translateX(10px)';
                el.style.transition = 'all 0.3s ease';
                setTimeout(() => el.remove(), 300);
            }
            // ✅ Reload list setelah hapus
            const modalEl = document.getElementById('modalDokumenGuru');
            if (modalEl && modalEl._x_dataStack && modalEl._x_dataStack[0]) {
                setTimeout(() => {
                    modalEl._x_dataStack[0].loadDokumens(guruId);
                }, 350);
            }
        }
    });
}
function verifyDokumen(dokumenId, guruId) {
    fetch(`/operator/data-guru/${guruId}/dokumen/${dokumenId}/verify`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) {
            // ✅ Alpine v3 — gunakan _x_dataStack
            const modalEl = document.getElementById('modalDokumenGuru');
            if (modalEl && modalEl._x_dataStack && modalEl._x_dataStack[0]) {
                modalEl._x_dataStack[0].loadDokumens(guruId);
            }
        }
    });
}
</script>
@endpush