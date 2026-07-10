<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class AkademikController extends Controller
{
    /**
     * Rekap akademik global untuk kepsek
     * GET /api/kepsek/akademik
     */
    public function index(Request $request)
    {
        $tahunAktif = TahunAjaran::where('is_active', true)->first();

        // Rata-rata nilai per kelas
        $nilaiPerKelas = Kelas::when($tahunAktif, fn($q) => $q->where('tahun_ajaran_id', $tahunAktif->id))
            ->get()
            ->map(function ($kelas) {
                $siswaIds = Siswa::where('kelas_id', $kelas->id)->pluck('id');
                $rataRata = Nilai::whereIn('siswa_id', $siswaIds)->avg('nilai');

                return [
                    'kelas_id' => $kelas->id,
                    'nama_kelas' => $kelas->nama_kelas,
                    'tingkat' => $kelas->tingkat,
                    'rata_rata' => $rataRata ? round($rataRata, 2) : null,
                ];
            });

        // Rekap absensi bulan ini per kelas
        $absensiPerKelas = Kelas::when($tahunAktif, fn($q) => $q->where('tahun_ajaran_id', $tahunAktif->id))
            ->get()
            ->map(function ($kelas) {
                $siswaIds = Siswa::where('kelas_id', $kelas->id)->pluck('id');

                $stats = Absensi::whereIn('siswa_id', $siswaIds)
                    ->whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year)
                    ->selectRaw('status, COUNT(*) as total')
                    ->groupBy('status')
                    ->pluck('total', 'status');

                return [
                    'kelas_id' => $kelas->id,
                    'nama_kelas' => $kelas->nama_kelas,
                    'hadir' => $stats['hadir'] ?? 0,
                    'izin' => $stats['izin'] ?? 0,
                    'sakit' => $stats['sakit'] ?? 0,
                    'alpha' => $stats['alpha'] ?? 0,
                ];
            });

        return response()->json([
            'tahun_ajaran' => $tahunAktif?->tahun,
            'nilai_per_kelas' => $nilaiPerKelas,
            'absensi_per_kelas' => $absensiPerKelas,
        ]);
    }
}