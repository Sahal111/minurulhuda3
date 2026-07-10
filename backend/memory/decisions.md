# Decisions — minurulhuda3

> Diperbarui: 2026-06-13
> Dokumen ini mencatat keputusan arsitektur dan desain yang dapat disimpulkan dari kondisi kode saat ini.

---

## 1. Framework & Stack Utama

**Keputusan**: Menggunakan Laravel 11 + Blade + Alpine.js + Tailwind CSS

**Alasan** (disimpulkan dari kode):
- Laravel adalah framework PHP matang dengan ekosistem lengkap (Eloquent ORM, migrasi, seeder, artisan, queue)
- Blade + Alpine.js cukup untuk UI interaktif tanpa overhead SPA (React/Vue)
- Tailwind CSS v3 memungkinkan styling cepat dan konsisten
- Livewire v4 sudah diinstall sebagai opsi untuk komponen reaktif di masa depan, tapi belum digunakan secara ekstensif

---

## 2. Database: MySQL (prod) + SQLite (dev)

**Keputusan**: `.env.example` dikonfigurasi untuk MySQL; `database.sqlite` ada di repo untuk development

**Alasan**:
- MySQL lebih robust untuk production multi-user
- SQLite memudahkan setup development lokal tanpa server database terpisah
- File `database.sqlite` sudah berisi data (86KB), memungkinkan developer langsung testing

---

## 3. RBAC: Many-to-Many (bukan Role Column di Users)

**Keputusan**: Role disimpan di tabel `roles` terpisah dengan pivot `role_user`; ada migrasi `remove_role_from_users_table.php`

**Alasan**:
- Awalnya ada kolom `role` langsung di `users`, kemudian di-refaktor ke many-to-many
- Memungkinkan satu user memiliki lebih dari satu role (mis. guru + wali kelas)
- Lebih fleksibel untuk ekspansi peran di masa depan

---

## 4. Soft Delete dengan Custom Cascade

**Keputusan**: Implementasi cascade soft-delete manual di method `boot()` model, bukan melalui foreign key database

**Alasan**:
- MySQL tidak mendukung cascade untuk soft delete secara native
- Pendekatan ini memberikan kontrol penuh: bisa menentukan relasi mana yang ikut di-soft-delete dan mana yang tidak
- Contoh keputusan spesifik: `pembayarans` **tidak** ikut soft delete saat siswa dihapus (standar audit keuangan — catatan transaksi uang harus tetap utuh)
- Restore menggunakan window `deleted_at >= (deletedAt - 5 detik)` untuk menangani relasi yang dihapus bersamaan

---

## 5. Service Layer untuk Riwayat Kelas

**Keputusan**: Logika pencatatan riwayat kelas diekstrak ke `RiwayatKelasService`

**Alasan**:
- Logika riwayat kelas kompleks (banyak jenis perubahan, perlu menutup record terbuka sebelum membuka yang baru)
- Digunakan dari beberapa controller (SiswaController, TahunAjaranController)
- Service class memastikan konsistensi dan memudahkan testing

---

## 6. View-First Development (UI Dulu, Logic Belakangan)

**Keputusan**: Banyak modul dibangun dengan Blade view lengkap dulu, baru kemudian controller dan logika backend

**Bukti**:
- Semua area peran (guru, kepsek, bendahara, ortu, adminPpdb) sudah punya view lengkap
- Route-nya masih menggunakan closure langsung ke view (`fn() => view('...')`) tanpa controller
- Ini adalah pola umum dalam rapid prototyping untuk validasi UI dengan stakeholder

---

## 7. Struktur Controller: Operator sebagai Sub-Namespace

**Keputusan**: Controller operator diletakkan di `app/Http/Controllers/Operator/` sebagai sub-namespace

**Alasan**:
- Operator adalah peran dengan paling banyak fungsi dan kompleksitas
- Pemisahan namespace mencegah penumpukan file di root `Controllers/`
- Konsisten dengan standar Laravel untuk grouping controller berdasarkan domain

---

