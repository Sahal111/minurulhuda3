<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * GET /api/bendahara/tagihan
     */
    public function index(Request $request)
    {
        $tagihans = Tagihan::with('tahunAjaran')
            ->when($request->search, fn($q) => $q->where('nama', 'like', '%' . $request->search . '%'))
            ->when($request->tahun_ajaran_id, fn($q) => $q->where('tahun_ajaran_id', $request->tahun_ajaran_id))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json($tagihans);
    }

    /**
     * POST /api/bendahara/tagihan
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'tahun_ajaran_id' => 'nullable|exists:tahun_ajarans,id',
            'kategori' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $tagihan = Tagihan::create([
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
            'created_by' => $request->user()->id,
        ]);

        return response()->json(['message' => 'Tagihan berhasil dibuat.', 'data' => $tagihan], 201);
    }

    /**
     * PUT /api/bendahara/tagihan/{id}
     */
    public function update(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);

        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'jumlah' => 'sometimes|required|numeric|min:0',
            'tahun_ajaran_id' => 'nullable|exists:tahun_ajarans,id',
            'kategori' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $tagihan->update(array_merge(
            $request->only(['nama', 'jumlah', 'tahun_ajaran_id', 'kategori', 'keterangan']),
            ['updated_by' => $request->user()->id]
        ));

        return response()->json(['message' => 'Tagihan berhasil diperbarui.', 'data' => $tagihan]);
    }

    /**
     * DELETE /api/bendahara/tagihan/{id}
     */
    public function destroy($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->delete();

        return response()->json(['message' => 'Tagihan berhasil dihapus.']);
    }
}