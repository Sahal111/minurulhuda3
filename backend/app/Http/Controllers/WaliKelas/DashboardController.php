<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function getKelasId(Request $request): ?int
    {
        $guru = $request->user()->guru;
        if (!$guru)
            return null;

        $wali = WaliKelas::where('guru_id', $guru->id)
            ->where('is_active', true)
            ->first();

        return $wali?->kelas_id;
    }

    /**
     * GET /api/wali-kelas/dashboard
     */
    public function index(Request $request)
    {
        $kelasId = $this->getKelasId($request);

        if (!$kelasId) {
            return response()->json(['message' => 'Anda tidak terdaftar sebagai wali kelas aktif.'], 403);
        }

        $totalSiswa = Siswa::where('kelas_id', $kelasId)->where('status', 'aktif')->count();

        $absensiHariIni = Absensi::whereHas('siswa', fn($q) => $q->where('kelas_id', $kelasId))
            ->whereDate('tanggal', today())
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $rekapAbsensiBulanIni = Absensi::whereHas('siswa', fn($q) => $q->where('kelas_id', $kelasId))
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return response()->json([
            'kelas_id' => $kelasId,
            'total_siswa' => $totalSiswa,
            'absensi_hari_ini' => [
                'hadir' => $absensiHariIni['hadir'] ?? 0,
                'izin' => $absensiHariIni['izin'] ?? 0,
                'sakit' => $absensiHariIni['sakit'] ?? 0,
                'alpha' => $absensiHariIni['alpha'] ?? 0,
            ],
            'rekap_bulan_ini' => [
                'hadir' => $rekapAbsensiBulanIni['hadir'] ?? 0,
                'izin' => $rekapAbsensiBulanIni['izin'] ?? 0,
                'sakit' => $rekapAbsensiBulanIni['sakit'] ?? 0,
                'alpha' => $rekapAbsensiBulanIni['alpha'] ?? 0,
            ],
        ]);
    }
}