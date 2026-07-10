<?php

namespace App\Services;

use App\Models\Kelas;
use App\Models\RiwayatKelas;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

class RiwayatKelasService
{
    public const TERMINAL_TYPES = ['mutasi_keluar', 'lulus', 'nonaktif'];

    public function recordClassMove(
        Siswa $siswa,
        Kelas $kelas,
        ?int $tahunAjaranId,
        CarbonInterface|string|null $tanggal = null,
        ?string $catatan = null
    ): RiwayatKelas {
        $tanggal = $this->dateString($tanggal);

        $this->closeLatestOpenHistory($siswa, $tanggal);

        return RiwayatKelas::create([
            'siswa_id' => $siswa->id,
            'kelas_id' => $kelas->id,
            'tahun_ajaran_id' => $tahunAjaranId,
            'semester' => $this->activeSemesterName($tahunAjaranId),
            'nama_kelas_snapshot' => $this->kelasSnapshot($kelas),
            'tanggal_masuk' => $tanggal,
            'tanggal_keluar' => null,
            'jenis_perubahan' => 'pindah_kelas',
            'catatan' => $catatan ?? 'Perpindahan kelas via edit data',
        ]);
    }

    public function recordReactivation(
        Siswa $siswa,
        Kelas $kelas,
        ?int $tahunAjaranId,
        string $semester,
        CarbonInterface|string|null $tanggalMasuk,
        string $oldStatus
    ): RiwayatKelas {
        $tanggalMasuk = $this->dateString($tanggalMasuk);

        $this->closeLatestOpenHistory($siswa, $tanggalMasuk);

        return RiwayatKelas::create([
            'siswa_id' => $siswa->id,
            'kelas_id' => $kelas->id,
            'tahun_ajaran_id' => $tahunAjaranId,
            'semester' => $semester,
            'nama_kelas_snapshot' => $this->kelasSnapshot($kelas),
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_keluar' => null,
            'jenis_perubahan' => 'masuk_kembali',
            'catatan' => 'Siswa aktif kembali dari status ' . $oldStatus,
        ]);
    }

    public function recordTerminalEvent(
        Siswa $siswa,
        string $jenisPerubahan,
        CarbonInterface|string|null $tanggal,
        ?int $tahunAjaranId,
        ?string $semester,
        ?string $catatan = null
    ): RiwayatKelas {
        $tanggal = $this->dateString($tanggal);

        $this->closeLatestOpenHistory($siswa, $tanggal);

        return RiwayatKelas::create([
            'siswa_id' => $siswa->id,
            'kelas_id' => null,
            'tahun_ajaran_id' => $tahunAjaranId,
            'semester' => $semester ?? $this->activeSemesterName($tahunAjaranId),
            'nama_kelas_snapshot' => $this->terminalSnapshot($jenisPerubahan),
            'tanggal_masuk' => $tanggal,
            'tanggal_keluar' => $tanggal,
            'jenis_perubahan' => $jenisPerubahan,
            'catatan' => $catatan,
        ]);
    }

    public function recordPromotion(
        Siswa $siswa,
        Kelas $kelas,
        string $jenisPerubahan,
        ?int $tahunAjaranId,
        CarbonInterface|string|null $tanggal = null
    ): RiwayatKelas {
        $tanggal = $this->dateString($tanggal);

        $this->closeLatestOpenHistory($siswa, $tanggal);

        return RiwayatKelas::create([
            'siswa_id' => $siswa->id,
            'kelas_id' => $kelas->id,
            'tahun_ajaran_id' => $tahunAjaranId,
            'semester' => $this->activeSemesterName($tahunAjaranId),
            'nama_kelas_snapshot' => $this->kelasSnapshot($kelas),
            'tanggal_masuk' => $tanggal,
            'tanggal_keluar' => null,
            'jenis_perubahan' => $jenisPerubahan,
            'catatan' => $jenisPerubahan === 'naik_kelas'
                ? 'Proses kenaikan kelas tahunan'
                : 'Proses tinggal kelas tahunan',
        ]);
    }

