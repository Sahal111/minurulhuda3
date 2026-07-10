<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\CatatanWali;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;

class WaliKelasController extends Controller
{
    /**
     * Helper: ambil wali kelas aktif milik guru yang login
     */
    private function getWaliKelasAktif(Request $request): ?WaliKelas
    {
        $guru = $request->user()->guru;

        return WaliKelas::with(['kelas', 'tahunAjaran', 'semester'])
            ->where('guru_id', $guru->id)
            ->where('is_active', true)
            ->first();
    }

    /**
     * Info kelas yang diwali guru ini
     * GET /api/guru/wali-kelas
     */
    public function info(Request $request)
    {
        $wali = $this->getWaliKelasAktif($request);

        if (!$wali) {
            return response()->json(['message' => 'Anda bukan wali kelas aktif.'], 403);
        }

        return response()->json([
            'kelas_id' => $wali->kelas_id,
            'nama_kelas' => $wali->kelas?->nama_kelas,
            'tahun_ajaran' => $wali->tahunAjaran?->tahun,
            'semester' => $wali->semester?->nama,
        ]);
    }

    /**
     * Daftar siswa di kelas yang diwali
     * GET /api/guru/wali-kelas/siswa
     */
    public function dataSiswa(Request $request)
    {
        $wali = $this->getWaliKelasAktif($request);

        if (!$wali) {
            return response()->json(['message' => 'Anda bukan wali kelas aktif.'], 403);
        }

        $siswas = Siswa::with(['orangTuas'])
            ->where('kelas_id', $wali->kelas_id)
            ->where('status', 'aktif')
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
     * Daftar catatan wali untuk siswa di kelasnya
     * GET /api/guru/wali-kelas/catatan
     */
    public function catatanIndex(Request $request)
    {
        $wali = $this->getWaliKelasAktif($request);

        if (!$wali) {
            return response()->json(['message' => 'Anda bukan wali kelas aktif.'], 403);
        }

        $catatan = CatatanWali::with('siswa')
            ->whereHas('siswa', fn($q) => $q->where('kelas_id', $wali->kelas_id))
            ->when($request->siswa_id, fn($q) => $q->where('siswa_id', $request->siswa_id))
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($catatan);
    }

    /**
     * Tambah catatan wali
     * POST /api/guru/wali-kelas/catatan
     */
    public function catatanStore(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'catatan' => 'required|string',
            'tanggal' => 'nullable|date',
        ]);

        $wali = $this->getWaliKelasAktif($request);

        if (!$wali) {
            return response()->json(['message' => 'Anda bukan wali kelas aktif.'], 403);
        }

        // Pastikan siswa memang di kelas yang diwali
        $siswaValid = Siswa::where('id', $request->siswa_id)
            ->where('kelas_id', $wali->kelas_id)
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

        return response()->json([
            'message' => 'Catatan berhasil ditambahkan.',
            'data' => $catatan,
        ], 201);
    }
}