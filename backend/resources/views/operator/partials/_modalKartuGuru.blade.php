{{-- resources/views/operator/partials/_modalKartuGuru.blade.php --}}
<div id="modalKartuGuru"
    class="fixed inset-0 z-[80] hidden flex items-center justify-center bg-slate-900/80 backdrop-blur-md overflow-y-auto p-4 sm:p-6 transition-all duration-300 ">

    {{-- Font & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/@tabler/icons-webfont@latest/tabler-icons.min.css" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .material-symbols-outlined.fill-icon {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        /* ── Field Grid ── */
        .kartu-field-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            border-radius: 1.25rem;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            background: #ffffff;
        }

        .dark .kartu-field-grid {
            border-color: #1e293b;
            background: #0f172a;
        }

        .kartu-field-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 13px 16px;
            border-bottom: 1px solid #f1f5f9;
            border-right: 1px solid #f1f5f9;
            transition: background 0.15s;
        }

        .dark .kartu-field-item {
            border-bottom-color: #1e293b;
            border-right-color: #1e293b;
        }

        .kartu-field-item:hover {
            background: #f8fafc;
        }

        .dark .kartu-field-item:hover {
            background: #1e293b;
        }

        /* remove right border on even items (right column) */
        .kartu-field-item:nth-child(even) {
            border-right: none;
        }

        /* full-width items */
        .kartu-field-item.full {
            grid-column: 1 / -1;
            border-right: none;
        }

        /* section divider row */
        .kartu-field-divider {
            grid-column: 1 / -1;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 16px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            border-right: none;
        }

        .dark .kartu-field-divider {
            background: #0f172a;
            border-bottom-color: #1e293b;
        }

        .kartu-field-divider i {
            font-size: 13px;
            color: #10b981;
        }

        .kartu-field-divider span {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #94a3b8;
        }

        /* icon box */
        .kartu-field-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: #f0fdf4;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .dark .kartu-field-icon {
            background: #064e3b22;
        }

        .kartu-field-icon i {
            font-size: 14px;
            color: #10b981;
        }

        /* label + value */
        .kartu-field-label {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #94a3b8;
            margin: 0 0 3px;
            line-height: 1;
        }

        .kartu-field-value {
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            margin: 0;
            line-height: 1.4;
            word-break: break-word;
        }

        .dark .kartu-field-value {
            color: #f1f5f9;
        }

        .kartu-field-value.email {
            color: #059669;
        }

        /* education level badge */
        .kartu-edu-badge {
            display: inline-block;
            padding: 1px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-right: 4px;
            vertical-align: middle;
        }

        .kartu-edu-badge.s1 {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .kartu-edu-badge.s2 {
            background: #ede9fe;
            color: #6d28d9;
        }

        .kartu-edu-badge.s3 {
            background: #fef3c7;
            color: #92400e;
        }

        .kartu-edu-badge.d3 {
            background: #d1fae5;
            color: #065f46;
        }
    </style>

    <div
        class="relative w-full max-w-7xl bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden flex flex-col max-h-[92vh] border border-slate-200 dark:border-slate-800 animate-up">

        {{-- Glassmorphic Header --}}
        <header
            class="sticky top-0 z-30 bg-white/70 dark:bg-slate-900/70 backdrop-blur-2xl border-b border-slate-100 dark:border-slate-800 px-6 sm:px-10 py-5 flex justify-between items-center shadow-sm">
            <div class="flex items-center gap-4">
                <div
                    class="h-12 w-12 rounded-xl bg-gradient-to-br from-emerald-900 to-emerald-600 flex items-center justify-center text-white shadow-md ring-1 ring-emerald-500/20">
                    <span class="material-symbols-outlined text-2xl fill-icon">shield_person</span>
                </div>
                <div>
                    <h1
                        class="text-lg sm:text-xl font-black text-slate-800 dark:text-white leading-none tracking-tight uppercase">
                        PROFIL IDENTITAS PENDIDIK</h1>
                    <p class="text-[11px] text-slate-400 mt-1 font-bold uppercase tracking-widest">MI Nurul Huda 3 ·
                        Siakad System</p>
                </div>
            </div>
            <button @click="closeKartuGuru()"
                class="h-10 w-10 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-center text-slate-400 transition-all hover:scale-105 active:scale-95">
                <span class="material-symbols-outlined">close</span>
            </button>
        </header>

        {{-- Main Content Scrollable Area --}}
        <div class="overflow-hidden flex-1 min-h-0 p-6 sm:p-10 bg-slate-50/50 dark:bg-slate-900/50 flex flex-col">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 flex-1 min-h-0">

                {{-- Left Column (Identity Card) --}}
                <aside class="lg:col-span-4 flex flex-col gap-6 overflow-y-auto custom-scrollbar pr-2 pb-6 h-full min-h-0">
                    <div
                        class="bg-white dark:bg-slate-800 rounded-[2.5rem] border border-slate-200 dark:border-slate-700 shadow-xl shadow-slate-200/50 dark:shadow-none overflow-hidden relative flex flex-col shrink-0">
                        <div
                            class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none">
                        </div>
                        <div
                            class="absolute -bottom-24 -left-24 w-64 h-64 bg-emerald-600/5 rounded-full blur-3xl pointer-events-none">
                        </div>

                        <div class="p-8 flex flex-col items-center text-center relative z-10 flex-1">
                            {{-- Photo --}}
                            <div class="relative mb-6 group">
                                <div
                                    class="w-40 h-40 rounded-full border-[6px] border-white dark:border-slate-900 shadow-2xl overflow-hidden bg-slate-100 flex items-center justify-center relative z-10 transition-transform duration-500 group-hover:scale-105">
                                    <img id="kartu_foto" alt="Foto Pendidik" class="w-full h-full object-cover"
                                        src="">
                                </div>
                                <div
                                    class="absolute bottom-2 right-2 z-20 h-9 w-9 bg-gradient-to-br from-emerald-600 to-emerald-900 rounded-full border-[3px] border-white dark:border-slate-900 flex items-center justify-center shadow-lg">
                                    <span
                                        class="material-symbols-outlined text-[18px] text-white font-bold">check</span>
                                </div>
                                <div
                                    class="absolute top-2 left-2 z-20 h-4 w-4 bg-emerald-400 rounded-full border-2 border-white dark:border-slate-900 shadow-lg animate-pulse">
                                </div>
                            </div>

                            {{-- Core Info --}}
                            <h2 id="kartu_nama_lengkap"
                                class="text-2xl font-black text-slate-800 dark:text-white mb-2 tracking-tight">—</h2>
                            <p id="kartu_nip"
                                class="font-mono text-[11px] text-slate-500 bg-slate-100 dark:bg-slate-900 px-4 py-1.5 rounded-xl mb-6 border border-slate-200 dark:border-slate-700 shadow-sm font-bold uppercase tracking-widest">
                                —</p>

                            {{-- Mini Stat Cards --}}
                            <div class="grid grid-cols-2 gap-3 w-full mb-6">
                                <div
                                    class="bg-slate-50 dark:bg-slate-900/50 rounded-2xl p-4 border border-slate-200 dark:border-slate-700 flex flex-col items-center shadow-sm">
                                    <span
                                        class="text-[9px] text-slate-400 uppercase tracking-[0.2em] mb-1 font-black">Status</span>
                                    <span id="kartu_status_aktif"
                                        class="text-[11px] text-emerald-600 font-black uppercase tracking-wide">—</span>
                                </div>
                                <div
                                    class="bg-slate-50 dark:bg-slate-900/50 rounded-2xl p-4 border border-slate-200 dark:border-slate-700 flex flex-col items-center shadow-sm">
                                    <span
                                        class="text-[9px] text-slate-400 uppercase tracking-[0.2em] mb-1 font-black">Golongan</span>
                                    <span id="kartu_golongan"
                                        class="text-[11px] text-slate-800 dark:text-white font-black uppercase tracking-wide">—</span>
                                </div>
                            </div>

                            {{-- Attendance & Performance Module --}}
                            <div
                                class="w-full mt-auto p-5 bg-emerald-50/50 dark:bg-emerald-500/5 rounded-3xl border border-emerald-100 dark:border-emerald-500/10 flex flex-col gap-4">

                                {{-- Kehadiran --}}
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center text-emerald-600">
                                            <span
                                                class="material-symbols-outlined text-[18px] fill-icon">event_available</span>
                                        </div>
                                        <span
                                            class="text-[10px] text-emerald-700 dark:text-emerald-400 uppercase tracking-widest font-black">Kehadiran</span>
                                    </div>
                                    <span id="kartu_persen_kehadiran_label"
                                        class="text-xs font-black text-emerald-700">—</span>
                                </div>
                                <div
                                    class="h-2 w-full bg-emerald-100 dark:bg-emerald-900/30 rounded-full overflow-hidden">
                                    <div id="kartu_kehadiran_bar"
                                        class="h-full bg-emerald-500 rounded-full shadow-[0_0_10px_rgba(16,185,129,0.5)] transition-all duration-700"
                                        style="width:0%"></div>
                                </div>

                                {{-- Beban Mengajar --}}
                                <div
                                    class="flex items-center justify-between mt-1 pt-4 border-t border-emerald-100 dark:border-emerald-500/10">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-emerald-900 flex items-center justify-center text-white">
                                            <span
                                                class="material-symbols-outlined text-[18px] fill-icon">menu_book</span>
                                        </div>
                                        <span
                                            class="text-[10px] text-slate-500 uppercase tracking-widest font-black">Beban
                                            Mengajar</span>
                                    </div>
                                    <span id="kartu_total_jp"
                                        class="text-xs font-black text-emerald-900 dark:text-emerald-400 bg-white dark:bg-slate-900 px-3 py-1 rounded-lg shadow-sm">—
                                        JP</span>
                                </div>
                            </div>
                            {{-- QR Code Area --}}
                            <div class="w-full pt-8 mt-8 border-t border-slate-100 dark:border-slate-700">
                                <div
                                    class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-700 p-5 shadow-sm flex flex-col items-center gap-4 relative overflow-hidden group">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent pointer-events-none">
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span id="kartu_verified_icon"
                                            class="material-symbols-outlined text-[18px] fill-icon text-slate-300">verified</span>
                                        <span id="kartu_verified_label"
                                            class="text-[10px] uppercase tracking-widest font-black text-slate-400">Belum
                                            Diverifikasi</span>
                                    </div>
                                    <div class="p-3 bg-white rounded-2xl border border-slate-100 shadow-inner mt-1">
                                        <img id="kartu_qr_code" src=""
                                            class="w-20 h-20 grayscale hover:grayscale-0 transition-all duration-300">
                                    </div>
                                    <div class="text-center">
                                        <h4
                                            class="text-[10px] text-slate-800 dark:text-white uppercase tracking-[0.2em] font-black mb-1">
                                            V-Card Digital</h4>
                                        <p class="text-[9px] text-slate-400 uppercase font-bold tracking-widest">Pindai
                                            & Simpan Kontak</p>
                                        <div id="kartu_audit_trail"
                                            class="hidden w-full border-t border-slate-100 dark:border-slate-800 pt-3 mt-1">
                                            <p
                                                class="text-[9px] text-slate-400 uppercase font-bold tracking-widest text-center">
                                                Diverifikasi oleh</p>
                                            <p id="kartu_verified_by"
                                                class="text-[10px] font-black text-emerald-700 text-center mt-1">—</p>
                                            <p id="kartu_verified_time" class="text-[9px] text-slate-400 text-center">—
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Academic Banner Module --}}
                    <div
                        class="rounded-[2rem] bg-gradient-to-br from-emerald-950 to-emerald-800 p-8 shadow-xl text-white relative overflow-hidden border border-emerald-800 shrink-0">
                        <div class="absolute inset-0 opacity-10 pointer-events-none">
                            <div
                                class="absolute -right-20 -top-20 w-64 h-64 rounded-full border-[30px] border-emerald-400">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-8 relative z-10">
                            <div class="flex items-center gap-4 group">
                                <div
                                    class="bg-white/10 p-3 rounded-xl backdrop-blur-md border border-white/10 group-hover:bg-white/20 transition-all shadow-lg">
                                    <span class="material-symbols-outlined text-emerald-400">menu_book</span>
                                </div>
                                <div>
                                    <p class="text-[9px] text-emerald-300/80 uppercase tracking-widest font-black">Mata
                                        Pelajaran</p>
                                    <p id="kartu_mapel" class="text-sm font-black text-white mt-0.5">—</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 group">
                                <div
                                    class="bg-white/10 p-3 rounded-xl backdrop-blur-md border border-white/10 group-hover:bg-white/20 transition-all shadow-lg">
                                    <span class="material-symbols-outlined text-emerald-400">class</span>
                                </div>
                                <div>
                                    <p class="text-[9px] text-emerald-300/80 uppercase tracking-widest font-black">Tugas
                                        Kelas</p>
                                    <p id="kartu_kelas" class="text-sm font-black text-white mt-0.5">—</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 group">
                                <div
                                    class="bg-white/10 p-3 rounded-xl backdrop-blur-md border border-white/10 group-hover:bg-white/20 transition-all shadow-lg">
                                    <span class="material-symbols-outlined text-emerald-400">history</span>
                                </div>
                                <div>
                                    <p class="text-[9px] text-emerald-300/80 uppercase tracking-widest font-black">Masa
                                        Bakti</p>
                                    <p id="kartu_tahun_mengajar" class="text-sm font-black text-white mt-0.5">—</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 group">
                                <div
                                    class="bg-white/10 p-3 rounded-xl backdrop-blur-md border border-white/10 group-hover:bg-white/20 transition-all shadow-lg">
                                    <span class="material-symbols-outlined text-emerald-400">workspace_premium</span>
                                </div>
                                <div>
                                    <p class="text-[9px] text-emerald-300/80 uppercase tracking-widest font-black">
                                        Sertifikasi</p>
                                    <p id="kartu_no_sertifikasi" class="text-sm font-black text-white mt-0.5">—</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                {{-- Right Column (Modular Content) --}}
                <main class="md:col-span-1 lg:col-span-8 flex flex-col h-full overflow-hidden space-y-5 min-h-0">

                    {{-- Name & Jabatan Header --}}
                    <div class="shrink-0">
                        <h2 id="kartu_nama_lengkap"
                            class="text-3xl sm:text-4xl font-extrabold tracking-tighter leading-tight break-words text-[#003527] font-['Manrope',_sans-serif]">
                            -</h2>
                        <p id="kartu_jabatan_main"
                            class="text-sm font-medium mt-1 flex items-center gap-2 text-[#006c49]">
                            - <span class="material-symbols-outlined text-[16px] text-[#006c49]">verified_user</span>
                        </p>
                    </div>

                    {{-- ════════════════════════════════════════
                         FIELD GRID  (new style)
                    ════════════════════════════════════════ --}}
                    <!-- RIGHT CONTENT MODERN TAB SECTION -->
                    <div class="flex-1 flex flex-col overflow-hidden min-h-0">

                        <!-- TAB NAVIGATION -->
                        <div class="mb-5 px-1 shrink-0">
                            <div
                                class="bg-slate-100/80 rounded-2xl p-1.5 flex items-center gap-1 border border-slate-200 shadow-inner">

                                <button type="button" class="kartu-tab-btn active" data-target="tab-pribadi">
                                    <span class="material-symbols-outlined text-[18px]">person</span>
                                    <span>Profil Pribadi</span>
                                </button>

                                <button type="button" class="kartu-tab-btn" data-target="tab-kepegawaian">
                                    <span class="material-symbols-outlined text-[18px]">badge</span>
                                    <span>Kepegawaian</span>
                                </button>

                                <button type="button" class="kartu-tab-btn" data-target="tab-sertifikasi">
                                    <span class="material-symbols-outlined text-[18px]">workspace_premium</span>
                                    <span>Sertifikasi</span>
                                </button>

                                <button type="button" class="kartu-tab-btn" data-target="tab-keuangan">
                                    <span class="material-symbols-outlined text-[18px]">account_balance_wallet</span>
                                    <span>Keuangan</span>
                                </button>
                            </div>
                        </div>

                        <!-- TAB CONTENT -->
                        <div class="flex-1 overflow-y-auto pr-2 kartu-scroll pb-6 min-h-0">
                            <div>

                            <!-- ===================================================== -->
                            <!-- TAB PRIBADI -->
                            <!-- ===================================================== -->
                            <div class="kartu-tab-content active" id="tab-pribadi">

                                <div class="kartu-modern-section">
                                    <div class="kartu-modern-header">
                                        <div class="kartu-modern-icon emerald">
                                            <span class="material-symbols-outlined text-[20px]">person</span>
                                        </div>
                                        <div>
                                            <h3>Data Pribadi</h3>
                                            <p>Informasi identitas utama pendidik</p>
                                        </div>
                                    </div>

                                    <div class="kartu-modern-grid">

                                        <div class="kartu-modern-item">
                                            <span class="label">NIK</span>
                                            <span class="value" id="kartu_nik">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Nomor KK</span>
                                            <span class="value" id="kartu_no_kk">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Jenis Kelamin</span>
                                            <span class="value" id="kartu_jk">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Agama</span>
                                            <span class="value" id="kartu_agama">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Tempat Lahir</span>
                                            <span class="value" id="kartu_tempat_lahir">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Tanggal Lahir</span>
                                            <span class="value" id="kartu_tgl_lahir">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Golongan Darah</span>
                                            <span class="value" id="kartu_golongan_darah">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Ibu Kandung</span>
                                            <span class="value" id="kartu_nama_ibu_kandung">—</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="kartu-modern-section">
                                    <div class="kartu-modern-header">
                                        <div class="kartu-modern-icon emerald">
                                            <span class="material-symbols-outlined text-[20px]">school</span>
                                        </div>
                                        <div>
                                            <h3>Data Pendidikan</h3>
                                            <p>Riwayat pendidikan terakhir</p>
                                        </div>
                                    </div>

                                    <div class="kartu-modern-grid">

                                        <div class="kartu-modern-item">
                                            <span class="label">Pendidikan</span>
                                            <span class="value" id="kartu_pendidikan">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Jurusan</span>
                                            <span class="value" id="kartu_jurusan">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Instansi</span>
                                            <span class="value" id="kartu_kampus">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Tahun Lulus</span>
                                            <span class="value" id="kartu_tahun_lulus">—</span>
                                        </div>

                                        <div class="kartu-modern-item full">
                                            <span class="label">No. Ijazah</span>
                                            <span class="value" id="kartu_no_ijazah">—</span>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <!-- ===================================================== -->
                            <!-- TAB KEPEGAWAIAN -->
                            <!-- ===================================================== -->
                            <div class="kartu-tab-content" id="tab-kepegawaian">

                                <div class="kartu-modern-section">

                                    <div class="kartu-modern-header">
                                        <div class="kartu-modern-icon emerald">
                                            <span class="material-symbols-outlined text-[20px]">badge</span>
                                        </div>
                                        <div>
                                            <h3>Data Kepegawaian</h3>
                                            <p>Status dan administrasi pegawai</p>
                                        </div>
                                    </div>

                                    <div class="kartu-modern-grid">

                                        <div class="kartu-modern-item">
                                            <span class="label">NUPTK</span>
                                            <span class="value" id="kartu_nuptk">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Status Kepegawaian</span>
                                            <span class="value" id="kartu_status_kepegawaian">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">TMT PNS</span>
                                            <span class="value" id="kartu_tmt_pns">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">TMT GTY</span>
                                            <span class="value" id="kartu_tmt_gty">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Tanggal Bergabung</span>
                                            <span class="value" id="kartu_tanggal_bergabung">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">TMT Jabatan</span>
                                            <span class="value" id="kartu_tmt_jabatan">—</span>
                                        </div>

                                        <div class="kartu-modern-item full">
                                            <span class="label">SK Pengangkatan</span>
                                            <span class="value" id="kartu_sk_pengangkatan">—</span>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <!-- ===================================================== -->
                            <!-- TAB SERTIFIKASI -->
                            <!-- ===================================================== -->
                            <div class="kartu-tab-content" id="tab-sertifikasi">

                                <div class="kartu-modern-section">

                                    <div class="kartu-modern-header">
                                        <div class="kartu-modern-icon emerald">
                                            <span class="material-symbols-outlined text-[20px]">workspace_premium</span>
                                        </div>
                                        <div>
                                            <h3>Data Sertifikasi</h3>
                                            <p>Informasi sertifikasi guru</p>
                                        </div>
                                    </div>

                                    <div class="kartu-modern-grid">

                                        <div class="kartu-modern-item">
                                            <span class="label">No Sertifikasi</span>
                                            <span class="value" id="kartu_no_sertifikasi_field">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">NRG</span>
                                            <span class="value" id="kartu_nrg">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Bidang Sertifikasi</span>
                                            <span class="value" id="kartu_bidang_sertifikasi">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Jenis Sertifikasi</span>
                                            <span class="value" id="kartu_jenis_sertifikasi">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Tahun Sertifikasi</span>
                                            <span class="value" id="kartu_tahun_sertifikasi">—</span>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <!-- ===================================================== -->
                            <!-- TAB KEUANGAN -->
                            <!-- ===================================================== -->
                            <div class="kartu-tab-content" id="tab-keuangan">

                                <div class="kartu-modern-section">

                                    <div class="kartu-modern-header">
                                        <div class="kartu-modern-icon emerald">
                                            <span class="material-symbols-outlined text-[20px]">account_balance_wallet</span>
                                        </div>
                                        <div>
                                            <h3>Data Keuangan</h3>
                                            <p>Informasi payroll dan rekening</p>
                                        </div>
                                    </div>

                                    <div class="kartu-modern-grid">

                                        <div class="kartu-modern-item">
                                            <span class="label">NPWP</span>
                                            <span class="value" id="kartu_npwp">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Gaji Pokok</span>
                                            <span class="value" id="kartu_gaji_pokok">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Tunjangan</span>
                                            <span class="value" id="kartu_tunjangan_fungsional">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Nomor Rekening</span>
                                            <span class="value" id="kartu_rekening">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Nama Bank</span>
                                            <span class="value" id="kartu_nama_bank">—</span>
                                        </div>

                                        <div class="kartu-modern-item">
                                            <span class="label">Cabang Bank</span>
                                            <span class="value" id="kartu_cabang_bank">—</span>
                                        </div>

                                        <div class="kartu-modern-item full">
                                            <span class="label">Atas Nama</span>
                                            <span class="value" id="kartu_atas_nama_rekening">—</span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            </div>

                            {{-- END FIELD GRID --}}

                            {{-- Riwayat Diklat & Kepangkatan --}}
                            <div class="grid grid-cols-1 gap-6 items-start pt-6 mt-6 border-t border-slate-200 dark:border-slate-700">
                        {{-- ===== RIWAYAT JABATAN ===== --}}
                        <section id="kartu_jabatan_section"
                            class="xl:col-span-2 bg-white dark:bg-slate-800/50 rounded-3xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden flex flex-col">
                            <div
                                class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-emerald-700 to-emerald-500 rounded-l-3xl">
                            </div>
                            <div class="pl-4 flex-1 flex flex-col">
                                <div
                                    class="flex items-center gap-3 mb-5 pb-3 border-b border-slate-100 dark:border-slate-700">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[20px]">work_history</span>
                                    </div>
                                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.18em]">
                                        Riwayat Jabatan</h3>
                                </div>
                                <div id="kartu_jabatan_list"
                                    class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3 flex-1"></div>
                                <div id="kartu_jabatan_empty" class="hidden py-6 text-center">
                                    <p class="text-sm text-slate-400 italic">Belum ada data riwayat jabatan.</p>
                                </div>
                            </div>
                        </section>
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                            {{-- ===== RIWAYAT DIKLAT ===== --}}
                            <section id="kartu_diklat_section"
                                class="bg-white dark:bg-slate-800/50 rounded-3xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden flex flex-col">
                                <div
                                    class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-emerald-700 to-emerald-500 rounded-l-3xl">
                                </div>
                                <div class="pl-4 flex-1 flex flex-col">
                                    <div
                                        class="flex items-center gap-3 mb-6 pb-3 border-b border-slate-100 dark:border-slate-700">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[20px]">school</span>
                                        </div>
                                        <div>
                                            <h3
                                                class="text-[10px] font-black text-slate-400 uppercase tracking-[0.18em]">
                                                Riwayat Diklat</h3>
                                            <p id="kartu_diklat_stats"
                                                class="text-[11px] text-slate-500 font-medium mt-0.5">— Kegiatan</p>
                                        </div>
                                    </div>
                                    <div id="kartu_diklat_list" class="space-y-4 flex-1">
                                        <div class="flex gap-4 relative group">
                                            <div class="flex flex-col items-center">
                                                <div
                                                    class="w-3.5 h-3.5 rounded-full bg-emerald-500 z-10 mt-1 shrink-0 shadow-[0_0_0_4px_white] group-hover:scale-125 transition-transform">
                                                </div>
                                                <div class="w-px flex-1 bg-slate-100 mt-1"></div>
                                            </div>
                                            <div
                                                class="flex-1 bg-slate-50 dark:bg-slate-900/50 rounded-2xl p-4 border border-slate-200 dark:border-slate-700 flex flex-col gap-3 hover:border-emerald-200 hover:shadow-sm hover:-translate-y-0.5 transition-all">
                                                <div>
                                                    <p
                                                        class="font-bold text-[14px] text-slate-800 dark:text-white leading-tight">
                                                        Diklat Implementasi Kurikulum Merdeka</p>
                                                    <p class="text-[12px] text-slate-400 mt-1">Penyelenggara: kemenag
                                                    </p>
                                                </div>
                                                <div
                                                    class="flex items-center justify-between border-t border-slate-100 dark:border-slate-700 pt-2">
                                                    <span
                                                        class="px-2.5 py-1 bg-emerald-50 text-emerald-700 text-[11px] rounded-md font-bold uppercase tracking-wider">76
                                                        JP</span>
                                                    <span
                                                        class="text-[12px] text-slate-400 font-bold flex items-center gap-1.5 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-md">
                                                        <span
                                                            class="material-symbols-outlined text-[14px]">calendar_today</span>
                                                        2026
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="kartu_diklat_empty" class="hidden py-8 text-center">
                                        <p class="text-sm text-slate-400 italic">Belum ada data diklat.</p>
                                    </div>
                                </div>
                            </section>

                            {{-- ===== RIWAYAT KEPANGKATAN ===== --}}
                            <section id="kartu_inpassing_section"
                                class="bg-slate-50 dark:bg-slate-900/50 rounded-3xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden flex flex-col">
                                <div
                                    class="absolute -right-8 -top-8 w-32 h-32 bg-emerald-500/5 rounded-full blur-2xl pointer-events-none">
                                </div>
                                <div
                                    class="flex items-center gap-3 mb-6 pb-3 border-b border-slate-100 dark:border-slate-700 relative z-10">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-500 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[20px]">work_history</span>
                                    </div>
                                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.18em]">
                                        Riwayat
                                        Kepangkatan</h3>
                                </div>
                                <div id="kartu_inpassing_content"
                                    class="space-y-4 relative before:absolute before:inset-0 before:ml-4 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-emerald-200 before:via-slate-200 before:to-transparent z-10 flex-1">
                                    <div class="relative flex items-start gap-4 group">
                                        <div
                                            class="flex items-center justify-center w-8 h-8 rounded-full border-4 border-slate-50 dark:border-slate-900 bg-emerald-600 text-white shrink-0 shadow-md z-10 mt-1 group-hover:scale-110 transition-transform">
                                            <span
                                                class="material-symbols-outlined text-[14px] fill-icon">verified</span>
                                        </div>
                                        <div
                                            class="flex-1 p-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm group-hover:shadow-md group-hover:border-emerald-200 transition-all">
                                            <div class="flex items-start justify-between gap-2 mb-3">
                                                <div>
                                                    <span
                                                        class="text-[15px] font-bold text-[#003527] dark:text-emerald-300 block leading-tight">Guru
                                                        Utama</span>
                                                    <p class="text-[12px] text-slate-400 mt-0.5">TMT: 30 May 2026</p>
                                                </div>
                                                <span
                                                    class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md uppercase tracking-wider whitespace-nowrap">Gol.
                                                    IV/D</span>
                                            </div>
                                            <div class="pt-2 border-t border-slate-100 dark:border-slate-700">
                                                <p
                                                    class="font-mono text-[11px] text-slate-500 bg-slate-50 dark:bg-slate-900 px-2 py-1 rounded-md inline-flex items-center gap-1.5 border border-slate-200 dark:border-slate-700">
                                                    <span
                                                        class="material-symbols-outlined text-[12px]">description</span>
                                                    SK: 892389893/kw
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="kartu_inpassing_empty" class="hidden py-8 text-center">
                                    <p class="text-sm text-slate-400 italic">Belum ada data inpassing.</p>
                                </div>
                            </section>
                        </div>
                    </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        {{-- Floating Enterprise Action Bar (Footer) --}}
        <footer
            class="sticky bottom-0 z-40 bg-white/85 dark:bg-slate-900/85 backdrop-blur-xl border-t border-slate-200 dark:border-slate-800 px-6 sm:px-8 py-4 flex flex-col sm:flex-row justify-between items-center gap-4 shadow-[0_-4px_20px_rgba(0,0,0,0.02)]">
            <div
                class="flex items-center gap-3 bg-slate-50/50 dark:bg-slate-800/50 px-3 py-2 rounded-xl border border-slate-200/60 dark:border-slate-700">
                <div
                    class="bg-white dark:bg-slate-900 rounded-lg p-1.5 shadow-sm border border-slate-100 dark:border-slate-700">
                    <span class="material-symbols-outlined text-[18px] text-emerald-600">qr_code_2</span>
                </div>
                <div class="hidden sm:block pr-2">
                    <div class="flex items-center gap-1">
                        <span
                            class="material-symbols-outlined text-[14px] text-emerald-500 fill-icon">verified_user</span>
                        <p
                            class="text-[10px] font-bold text-emerald-700 dark:text-emerald-400 uppercase tracking-wider leading-none">
                            Verified Identity</p>
                    </div>
                    <p class="text-[9px] text-slate-400 font-medium mt-1 uppercase tracking-widest">Secure System
                        Access</p>
                </div>
            </div>

            <div class="flex items-center gap-2.5 flex-1 justify-end flex-wrap w-full sm:w-auto">
                <button @click="closeKartuGuru()"
                    class="px-3 py-2.5 text-[11px] font-bold text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 uppercase tracking-wider transition-colors">
                    Tutup
                </button>
                <div class="flex items-center gap-2 border-r border-slate-200 dark:border-slate-700 pr-2 mr-1">
                    <button @click="openDokumenModal(currentGuruForModal)"
                        class="group px-4 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-slate-900 transition-all flex items-center gap-2 shadow-sm">
                        <span
                            class="material-symbols-outlined text-[16px] text-slate-400 group-hover:text-slate-600 dark:group-hover:text-white transition-colors">folder_open</span>
                        <span class="hidden md:inline">Berkas Digital</span>
                        <span class="md:hidden">Berkas</span>
                    </button>
                    <button @click="openDiklatModal(currentGuruForModal)"
                        class="group px-4 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-slate-900 transition-all flex items-center gap-2 shadow-sm">
                        <span
                            class="material-symbols-outlined text-[16px] text-slate-400 group-hover:text-emerald-600 transition-colors">history_edu</span>
                        <span class="hidden md:inline">Diklat</span>
                        <span class="md:hidden">Diklat</span>
                    </button>
                    <button @click="openInpassingModal(currentGuruForModal)"
                        class="group px-4 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-slate-900 transition-all flex items-center gap-2 shadow-sm">
                        <span
                            class="material-symbols-outlined text-[16px] text-slate-400 group-hover:text-blue-600 transition-colors">work_history</span>
                        <span class="hidden md:inline">Inpassing</span>
                        <span class="md:hidden">Inpassing</span>
                    </button>
                </div>
                <button id="btnUbahDataKartu"
                    class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-wider 
    text-white bg-gradient-to-r from-[#003527] to-[#006c49] backdrop-blur-md shadow-lg
    hover:shadow-[0_8px_20px_-4px_rgba(0,53,39,0.4)]
    hover:-translate-y-0.5 active:scale-95 transition-all duration-300 
    flex items-center gap-2 border border-white/10">

                    <span class="material-symbols-outlined text-[16px] fill-icon">
                        edit_note
                    </span>

                    Ubah Profil
                </button>
            </div>
        </footer>
    </div>
</div>

<style>
    .kartu-tab-btn {
        flex: 1;
        height: 52px;
        border: none;
        border-radius: 14px;
        background: transparent;
        color: #64748b;
        font-size: 13px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: .25s;
    }

    .kartu-tab-btn.active {
        background: linear-gradient(135deg, #003527, #006c49);
        color: white;
        box-shadow: 0 4px 14px rgba(0, 0, 0, .12);
    }

    .kartu-tab-content {
        display: none;
        animation: fadeTab .25s ease;
    }

    .kartu-tab-content.active {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    @keyframes fadeTab {
        from {
            opacity: 0;
            transform: translateY(5px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .kartu-modern-section {
        background: white;
        border-radius: 28px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .04);
    }

    .kartu-modern-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #e2e8f0;
    }

    .kartu-modern-header h3 {
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .kartu-modern-header p {
        font-size: 12px;
        color: #64748b;
        margin: 2px 0 0;
    }

    .kartu-modern-icon {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .kartu-modern-icon.emerald {
        background: #dcfce7;
        color: #059669;
    }

    .kartu-modern-icon.blue {
        background: #dbeafe;
        color: #2563eb;
    }

    .kartu-modern-icon.purple {
        background: #ede9fe;
        color: #7c3aed;
    }

    .kartu-modern-icon.amber {
        background: #fef3c7;
        color: #d97706;
    }

    .kartu-modern-icon.rose {
        background: #ffe4e6;
        color: #e11d48;
    }

    .kartu-modern-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 16px;
    }

    .kartu-modern-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 18px;
        display: flex;
        flex-direction: column;
        transition: .25s;
    }

    .kartu-modern-item:hover {
        transform: translateY(-2px);
        border-color: #cbd5e1;
        box-shadow: 0 8px 20px rgba(15, 23, 42, .05);
    }

    .kartu-modern-item.full {
        grid-column: 1/-1;
    }

    .kartu-modern-item .label {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: #64748b;
        margin-bottom: 8px;
    }

    .kartu-modern-item .value {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.5;
    }

    .kartu-scroll::-webkit-scrollbar {
        width: 7px;
    }

    .kartu-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 20px;
    }
</style>

<script>
    document.querySelectorAll('.kartu-tab-btn').forEach(button => {

        button.addEventListener('click', function() {

            document.querySelectorAll('.kartu-tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            document.querySelectorAll('.kartu-tab-content').forEach(content => {
                content.classList.remove('active');
            });

            this.classList.add('active');

            document
                .getElementById(this.dataset.target)
                .classList.add('active');

        });

    });
</script>
<script>
    function renderInpassingList(items) {
        const content = document.getElementById('kartu_inpassing_content');
        const empty = document.getElementById('kartu_inpassing_empty');
        if (!content || !empty) return;
        content.innerHTML = '';

        if (!items || items.length === 0) {
            content.classList.add('hidden');
            empty.classList.remove('hidden');
            return;
        }

        content.classList.remove('hidden');
        empty.classList.add('hidden');

        items.forEach((item, index) => {
            const isActive = index === 0;
            if (isActive) {
                content.innerHTML += `
            <div class="relative flex items-start gap-4 group">
                <div class="flex items-center justify-center w-8 h-8 rounded-full border-4 border-slate-50 bg-emerald-600 text-white shrink-0 shadow-md z-10 mt-1 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-[14px] fill-icon">verified</span>
                </div>
                <div class="flex-1 p-4 rounded-2xl border border-slate-200 bg-white shadow-sm group-hover:shadow-md group-hover:border-emerald-200 transition-all">
                    <div class="flex items-start justify-between gap-2 mb-3">
                        <div>
                            <span class="text-[15px] font-bold text-[#003527] block leading-tight">${item.nama_pangkat}</span>
                            <p class="text-[12px] text-slate-400 mt-0.5">TMT: ${item.tmt}</p>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md uppercase tracking-wider whitespace-nowrap">Gol. ${item.golongan}</span>
                    </div>
                    <div class="pt-2 border-t border-slate-100">
                        <p class="font-mono text-[11px] text-slate-500 bg-slate-50 px-2 py-1 rounded-md inline-flex items-center gap-1.5 border border-slate-200">
                            <span class="material-symbols-outlined text-[12px]">description</span>
                            SK: ${item.no_sk}
                        </p>
                    </div>
                </div>
            </div>`;
            } else {
                content.innerHTML += `
            <div class="relative flex items-start gap-4 group">
                <div class="flex items-center justify-center w-8 h-8 rounded-full border-4 border-slate-50 bg-slate-200 text-slate-500 shrink-0 shadow-sm z-10 mt-1 group-hover:bg-slate-300 transition-colors">
                    <span class="material-symbols-outlined text-[14px]">history</span>
                </div>
                <div class="flex-1 p-4 rounded-2xl border border-slate-200 bg-white/60 group-hover:bg-white transition-colors">
                    <div class="flex items-start justify-between gap-2 mb-3">
                        <div>
                            <span class="text-[15px] font-bold text-slate-500 block leading-tight">${item.nama_pangkat}</span>
                            <p class="text-[12px] text-slate-400 mt-0.5">TMT: ${item.tmt}</p>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-md uppercase tracking-wider whitespace-nowrap border border-slate-200">Gol. ${item.golongan}</span>
                    </div>
                    <div class="pt-2 border-t border-slate-100">
                        <p class="font-mono text-[11px] text-slate-400 bg-slate-50 px-2 py-1 rounded-md inline-flex items-center gap-1.5 border border-slate-200">
                            <span class="material-symbols-outlined text-[12px]">description</span>
                            SK: ${item.no_sk}
                        </p>
                    </div>
                </div>
            </div>`;
            }
        });
    }
</script>
