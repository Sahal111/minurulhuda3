<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $guru = $user->guru;

        if (!$guru) {
            return response()->json(['message' => 'Data guru tidak ditemukan.'], 404);
        }

        $waliKelas = WaliKelas::with(['kelas', 'tahunAjaran', 'semester'])
            ->where('guru_id', $guru->id)
            ->where('is_active', true)
            ->first();

        $hariIni = strtolower(now()->locale('id')->dayName);
        $jadwalHariIni = Jadwal::with(['kelas', 'mapel'])
            ->where('guru_id', $guru->id)
            ->where('hari', $hariIni)
            ->orderBy('jam_mulai')
            ->get();

        $totalSiswaKelas = 0;
        if ($waliKelas) {
            $totalSiswaKelas = Siswa::where('kelas_id', $waliKelas->kelas_id)
                ->where('status', 'aktif')
                ->count();
        }

        $absensiStats = Absensi::where('guru_id', $guru->id)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return response()->json([
            'guru' => [
                'id' => $guru->id,
                'nama' => $guru->nama,
                'nuptk' => $guru->nuptk,
                'jabatan' => $guru->jabatan,
                'foto' => $guru->foto ? asset('storage/' . $guru->foto) : null,
            ],
            'wali_kelas' => $waliKelas ? [
                'kelas_id' => $waliKelas->kelas_id,
                'nama_kelas' => $waliKelas->kelas?->nama_kelas,
                'tahun_ajaran' => $waliKelas->tahunAjaran?->tahun,
                'semester' => $waliKelas->semester?->nama,
                'total_siswa' => $totalSiswaKelas,
            ] : null,
            'jadwal_hari_ini' => $jadwalHariIni,
            'absensi_bulan_ini' => [
                'hadir' => $absensiStats['hadir'] ?? 0,
                'izin' => $absensiStats['izin'] ?? 0,
                'sakit' => $absensiStats['sakit'] ?? 0,
                'alpha' => $absensiStats['alpha'] ?? 0,
            ],
        ]);
    }
}