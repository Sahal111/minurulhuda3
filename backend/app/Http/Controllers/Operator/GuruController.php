<?php

namespace App\Http\Controllers\Operator;

use App\Exports\GuruExport;
use App\Exports\GuruTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\GuruImport;
use App\Models\Guru;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class GuruController extends Controller
{
    // ==================== INDEX ====================

    public function index(Request $request)
    {
        $filters = $this->filtersFromRequest($request);
        $query = $this->applyFilters(Guru::with(['kelasWali', 'user', 'currentJabatan', 'rekening', 'keluarga', 'pendidikans', 'sertifikasis']), $filters);

        $guru = $query->latest()->paginate(10)->withQueryString();
        $stats = $this->getStats();

        // Daftar user dengan role guru/wali_kelas untuk assign akun
        $userGuru = \App\Models\User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['guru', 'wali_kelas']);
        })->orderBy('name')->get(['id', 'name', 'email']);

        // Daftar user yang belum di-assign ke guru manapun (termasuk yang sedang di-assign ke guru di halaman ini)
        $guruIds = $guru->pluck('id')->toArray();
        $availableUsers = \App\Models\User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['guru', 'wali_kelas']);
        })
            ->where(function ($q) use ($guruIds) {
                $q
                    ->whereDoesntHave('guru')
                    ->orWhereHas('guru', fn($q2) => $q2->whereIn('id', $guruIds));
            })
            ->orderBy('name')
            ->get(['id', 'name', 'email']);

        $masterMapel = \App\Models\Mapel::orderBy('nama_mapel')->pluck('nama_mapel', 'nama_mapel')->toArray();
        $masterKelas = \App\Models\Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get()->mapWithKeys(function ($k) {
            return [$k->tingkat . $k->nama_kelas => 'Kelas ' . $k->tingkat . $k->nama_kelas];
        })->toArray();

        // Return JSON API response instead of Blade view
        return response()->json(compact('guru', 'stats', 'userGuru', 'availableUsers', 'masterMapel', 'masterKelas'));
    }

    // ==================== STORE ====================

    public function store(Request $request)
    {
        $validated = $this->validateGuru($request);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_guru', 'public');
        }

        $guru = Guru::create($validated);

        // 1. Jabatan & Kepegawaian
        $guru->jabatans()->create([
            'jabatan' => $request->jabatan,
            'status_kepegawaian' => $request->status_kepegawaian,
            'golongan' => $request->golongan,
            'sk_nomor' => $request->sk_pengangkatan,
            'sk_tanggal' => $request->tanggal_sk,
            'tmt_jabatan' => $request->tmt_jabatan ?? $request->tanggal_sk ?? $request->tanggal_bergabung,
            'tanggal_selesai' => $request->tanggal_selesai,
            'is_current' => true,
        ]);

        // 2. Rekening & Payroll
        $guru->rekening()->create([
            'nama_bank' => $request->nama_bank,
            'no_rekening' => $request->no_rekening,
            'atas_nama' => $request->atas_nama ?? $guru->nama,
            'npwp' => $request->npwp,
            'cabang' => $request->cabang,              // ← tambah
            'gaji_pokok' => (float) filter_var($request->gaji_pokok ?? 0, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'tunjangan_fungsional' => (float) filter_var($request->tunjangan_fungsional ?? 0, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION), // ← tambah
        ]);

        // 3. Keluarga
        $guru->keluarga()->create([
            'status_perkawinan' => $request->status_perkawinan,
            'nama_pasangan' => $request->nama_pasangan,
            'pekerjaan_pasangan' => $request->pekerjaan_pasangan,
            'jumlah_anak' => (int) ($request->jumlah_anak ?? 0),
        ]);

        // 4. Pendidikan (S1 & S2)
        if ($request->pendidikan) {
            $guru->pendidikans()->updateOrCreate(
                ['jenjang' => $request->pendidikan],
                [
                    'nama_sekolah' => $request->kampus,
                    'jurusan' => $request->jurusan,
                    'tahun_lulus' => $request->tahun_lulus ?? date('Y'),
                    'no_ijazah' => $request->no_ijazah,  // ← tambah
                ]
            );
        }
        // if ($request->pendidikan_s2) {
        //     $guru->pendidikans()->create([
        //         'jenjang' => $request->pendidikan_s2,
        //         'nama_sekolah' => $request->kampus_s2,
        //         'jurusan' => $request->jurusan_s2,
        //         'tahun_lulus' => $request->tahun_lulus_s2 ?? date('Y'),
        //     ]);
        // }

        // 5. Sertifikasi (Initial)
        if ($request->no_sertifikasi) {
            $guru->sertifikasis()->create([
                'no_sertifikat' => $request->no_sertifikasi,
                'tahun_sertifikasi' => $request->tahun_sertifikasi,
                'bidang_studi' => $request->bidang_sertifikasi,
                'jenis_sertifikasi' => 'Sertifikasi Pendidik',
                'nrg' => $request->nrg,              // ← tambah
                'tanggal_terbit' => $request->tanggal_terbit_sertifikasi, // ← tambah
                'expired_at' => $request->expired_sertifikasi,        // ← tambah
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Data guru berhasil ditambahkan!', 'data' => $guru], 201);
    }

    // ==================== UPDATE ====================

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        $validated = $this->validateGuru($request, $id);

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto_guru', 'public');
        }

        if (isset($validated['no_kk'])) {
            $validated['no_kk'] = substr(preg_replace('/\D/', '', $validated['no_kk']), 0, 20);
        }
        if (isset($validated['nik'])) {
            $validated['nik'] = substr(preg_replace('/\D/', '', $validated['nik']), 0, 20);
        }

        $guru->update($validated);

        // 1. Jabatan Sync
        $current = $guru->currentJabatan;
        if (!$current || $current->jabatan !== $request->jabatan || $current->golongan !== $request->golongan || $current->status_kepegawaian !== $request->status_kepegawaian) {
            if ($current)
                $current->update(['is_current' => false]);
            $guru->jabatans()->create([
                'jabatan' => $request->jabatan,
                'status_kepegawaian' => $request->status_kepegawaian,
                'golongan' => $request->golongan,
                'sk_nomor' => $request->sk_pengangkatan,
                'sk_tanggal' => $request->tanggal_sk,
                'tmt_jabatan' => $request->tmt_jabatan ?? $request->tanggal_sk ?? $request->tanggal_bergabung,
                'tanggal_selesai' => $request->tanggal_selesai,
                'is_current' => true,
            ]);
        } else {
            $current->update([
                'sk_nomor' => $request->sk_pengangkatan,
                'sk_tanggal' => $request->tanggal_sk,
                'tmt_jabatan' => $request->tmt_jabatan ?? $request->tanggal_sk ?? $request->tanggal_bergabung,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);
        }

        // 2. Rekening Update
        $guru->rekening()->updateOrCreate([], [
            'nama_bank' => $request->nama_bank,
            'no_rekening' => $request->no_rekening,
            'npwp' => $request->npwp,
            'cabang' => $request->cabang,              // ← tambah
            'atas_nama' => $request->atas_nama ?? $guru->nama,
            'gaji_pokok' => (float) filter_var($request->gaji_pokok ?? 0, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'tunjangan_fungsional' => (float) filter_var($request->tunjangan_fungsional ?? 0, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
        ]);

        // 3. Keluarga Update
        $guru->keluarga()->updateOrCreate([], [
            'status_perkawinan' => $request->status_perkawinan,
            'nama_pasangan' => $request->nama_pasangan,
            'pekerjaan_pasangan' => $request->pekerjaan_pasangan,
            'jumlah_anak' => (int) ($request->jumlah_anak ?? 0),
        ]);

        // 4. Pendidikan Update (Sync S1/S2)

        // BENAR — pakai nilai jenjang dari request:
        if ($request->pendidikan) {
            $guru
                ->pendidikans()
                ->where('jenjang', $request->pendidikan)  // match nilai asli seperti 'S1 - Sarjana'
                ->updateOrCreate(
                    ['jenjang' => $request->pendidikan],
                    [
                        'nama_sekolah' => $request->kampus,
                        'jurusan' => $request->jurusan,
                        'tahun_lulus' => $request->tahun_lulus ?? date('Y'),
                        'no_ijazah' => $request->no_ijazah,
                    ]
                );
        }
        if ($request->pendidikan_s2) {
            $guru
                ->pendidikans()
                ->updateOrCreate(
                    ['jenjang' => $request->pendidikan_s2],
                    [
                        'nama_sekolah' => $request->kampus_s2,
                        'jurusan' => $request->jurusan_s2,
                        'tahun_lulus' => $request->tahun_lulus_s2 ?? date('Y'),
                    ]
                );
        }

        // 5. Sertifikasi Update
        if ($request->no_sertifikasi) {
            $guru->sertifikasis()->updateOrCreate(['jenis_sertifikasi' => 'Sertifikasi Pendidik'], [
                'no_sertifikat' => $request->no_sertifikasi,
                'tahun_sertifikasi' => $request->tahun_sertifikasi,
                'bidang_studi' => $request->bidang_sertifikasi,
                'nrg' => $request->nrg,              // ← tambah
                'tanggal_terbit' => $request->tanggal_terbit_sertifikasi, // ← tambah
                'expired_at' => $request->expired_sertifikasi,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Data guru berhasil diperbarui!']);
    }

    // ==================== DESTROY ====================

    // Update destroy() — hapus kode Storage::delete yang lama:
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete(); // soft delete, foto TIDAK dihapus

        return response()->json([
            'success' => true,
            'message' => 'Data guru berhasil dihapus. Dapat dipulihkan dari Recycle Bin.'
        ]);
    }

    // Tambah method baru:
    public function restore($id)
    {
        $guru = Guru::withTrashed()->findOrFail($id);
        $guru->restore(); // cascade restore via boot()

        return response()->json([
            'success' => true,
            'message' => "Data guru {$guru->nama} berhasil dipulihkan."
        ]);
    }

    public function forceDelete($id)
    {
        $guru = Guru::withTrashed()->findOrFail($id);
        $nama = $guru->nama;
        $guru->forceDelete(); // cascade force delete via boot()

        return response()->json([
            'success' => true,
            'message' => "Data guru {$nama} dihapus permanen."
        ]);
    }

    // Tambah method trash() untuk menampilkan data terhapus:
    public function trash(Request $request)
    {
        $guru = Guru::onlyTrashed()
            ->with([
                'currentJabatan' => function ($q) {
                    $q->withTrashed();
                }
            ])
            ->latest('deleted_at')
            ->paginate(10);

        // Selalu return JSON — modal yang handle tampilannya
        return response()->json([
            'data' => $guru->map(fn($g) => [
                'id' => $g->id,
                'nama' => $g->nama,
                'foto' => $g->foto,
                'nuptk' => $g->nuptk,
                'jabatan' => $g->currentJabatan?->jabatan ?? 'Guru',
                'status_kepegawaian' => $g->currentJabatan?->status_kepegawaian ?? '-',
                'deleted_at' => $g->deleted_at->format('d M Y, H:i'),
            ]),
            'total' => $guru->total(),
            'current_page' => $guru->currentPage(),
            'last_page' => $guru->lastPage(),
        ]);
    }

    // ==================== ASSIGN USER ====================

    public function assignUser(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
        ]);

        $guru = Guru::findOrFail($id);

        // Jika user_id null, berarti unassign
        if (!$request->user_id) {
            $guru->update(['user_id' => null]);
            return response()->json(['success' => true, 'message' => 'Akun user berhasil dilepas dari guru.']);
        }

        // Cek apakah user sudah di-assign ke guru lain
        $existingGuru = Guru::where('user_id', $request->user_id)
            ->where('id', '!=', $id)
            ->first();

        if ($existingGuru) {
            return response()->json(['success' => false, 'message' => 'User ini sudah di-assign ke guru: ' . $existingGuru->nama], 422);
        }

        $guru->update(['user_id' => $request->user_id]);

        return response()->json(['success' => true, 'message' => 'Akun user berhasil di-assign ke guru.']);
    }

    // ==================== EXPORT LAPORAN REKAP ====================

    public function exportLaporan(Request $request)
    {
        $type = $request->get('type', 'kepegawaian');  // kepegawaian, pendidikan, sertifikasi

        $gurus = Guru::with(['kelasWali', 'currentJabatan', 'pendidikans', 'sertifikasis'])->get();

        $pdf = Pdf::loadView('operator.pdf.laporan-guru', compact('gurus', 'type'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont' => 'DejaVu Sans',
                'isRemoteEnabled' => false,
                'isPhpEnabled' => false,
                'dpi' => 150,
            ]);

        $tanggal = now()->format('Ymd-His');
        $filename = "laporan-guru-{$type}-{$tanggal}.pdf";

        return $pdf->download($filename);
    }

    // ==================== EXPORT GABUNGAN (ZIP / PDF) ====================

    public function exportData(Request $request)
    {
        $mode = $request->get('mode', 'zip');
        $filters = $this->filtersFromRequest($request);

        return match ($mode) {
            'pdf' => $this->exportPdfCards($filters),
            default => $this->exportZip($filters),
        };
    }

    private function exportPdfCards(array $filters)
    {
        $gurus = $this
            ->applyFilters(Guru::with(['kelasWali', 'currentJabatan']), $filters)
            ->latest()
            ->get();

        if ($gurus->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Tidak ada data guru untuk di-export.'], 404);
        }

        $pdf = Pdf::loadView('operator.pdf.kartu-guru', compact('gurus'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'defaultFont'     => 'DejaVu Sans',
                'isRemoteEnabled' => false, // FIX BUG-03: Dinonaktifkan untuk mencegah SSRF
                'isPhpEnabled'    => false,
                'chroot'          => storage_path('app/public'),
                'dpi'             => 150,
            ]);

        $tanggal = now()->format('Ymd-His');

        return $pdf->download("kartu-identitas-guru-{$tanggal}.pdf");
    }

    private function exportZip(array $filters)
    {
        $excelTmp = tempnam(sys_get_temp_dir(), 'siakad_excel_') . '.xlsx';
        $excelContent = Excel::raw(
            new GuruExport(
                $filters['search'],
                $filters['jabatan'],
                $filters['status'],
                $filters['status_kepegawaian'],
                $filters['sertifikasi']
            ),
            \Maatwebsite\Excel\Excel::XLSX
        );
        file_put_contents($excelTmp, $excelContent);

        $gurus = $this
            ->applyFilters(Guru::with(['kelasWali', 'currentJabatan']), $filters)
            ->latest()
            ->get();

        $zipTmp = tempnam(sys_get_temp_dir(), 'siakad_zip_') . '.zip';
        $tanggal = now()->format('Ymd-His');
        $namaZip = "export-guru-{$tanggal}.zip";

        $zip = new ZipArchive();
        if ($zip->open($zipTmp, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Gagal membuat file ZIP.');
        }

        $zip->addFile($excelTmp, 'data_guru.xlsx');

        $fotoCount = 0;
        foreach ($gurus as $g) {
            if (!$g->foto) {
                continue;
            }

            $storagePath = storage_path('app/public/' . $g->foto);
            if (!file_exists($storagePath)) {
                continue;
            }

            $ext = pathinfo($g->foto, PATHINFO_EXTENSION);

            // Use NUPTK, fallback to NIP, fallback to slugified name to avoid blank filenames
            $stem = $g->nuptk ?: $g->nip ?: \Illuminate\Support\Str::slug($g->nama) . '-' . $g->id;
            $namaFile = $stem . '.' . $ext;

            $zip->addFile($storagePath, 'foto/' . $namaFile);
            $fotoCount++;
        }

        $zip->addFromString('README.txt', $this->buildReadme($gurus->count(), $fotoCount, $tanggal));

        $zip->close();
        @unlink($excelTmp);

        return response()->download($zipTmp, $namaZip, [
            'Content-Type' => 'application/zip',
        ])->deleteFileAfterSend(true);
    }

    public function exportExcel(Request $request)
    {
        return $this->exportZip($this->filtersFromRequest($request));
    }

    public function exportPdfRekap(Request $request)
    {
        return $this->exportPdfCards($this->filtersFromRequest($request));
    }

    // ==================== EXPORT TEMPLATE ====================

    public function exportTemplate()
    {
        return Excel::download(new GuruTemplateExport(), 'template-import-guru.xlsx');
    }

    // ==================== IMPORT EXCEL / ZIP ====================

    public function import(Request $request)
    {
        $request->validate([
            'file_import' => 'required|file|mimes:zip,xlsx,xls,csv|max:20480',
        ]);

        $file = $request->file('file_import');
        $ext = strtolower($file->getClientOriginalExtension());
        $fotoDir = null;
        $tmpDir = null;

        if ($ext === 'zip') {
            [$excelPath, $fotoMap, $tmpDir] = $this->extractZip($file);

            if (!$excelPath) {
                return redirect()
                    ->back()
                    ->with('error', 'File ZIP tidak valid: tidak ditemukan file Excel (.xlsx/.xls/.csv) di dalamnya. Pastikan struktur ZIP sudah benar.');
            }

            $import = new GuruImport($fotoMap);
            Excel::import($import, $excelPath);
        } else {
            $import = new GuruImport([]);
            Excel::import($import, $file);
        }

        if ($tmpDir && is_dir($tmpDir)) {
            File::deleteDirectory($tmpDir);
        }

        $stats = $import->getStats();

        $msg = "Import selesai: {$stats['inserted']} guru berhasil ditambahkan";
        if ($stats['updated'] > 0)
            $msg .= ", {$stats['updated']} guru diperbarui";
        if ($stats['skipped'] > 0)
            $msg .= ", {$stats['skipped']} baris dilewati";
        if ($stats['foto_matched'] > 0)
            $msg .= ", {$stats['foto_matched']} foto berhasil dipasang";
        if ($stats['foto_avatar'] > 0)
            $msg .= ", {$stats['foto_avatar']} tanpa foto";
        $msg .= '.';

        $sessionKey = ($stats['inserted'] > 0 || $stats['updated'] > 0) ? 'success' : 'warning';
        return redirect()
            ->back()
            ->with($sessionKey, $msg)
            ->with('import_skipped', $import->skippedRows);
    }

    private function extractZip($file): array
    {
        $zip = new ZipArchive();
        $tmpDir = sys_get_temp_dir() . '/siakad_' . uniqid();
        mkdir($tmpDir, 0755, true);

        if ($zip->open($file->getRealPath()) !== true) {
            return [null, [], $tmpDir];
        }
        $zip->extractTo($tmpDir);
        $zip->close();

        $excelPath = null;
        $fotoMap = [];

        $it = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($tmpDir, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($it as $info) {
            if ($info->isFile()) {
                $ext = strtolower($info->getExtension());
                $path = $info->getRealPath();

                if (strpos($path, '__MACOSX') !== false) {
                    continue;
                }

                if (!$excelPath && in_array($ext, ['xlsx', 'xls', 'csv'])) {
                    if (strpos($info->getFilename(), '.~') === false && strpos($info->getFilename(), '._') === false) {
                        $excelPath = $path;
                    }
                } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $filename = pathinfo($info->getFilename(), PATHINFO_FILENAME);
                    $fotoMap[strtolower(trim($filename))] = $path;
                }
            }
        }

        return [$excelPath, $fotoMap, $tmpDir];
    }

    // ==================== EXPORT PDF (KARTU IDENTITAS) ====================

    public function exportPdf($id)
    {
        $guru = Guru::with(['kelasWali', 'currentJabatan'])->findOrFail($id);
        $gurus = collect([$guru]);

        $pdf = Pdf::loadView('operator.pdf.kartu-guru', compact('gurus'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'defaultFont'     => 'DejaVu Sans',
                'isRemoteEnabled' => false, // FIX BUG-03: Dinonaktifkan untuk mencegah SSRF
                'isPhpEnabled'    => false,
                'chroot'          => storage_path('app/public'),
                'dpi'             => 150,
            ]);

        $namaFile = \Illuminate\Support\Str::slug($guru->nama) . '-' . ($guru->nuptk ?? $guru->nip) . '.pdf';

        return $pdf->stream($namaFile);
    }

    // ==================== PRIVATE HELPERS ====================

    private function filtersFromRequest(Request $request): array
    {
        return [
            'search' => (string) $request->get('search', ''),
            'jabatan' => (string) $request->get('jabatan', 'semua'),
            'status' => (string) $request->get('status', 'semua'),
            'status_kepegawaian' => (string) $request->get('status_kepegawaian', 'semua'),
            'sertifikasi' => (string) $request->get('sertifikasi', ''),
        ];
    }

    private function applyFilters(Builder $query, array $filters): Builder
    {
        if ($filters['search'] !== '') {
            $query->search($filters['search']);
        }

        if ($filters['jabatan'] !== 'semua') {
            $jabatanMap = [
                'guru' => 'Guru Kelas',
                'wali' => 'Wali Kelas',
                'kepala' => 'Kepala Sekolah',
                'staf' => 'Staf TU',
            ];
            $jabatanValue = $jabatanMap[$filters['jabatan']] ?? $filters['jabatan'];
            $query->whereHas('jabatans', function ($q) use ($jabatanValue) {
                $q->where('jabatan', $jabatanValue)->where('is_current', true);
            });
        }

        if ($filters['status_kepegawaian'] !== 'semua') {
            $query->whereHas('jabatans', function ($q) use ($filters) {
                $q
                    ->where('status_kepegawaian', $filters['status_kepegawaian'])
                    ->where('is_current', true);
            });
        }

        if ($filters['status'] !== 'semua') {
            $query->where('status_aktif', $filters['status'] === 'tetap' ? 1 : 0);
        }

        if ($filters['sertifikasi'] === 'sudah') {
            $query->whereHas('sertifikasis');
        } elseif ($filters['sertifikasi'] === 'belum') {
            $query->whereDoesntHave('sertifikasis');
        }

        return $query;
    }

    private function buildReadme(int $jumlahGuru, int $jumlahFoto, string $tanggal): string
    {
        return <<<TXT
            EXPORT DATA GURU — MI NURUL HUDA 3
            ======================================
            Tanggal export : {$tanggal}
            Jumlah guru    : {$jumlahGuru}
            Jumlah foto    : {$jumlahFoto}

            STRUKTUR FILE:
              data_guru.xlsx      → Data lengkap semua guru
              foto/
                1234567890123456.jpg   → Foto guru (nama file = NUPTK)
                198001012005011001.jpg → Alternatif nama file = NIP
                ...

            CARA RE-IMPORT:
              ZIP ini dapat langsung di-import kembali via fitur
              "Import ZIP + Foto" di halaman Data Guru.
              Sistem akan otomatis mencocokkan foto berdasarkan
              NUPTK, NIP, atau nama file yang sesuai.

            KOLOM EXCEL:
              Kolom terakhir "Nama File Foto" berisi nama file foto
              yang tersimpan di folder foto/ dalam ZIP ini.
            ======================================
            TXT;
    }

    private function validateGuru(Request $request, ?int $id = null): array
    {
        $uniqueNuptk = 'required|string|max:50|unique:gurus,nuptk' . ($id ? ",{$id}" : '');
        $uniqueEmail = 'required|email|max:100|unique:gurus,email' . ($id ? ",{$id}" : '');
        // NIK: nullable, tapi jika diisi harus 16 digit dan unique
        $nikRule = 'nullable|digits:16|unique:gurus,nik' . ($id ? ",{$id}" : '');

        return $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'user_id' => 'nullable|exists:users,id',
            // Identitas
            'nip' => 'nullable|string|max:30',
            'nik' => $nikRule,
            'no_kk' => 'nullable|digits:16',
            'no_karpeg' => 'nullable|string|max:30',
            'no_karis_karsu' => 'nullable|string|max:30',
            'nuptk' => $uniqueNuptk,
            'no_sertifikasi' => 'nullable|string|max:50',
            'tahun_sertifikasi' => 'nullable|integer|min:1990|max:' . date('Y'),
            'bidang_sertifikasi' => 'nullable|string|max:150',
            'nama' => 'required|string|max:150',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'golongan_darah' => 'nullable|in:A,B,AB,O,-',
            'agama' => 'required|string|max:50',
            'nama_ibu_kandung' => 'nullable|string|max:150',
            // Data Keluarga
            'status_perkawinan' => 'nullable|in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati',
            'nama_pasangan' => 'nullable|string|max:150',
            'pekerjaan_pasangan' => 'nullable|string|max:100',
            'jumlah_anak' => 'nullable|integer|min:0|max:20',
            // Kontak
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => $uniqueEmail,
            // Pendidikan
            'pendidikan' => 'nullable|string|max:100',
            'jurusan' => 'nullable|string|max:100',
            'kampus' => 'nullable|string|max:150',
            // Mengajar
            'mapel' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:50',
            'tahun_mengajar' => 'nullable|integer',
            // Kepegawaian
            'status_kepegawaian' => 'required|string|max:50',
            'jabatan' => 'required|string|max:100',
            'status_aktif' => 'required|in:0,1',
            'golongan' => $request->status_kepegawaian === 'PNS'
                ? 'required|string|max:20'
                : 'nullable|string|max:20',
            'sk_pengangkatan' => 'nullable|string|max:100',
            'tanggal_sk' => 'nullable|date',
            'tanggal_bergabung' => 'required|date',
            'tmt_pns' => 'nullable|date',
            'tmt_gty' => 'nullable|date',
            'tmt_jabatan' => 'exclude|nullable|date',
            'gaji_pokok' => 'nullable|string|max:30',
            'npwp' => 'nullable|string|max:30',
            'no_rekening' => 'nullable|string|max:30',
            'nama_bank' => 'nullable|string|max:50',
            'atas_nama' => 'exclude|nullable|string|max:150',
            'tanggal_selesai' => 'exclude|nullable|date',
            // Tambahkan di dalam array validate():
            'nrg' => 'nullable|string|max:50',
            'tanggal_terbit_sertifikasi' => 'exclude|nullable|date',
            'expired_sertifikasi' => 'exclude|nullable|date',
            'no_ijazah' => 'nullable|string|max:50',
            'tunjangan_fungsional' => 'nullable|string|max:30',
            'cabang' => 'nullable|string|max:100',
        ]);
    }

    private function getStats(): array
    {
        return [
            'total' => Guru::count(),
            'aktif' => Guru::where('status_aktif', true)->count(),
            'pns' => Guru::whereHas('jabatans', fn($q) => $q->where('status_kepegawaian', 'PNS')->where('is_current', true))->count(),
            'honorer' => Guru::whereHas('jabatans', fn($q) => $q->where('status_kepegawaian', 'Honorer')->where('is_current', true))->count(),
            'pppk' => Guru::whereHas('jabatans', fn($q) => $q->where('status_kepegawaian', 'PPPK')->where('is_current', true))->count(),
            'sertifikasi' => Guru::whereHas('sertifikasis')->count(),
            'wali_kelas' => Guru::has('kelasWali')->count(),
        ];
    }

    public function show($id)
    {
        // Ganti bagian with() — tambah load relasi nested:
        $guru = Guru::with([
            'currentJabatan',
            'jabatans',
            'rekening',
            'keluarga',
            'pendidikans',
            'sertifikasis',
            'kelasWali',
            'user',
            'guruMapels.mapel',   // ← eager load relasi mapel
            'guruMapels.kelas',   // ← eager load relasi kelas
            'absensiGuru',
        ])->findOrFail($id);

        $data = $guru->toArray();

        // ── Pendidikan Terakhir (untuk field grid utama)
        $pendTerakhir = $guru->pendidikanTerakhir();
        $data['pendidikan'] = $pendTerakhir?->jenjang;
        $data['jurusan'] = $pendTerakhir?->jurusan;
        $data['kampus'] = $pendTerakhir?->nama_sekolah;
        $data['tahun_lulus'] = $pendTerakhir?->tahun_lulus;
        $data['no_ijazah'] = $pendTerakhir?->no_ijazah;

        // ── PERBAIKAN 5: Semua riwayat pendidikan (urut tertinggi)
        $order = ['S3 - Doktor' => 5, 'S2 - Magister' => 4, 'S1 - Sarjana' => 3, 'D3 - Diploma' => 2, 'SMA / MA' => 1];
        $data['semua_pendidikan'] = $guru->pendidikans
            ->sortByDesc(fn($p) => $order[$p->jenjang] ?? 0)
            ->values()
            ->map(fn($p) => [
                'jenjang' => $p->jenjang,
                'jurusan' => $p->jurusan,
                'nama_sekolah' => $p->nama_sekolah,
                'tahun_lulus' => $p->tahun_lulus,
                'no_ijazah' => $p->no_ijazah,
            ])->toArray();

        // ── Sertifikasi
        $sertFirst = $guru->sertifikasis->first();
        $data['nrg'] = $sertFirst?->nrg;
        $data['tanggal_terbit_sertifikasi'] = $sertFirst?->tanggal_terbit?->format('Y-m-d');
        $data['expired_sertifikasi'] = $sertFirst?->expired_at?->format('Y-m-d');
        $data['tahun_sertifikasi'] = $sertFirst?->tahun_sertifikasi;
        $data['jenis_sertifikasi'] = $sertFirst?->jenis_sertifikasi;

        // ── Berkas digital
        $data['has_file_ijazah'] = !empty($pendTerakhir?->file_ijazah);
        $data['has_file_sertifikat'] = !empty($sertFirst?->file_sertifikat);
        $data['file_ijazah_url'] = $pendTerakhir?->file_ijazah
            ? asset('storage/' . $pendTerakhir->file_ijazah) : null;
        $data['file_sertifikat_url'] = $sertFirst?->file_sertifikat
            ? asset('storage/' . $sertFirst->file_sertifikat) : null;

        // ── Rekening
        $data['tunjangan_fungsional'] = $guru->rekening?->tunjangan_fungsional;
        $data['cabang'] = $guru->rekening?->cabang;
        $data['atas_nama'] = $guru->rekening?->atas_nama;
        $data['nama_bank'] = $guru->rekening?->nama_bank;

        // ── Jabatan saat ini
        $jabatan = $guru->currentJabatan;
        $data['tanggal_selesai'] = $jabatan?->tanggal_selesai instanceof \Carbon\Carbon
            ? $jabatan->tanggal_selesai->format('Y-m-d')
            : $jabatan?->tanggal_selesai;
        $data['tmt_jabatan'] = $jabatan?->tmt_jabatan instanceof \Carbon\Carbon
            ? $jabatan->tmt_jabatan->format('Y-m-d')
            : $jabatan?->tmt_jabatan;
        $data['sk_pengangkatan'] = $jabatan?->sk_nomor;
        $data['tanggal_sk'] = $jabatan?->sk_tanggal instanceof \Carbon\Carbon
            ? $jabatan->sk_tanggal->format('Y-m-d')
            : $jabatan?->sk_tanggal;

        // ── PERBAIKAN 4: Riwayat semua jabatan
        $data['riwayat_jabatan'] = $guru->jabatans
            ->sortByDesc('tmt_jabatan')
            ->values()
            ->map(fn($j) => [
                'jabatan' => $j->jabatan,
                'status_kepegawaian' => $j->status_kepegawaian,
                'golongan' => $j->golongan,
                'sk_nomor' => $j->sk_nomor,
                'sk_tanggal' => $j->sk_tanggal instanceof \Carbon\Carbon
                    ? $j->sk_tanggal->format('Y-m-d') : $j->sk_tanggal,
                'tmt_jabatan' => $j->tmt_jabatan instanceof \Carbon\Carbon
                    ? $j->tmt_jabatan->format('Y-m-d') : $j->tmt_jabatan,
                'tanggal_selesai' => $j->tanggal_selesai instanceof \Carbon\Carbon
                    ? $j->tanggal_selesai->format('Y-m-d') : $j->tanggal_selesai,
                'is_current' => (bool) $j->is_current,
            ])->toArray();

        // ── PERBAIKAN 1: Kehadiran nyata dari GuruAbsensi
        $totalAbsensi = $guru->absensiGuru()->count();
        $hadirAbsensi = $guru->absensiGuru()->where('status', 'hadir')->count();
        $data['persen_kehadiran'] = $totalAbsensi > 0
            ? round($hadirAbsensi / $totalAbsensi * 100)
            : null;
        $data['total_absensi'] = $totalAbsensi;
        $data['total_hadir'] = $hadirAbsensi;

        // ── PERBAIKAN 1: Beban JP dari guruMapels
        $totalJP = $guru->guruMapels()->sum('beban_jam'); // ← ganti jam_pelajaran → beban_jam
        $data['total_jp'] = $totalJP > 0 ? $totalJP : null;

        // ── PERBAIKAN 2 & 6: Status verifikasi + audit trail
        $data['is_verified'] = (bool) $guru->is_verified;
        $data['verified_at'] = $guru->verified_at?->format('Y-m-d H:i');
        $data['verified_by_name'] = $guru->verified_by
            ? \App\Models\User::find($guru->verified_by)?->name
            : null;

        // ── PERBAIKAN 3: Mapel dari tabel normalisasi (fallback ke kolom manual)
        // Ganti bagian mapel & kelas:
        if ($guru->guruMapels->isNotEmpty()) {
            $data['mapel'] = $guru->guruMapels
                ->map(fn($gm) => $gm->mapel?->nama)   // ← dari relasi, bukan kolom langsung
                ->filter()
                ->unique()
                ->implode(', ');
            $data['kelas'] = $guru->guruMapels
                ->map(fn($gm) => $gm->kelas?->nama)   // ← dari relasi
                ->filter()
                ->unique()
                ->implode(', ');
        }
        // jika guruMapels kosong, $data['mapel'] dan $data['kelas']
        // sudah terisi dari $guru->toArray() (kolom manual di tabel gurus)

        // ── PERBAIKAN 7: Tahun mengajar — kirim keduanya
        $data['tahun_mengajar_manual'] = $guru->tahun_mengajar; // angka tahun input manual
        // masa_bakti sudah ada via $appends, dibiarkan

        unset($data['pendidikan_s2'], $data['jurusan_s2'], $data['kampus_s2']);
        // Tambahkan di show() sebelum return response()->json($data):
        $data['tanggal_bergabung'] = $guru->tanggal_bergabung?->format('Y-m-d');
        return response()->json($data);
    }
}