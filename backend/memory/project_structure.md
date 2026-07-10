# Project Structure — minurulhuda3

> Diperbarui: 2026-06-13
> Dokumen ini dirancang sebagai panduan cepat (index) bagi asisten AI untuk memetakan arsitektur folder dan file terkait dari fitur-fitur di dalam repositori tanpa perlu memindai (scan) seluruh direktori berulang kali.

## 1. Ringkasan Struktur Folder Utama

Proyek ini berbasis framework **Laravel 11**. Sebagian besar logika dan tampilan terletak di folder standar Laravel:

- **`app/`** — Berisi logika bisnis (Backend)
  - `Http/Controllers/` — Pengendali rute (*controllers*). Khusus peran admin/operator ada di subfolder `Operator/`.
  - `Http/Middleware/` — Penyaring *request* (RBAC & Auth).
  - `Models/` — Pemodelan database (Eloquent).
  - `Services/` — Logika *domain* yang kompleks di luar *controller*.
  - `Exports/` & `Imports/` — Kelas utilitas untuk ekspor/impor Excel/CSV.
- **`routes/`** — Definisi *routing* aplikasi.
- **`resources/views/`** — Tampilan antarmuka (*Blade templates*). Dipisah per folder peran (`operator`, `guru`, `kepsek`, dll).
- **`database/`** — Definisi skema (migrations) dan data awal (seeders).
- **`public/`** — Aset publik dan *entry point* (index.php).

## 2. Mapping Fitur ke File Terkait

Gunakan pemetaan ini untuk langsung menuju file yang relevan saat mengerjakan fitur tertentu:

| Modul/Fitur | Controller Utama | Model Terkait | View (Blade) Utama |
|---|---|---|---|
| **Otentikasi & RBAC** | `AuthController.php` | `User`, `Role` | `auth/login`, `auth/register` |
| **Data Siswa (Operator)** | `Operator/SiswaController.php` | `Siswa`, `OrangTua`, `RiwayatKelas` | `operator/dataSiswa.blade.php`, `partials/_modalKartuSiswa.blade.php` |
| **Data Guru (Operator)** | `Operator/GuruController.php` | `Guru`, `GuruJabatan`, `GuruDiklat`, dll. | `operator/dataGuru.blade.php`, `partials/_modalKartuGuru.blade.php` |
| **Manajemen Akademik** | `Operator/KelasController.php`, `TahunAjaranController.php` | `Kelas`, `Mapel`, `TahunAjaran`, `Semester` | `operator/dataKelas.blade.php`, `operator/tahunAjaran.blade.php` |
| **Halaman Publik** | `HomeController.php` | - | `welcome.blade.php`, `profile.blade.php`, `ppdb.blade.php` |

## 3. Entry Point Aplikasi

1. **HTTP Request Entry Point:** `public/index.php` (standar Laravel).
2. **Routing Entry Point:** `routes/web.php` (Semua pendaftaran _route_ dan grup *middleware* ada di file tunggal ini. File ini memiliki lebih dari 300 baris dan menjadi peta jalan utama untuk semua URL).
3. **Middleware Utama:** `app/Http/Middleware/RoleMiddleware.php` (menangani gerbang masuk *role-based access control* / RBAC).

## 4. Status Setiap Modul

Daftar berikut merangkum tingkat kesiapan fungsional tiap *role* berdasarkan ketersediaan **UI (View)** dan **Logic (Controller)**:

- **Auth & Publik:** ✅ Selesai (UI dan logika berjalan utuh).
- **Modul Operator:** ✅ Stabil (Data Guru, Siswa, Kelas, Manajemen Akun memiliki operasi CRUD dan import/export yang lengkap).
- **Modul Guru & Wali Kelas:** ⚠️ *Needs Verification* (UI/Views untuk dashboard, nilai, dan jadwal sudah ada, tetapi di `routes/web.php` masih menggunakan *closure* langsung ke *view* tanpa Controller).
- **Modul Kepsek:** ⚠️ *Needs Verification* (UI ada, Controller belum ada).
- **Modul Bendahara:** ⚠️ *Needs Verification* (UI ada, Controller belum ada).
- **Modul Admin PPDB:** ⚠️ *Needs Verification* (UI ada, Controller belum ada).
- **Modul Orang Tua (Ortu):** ⚠️ *Needs Verification* (UI ada, Controller belum ada).

## 5. Dependency Penting Antar Modul

Pemetaan ini berguna untuk memahami dampak jika sebuah model atau logika diubah:

- **Pusat Ketergantungan (User & RBAC):** Hampir semua profil peran (Siswa, Guru, Admin) terhubung (dependen) secara opsional maupun wajib ke tabel `users` (Model `User.php`). Jika `User` dihapus, cascade atau logic *cleanup* harus diperhatikan.
- **Siswa ↔ Akademik:** Modul `Siswa` sangat terikat pada model `Kelas`, `TahunAjaran`, dan tabel `riwayat_kelas`. Manipulasi perpindahan/kenaikan kelas dikelola terpusat oleh `app/Services/RiwayatKelasService.php`.
- **Soft Deletes Cascade (Guru & Siswa):** Model `Guru` dan `Siswa` mengimplementasikan *custom soft deletes* di dalam *method* `boot()` mereka masing-masing. Menghapus satu relasi akan berdampak pada relasi bersarang lainnya. Perhatikan siklus hidup ini jika Anda ingin mengedit atau menghapus data mereka.
- **Library Eksternal Utama:** 
  - Ekspor/Impor Excel: Bergantung penuh pada `maatwebsite/excel`. Logic berada di direktori `app/Exports/` dan `app/Imports/`.
  - Ekspor PDF: Bergantung pada `barryvdh/laravel-dompdf` (rendering kartu dan laporan PDF langsung dari sintaks Blade HTML).
