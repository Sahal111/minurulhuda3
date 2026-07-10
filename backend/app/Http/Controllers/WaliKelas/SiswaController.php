<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\CatatanWali;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    private function getKelasId(Request $request): ?int
    {
        $guru = $request->user()->guru;
        if (!$guru)
            return null;

        $wali = WaliKelas::where('guru_id', $guru->id)
            ->where('is_active', true)
            ->first();

        return $wali?->kelas_id;
    }

    /**
     * GET /api/wali-kelas/siswa
     */
    public function index(Request $request)
    {
        $kelasId = $this->getKelasId($request);

        if (!$kelasId) {
            return response()->json(['message' => 'Anda tidak terdaftar sebagai wali kelas aktif.'], 403);
        }

        $siswas = Siswa::with(['orangTuas'])
            ->where('kelas_id', $kelasId)
            ->where('status', 'aktif')
            ->when($request->search, fn($q) => $q->where('nama', 'like', '%' . $request->search . '%'))
            ->orderBy('nama')
            ->get()
            ->map(fn($s) => [
                'id' => $s->id,
                'nama' => $s->nama,
                'nisn' => $s->nisn,
                'nis' => $s->nis,
                'jenis_kelamin' => $s->jenis_kelamin,
                'foto' => $s->foto ? asset('storage/' . $s->foto) : null,
                'orang_tua' => $s->orangTuas->first()?->only(['nama_ayah', 'nama_ibu', 'no_hp']),
            ]);

        return response()->json($siswas);
    }

    /**
     * GET /api/wali-kelas/siswa/{id}/absensi
     */
    public function absensi(Request $request, $siswaId)
    {
        $kelasId = $this->getKelasId($request);
        if (!$kelasId)
            return response()->json(['message' => 'Akses ditolak.'], 403);

        $siswa = Siswa::where('id', $siswaId)->where('kelas_id', $kelasId)->firstOrFail();

        $absensi = Absensi::where('siswa_id', $siswaId)
            ->when($request->bulan, fn($q) => $q->whereMonth('tanggal', $request->bulan))
            ->when($request->tahun, fn($q) => $q->whereYear('tanggal', $request->tahun))
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json(['siswa' => $siswa->only(['id', 'nama', 'nisn']), 'absensi' => $absensi]);
    }

    /**
     * GET /api/wali-kelas/siswa/{id}/nilai
     */
    public function nilai(Request $request, $siswaId)
    {
        $kelasId = $this->getKelasId($request);
        if (!$kelasId)
            return response()->json(['message' => 'Akses ditolak.'], 403);

        $siswa = Siswa::where('id', $siswaId)->where('kelas_id', $kelasId)->firstOrFail();

        $nilais = Nilai::with(['plotGuruMapel.mapel', 'komponenPenilaian'])
            ->where('siswa_id', $siswaId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['siswa' => $siswa->only(['id', 'nama', 'nisn']), 'nilai' => $nilais]);
    }

    /**
     * GET /api/wali-kelas/catatan
     */
    public function catatanIndex(Request $request)
    {
        $kelasId = $this->getKelasId($request);
        if (!$kelasId)
            return response()->json(['message' => 'Akses ditolak.'], 403);

        $catatan = CatatanWali::with('siswa')
            ->whereHas('siswa', fn($q) => $q->where('kelas_id', $kelasId))
            ->when($request->siswa_id, fn($q) => $q->where('siswa_id', $request->siswa_id))
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($catatan);
    }

    /**
     * POST /api/wali-kelas/catatan
     */
    public function catatanStore(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'catatan' => 'required|string',
            'tanggal' => 'nullable|date',
        ]);

        $kelasId = $this->getKelasId($request);
        if (!$kelasId)
            return response()->json(['message' => 'Akses ditolak.'], 403);

        $siswaValid = Siswa::where('id', $request->siswa_id)
            ->where('kelas_id', $kelasId)
            ->exists();

        if (!$siswaValid) {
            return response()->json(['message' => 'Siswa tidak ditemukan di kelas Anda.'], 422);
        }

        $catatan = CatatanWali::create([
            'siswa_id' => $request->siswa_id,
            'catatan' => $request->catatan,
            'tanggal' => $request->tanggal ?? now()->toDateString(),
            'created_by' => $request->user()->id,
        ]);

        return response()->json(['message' => 'Catatan berhasil ditambahkan.', 'data' => $catatan], 201);
    }
}