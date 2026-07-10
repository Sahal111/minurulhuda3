<?php

namespace App\Console\Commands;

use App\Services\RiwayatKelasService;
use Illuminate\Console\Command;

class NormalizeRiwayatKelas extends Command
{
    protected $signature = 'siswa:normalize-riwayat-kelas
        {--dry-run : Preview changes without writing to the database}
        {--siswa-id=* : Limit normalization to one or more siswa IDs}';

    protected $description = 'Normalize legacy riwayat_kelas intervals and terminal status events.';

    public function handle(RiwayatKelasService $riwayatKelasService): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $siswaIds = collect($this->option('siswa-id'))
            ->filter(fn ($id) => is_numeric($id))
            ->map(fn ($id) => (int) $id)
            ->values()
            ->all();

        $summary = $riwayatKelasService->normalizeExistingHistories(
            $siswaIds !== [] ? $siswaIds : null,
            $dryRun
        );

        $this->info($dryRun ? 'Dry run selesai. Tidak ada data yang diubah.' : 'Normalisasi riwayat kelas selesai.');
        $this->table(
            ['Metric', 'Value'],
            [
                ['Siswa dicek', $summary['checked_students']],
                ['Baris akan/berhasil diperbarui', $summary['updated_rows']],
                ['Event terminal diperbaiki', $summary['terminal_rows_fixed']],
                ['Interval kelas diperbaiki', $summary['interval_rows_fixed']],
                ['Snapshot terminal diperbaiki', $summary['snapshot_rows_fixed']],
                ['Item audit', count($summary['audit'])],
            ]
        );

        if ($summary['audit'] !== []) {
            $this->warn('Baris berikut perlu dicek manual karena terlihat ambigu atau duplikat:');
            $this->table(
                ['Siswa ID', 'Nama', 'Issue', 'Riwayat IDs'],
                collect($summary['audit'])
                    ->map(fn ($item) => [
                        $item['siswa_id'],
                        $item['siswa'],
                        $item['issue'],
                        implode(', ', $item['ids']),
                    ])
                    ->values()
                    ->all()
            );
        }

        return self::SUCCESS;
    }
}
