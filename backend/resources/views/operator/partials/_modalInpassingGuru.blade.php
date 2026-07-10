{{-- resources/views/operator/partials/_modalInpassingGuru.blade.php --}}
{{-- Dipanggil via: @include('operator.partials._modalInpassingGuru') --}}
{{-- Dibuka via JS: openInpassingModal(guru) dari guruPanel Alpine --}}

<div id="modalInpassingGuru"
    x-data="inpassingPanel()"
    class="fixed inset-0 z-[80] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm overflow-y-auto transition-all duration-300 opacity-0"
    @click.self="closeInpassingModal()">

    <div class="relative w-full max-w-5xl mx-auto my-4 bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl shadow-emerald-900/10 overflow-hidden flex flex-col max-h-[95vh] border border-slate-100 dark:border-slate-800">

        {{-- ===== HEADER ===== --}}
        <div class="flex items-center justify-between px-8 py-5 border-b border-slate-100 dark:border-slate-800 shrink-0 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md z-10 sticky top-0">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-sm border border-emerald-100 bg-emerald-50 dark:bg-emerald-900/30 dark:border-emerald-800">
                    <i data-lucide="scale" class="w-6 h-6 text-emerald-600 dark:text-emerald-400"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white tracking-tight">
                        Riwayat Inpassing Jabatan
                    </h3>
                    <div class="flex items-center gap-2 mt-0.5">
                        <i data-lucide="user" class="w-3.5 h-3.5 text-emerald-600"></i>
                        <p id="inpassingGuruNama" class="text-xs text-slate-500 dark:text-slate-400 font-medium tracking-wide">—</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div id="inpassingStatBadges" class="hidden sm:flex items-center gap-2">
                    <span id="badgeTotalInpassing"
                        class="px-3.5 py-1.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-xl text-[11px] font-bold tracking-wide">
                        0 Riwayat
                    </span>
                    <span id="badgeInpassingAktif"
                        class="hidden px-3.5 py-1.5 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl text-[11px] font-bold tracking-wide">
                        — Aktif
                    </span>
                </div>
                <div class="h-8 w-px bg-slate-200 dark:bg-slate-700 hidden sm:block"></div>
                <button @click="closeInpassingModal()"
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-slate-800 text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-100 hover:border-rose-100 transition-all shadow-sm">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        {{-- ===== BODY ===== --}}
        <div class="flex flex-col lg:flex-row flex-1 min-h-0 overflow-hidden bg-slate-50/50 dark:bg-slate-900/50">

            {{-- ── PANEL KIRI: Form Input ── --}}
            <div class="w-full lg:w-[400px] shrink-0 border-b lg:border-b-0 lg:border-r border-slate-100 dark:border-slate-800 overflow-y-auto bg-white dark:bg-slate-900">
                <div class="p-6 md:p-8 space-y-6">

                    {{-- Info box --}}
                    <div class="p-4 bg-emerald-50/80 border border-emerald-100/80 rounded-2xl flex items-start gap-3">
                        <div class="p-1.5 bg-white rounded-lg shadow-sm shrink-0">
                            <i data-lucide="info" class="w-4 h-4 text-emerald-600"></i>
                        </div>
                        <div class="text-xs text-slate-600 space-y-1">
                            <p class="font-bold text-emerald-800">Inpassing Jabatan Fungsional</p>
                            <p class="leading-relaxed opacity-90">Penyetaraan jabatan & golongan untuk guru non-PNS (GTY/Honorer) sesuai SK Kemenag/BKN.</p>
                        </div>
                    </div>

                    <form id="formInpassing" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">
                            
                            <div class="flex items-center gap-3 pb-2">
                                <div class="h-px flex-1 bg-slate-100"></div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Formulir Riwayat Baru</p>
                                <div class="h-px flex-1 bg-slate-100"></div>
                            </div>

                            {{-- No SK --}}
                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700">Nomor SK Inpassing <span class="text-rose-500">*</span></label>
                                <input type="text" name="no_sk"
                                    class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="Contoh: 2847/Kw.11.1/2/KP.07.6/2023" required>
                            </div>

                            {{-- Jabatan Fungsional --}}
                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-slate-700">Jabatan Fungsional <span class="text-rose-500">*</span></label>
                                <select name="jabatan_fungsional" id="selectJabatanInpassing"
                                    class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm text-slate-800 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all appearance-none cursor-pointer"
                                    @change="updateGolonganOptions()" required>
                                    <option value="">— Pilih Jabatan Hasil Inpassing —</option>
                                    <option value="Guru Pertama">Guru Pertama (III/a – III/b)</option>
                                    <option value="Guru Muda">Guru Muda (III/c – III/d)</option>
                                    <option value="Guru Madya">Guru Madya (IV/a – IV/b – IV/c)</option>
                                    <option value="Guru Utama">Guru Utama (IV/d – IV/e)</option>
                                </select>
                            </div>

                            {{-- Golongan --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-slate-700">Gol. Sebelum</label>
                                    <select name="golongan_sebelum"
                                        class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm text-slate-800 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all appearance-none cursor-pointer">
                                        <option value="">— Opsional —</option>
                                        @foreach(['II/a','II/b','II/c','II/d','III/a','III/b','III/c','III/d','IV/a','IV/b','IV/c','IV/d','IV/e'] as $gol)
                                        <option value="{{ $gol }}">{{ $gol }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-slate-700">Gol. Sesudah <span class="text-rose-500">*</span></label>
                                    <select name="golongan_sesudah" id="selectGolonganSesudah"
                                        class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm text-slate-800 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all appearance-none cursor-pointer" required>
                                        <option value="">— Tunggu Jabatan —</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Tanggal SK & TMT --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-slate-700">Tanggal SK <span class="text-rose-500">*</span></label>
                                    <div class="relative">
                                        <i data-lucide="calendar" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                                        <input type="text" name="tanggal_sk" id="inpassing_tgl_sk"
                                            class="w-full pl-9 pr-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all"
                                            placeholder="Pilih Tanggal" required>
                                    </div>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-slate-700">TMT Berlaku <span class="text-rose-500">*</span></label>
                                    <div class="relative">
                                        <i data-lucide="clock" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                                        <input type="text" name="tmt_inpassing" id="inpassing_tmt"
                                            class="w-full pl-9 pr-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all"
                                            placeholder="Pilih TMT" required>
                                    </div>
                                </div>
                            </div>

                            {{-- Angka Kredit & Instansi --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-slate-700">Angka Kredit</label>
                                    <input type="text" name="angka_kredit"
                                        class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all"
                                        placeholder="Cth: 150.00">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-slate-700">Instansi Penetap</label>
                                    <input type="text" name="instansi_penetap"
                                        class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all"
                                        placeholder="Kemenag / BKN">
                                </div>
                            </div>

                            {{-- Upload SK --}}
                            <div class="space-y-1.5 pt-2">
                                <label class="text-xs font-semibold text-slate-700">Dokumen SK Inpassing</label>
                                <div class="border-2 border-dashed border-slate-200 hover:border-emerald-400 bg-slate-50 hover:bg-emerald-50/30 rounded-2xl p-5 flex flex-col items-center justify-center gap-2 transition-all duration-300 relative group cursor-pointer"
                                    @dragover.prevent @drop.prevent="handleDropInpassing($event)" @click="document.getElementById('inputFileSKInpassing').click()">
                                    
                                    <div class="w-10 h-10 rounded-full bg-white shadow-sm border border-slate-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i data-lucide="cloud-upload" class="w-5 h-5 text-emerald-500"></i>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xs text-slate-600 font-medium">Klik atau seret file ke sini</p>
                                        <p class="text-[10px] text-slate-400 mt-0.5">PDF / JPG / PNG (Maks. 5MB)</p>
                                    </div>
                                    <input type="file" name="file_sk" id="inputFileSKInpassing"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        class="hidden"
                                        @change="setFileInpassing($event)">
                                        
                                    {{-- File Terpilih Overlay --}}
                                    <div x-show="fileNameInpassing" x-transition.opacity
                                        class="absolute inset-0 bg-white/95 backdrop-blur-sm rounded-2xl border-2 border-emerald-400 flex flex-col items-center justify-center p-4 z-10" @click.stop>
                                        <i data-lucide="file-check-2" class="w-8 h-8 text-emerald-500 mb-2"></i>
                                        <p x-text="fileNameInpassing" class="text-xs font-bold text-slate-700 text-center truncate w-full px-4"></p>
                                        <button type="button" @click.prevent="clearFileInpassing()"
                                            class="mt-2 px-3 py-1 bg-rose-50 text-rose-600 rounded-lg text-[10px] font-bold hover:bg-rose-100 transition-colors">
                                            Batalkan File
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full py-3.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl text-sm font-bold tracking-wide flex items-center justify-center gap-2 transition-all shadow-lg shadow-emerald-900/20 active:scale-[0.98]">
                                    <i data-lucide="save" class="w-4 h-4"></i>
                                    Simpan Data Inpassing
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── PANEL KANAN: Riwayat ── --}}
            <div class="flex-1 overflow-y-auto relative">
                <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:16px_16px] opacity-30"></div>
                <div class="p-6 md:p-8 relative z-10">

                    {{-- Loading --}}
                    <div id="inpassingLoading" class="flex items-center justify-center py-24 hidden">
                        <div class="flex flex-col items-center gap-4 bg-white px-8 py-6 rounded-3xl shadow-sm border border-slate-100">
                            <div class="w-10 h-10 border-4 border-slate-100 border-t-emerald-600 rounded-full animate-spin"></div>
                            <p class="text-sm text-slate-500 font-medium animate-pulse">Menarik data riwayat...</p>
                        </div>
                    </div>

                    {{-- Empty --}}
                    <div id="inpassingEmpty" class="flex flex-col items-center justify-center py-24 hidden">
                        <div class="w-24 h-24 bg-white shadow-sm border border-slate-100 rounded-[2rem] flex items-center justify-center mb-6 relative">
                            <div class="absolute inset-0 bg-emerald-50 rounded-[2rem] scale-110 -z-10 opacity-50"></div>
                            <i data-lucide="folder-open" class="w-10 h-10 text-slate-300"></i>
                        </div>
                        <h4 class="text-lg font-bold text-slate-700">Belum Ada Riwayat</h4>
                        <p class="text-sm text-slate-500 mt-2 text-center max-w-sm leading-relaxed">Guru ini belum memiliki catatan inpassing jabatan. Silakan tambahkan data baru melalui formulir di samping.</p>
                    </div>

                    {{-- List --}}
                    <div id="inpassingList" class="space-y-4 hidden"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('inpassingPanel', () => ({
        fileNameInpassing: '',
        currentGuruId: null,

        golonganMap: {
            'Guru Pertama': ['III/a', 'III/b'],
            'Guru Muda':    ['III/c', 'III/d'],
            'Guru Madya':   ['IV/a',  'IV/b', 'IV/c'],
            'Guru Utama':   ['IV/d',  'IV/e'],
        },

        // Update warna menjadi lebih profesional & korporat
        jabatanColors: {
            'Guru Pertama': { bg: '#f8fafc', text: '#475569', border: '#e2e8f0', dot: '#64748b', iconBg: '#f1f5f9' },
            'Guru Muda':    { bg: '#eff6ff', text: '#1e40af', border: '#bfdbfe', dot: '#3b82f6', iconBg: '#dbeafe' },
            'Guru Madya':   { bg: '#f5f3ff', text: '#5b21b6', border: '#ddd6fe', dot: '#8b5cf6', iconBg: '#ede9fe' },
            'Guru Utama':   { bg: '#fef2f2', text: '#991b1b', border: '#fecaca', dot: '#ef4444', iconBg: '#fee2e2' },
        },

        initDatepickers() {
            const opts = { altInput: true, altFormat: 'd/m/Y', dateFormat: 'Y-m-d', allowInput: true };
            flatpickr('#inpassing_tgl_sk', opts);
            flatpickr('#inpassing_tmt',    opts);
        },

        updateGolonganOptions() {
            const jabatan  = document.getElementById('selectJabatanInpassing').value;
            const select   = document.getElementById('selectGolonganSesudah');
            const options  = this.golonganMap[jabatan] ?? [];

            select.innerHTML = options.length
                ? options.map(g => `<option value="${g}">${g}</option>`).join('')
                : '<option value="">— Tunggu Jabatan —</option>';
        },

        openInpassingModal(guru) {
            this.currentGuruId = guru.id;
            document.getElementById('inpassingGuruNama').innerText = guru.nama ?? '—';
            document.getElementById('formInpassing').action = `/operator/data-guru/${guru.id}/inpassing`;
            this.resetForm();
            this.loadInpassings(guru.id);

            const modal = document.getElementById('modalInpassingGuru');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => modal.classList.add('opacity-100'), 10);
            document.body.style.overflow = 'hidden';

            this.$nextTick(() => {
                this.initDatepickers();
                if (typeof lucide !== 'undefined') lucide.createIcons();
            });
        },

        closeInpassingModal() {
            const modal = document.getElementById('modalInpassingGuru');
            modal.classList.remove('opacity-100');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = '';
            }, 300);
        },

        resetForm() {
            document.getElementById('formInpassing').reset();
            this.clearFileInpassing();
            const sel = document.getElementById('selectGolonganSesudah');
            if (sel) sel.innerHTML = '<option value="">— Tunggu Jabatan —</option>';
        },

        setFileInpassing(e) {
            this.fileNameInpassing = e.target.files[0]?.name ?? '';
        },

        clearFileInpassing() {
            this.fileNameInpassing = '';
            const input = document.getElementById('inputFileSKInpassing');
            if(input) input.value = '';
        },

        handleDropInpassing(e) {
            const file = e.dataTransfer.files[0];
            if (!file) return;
            const input = document.getElementById('inputFileSKInpassing');
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
            this.fileNameInpassing = file.name;
        },

        async loadInpassings(guruId) {
            document.getElementById('inpassingLoading').classList.remove('hidden');
            document.getElementById('inpassingEmpty').classList.add('hidden');
            document.getElementById('inpassingList').classList.add('hidden');

            try {
                const res  = await fetch(`/operator/data-guru/${guruId}/inpassing`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await res.json();
                this.renderInpassings(data);

                document.getElementById('badgeTotalInpassing').innerText = `${data.total} Riwayat`;
                document.getElementById('inpassingStatBadges').classList.remove('hidden');

                const badgeAktif = document.getElementById('badgeInpassingAktif');
                if (data.aktif) {
                    badgeAktif.innerHTML = `<span class="w-1.5 h-1.5 bg-emerald-500 rounded-full inline-block mr-1"></span> ${data.aktif.jabatan_fungsional} (${data.aktif.golongan_sesudah})`;
                    badgeAktif.classList.remove('hidden');
                } else {
                    badgeAktif.classList.add('hidden');
                }
            } catch(e) {
                console.error(e);
            } finally {
                document.getElementById('inpassingLoading').classList.add('hidden');
            }
        },

        renderInpassings(data) {
            const list  = document.getElementById('inpassingList');
            const empty = document.getElementById('inpassingEmpty');

            if (data.total === 0) {
                empty.classList.remove('hidden');
                list.classList.add('hidden');
                return;
            }

            empty.classList.add('hidden');
            list.classList.remove('hidden');
            list.innerHTML = '';

            data.inpassings.forEach(ip => {
                const colors = this.jabatanColors[ip.jabatan_fungsional] ?? {
                    bg: '#ffffff', text: '#475569', border: '#e2e8f0', dot: '#94a3b8', iconBg: '#f8fafc'
                };
                const isAktif = ip.status === 'aktif';
                
                // Styling Card Modern (Bento style)
                const cardClasses = isAktif 
                    ? `bg-white border-2 border-emerald-500 shadow-md shadow-emerald-500/10 ring-4 ring-emerald-50` 
                    : `bg-white border border-slate-200 hover:border-slate-300 hover:shadow-md shadow-sm`;

                const el = document.createElement('div');
                el.dataset.inpassingId = ip.id;
                el.className = `relative group rounded-3xl transition-all duration-300 ${cardClasses}`;

                el.innerHTML = `
                    <div class="p-5 sm:p-6 flex flex-col sm:flex-row items-start gap-5">
                        
                        {{-- Icon Kiri --}}
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0"
                            style="background:${colors.iconBg};">
                            <i data-lucide="award" class="w-6 h-6" style="color:${colors.dot}"></i>
                        </div>

                        {{-- Konten Utama --}}
                        <div class="flex-1 min-w-0 w-full">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
                                <div>
                                    <div class="flex items-center gap-2 flex-wrap mb-1">
                                        <h4 class="text-base font-bold" style="color:${colors.text}">${ip.jabatan_fungsional}</h4>
                                        <span class="px-2.5 py-1 rounded-lg text-[11px] font-bold tracking-wide border"
                                            style="background:${colors.bg}; color:${colors.text}; border-color:${colors.border};">
                                            GOL. ${ip.golongan_sesudah}
                                        </span>
                                        ${isAktif ? `
                                        <span class="flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-lg text-[10px] font-bold border border-emerald-200">
                                            <span class="relative flex h-2 w-2">
                                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                              <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                            </span>
                                            AKTIF SEKARANG
                                        </span>` : ''}
                                    </div>
                                    ${ip.golongan_sebelum ? `
                                    <p class="text-xs text-slate-500 font-medium">
                                        Penyetaraan dari <span class="text-slate-700 font-bold">${ip.golongan_sebelum}</span> ke <span class="text-slate-700 font-bold">${ip.golongan_sesudah}</span>
                                    </p>` : ''}
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex items-center gap-2 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                                    ${ip.file_sk_url ? `
                                    <a href="/operator/data-guru/${this.currentGuruId}/inpassing/${ip.id}/sk"
                                        target="_blank"
                                        class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition-all border border-slate-200 hover:border-emerald-200"
                                        title="Lihat Dokumen SK">
                                        <i data-lucide="file-text" class="w-4 h-4"></i>
                                    </a>` : ''}
                                    ${!isAktif ? `
                                    <button onclick="setInpassingAktif(${ip.id}, ${this.currentGuruId})"
                                        class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-all border border-slate-200 hover:border-blue-200"
                                        title="Jadikan Aktif Utama">
                                        <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                                    </button>` : ''}
                                    <button onclick="deleteInpassing(${ip.id}, '${ip.no_sk.replace(/'/g,"\\'")}', ${this.currentGuruId})"
                                        class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-all border border-slate-200 hover:border-rose-200"
                                        title="Hapus Data">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Info Grid (Bento style details) --}}
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 bg-slate-50 rounded-2xl p-3 border border-slate-100">
                                <div class="space-y-1">
                                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">No SK</p>
                                    <p class="text-xs font-medium text-slate-700 truncate" title="${ip.no_sk}">${ip.no_sk}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Tgl SK</p>
                                    <p class="text-xs font-medium text-slate-700">${ip.tanggal_sk_fmt}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">TMT</p>
                                    <p class="text-xs font-medium text-slate-700">${ip.tmt_inpassing_fmt}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Kredit</p>
                                    <p class="text-xs font-bold text-slate-700">${ip.angka_kredit ?? '-'}</p>
                                </div>
                            </div>
                            
                            ${ip.instansi_penetap || ip.pejabat_penetap ? `
                            <div class="mt-3 flex items-center gap-2 text-xs text-slate-500 bg-white inline-flex px-3 py-1.5 rounded-lg border border-slate-100 shadow-sm">
                                <i data-lucide="building" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span>Penetap: <span class="font-medium text-slate-700">${[ip.instansi_penetap, ip.pejabat_penetap].filter(Boolean).join(' - ')}</span></span>
                            </div>` : ''}
                        </div>
                    </div>
                `;
                list.appendChild(el);
            });

            this.$nextTick(() => {
                if (typeof lucide !== 'undefined') lucide.createIcons();
            });
        },
    }));
});

// ... (Fungsi setInpassingAktif & deleteInpassing tetap sama secara fungsional) ...
function setInpassingAktif(inpassingId, guruId) {
    fetch(`/operator/data-guru/${guruId}/inpassing/${inpassingId}/aktif`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) {
            const modalEl = document.getElementById('modalInpassingGuru');
            if (modalEl?._x_dataStack?.[0]) modalEl._x_dataStack[0].loadInpassings(guruId);
        }
    });
}

function deleteInpassing(inpassingId, noSk, guruId) {
    if (!confirm(`Yakin hapus riwayat inpassing SK "${noSk}"?`)) return;

    fetch(`/operator/data-guru/${guruId}/inpassing/${inpassingId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) {
            const el = document.querySelector(`[data-inpassing-id="${inpassingId}"]`);
            if (el) {
                el.style.opacity = '0';
                el.style.transform = 'scale(0.95)';
                el.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                setTimeout(() => el.remove(), 300);
            }
            const modalEl = document.getElementById('modalInpassingGuru');
            if (modalEl?._x_dataStack?.[0]) {
                setTimeout(() => modalEl._x_dataStack[0].loadInpassings(guruId), 350);
            }
        }
    });
}
</script>
@endpush