<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\GuruDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruDokumenController extends Controller
{
    // ==================== INDEX (list dokumen 1 guru) ====================

    public function index($guruId)
    {
        $guru = Guru::with(['dokumens' => function ($q) {
            $q->latest();
        }])->findOrFail($guruId);

        $dokumens = $guru->dokumens->groupBy('kategori_group');

        return response()->json([
            'guru'     => $guru->only(['id', 'nama', 'nuptk', 'foto']),
            'dokumens' => $dokumens,
            'total'    => $guru->dokumens->count(),
            'expired'  => $guru->dokumens->filter->is_expired->count(),
            'expiring' => $guru->dokumens->filter->is_expiring_soon->count(),
        ]);
    }

    // ==================== STORE (upload dokumen) ====================

    public function store(Request $request, $guruId)
    {
        $request->validate([
            'dokumen'            => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'kategori'           => 'required|string|in:' . implode(',', array_keys(GuruDokumen::KATEGORI)),
            'nama_dokumen'       => 'required|string|max:150',
            'nomor_dokumen'      => 'nullable|string|max:100',
            'tanggal_dokumen'    => 'nullable|date',
            'tanggal_berlaku'    => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date|after:today',
            'penerbit'           => 'nullable|string|max:150',
            'keterangan'         => 'nullable|string|max:300',
        ]);

        $guru = Guru::findOrFail($guruId);
        $file = $request->file('dokumen');

        $path = $file->store("dokumen_guru/{$guru->id}", 'public');

        $dokumen = $guru->dokumens()->create([
            'kategori'           => $request->kategori,
            'nama_dokumen'       => $request->nama_dokumen,
            'nomor_dokumen'      => $request->nomor_dokumen,
            'tanggal_dokumen'    => $request->tanggal_dokumen,
            'tanggal_berlaku'    => $request->tanggal_berlaku,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'penerbit'           => $request->penerbit,
            'file_path'          => $path,
            'file_type'          => strtolower($file->getClientOriginalExtension()),
            'file_size'          => $file->getSize(),
            'keterangan'         => $request->keterangan,
        ]);

        return back()->with('success', "Dokumen \"{$request->nama_dokumen}\" berhasil diupload.");
    }

    // ==================== UPDATE (edit metadata) ====================

    public function update(Request $request, $guruId, $dokumenId)
    {
        $request->validate([
            'dokumen'            => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'kategori'           => 'required|string|in:' . implode(',', array_keys(GuruDokumen::KATEGORI)),
            'nama_dokumen'       => 'required|string|max:150',
            'nomor_dokumen'      => 'nullable|string|max:100',
            'tanggal_dokumen'    => 'nullable|date',
            'tanggal_berlaku'    => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'penerbit'           => 'nullable|string|max:150',
            'keterangan'         => 'nullable|string|max:300',
        ]);

        $dokumen = GuruDokumen::where('guru_id', $guruId)->findOrFail($dokumenId);

        $data = $request->only([
            'kategori', 'nama_dokumen', 'nomor_dokumen',
            'tanggal_dokumen', 'tanggal_berlaku', 'tanggal_kadaluarsa',
            'penerbit', 'keterangan',
        ]);

        // Ganti file jika ada upload baru
        if ($request->hasFile('dokumen')) {
            Storage::disk('public')->delete($dokumen->file_path);
            $file = $request->file('dokumen');
            $data['file_path'] = $file->store("dokumen_guru/{$guruId}", 'public');
            $data['file_type'] = strtolower($file->getClientOriginalExtension());
            $data['file_size'] = $file->getSize();
        }

        $dokumen->update($data);

        return back()->with('success', 'Dokumen berhasil diperbarui.');
    }

    // ==================== DESTROY ====================

    public function destroy($guruId, $dokumenId)
    {
        $dokumen = GuruDokumen::where('guru_id', $guruId)->findOrFail($dokumenId);

        Storage::disk('public')->delete($dokumen->file_path);
        $dokumen->delete();

        return response()->json(['success' => true, 'message' => 'Dokumen berhasil dihapus.']);
    }

    // ==================== VIEW / DOWNLOAD ====================

    public function view($guruId, $dokumenId)
    {
        $dokumen = GuruDokumen::where('guru_id', $guruId)->findOrFail($dokumenId);

        if (!Storage::disk('public')->exists($dokumen->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $safeNama = str_replace(['/', '\\'], '-', $dokumen->nama_dokumen);

        return Storage::disk('public')->response(
            $dokumen->file_path,
            $safeNama . '.' . $dokumen->file_type
        );
    }

    public function download($guruId, $dokumenId)
    {
        $dokumen = GuruDokumen::where('guru_id', $guruId)->findOrFail($dokumenId);

        if (!Storage::disk('public')->exists($dokumen->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $safeNama = str_replace(['/', '\\'], '-', $dokumen->nama_dokumen);

        return Storage::disk('public')->download(
            $dokumen->file_path,
            $safeNama . '.' . $dokumen->file_type
        );
    }

    // ==================== VERIFY ====================

    public function verify($guruId, $dokumenId)
    {
        $dokumen = GuruDokumen::where('guru_id', $guruId)->findOrFail($dokumenId);
        $dokumen->update(['is_verified' => !$dokumen->is_verified]);

        $status = $dokumen->is_verified ? 'diverifikasi' : 'dibatalkan verifikasinya';

        return response()->json([
            'success'     => true,
            'is_verified' => $dokumen->is_verified,
            'message'     => "Dokumen berhasil {$status}.",
        ]);
    }
}