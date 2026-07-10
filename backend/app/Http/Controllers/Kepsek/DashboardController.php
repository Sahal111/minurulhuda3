<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahunAktif = TahunAjaran::where('is_active', true)->with('semesters')->first();

        // ─── Statistik Siswa ───
        $totalSiswa = Siswa::where('status', 'aktif')->count();
        $siswaLaki = Siswa::where('status', 'aktif')->where('jenis_kelamin', 'L')->count();
        $siswaPerempuan = Siswa::where('status', 'aktif')->where('jenis_kelamin', 'P')->count();

        // Siswa per kelas
        $siswaPerKelas = Kelas::withCount(['siswas as total_siswa' => fn($q) => $q->where('status', 'aktif')])
            ->when($tahunAktif, fn($q) => $q->where('tahun_ajaran_id', $tahunAktif->id))
            ->get(['id', 'nama_kelas', 'tingkat', 'total_siswa']);

        // ─── Statistik Guru ───
        $totalGuru = Guru::where('status_aktif', true)->count();
        $guruPns = Guru::where('status_aktif', true)
            ->whereHas('jabatans', fn($q) => $q->where('is_current', true)->where('status_kepegawaian', 'PNS'))
            ->count();
        $guruHonorer = $totalGuru - $guruPns;

        // ─── Statistik Keuangan (bulan ini) ───
        $pemasukanBulanIni = Pembayaran::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('jumlah');

        // ─── Statistik Kelas ───
        $totalKelas = Kelas::when($tahunAktif, fn($q) => $q->where('tahun_ajaran_id', $tahunAktif->id))
            ->count();

        return response()->json([
            'tahun_ajaran' => $tahunAktif?->tahun,
            'semester_aktif' => $tahunAktif?->semesters->where('is_active', true)->first()?->nama,
            'siswa' => [
                'total' => $totalSiswa,
                'laki' => $siswaLaki,
                'perempuan' => $siswaPerempuan,
                'per_kelas' => $siswaPerKelas,
            ],
            'guru' => [
                'total' => $totalGuru,
                'pns' => $guruPns,
                'honorer' => $guruHonorer,
            ],
            'kelas' => [
                'total' => $totalKelas,
            ],
            'keuangan' => [
                'pemasukan_bulan_ini' => $pemasukanBulanIni,
            ],
        ]);
    }
}