# Progress — minurulhuda3

> Diperbarui: 2026-06-13

## Status Umum

Proyek berada dalam tahap **pengembangan aktif**. Fondasi database dan sistem CRUD inti sudah selesai. Pengembangan sedang bergerak ke arah fitur-fitur lanjutan dan penyempurnaan tampilan.

---

## Modul yang Sudah Selesai (Production-Ready)

### ✅ Autentikasi & Otorisasi
- Login/logout dengan session
- RBAC berbasis many-to-many `users ↔ roles`
- `RoleMiddleware` melindungi semua area peran
- Manajemen akun user (enable/disable, reset password, soft delete)
- Seeder tersedia: `AdminSeeder`, `KepsekSeeder`, `OperatorSeeder`, `RoleSeeder`, `UserSeeder`

### ✅ Modul Operator — Data Siswa
- CRUD siswa lengkap dengan validasi
- Upload foto profil siswa
- Data Dapodik (alamat domisili, data keluarga, data periodik/geografis)
- Import Excel (bulk upload siswa baru)
- Export Excel (data siswa)
- Export PDF kartu profil per siswa
- Export template import kosong
- **Berkas Digital Siswa**: upload, view, download, delete dokumen (private storage)
- **Prestasi Siswa**: CRUD + upload file bukti
- **Beasiswa Siswa**: CRUD
- **Riwayat Kelas**: pencatatan otomatis via `RiwayatKelasService`
- Mutasi lulus & reaktivasi siswa
- Soft delete + trash + restore + force delete (dengan cascade)

### ✅ Modul Operator — Data Guru
- CRUD guru lengkap dengan `GuruController` (36KB)
- Upload foto profil guru
- Assign user login ke profil guru
- Import Excel (bulk upload guru)
- Export Excel & PDF rekap guru
- Export PDF kartu profil per guru
- **Diklat Guru**: CRUD + upload sertifikat (view/download)
- **Inpassing Guru**: CRUD + upload SK + set inpassing aktif
- **Dokumen Guru**: CRUD + upload file + verifikasi dokumen + view/download
- Soft delete + trash + restore + force delete (dengan cascade ke semua sub-tabel)
- Sub-tabel terintegrasi: jabatan, pendidikan, sertifikasi, rekening, keluarga, mapel, absensi

### ✅ Modul Operator — Manajemen Akademik
- **Kelas**: CRUD kelas (nama, tingkat, wali kelas, kapasitas, jadwal pertemuan orang tua)
- **Penempatan Siswa**: mapping siswa ke kelas (`updatePenempatan`)
- **Mata Pelajaran**: halaman tersedia (view static, belum ada controller CRUD)
- **Pengampu Mapel** (`plot_guru_mapels`): halaman tersedia
- **Jadwal Pelajaran**: halaman tersedia
- **Semester**: CRUD + set semester aktif
- **Tahun Ajaran**: CRUD + arsip + proses kenaikan kelas (`promoteSiswa`)
- **Kenaikan Kelas**: halaman khusus dengan logika promosi siswa

### ✅ Modul Operator — Manajemen User
- CRUD user dengan manajemen peran
- Toggle status aktif/nonaktif
- Reset password

### ✅ Halaman Publik
- Landing page sekolah (`welcome.blade.php` — 41KB)
- Halaman profil sekolah
- Halaman program sekolah
- Halaman galeri
- Halaman PPDB

### ✅ Partial UI Operator
- `_modalKartuSiswa.blade.php` (72KB) — Modal detail lengkap siswa
- `_modalKartuGuru.blade.php` (64KB) — Modal detail lengkap guru
- `_modalDokumenGuru.blade.php` (36KB)
- `_modalInpassingGuru.blade.php` (33KB)
- `_modalDiklatGuru.blade.php` (27KB)
- `_tableGuru.blade.php`, `_stepNav.blade.php`, `_formField.blade.php`, dll.

---

## Modul yang Sudah Ada UI-nya tapi Belum Terkoneksi Controller

