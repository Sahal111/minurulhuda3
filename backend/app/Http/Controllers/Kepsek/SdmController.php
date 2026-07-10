<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class SdmController extends Controller
{
    /**
     * Daftar semua guru (read-only untuk kepsek)
     * GET /api/kepsek/sdm/guru
     */
    public function index(Request $request)
    {
        $query = Guru::with(['currentJabatan', 'pendidikans', 'kelasWali'])
            ->where('status_aktif', true);

        if ($request->q) {
            $query->search($request->q);
        }

        $gurus = $query->orderBy('nama')->get()->map(fn($g) => [
            'id' => $g->id,
            'nama' => $g->nama,
            'nuptk' => $g->nuptk,
            'nip' => $g->nip,
            'jabatan' => $g->jabatan,
            'status_kepegawaian' => $g->status_kepegawaian,
            'pendidikan' => $g->pendidikan,
            'masa_bakti' => $g->masa_bakti,
            'mapel' => $g->mapel,
            'wali_kelas' => $g->kelasWali?->nama_kelas,
            'foto' => $g->foto ? asset('storage/' . $g->foto) : null,
        ]);

        return response()->json($gurus);
    }

    /**
     * Detail satu guru
     * GET /api/kepsek/sdm/guru/{id}
     */
    public function show($id)
    {
        $guru = Guru::with([
            'currentJabatan',
            'jabatans',
            'pendidikans',
            'sertifikasis',
            'diklats',
            'inpassings',
            'kelasWali',
        ])->findOrFail($id);

        return response()->json($guru);
    }
}