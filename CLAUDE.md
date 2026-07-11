# minurulhuda3 — Sistem Informasi Sekolah

## 🏗️ Tech Stack

### Frontend
- **Framework**: React 19 + Vite 8
- **Styling**: TailwindCSS v4
- **State Management**: Zustand v5
- **Server State**: TanStack React Query v5
- **Routing**: React Router DOM v7
- **Forms**: React Hook Form v7
- **HTTP Client**: Axios
- **Icons**: Heroicons + Lucide React
- **Linter**: OxLint

### Backend
- **Framework**: Laravel (PHP)
- **Entry points**: `backend/routes/api.php`, `backend/routes/web.php`
- **Dependencies**: `backend/composer.json`

### AI Tools (Python)
- **Location**: `backend/ai_tools/`
- **Runtime**: Python 3.10 + venv
- **Fitur**: Code search, symbol search, function search, class search, context builder, indexer, evaluator

---

## 👥 Role yang Ada di Sistem
- `Operator` — manajemen siswa (CRUD, import, mutasi, kartu siswa)
- `Guru` — akses pengajaran
- `WaliKelas` — manajemen kelas
- `Bendahara` — keuangan
- `Kepsek` — kepala sekolah / dashboard eksekutif
- `AdminPpdb` — penerimaan peserta didik baru
- `Ortu` — orang tua siswa
- `Public` — halaman publik (landing page, PPDB)

---

## ✅ COMPLETED FEATURES — DO NOT TOUCH

> Update section ini setiap kali user bilang "done" / "selesai" / "fix".
> **AI wajib baca section ini dulu sebelum nulis satu baris pun.**
> File di sini = SUDAH SELESAI = JANGAN DIMODIFIKASI kecuali user minta eksplisit fix bug.
> **Kalau user belum bilang done = JANGAN dipindahkan ke sini, masih IN PROGRESS.**

### Operator
- [x] Recycle Bin Semester — backend: controller + routes; frontend: API, ModalTrashSemester, SemesterPage
- [x] Perbaikan logika aktif Tahun Ajaran dan Semester — semester hanya bisa aktif di TA yang sedang aktif
- [x] Fix bug dropdown Tahun Ajaran tidak muncul di Step 4 form tambah/edit siswa — mismatch key `tahun_ajarans` → `tahunAjarans` di `SiswaPage.jsx:112`
- [x] Tambah/Edit Siswa — form multi-step 5 tahap: Identitas, Orang Tua, Periodik, Akademik, Konfirmasi; upload foto; data Dapodik lengkap
- [x] Detail Data Siswa — modal gabungan 7 tab: Identitas, Ortu, Periodik, Akademik+Riwayat, Prestasi, Beasiswa, Berkas; panel kiri kartu identitas; CRUD prestasi/beasiswa/berkas
- [x] Download Template Excel — ganti `<a href>` langsung (tanpa token) → download via axios blob (Bearer token otomatis)
- [x] Import Siswa dari Excel — ganti raw `fetch` → `siswaAPI.import` pakai axios instance (auth, CSRF, credentials); fix duplicate heading slug; fix `firstOrCreate` → `updateOrCreate` agar re-import update field Orang Tua
- [x] Recycle Bin Siswa — backend: controller + routes (destroy, trash, restore, forceDelete); pagination 10/halaman; cascade soft-delete ke riwayat_kelas, nilais, absensis, rapors, catatan_walis, perkembangans
- [x] Export Data Siswa (ZIP & PDF) — fix bug URL salah `/operator/data-siswa/export` (tanpa `/api` prefix) + token tidak terkirim; ganti `<a href>` → axios blob download via `siswaAPI.exportData`; tambah loading state; files: `operator.js`, `SiswaPage.jsx`

### Guru
- [ ] *(belum ada)*

### Wali Kelas
- [ ] *(belum ada)*

### Bendahara
- [ ] *(belum ada)*

### Kepsek
- [ ] *(belum ada)*

### Admin PPDB
- [ ] *(belum ada)*

### Ortu
- [ ] *(belum ada)*

### Public
- [ ] *(belum ada)*

### Komponen yang SUDAH STABIL — jangan diubah kecuali ada bug:
- `frontend/src/context/AuthContext.jsx` — auth context, jangan direfactor
- `frontend/src/hooks/useAuth.js` — custom hook auth
- `frontend/src/api/axios.js` — axios instance & interceptors
- `frontend/src/pages/operator/TahunAjaranPage.jsx` — halaman tahun ajaran, CRUD + recycle bin
- `frontend/src/pages/operator/SemesterPage.jsx` — halaman semester, CRUD + recycle bin
- `frontend/src/components/operator/ModalTrashSemester.jsx` — recycle bin semester
- `frontend/src/components/operator/ModalTrashTahunAjaran.jsx` — recycle bin tahun ajaran
- `frontend/dist/` — build output, JANGAN diedit manual
- `backend/ai_tools/venv/` — virtual environment Python, JANGAN disentuh

