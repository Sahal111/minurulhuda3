<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\GuruDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruDiklatController extends Controller
{
    // ==================== INDEX (list diklat 1 guru, JSON) ====================

    public function index($guruId)
    {
        $guru = Guru::with(['diklats'])->findOrFail($guruId);

        $diklats = $guru->diklats->map(fn($d) => $d->append([
            'tanggal_mulai_fmt',
            'tanggal_selesai_fmt',
            'durasi_label',
            'jenis_label',
            'tingkat_label',
            'peran_label',
            'file_sertifikat_url',
        ]));

        $grouped = $diklats->groupBy('jenis_label');

        return response()->json([
            'guru'    => $guru->only(['id', 'nama', 'nuptk', 'foto']),
            'diklats' => $grouped,
            'total'   => $diklats->count(),
            'total_jp'=> $diklats->sum('jumlah_jam'),
        ]);
    }

    // ==================== STORE ====================

    public function store(Request $request, $guruId)
    {
        $request->validate([
            'nama_diklat'     => 'required|string|max:200',
            'jenis'           => 'required|in:' . implode(',', array_keys(GuruDiklat::JENIS)),
            'penyelenggara'   => 'nullable|string|max:150',
            'tingkat'         => 'nullable|in:' . implode(',', array_keys(GuruDiklat::TINGKAT)),
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jumlah_jam'      => 'nullable|integer|min:1|max:9999',
            'no_sertifikat'   => 'nullable|string|max:100',
            'peran'           => 'nullable|in:' . implode(',', array_keys(GuruDiklat::PERAN)),
            'file_sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'keterangan'      => 'nullable|string|max:500',
        ]);

        $guru = Guru::findOrFail($guruId);

        $data = $request->only([
            'nama_diklat', 'jenis', 'penyelenggara', 'tingkat',
            'tanggal_mulai', 'tanggal_selesai', 'jumlah_jam',
            'no_sertifikat', 'peran', 'keterangan',
        ]);

        if ($request->hasFile('file_sertifikat')) {
            $data['file_sertifikat'] = $request->file('file_sertifikat')
                ->store("diklat_guru/{$guru->id}", 'public');
        }

        $guru->diklats()->create($data);

        return back()->with('success', "Riwayat diklat \"{$request->nama_diklat}\" berhasil disimpan.");
    }

    // ==================== UPDATE ====================

    public function update(Request $request, $guruId, $diklatId)
    {
        $request->validate([
            'nama_diklat'     => 'required|string|max:200',
            'jenis'           => 'required|in:' . implode(',', array_keys(GuruDiklat::JENIS)),
            'penyelenggara'   => 'nullable|string|max:150',
            'tingkat'         => 'nullable|in:' . implode(',', array_keys(GuruDiklat::TINGKAT)),
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jumlah_jam'      => 'nullable|integer|min:1|max:9999',
            'no_sertifikat'   => 'nullable|string|max:100',
            'peran'           => 'nullable|in:' . implode(',', array_keys(GuruDiklat::PERAN)),
            'file_sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'keterangan'      => 'nullable|string|max:500',
        ]);

        $diklat = GuruDiklat::where('guru_id', $guruId)->findOrFail($diklatId);

        $data = $request->only([
            'nama_diklat', 'jenis', 'penyelenggara', 'tingkat',
            'tanggal_mulai', 'tanggal_selesai', 'jumlah_jam',
            'no_sertifikat', 'peran', 'keterangan',
        ]);

        if ($request->hasFile('file_sertifikat')) {
            if ($diklat->file_sertifikat) {
                Storage::disk('public')->delete($diklat->file_sertifikat);
            }
            $data['file_sertifikat'] = $request->file('file_sertifikat')
                ->store("diklat_guru/{$guruId}", 'public');
        }

        $diklat->update($data);

        return back()->with('success', 'Riwayat diklat berhasil diperbarui.');
    }

    // ==================== DESTROY ====================

    public function destroy($guruId, $diklatId)
    {
        $diklat = GuruDiklat::where('guru_id', $guruId)->findOrFail($diklatId);

        if ($diklat->file_sertifikat) {
            Storage::disk('public')->delete($diklat->file_sertifikat);
        }

        $diklat->delete();

        return response()->json(['success' => true, 'message' => 'Riwayat diklat berhasil dihapus.']);
    }

    // ==================== VIEW SERTIFIKAT ====================

    public function viewSertifikat($guruId, $diklatId)
    {
        $diklat = GuruDiklat::where('guru_id', $guruId)->findOrFail($diklatId);

        if (!$diklat->file_sertifikat || !Storage::disk('public')->exists($diklat->file_sertifikat)) {
            abort(404, 'File sertifikat tidak ditemukan.');
        }

        $safeNama = str_replace(['/', '\\'], '-', $diklat->nama_diklat);

        return Storage::disk('public')->response(
            $diklat->file_sertifikat,
            $safeNama . '.' . pathinfo($diklat->file_sertifikat, PATHINFO_EXTENSION)
        );
    }
}