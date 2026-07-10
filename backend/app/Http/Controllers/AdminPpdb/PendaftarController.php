<?php

namespace App\Http\Controllers\AdminPpdb;

use App\Http\Controllers\Controller;
use App\Models\BerkasPendaftar;
use App\Models\CalonSiswa;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    /**
     * GET /api/admin-ppdb/pendaftar
     */
    public function index(Request $request)
    {
        $pendaftars = CalonSiswa::with(['tahunAjaran', 'berkas'])
            ->when($request->search, fn($q) => $q->where('nama', 'like', '%' . $request->search . '%'))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->tahun_ajaran_id, fn($q) => $q->where('tahun_ajaran_id', $request->tahun_ajaran_id))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json($pendaftars);
    }

    /**
     * GET /api/admin-ppdb/pendaftar/{id}
     */
    public function show($id)
    {
        $pendaftar = CalonSiswa::with(['berkas', 'pembayaran', 'tahunAjaran'])->findOrFail($id);
        return response()->json($pendaftar);
    }

    /**
     * PATCH /api/admin-ppdb/pendaftar/{id}/status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $pendaftar = CalonSiswa::findOrFail($id);
        $pendaftar->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'updated_by' => $request->user()->id,
        ]);

        return response()->json(['message' => 'Status pendaftar berhasil diperbarui.', 'data' => $pendaftar]);
    }

    /**
     * PATCH /api/admin-ppdb/berkas/{berkasId}/verifikasi
     */
    public function verifikasiBerkas(Request $request, $berkasId)
    {
        $request->validate([
            'status' => 'required|in:menunggu,valid,tidak_valid',
            'keterangan' => 'nullable|string',
        ]);

        $berkas = BerkasPendaftar::findOrFail($berkasId);
        $berkas->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'verified_by' => $request->user()->id,
            'verified_at' => now(),
        ]);

        return response()->json(['message' => 'Berkas berhasil diverifikasi.', 'data' => $berkas]);
    }
}