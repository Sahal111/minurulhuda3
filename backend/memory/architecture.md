# Architecture — minurulhuda3

> Diperbarui: 2026-06-13

## Pola Arsitektur

Proyek ini mengikuti pola **MVC (Model-View-Controller)** standar Laravel dengan beberapa ekstensi:

- **Service Layer**: `app/Services/` untuk logika bisnis kompleks
- **Import/Export Layer**: `app/Imports/` dan `app/Exports/` untuk operasi Excel
- **Middleware**: Otentikasi + otorisasi berbasis peran (RBAC)
- **Blade Partials**: View besar dipecah menjadi partial untuk modularitas

---

## Lapisan Autentikasi & Otorisasi

### RoleMiddleware
`app/Http/Middleware/RoleMiddleware.php`

- Melindungi semua route bertanda `['auth', 'role:<nama>']`
- Menggunakan `auth()->user()->hasRole($role)` — dicek via relasi many-to-many `users ↔ roles`
- Redirect ke `/login` jika belum auth, `abort(403)` jika tidak punya role

### Tabel Role
- `roles` — daftar role: `operator`, `guru`, `kepsek`, `bendahara`, `admin_ppdb`, `ortu`
- `role_user` — pivot table users ↔ roles (many-to-many)
- Satu user bisa memiliki lebih dari satu role

---

## Model & Database

### 42 Eloquent Models

**Core / Infrastruktur:**
| Model | Tabel | Keterangan |
|-------|-------|-----------|
| `User` | `users` | Autentikasi; relasi ke semua profil peran |
| `Role` | `roles` | RBAC roles |
| `TahunAjaran` | `tahun_ajarans` | Tahun ajaran akademik; `is_active` flag |
| `Semester` | `semesters` | Semester per tahun ajaran; `is_active` flag |

**Modul Siswa:**
| Model | Tabel | Keterangan |
|-------|-------|-----------|
| `Siswa` | `siswas` | Data utama siswa; SoftDeletes dengan cascade |
| `OrangTua` | `orang_tuas` | Data ayah/ibu; many-to-many via `orang_tua_siswa` |
| `RiwayatKelas` | `riwayat_kelas` | Log perpindahan/naik/turun kelas siswa |
| `MutasiSiswa` | `mutasi_siswas` | Mutasi masuk/keluar |
| `PerkembanganSiswa` | `perkembangan_siswas` | Catatan perkembangan periodik |
| `BerkasSiswa` | `berkas_siswas` | Dokumen digital siswa (file storage) |
| `Prestasi` | `prestasis` | Prestasi akademik/non-akademik + file bukti |
| `Beasiswa` | `beasiswas` | Data beasiswa siswa |
| `DataTambahanSiswa` | `data_tambahan_siswas` | Data tambahan Dapodik |
| `ProgramKesejahteraanSiswa` | `program_kesejahteraan_siswas` | Program bantuan |

**Modul Guru:**
| Model | Tabel | Keterangan |
|-------|-------|-----------|
| `Guru` | `gurus` | Data utama guru; SoftDeletes + cascade ke sub-tabel |
| `GuruJabatan` | `guru_jabatans` | Riwayat jabatan guru; `is_current` flag |
| `GuruPendidikan` | `guru_pendidikans` | Riwayat pendidikan formal |
| `GuruSertifikasi` | `guru_sertifikasis` | Data sertifikasi profesi |
| `GuruRekening` | `guru_rekenings` | Data rekening bank + gaji |
| `GuruKeluarga` | `guru_keluargas` | Data keluarga/status perkawinan |
| `GuruMapel` | `guru_mapels` | Mapping guru ↔ mata pelajaran |
| `GuruDiklat` | `guru_diklats` | Riwayat pelatihan/diklat + sertifikat |
| `GuruInpassing` | `guru_inpassings` | Riwayat inpassing + SK; `status: aktif` |
| `GuruDokumen` | `guru_dokumens` | Dokumen digital guru + verifikasi |
| `GuruAbsensi` | `guru_absensis` | Absensi kehadiran guru |

**Modul Akademik:**
| Model | Tabel | Keterangan |
|-------|-------|-----------|
| `Kelas` | `kelas` | Data kelas; `wali_kelas_id`, `kapasitas` |
| `Mapel` | `mapels` | Mata pelajaran |
| `Jadwal` | `jadwals` | Jadwal pelajaran |
| `PlotGuruMapel` | `plot_guru_mapels` | Penugasan guru-mapel per kelas |
| `WaliKelas` | `wali_kelas` | Riwayat wali kelas per semester |
| `Absensi` | `absensis` | Absensi siswa |
| `Nilai` | `nilais` | Nilai siswa; refactored dengan histori |
| `KomponenPenilaian` | `komponen_penilaians` | Komponen penilaian (UH, UTS, dll) |
| `Rapor` | `rapors` | Rapor siswa; `status_kenaikan` |
| `CatatanWali` | `catatan_walis` | Catatan dari wali kelas untuk siswa |

**Modul Keuangan:**
| Model | Tabel | Keterangan |
|-------|-------|-----------|
| `Pembayaran` | `pembayarans` | Transaksi pembayaran SPP |
| `Tagihan` | `tagihans` | Tagihan per siswa; `kategori` |
| `Bendahara` | `bendaharas` | Profil bendahara |

**Modul PPDB:**
| Model | Tabel | Keterangan |
|-------|-------|-----------|
| `CalonSiswa` | `calon_siswas` | Data calon siswa pendaftar |
| `BerkasPendaftar` | `berkas_pendaftars` | Berkas dokumen pendaftar |
| `PembayaranPpdb` | `pembayaran_ppdb` | Pembayaran biaya pendaftaran |
| `AdminPpdbProfile` | `admin_ppdb_profiles` | Profil admin PPDB |

