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

        // Jika diset aktif, nonaktifkan semua semester lain dan sinkronkan tahun ajaran
        if ($validated['is_active'] ?? false) {
            Semester::where('is_active', true)->update(['is_active' => false]);
            
            // Sinkronisasi: Aktifkan Tahun Ajaran ini, nonaktifkan yg lain
            TahunAjaran::where('is_active', true)->update(['is_active' => false]);
            TahunAjaran::where('id', $validated['tahun_ajaran_id'])->update(['is_active' => true]);
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
            Semester::where('is_active', true)->update(['is_active' => false]);
            
            // Sinkronisasi: Aktifkan Tahun Ajaran ini, nonaktifkan yg lain
            TahunAjaran::where('is_active', true)->update(['is_active' => false]);
            TahunAjaran::where('id', $validated['tahun_ajaran_id'])->update(['is_active' => true]);
        }

        $semester->update($validated);

        return response()->json(['message' => 'Semester berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return response()->json(['message' => 'Semester berhasil dihapus.']);
    }

    public function setActive($id)
    {
        Semester::where('is_active', true)->update(['is_active' => false]);

        $semester = Semester::findOrFail($id);
        $semester->is_active = true;
        $semester->save();

        // Sinkronisasi: Aktifkan Tahun Ajaran dari semester ini, nonaktifkan yg lain
        TahunAjaran::where('is_active', true)->update(['is_active' => false]);
        if ($semester->tahun_ajaran_id) {
            TahunAjaran::where('id', $semester->tahun_ajaran_id)->update(['is_active' => true]);
        }

        return response()->json(['message' => 'Semester berhasil diaktifkan.']);
    }
}
