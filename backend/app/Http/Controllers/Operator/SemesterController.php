<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::with('tahunAjaran')
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($s) {
                return [
                    'id'            => $s->id,
                    'tahun_ajaran'  => $s->tahunAjaran->tahun ?? '-',
                    'tahun_ajaran_id' => $s->tahun_ajaran_id,
                    'nama'          => $s->nama,
                    'start'         => $s->tgl_mulai?->format('Y-m-d'),
                    'end'           => $s->tgl_selesai?->format('Y-m-d'),
                    'is_active'     => $s->is_active,
                ];
            });

        $tahunAjarans = TahunAjaran::orderBy('id', 'desc')->get();

        return response()->json(compact('semesters', 'tahunAjarans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'nama'            => 'required|in:Ganjil,Genap',
            'tgl_mulai'       => 'nullable|date',
            'tgl_selesai'     => 'nullable|date',
            'is_active'       => 'boolean',
        ]);

        if ($validated['is_active'] ?? false) {
            $activeTa = TahunAjaran::where('is_active', true)->first();

            if (! $activeTa || $activeTa->id !== (int) $validated['tahun_ajaran_id']) {
                return response()->json([
                    'message' => 'Semester hanya bisa diaktifkan pada Tahun Ajaran yang sedang aktif.',
                ], 422);
            }

            Semester::where('tahun_ajaran_id', $validated['tahun_ajaran_id'])
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        Semester::create($validated);

        return response()->json(['message' => 'Semester berhasil ditambahkan.']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'nama'            => 'required|in:Ganjil,Genap',
            'tgl_mulai'       => 'nullable|date',
            'tgl_selesai'     => 'nullable|date',
            'is_active'       => 'boolean',
        ]);

        $semester = Semester::findOrFail($id);

        if (($validated['is_active'] ?? false) && !$semester->is_active) {
            $activeTa = TahunAjaran::where('is_active', true)->first();

            if (! $activeTa || $activeTa->id !== (int) $validated['tahun_ajaran_id']) {
                return response()->json([
                    'message' => 'Semester hanya bisa diaktifkan pada Tahun Ajaran yang sedang aktif.',
                ], 422);
            }

            Semester::where('tahun_ajaran_id', $validated['tahun_ajaran_id'])
                ->where('id', '!=', $semester->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        $semester->update($validated);

        return response()->json(['message' => 'Semester berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return response()->json(['message' => 'Semester berhasil dipindahkan ke Recycle Bin.']);
    }

    // ─── Recycle Bin ─────────────────────────────────────────────────────

    public function trash(Request $request)
    {
        $semesters = Semester::onlyTrashed()
            ->with('tahunAjaran')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return response()->json([
            'semesters' => [
                'data' => $semesters->map(function ($s) {
                    return [
                        'id'           => $s->id,
                        'nama'         => $s->nama,
                        'tahun_ajaran' => $s->tahunAjaran->tahun ?? '-',
                        'is_active'    => $s->is_active,
                        'deleted_at'   => $s->deleted_at->format('d M Y, H:i'),
                    ];
                }),
                'total'        => $semesters->total(),
                'current_page' => $semesters->currentPage(),
                'last_page'    => $semesters->lastPage(),
                'from'         => $semesters->firstItem(),
                'to'           => $semesters->lastItem(),
            ],
        ]);
    }

    public function restore($id)
    {
        $semester = Semester::onlyTrashed()->findOrFail($id);
        $semester->restore();

        return response()->json([
            'success' => true,
            'message' => "Semester {$semester->nama} berhasil dipulihkan.",
        ]);
    }

    public function forceDelete($id)
    {
        $semester = Semester::onlyTrashed()->findOrFail($id);
        $nama = $semester->nama;
        $semester->forceDelete();

        return response()->json([
            'success' => true,
            'message' => "Semester {$nama} dihapus permanen.",
        ]);
    }

    public function setActive($id)
    {
        $semester = Semester::findOrFail($id);

        $activeTa = TahunAjaran::where('is_active', true)->first();
        if (! $activeTa || $activeTa->id !== $semester->tahun_ajaran_id) {
            return response()->json([
                'message' => 'Semester hanya bisa diaktifkan pada Tahun Ajaran yang sedang aktif.',
            ], 422);
        }

        Semester::where('tahun_ajaran_id', $semester->tahun_ajaran_id)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        $semester->is_active = true;
        $semester->save();

        return response()->json(['message' => 'Semester berhasil diaktifkan.']);
    }
}
