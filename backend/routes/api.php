<?php

use App\Http\Controllers\AdminPpdb\DashboardController as AdminPpdbDashboardController;
use App\Http\Controllers\AdminPpdb\PendaftarController as AdminPpdbPendaftarController;
// ── Operator Controllers ──
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Bendahara\DashboardController as BendaraDashboardController;
use App\Http\Controllers\Bendahara\PembayaranController as BendaraPembayaranController;
use App\Http\Controllers\Bendahara\TagihanController as BendaraTagihanController;
use App\Http\Controllers\Guru\AbsensiController as GuruAbsensiController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\JadwalController as GuruJadwalController;
use App\Http\Controllers\Guru\NilaiController as GuruNilaiController;
use App\Http\Controllers\Guru\WaliKelasController;
// ── Guru Controllers ──
use App\Http\Controllers\Kepsek\AkademikController;
use App\Http\Controllers\Kepsek\DashboardController as KepsekDashboardController;
use App\Http\Controllers\Kepsek\SdmController;
use App\Http\Controllers\Operator\GuruController;
use App\Http\Controllers\Operator\GuruDiklatController;
// ── Kepsek Controllers ──
use App\Http\Controllers\Operator\GuruDokumenController;
use App\Http\Controllers\Operator\GuruInpassingController;
use App\Http\Controllers\Operator\KelasController;
// ── Ortu Controllers ──
use App\Http\Controllers\Operator\SemesterController;
// ── Bendahara Controllers ──
use App\Http\Controllers\Operator\SiswaController;
use App\Http\Controllers\Operator\TahunAjaranController;
use App\Http\Controllers\Operator\UserManagementController;
// ── WaliKelas Controllers ──
use App\Http\Controllers\Ortu\DashboardController as OrtuDashboardController;
use App\Http\Controllers\WaliKelas\DashboardController as WaliKelasDashboardController;
// ── AdminPpdb Controllers ──
use App\Http\Controllers\WaliKelas\SiswaController as WaliKelasSiswaController;
use Illuminate\Support\Facades\Route;

// =====================================================================
// AUTH (public — tidak perlu token)
// =====================================================================
Route::post('/auth/login', [AuthController::class, 'prosesLogin']);
Route::post('/auth/register', [AuthController::class, 'prosesRegister']);

