# Project Overview — MI Nurul Huda 3 (minurulhuda3)

> Diperbarui: 2026-06-13

## Nama & Tujuan Proyek

**minurulhuda3** adalah Sistem Informasi Manajemen Sekolah (SIMS) berbasis web untuk **Madrasah Ibtidaiyah (MI) Nurul Huda 3** — sekolah dasar tingkat Islam di Indonesia. Sistem ini dirancang untuk mendigitalisasi seluruh proses administrasi sekolah, mulai dari penerimaan peserta didik baru (PPDB) hingga pengelolaan data guru, siswa, keuangan, dan akademik.

## Tech Stack

| Layer        | Teknologi                        |
|--------------|----------------------------------|
| Framework    | Laravel 11 (PHP ^8.2)            |
| Database     | MySQL (production) / SQLite (dev)|
| Frontend     | Blade Templates + Alpine.js + Tailwind CSS v3 |
| Build Tool   | Vite 6 + Laravel Vite Plugin     |
| PDF          | barryvdh/laravel-dompdf + barryvdh/laravel-snappy |
| Excel        | maatwebsite/excel ^3.1           |
| QR Code      | simplesoftwareio/simple-qrcode   |
| Real-time    | Livewire v4                      |
| Testing      | PestPHP v3                       |
| Dev Tools    | Laravel Pail, Laravel Pint, Laravel ERD, Faker |

## Modul & Peran Pengguna

Sistem menggunakan RBAC (Role-Based Access Control) dengan **7 peran utama**:

| Peran          | Namespace Prefix | Deskripsi                                              |
|----------------|------------------|--------------------------------------------------------|
| `operator`     | `/operator/`     | Admin sekolah; pengelola data guru, siswa, kelas, akademik |
| `guru`         | `/guru/`         | Guru pengajar; akses jadwal, absensi, penilaian, rekap |
| `wali_kelas`   | `/guru/wali/`    | Sub-peran guru; akses khusus data kelasnya             |
| `kepsek`       | `/kepsek/`       | Kepala Sekolah; monitoring semua bidang                |
| `bendahara`    | `/bendahara/`    | Pengelola keuangan, SPP, laporan keuangan              |
| `admin_ppdb`   | `/adminPpdb/`    | Admin PPDB; pendaftaran calon siswa baru               |
| `ortu`         | `/ortu/`         | Orang tua / wali murid; akses nilai, absensi, SPP anak |

## Halaman Publik

- `/` — Landing page sekolah (welcome)
- `/profile` — Profil sekolah
- `/program` — Program-program sekolah
- `/gallery` — Galeri foto
- `/ppdb` — Informasi Penerimaan Peserta Didik Baru

## Lokasi File Konfigurasi Utama

| File                  | Isi                                               |
|-----------------------|---------------------------------------------------|
| `.env` / `.env.example` | Konfigurasi environment (DB, Mail, App)         |
| `composer.json`       | Dependensi PHP & skrip dev                        |
| `package.json`        | Dependensi JS (Tailwind, Alpine, Vite)            |
| `tailwind.config.js`  | Konfigurasi Tailwind CSS                          |
| `vite.config.js`      | Konfigurasi bundler frontend                      |
| `phpunit.xml`         | Konfigurasi testing                               |
| `database/database.sqlite` | SQLite dev database (sudah terisi)           |

## Struktur Direktori Utama

```
minurulhuda3/
├── app/
│   ├── Console/
│   ├── Exports/         # Excel export (Guru, Siswa)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Operator/    # 9 controller utama operator
│   │   │   ├── AuthController.php
│   │   │   ├── HomeController.php
│   │   │   ├── AdminUserController.php
│   │   │   └── ProfileController.php
│   │   ├── Middleware/
│   │   │   └── RoleMiddleware.php
│   │   └── Requests/
│   ├── Imports/         # Excel import (Guru, Siswa)
│   ├── Models/          # 42 Eloquent models
│   ├── Providers/
│   ├── Services/
│   │   └── RiwayatKelasService.php
│   └── View/Components/
├── database/
│   ├── migrations/      # 103 file migrasi
│   ├── seeders/         # 6 seeder
│   └── database.sqlite
├── resources/
│   ├── views/
│   │   ├── layouts/     # 7 layout Blade
│   │   ├── operator/    # 20+ view
│   │   ├── guru/        # 8 view + sub-wali
│   │   ├── kepsek/      # 10 view
│   │   ├── bendahara/   # 7 view
│   │   ├── adminPpdb/   # 11 view
│   │   ├── ortu/        # 7 view
│   │   └── [halaman publik]
│   ├── css/
│   └── js/
├── routes/
│   └── web.php          # 307 baris, semua route
├── docs/erd/            # ERD diagram
└── memory/              # Dokumentasi proyek ini
```