### 🔨 Dashboard Semua Peran
- Semua dashboard sudah ada Blade view (operator, guru, kepsek, bendahara, ortu, adminPpdb)
- Data dummy / static; belum mengambil data real dari database secara dinamis

### 🔨 Modul Guru (dari sudut pandang guru)
- `guru/dashboard`, `jadwal`, `absensi`, `penilaian`, `materiTugas`, `rekapAkademik`, `analitikKelas`, `setting`
- Sub-menu Wali Kelas: `dashboard`, `data-siswa`, `rekap-absensi`, `rekap-nilai`, `monitoring-spp`, `cetak-rapor`, `catatan`
- **Status**: Route sudah ada, Blade sudah ada, Controller belum ada (route langsung ke view via closure)

### 🔨 Modul Kepsek
- 10 view sudah ada: `dashboard`, `akademik`, `sdm`, `keuangan`, `ppdb`, `approval`, `laporan`, `notifikasi`, `auditLog`, `setting`
- **Status**: Semua route closure langsung, belum ada controller kepsek

### 🔨 Modul Bendahara
- 7 view sudah ada: `dashboard`, `spp`, `laporanKeuangan`, `rekapTunggakan`, `transaksi`, `audit`, `setting`
- **Status**: Semua route closure langsung, belum ada controller bendahara

### 🔨 Modul Admin PPDB
- 11 view sudah ada: `dashboard`, `tambahPendaftar`, `uploadImport`, `dataPendaftar`, `verifikasiBerkas`, `verifikasiDetail`, `seleksi`, `pembayaran`, `konversi`, `stastistikLaporan`, `setting`
- **Status**: Semua route closure langsung, belum ada controller admin PPDB

### 🔨 Modul Ortu
- 7 view sudah ada: `dashboard`, `nilai`, `absensi`, `pembayaran`, `jadwal`, `catatan`, `setting`
- **Status**: Semua route closure langsung, belum ada controller ortu

---

## Modul yang Belum Diimplementasikan

### ❌ Belum Ada
- **Manajemen User Lama** (`manajementUser.blade.php` ada, tapi route-nya di-comment)
- **Integrasi Dapodik** (halaman ada, logika belum)
- **Backup & Restore** (halaman ada, logika belum)
- **Audit Log** (halaman ada, mekanisme logging belum)
- **Notifikasi Real-time** (Livewire tersedia, belum diimplementasikan)
- **Cetak Rapor** (view ada, integrasi nilai → PDF belum)
- **Monitoring SPP Wali Kelas** (belum)
- **Laporan Keuangan Dinamis** (view statis)
- **PPDB End-to-End** (konversi calon siswa → siswa aktif belum)

---

## Statistik Kode

| Komponen | Jumlah |
|----------|--------|
| Migrasi database | 103 file |
| Eloquent Models | 42 model |
| Controllers | 14 controller (5 non-operator + 9 operator) |
| Blade Views | 80+ file |
| Services | 1 (RiwayatKelasService) |
| Import classes | 2 |
| Export classes | 4 |
| Middleware | 1 (RoleMiddleware) |
| Seeder | 6 |
| Route | ~110+ named routes |

---

## Timeline Pengembangan (berdasarkan migrasi)

| Periode | Aktivitas |
|---------|-----------|
| Feb 2026 | Setup awal: user, role, guru, kelas, siswa, orang tua, jadwal, nilai, absensi, pembayaran, rapor, PPDB |
| Apr 2026 | Ekspansi: foto siswa, agama siswa, parent meeting, data Dapodik orang tua |
| Mei 2026 awal | Modul semester, riwayat kelas, sertifikasi guru, tambahan fields guru |
| Mei 2026 tengah | Modul guru lengkap: jabatan, pendidikan, sertifikasi, rekening, keluarga, diklat, inpassing, dokumen, absensi |
| Mei 2026 akhir | Refaktor nilais, tagihan, riwayat kelas, mutasi, perkembangan, prestasi, beasiswa, data tambahan siswa, program kesejahteraan |
| Jun 2026 (saat ini) | Penyempurnaan, dokumentasi, pengembangan lanjutan |
