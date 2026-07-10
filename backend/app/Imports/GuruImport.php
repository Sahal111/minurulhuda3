<?php

namespace App\Imports;

use App\Models\Guru;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithBatchInserts,
    WithChunkReading
{
    use SkipsErrors;

    private array $fotoMap;

    private array $stats = [
        'inserted' => 0,
        'updated' => 0,
        'skipped' => 0,
        'foto_matched' => 0,
        'foto_avatar' => 0,
    ];

    public array $skippedRows = [];

    public function __construct(array $fotoMap = [])
    {
        $this->fotoMap = $fotoMap;
    }

    public function collection(Collection $rows): void
    {
        foreach ($rows as $index => $row) {
            try {
                // Skip baris kosong
                $allEmpty = collect($row)->filter(fn($v) => !is_null($v) && trim((string) $v) !== '')->isEmpty();
                if ($allEmpty)
                    continue;

                $nuptk = $this->parseNumericString($this->pick($row, ['nuptk'])) ?? '';
                $nama = trim((string) $this->pick($row, ['nama', 'nama_lengkap']));
                $nip = $this->parseNumericString($this->pick($row, ['nip'])) ?? '';
                $email = trim((string) $this->pick($row, ['email']));

                if ($nuptk === '') {
                    $this->stats['skipped']++;
                    $this->skippedRows[] = ['baris' => $index + 2, 'nama' => $nama ?: '-', 'alasan' => 'NUPTK kosong'];
                    continue;
                }

                if ($nama === '') {
                    $this->stats['skipped']++;
                    $this->skippedRows[] = ['baris' => $index + 2, 'nama' => '-', 'alasan' => 'Nama guru kosong'];
                    continue;
                }

                // 2. FIX — pakai withTrashed agar soft deleted ketemu
                $guru = Guru::withTrashed()->where('nuptk', $nuptk)->first();
                if ($guru && $guru->trashed()) {
                    $guru->restore();
                }

                // Cek conflict email
                if ($email !== '') {
                    $emailExists = Guru::where('email', $email)
                        ->when($guru, fn($q) => $q->where('id', '!=', $guru->id))
                        ->exists();
                    if ($emailExists) {
                        $this->stats['skipped']++;
                        $this->skippedRows[] = ['baris' => $index + 2, 'nama' => $nama, 'alasan' => 'Email sudah digunakan guru lain'];
                        continue;
                    }
                }

                // Cek conflict NIK
                $nik = $this->parseNumericString($this->pick($row, ['nik'])) ?? '';
                if ($nik !== '') {
                    $nikExists = Guru::where('nik', $nik)
                        ->when($guru, fn($q) => $q->where('id', '!=', $guru->id))
                        ->exists();
                    if ($nikExists) {
                        $this->stats['skipped']++;
                        $this->skippedRows[] = ['baris' => $index + 2, 'nama' => $nama, 'alasan' => 'NIK sudah digunakan guru lain'];
                        continue;
                    }
                }

                // 3. FIX — no_kk dan no_rekening di-truncate max 20 karakter
                $profileData = [
                    'nip' => $nip ?: null,
                    'nuptk' => $nuptk,
                    'nama' => $nama,
                    'tempat_lahir' => $this->nullableString($this->pick($row, ['tempat_lahir'])),
                    'tanggal_lahir' => $this->parseDate($this->pick($row, ['tanggal_lahir'])),
                    'jenis_kelamin' => $this->nullableString($this->pick($row, ['jenis_kelamin'])),
                    'agama' => $this->nullableString($this->pick($row, ['agama'])),
                    'alamat' => $this->nullableString($this->pick($row, ['alamat'])),
                    'no_hp' => $this->nullableString($this->pick($row, ['no_hp'])),
                    'email' => $email ?: null,
                    'status_aktif' => $this->parseBoolean($this->pick($row, ['status_aktif']) ?? 'Aktif'),
                    'tanggal_bergabung' => $this->parseDate($this->pick($row, ['tanggal_bergabung'])),
                    'tmt_pns' => $this->parseDate($this->pick($row, ['tmt_pns'])),
                    'tmt_gty' => $this->parseDate($this->pick($row, ['tmt_gty'])),
                    'nik' => $nik ?: null,
                    'no_kk' => $this->parseTruncated($this->pick($row, ['no_kk']), 20),
                    'no_karpeg' => $this->nullableString($this->pick($row, ['no_karpeg'])),
                    'no_karis_karsu' => $this->nullableString($this->pick($row, ['no_karis_karsu'])),
                    'nama_ibu_kandung' => $this->nullableString($this->pick($row, ['nama_ibu_kandung'])),
                    'golongan_darah' => $this->nullableString($this->pick($row, ['golongan_darah'])),
                    'mapel' => $this->nullableString($this->pick($row, ['mata_pelajaran', 'mapel'])),
                    'kelas' => $this->nullableString($this->pick($row, ['kelas'])),
                    'tahun_mengajar' => $this->parseYear($this->pick($row, ['tahun_mengajar'])),
                ];

                if ($guru) {
                    $guru->update($profileData);
                    $this->stats['updated']++;
                } else {
                    $profileData['foto'] = $this->resolveFoto($nuptk, $nip, $nama);
                    $guru = Guru::create($profileData);
                    $this->stats['inserted']++;
                }

                // --- SAVE DETAIL TABLES ---

                // 1. Jabatan & Kepegawaian
                $statusKepegawaian = $this->nullableString($this->pick($row, ['status_kepegawaian'])) ?? 'Honorer';
                $jabatanStr = $this->nullableString($this->pick($row, ['jabatan'])) ?? 'Guru';
                $golongan = $this->nullableString($this->pick($row, ['golongan']));

                // Sync current jabatan
                $currentJabatan = $guru->currentJabatan;
                if (!$currentJabatan || $currentJabatan->jabatan !== $jabatanStr || $currentJabatan->status_kepegawaian !== $statusKepegawaian || $currentJabatan->golongan !== $golongan) {
                    if ($currentJabatan)
                        $currentJabatan->update(['is_current' => false]);
                    $guru->jabatans()->create([
                        'jabatan' => $jabatanStr,
                        'status_kepegawaian' => $statusKepegawaian,
                        'golongan' => $golongan,
                        'sk_nomor' => $this->nullableString($this->pick($row, ['sk_pengangkatan'])),
                        'sk_tanggal' => $this->parseDate($this->pick($row, ['tanggal_sk'])),
                        'tmt_jabatan' => $this->parseDate($this->pick($row, ['tmt_jabatan'])),
                        'tanggal_selesai' => $this->parseDate($this->pick($row, ['tanggal_selesai_jabatan', 'tanggal_selesai'])),
                        'is_current' => true,
                    ]);
                } else {
                    // ← tambah update tanggal_selesai di sini juga
                    $currentJabatan->update([
                        'sk_nomor' => $this->nullableString($this->pick($row, ['sk_pengangkatan'])),
                        'sk_tanggal' => $this->parseDate($this->pick($row, ['tanggal_sk'])),
                        'tmt_jabatan' => $this->parseDate($this->pick($row, ['tmt_jabatan'])),
                        'tanggal_selesai' => $this->parseDate($this->pick($row, ['tanggal_selesai_jabatan', 'tanggal_selesai'])),
                    ]);
                }

                // 2. Rekening & Payroll
                $guru->rekening()->updateOrCreate([], [
                    'nama_bank' => $this->nullableString($this->pick($row, ['nama_bank', 'bank'])),
                    'no_rekening' => $this->nullableString($this->pick($row, ['no_rekening', 'rekening'])),
                    'cabang' => $this->nullableString($this->pick($row, ['cabang_bank', 'cabang'])),  // ← tambah
                    'atas_nama' => $this->nullableString($this->pick($row, ['atas_nama_rekening', 'atas_nama'])) ?? $nama,
                    'npwp' => $this->nullableString($this->pick($row, ['npwp'])),
                    'gaji_pokok' => (float) ($this->parseNumeric($this->pick($row, ['gaji_pokok'])) ?? 0),
                    'tunjangan_fungsional' => (float) ($this->parseNumeric($this->pick($row, ['tunjangan_fungsional'])) ?? 0),  // ← tambah
                ]);

                // 3. Keluarga
                $guru->keluarga()->updateOrCreate([], [
                    'status_perkawinan' => $this->nullableString($this->pick($row, ['status_perkawinan'])),
                    'nama_pasangan' => $this->nullableString($this->pick($row, ['nama_pasangan'])),
                    'pekerjaan_pasangan' => $this->nullableString($this->pick($row, ['pekerjaan_pasangan'])),
                    'jumlah_anak' => (int) $this->parseNumeric($this->pick($row, ['jumlah_anak'])) ?? 0,
                ]);

                // 4. Pendidikan (S1 & S2)
                $pendidikanS1 = $this->normalizeJenjang(
                    $this->nullableString($this->pick($row, ['pendidikan_terakhir', 'pendidikan', 'pendidikan_s1']))
                );
                if ($pendidikanS1) {
                    $guru->pendidikans()->updateOrCreate(
                        ['jenjang' => $pendidikanS1],  // ← pakai nilai asli, bukan hardcode 'S1'
                        [
                            'nama_sekolah' => $this->nullableString($this->pick($row, ['kampus_terakhir', 'kampus', 'kampus_s1'])),
                            'jurusan' => $this->nullableString($this->pick($row, ['jurusan_terakhir', 'jurusan', 'jurusan_s1'])),
                            'tahun_lulus' => $this->parseYear($this->pick($row, ['tahun_lulus_s1', 'tahun_lulus'])),
                            'no_ijazah' => $this->nullableString($this->pick($row, ['no_ijazah'])),  // ← tambah
                        ]
                    );
                }

                // 5. Sertifikasi
                $noSertifikasi = $this->nullableString($this->pick($row, ['no_sertifikasi']));
                if ($noSertifikasi) {
                    $guru->sertifikasis()->updateOrCreate(
                        ['no_sertifikat' => $noSertifikasi],
                        [
                            'jenis_sertifikasi' => 'Sertifikasi Pendidik',
                            'tahun_sertifikasi' => $this->parseYear($this->pick($row, ['tahun_sertifikasi'])),
                            'bidang_studi' => $this->nullableString($this->pick($row, ['bidang_sertifikasi'])),
                            'nrg' => $this->nullableString($this->pick($row, ['nrg'])),
                            'tanggal_terbit' => $this->parseDate($this->pick($row, ['tanggal_terbit_sertifikasi'])),  // ← tambah
                            'expired_at' => $this->parseDate($this->pick($row, ['expired_sertifikasi'])),  // ← tambah
                        ]
                    );
                    if ($guru->id && !empty($this->fotoMap)) {
                        $fotoPath = $this->resolveFoto($nuptk, $nip, $nama, false);
                        if ($fotoPath !== null) {
                            if ($guru->foto) {
                                \Illuminate\Support\Facades\Storage::disk('public')->delete($guru->foto);
                            }
                            $guru->update(['foto' => $fotoPath]);
                        }
                    }
                }
            } catch (\Exception $e) {
                // 4. FIX — tangkap error dan masukkan ke skippedRows agar terlihat
                $this->stats['skipped']++;
                $this->skippedRows[] = [
                    'baris' => $index + 2,
                    'nama' => $nama ?? '-',
                    'alasan' => 'Error: ' . $e->getMessage(),
                ];
            }
        }
    }

    private function resolveFoto(string $nuptk, string $nip, string $nama, bool $countAvatar = true): ?string
    {
        if (!empty($this->fotoMap)) {
            $candidates = array_filter([
                $nuptk ? strtolower(trim($nuptk)) : null,
                $nip ? strtolower(trim($nip)) : null,
                $nama ? strtolower(\Illuminate\Support\Str::slug($nama)) : null,
            ]);

            foreach ($candidates as $stem) {
                if (isset($this->fotoMap[$stem])) {
                    $fullPath = $this->fotoMap[$stem];
                    $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
                    $dest = 'foto_guru/' . \Illuminate\Support\Str::uuid() . ".{$ext}";
                    \Illuminate\Support\Facades\Storage::disk('public')->put($dest, file_get_contents($fullPath));
                    $this->stats['foto_matched']++;
                    return $dest;
                }
            }
        }

        if ($countAvatar) {
            $this->stats['foto_avatar']++;
        }

        return null;
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function getStats(): array
    {
        return $this->stats;
    }

    private function pick($row, array $keys): mixed
    {
        foreach ($keys as $key) {
            if (isset($row[$key]) && trim((string) $row[$key]) !== '') {
                return $row[$key];
            }
        }

        return null;
    }

    private function nullableString($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        if (in_array($value, ['', '-', '–'])) {
            return null;
        }

        return $value;
    }

    private function parseDate($value): ?string
    {
        if (!$value)
            return null;

        $valueStr = trim((string) $value);
        if (in_array($valueStr, ['', '-', '–']))
            return null;

        try {
            if (is_numeric($value)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)
                    ->format('Y-m-d');
            }
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    private function parseBoolean($value): bool
    {
        $lower = strtolower(trim($value ?? ''));
        return in_array($lower, ['aktif', 'ya', 'yes', '1', 'true', 'active']);
    }

    private function parseYear($value): ?int
    {
        if (!$value)
            return null;
        $valueStr = trim((string) $value);
        if (in_array($valueStr, ['', '-', '–']))
            return null;
        // Handle Excel numeric date serial for year columns
        if (is_numeric($valueStr) && strlen($valueStr) === 4) {
            return (int) $valueStr;
        }
        return null;
    }

    private function parseNumeric($value): ?int
    {
        if (!$value)
            return null;

        $valueStr = trim((string) $value);
        if (in_array($valueStr, ['', '-', '–']))
            return null;

        return (int) filter_var($valueStr, FILTER_SANITIZE_NUMBER_INT) ?: null;
    }

    // Tambah method baru di bawah parseNumeric():

    private function parseNumericString($value): ?string
    {
        if (!$value)
            return null;
        $valueStr = trim((string) $value);
        if (in_array($valueStr, ['', '-', '–']))
            return null;

        // Handle scientific notation dari Excel (misal: 5.4455678937644E+16)
        if (is_float($value) || stripos($valueStr, 'E+') !== false) {
            return number_format((float) $value, 0, '', '');
        }

        return $valueStr;
    }

    private function parseTruncated($value, int $maxLength): ?string
    {
        $result = $this->parseNumericString($value);
        if ($result === null)
            return null;
        return substr($result, 0, $maxLength);
    }

    private function normalizeJenjang(?string $value): ?string
    {
        if (!$value)
            return null;

        $map = [
            's1' => 'S1 - Sarjana',
            's-1' => 'S1 - Sarjana',
            'sarjana' => 'S1 - Sarjana',
            's1 - sarjana' => 'S1 - Sarjana',
            's2' => 'S2 - Magister',
            's-2' => 'S2 - Magister',
            'magister' => 'S2 - Magister',
            's2 - magister' => 'S2 - Magister',
            's3' => 'S3 - Doktor',
            's-3' => 'S3 - Doktor',
            'doktor' => 'S3 - Doktor',
            's3 - doktor' => 'S3 - Doktor',
            'd3' => 'D3 - Diploma',
            'd-3' => 'D3 - Diploma',
            'diploma' => 'D3 - Diploma',
            'd3 - diploma' => 'D3 - Diploma',
            'sma' => 'SMA / MA',
            'ma' => 'SMA / MA',
            'smk' => 'SMA / MA',
            'sma / ma' => 'SMA / MA',
            'sma/ma' => 'SMA / MA',
            'ma' => 'SMA / MA',
            'ma / sma' => 'SMA / MA',
        ];

        return $map[strtolower(trim($value))] ?? $value;
    }
}
