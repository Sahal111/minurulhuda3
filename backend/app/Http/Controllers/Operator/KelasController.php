<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\TahunAjaran;
use App\Models\Siswa;
use App\Services\RiwayatKelasService;


class KelasController extends Controller
{
    public function __construct(private RiwayatKelasService $riwayatKelasService)
    {
    }

    public function index()
    {
        $kelas = Kelas::with(['waliKelas', 'siswas', 'tahunAjaran'])->get();

        $guru = Guru::all();
        $tahunAjaran = TahunAjaran::all();

        return response()->json(compact('kelas', 'guru', 'tahunAjaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'tingkat' => 'required',
            'wali_kelas_id' => 'nullable',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'kapasitas' => 'nullable|integer',
            'parent_meeting_at' => 'nullable|date',
        ]);

        if ($request->wali_kelas_id) {
            $exists = Kelas::where('tahun_ajaran_id', $request->tahun_ajaran_id)
                ->where('wali_kelas_id', $request->wali_kelas_id)
                ->exists();
            if ($exists) {
            return response()->json(['success' => false, 'message' => 'Guru tersebut sudah menjadi wali kelas di kelas lain pada tahun ajaran ini.', 'errors' => ['wali_kelas_id' => 'Guru tersebut sudah menjadi wali kelas di kelas lain pada tahun ajaran ini.']], 422);
            }
        }

        $tahun = TahunAjaran::find($request->tahun_ajaran_id);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'wali_kelas_id' => $request->wali_kelas_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'tahun_ajaran' => $tahun->nama, // Fill string for compatibility
            'kapasitas' => $request->kapasitas ?? 32,
            'parent_meeting_at' => $request->parent_meeting_at,
        ]);

        return response()->json(['success' => true, 'message' => 'Kelas berhasil ditambahkan'], 201);
    }

    public function getSiswa($id)
    {
        $kelas = Kelas::with('siswas')->findOrFail($id);

        return response()->json($kelas->siswas);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'tingkat' => 'required',
            'wali_kelas_id' => 'nullable',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'kapasitas' => 'nullable|integer',
            'parent_meeting_at' => 'nullable|date',
        ]);

        if ($request->wali_kelas_id) {
            $exists = Kelas::where('tahun_ajaran_id', $request->tahun_ajaran_id)
                ->where('wali_kelas_id', $request->wali_kelas_id)
                ->where('id', '!=', $id)
                ->exists();
            if ($exists) {
            return response()->json(['success' => false, 'message' => 'Guru tersebut sudah menjadi wali kelas di kelas lain pada tahun ajaran ini.', 'errors' => ['wali_kelas_id' => 'Guru tersebut sudah menjadi wali kelas di kelas lain pada tahun ajaran ini.']], 422);
            }
        }

        $kelas = Kelas::findOrFail($id);
        $tahun = TahunAjaran::find($request->tahun_ajaran_id);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'wali_kelas_id' => $request->wali_kelas_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'tahun_ajaran' => $tahun->nama,
            'kapasitas' => $request->kapasitas ?? 32,
            'parent_meeting_at' => $request->parent_meeting_at,
        ]);

        return response()->json(['success' => true, 'message' => 'Kelas berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return response()->json(['success' => true, 'message' => 'Kelas berhasil dihapus']);
    }

    public function penempatan()
    {
        $activeTahun = TahunAjaran::where('is_active', true)->first();
        if (!$activeTahun) {
            return response()->json(['success' => false, 'message' => 'Silahkan aktifkan Tahun Ajaran terlebih dahulu.'], 422);
        }

        // KelasController::penempatan()
        $siswas = \App\Models\Siswa::with('kelas')->get()->map(function ($s) use ($activeTahun) {
            $isSameYear = $s->kelas && $s->kelas->tahun_ajaran_id == $activeTahun->id;

            // Ambil tingkat dari kelas aktif, atau fallback ke field tingkat siswa
            $tingkat = $isSameYear ? (int) $s->kelas->tingkat : (int) $s->tingkat;

            return [
                'id' => $s->id,
                'nis' => $s->nis,
                'nama' => $s->nama,
                'jk' => $s->jenis_kelamin,
                'status' => $isSameYear ? 'sudah' : 'belum',
                'rombel_id' => $isSameYear ? $s->kelas_id : null,
                'tingkat' => $tingkat ?: 1, // default 1 jika null
            ];
        });

        // KelasController::penempatan()
        $rombels = Kelas::with('waliKelas')
            ->where('tahun_ajaran_id', $activeTahun->id)
            ->get()->map(function ($r) {
                return [
                    'id' => $r->id,
                    'nama' => $r->tingkat . $r->nama_kelas,
                    'tingkat' => (int) $r->tingkat, // ← cast ke integer
                    'wali' => $r->waliKelas->nama ?? 'Belum Diatur',
                    'kapasitas' => $r->kapasitas,
                    'terisi' => $r->siswas->count(),
                ];
            });

        return response()->json(compact('siswas', 'rombels', 'activeTahun'));
    }

    public function updatePenempatan(Request $request)
    {
        $request->validate([
            'siswa_ids' => 'required|array',
            'kelas_id' => 'nullable',
        ]);

        $kelas = $request->kelas_id ? Kelas::find($request->kelas_id) : null;

        Siswa::whereIn('id', $request->siswa_ids)->get()->each(function (Siswa $siswa) use ($kelas, $request) {
            $updateData = ['kelas_id' => $request->kelas_id];

            if ($kelas) {
                if ((int) $siswa->kelas_id !== (int) $kelas->id) {
                    $this->riwayatKelasService->recordClassMove(
                        $siswa,
                        $kelas,
                        $kelas->tahun_ajaran_id,
                        now(),
                        'Perpindahan kelas via penempatan siswa'
                    );
                }

                $updateData['tingkat'] = $kelas->tingkat;
                $updateData['tahun_ajaran_id'] = $kelas->tahun_ajaran_id;
            } elseif ($siswa->kelas_id) {
                $this->riwayatKelasService->closeLatestOpenHistory($siswa, now());
            }

            $siswa->update($updateData);
        });

        return response()->json(['success' => true, 'message' => 'Penempatan siswa berhasil diperbarui.']);
    }
}
