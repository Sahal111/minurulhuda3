<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\GuruInpassing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruInpassingController extends Controller
{
    // ==================== INDEX ====================

    public function index($guruId)
    {
        $guru = Guru::with(['inpassings'])->findOrFail($guruId);

        $inpassings = $guru->inpassings->map(fn($ip) => $ip->append([
            'tanggal_sk_fmt',
            'tmt_inpassing_fmt',
            'jabatan_label',
            'golongan_label',
            'file_sk_url',
            'is_aktif',
        ]));

        return response()->json([
            'guru'      => $guru->only(['id', 'nama', 'nuptk', 'foto']),
            'inpassings'=> $inpassings,
            'total'     => $inpassings->count(),
            'aktif'     => $inpassings->where('status', 'aktif')->first(),
        ]);
    }

    // ==================== STORE ====================

    public function store(Request $request, $guruId)
    {
        $request->validate([
            'no_sk'              => 'required|string|max:100',
            'tanggal_sk'         => 'required|date',
            'tmt_inpassing'      => 'required|date',
            'golongan_sebelum'   => 'nullable|string|max:20',
            'golongan_sesudah'   => 'required|string|max:20',
            'jabatan_fungsional' => 'required|in:' . implode(',', array_keys(GuruInpassing::JABATAN_FUNGSIONAL)),
            'angka_kredit'       => 'nullable|string|max:20',
            'pejabat_penetap'    => 'nullable|string|max:150',
            'instansi_penetap'   => 'nullable|string|max:150',
            'file_sk'            => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'keterangan'         => 'nullable|string|max:500',
        ]);

        $guru = Guru::findOrFail($guruId);

        // Nonaktifkan inpassing lama sebelum simpan yang baru
        $guru->inpassings()->where('status', 'aktif')->update(['status' => 'nonaktif']);

        $data = $request->only([
            'no_sk', 'tanggal_sk', 'tmt_inpassing',
            'golongan_sebelum', 'golongan_sesudah', 'jabatan_fungsional',
            'angka_kredit', 'pejabat_penetap', 'instansi_penetap', 'keterangan',
        ]);
        $data['status'] = 'aktif';

        if ($request->hasFile('file_sk')) {
            $data['file_sk'] = $request->file('file_sk')
                ->store("inpassing_guru/{$guru->id}", 'public');
        }

        $guru->inpassings()->create($data);

        return back()->with('success', "Data inpassing \"{$request->no_sk}\" berhasil disimpan.");
    }

    // ==================== SET AKTIF ====================

    public function setAktif($guruId, $inpassingId)
    {
        $guru = Guru::findOrFail($guruId);

        // Nonaktifkan semua dulu
        $guru->inpassings()->update(['status' => 'nonaktif']);

        // Aktifkan yang dipilih
        $inpassing = GuruInpassing::where('guru_id', $guruId)->findOrFail($inpassingId);
        $inpassing->update(['status' => 'aktif']);

        return response()->json([
            'success' => true,
            'message' => "Inpassing {$inpassing->no_sk} ditetapkan sebagai aktif.",
        ]);
    }

    // ==================== DESTROY ====================

    public function destroy($guruId, $inpassingId)
    {
        $inpassing = GuruInpassing::where('guru_id', $guruId)->findOrFail($inpassingId);

        if ($inpassing->file_sk) {
            Storage::disk('public')->delete($inpassing->file_sk);
        }

        $wasAktif = $inpassing->status === 'aktif';
        $inpassing->delete();

        // Jika yang dihapus adalah yang aktif, otomatis aktifkan yang terbaru
        if ($wasAktif) {
            $latest = GuruInpassing::where('guru_id', $guruId)
                        ->latest('tmt_inpassing')
                        ->first();
            if ($latest) {
                $latest->update(['status' => 'aktif']);
            }
        }

        return response()->json(['success' => true, 'message' => 'Riwayat inpassing berhasil dihapus.']);
    }

    // ==================== VIEW SK ====================

    public function viewSK($guruId, $inpassingId)
    {
        $inpassing = GuruInpassing::where('guru_id', $guruId)->findOrFail($inpassingId);

        if (!$inpassing->file_sk || !Storage::disk('public')->exists($inpassing->file_sk)) {
            abort(404, 'File SK tidak ditemukan.');
        }

        $safeNoSk = str_replace(['/', '\\'], '-', $inpassing->no_sk);

        return Storage::disk('public')->response(
            $inpassing->file_sk,
            "SK-Inpassing-{$safeNoSk}." . pathinfo($inpassing->file_sk, PATHINFO_EXTENSION)
        );
    }
}
