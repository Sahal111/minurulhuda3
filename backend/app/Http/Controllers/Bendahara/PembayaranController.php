<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * GET /api/bendahara/pembayaran
     */
    public function index(Request $request)
    {
        $pembayarans = Pembayaran::with(['siswa', 'tagihan'])
            ->when($request->search, fn($q) => $q->whereHas('siswa', fn($s) => $s->where('nama', 'like', '%' . $request->search . '%')))
            ->when($request->tagihan_id, fn($q) => $q->where('tagihan_id', $request->tagihan_id))
            ->when($request->bulan, fn($q) => $q->whereMonth('created_at', $request->bulan))
            ->when($request->tahun, fn($q) => $q->whereYear('created_at', $request->tahun))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json($pembayarans);
    }

    /**
     * POST /api/bendahara/pembayaran
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tagihan_id' => 'required|exists:tagihans,id',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran = Pembayaran::create([
            'siswa_id' => $request->siswa_id,
            'tagihan_id' => $request->tagihan_id,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'created_by' => $request->user()->id,
        ]);

        return response()->json(['message' => 'Pembayaran berhasil dicatat.', 'data' => $pembayaran->load(['siswa', 'tagihan'])], 201);
    }

    /**
     * DELETE /api/bendahara/pembayaran/{id}
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return response()->json(['message' => 'Data pembayaran berhasil dihapus.']);
    }

    /**
     * GET /api/bendahara/pembayaran/laporan
     */
    public function laporan(Request $request)
    {
        $bulan = $request->query('bulan', now()->month);
        $tahun = $request->query('tahun', now()->year);

        $total = Pembayaran::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->sum('jumlah');

        $perTagihan = Pembayaran::with('tagihan')
            ->selectRaw('tagihan_id, SUM(jumlah) as total, COUNT(*) as jumlah_transaksi')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('tagihan_id')
            ->get();

        return response()->json([
            'bulan' => $bulan,
            'tahun' => $tahun,
            'total' => $total,
            'per_tagihan' => $perTagihan,
        ]);
    }

    /**
     * GET /api/bendahara/tunggakan
     * Siswa yang belum bayar tagihan tertentu
     */
    public function tunggakan(Request $request)
    {
        $request->validate(['tagihan_id' => 'required|exists:tagihans,id']);

        $sudahBayar = Pembayaran::where('tagihan_id', $request->tagihan_id)
            ->pluck('siswa_id');

        $belumBayar = Siswa::where('status', 'aktif')
            ->whereNotIn('id', $sudahBayar)
            ->with('kelas')
            ->orderBy('nama')
            ->get()
            ->map(fn($s) => [
                'id' => $s->id,
                'nama' => $s->nama,
                'nisn' => $s->nisn,
                'kelas' => $s->kelas?->nama_kelas,
            ]);

        return response()->json($belumBayar);
    }
}