## 8. Partial Modal yang Besar (Monolithic Blade)

**Keputusan**: Modal detail guru dan siswa dibuat sebagai file Blade partial tunggal yang sangat besar

**Bukti**:
- `_modalKartuSiswa.blade.php` = 72KB
- `_modalKartuGuru.blade.php` = 64KB
- `dataSiswa.blade.php` = 280KB (view terbesar)
- `dataGuru.blade.php` = 171KB

**Trade-off**:
- Pro: Semua logika UI data master ada di satu tempat, mudah di-copy/modifikasi
- Kontra: File besar sulit dipelihara; kandidat untuk refaktor ke Livewire component atau komponen Blade

---

## 9. Import/Export via Maatwebsite Excel

**Keputusan**: Menggunakan paket `maatwebsite/excel ^3.1` untuk semua operasi import/export Excel

**Alasan**:
- Standar de-facto untuk Excel di ekosistem Laravel
- Mendukung import dengan validasi, mapping kolom, dan batch insert
- Export bisa dikustomisasi dengan styling, multiple sheet, dll.

---

## 10. PDF Generation: dompdf + Snappy (dual approach)

**Keputusan**: Menginstall dua library PDF — `barryvdh/laravel-dompdf` dan `barryvdh/laravel-snappy`

**Alasan**:
- dompdf: pure PHP, mudah setup, cocok untuk dokumen sederhana (kartu profil)
- Snappy (wkhtmltopdf): berbasis headless browser, kualitas rendering lebih tinggi untuk dokumen kompleks
- Keduanya ada kemungkinan digunakan untuk kasus berbeda (rapor vs kartu ID)

---

## 11. Queue Connection: Database

**Keputusan**: `QUEUE_CONNECTION=database` di `.env.example`

**Alasan**:
- Tidak memerlukan Redis/Beanstalkd untuk setup awal
- Cukup untuk volume pekerjaan background sekolah
- Mudah dimonitor via artisan; tabel jobs sudah ada dalam migrasi

---

## 12. Session Driver: Database

**Keputusan**: `SESSION_DRIVER=database` di `.env.example`

**Alasan**:
- Lebih persistent dibanding file (tidak hilang saat server restart/deploy)
- Memungkinkan invalidasi session dari admin jika diperlukan
- Konsisten dengan pendekatan "database-first" proyek ini

---

## 13. Kolom Audit (created_by, updated_by, deleted_by)

**Keputusan**: Beberapa tabel utama memiliki kolom audit `created_by`, `updated_by`, `deleted_by`

**Bukti**: Ada migrasi `add_audit_columns_to_tables.php` (2026-05-17)

**Alasan**:
- Traceability — siapa yang melakukan operasi
- Penting untuk lingkungan multi-user seperti sekolah
- Didukung juga oleh halaman "Audit Log" yang sudah ada di operator dan kepsek

---

## 14. Dapodik Field Integration

**Keputusan**: Menambahkan field-field standar Dapodik (Data Pokok Pendidikan) ke tabel siswa dan orang tua

**Bukti**: Migrasi `add_dapodik_fields_to_siswas_table` dan `add_dapodik_fields_to_orang_tuas_table` (Mei 2026)

**Alasan**:
- Sekolah madrasah wajib melaporkan data ke Dapodik Kemenag
- Dengan menyimpan field Dapodik di database lokal, sistem bisa generate laporan Dapodik langsung
- Field mencakup: alamat domisili lengkap (RT/RW/kelurahan/kecamatan/kodepos), data geografis (jarak, waktu tempuh, transportasi), data keluarga (anak ke, jumlah saudara)

---

## 15. Manajemen Gambar: Storage Public + Private

**Keputusan**: Foto profil di `storage/public`, dokumen/berkas di `storage/local`

**Alasan**:
- Foto profil boleh diakses langsung via URL (tidak sensitif)
- Dokumen siswa/guru bersifat sensitif (harus melalui controller untuk download, bukan direct URL)
- Memisahkan disk mencegah akses tidak sah ke dokumen privat
