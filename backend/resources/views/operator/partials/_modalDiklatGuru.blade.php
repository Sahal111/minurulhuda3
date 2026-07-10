{{-- resources/views/operator/partials/_modalDiklatGuru.blade.php --}}
{{-- Dipanggil via: @include('operator.partials._modalDiklatGuru') --}}
{{-- Dibuka via JS: openDiklatModal(guru) dari guruPanel Alpine --}}
{{-- resources/views/operator/partials/_modalDiklatGuru.blade.php --}}
<div id="modalDiklatGuru"
    x-data="diklatPanel()"
    class="fixed inset-0 z-[80] hidden items-center justify-center bg-[#001a13]/70 backdrop-blur-sm overflow-y-auto font-['Inter',_sans-serif]">

    <div class="relative w-full max-w-5xl mx-auto my-4 bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden flex flex-col max-h-[95vh] border border-[#bfc9c3]/10">

        {{-- ===== HEADER ===== --}}
        <div class="flex items-center justify-between px-8 py-6 border-b border-[#bfc9c3]/10 shrink-0 bg-white/90 backdrop-blur-md">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-[#003527] rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-900/20">
                    <i data-lucide="book-open" class="w-6 h-6 text-emerald-400"></i>
                </div>
                <div>
                    <h3 class="text-xl font-extrabold text-[#003527] tracking-tight">
                        Riwayat Diklat & Pelatihan
                    </h3>
                    <p id="diklatGuruNama" class="text-[11px] text-[#006c49] font-bold uppercase tracking-widest mt-0.5">—</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                {{-- Stat badges --}}
                <div id="diklatStatBadges" class="hidden sm:flex items-center gap-2">
                    <span id="badgeTotalDiklat"
                        class="px-4 py-1.5 bg-emerald-50 border border-emerald-100 text-[#006c49] rounded-full text-[11px] font-bold">
                        0 Riwayat
                    </span>
                    <span id="badgeTotalJP"
                        class="px-4 py-1.5 bg-[#6cf8bb]/20 border border-[#6cf8bb]/30 text-[#006c49] rounded-full text-[11px] font-bold hidden">
                        0 JP Total
                    </span>
                </div>
                <div class="h-8 w-px bg-[#bfc9c3]/20 hidden sm:block mx-1"></div>
                <button @click="closeDiklatModal()"
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-all">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        {{-- ===== BODY ===== --}}
        <div class="flex flex-col lg:flex-row flex-1 min-h-0 overflow-hidden">

            {{-- ── PANEL KIRI: Form Input ── --}}
            <div class="w-full lg:w-[360px] shrink-0 border-b lg:border-b-0 lg:border-r border-[#bfc9c3]/10 overflow-y-auto bg-white">
                <div class="p-6 space-y-4">
                    <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                        <div class="w-6 h-6 rounded-lg bg-emerald-50 flex items-center justify-center">
                            <i data-lucide="plus-circle" class="w-3.5 h-3.5 text-[#006c49]"></i>
                        </div>
                        <p class="text-xs font-bold text-slate-600 uppercase tracking-wider">
                            Tambah Riwayat Diklat
                        </p>
                    </div>

                    <form id="formDiklat" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-3.5">
                            {{-- Nama Diklat --}}
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-bold text-[#707974] uppercase tracking-wider">Nama Diklat <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama_diklat"
                                    class="w-full px-3 py-2.5 bg-[#f0f4f8] border border-transparent rounded-xl text-sm focus:ring-2 focus:ring-[#6cf8bb] focus:bg-white outline-none transition-all"
                                    placeholder="Contoh: Diklat PKB Guru Kelas MI" required>
                            </div>

                            {{-- Jenis --}}
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[11px] font-bold text-[#707974] uppercase tracking-wider">Jenis <span class="text-rose-500">*</span></label>
                                    <select name="jenis" class="w-full px-3 py-2.5 bg-[#f0f4f8] border border-transparent rounded-xl text-sm focus:ring-2 focus:ring-[#6cf8bb] focus:bg-white outline-none transition-all" required>
                                        <option value="">Pilih</option>
                                        <option value="diklat">Diklat Fungsional</option>
                                        <option value="workshop">Workshop</option>
                                        <option value="seminar">Seminar</option>
                                        <option value="bimtek">Bimtek</option>
                                        <option value="pelatihan">Pelatihan</option>
                                        <option value="magang">Magang</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[11px] font-bold text-[#707974] uppercase tracking-wider">Peran</label>
                                    <select name="peran" class="w-full px-3 py-2.5 bg-[#f0f4f8] border border-transparent rounded-xl text-sm focus:ring-2 focus:ring-[#6cf8bb] focus:bg-white outline-none transition-all">
                                        <option value="peserta">Peserta</option>
                                        <option value="narasumber">Narasumber</option>
                                        <option value="panitia">Panitia</option>
                                        <option value="fasilitator">Fasilitator</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Penyelenggara --}}
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-bold text-[#707974] uppercase tracking-wider">Penyelenggara</label>
                                <input type="text" name="penyelenggara"
                                    class="w-full px-3 py-2.5 bg-[#f0f4f8] border border-transparent rounded-xl text-sm focus:ring-2 focus:ring-[#6cf8bb] focus:bg-white outline-none transition-all"
                                    placeholder="Kemenag, LPMP, P4TK, dll">
                            </div>

                            {{-- Tingkat --}}
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] font-bold text-[#707974] uppercase tracking-wider">Tingkat</label>
                                <select name="tingkat" class="w-full px-3 py-2.5 bg-[#f0f4f8] border border-transparent rounded-xl text-sm focus:ring-2 focus:ring-[#6cf8bb] focus:bg-white outline-none transition-all">
                                    <option value="">— Pilih Tingkat —</option>
                                    <option value="sekolah">Tingkat Sekolah</option>
                                    <option value="kecamatan">Tingkat Kecamatan</option>
                                    <option value="kabupaten">Tingkat Kabupaten/Kota</option>
                                    <option value="provinsi">Tingkat Provinsi</option>
                                    <option value="nasional">Tingkat Nasional</option>
                                    <option value="internasional">Internasional</option>
                                </select>
                            </div>

                            {{-- Tanggal --}}
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[11px] font-bold text-[#707974] uppercase tracking-wider">Tgl Mulai</label>
                                    <input type="text" name="tanggal_mulai" id="diklat_tgl_mulai"
                                        class="w-full px-3 py-2.5 bg-[#f0f4f8] border border-transparent rounded-xl text-sm focus:ring-2 focus:ring-[#6cf8bb] outline-none"
                                        placeholder="dd/mm/yyyy">
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[11px] font-bold text-[#707974] uppercase tracking-wider">Tgl Selesai</label>
                                    <input type="text" name="tanggal_selesai" id="diklat_tgl_selesai"
                                        class="w-full px-3 py-2.5 bg-[#f0f4f8] border border-transparent rounded-xl text-sm focus:ring-2 focus:ring-[#6cf8bb] outline-none"
                                        placeholder="dd/mm/yyyy">
                                </div>
                            </div>

                            {{-- Jam + No Sertifikat --}}
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[11px] font-bold text-[#707974] uppercase tracking-wider">Jumlah JP</label>
                                    <input type="number" name="jumlah_jam" min="1" max="9999"
                                        class="w-full px-3 py-2.5 bg-[#f0f4f8] border border-transparent rounded-xl text-sm focus:ring-2 focus:ring-[#6cf8bb] outline-none"
                                        placeholder="32">
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[11px] font-bold text-[#707974] uppercase tracking-wider">No. Sertifikat</label>
                                    <input type="text" name="no_sertifikat"
                                        class="w-full px-3 py-2.5 bg-[#f0f4f8] border border-transparent rounded-xl text-sm focus:ring-2 focus:ring-[#6cf8bb] outline-none"
                                        placeholder="Nomor sertifikat">
                                </div>
                            </div>

                            {{-- Upload Sertifikat --}}
                            <div class="border-2 border-dashed border-slate-200 hover:border-emerald-400 rounded-2xl p-4 flex flex-col items-center gap-2 transition-all relative"
                                @dragover.prevent @drop.prevent="handleDropDiklat($event)">
                                <i data-lucide="file-up" class="w-8 h-8 text-[#95d3ba]"></i>
                                <p class="text-xs text-[#707974] font-medium text-center">
                                    Scan Sertifikat <span class="text-slate-400">(opsional)</span>
                                </p>
                                <label class="px-4 py-2 bg-emerald-50 text-[#006c49] border border-emerald-100 rounded-xl text-xs font-bold cursor-pointer hover:bg-[#6cf8bb] hover:text-[#006c49] transition-all">
                                    Pilih File
                                    <input type="file" name="file_sertifikat" id="inputFileDiklat"
                                        accept=".pdf,.jpg,.jpeg,.png" class="hidden" @change="setFileDiklat($event)">
                                </label>
                                <div x-show="fileNameDiklat" x-transition
                                    class="absolute inset-0 bg-white/95 backdrop-blur-sm rounded-2xl border-2 border-[#6cf8bb] flex flex-col items-center justify-center p-4">
                                    <i data-lucide="check-circle" class="w-8 h-8 text-[#006c49] mb-1"></i>
                                    <p x-text="fileNameDiklat" class="text-xs font-bold text-slate-700 text-center truncate w-full px-2"></p>
                                    <button type="button" @click.prevent="clearFileDiklat()" class="mt-1.5 text-[10px] text-rose-500 font-semibold hover:underline">Hapus</button>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <button type="submit"
                                class="w-full py-3 bg-[#003527] hover:bg-[#006c49] text-white rounded-xl text-xs font-black uppercase tracking-widest flex items-center justify-center gap-2 transition-all shadow-lg shadow-emerald-900/20 active:scale-95">
                                <i data-lucide="save" class="w-4 h-4"></i>
                                Simpan Riwayat
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── PANEL KANAN: Daftar Riwayat ── --}}
            <div class="flex-1 overflow-y-auto bg-[#f0f4f8]/30">
                <div class="p-6 md:p-8">
                    {{-- Loading --}}
                    <div id="diklatLoading" class="flex items-center justify-center py-20 hidden">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-10 h-10 border-4 border-emerald-100 border-t-[#006c49] rounded-full animate-spin"></div>
                            <p class="text-sm text-slate-400 font-medium">Memuat data...</p>
                        </div>
                    </div>

                    {{-- Empty --}}
                    <div id="diklatEmpty" class="flex flex-col items-center justify-center py-20 hidden">
                        <div class="w-20 h-20 bg-white shadow-sm border border-emerald-50 rounded-full flex items-center justify-center mb-5">
                            <i data-lucide="award" class="w-10 h-10 text-emerald-100"></i>
                        </div>
                        <h4 class="text-base font-bold text-[#003527]">Belum Ada Riwayat Diklat</h4>
                        <p class="text-sm text-slate-400 mt-1 text-center max-w-xs">Data pelatihan pendidik akan tampil di sini.</p>
                    </div>

                    {{-- List --}}
                    <div id="diklatList" class="space-y-8 hidden"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<style>
    /* Styling khusus scrollbar untuk modal ini agar lebih rapi */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: #94a3b8; }
</style>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('diklatPanel', () => ({
        fileNameDiklat: '',
        currentGuruId: null,

        initDatepickers() {
            const opts = { altInput: true, altFormat: 'd/m/Y', dateFormat: 'Y-m-d', allowInput: true };
            flatpickr('#diklat_tgl_mulai', opts);
            flatpickr('#diklat_tgl_selesai', opts);
        },

        openDiklatModal(guru) {
            this.currentGuruId = guru.id;
            document.getElementById('diklatGuruNama').innerText = guru.nama ?? '—';
            document.getElementById('formDiklat').action = `/operator/data-guru/${guru.id}/diklat`;
            this.resetForm();
            this.loadDiklats(guru.id);

            const modal = document.getElementById('modalDiklatGuru');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';

            this.$nextTick(() => {
                this.initDatepickers();
                if (typeof lucide !== 'undefined') lucide.createIcons();
            });
        },

        closeDiklatModal() {
            const modal = document.getElementById('modalDiklatGuru');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        },

        resetForm() {
            document.getElementById('formDiklat').reset();
            this.fileNameDiklat = '';
        },

        setFileDiklat(e) {
            this.fileNameDiklat = e.target.files[0]?.name ?? '';
        },

        clearFileDiklat() {
            this.fileNameDiklat = '';
            document.getElementById('inputFileDiklat').value = '';
        },

        handleDropDiklat(e) {
            const file = e.dataTransfer.files[0];
            if (!file) return;
            const input = document.getElementById('inputFileDiklat');
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
            this.fileNameDiklat = file.name;
        },

        async loadDiklats(guruId) {
            document.getElementById('diklatLoading').classList.remove('hidden');
            document.getElementById('diklatEmpty').classList.add('hidden');
            document.getElementById('diklatList').classList.add('hidden');
            document.getElementById('diklatStatBadges').classList.add('hidden');

            try {
                const res  = await fetch(`/operator/data-guru/${guruId}/diklat`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await res.json();
                this.renderDiklats(data);

                document.getElementById('badgeTotalDiklat').innerText = `${data.total} Riwayat`;
                document.getElementById('diklatStatBadges').classList.remove('hidden');

                if (data.total_jp > 0) {
                    const jpBadge = document.getElementById('badgeTotalJP');
                    jpBadge.innerText = `${data.total_jp} JP Total`;
                    jpBadge.classList.remove('hidden');
                } else {
                    document.getElementById('badgeTotalJP').classList.add('hidden');
                }
            } catch(e) {
                console.error(e);
            } finally {
                document.getElementById('diklatLoading').classList.add('hidden');
            }
        },

        renderDiklats(data) {
            const list  = document.getElementById('diklatList');
            const empty = document.getElementById('diklatEmpty');

            if (data.total === 0) {
                empty.classList.remove('hidden');
                list.classList.add('hidden');
                return;
            }

            empty.classList.add('hidden');
            list.classList.remove('hidden');
            list.innerHTML = '';

            // Mapping lengkap class Tailwind untuk mengatasi masalah Tailwind JIT scanner
            const badgeThemes = {
                'Diklat Fungsional': { icon: 'text-emerald-600', wrapper: 'bg-emerald-50 border-emerald-100', hover: 'hover:border-emerald-300 hover:shadow-emerald-900/5' },
                'Workshop':          { icon: 'text-emerald-600', wrapper: 'bg-emerald-50 border-emerald-100', hover: 'hover:border-emerald-300 hover:shadow-emerald-900/5' },
                'Seminar':           { icon: 'text-emerald-600', wrapper: 'bg-emerald-50 border-emerald-100', hover: 'hover:border-emerald-300 hover:shadow-emerald-900/5' },
                'Bimtek':            { icon: 'text-emerald-600', wrapper: 'bg-emerald-50 border-emerald-100', hover: 'hover:border-emerald-300 hover:shadow-emerald-900/5' },
                'Pelatihan':         { icon: 'text-emerald-600', wrapper: 'bg-emerald-50 border-emerald-100', hover: 'hover:border-emerald-300 hover:shadow-emerald-900/5' },
                'Magang':            { icon: 'text-emerald-600', wrapper: 'bg-emerald-50 border-emerald-100', hover: 'hover:border-emerald-300 hover:shadow-emerald-900/5' },
                'Lainnya':           { icon: 'text-slate-600',   wrapper: 'bg-slate-50 border-slate-200',     hover: 'hover:border-slate-300 hover:shadow-slate-900/5' },
            };

            const tingkatThemes = {
                'Tingkat Sekolah':       'bg-slate-50 text-slate-600 border-slate-200',
                'Tingkat Kecamatan':     'bg-emerald-50 text-emerald-600 border-emerald-100',
                'Tingkat Kabupaten/Kota':'bg-emerald-100 text-emerald-700 border-emerald-200',
                'Tingkat Provinsi':      'bg-emerald-600 text-white border-transparent',
                'Tingkat Nasional':      'bg-[#003527] text-emerald-400 border-transparent',
                'Internasional':         'bg-[#006c49] text-white border-transparent',
            };

            Object.entries(data.diklats).forEach(([group, items]) => {
                const theme = badgeThemes[group] || badgeThemes['Lainnya'];
                const section = document.createElement('div');
                section.innerHTML = `
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-xl ${theme.wrapper} flex items-center justify-center shadow-sm">
                            <i data-lucide="award" class="w-4 h-4 ${theme.icon}"></i>
                        </div>
                        <h5 class="text-[15px] font-extrabold text-slate-800 dark:text-slate-200 tracking-tight">${group}</h5>
                        <div class="h-px flex-1 bg-gradient-to-r from-slate-200 dark:from-slate-700 to-transparent"></div>
                        <span class="px-2.5 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-[10px] font-black text-slate-500 shadow-sm">${items.length}</span>
                    </div>
                    <div class="space-y-3.5">
                        ${items.map(d => this.renderDiklatCard(d, theme, tingkatThemes)).join('')}
                    </div>
                `;
                list.appendChild(section);
            });

            this.$nextTick(() => {
                if (typeof lucide !== 'undefined') lucide.createIcons();
            });
        },

        renderDiklatCard(d, theme, tingkatThemes) {
            const tkClass = tingkatThemes[d.tingkat_label] || 'bg-slate-50 text-slate-600 border-slate-200';
            const tingkatBadge = d.tingkat_label !== '-'
                ? `<span class="px-2 py-0.5 rounded text-[10px] font-bold border ${tkClass}">${d.tingkat_label}</span>`
                : '';

            const peranBadge = d.peran !== 'peserta'
                ? `<span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded text-[10px] font-bold border border-indigo-200 ml-1 shadow-sm">${d.peran_label}</span>`
                : '';

            const sertifikatBtn = d.file_sertifikat_url
                ? `<a href="/operator/data-guru/${this.currentGuruId}/diklat/${d.id}/sertifikat" target="_blank"
                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-emerald-600 hover:bg-emerald-50 transition-all shadow-sm"
                        title="Lihat Sertifikat">
                        <i data-lucide="file-check-2" class="w-4 h-4"></i>
                    </a>`
                : '';

            return `
                <div class="group relative flex items-start gap-4 p-4 lg:p-5 bg-white dark:bg-slate-800/80 rounded-[1.25rem] border border-slate-200 dark:border-slate-700 ${theme.hover} transition-all duration-300 hover:-translate-y-0.5"
                    data-diklat-id="${d.id}">
                    {{-- Icon Kiri --}}
                    <div class="w-12 h-12 ${theme.wrapper} rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                        <i data-lucide="graduation-cap" class="w-5 h-5 ${theme.icon}"></i>
                    </div>
                    {{-- Konten --}}
                    <div class="flex-1 min-w-0 pr-16">
                        <p class="text-[15px] font-bold text-slate-800 dark:text-slate-100 leading-snug">${d.nama_diklat}</p>
                        <div class="flex flex-wrap items-center gap-1.5 mt-2">
                            ${tingkatBadge}
                            ${peranBadge}
                        </div>
                        <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-3 text-[11px] font-medium text-slate-500">
                            ${d.penyelenggara ? `<span class="flex items-center gap-1.5"><i data-lucide="building-2" class="w-3.5 h-3.5 text-slate-400"></i>${d.penyelenggara}</span>` : ''}
                            ${d.tanggal_mulai ? `<span class="flex items-center gap-1.5"><i data-lucide="calendar-days" class="w-3.5 h-3.5 text-slate-400"></i>${d.tanggal_mulai_fmt}${d.tanggal_selesai ? ' – ' + d.tanggal_selesai_fmt : ''}</span>` : ''}
                            <span class="flex items-center gap-1.5 px-2 py-0.5 bg-slate-50 dark:bg-slate-700/50 rounded border border-slate-100 dark:border-slate-700">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>${d.durasi_label}
                            </span>
                        </div>
                        ${d.no_sertifikat ? `<div class="mt-3 p-2 bg-slate-50 dark:bg-slate-900/50 rounded-lg inline-block border border-slate-100 dark:border-slate-800"><p class="text-[10px] font-mono text-slate-500 flex items-center gap-1"><i data-lucide="hash" class="w-3 h-3 text-slate-400"></i>${d.no_sertifikat}</p></div>` : ''}
                    </div>
                    {{-- Action buttons --}}
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 flex flex-col sm:flex-row items-center gap-2 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                        ${sertifikatBtn}
                        <button onclick="deleteDiklat(${d.id}, '${d.nama_diklat.replace(/'/g, "\\'")}', ${this.currentGuruId})"
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-all shadow-sm"
                            title="Hapus">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            `;
        },
    }));
});

// ===== Global helpers =====
function deleteDiklat(diklatId, nama, guruId) {
    if (!confirm(`Yakin hapus riwayat diklat:\n"${nama}"?`)) return;

    fetch(`/operator/data-guru/${guruId}/diklat/${diklatId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) {
            const el = document.querySelector(`[data-diklat-id="${diklatId}"]`);
            if (el) {
                el.style.opacity = '0';
                el.style.transform = 'translateY(10px)';
                el.style.transition = 'all 0.3s ease';
                setTimeout(() => el.remove(), 300);
            }
            // Reload list (after animation)
            const modalEl = document.getElementById('modalDiklatGuru');
            if (modalEl?._x_dataStack?.[0]) {
                setTimeout(() => modalEl._x_dataStack[0].loadDiklats(guruId), 350);
            }
        }
    });
}
</script>
@endpush