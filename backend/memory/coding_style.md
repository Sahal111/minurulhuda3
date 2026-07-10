# Coding Style — minurulhuda3

> Diperbarui: 2026-06-13
> Dokumen ini merangkum konvensi penulisan kode dan standar yang digunakan dalam proyek ini berdasarkan observasi pada kode sumber yang ada.

## 1. Konvensi Penamaan (Naming Conventions)

### PHP & Laravel
- **Class (Controllers, Models, Services, Middleware):** Menggunakan `PascalCase`. Contoh: `SiswaController`, `RiwayatKelasService`, `RoleMiddleware`.
- **Method (Fungsi):** Menggunakan `camelCase`. Contoh: `exportData()`, `closeLatestOpenHistory()`, `forceDelete()`.
- **Variabel:** Menggunakan `camelCase` secara umum (`$tahunAjaranId`, `$totalSiswaAktif`), namun sering menggunakan `snake_case` jika langsung merepresentasikan nama kolom database (`$request->nama_ayah`).
- **Tabel Database:** Menggunakan `snake_case` dan bentuk jamak (plural). Contoh: `siswas`, `gurus`, `orang_tuas`, `guru_jabatans`.
- **Kolom Database:** Menggunakan `snake_case`. Contoh: `jenis_kelamin`, `tempat_lahir`.

### Blade Views
- Penamaan file view cenderung bervariasi, namun pola yang dominan adalah:
  - **camelCase** untuk halaman data/dashboard: `dataSiswa.blade.php`, `dataGuru.blade.php`, `materiTugas.blade.php`.
  - **kebab-case** untuk halaman sub-menu atau ekspor: `rekap-absensi.blade.php`, `kartu-guru.blade.php`. *(Needs Verification: Sebaiknya distandarisasi ke depan)*
  - **Prefix Underscore (`_`)** untuk file partial / komponen yang di-include: `_modalKartuSiswa.blade.php`, `_tableGuru.blade.php`.

## 2. Praktik PHP & Laravel Modern (PHP 8.x)

Proyek ini aktif memanfaatkan fitur-fitur PHP 8.2+ dan Laravel modern:
- **Constructor Property Promotion:** Digunakan untuk injeksi dependensi. Contoh: `public function __construct(private RiwayatKelasService $riwayatKelasService)`
- **Arrow Functions:** Sering digunakan untuk closure sederhana pada Eloquent query. Contoh: `fn($q) => $q->search($keyword)`
- **Match Expression:** Digunakan untuk menggantikan `switch` statement yang panjang. Contoh: `return match ($mode) { ... }`
- **Nullsafe Operator (`?->`):** Banyak digunakan untuk menghindari error *null on member access* saat mengakses relasi. Contoh: `$guru->currentJabatan?->jabatan`
- **Named Arguments:** Tidak terlalu mendominasi, namun disupport.

## 3. Struktur & Arsitektur Kode

### Eloquent & Database
- **Eager Loading:** Sangat ditekankan menggunakan `with()` untuk menghindari masalah N+1 query problem. Contoh: `Siswa::with(['kelas.waliKelas', 'orangTuas'])`.
- **Database Transactions:** Digunakan secara konsisten (`DB::transaction`) untuk operasi `store` dan `update` yang melibatkan manipulasi data di banyak tabel sekaligus (mis. menyimpan data siswa, data tambahan, dan riwayat kelas).
- **Soft Deletes:** Menggunakan trait `SoftDeletes`. Menariknya, sistem menggunakan event `boot` pada model untuk mengimplementasikan manual cascading saat menghapus/memulihkan data relasional (contoh: di `Siswa::boot()` dan `Guru::boot()`).

### Controller
- **Fat Controller vs Service:** Kebanyakan controller (terutama untuk Operator) memuat logika yang cukup tebal (Fat Controller) untuk urusan upload file dan validasi. Namun, logika bisnis khusus yang rumit diekstrak ke Service layer (mis. `RiwayatKelasService`).
- **Validasi:** Menggunakan metode validasi langsung dari objek Request (`$request->validate([...])`) daripada membuat file FormRequest terpisah (walau foldernya tersedia).

## 4. Format Dokumen & Formatting

Berdasarkan konfigurasi `.editorconfig`:
- **Indentation:** 4 spasi untuk PHP/JS/CSS, 2 spasi untuk YAML.
- **Line Endings:** `LF` (Unix-style).
- **Charset:** `utf-8`.
- **Trailing Whitespace:** Dihapus otomatis, kecuali untuk file Markdown (`.md`).
- **Final Newline:** Selalu menambahkan baris kosong di akhir file.

## 5. Komentar dan Dokumentasi Kode

- Controller yang panjang menggunakan pemisah blok komentar yang jelas untuk memisahkan fungsi CRUD. Contoh:
  ```php
  // ─────────────────────────────────────────
  // STORE  (POST /data-siswa/store)
  // ─────────────────────────────────────────
  ```
- Method yang kompleks sering kali disertai dengan komentar penjelas yang mengacu pada aturan domain (contoh: `// Dapodik: Alamat & Domisili Siswa`).

---
*Catatan: Dokumen ini sebaiknya dijadikan pedoman utama untuk kontribusi fitur baru agar gaya penulisan kode tetap konsisten.*
