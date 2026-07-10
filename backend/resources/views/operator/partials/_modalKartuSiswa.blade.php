{{-- resources/views/operator/partials/_modalKartuSiswa.blade.php --}}
<div id="modalKartuSiswa"
    class="fixed inset-0 z-[80] hidden flex items-center justify-center bg-slate-900/80 backdrop-blur-md overflow-y-auto p-4 sm:p-6 transition-all duration-300">

    {{-- Font & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/@tabler/icons-webfont@latest/tabler-icons.min.css" />

    <div
        class="relative w-full max-w-7xl bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden flex flex-col max-h-[92vh] border border-slate-200 dark:border-slate-800 animate-up">

        {{-- Glassmorphic Header --}}
        <header
            class="sticky top-0 z-30 bg-white/70 dark:bg-slate-900/70 backdrop-blur-2xl border-b border-slate-100 dark:border-slate-800 px-6 sm:px-10 py-5 flex justify-between items-center shadow-sm">
            <div class="flex items-center gap-4">
                <div
                    class="h-12 w-12 rounded-xl bg-gradient-to-br from-emerald-900 to-emerald-600 flex items-center justify-center text-white shadow-md ring-1 ring-emerald-500/20">
                    <span class="material-symbols-outlined text-2xl fill-icon">school</span>
                </div>
                <div>
                    <h1
                        class="text-lg sm:text-xl font-black text-slate-800 dark:text-white leading-none tracking-tight uppercase">
                        PROFIL IDENTITAS PESERTA DIDIK</h1>
                    <p class="text-[11px] text-slate-400 mt-1 font-bold uppercase tracking-widest">MI Nurul Huda 3 ·
                        Siakad System</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button @click="closeKartuSiswa()"
                    class="h-10 w-10 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-center text-slate-400 transition-all hover:scale-105 active:scale-95">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        </header>

        {{-- Main Content Scrollable Area --}}
        <div class="overflow-hidden flex-1 min-h-0 p-6 sm:p-10 bg-slate-50/50 dark:bg-slate-900/50 flex flex-col">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 flex-1 min-h-0">

                {{-- Left Column (Identity Card) --}}
                <aside class="lg:col-span-4 flex flex-col gap-6 overflow-y-auto no-scrollbar pr-2 pb-6 h-full min-h-0">
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
                                    <img id="kartu_siswa_foto" alt="Foto Siswa" class="w-full h-full object-cover"
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
                            <h2 id="kartu_siswa_nama_pendek"
                                class="text-2xl font-black text-slate-800 dark:text-white mb-2 tracking-tight">—</h2>
                            <p id="kartu_siswa_nisn"
                                class="font-mono text-[11px] text-slate-500 bg-slate-100 dark:bg-slate-900 px-4 py-1.5 rounded-xl mb-6 border border-slate-200 dark:border-slate-700 shadow-sm font-bold uppercase tracking-widest">
                                —</p>

                            {{-- Mini Stat Cards --}}
                            <div class="grid grid-cols-2 gap-3 w-full mb-6">
                                <div
                                    class="bg-slate-50 dark:bg-slate-900/50 rounded-2xl p-4 border border-slate-200 dark:border-slate-700 flex flex-col items-center shadow-sm">
                                    <span
                                        class="text-[9px] text-slate-400 uppercase tracking-[0.2em] mb-1 font-black">Status</span>
                                    <span id="kartu_siswa_status"
                                        class="text-[11px] text-emerald-600 font-black uppercase tracking-wide">—</span>
                                </div>
                                <div
                                    class="bg-slate-50 dark:bg-slate-900/50 rounded-2xl p-4 border border-slate-200 dark:border-slate-700 flex flex-col items-center shadow-sm">
                                    <span
                                        class="text-[9px] text-slate-400 uppercase tracking-[0.2em] mb-1 font-black">Kelas</span>
                                    <span id="kartu_siswa_kelas"
                                        class="text-[11px] text-slate-800 dark:text-white font-black uppercase tracking-wide">—</span>
                                </div>
                            </div>

                            {{-- Attendance & Academic Module --}}
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
                                    <span id="kartu_siswa_persen_kehadiran_label"
                                        class="text-xs font-black text-emerald-700">—</span>
                                </div>
                                <div
                                    class="h-2 w-full bg-emerald-100 dark:bg-emerald-900/30 rounded-full overflow-hidden">
                                    <div id="kartu_siswa_kehadiran_bar"
                                        class="h-full bg-emerald-500 rounded-full shadow-[0_0_10px_rgba(16,185,129,0.5)] transition-all duration-700"
                                        style="width:0%"></div>
                                </div>

                                {{-- Nilai Rata-rata --}}
                                <div
                                    class="flex items-center justify-between mt-1 pt-4 border-t border-emerald-100 dark:border-emerald-500/10">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-emerald-900 flex items-center justify-center text-white">
                                            <span class="material-symbols-outlined text-[18px] fill-icon">grade</span>
                                        </div>
                                        <span
                                            class="text-[10px] text-slate-500 uppercase tracking-widest font-black">Rata-rata
                                            Nilai</span>
                                    </div>
                                    <span id="kartu_siswa_rata_nilai"
                                        class="text-xs font-black text-emerald-900 dark:text-emerald-400 bg-white dark:bg-slate-900 px-3 py-1 rounded-lg shadow-sm">—</span>
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
                                        <span
                                            class="material-symbols-outlined text-[18px] fill-icon text-emerald-500">verified</span>
                                        <span
                                            class="text-[10px] uppercase tracking-widest font-black text-emerald-600">ID
                                            Terverifikasi</span>
                                    </div>
                                    <div class="p-3 bg-white rounded-2xl border border-slate-100 shadow-inner mt-1">
                                        <img id="kartu_siswa_qr" src=""
                                            class="w-20 h-20 grayscale hover:grayscale-0 transition-all duration-300">
                                    </div>
                                    <div class="text-center">
                                        <h4
                                            class="text-[10px] text-slate-800 dark:text-white uppercase tracking-[0.2em] font-black mb-1">
                                            Kartu Digital Siswa</h4>
                                        <p id="kartu_siswa_id_system"
                                            class="text-[9px] text-slate-400 font-mono uppercase font-bold tracking-widest">
                                            —</p>
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
                                    <span class="material-symbols-outlined text-emerald-400">class</span>
                                </div>
                                <div>
                                    <p class="text-[9px] text-emerald-300/80 uppercase tracking-widest font-black">
                                        Kelas Aktif</p>
                                    <p id="kartu_siswa_kelas_banner" class="text-sm font-black text-white mt-0.5">—</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 group">
                                <div
                                    class="bg-white/10 p-3 rounded-xl backdrop-blur-md border border-white/10 group-hover:bg-white/20 transition-all shadow-lg">
                                    <span class="material-symbols-outlined text-emerald-400">badge</span>
                                </div>
                                <div>
                                    <p class="text-[9px] text-emerald-300/80 uppercase tracking-widest font-black">
                                        Wali Kelas</p>
                                    <p id="kartu_siswa_wali" class="text-sm font-black text-white mt-0.5 break-words">
                                        —</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 group">
                                <div
                                    class="bg-white/10 p-3 rounded-xl backdrop-blur-md border border-white/10 group-hover:bg-white/20 transition-all shadow-lg">
                                    <span class="material-symbols-outlined text-emerald-400">calendar_month</span>
                                </div>
                                <div>
                                    <p class="text-[9px] text-emerald-300/80 uppercase tracking-widest font-black">
                                        Tahun Ajaran</p>
                                    <p id="kartu_siswa_tahun_ajaran_banner"
                                        class="text-sm font-black text-white mt-0.5">—</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 group">
                                <div
                                    class="bg-white/10 p-3 rounded-xl backdrop-blur-md border border-white/10 group-hover:bg-white/20 transition-all shadow-lg">
                                    <span class="material-symbols-outlined text-emerald-400">home</span>
                                </div>
                                <div>
                                    <p class="text-[9px] text-emerald-300/80 uppercase tracking-widest font-black">
                                        NIS</p>
                                    <p id="kartu_siswa_nis_banner" class="text-sm font-black text-white mt-0.5">—</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                {{-- Right Column (Modular Content) --}}
                <main class="md:col-span-1 lg:col-span-8 flex flex-col h-full overflow-hidden space-y-5 min-h-0">

                    {{-- Name & Status Header --}}
                    <div class="shrink-0">
                        <h2 id="kartu_siswa_nama_lengkap"
                            class="text-3xl sm:text-4xl font-extrabold tracking-tighter leading-tight break-words text-[#003527] font-['Manrope',_sans-serif]">
                            -</h2>
                        <p id="kartu_siswa_status_label"
                            class="text-sm font-medium mt-1 flex items-center gap-2 text-[#006c49]">

                            Peserta Didik Aktif <span
                                class="material-symbols-outlined text-[16px]">verified_user</span>

                        </p>

                    </div>

                    {{-- TAB SECTION --}}
                    <div class="flex-1 flex flex-col overflow-hidden min-h-0">

                        {{-- TAB NAVIGATION --}}
                        <div class="mb-5 px-1 shrink-0">
                            <div
                                class="bg-slate-100/80 rounded-2xl p-1.5 flex items-center gap-1 border border-slate-200 shadow-inner">

                                <button type="button" class="kartu-siswa-tab-btn active"
                                    data-target="tab-siswa-pribadi">
                                    <span class="material-symbols-outlined text-[18px]">person</span>
                                    <span>Profil Pribadi</span>
                                </button>

                                <button type="button" class="kartu-siswa-tab-btn" data-target="tab-siswa-ortu">
                                    <span class="material-symbols-outlined text-[18px]">family_restroom</span>
                                    <span>Orang Tua</span>
                                </button>

                                <button type="button" class="kartu-siswa-tab-btn" data-target="tab-siswa-fisik">
                                    <span class="material-symbols-outlined text-[18px]">monitor_weight</span>
                                    <span>Fisik & Kesehatan</span>
                                </button>

                                <button type="button" class="kartu-siswa-tab-btn" data-target="tab-siswa-admin">
                                    <span class="material-symbols-outlined text-[18px]">description</span>
                                    <span>Administrasi</span>
                                </button>
                            </div>
                        </div>

                        {{-- TAB CONTENT --}}
                        <div class="flex-1 overflow-y-auto pr-2 no-scrollbar pb-6 min-h-0">
                            <div>

                                {{-- ===== TAB PROFIL PRIBADI ===== --}}
                                <div class="kartu-siswa-tab-content active" id="tab-siswa-pribadi">

                                    <div class="kartu-modern-section">
                                        <div class="kartu-modern-header">
                                            <div class="kartu-modern-icon emerald">
                                                <span class="material-symbols-outlined text-[20px]">badge</span>
                                            </div>
                                            <div>
                                                <h3>Data Kependudukan</h3>
                                                <p>Informasi identitas kependudukan siswa</p>
                                            </div>
                                        </div>

                                        <div class="kartu-modern-grid">

                                            <div class="kartu-modern-item">
                                                <span class="label">NIS (Lokal)</span>
                                                <span class="value" id="kartu_siswa_nis">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">NISN</span>
                                                <span class="value" id="kartu_siswa_nisn_full">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">NIK</span>
                                                <span class="value" id="kartu_siswa_nik">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Nomor KK</span>
                                                <span class="value" id="kartu_siswa_no_kk">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Kewarganegaraan</span>
                                                <span class="value" id="kartu_siswa_kewarganegaraan">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">No Registrasi Akta</span>
                                                <span class="value" id="kartu_siswa_no_registrasi_akta_kelahiran">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Tempat Lahir</span>
                                                <span class="value" id="kartu_siswa_tempat_lahir">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Tanggal Lahir</span>
                                                <span class="value" id="kartu_siswa_tgl_lahir">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Jenis Kelamin</span>
                                                <span class="value" id="kartu_siswa_jk">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Agama</span>
                                                <span class="value" id="kartu_siswa_agama">—</span>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Domisili & Periodik --}}
                                    <div class="kartu-modern-section">
                                        <div class="kartu-modern-header">
                                            <div class="kartu-modern-icon emerald">
                                                <span class="material-symbols-outlined text-[20px]">location_on</span>
                                            </div>
                                            <div>
                                                <h3>Data Domisili & Periodik</h3>
                                                <p>Alamat tempat tinggal dan akses ke sekolah</p>
                                            </div>
                                        </div>

                                        <div class="kartu-modern-grid">
                                            <div class="kartu-modern-item full">
                                                <span class="label">Alamat Tempat Tinggal Siswa</span>
                                                <span class="value" id="kartu_siswa_alamat_siswa">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">RT / RW</span>
                                                <span class="value" id="kartu_siswa_rt_rw">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Kelurahan</span>
                                                <span class="value" id="kartu_siswa_kelurahan">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Kecamatan</span>
                                                <span class="value" id="kartu_siswa_kecamatan">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Kode Pos</span>
                                                <span class="value" id="kartu_siswa_kode_pos">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Lintang</span>
                                                <span class="value" id="kartu_siswa_lintang">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Bujur</span>
                                                <span class="value" id="kartu_siswa_bujur">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Anak Ke-</span>
                                                <span class="value" id="kartu_siswa_anak_ke">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Jumlah Saudara</span>
                                                <span class="value" id="kartu_siswa_jumlah_saudara">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Jarak ke Sekolah</span>
                                                <span class="value" id="kartu_siswa_jarak">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Waktu Tempuh</span>
                                                <span class="value" id="kartu_siswa_waktu_tempuh">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Moda Transportasi</span>
                                                <span class="value" id="kartu_siswa_moda_transportasi">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Hobi</span>
                                                <span class="value" id="kartu_siswa_hobi">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Cita-cita</span>
                                                <span class="value" id="kartu_siswa_cita_cita">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">No Telp Siswa</span>
                                                <span class="value" id="kartu_siswa_no_telp_siswa">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">HP Siswa</span>
                                                <span class="value" id="kartu_siswa_hp_siswa">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Email Siswa</span>
                                                <span class="value" id="kartu_siswa_email_siswa">—</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                {{-- ===== TAB ORANG TUA ===== --}}
                                <div class="kartu-siswa-tab-content" id="tab-siswa-ortu">

                                    <div class="kartu-modern-section">
                                        <div class="kartu-modern-header">
                                            <div class="kartu-modern-icon emerald">
                                                <span class="material-symbols-outlined text-[20px]">wc</span>
                                            </div>
                                            <div>
                                                <h3>Data Orang Tua / Wali</h3>
                                                <p>Informasi ayah, ibu kandung, dan wali</p>
                                            </div>
                                        </div>

                                        <div class="kartu-modern-grid">

                                            <div class="kartu-modern-item">
                                                <span class="label">Nama Ayah</span>
                                                <span class="value" id="kartu_siswa_ayah">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Pekerjaan Ayah</span>
                                                <span class="value" id="kartu_siswa_pekerjaan_ayah">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">NIK Ayah</span>
                                                <span class="value" id="kartu_siswa_nik_ayah">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Tahun Lahir Ayah</span>
                                                <span class="value" id="kartu_siswa_tahun_lahir_ayah">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Pendidikan Ayah</span>
                                                <span class="value" id="kartu_siswa_pendidikan_ayah">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Kebutuhan Khusus Ayah</span>
                                                <span class="value" id="kartu_siswa_kebutuhan_khusus_ayah">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Penghasilan Ayah</span>
                                                <span class="value" id="kartu_siswa_penghasilan_ayah">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Nama Ibu</span>
                                                <span class="value" id="kartu_siswa_ibu">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Pekerjaan Ibu</span>
                                                <span class="value" id="kartu_siswa_pekerjaan_ibu">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">NIK Ibu</span>
                                                <span class="value" id="kartu_siswa_nik_ibu">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Tahun Lahir Ibu</span>
                                                <span class="value" id="kartu_siswa_tahun_lahir_ibu">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Pendidikan Ibu</span>
                                                <span class="value" id="kartu_siswa_pendidikan_ibu">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Kebutuhan Khusus Ibu</span>
                                                <span class="value" id="kartu_siswa_kebutuhan_khusus_ibu">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Penghasilan Ibu</span>
                                                <span class="value" id="kartu_siswa_penghasilan_ibu">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">No HP Orang Tua</span>
                                                <span class="value" id="kartu_siswa_hp">—</span>
                                            </div>

                                            <div class="kartu-modern-item full">
                                                <span class="label">Alamat Orang Tua</span>
                                                <span class="value" id="kartu_siswa_alamat">—</span>
                                            </div>

                                            <div id="section_kartu_wali"
                                                class="kartu-modern-grid full"
                                                style="display: none; grid-column: 1/-1; margin-top: 10px;">
                                                <div class="kartu-modern-item full bg-slate-100 border-dashed"
                                                    style="padding-bottom: 8px; border-bottom: none; border-bottom-left-radius: 0; border-bottom-right-radius: 0;">
                                                    <span class="label" style="margin-bottom: 0;">Data Wali /
                                                        Pengasuh</span>
                                                </div>
                                                <div class="kartu-modern-item">
                                                    <span class="label">Nama Wali</span>
                                                    <span class="value" id="kartu_siswa_wali_nama">—</span>
                                                </div>
                                                <div class="kartu-modern-item">
                                                    <span class="label">Pekerjaan Wali</span>
                                                    <span class="value" id="kartu_siswa_pekerjaan_wali">—</span>
                                                </div>
                                                <div class="kartu-modern-item">
                                                    <span class="label">NIK Wali</span>
                                                    <span class="value" id="kartu_siswa_nik_wali">—</span>
                                                </div>
                                                <div class="kartu-modern-item">
                                                    <span class="label">Tahun Lahir Wali</span>
                                                    <span class="value" id="kartu_siswa_tahun_lahir_wali">—</span>
                                                </div>
                                                <div class="kartu-modern-item">
                                                    <span class="label">No HP Wali</span>
                                                    <span class="value" id="kartu_siswa_hp_wali">—</span>
                                                </div>
                                                <div class="kartu-modern-item">
                                                    <span class="label">Penghasilan Wali</span>
                                                    <span class="value" id="kartu_siswa_penghasilan_wali">—</span>
                                                </div>
                                                <div class="kartu-modern-item full">
                                                    <span class="label">Alamat Wali</span>
                                                    <span class="value" id="kartu_siswa_alamat_wali">—</span>
                                                </div>
                                                <div class="kartu-modern-item">
                                                    <span class="label">Pendidikan Wali</span>
                                                    <span class="value" id="kartu_siswa_pendidikan_wali">—</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                {{-- ===== TAB FISIK & KESEHATAN ===== --}}
                                <div class="kartu-siswa-tab-content" id="tab-siswa-fisik">

                                    <div class="kartu-modern-section">
                                        <div class="kartu-modern-header">
                                            <div class="kartu-modern-icon emerald">
                                                <span
                                                    class="material-symbols-outlined text-[20px]">monitor_weight</span>
                                            </div>
                                            <div>
                                                <h3>Data Fisik & Kesehatan</h3>
                                                <p>Informasi fisik dan riwayat kesehatan siswa</p>
                                            </div>
                                        </div>

                                        <div class="kartu-modern-grid">

                                            <div class="kartu-modern-item">
                                                <span class="label">Golongan Darah</span>
                                                <span class="value" id="kartu_siswa_golongan_darah">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Kebutuhan Khusus</span>
                                                <span class="value" id="kartu_siswa_kebutuhan_khusus">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Tinggi Badan</span>
                                                <span class="value" id="kartu_siswa_tinggi_badan">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Berat Badan</span>
                                                <span class="value" id="kartu_siswa_berat_badan">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Lingkar Kepala</span>
                                                <span class="value" id="kartu_siswa_lingkar_kepala">—</span>
                                            </div>

                                            <div class="kartu-modern-item full">
                                                <span class="label">Riwayat Penyakit</span>
                                                <span class="value" id="kartu_siswa_riwayat_penyakit">—</span>
                                            </div>

                                            <div class="kartu-modern-item full">
                                                <span class="label">Catatan Kesehatan</span>
                                                <span class="value" id="kartu_siswa_catatan_kesehatan">—</span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="kartu-modern-section">
                                        <div class="kartu-modern-header">
                                            <div class="kartu-modern-icon emerald">
                                                <span class="material-symbols-outlined text-[20px]">volunteer_activism</span>
                                            </div>
                                            <div>
                                                <h3>Program Kesejahteraan</h3>
                                                <p>Status KPS/PKH, PIP, dan KIP siswa</p>
                                            </div>
                                        </div>

                                        <div class="kartu-modern-grid">
                                            <div class="kartu-modern-item">
                                                <span class="label">Penerima KPS/PKH</span>
                                                <span class="value" id="kartu_siswa_penerima_kps_pkh">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">No KPS/PKH</span>
                                                <span class="value" id="kartu_siswa_no_kps_pkh">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Layak PIP</span>
                                                <span class="value" id="kartu_siswa_layak_pip">—</span>
                                            </div>
                                            <div class="kartu-modern-item full">
                                                <span class="label">Alasan Layak PIP</span>
                                                <span class="value" id="kartu_siswa_alasan_layak_pip">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">Penerima KIP</span>
                                                <span class="value" id="kartu_siswa_penerima_kip">—</span>
                                            </div>
                                            <div class="kartu-modern-item">
                                                <span class="label">No KIP</span>
                                                <span class="value" id="kartu_siswa_no_kip">—</span>
                                            </div>
                                            <div class="kartu-modern-item full">
                                                <span class="label">Nama Tertera di KIP</span>
                                                <span class="value" id="kartu_siswa_nama_tertera_di_kip">—</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                {{-- ===== TAB ADMINISTRASI ===== --}}
                                <div class="kartu-siswa-tab-content" id="tab-siswa-admin">

                                    <div class="kartu-modern-section">
                                        <div class="kartu-modern-header">
                                            <div class="kartu-modern-icon emerald">
                                                <span class="material-symbols-outlined text-[20px]">how_to_reg</span>
                                            </div>
                                            <div>
                                                <h3>Data Pendaftaran</h3>
                                                <p>Informasi pendaftaran awal siswa</p>
                                            </div>
                                        </div>

                                        <div class="kartu-modern-grid">

                                            <div class="kartu-modern-item">
                                                <span class="label">Asal Sekolah</span>
                                                <span class="value" id="kartu_siswa_asal_sekolah">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Tanggal Masuk</span>
                                                <span class="value" id="kartu_siswa_tanggal_masuk">—</span>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Section: Mutasi Masuk --}}
                                    <div class="kartu-modern-section" id="section_siswa_mutasi_masuk"
                                        style="display: none;">
                                        <div class="kartu-modern-header">
                                            <div class="kartu-modern-icon amber">
                                                <span class="material-symbols-outlined text-[20px]">arrow_circle_right</span>
                                            </div>
                                            <div>
                                                <h3>Data Mutasi Masuk</h3>
                                                <p>Informasi siswa pindahan dari sekolah lain</p>
                                            </div>
                                        </div>

                                        <div class="kartu-modern-grid">

                                            <div class="kartu-modern-item">
                                                <span class="label">Tanggal Masuk</span>
                                                <span class="value" id="kartu_siswa_tanggal_mutasi_masuk">—</span>
                                            </div>

                                            <div class="kartu-modern-item full">
                                                <span class="label">Sekolah Asal</span>
                                                <span class="value" id="kartu_siswa_sekolah_asal_mutasi">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">No Surat Pindah</span>
                                                <span class="value" id="kartu_siswa_no_surat_masuk">—</span>
                                            </div>

                                            <div class="kartu-modern-item full">
                                                <span class="label">Alasan Pindah</span>
                                                <span class="value" id="kartu_siswa_alasan_mutasi_masuk">—</span>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Section: Mutasi Keluar --}}
                                    <div class="kartu-modern-section" id="section_siswa_mutasi"
                                        style="display: none;">
                                        <div class="kartu-modern-header">
                                            <div id="kartu_mutasi_icon" class="kartu-modern-icon">
                                                <span
                                                    class="material-symbols-outlined text-[20px]">transfer_within_a_station</span>
                                            </div>
                                            <div>
                                                <h3 id="kartu_mutasi_judul">Data Mutasi / Keluar</h3>
                                                <p id="kartu_mutasi_subjudul">Informasi kepindahan atau kelulusan siswa
                                                </p>
                                            </div>
                                        </div>

                                        <div class="kartu-modern-grid">

                                            <div class="kartu-modern-item">
                                                <span class="label">Tanggal Keluar</span>
                                                <span class="value" id="kartu_siswa_tanggal_keluar">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Jenis Mutasi</span>
                                                <span class="value" id="kartu_siswa_jenis_mutasi_keluar">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">No Surat Mutasi</span>
                                                <span class="value" id="kartu_siswa_no_surat_mutasi">—</span>
                                            </div>

                                            <div class="kartu-modern-item">
                                                <span class="label">Sekolah Tujuan</span>
                                                <span class="value" id="kartu_siswa_sekolah_tujuan">—</span>
                                            </div>

                                            <div class="kartu-modern-item full">
                                                <span class="label">Alasan Keluar / Mutasi</span>
                                                <span class="value" id="kartu_siswa_alasan_mutasi">—</span>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                            {{-- Riwayat Prestasi & Beasiswa --}}
                            <div
                                class="grid grid-cols-1 gap-6 items-start pt-6 mt-6 border-t border-slate-200 dark:border-slate-700">

                                {{-- ===== RIWAYAT PRESTASI ===== --}}
                                <section id="kartu_siswa_prestasi_section"
                                    class="xl:col-span-2 bg-white dark:bg-slate-800/50 rounded-3xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden flex flex-col">
                                    <div
                                        class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-emerald-700 to-emerald-500 rounded-l-3xl">
                                    </div>
                                    <div class="pl-4 flex-1 flex flex-col">
                                        <div
                                            class="flex items-center gap-3 mb-5 pb-3 border-b border-slate-100 dark:border-slate-700">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-amber-500/10 text-amber-600 flex items-center justify-center">
                                                <span class="material-symbols-outlined text-[20px]">emoji_events</span>
                                            </div>
                                            <h3
                                                class="text-[10px] font-black text-slate-400 uppercase tracking-[0.18em]">
                                                Riwayat Prestasi</h3>
                                        </div>
                                        <div id="kartu_siswa_prestasi_list"
                                            class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3 flex-1"></div>
                                        <div id="kartu_siswa_prestasi_empty" class="hidden py-6 text-center">
                                            <p class="text-sm text-slate-400 italic">Belum ada data prestasi.</p>
                                        </div>
                                    </div>
                                </section>

                                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                                    {{-- ===== RIWAYAT BEASISWA ===== --}}
                                    <section id="kartu_siswa_beasiswa_section"
                                        class="bg-white dark:bg-slate-800/50 rounded-3xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden flex flex-col">
                                        <div
                                            class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-emerald-700 to-emerald-500 rounded-l-3xl">
                                        </div>
                                        <div class="pl-4 flex-1 flex flex-col">
                                            <div
                                                class="flex items-center gap-3 mb-6 pb-3 border-b border-slate-100 dark:border-slate-700">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 flex items-center justify-center">
                                                    <span
                                                        class="material-symbols-outlined text-[20px]">workspace_premium</span>
                                                </div>
                                                <div>
                                                    <h3
                                                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.18em]">
                                                        Riwayat Beasiswa</h3>
                                                    <p id="kartu_siswa_beasiswa_stats"
                                                        class="text-[11px] text-slate-500 font-medium mt-0.5">—
                                                        Beasiswa</p>
                                                </div>
                                            </div>
                                            <div id="kartu_siswa_beasiswa_list" class="space-y-4 flex-1"></div>
                                            <div id="kartu_siswa_beasiswa_empty" class="hidden py-8 text-center">
                                                <p class="text-sm text-slate-400 italic">Belum ada data beasiswa.</p>
                                            </div>
                                        </div>
                                    </section>

                                    {{-- ===== RIWAYAT NAIK KELAS ===== --}}
                                    <section id="kartu_siswa_kenaikan_section"
                                        class="bg-slate-50 dark:bg-slate-900/50 rounded-3xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden flex flex-col">
                                        <div
                                            class="absolute -right-8 -top-8 w-32 h-32 bg-emerald-500/5 rounded-full blur-2xl pointer-events-none">
                                        </div>
                                        <div
                                            class="flex items-center gap-3 mb-6 pb-3 border-b border-slate-100 dark:border-slate-700 relative z-10">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-500 flex items-center justify-center">
                                                <span class="material-symbols-outlined text-[20px]">trending_up</span>
                                            </div>
                                            <h3
                                                class="text-[10px] font-black text-slate-400 uppercase tracking-[0.18em]">
                                                Riwayat Kelas & Status Akademik</h3>
                                        </div>
                                        <div id="kartu_siswa_kenaikan_content"
                                            class="space-y-4 relative before:absolute before:inset-0 before:ml-4 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-emerald-200 before:via-slate-200 before:to-transparent z-10 flex-1">
                                        </div>
                                        <div id="kartu_siswa_kenaikan_empty" class="hidden py-8 text-center">
                                            <p class="text-sm text-slate-400 italic">Belum ada data kenaikan kelas.</p>
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
                <button @click="closeKartuSiswa()"
                    class="px-3 py-2.5 text-[11px] font-bold text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 uppercase tracking-wider transition-colors">
                    Tutup
                </button>
                <div class="flex items-center gap-2 border-r border-slate-200 dark:border-slate-700 pr-2 mr-1">
                    <button @click="openDokumenSiswaModal(currentSiswaForModal)"
                        class="group px-4 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-slate-900 transition-all flex items-center gap-2 shadow-sm">
                        <span
                            class="material-symbols-outlined text-[16px] text-slate-400 group-hover:text-slate-600 dark:group-hover:text-white transition-colors">folder_open</span>
                        <span class="hidden md:inline">Berkas Digital</span>
                        <span class="md:hidden">Berkas</span>
                    </button>
                    <button @click="openPrestasiSiswaModal(currentSiswaForModal)"
                        class="group px-4 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-slate-900 transition-all flex items-center gap-2 shadow-sm">
                        <span
                            class="material-symbols-outlined text-[16px] text-slate-400 group-hover:text-amber-500 transition-colors">emoji_events</span>
                        <span class="hidden md:inline">Prestasi</span>
                        <span class="md:hidden">Prestasi</span>
                    </button>
                    <button @click="openBeasiswaSiswaModal(currentSiswaForModal)"
                        class="group px-4 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-slate-900 transition-all flex items-center gap-2 shadow-sm">
                        <span
                            class="material-symbols-outlined text-[16px] text-slate-400 group-hover:text-emerald-600 transition-colors">workspace_premium</span>
                        <span class="hidden md:inline">Beasiswa</span>
                        <span class="md:hidden">Beasiswa</span>
                    </button>
                </div>
                <button id="btnUbahDataKartuSiswaFooter"
                    class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-wider
                    text-white bg-gradient-to-r from-[#003527] to-[#006c49] backdrop-blur-md shadow-lg
                    hover:shadow-[0_8px_20px_-4px_rgba(0,53,39,0.4)]
                    hover:-translate-y-0.5 active:scale-95 transition-all duration-300
                    flex items-center gap-2 border border-white/10">
                    <span class="material-symbols-outlined text-[16px] fill-icon">edit_note</span>
                    Ubah Profil
                </button>
            </div>
        </footer>
    </div>
</div>

<style>
    .kartu-siswa-tab-btn {
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

    .kartu-siswa-tab-btn.active {
        background: linear-gradient(135deg, #003527, #006c49);
        color: white;
        box-shadow: 0 4px 14px rgba(0, 0, 0, .12);
    }

    .kartu-siswa-tab-content {
        display: none;
        animation: fadeTab .25s ease;
    }

    .kartu-siswa-tab-content.active {
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

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    .material-symbols-outlined.fill-icon {
        font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
</style>

<script>
    // Tab switching untuk kartu siswa (scope ke dalam modal agar tidak bentrok dengan kartu guru)
    document.querySelectorAll('.kartu-siswa-tab-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.kartu-siswa-tab-btn').forEach(btn => btn.classList.remove(
                'active'));
            document.querySelectorAll('.kartu-siswa-tab-content').forEach(content => content.classList
                .remove('active'));
            this.classList.add('active');
            document.getElementById(this.dataset.target).classList.add('active');
        });
    });

    // Render riwayat kenaikan kelas (pola sama seperti renderInpassingList di kartu guru)
    function renderKenaikanKelasList(items) {
        const content = document.getElementById('kartu_siswa_kenaikan_content');
        const empty = document.getElementById('kartu_siswa_kenaikan_empty');
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
                                <span class="text-[15px] font-bold text-[#003527] block leading-tight">${item.kelas} <span class="text-[12px] font-normal text-slate-500 ml-1">(Semester ${item.semester || '-'})</span></span>
                                <p class="text-[12px] text-slate-400 mt-0.5">Tahun Ajaran: ${item.tahun_ajaran}</p>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md uppercase tracking-wider whitespace-nowrap">${item.status}</span>
                        </div>
                        <div class="pt-2 pb-2 text-[11px] text-slate-500 space-y-1">
                            <div class="flex justify-between">
                                <span><strong class="text-slate-600">Mulai:</strong> ${item.tanggal_masuk_label || item.tanggal_masuk || '-'}</span>
                                <span><strong class="text-slate-600">Selesai:</strong> ${item.tanggal_keluar_label || item.tanggal_keluar || '-'}</span>
                            </div>
                            ${item.keterangan ? `<p class="mt-1"><strong class="text-slate-600">Ket:</strong> ${item.keterangan}</p>` : ''}
                        </div>
                        <div class="pt-2 border-t border-slate-100">
                            <p class="font-mono text-[11px] text-slate-500 bg-slate-50 px-2 py-1 rounded-md inline-flex items-center gap-1.5 border border-slate-200">
                                <span class="material-symbols-outlined text-[12px]">grade</span>
                                Rata-rata: ${item.rata_nilai}
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
                                <span class="text-[15px] font-bold text-slate-500 block leading-tight">${item.kelas} <span class="text-[12px] font-normal text-slate-400 ml-1">(Semester ${item.semester || '-'})</span></span>
                                <p class="text-[12px] text-slate-400 mt-0.5">Tahun Ajaran: ${item.tahun_ajaran}</p>
                            </div>
                            <span class="text-[10px] font-bold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-md uppercase tracking-wider whitespace-nowrap border border-slate-200">${item.status}</span>
                        </div>
                        <div class="pt-2 pb-2 text-[11px] text-slate-500 space-y-1">
                            <div class="flex justify-between">
                                <span><strong class="text-slate-600">Mulai:</strong> ${item.tanggal_masuk_label || item.tanggal_masuk || '-'}</span>
                                <span><strong class="text-slate-600">Selesai:</strong> ${item.tanggal_keluar_label || item.tanggal_keluar || '-'}</span>
                            </div>
                            ${item.keterangan ? `<p class="mt-1"><strong class="text-slate-600">Ket:</strong> ${item.keterangan}</p>` : ''}
                        </div>
                        <div class="pt-2 border-t border-slate-100">
                            <p class="font-mono text-[11px] text-slate-400 bg-slate-50 px-2 py-1 rounded-md inline-flex items-center gap-1.5 border border-slate-200">
                                <span class="material-symbols-outlined text-[12px]">grade</span>
                                Rata-rata: ${item.rata_nilai}
                            </p>
                        </div>
                    </div>
                </div>`;
            }
        });
    }
</script>
