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

> Update section ini setiap kali fitur selesai dikerjakan

- [x] Recycle Bin untuk Semester (Operator) — backend: controller + routes; frontend: API, ModalTrashSemester, SemesterPage
- [x] Perbaikan logika aktif Tahun Ajaran dan Semester (Operator) — semester hanya bisa aktif di TA yang sedang aktif
- [x] Fix bug dropdown Tahun Ajaran tidak muncul di Step 4 form tambah/edit siswa (Operator) — mismatch key `tahun_ajarans` → `tahunAjarans` di `SiswaPage.jsx:112`

### Komponen yang SUDAH STABIL — jangan diubah kecuali ada bug:
- `frontend/src/context/AuthContext.jsx` — auth context, jangan direfactor
- `frontend/src/hooks/useAuth.js` — custom hook auth
- `frontend/src/api/axios.js` — axios instance & interceptors
- `frontend/src/components/operator/ModalTrashSemester.jsx` — recycle bin semester, baru
- `frontend/dist/` — build output, JANGAN diedit manual
- `backend/ai_tools/venv/` — virtual environment Python, JANGAN disentuh

---

## 🚧 IN PROGRESS

> Update section ini dengan fitur yang sedang dikerjakan sekarang

- [ ] *(isi dengan fitur yang sedang aktif dikerjakan)*

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

## ⚠️ ATURAN UNTUK AI

1. **Fokus pada satu fitur per sesi** — jangan ubah file di luar scope yang diminta
2. **Cek section COMPLETED dulu** sebelum mengubah apapun
3. **Jangan refactor** kode yang tidak diminta direfactor
4. **Jangan ubah** struktur routing (`App.jsx`) tanpa konfirmasi
5. **Jangan ubah** `AuthContext.jsx` atau `useAuth.js` kecuali diminta eksplisit
6. **Jangan install** dependency baru tanpa konfirmasi
7. Kalau ragu apakah boleh ubah sesuatu — **tanya dulu**
8. **Update section IN PROGRESS dan COMPLETED** setelah setiap fitur selesai