    public function normalizeExistingHistories(?array $siswaIds = null, bool $dryRun = true): array
    {
        $summary = [
            'checked_students' => 0,
            'updated_rows' => 0,
            'terminal_rows_fixed' => 0,
            'interval_rows_fixed' => 0,
            'snapshot_rows_fixed' => 0,
            'audit' => [],
        ];

        Siswa::query()
            ->when($siswaIds, fn ($query) => $query->whereIn('id', $siswaIds))
            ->with(['riwayatKelas' => fn ($query) => $query
                ->orderByRaw('COALESCE(tanggal_masuk, DATE(created_at)) asc')
                ->orderBy('id')])
            ->chunkById(100, function (Collection $siswas) use (&$summary, $dryRun) {
                foreach ($siswas as $siswa) {
                    $summary['checked_students']++;
                    $histories = $siswa->riwayatKelas->values();

                    $openRows = $histories->whereNull('tanggal_keluar');
                    if ($openRows->count() > 1) {
                        $summary['audit'][] = [
                            'siswa_id' => $siswa->id,
                            'siswa' => $siswa->nama,
                            'issue' => 'multiple_open_histories',
                            'ids' => $openRows->pluck('id')->values()->all(),
                        ];
                    }

                    $duplicates = $histories
                        ->groupBy(fn ($r) => implode('|', [
                            $r->jenis_perubahan,
                            $r->nama_kelas_snapshot,
                            $this->dateString($r->tanggal_masuk ?? $r->created_at),
                        ]))
                        ->filter(fn ($group) => $group->count() > 1);

                    foreach ($duplicates as $group) {
                        $summary['audit'][] = [
                            'siswa_id' => $siswa->id,
                            'siswa' => $siswa->nama,
                            'issue' => 'possible_duplicate_histories',
                            'ids' => $group->pluck('id')->values()->all(),
                        ];
                    }

                    foreach ($histories as $index => $history) {
                        $next = $histories->get($index + 1);
                        $changes = $this->normalizationChangesFor($history, $next);

                        if ($changes === []) {
                            continue;
                        }

                        $summary['updated_rows']++;

                        if (array_key_exists('tanggal_keluar', $changes)) {
                            in_array($history->jenis_perubahan, self::TERMINAL_TYPES, true)
                                ? $summary['terminal_rows_fixed']++
                                : $summary['interval_rows_fixed']++;
                        }

                        if (array_key_exists('nama_kelas_snapshot', $changes)) {
                            $summary['snapshot_rows_fixed']++;
                        }

                        if (!$dryRun) {
                            $history->update($changes);
                        }
                    }
                }
            });

        return $summary;
    }

    public function labelFor(?string $jenisPerubahan): string
    {
        return [
            'naik_kelas' => 'Naik Kelas',
            'turun_kelas' => 'Tinggal Kelas',
            'pindah_kelas' => 'Pindah Kelas',
            'masuk_baru' => 'Siswa Baru',
            'mutasi_masuk' => 'Mutasi Masuk',
            'mutasi_keluar' => 'Mutasi Keluar',
            'lulus' => 'Lulus',
            'masuk_kembali' => 'Aktif Kembali',
            'nonaktif' => 'Nonaktif',
        ][$jenisPerubahan] ?? 'Lainnya';
    }

    public function terminalSnapshot(string $jenisPerubahan): string
    {
        return [
            'lulus' => 'Lulus',
            'mutasi_keluar' => 'Mutasi Keluar',
            'nonaktif' => 'Nonaktif',
        ][$jenisPerubahan] ?? 'Mutasi Keluar';
    }

    public function activeSemesterName(?int $tahunAjaranId = null): string
    {
        $query = Semester::query()->where('is_active', true);

        if ($tahunAjaranId) {
            $query->where('tahun_ajaran_id', $tahunAjaranId);
        }

        return $query->value('nama') ?? 'Ganjil';
    }

    public function activeTahunAjaranId(): ?int
    {
        return TahunAjaran::where('is_active', true)->value('id');
    }

    public function closeLatestOpenHistory(Siswa $siswa, CarbonInterface|string|null $tanggalKeluar = null): ?RiwayatKelas
    {
        $tanggalKeluar = $this->dateString($tanggalKeluar);

        $history = RiwayatKelas::where('siswa_id', $siswa->id)
            ->whereNull('tanggal_keluar')
            ->orderByRaw('COALESCE(tanggal_masuk, DATE(created_at)) desc')
            ->orderByDesc('id')
            ->first();

        if (!$history) {
            return null;
        }

        $history->update(['tanggal_keluar' => $tanggalKeluar]);

        return $history;
    }

    private function normalizationChangesFor(RiwayatKelas $history, ?RiwayatKelas $next): array
    {
        $changes = [];
        $start = $this->dateString($history->tanggal_masuk ?? $history->created_at);
        $nextStart = $next ? $this->dateString($next->tanggal_masuk ?? $next->created_at) : null;

        if (in_array($history->jenis_perubahan, self::TERMINAL_TYPES, true)) {
            if (!$history->tanggal_keluar || $this->dateString($history->tanggal_keluar) !== $start) {
                $changes['tanggal_keluar'] = $start;
            }

            $snapshot = $this->terminalSnapshot($history->jenis_perubahan);
            if ($history->nama_kelas_snapshot !== $snapshot) {
                $changes['nama_kelas_snapshot'] = $snapshot;
            }

            return $changes;
        }

        if ($nextStart) {
            $currentEnd = $history->tanggal_keluar ? $this->dateString($history->tanggal_keluar) : null;
            if (!$currentEnd || $currentEnd < $start || $currentEnd > $nextStart) {
                $changes['tanggal_keluar'] = $nextStart;
            }
        } elseif ($history->tanggal_keluar && $this->dateString($history->tanggal_keluar) < $start) {
            $changes['tanggal_keluar'] = $start;
        }

        return $changes;
    }

    private function kelasSnapshot(Kelas $kelas): string
    {
        return trim($kelas->tingkat . ' ' . $kelas->nama_kelas);
    }

    private function dateString(CarbonInterface|string|null $date): string
    {
        return $date instanceof CarbonInterface
            ? $date->toDateString()
            : Carbon::parse($date ?? now())->toDateString();
    }
}
