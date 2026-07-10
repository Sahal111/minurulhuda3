<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $guru = $request->user()->guru;
        $kelasId = $request->query('kelas_id');
        $tanggal = $request->query('tanggal', now()->toDateString());

        $query = Absensi::with(['siswa', 'kelas'])
            ->where('guru_id', $guru->id)
            ->whereDate('tanggal', $tanggal);

        if ($kelasId) {
            $query->where('kelas_id', $kelasId);
        }

        return response()->json($query->orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
            'data' => 'required|array|min:1',
            'data.*.siswa_id' => 'required|exists:siswas,id',
            'data.*.status' => 'required|in:hadir,izin,sakit,alpha',
            'data.*.keterangan' => 'nullable|string|max:255',
        ]);

        $guru = $request->user()->guru;
        $tahunAjaran = TahunAjaran::where('is_active', true)->first();

        foreach ($request->data as $item) {
            Absensi::updateOrCreate(
                [
                    'siswa_id' => $item['siswa_id'],
                    'kelas_id' => $request->kelas_id,
                    'tanggal' => $request->tanggal,
                ],
                [
                    'guru_id' => $guru->id,
                    'status' => $item['status'],
                    'keterangan' => $item['keterangan'] ?? null,
                    'tahun_ajaran_id' => $tahunAjaran?->id,
                    'created_by' => $request->user()->id,
                    'updated_by' => $request->user()->id,
                ]
            );
        }

        return response()->json(['message' => 'Absensi berhasil disimpan.']);
    }

    public function rekap(Request $request)
    {
        $request->validate(['kelas_id' => 'required|exists:kelas,id']);

        $bulan = $request->query('bulan', now()->month);
        $tahun = $request->query('tahun', now()->year);

        $siswas = Siswa::where('kelas_id', $request->kelas_id)
            ->where('status', 'aktif')
            ->with([
                'absensis' => function ($q) use ($bulan, $tahun) {
                    $q->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
                }
            ])
            ->get()
            ->map(fn($siswa) => [
                'siswa_id' => $siswa->id,
                'nama' => $siswa->nama,
                'nisn' => $siswa->nisn,
                'hadir' => $siswa->absensis->where('status', 'hadir')->count(),
                'izin' => $siswa->absensis->where('status', 'izin')->count(),
                'sakit' => $siswa->absensis->where('status', 'sakit')->count(),
                'alpha' => $siswa->absensis->where('status', 'alpha')->count(),
                'total_hari' => $siswa->absensis->count(),
            ]);

        return response()->json($siswas);
    }
}