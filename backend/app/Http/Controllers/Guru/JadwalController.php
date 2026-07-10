<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $guru = $request->user()->guru;

        $query = Jadwal::with(['kelas', 'mapel'])
            ->where('guru_id', $guru->id)
            ->orderByRaw("FIELD(hari, 'senin','selasa','rabu','kamis','jumat','sabtu')")
            ->orderBy('jam_mulai');

        if ($request->hari) {
            $query->where('hari', strtolower($request->hari));
        }

        return response()->json($query->get());
    }
}