---

## 🚧 IN PROGRESS — Sedang Dikerjakan
 
> Update section ini setiap kali mulai mengerjakan fitur baru.
> Hanya boleh ada 1 fitur aktif di sini per sesi.
> **Jangan pindahkan ke COMPLETED sampai user secara eksplisit bilang "done" / "selesai" / "fix".**
 
- [ ] *(kosong — belum ada sesi aktif)*

---

## ❌ NEVER MODIFY — Tanpa Izin Eksplisit

- `frontend/dist/` — hasil build otomatis, selalu di-generate ulang via `npm run build`
- `backend/ai_tools/venv/` — Python virtual environment
- `backend/vendor/` — Laravel vendor (dikelola composer)
- `frontend/node_modules/` — dikelola npm
- `.env` / `.env.example` — konfigurasi environment sensitif
- `package-lock.json` / `composer.lock` — jangan diedit manual

---

## 📁 Struktur Project

```
minurulhuda3/
├── frontend/                  # React App (Vite)
│   ├── src/
│   │   ├── api/               # Axios API calls per domain
│   │   │   ├── axios.js       # Base axios instance
│   │   │   └── operator.js    # API calls untuk operator
│   │   ├── components/
│   │   │   ├── layouts/       # Sidebar & layout per role
│   │   │   └── operator/      # Komponen khusus operator
│   │   ├── context/           # React context (Auth)
│   │   ├── hooks/             # Custom hooks
│   │   └── App.jsx            # Root component & routing
│   └── dist/                  # Build output (auto-generated)
│
├── backend/                   # Laravel App
│   ├── routes/
│   │   ├── api.php            # API routes
│   │   └── web.php            # Web routes
│   ├── ai_tools/              # Python AI utilities
│   │   └── code_search/       # Code indexer & searcher
│   └── vendor/                # Composer packages
│
└── CLAUDE.md                  # File ini
```

---

## 🔧 Cara Kerja / Konvensi Kode

### Frontend
- Setiap **role** punya **Sidebar** tersendiri di `components/layouts/`
- API calls dikelompokkan per domain di folder `src/api/`
- Gunakan **React Query** untuk semua server state (fetch, mutasi)
- Gunakan **Zustand** untuk client-side global state
- Form menggunakan **React Hook Form**, jangan pakai controlled state biasa
- Styling hanya dengan **TailwindCSS**, tidak ada inline style atau CSS tambahan kecuali `App.css` & `index.css`

### Backend (Laravel)
- API endpoint didefinisikan di `backend/routes/api.php`
- Ikuti konvensi RESTful Laravel

### AI Tools (Python)
- Semua tool ada di `backend/ai_tools/`
- Jalankan via venv: `source backend/ai_tools/venv/bin/activate`
- Entry point utama: `run_index.py`, `evaluator.py`

---

## 🚀 Cara Menjalankan

```bash
# Frontend
cd frontend
npm install
npm run dev          # development
npm run build        # production build

# Backend (Laravel)
cd backend
composer install
php artisan serve

# AI Tools (Python)
cd backend/ai_tools
source venv/bin/activate
python run_index.py
```

---

## ⚠️ ATURAN AI — WAJIB DIIKUTI
 
### Sebelum Mulai

1. **Baca section COMPLETED dulu** — semua file di sana tidak boleh diubah tanpa izin eksplisit user.
2. **Tulis fitur ke IN PROGRESS dulu** sebelum mulai mengerjakan apapun.
3. **Konfirmasi scope** — pastikan sudah paham apa yang diminta sebelum nulis kode.

### Selama Mengerjakan

4. **Satu sesi = satu fitur** — jangan ubah file di luar scope yang sedang dikerjakan.
5. **Jangan refactor** kode yang tidak diminta direfactor, meskipun kelihatan bisa diperbaiki.
6. **Jangan ubah** `router/index.jsx`, `AuthContext.jsx`, `useAuth.js`, atau `axios.js` tanpa konfirmasi eksplisit.
7. **Jangan install** dependency baru tanpa konfirmasi user.
8. **Kalau ragu apakah boleh ubah sesuatu — tanya dulu, jangan asumsi boleh.**

### Soal Status Fitur

