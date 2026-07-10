<?php

use App\Http\Controllers\Operator\GuruController;
use App\Http\Controllers\Operator\GuruDiklatController;
use App\Http\Controllers\Operator\GuruDokumenController;
use App\Http\Controllers\Operator\GuruInpassingController;
use App\Http\Controllers\Operator\KelasController;
use App\Http\Controllers\Operator\SemesterController;
use App\Http\Controllers\Operator\SiswaController;
use App\Http\Controllers\Operator\TahunAjaranController;
use App\Http\Controllers\Operator\UserManagementController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// ===================== PUBLIC =====================

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/program', [HomeController::class, 'program'])->name('program');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/ppdb', [HomeController::class, 'ppdb'])->name('ppdb');

// ===================== AUTH =====================

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin'])->name('login.proses');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'prosesRegister'])->name('register.proses');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===================== DASHBOARD ROLE =====================

Route::middleware(['auth', 'role:ortu'])
    ->prefix('ortu')
    ->name('ortu.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('ortu.dashboard'))->name('dashboard');
        Route::get('/nilai', fn() => view('ortu.nilai'))->name('nilai');
        Route::get('/absensi', fn() => view('ortu.absensi'))->name('absensi');
        Route::get('/pembayaran', fn() => view('ortu.pembayaran'))->name('pembayaran');
        Route::get('/jadwal', fn() => view('ortu.jadwal'))->name('jadwal');
        Route::get('/catatan', fn() => view('ortu.catatan'))->name('catatan');
        Route::get('/setting', fn() => view('ortu.setting'))->name('setting');
    });

Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('guru.dashboard'))->name('dashboard');
        Route::get('/jadwal', fn() => view('guru.jadwal'))->name('jadwal');
        Route::get('/absensi', fn() => view('guru.absensi'))->name('absensi');
        Route::get('/penilaian', fn() => view('guru.penilaian'))->name('penilaian');
        Route::get('/materi-tugas', fn() => view('guru.materiTugas'))->name('materiTugas');
        Route::get('/rekap-akademik', fn() => view('guru.rekapAkademik'))->name('rekapAkademik');
        Route::get('/analitik-kelas', fn() => view('guru.analitikKelas'))->name('analitikKelas');
        Route::get('/setting', fn() => view('guru.setting'))->name('setting');

        // WALIKELAS SUB MENU
        Route::prefix('wali')->name('wali.')->group(function () {
            Route::get('/dashboard', fn() => view('guru.wali.dashboard'))->name('dashboard');
            Route::get('/data-siswa', fn() => view('guru.wali.data-siswa'))->name('dataSiswa');
            Route::get('/rekap-absensi', fn() => view('guru.wali.rekap-absensi'))->name('rekapAbsensi');
            Route::get('/rekap-nilai', fn() => view('guru.wali.rekap-nilai'))->name('rekapNilai');
            Route::get('/monitoring-spp', fn() => view('guru.wali.monitoring-spp'))->name('monitoringSpp');
            Route::get('/cetak-rapor', fn() => view('guru.wali.cetak-rapor'))->name('cetakRapor');
            Route::get('/catatan', fn() => view('guru.wali.catatan'))->name('catatan');
        });
    });

// ===================== KEPSEK AREA =====================

Route::middleware(['auth', 'role:kepsek'])
    ->prefix('kepsek')
    ->name('kepsek.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', fn() => view('kepsek.dashboard'))
            ->name('dashboard');

        // Monitoring
        Route::get('/akademik', fn() => view('kepsek.akademik'))
            ->name('akademik');

        Route::get('/sdm', fn() => view('kepsek.sdm'))
            ->name('sdm');

        Route::get('/keuangan', fn() => view('kepsek.keuangan'))
            ->name('keuangan');

        Route::get('/ppdb', fn() => view('kepsek.ppdb'))
            ->name('ppdb');

        // Operations
        Route::get('/approval', fn() => view('kepsek.approval'))
            ->name('approval');

        Route::get('/laporan', fn() => view('kepsek.laporan'))
            ->name('laporan');

        Route::get('/notifikasi', fn() => view('kepsek.notifikasi'))
            ->name('notifikasi');

        Route::get('/audit-log', fn() => view('kepsek.auditLog'))
            ->name('auditLog');

        // System
        Route::get('/setting', fn() => view('kepsek.setting'))
            ->name('setting');
    });

    // Route::middleware(['auth', 'role:operator']) block moved to routes/api.php

Route::middleware(['auth', 'role:bendahara'])
    ->prefix('bendahara')
    ->name('bendahara.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('bendahara.dashboard'))->name('dashboard');
        Route::get('/spp', fn() => view('bendahara.spp'))->name('spp');
        Route::get('/laporan-keuangan', fn() => view('bendahara.laporanKeuangan'))->name('laporan');
        Route::get('/rekap-tunggakan', fn() => view('bendahara.rekapTunggakan'))->name('rekap');
        Route::get('/transaksi', fn() => view('bendahara.transaksi'))->name('transaksi');
        Route::get('/audit', fn() => view('bendahara.audit'))->name('audit');
        Route::get('/setting', fn() => view('bendahara.setting'))->name('setting');
    });

Route::middleware(['auth', 'role:admin_ppdb'])
    ->prefix('adminPpdb')
    ->name('adminPpdb.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('adminPpdb.dashboard'))->name('dashboard');
        Route::get('/tambah-pendaftar', fn() => view('adminPpdb.tambahPendaftar'))->name('tambahPendaftar');
        Route::get('/upload-import', fn() => view('adminPpdb.uploadImport'))->name('uploadImport');
        Route::get('/data-pendaftar', fn() => view('adminPpdb.dataPendaftar'))->name('dataPendaftar');
        Route::get('/verifikasi', fn() => view('adminPpdb.verifikasiBerkas'))->name('verifikasiBerkas');
        Route::get('/verifikasi-detail', fn() => view('adminPpdb.verifikasiDetail'))->name('verifikasiDetail');
        Route::get('/seleksi', fn() => view('adminPpdb.seleksi'))->name('seleksi');
        Route::get('/pembayaran', fn() => view('adminPpdb.pembayaran'))->name('pembayaran');
        Route::get('/konversi', fn() => view('adminPpdb.konversi'))->name('konversi');
        Route::get('/statistik-laporan', fn() => view('adminPpdb.stastistikLaporan'))->name('stastistikLaporan');
        Route::get('/setting', fn() => view('adminPpdb.setting'))->name('setting');
    });