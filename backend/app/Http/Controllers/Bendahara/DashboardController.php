<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * GET /api/bendahara/dashboard
     */
    public function index(Request $request)
    {
        $totalSiswa = Siswa::where('status', 'aktif')->count();
        $totalTagihan = Tagihan::count();
        $totalPembayaran = Pembayaran::whereNull('deleted_at')->count();

        $pemasukanBulanIni = Pembayaran::whereNull('deleted_at')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('jumlah');

        $pembayaranTerbaru = Pembayaran::with(['siswa', 'tagihan'])
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(fn($p) => [
                'id' => $p->id,
                'nama_siswa' => $p->siswa?->nama,
                'tagihan' => $p->tagihan?->nama ?? '-',
                'jumlah' => $p->jumlah,
                'tanggal' => $p->created_at?->format('d M Y'),
                'status' => $p->status ?? 'lunas',
            ]);

        return response()->json([
            'stats' => [
                'total_siswa' => $totalSiswa,
                'total_tagihan' => $totalTagihan,
                'total_pembayaran' => $totalPembayaran,
                'pemasukan_bulan_ini' => $pemasukanBulanIni,
            ],
            'pembayaran_terbaru' => $pembayaranTerbaru,
        ]);
    }
}