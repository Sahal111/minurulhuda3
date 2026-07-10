<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Operator\SiswaController;
use App\Http\Controllers\Operator\GuruController;
use App\Http\Controllers\Operator\KelasController;
use App\Http\Controllers\Operator\SemesterController;
use App\Http\Controllers\Operator\TahunAjaranController;
use App\Http\Controllers\Operator\UserManagementController;
use App\Http\Controllers\Operator\GuruDiklatController;
use App\Http\Controllers\Operator\GuruInpassingController;
use App\Http\Controllers\Operator\GuruDokumenController;

Route::post('/auth/login', [AuthController::class, 'prosesLogin']);
Route::post('/auth/register', [AuthController::class, 'prosesRegister']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);
    
    // ===================== OPERATOR =====================
    Route::middleware(['role:operator'])->prefix('operator')->name('api.operator.')->group(function () {
        
        // ── Dashboard Stats (to be implemented in controller if needed)
        // Route::get('/dashboard', [DashboardController::class, 'index']);

        // ── Data Siswa ─────────────────────────────────────────────
        Route::get('/data-siswa', [SiswaController::class, 'index'])->name('dataSiswa.index');
        Route::get('/data-siswa/{id}/show', [SiswaController::class, 'show'])->name('dataSiswa.show');
        Route::get('/data-siswa/trash', [SiswaController::class, 'trash'])->name('dataSiswa.trash');
        Route::post('/data-siswa/{id}/restore', [SiswaController::class, 'restore'])->name('dataSiswa.restore');
        Route::delete('/data-siswa/{id}/force', [SiswaController::class, 'forceDelete'])->name('dataSiswa.forceDelete');
        Route::post('/data-siswa', [SiswaController::class, 'store'])->name('dataSiswa.store');
        Route::put('/data-siswa/{id}', [SiswaController::class, 'update'])->name('dataSiswa.update');
        Route::delete('/data-siswa/{id}', [SiswaController::class, 'destroy'])->name('dataSiswa.destroy');
        Route::get('/data-siswa/template', [SiswaController::class, 'exportTemplate'])->name('dataSiswa.template');
        Route::get('/data-siswa/export', [SiswaController::class, 'exportData'])->name('dataSiswa.export');
        Route::get('/data-siswa/{id}/pdf', [SiswaController::class, 'exportPdfSatu'])->name('dataSiswa.pdf');
        Route::get('/data-siswa/{id}/riwayat-kelas', [SiswaController::class, 'riwayatKelas'])->name('dataSiswa.riwayat');
        Route::post('/data-siswa/import', [SiswaController::class, 'import'])->name('dataSiswa.import');
        Route::put('/data-siswa/{id}/mutasi', [SiswaController::class, 'mutasiLulus'])->name('dataSiswa.mutasi');
        Route::put('/data-siswa/{id}/reactivate', [SiswaController::class, 'reactivate'])->name('dataSiswa.reactivate');

        // Berkas Digital Siswa
        Route::get('/data-siswa/{siswaId}/berkas', [SiswaController::class, 'berkasIndex'])->name('dataSiswa.berkas.index');
        Route::post('/data-siswa/{siswaId}/berkas', [SiswaController::class, 'berkasStore'])->name('dataSiswa.berkas.store');
        Route::get('/data-siswa/{siswaId}/berkas/{berkasId}/view', [SiswaController::class, 'berkasView'])->name('dataSiswa.berkas.view');
        Route::get('/data-siswa/{siswaId}/berkas/{berkasId}/download', [SiswaController::class, 'berkasDownload'])->name('dataSiswa.berkas.download');
        Route::delete('/data-siswa/{siswaId}/berkas/{berkasId}', [SiswaController::class, 'berkasDestroy'])->name('dataSiswa.berkas.destroy');

        // Prestasi Siswa
        Route::get('/data-siswa/{siswaId}/prestasi', [SiswaController::class, 'prestasiIndex'])->name('dataSiswa.prestasi.index');
        Route::post('/data-siswa/{siswaId}/prestasi', [SiswaController::class, 'prestasiStore'])->name('dataSiswa.prestasi.store');
        Route::post('/data-siswa/{siswaId}/prestasi/{prestasiId}', [SiswaController::class, 'prestasiUpdate'])->name('dataSiswa.prestasi.update');
        Route::delete('/data-siswa/{siswaId}/prestasi/{prestasiId}', [SiswaController::class, 'prestasiDestroy'])->name('dataSiswa.prestasi.destroy');
        Route::get('/data-siswa/{siswaId}/prestasi/{prestasiId}/view', [SiswaController::class, 'prestasiViewBukti'])->name('dataSiswa.prestasi.view');
        Route::get('/data-siswa/{siswaId}/prestasi/{prestasiId}/download', [SiswaController::class, 'prestasiDownloadBukti'])->name('dataSiswa.prestasi.download');

        // Beasiswa Siswa
        Route::get('/data-siswa/{siswaId}/beasiswa', [SiswaController::class, 'beasiswaIndex'])->name('dataSiswa.beasiswa.index');
        Route::post('/data-siswa/{siswaId}/beasiswa', [SiswaController::class, 'beasiswaStore'])->name('dataSiswa.beasiswa.store');
        Route::delete('/data-siswa/{siswaId}/beasiswa/{beasiswaId}', [SiswaController::class, 'beasiswaDestroy'])->name('dataSiswa.beasiswa.destroy');

        // ── Data Guru ─────────────────────────────────────────────
        Route::get('/data-guru', [GuruController::class, 'index'])->name('dataGuru.index');
        Route::post('/data-guru', [GuruController::class, 'store'])->name('dataGuru.store');
        Route::post('/data-guru/import', [GuruController::class, 'import'])->name('dataGuru.import');
        Route::get('/data-guru/export', [GuruController::class, 'exportData'])->name('dataGuru.export');
        Route::get('/data-guru/export-excel', [GuruController::class, 'exportExcel'])->name('dataGuru.exportExcel');
        Route::get('/data-guru/export-pdf-rekap', [GuruController::class, 'exportPdfRekap'])->name('dataGuru.exportPdfRekap');
        Route::get('/data-guru/export-template', [GuruController::class, 'exportTemplate'])->name('dataGuru.exportTemplate');
        Route::get('/data-guru/trash', [GuruController::class, 'trash'])->name('dataGuru.trash');
        Route::patch('/data-guru/{id}/restore', [GuruController::class, 'restore'])->name('dataGuru.restore');
        Route::delete('/data-guru/{id}/force-delete', [GuruController::class, 'forceDelete'])->name('dataGuru.forceDelete');
        Route::get('/data-guru/{id}/show', [GuruController::class, 'show'])->name('dataGuru.show');
        Route::put('/data-guru/{id}', [GuruController::class, 'update'])->name('dataGuru.update');
        Route::delete('/data-guru/{id}', [GuruController::class, 'destroy'])->name('dataGuru.destroy');
        Route::get('/data-guru/{id}/kartu-pdf', [GuruController::class, 'exportPdf'])->name('dataGuru.kartuPdf');
        Route::post('/data-guru/{id}/assign-user', [GuruController::class, 'assignUser'])->name('dataGuru.assignUser');
        Route::get('/data-guru/laporan/export', [GuruController::class, 'exportLaporan'])->name('dataGuru.exportLaporan');

        // Diklat Guru
        Route::prefix('data-guru/{guruId}/diklat')->name('dataGuru.diklat.')->group(function () {
            Route::get('/', [GuruDiklatController::class, 'index'])->name('index');
            Route::post('/', [GuruDiklatController::class, 'store'])->name('store');
            Route::put('/{diklatId}', [GuruDiklatController::class, 'update'])->name('update');
            Route::delete('/{diklatId}', [GuruDiklatController::class, 'destroy'])->name('destroy');
            Route::get('/{diklatId}/sertifikat', [GuruDiklatController::class, 'viewSertifikat'])->name('sertifikat');
        });

        // Inpassing Guru
        Route::prefix('data-guru/{guruId}/inpassing')->name('dataGuru.inpassing.')->group(function () {
            Route::get('/', [GuruInpassingController::class, 'index'])->name('index');
            Route::post('/', [GuruInpassingController::class, 'store'])->name('store');
            Route::patch('/{inpassingId}/aktif', [GuruInpassingController::class, 'setAktif'])->name('aktif');
            Route::delete('/{inpassingId}', [GuruInpassingController::class, 'destroy'])->name('destroy');
            Route::get('/{inpassingId}/sk', [GuruInpassingController::class, 'viewSK'])->name('sk');
        });

        // Dokumen Guru
        Route::get('/data-guru/{id}/dokumen', [GuruDokumenController::class, 'index'])->name('dataGuru.dokumen.index');
        Route::post('/data-guru/{id}/dokumen', [GuruDokumenController::class, 'store'])->name('dataGuru.dokumen.store');
        Route::post('/data-guru/{id}/dokumen/{dokumenId}', [GuruDokumenController::class, 'update'])->name('dataGuru.dokumen.update');
        Route::delete('/data-guru/{id}/dokumen/{dokumenId}', [GuruDokumenController::class, 'destroy'])->name('dataGuru.dokumen.destroy');
        Route::get('/data-guru/{id}/dokumen/{dokumenId}/view', [GuruDokumenController::class, 'view'])->name('dataGuru.dokumen.view');
        Route::get('/data-guru/{id}/dokumen/{dokumenId}/download', [GuruDokumenController::class, 'download'])->name('dataGuru.dokumen.download');
        Route::patch('/data-guru/{id}/dokumen/{dokumenId}/verify', [GuruDokumenController::class, 'verify'])->name('dataGuru.dokumen.verify');

        // ── Data Kelas ─────────────────────────────────────────────
        Route::get('/data-kelas', [KelasController::class, 'index'])->name('dataKelas.index');
        Route::post('/data-kelas/store', [KelasController::class, 'store'])->name('dataKelas.store');
        Route::put('/data-kelas/{id}', [KelasController::class, 'update'])->name('dataKelas.update');
        Route::delete('/data-kelas/{id}', [KelasController::class, 'destroy'])->name('dataKelas.destroy');
        Route::get('/kelas/{id}/siswa', [KelasController::class, 'getSiswa']);
        Route::get('/penempatan-siswa', [KelasController::class, 'penempatan'])->name('penempatanSiswa');
        Route::post('/penempatan-siswa/update', [KelasController::class, 'updatePenempatan'])->name('penempatanSiswa.update');

        // ── Pengaturan Akademik ─────────────────────────────────────────────
        Route::get('/semester', [SemesterController::class, 'index'])->name('semester.index');
        Route::post('/semester', [SemesterController::class, 'store'])->name('semester.store');
        Route::put('/semester/{id}', [SemesterController::class, 'update'])->name('semester.update');
        Route::delete('/semester/{id}', [SemesterController::class, 'destroy'])->name('semester.destroy');
        Route::patch('/semester/{id}/aktif', [SemesterController::class, 'setActive'])->name('semester.setActive');
        
        Route::get('/tahun-ajaran', [TahunAjaranController::class, 'index'])->name('tahunAjaran.index');
        Route::post('/tahun-ajaran', [TahunAjaranController::class, 'store'])->name('tahunAjaran.store');
        Route::put('/tahun-ajaran/{id}', [TahunAjaranController::class, 'update'])->name('tahunAjaran.update');
        Route::delete('/tahun-ajaran/{id}', [TahunAjaranController::class, 'destroy'])->name('tahunAjaran.destroy');
        Route::patch('/tahun-ajaran/{id}/archive', [TahunAjaranController::class, 'archive'])->name('tahunAjaran.archive');
        Route::get('/kenaikan-kelas', [TahunAjaranController::class, 'kenaikanKelas'])->name('kenaikanKelas');
        Route::post('/tahun-ajaran/promote', [TahunAjaranController::class, 'promoteSiswa'])->name('tahunAjaran.promote');

        // ── Manajemen User ─────────────────────────────────────────────
        Route::get('/manajemen-akun', [UserManagementController::class, 'index'])->name('manajemenAkun.index');
        Route::post('/manajemen-akun/store', [UserManagementController::class, 'store'])->name('manajemenAkun.store');
        Route::patch('/manajemen-akun/{id}/toggle', [UserManagementController::class, 'toggleStatus'])->name('manajemenAkun.toggle');
        Route::put('/manajemen-akun/{id}', [UserManagementController::class, 'update'])->name('manajemenAkun.update');
        Route::patch('/manajemen-akun/{id}/reset-password', [UserManagementController::class, 'resetPassword'])->name('manajemenAkun.resetPassword');
        Route::delete('/manajemen-akun/{id}', [UserManagementController::class, 'destroy'])->name('manajemenAkun.destroy');

    });
});