9. **Fitur HANYA boleh dipindahkan ke COMPLETED kalau user sudah bilang secara eksplisit**: "done", "selesai", "udah beres", "fix", atau kata setara lainnya.
10. **Selama user belum bilang done = fitur masih IN PROGRESS** — meskipun kode sudah ditulis, meskipun kelihatan sudah berjalan.
11. **Jangan auto-complete** — jangan anggap fitur selesai hanya karena AI sudah selesai menulis kodenya.
12. **Jangan pindahkan** fitur dari IN PROGRESS ke COMPLETED atas inisiatif sendiri.

### Setelah Selesai (hanya jika user bilang done)

13. Centang `[x]` di IN PROGRESS, lalu pindahkan ke section COMPLETED role yang sesuai.
14. Kosongkan IN PROGRESS (isi kembali jadi `- [ ] *(kosong)*`).
15. Hapus item dari list BELUM DIKERJAKAN kalau sudah selesai.

### 🧠 Aturan Eksekusi & Kualitas Kode (Power Rules)

16. **Search Before Write:** Wajib gunakan AI tools (`code_search`, `symbol_search`, dll) untuk memeriksa model, kolom database, atau komponen eksis sebelum menulis kode baru. Dilarang menebak nama variabel/kolom/fungsi!
17. **Plan Before Code:** Untuk fitur baru/kompleks, berikan rancangan alur (flow & struktur API/State) terlebih dahulu dan tunggu persetujuan user sebelum generate kode.
18. **Re-use Over Re-create:** Cek komponen atau helper yang sudah ada sebelum membuat baru. Hindari duplikasi kode.
19. **Mandatory Auth & Role Check:** Setiap endpoint Laravel baru WAJIB dilengkapi middleware/Policy/Gate yang sesuai dengan 8 role yang ada. Jangan pernah membuat endpoint tanpa proteksi role.
20. **Root Cause Analysis:** Saat fix bug, jelaskan AKAR MASALAH-nya terlebih dahulu sebelum memberikan solusi. Dilarang memberi solusi tambal sulam (band-aid fix).
21. **Targeted Output:** Saat mengedit file panjang, berikan HANYA bagian kode yang diubah (gunakan komentar `// ... existing code ...`). Jangan mencetak ulang seluruh file jika tidak perlu.
22. **No Over-Engineering:** Fokus 100% pada requirement. Jangan menambahkan fitur tambahan, styling berlebihan, atau refactor kode lain yang tidak diminta.

### 🛡️ Aturan Keamanan Database & Migrasi (DB Safety First)

23. **DILARANG KERAS `migrate:fresh` / `migrate:reset`:** Jangan pernah menyarankan atau menjalankan perintah migrasi yang destruktif (seperti `php artisan migrate:fresh`, `migrate:refresh`, atau `db:seed` ulang total) tanpa izin eksplisit dari user. Data yang ada di database adalah SUCI dan tidak boleh hilang/ke-reset!
24. **Dilarang Edit File Migrasi Lama:** Jika perlu mengubah struktur tabel (tambah kolom, ubah tipe data, hapus kolom), **WAJIB buat file migrasi baru** (contoh: `add_status_to_siswas_table`). Jangan pernah mengedit file migrasi yang sudah pernah di-run sebelumnya agar tidak terjadi bentrok skema atau error di environment lain.
25. **Cek Skema Sebelum Query (Anti-Error SQL):** Sebelum menulis query Eloquent atau Raw SQL, **wajib periksa nama tabel dan kolom yang sebenarnya ada** (gunakan tool `code_search` untuk melihat model/migrasi). Jangan berasumsi! Ini wajib dilakukan untuk mencegah error `SQLSTATE[42S22]: Column not found` atau `Table '...' doesn't exist`.
26. **Jaga Integritas Relasi (Foreign Key & Cascade):** Database sekolah memiliki relasi yang dalam (Siswa → Kelas → Nilai / Absensi / Keuangan). Saat membuat tabel baru atau fitur hapus, pastikan *Foreign Key constraint* dan logika *Cascade* (atau Soft Deletes) dipikirkan matang-matang agar tidak ada *orphan data* (data yatim/tergantung) atau error *constraint violation* saat menghapus data.
27. **Aman Saat Seeding & Import:** Saat membuat Seeder atau fitur import data (Excel/CSV), hindari method `create()` biasa yang bisa memicu error *duplicate entry / unique constraint*. Gunakan `updateOrCreate()` atau `firstOrCreate()` dengan parameter *unique key* yang tepat agar data aman jika dijalankan berulang kali.
28. **Konsistensi Penamaan (Naming Convention):** Wajib ikuti standar Laravel untuk penamaan tabel (snake_case plural: `tahun_ajarans`, `riwayat_kelas`) dan foreign key (`siswa_id`, `wali_kelas_id`). Jangan campur aduk dengan camelCase di tingkat database!