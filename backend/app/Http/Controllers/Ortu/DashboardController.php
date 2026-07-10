<?php

namespace App\Http\Controllers\Ortu;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Helper: ambil siswa-siswa yang terhubung ke ortu yang login
     */
    private function getSiswas(Request $request)
    {
        $user = $request->user();
        $ortu = $user->orangTua;

        if (!$ortu) {
            return collect();
        }

        return $ortu->siswas()->with(['kelas', 'kelas.waliKelas'])->get();
    }

    /**
     * GET /api/ortu/dashboard
     */
    public function index(Request $request)
    {
        $siswas = $this->getSiswas($request);

        if ($siswas->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data anak yang terhubung.'], 404);
        }

        $data = $siswas->map(function ($siswa) {
            // Absensi bulan ini
            $absensi = Absensi::where('siswa_id', $siswa->id)
                ->whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->selectRaw('status, COUNT(*) as total')
                ->groupBy('status')
                ->pluck('total', 'status');

            // Tagihan belum lunas
            $tunggakan = Tagihan::whereDoesntHave('pembayarans', fn($q) => $q->where('siswa_id', $siswa->id))
                ->count();

            return [
                'siswa_id' => $siswa->id,
                'nama' => $siswa->nama,
                'nisn' => $siswa->nisn,
                'kelas' => $siswa->kelas?->nama_kelas,
                'wali_kelas' => $siswa->kelas?->waliKelas?->nama,
                'foto' => $siswa->foto ? asset('storage/' . $siswa->foto) : null,
                'absensi' => [
                    'hadir' => $absensi['hadir'] ?? 0,
                    'izin' => $absensi['izin'] ?? 0,
                    'sakit' => $absensi['sakit'] ?? 0,
                    'alpha' => $absensi['alpha'] ?? 0,
                ],
                'tunggakan' => $tunggakan,
            ];
        });

        return response()->json($data);
    }

    /**
     * Absensi anak
     * GET /api/ortu/absensi?siswa_id=&bulan=&tahun=
     */
    public function absensi(Request $request)
    {
        $siswas = $this->getSiswas($request);
        $siswaIds = $siswas->pluck('id');

        $siswaId = $request->siswa_id;
        if ($siswaId && !$siswaIds->contains($siswaId)) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $bulan = $request->query('bulan', now()->month);
        $tahun = $request->query('tahun', now()->year);

        $query = Absensi::with('siswa')
            ->whereIn('siswa_id', $siswaId ? [$siswaId] : $siswaIds->toArray())
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'desc');

        return response()->json($query->get());
    }

    /**
     * Nilai anak
     * GET /api/ortu/nilai?siswa_id=
     */
    public function nilai(Request $request)
    {
        $siswas = $this->getSiswas($request);
        $siswaIds = $siswas->pluck('id');

        $siswaId = $request->siswa_id;
        if ($siswaId && !$siswaIds->contains($siswaId)) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $targetIds = $siswaId ? [$siswaId] : $siswaIds->toArray();

        $nilais = \App\Models\Nilai::with(['plotGuruMapel.mapel', 'komponenPenilaian'])
            ->whereIn('siswa_id', $targetIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($nilais);
    }

    /**
     * Riwayat pembayaran & tagihan anak
     * GET /api/ortu/pembayaran?siswa_id=
     */
    public function pembayaran(Request $request)
    {
        $siswas = $this->getSiswas($request);
        $siswaIds = $siswas->pluck('id');

        $siswaId = $request->siswa_id;
        if ($siswaId && !$siswaIds->contains($siswaId)) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $targetIds = $siswaId ? [$siswaId] : $siswaIds->toArray();

        $pembayarans = Pembayaran::with(['siswa', 'tagihan'])
            ->whereIn('siswa_id', $targetIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($pembayarans);
    }
}