// =====================================================================
// PROTECTED ROUTES
// =====================================================================
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);

    // =================================================================
    // OPERATOR
    // =================================================================
    Route::middleware(['role:operator'])->prefix('operator')->group(function () {

        // Data Siswa
        Route::get('/data-siswa', [SiswaController::class, 'index']);
        Route::get('/data-siswa/trash', [SiswaController::class, 'trash']);
        Route::get('/data-siswa/template', [SiswaController::class, 'exportTemplate']);
        Route::get('/data-siswa/export', [SiswaController::class, 'exportData']);
        Route::post('/data-siswa', [SiswaController::class, 'store']);
        Route::post('/data-siswa/import', [SiswaController::class, 'import']);
        Route::get('/data-siswa/{id}/show', [SiswaController::class, 'show']);
        Route::get('/data-siswa/{id}/pdf', [SiswaController::class, 'exportPdfSatu']);
        Route::get('/data-siswa/{id}/riwayat-kelas', [SiswaController::class, 'riwayatKelas']);
        Route::put('/data-siswa/{id}', [SiswaController::class, 'update']);
        Route::delete('/data-siswa/{id}', [SiswaController::class, 'destroy']);
        Route::post('/data-siswa/{id}/restore', [SiswaController::class, 'restore']);
        Route::delete('/data-siswa/{id}/force', [SiswaController::class, 'forceDelete']);
        Route::put('/data-siswa/{id}/mutasi', [SiswaController::class, 'mutasiLulus']);
        Route::put('/data-siswa/{id}/reactivate', [SiswaController::class, 'reactivate']);

        // Berkas siswa
        Route::get('/data-siswa/{siswaId}/berkas', [SiswaController::class, 'berkasIndex']);
        Route::post('/data-siswa/{siswaId}/berkas', [SiswaController::class, 'berkasStore']);
        Route::get('/data-siswa/{siswaId}/berkas/{berkasId}/view', [SiswaController::class, 'berkasView']);
        Route::get('/data-siswa/{siswaId}/berkas/{berkasId}/download', [SiswaController::class, 'berkasDownload']);
        Route::delete('/data-siswa/{siswaId}/berkas/{berkasId}', [SiswaController::class, 'berkasDestroy']);

        // Prestasi siswa
        Route::get('/data-siswa/{siswaId}/prestasi', [SiswaController::class, 'prestasiIndex']);
        Route::post('/data-siswa/{siswaId}/prestasi', [SiswaController::class, 'prestasiStore']);
        Route::post('/data-siswa/{siswaId}/prestasi/{prestasiId}', [SiswaController::class, 'prestasiUpdate']);
        Route::delete('/data-siswa/{siswaId}/prestasi/{prestasiId}', [SiswaController::class, 'prestasiDestroy']);
        Route::get('/data-siswa/{siswaId}/prestasi/{prestasiId}/view', [SiswaController::class, 'prestasiViewBukti']);
        Route::get('/data-siswa/{siswaId}/prestasi/{prestasiId}/download', [SiswaController::class, 'prestasiDownloadBukti']);

        // Beasiswa siswa
        Route::get('/data-siswa/{siswaId}/beasiswa', [SiswaController::class, 'beasiswaIndex']);
        Route::post('/data-siswa/{siswaId}/beasiswa', [SiswaController::class, 'beasiswaStore']);
        Route::post('/data-siswa/{siswaId}/beasiswa/{beasiswaId}', [SiswaController::class, 'beasiswaUpdate']);
        Route::delete('/data-siswa/{siswaId}/beasiswa/{beasiswaId}', [SiswaController::class, 'beasiswaDestroy']);

        // Data Guru
        Route::get('/data-guru', [GuruController::class, 'index']);
        Route::get('/data-guru/trash', [GuruController::class, 'trash']);
        Route::get('/data-guru/export', [GuruController::class, 'exportData']);
        Route::get('/data-guru/export-excel', [GuruController::class, 'exportExcel']);
        Route::get('/data-guru/export-pdf-rekap', [GuruController::class, 'exportPdfRekap']);
        Route::get('/data-guru/export-template', [GuruController::class, 'exportTemplate']);
        Route::get('/data-guru/laporan/export', [GuruController::class, 'exportLaporan']);
        Route::post('/data-guru', [GuruController::class, 'store']);
        Route::post('/data-guru/import', [GuruController::class, 'import']);
        Route::get('/data-guru/{id}/show', [GuruController::class, 'show']);
        Route::get('/data-guru/{id}/kartu-pdf', [GuruController::class, 'exportPdf']);
        Route::put('/data-guru/{id}', [GuruController::class, 'update']);
        Route::delete('/data-guru/{id}', [GuruController::class, 'destroy']);
        Route::patch('/data-guru/{id}/restore', [GuruController::class, 'restore']);
        Route::delete('/data-guru/{id}/force-delete', [GuruController::class, 'forceDelete']);
        Route::post('/data-guru/{id}/assign-user', [GuruController::class, 'assignUser']);

        // Diklat guru
        Route::prefix('data-guru/{guruId}/diklat')->group(function () {
            Route::get('/', [GuruDiklatController::class, 'index']);
            Route::post('/', [GuruDiklatController::class, 'store']);
            Route::put('/{diklatId}', [GuruDiklatController::class, 'update']);
            Route::delete('/{diklatId}', [GuruDiklatController::class, 'destroy']);
            Route::get('/{diklatId}/sertifikat', [GuruDiklatController::class, 'viewSertifikat']);
        });

        // Inpassing guru
        Route::prefix('data-guru/{guruId}/inpassing')->group(function () {
            Route::get('/', [GuruInpassingController::class, 'index']);
            Route::post('/', [GuruInpassingController::class, 'store']);
            Route::patch('/{inpassingId}/aktif', [GuruInpassingController::class, 'setAktif']);
            Route::delete('/{inpassingId}', [GuruInpassingController::class, 'destroy']);
            Route::get('/{inpassingId}/sk', [GuruInpassingController::class, 'viewSK']);
        });

        // Dokumen guru
        Route::get('/data-guru/{id}/dokumen', [GuruDokumenController::class, 'index']);
        Route::post('/data-guru/{id}/dokumen', [GuruDokumenController::class, 'store']);
        Route::post('/data-guru/{id}/dokumen/{dokumenId}', [GuruDokumenController::class, 'update']);
        Route::delete('/data-guru/{id}/dokumen/{dokumenId}', [GuruDokumenController::class, 'destroy']);
        Route::get('/data-guru/{id}/dokumen/{dokumenId}/view', [GuruDokumenController::class, 'view']);
        Route::get('/data-guru/{id}/dokumen/{dokumenId}/download', [GuruDokumenController::class, 'download']);
        Route::patch('/data-guru/{id}/dokumen/{dokumenId}/verify', [GuruDokumenController::class, 'verify']);

        // Data Kelas
        Route::get('/data-kelas', [KelasController::class, 'index']);
        Route::post('/data-kelas/store', [KelasController::class, 'store']);
        Route::put('/data-kelas/{id}', [KelasController::class, 'update']);
        Route::delete('/data-kelas/{id}', [KelasController::class, 'destroy']);
        Route::get('/kelas/{id}/siswa', [KelasController::class, 'getSiswa']);
        Route::get('/penempatan-siswa', [KelasController::class, 'penempatan']);
        Route::post('/penempatan-siswa/update', [KelasController::class, 'updatePenempatan']);

        // Semester & Tahun Ajaran
        Route::get('/semester/trash', [SemesterController::class, 'trash']);
        Route::get('/semester', [SemesterController::class, 'index']);
        Route::post('/semester', [SemesterController::class, 'store']);
        Route::put('/semester/{id}', [SemesterController::class, 'update']);
        Route::delete('/semester/{id}', [SemesterController::class, 'destroy']);
        Route::post('/semester/{id}/restore', [SemesterController::class, 'restore']);
        Route::delete('/semester/{id}/force', [SemesterController::class, 'forceDelete']);
        Route::patch('/semester/{id}/aktif', [SemesterController::class, 'setActive']);

        Route::get('/tahun-ajaran', [TahunAjaranController::class, 'index']);
        Route::get('/tahun-ajaran/trash', [TahunAjaranController::class, 'trash']);
        Route::post('/tahun-ajaran', [TahunAjaranController::class, 'store']);
        Route::put('/tahun-ajaran/{id}', [TahunAjaranController::class, 'update']);
        Route::delete('/tahun-ajaran/{id}', [TahunAjaranController::class, 'destroy']);
        Route::post('/tahun-ajaran/{id}/restore', [TahunAjaranController::class, 'restore']);
        Route::delete('/tahun-ajaran/{id}/force', [TahunAjaranController::class, 'forceDelete']);
        Route::patch('/tahun-ajaran/{id}/archive', [TahunAjaranController::class, 'archive']);
        Route::get('/kenaikan-kelas', [TahunAjaranController::class, 'kenaikanKelas']);
        Route::post('/tahun-ajaran/promote', [TahunAjaranController::class, 'promoteSiswa']);

        // Manajemen User
        Route::get('/manajemen-akun', [UserManagementController::class, 'index']);
        Route::post('/manajemen-akun/store', [UserManagementController::class, 'store']);
        Route::patch('/manajemen-akun/{id}/toggle', [UserManagementController::class, 'toggleStatus']);
        Route::put('/manajemen-akun/{id}', [UserManagementController::class, 'update']);
        Route::patch('/manajemen-akun/{id}/reset-password', [UserManagementController::class, 'resetPassword']);
        Route::delete('/manajemen-akun/{id}', [UserManagementController::class, 'destroy']);
    });

    // =================================================================
    // GURU
    // =================================================================
    Route::middleware(['role:guru'])->prefix('guru')->group(function () {
        Route::get('/dashboard', [GuruDashboardController::class, 'index']);
        Route::get('/jadwal', [GuruJadwalController::class, 'index']);
        Route::get('/absensi', [GuruAbsensiController::class, 'index']);
        Route::post('/absensi', [GuruAbsensiController::class, 'store']);
        Route::get('/absensi/rekap', [GuruAbsensiController::class, 'rekap']);
        Route::get('/nilai', [GuruNilaiController::class, 'index']);
        Route::post('/nilai', [GuruNilaiController::class, 'store']);
        Route::get('/nilai/rekap', [GuruNilaiController::class, 'rekap']);

        Route::prefix('wali-kelas')->group(function () {
            Route::get('/', [WaliKelasController::class, 'info']);
            Route::get('/siswa', [WaliKelasController::class, 'dataSiswa']);
            Route::get('/catatan', [WaliKelasController::class, 'catatanIndex']);
            Route::post('/catatan', [WaliKelasController::class, 'catatanStore']);
        });
    });

    // =================================================================
    // KEPSEK
    // =================================================================
    Route::middleware(['role:kepsek'])->prefix('kepsek')->group(function () {
        Route::get('/dashboard', [KepsekDashboardController::class, 'index']);
        Route::get('/akademik', [AkademikController::class, 'index']);
        Route::get('/sdm/guru', [SdmController::class, 'index']);
        Route::get('/sdm/guru/{id}', [SdmController::class, 'show']);
    });

    // =================================================================
    // ORTU
    // =================================================================
    Route::middleware(['role:ortu'])->prefix('ortu')->group(function () {
        Route::get('/dashboard', [OrtuDashboardController::class, 'index']);
        Route::get('/absensi', [OrtuDashboardController::class, 'absensi']);
        Route::get('/nilai', [OrtuDashboardController::class, 'nilai']);
        Route::get('/pembayaran', [OrtuDashboardController::class, 'pembayaran']);
    });

    // =================================================================
    // BENDAHARA
    // =================================================================
    Route::middleware(['role:bendahara'])->prefix('bendahara')->group(function () {
        Route::get('/dashboard', [BendaraDashboardController::class, 'index']);

        // Tagihan
        Route::get('/tagihan', [BendaraTagihanController::class, 'index']);
        Route::post('/tagihan', [BendaraTagihanController::class, 'store']);
        Route::put('/tagihan/{id}', [BendaraTagihanController::class, 'update']);
        Route::delete('/tagihan/{id}', [BendaraTagihanController::class, 'destroy']);

        // Pembayaran
        Route::get('/pembayaran', [BendaraPembayaranController::class, 'index']);
        Route::post('/pembayaran', [BendaraPembayaranController::class, 'store']);
        Route::delete('/pembayaran/{id}', [BendaraPembayaranController::class, 'destroy']);
        Route::get('/pembayaran/laporan', [BendaraPembayaranController::class, 'laporan']);
        Route::get('/tunggakan', [BendaraPembayaranController::class, 'tunggakan']);
    });

    // =================================================================
    // WALI KELAS
    // =================================================================
    Route::middleware(['role:wali_kelas'])->prefix('wali-kelas')->group(function () {
        Route::get('/dashboard', [WaliKelasDashboardController::class, 'index']);

        // Data siswa di kelas
        Route::get('/siswa', [WaliKelasSiswaController::class, 'index']);
        Route::get('/siswa/{id}/absensi', [WaliKelasSiswaController::class, 'absensi']);
        Route::get('/siswa/{id}/nilai', [WaliKelasSiswaController::class, 'nilai']);

        // Catatan wali kelas
        Route::get('/catatan', [WaliKelasSiswaController::class, 'catatanIndex']);
        Route::post('/catatan', [WaliKelasSiswaController::class, 'catatanStore']);
    });

    // =================================================================
    // ADMIN PPDB
    // =================================================================
    Route::middleware(['role:admin_ppdb'])->prefix('admin-ppdb')->group(function () {
        Route::get('/dashboard', [AdminPpdbDashboardController::class, 'index']);

        // Pendaftar
        Route::get('/pendaftar', [AdminPpdbPendaftarController::class, 'index']);
        Route::get('/pendaftar/{id}', [AdminPpdbPendaftarController::class, 'show']);
        Route::patch('/pendaftar/{id}/status', [AdminPpdbPendaftarController::class, 'updateStatus']);

        // Verifikasi berkas
        Route::patch('/berkas/{berkasId}/verifikasi', [AdminPpdbPendaftarController::class, 'verifikasiBerkas']);
    });
});
