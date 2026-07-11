<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Services\RiwayatKelasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunAjaranController extends Controller
{
    public function __construct(private RiwayatKelasService $riwayatKelasService) {}

    public function index()
    {
        $tahunAjarans = TahunAjaran::with('semesters')
            ->orderBy('id', 'desc')
            ->get();

        $arsipData = TahunAjaran::where('is_active', false)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($item) {
                $item->jumlah_siswa = DB::table('siswas')->count();
                $item->kelulusan = 100;

                return $item;
            });

        return response()->json(compact('tahunAjarans', 'arsipData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $tahunAjaran = TahunAjaran::create($validated);

        if ($validated['is_active'] ?? false) {
            TahunAjaran::where('is_active', true)
                ->where('id', '!=', $tahunAjaran->id)
                ->update(['is_active' => false]);

            Semester::where('is_active', true)
                ->where('tahun_ajaran_id', '!=', $tahunAjaran->id)
                ->update(['is_active' => false]);
        }

        return response()->json(['message' => 'Tahun ajaran berhasil ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tahun' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $tahunAjaran = TahunAjaran::findOrFail($id);

        if (($validated['is_active'] ?? false) && ! $tahunAjaran->is_active) {
            TahunAjaran::where('is_active', true)->update(['is_active' => false]);

            Semester::where('tahun_ajaran_id', '!=', $id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        if (! ($validated['is_active'] ?? true) && $tahunAjaran->is_active) {
            Semester::where('tahun_ajaran_id', $id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        $tahunAjaran->update($validated);

        return response()->json(['message' => 'Tahun ajaran berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->delete();

        return response()->json(['message' => 'Tahun ajaran berhasil dihapus dan dipindahkan ke Recycle Bin.']);
    }

    public function archive($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->is_active = false;
        $tahunAjaran->save();

        Semester::where('tahun_ajaran_id', $id)
            ->update(['is_active' => false]);

        return response()->json(['message' => 'Tahun ajaran berhasil diarsipkan']);
    }

    // ─── Recycle Bin ─────────────────────────────────────────────────────

    public function trash(Request $request)
    {
        $tahunAjarans = TahunAjaran::onlyTrashed()
            ->with('semesters')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return response()->json([
            'tahun_ajarans' => [
                'data' => $tahunAjarans->map(function ($ta) {
                    return [
                        'id' => $ta->id,
                        'tahun' => $ta->tahun,
                        'is_active' => $ta->is_active,
                        'semesters' => $ta->semesters->map(fn ($s) => [
                            'id' => $s->id,
                            'nama' => $s->nama,
                        ]),
                        'deleted_at' => $ta->deleted_at->format('d M Y, H:i'),
                    ];
                }),
                'total' => $tahunAjarans->total(),
                'current_page' => $tahunAjarans->currentPage(),
                'last_page' => $tahunAjarans->lastPage(),
                'from' => $tahunAjarans->firstItem(),
                'to' => $tahunAjarans->lastItem(),
            ],
        ]);
    }

    public function restore($id)
    {
        $tahunAjaran = TahunAjaran::onlyTrashed()->findOrFail($id);
        $tahunAjaran->restore();

        return response()->json([
            'success' => true,
            'message' => "Tahun ajaran {$tahunAjaran->tahun} berhasil dipulihkan.",
        ]);
    }

    public function forceDelete($id)
    {
        $tahunAjaran = TahunAjaran::onlyTrashed()->findOrFail($id);
        $nama = $tahunAjaran->tahun;
        $tahunAjaran->forceDelete();

        return response()->json([
            'success' => true,
            'message' => "Tahun ajaran {$nama} dihapus permanen.",
        ]);
    }

    public function kenaikanKelas()
    {
        $activeTahun = TahunAjaran::where('is_active', true)->first();
        if (! $activeTahun) {
            return response()->json(['success' => false, 'message' => 'Silahkan aktifkan Tahun Ajaran terlebih dahulu.'], 422);
        }

        $siswas = Siswa::with('kelas')
            ->whereHas('kelas', function ($q) use ($activeTahun) {
                $q->where('tahun_ajaran_id', $activeTahun->id);
            })
            ->where('status', 'aktif')
            ->get()
            ->map(function ($s) {
                return [
                    'id' => $s->id,
                    'nama' => $s->nama,
                    'nis' => $s->nis,
                    'tingkat' => (int) ($s->kelas->tingkat ?? $s->tingkat ?? 1),
                    'rombelAsal' => $s->kelas
                        ? $s->kelas->tingkat.$s->kelas->nama_kelas
                        : '-',
                    'status' => 'belum',
                    'tingkatTujuan' => '',
                    'rombelTujuan' => '',
                    'rombel_id' => $s->kelas_id,
                ];
            });

        $rombels = Kelas::with('tahunAjaran')->get()->map(function ($r) {
            return [
                'id' => $r->id,
                'nama' => $r->tingkat.$r->nama_kelas,
                'tingkat' => (int) $r->tingkat,
                'tahun_ajaran_id' => $r->tahun_ajaran_id,
            ];
        });

        $tahunAjarans = TahunAjaran::orderBy('id', 'desc')->get();

        return view('operator.kenaikanKelas', compact(
            'siswas',
            'rombels',
            'activeTahun',
            'tahunAjarans'
        ));
    }

    public function promoteSiswa(Request $request)
    {
        $request->validate([
            'siswa' => 'required|array',
            'ta_tujuan_id' => 'required|exists:tahun_ajarans,id',
        ]);

        DB::beginTransaction();
        try {
            $tanggalProses = now();
            $tahunAjaranTujuan = TahunAjaran::findOrFail($request->ta_tujuan_id);
            $semesterTujuan = $this->riwayatKelasService->activeSemesterName($tahunAjaranTujuan->id);

            foreach ($request->siswa as $sData) {
                $siswa = Siswa::find($sData['id']);
                if (! $siswa) {
                    continue;
                }

                if (in_array($sData['status'], ['naik', 'tinggal'])) {
                    $rombelId = $sData['rombelTujuan'];

                    if (! $rombelId || $rombelId === '-') {
                        continue;
                    }

                    $kelas = Kelas::find($rombelId);
                    if (! $kelas) {
                        continue;
                    }

                    $jenisPerubahan = $sData['status'] === 'naik' ? 'naik_kelas' : 'turun_kelas';
                    $this->riwayatKelasService->recordPromotion(
                        $siswa,
                        $kelas,
                        $jenisPerubahan,
                        $tahunAjaranTujuan->id,
                        $tanggalProses
                    );

                    $siswa->update([
                        'tingkat' => $kelas->tingkat,
                        'kelas_id' => $kelas->id,
                        'tahun_ajaran_id' => $tahunAjaranTujuan->id,
                        'status' => 'aktif',
                    ]);
                } elseif ($sData['status'] === 'lulus') {
                    $this->riwayatKelasService->recordTerminalEvent(
                        $siswa,
                        'lulus',
                        $tanggalProses,
                        $tahunAjaranTujuan->id,
                        $semesterTujuan,
                        'Proses kelulusan tahunan'
                    );

                    $siswa->update([
                        'status' => 'lulus',
                        'kelas_id' => null,
                        'tahun_ajaran_id' => $tahunAjaranTujuan->id,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Proses kenaikan kelas berhasil.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: '.$e->getMessage(),
            ], 500);
        }
    }
}