---

## Soft Delete & Cascade

Dua model utama mengimplementasikan **custom cascade soft-delete** via boot events:

### `Siswa` (SoftDeletes)
- **Soft delete** → ikut ter-soft-delete: `riwayat_kelas`, `nilais`, `absensis`, `rapors`, `catatan_walis`, `perkembangans`
- **TIDAK ikut soft-delete**: `pembayarans` (standar audit keuangan)
- **Restore** → semua relasi di-restore bersamaan (berdasarkan `deleted_at >= deletedAt - 5s`)
- **Force delete** → hapus foto profil, semua berkas fisik, detach orang tua, hapus akun `User` terkait

### `Guru` (SoftDeletes)
- **Soft delete** → cascade ke: `jabatans`, `pendidikans`, `sertifikasis`, `rekening`, `keluarga`, `guruMapels`, `dokumens`, `diklats`, `inpassings`
- **Restore** → semua relasi di-restore bersamaan
- **Force delete** → hapus foto & semua file dokumen fisik dari storage

---

## Service Layer

### `RiwayatKelasService`
`app/Services/RiwayatKelasService.php`

Mengelola semua operasi pencatatan riwayat perpindahan kelas siswa:

| Method | Fungsi |
|--------|--------|
| `recordClassMove()` | Catat pindah kelas |
| `recordReactivation()` | Catat siswa aktif kembali |
| `recordTerminalEvent()` | Catat event terminal (lulus/mutasi keluar/nonaktif) |
| `recordPromotion()` | Catat naik/tinggal kelas (proses tahunan) |
| `closeLatestOpenHistory()` | Tutup riwayat terbuka (set `tanggal_keluar`) |
| `normalizeExistingHistories()` | Audit & normalisasi data histori lama |
| `activeSemesterName()` | Ambil nama semester aktif |
| `activeTahunAjaranId()` | Ambil ID tahun ajaran aktif |

**Jenis perubahan (enum)**:
`naik_kelas`, `turun_kelas`, `pindah_kelas`, `masuk_baru`, `mutasi_masuk`, `mutasi_keluar`, `lulus`, `masuk_kembali`, `nonaktif`

---

## Import / Export

### Export (Excel + PDF)
| Class | Output |
|-------|--------|
| `GuruExport` | Excel data guru lengkap |
| `GuruTemplateExport` | Template import kosong untuk guru |
| `SiswaExport` | Excel data siswa lengkap |
| `SiswaTemplateExport` | Template import kosong untuk siswa |
| `GuruController::exportPdf()` | PDF kartu profil guru (dompdf) |
| `SiswaController::exportPdfSatu()` | PDF kartu profil siswa (dompdf) |

### Import (Excel → DB)
| Class | Fungsi |
|-------|--------|
| `GuruImport` | Bulk insert/update guru dari Excel |
| `SiswaImport` | Bulk insert/update siswa dari Excel |

---

## Routing

File tunggal `routes/web.php` (307 baris) mengorganisasi semua route dalam kelompok middleware:

```
[PUBLIC]          GET /  /profile  /program  /gallery  /ppdb
[AUTH]            GET/POST /login  /register
                  POST /logout
[role:ortu]       /ortu/*
[role:guru]       /guru/*  /guru/wali/*
[role:kepsek]     /kepsek/*
[role:operator]   /operator/*  (full CRUD: siswa, guru, kelas, mapel, dll)
[role:bendahara]  /bendahara/*
[role:admin_ppdb] /adminPpdb/*
```

Route operator paling kompleks dengan CRUD lengkap untuk:
- Data Siswa (termasuk berkas, prestasi, beasiswa)
- Data Guru (termasuk diklat, inpassing, dokumen)
- Kelas, Mata Pelajaran, Semester, Tahun Ajaran
- Manajemen Akun User

---

## Frontend Stack

- **Tailwind CSS v3** — utility-first styling
- **Alpine.js v3** — reactive JavaScript ringan (interaktivitas UI)
- **Livewire v4** — komponen server-side reactive (digunakan selektif)
- **Vite 6** — bundler modern; hot reload saat development
- **Blade Components**: `AppLayout`, `GuestLayout`

### Layout Blade
| File | Digunakan oleh |
|------|----------------|
| `layouts/app.blade.php` | Layout utama umum |
| `layouts/operator.blade.php` | Dashboard operator |
| `layouts/guru.blade.php` | Dashboard guru |
| `layouts/kepsek.blade.php` | Dashboard kepsek |
| `layouts/bendahara.blade.php` | Dashboard bendahara |
| `layouts/ortu.blade.php` | Dashboard ortu |
| `layouts/ppdb.blade.php` | Area PPDB publik |

---

## File Storage

- **`storage/app/public/`** — Foto guru, foto siswa (accessible via symlink)
- **`storage/app/local/`** (private) — Berkas digital siswa
- Disk `public` untuk foto profil; disk `local` untuk dokumen privat
- File dihapus secara eksplisit saat force delete model

---

## Database: 103 Migrasi

Periode pengembangan migrasi:
- **Feb 2026**: Struktur dasar (users, roles, guru, kelas, siswa, orang tua, jadwal, nilai, absensi, pembayaran, rapor, PPDB)
- **Apr–Mei 2026**: Ekspansi besar-besaran — Dapodik fields, modul guru lengkap (jabatan, pendidikan, sertifikasi, rekening, keluarga, diklat, inpassing, dokumen, absensi), refaktor nilais, tagihan, riwayat kelas, prestasi, beasiswa, data tambahan siswa
