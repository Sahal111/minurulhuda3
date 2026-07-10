<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\PlotGuruMapel;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Daftar nilai berdasarkan plot mengajar guru
     * GET /api/guru/nilai?kelas_id=&semester_id=
     */
    public function index(Request $request)
    {
        $guru = $request->user()->guru;

        $query = Nilai::with(['siswa', 'plotGuruMapel.mapel', 'komponenPenilaian'])
            ->whereHas('plotGuruMapel', fn($q) => $q->where('guru_id', $guru->id));

        if ($request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }

        if ($request->semester_id) {
            $query->whereHas('plotGuruMapel', fn($q) => $q->where('semester_id', $request->semester_id));
        }

        return response()->json($query->get());
    }

    /**
     * Simpan/update nilai satu siswa
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'plot_guru_mapel_id' => 'required|exists:plot_guru_mapels,id',
            'komponen_penilaian_id' => 'nullable|exists:komponen_penilaians,id',
            'nilai' => 'required|numeric|min:0|max:100',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
        ]);

        $guru = $request->user()->guru;

        // Pastikan plot ini milik guru yang login
        $plot = PlotGuruMapel::where('id', $request->plot_guru_mapel_id)
            ->where('guru_id', $guru->id)
            ->firstOrFail();

        $nilai = Nilai::updateOrCreate(
            [
                'siswa_id' => $request->siswa_id,
                'plot_guru_mapel_id' => $plot->id,
                'komponen_penilaian_id' => $request->komponen_penilaian_id,
            ],
            [
                'nilai' => $request->nilai,
                'kelas_id' => $request->kelas_id,
                'tahun_ajaran_id' => $request->tahun_ajaran_id,
                'created_by' => $request->user()->id,
                'updated_by' => $request->user()->id,
            ]
        );

        return response()->json([
            'message' => 'Nilai berhasil disimpan.',
            'data' => $nilai,
        ]);
    }

    /**
     * Rekap nilai per kelas dan mapel yang diajar guru ini
     * GET /api/guru/nilai/rekap?kelas_id=&semester_id=
     */
    public function rekap(Request $request)
    {
        $request->validate(['kelas_id' => 'required|exists:kelas,id']);

        $guru = $request->user()->guru;

        $siswas = Siswa::where('kelas_id', $request->kelas_id)
            ->where('status', 'aktif')
            ->with([
                'nilais' => function ($q) use ($guru, $request) {
                    $q->whereHas('plotGuruMapel', fn($pq) => $pq->where('guru_id', $guru->id));
                    if ($request->semester_id) {
                        $q->whereHas('plotGuruMapel', fn($pq) => $pq->where('semester_id', $request->semester_id));
                    }
                },
                'nilais.plotGuruMapel.mapel'
            ])
            ->get()
            ->map(fn($siswa) => [
                'siswa_id' => $siswa->id,
                'nama' => $siswa->nama,
                'nisn' => $siswa->nisn,
                'nilai_list' => $siswa->nilais->map(fn($n) => [
                    'mapel' => $n->plotGuruMapel?->mapel?->nama_mapel,
                    'nilai' => $n->nilai,
                ]),
                'rata_rata' => $siswa->nilais->avg('nilai'),
            ]);

        return response()->json($siswas);
    }
}