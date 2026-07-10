<?php

namespace App\Http\Controllers\AdminPpdb;

use App\Http\Controllers\Controller;
use App\Models\BerkasPendaftar;
use App\Models\CalonSiswa;
use App\Models\PembayaranPpdb;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * GET /api/admin-ppdb/dashboard
     */
    public function index(Request $request)
    {
        $totalPendaftar = CalonSiswa::count();
        $menungguVerifikasi = CalonSiswa::where('status', 'menunggu')->count();
        $diterima = CalonSiswa::where('status', 'diterima')->count();
        $ditolak = CalonSiswa::where('status', 'ditolak')->count();

        $berkasMenunggu = BerkasPendaftar::where('status', 'menunggu')->count();

        $pendaftarTerbaru = CalonSiswa::with('tahunAjaran')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(fn($c) => [
                'id' => $c->id,
                'nama' => $c->nama,
                'status' => $c->status,
                'tahun_ajaran' => $c->tahunAjaran?->tahun,
                'tanggal' => $c->created_at?->format('d M Y'),
            ]);

        return response()->json([
            'stats' => [
                'total_pendaftar' => $totalPendaftar,
                'menunggu_verifikasi' => $menungguVerifikasi,
                'diterima' => $diterima,
                'ditolak' => $ditolak,
                'berkas_menunggu' => $berkasMenunggu,
            ],
            'pendaftar_terbaru' => $pendaftarTerbaru,
        ]);
    }
}