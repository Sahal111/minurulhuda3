<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class SiswaImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnError,
    SkipsOnFailure,
    WithChunkReading
{
    use SkipsErrors, SkipsFailures;

    private array $fotoMap;   // [stem_lowercase => fullpath]
    private array $kelasCache = [];
    private array $stats = [
        'inserted'     => 0,
        'updated'      => 0,
        'skipped'      => 0,
        'foto_matched' => 0,
        'foto_avatar'  => 0,
    ];

    public function __construct(array $fotoMap = [])
    {
        $this->fotoMap = $fotoMap;
    }

    public function model(array $row): ?Siswa
    {
        // Skip baris yang benar-benar kosong
        $allEmpty = collect($row)->filter(fn($v) => !is_null($v) && trim((string)$v) !== '')->isEmpty();
        if ($allEmpty) return null;

        $nis  = trim($row['nis'] ?? '');
        $nisn = trim($row['nisn'] ?? '');
        $nama = trim($row['nama_lengkap'] ?? ($row['nama'] ?? ''));

        if (!$nis) {
            $this->stats['skipped']++;
            return null;
        }

        // Resolve kelas & tingkat
        $kelasRaw = trim($row['kelas'] ?? '');
        $kelasId  = $this->resolveKelas($kelasRaw);
        $tingkat  = 1;
        if ($kelasId) {
            $kelas   = Kelas::find($kelasId);
            $tingkat = $kelas?->tingkat ?? 1;
        }

        $data = [
            'nisn'             => $nisn ?: null,
            'nis'              => $nis,
            'nama'             => $nama,
            'tingkat'          => $tingkat,
            'nik'              => trim($row['nik'] ?? '') ?: null,
            'no_kk'            => trim($row['no_kk'] ?? '') ?: null,
            'jenis_kelamin'    => $this->parseJK($row['jenis_kelamin_l_p'] ?? ($row['jenis_kelamin'] ?? '')),
            'tempat_lahir'     => trim($row['tempat_lahir'] ?? '') ?: null,
            'tanggal_lahir'    => $this->parseDate($row['tanggal_lahir'] ?? ($row['tanggal_lahir_yyyy_mm_dd'] ?? null)),
            'agama'            => trim($row['agama'] ?? '') ?: null,
            'golongan_darah'   => $this->parseGolonganDarah($row['golongan_darah'] ?? ''),
            'kebutuhan_khusus' => trim($row['kebutuhan_khusus'] ?? '') ?: null,
            'status'           => strtolower(trim($row['status_siswa'] ?? 'aktif')),
            'kelas_id'         => $kelasId,
            'asal_sekolah'     => trim($row['asal_sekolah'] ?? '') ?: null,
            'tanggal_masuk'    => $this->parseDate($row['tanggal_masuk'] ?? ($row['tanggal_masuk_yyyy_mm_dd'] ?? null)),
            // Dapodik: Domisili & Periodik
            'alamat_siswa'           => trim($row['alamat_siswa'] ?? '') ?: null,
            'rt'                     => trim($row['rt'] ?? '') ?: null,
            'rw'                     => trim($row['rw'] ?? '') ?: null,
            'kelurahan'              => trim($row['kelurahan'] ?? '') ?: null,
            'kecamatan'              => trim($row['kecamatan'] ?? '') ?: null,
            'kode_pos'               => trim($row['kode_pos'] ?? '') ?: null,
            'anak_ke'                => $this->parseUnsignedInt($row['anak_ke'] ?? null),
            'jumlah_saudara'         => $this->parseUnsignedInt($row['jumlah_saudara'] ?? null),
            'jarak_tempat_tinggal'   => isset($row['jarak_tempat_tinggal']) ? (float)$row['jarak_tempat_tinggal'] : null,
            'waktu_tempuh'           => $this->parseUnsignedInt($row['waktu_tempuh'] ?? null),
            'moda_transportasi'      => $this->parseString($row['moda_transportasi'] ?? ''),
        ];

        $tinggi_badan = $this->parseUnsignedInt($row['tinggi_badan_cm'] ?? ($row['tinggi_badan'] ?? null));
        $berat_badan  = $this->parseUnsignedInt($row['berat_badan_kg']  ?? ($row['berat_badan']  ?? null));
        $dataTambahan = [
            'kewarganegaraan' => $this->parseKewarganegaraan($row['kewarganegaraan'] ?? null),
            'no_registrasi_akta_kelahiran' => trim($row['no_registrasi_akta_kelahiran'] ?? '') ?: null,
            'lintang' => $this->parseDecimal($row['lintang'] ?? null),
            'bujur' => $this->parseDecimal($row['bujur'] ?? null),
            'kebutuhan_khusus_ayah' => trim($row['kebutuhan_khusus_ayah'] ?? '') ?: null,
            'kebutuhan_khusus_ibu' => trim($row['kebutuhan_khusus_ibu'] ?? '') ?: null,
            'hobi' => trim($row['hobi'] ?? '') ?: null,
            'cita_cita' => trim($row['cita_cita'] ?? '') ?: null,
            'no_telp_siswa' => trim($row['no_telp_siswa'] ?? '') ?: null,
            'hp_siswa' => trim($row['hp_siswa'] ?? '') ?: null,
            'email_siswa' => trim($row['email_siswa'] ?? '') ?: null,
            'lingkar_kepala' => $this->parseDecimal($row['lingkar_kepala_cm'] ?? ($row['lingkar_kepala'] ?? null)),
        ];
        $programKesejahteraan = [
            'penerima_kps_pkh' => $this->parseBool($row['penerima_kps_pkh'] ?? null),
            'no_kps_pkh' => trim($row['no_kps_pkh'] ?? '') ?: null,
            'layak_pip' => $this->parseBool($row['layak_pip'] ?? null),
            'alasan_layak_pip' => trim($row['alasan_layak_pip'] ?? '') ?: null,
            'penerima_kip' => $this->parseBool($row['penerima_kip'] ?? null),
            'no_kip' => trim($row['no_kip'] ?? '') ?: null,
            'nama_tertera_di_kip' => trim($row['nama_tertera_di_kip'] ?? '') ?: null,
        ];

        $dataAyah = [
            'nama_ayah'        => trim($row['nama_ayah']      ?? '') ?: null,
            'nik_ayah'         => trim($row['nik_ayah'] ?? '') ?: null,
            'tahun_lahir_ayah' => $this->parseUnsignedInt($row['tahun_lahir_ayah'] ?? null),
            'pendidikan_ayah'  => $this->parseString($row['pendidikan_ayah'] ?? ''),
            'pekerjaan_ayah'   => trim($row['pekerjaan_ayah'] ?? '') ?: null,
            'penghasilan_ayah' => $this->parseString($row['penghasilan_ayah'] ?? ''),
            'no_hp'            => trim($row['no_hp_ortu']     ?? '') ?: null,
            'alamat'           => trim($row['alamat']         ?? '') ?: null,
            'nama_ibu'         => null, 'nik_ibu' => null, 'tahun_lahir_ibu' => null, 'pendidikan_ibu' => null, 'pekerjaan_ibu' => null, 'penghasilan_ibu' => null,
            'nama_wali'        => null, 'nik_wali' => null, 'tahun_lahir_wali' => null, 'pendidikan_wali' => null, 'pekerjaan_wali' => null, 'penghasilan_wali' => null, 'no_hp_wali' => null, 'alamat_wali' => null,
        ];

        $dataIbu = [
            'nama_ibu'         => trim($row['nama_ibu']       ?? '') ?: null,
            'nik_ibu'          => trim($row['nik_ibu'] ?? '') ?: null,
            'tahun_lahir_ibu'  => $this->parseUnsignedInt($row['tahun_lahir_ibu'] ?? null),
            'pendidikan_ibu'   => $this->parseString($row['pendidikan_ibu'] ?? ''),
            'pekerjaan_ibu'    => trim($row['pekerjaan_ibu']  ?? '') ?: null,
            'penghasilan_ibu'  => $this->parseString($row['penghasilan_ibu'] ?? ''),
            'no_hp'            => trim($row['no_hp_ortu']     ?? '') ?: null,
            'alamat'           => trim($row['alamat']         ?? '') ?: null,
            'nama_ayah'        => null, 'nik_ayah' => null, 'tahun_lahir_ayah' => null, 'pendidikan_ayah' => null, 'pekerjaan_ayah' => null, 'penghasilan_ayah' => null,
            'nama_wali'        => null, 'nik_wali' => null, 'tahun_lahir_wali' => null, 'pendidikan_wali' => null, 'pekerjaan_wali' => null, 'penghasilan_wali' => null, 'no_hp_wali' => null, 'alamat_wali' => null,
        ];

        $dataWali = [
            'nama_wali'        => trim($row['nama_wali'] ?? '') ?: null,
            'nik_wali'         => trim($row['nik_wali'] ?? '') ?: null, // Wali doesn't explicitly have NIK in this import sheet usually but defined in DB
            'tahun_lahir_wali' => null,
            'pekerjaan_wali'   => trim($row['pekerjaan_wali'] ?? '') ?: null,
            'pendidikan_wali'  => $this->parseString($row['pendidikan_wali'] ?? ''),
            'penghasilan_wali' => $this->parseString($row['penghasilan_wali'] ?? ''),
            'no_hp_wali'       => trim($row['no_hp_wali'] ?? '') ?: null,
            'alamat_wali'      => trim($row['alamat_wali'] ?? '') ?: null,
            'no_hp'            => trim($row['no_hp_wali'] ?? '') ?: null, // Fallback no_hp
            'alamat'           => trim($row['alamat_wali'] ?? '') ?: null,
            'nama_ayah'        => null, 'nik_ayah' => null, 'tahun_lahir_ayah' => null, 'pendidikan_ayah' => null, 'pekerjaan_ayah' => null, 'penghasilan_ayah' => null,
            'nama_ibu'         => null, 'nik_ibu' => null, 'tahun_lahir_ibu' => null, 'pendidikan_ibu' => null, 'pekerjaan_ibu' => null, 'penghasilan_ibu' => null,
        ];

        // Cek apakah siswa sudah ada berdasarkan NIS
        $existing = Siswa::where('nis', $nis)->first();

        \Illuminate\Support\Facades\DB::transaction(function () use ($existing, $data, $dataAyah, $dataIbu, $dataWali, $dataTambahan, $programKesejahteraan, $tinggi_badan, $berat_badan, $nisn, $nis, $nama) {
            if ($existing) {
                // UPDATE siswa yang sudah ada
                $existing->update($data);
                $existing->dataTambahan()->updateOrCreate(['siswa_id' => $existing->id], $dataTambahan);
                $existing->programKesejahteraan()->updateOrCreate(['siswa_id' => $existing->id], $programKesejahteraan);

                // Update foto jika ZIP berisi foto baru
                if (!empty($this->fotoMap)) {
                    $fotoPath = $this->resolveFoto($nisn, $nis, $nama, false);
                    if ($fotoPath !== null) {
                        if ($existing->foto) {
                            Storage::disk('public')->delete($existing->foto);
                        }
                        $existing->update(['foto' => $fotoPath]);
                    }
                }

                // Update data orang tua via pivot
                if ($dataAyah['nama_ayah']) {
                    $ayah = OrangTua::firstOrCreate(['nama_ayah' => $dataAyah['nama_ayah']], $dataAyah);
                    $existing->orangTuas()->syncWithoutDetaching([$ayah->id => ['hubungan_keluarga' => 'Ayah']]);
                }
                if ($dataIbu['nama_ibu']) {
                    $ibu = OrangTua::firstOrCreate(['nama_ibu' => $dataIbu['nama_ibu']], $dataIbu);
                    $existing->orangTuas()->syncWithoutDetaching([$ibu->id => ['hubungan_keluarga' => 'Ibu']]);
                }
                if ($dataWali['nama_wali']) {
                    $wali = OrangTua::firstOrCreate(['nama_wali' => $dataWali['nama_wali']], $dataWali);
                    $existing->orangTuas()->syncWithoutDetaching([$wali->id => ['hubungan_keluarga' => 'Wali']]);
                }

                // Handle Perkembangan Siswa
                if ($tinggi_badan || $berat_badan) {
                    $existing->perkembangans()->updateOrCreate(
                        ['tahun_ajaran_id' => null, 'semester' => 'Ganjil'], // Placeholder
                        ['tinggi_badan' => $tinggi_badan, 'berat_badan' => $berat_badan]
                    );
                }

                $this->stats['updated']++;
                return;
            }

            // INSERT siswa baru
            $foto = $this->resolveFoto($nisn, $nis, $nama);
            $data['foto'] = $foto;

            $siswa = Siswa::create($data);
            $siswa->dataTambahan()->create($dataTambahan);
            $siswa->programKesejahteraan()->create($programKesejahteraan);

            if ($dataAyah['nama_ayah']) {
                $ayah = OrangTua::firstOrCreate(['nama_ayah' => $dataAyah['nama_ayah']], $dataAyah);
                $siswa->orangTuas()->attach($ayah->id, ['hubungan_keluarga' => 'Ayah']);
            }
            if ($dataIbu['nama_ibu']) {
                $ibu = OrangTua::firstOrCreate(['nama_ibu' => $dataIbu['nama_ibu']], $dataIbu);
                $siswa->orangTuas()->attach($ibu->id, ['hubungan_keluarga' => 'Ibu']);
            }
            if ($dataWali['nama_wali']) {
                $wali = OrangTua::firstOrCreate(['nama_wali' => $dataWali['nama_wali']], $dataWali);
                $siswa->orangTuas()->attach($wali->id, ['hubungan_keluarga' => 'Wali']);
            }

            if ($tinggi_badan || $berat_badan) {
                $siswa->perkembangans()->create([
                    'tahun_ajaran_id' => null,
                    'semester'        => 'Ganjil',
                    'tinggi_badan'    => $tinggi_badan,
                    'berat_badan'     => $berat_badan,
                ]);
            }

            $this->stats['inserted']++;
        });

        return null; // Sudah di-handle manual dalam transaction
    }

    private function resolveFoto(string $nisn, string $nis, string $nama, bool $countAvatar = true): ?string
    {
        if (!empty($this->fotoMap)) {
            $candidates = array_filter([
                $nisn ? strtolower(trim($nisn)) : null,
                $nis  ? strtolower(trim($nis))  : null,
                $nama ? strtolower(Str::slug($nama)) : null,
            ]);

            foreach ($candidates as $stem) {
                if (isset($this->fotoMap[$stem])) {
                    $fullPath = $this->fotoMap[$stem];
                    $ext      = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
                    $dest     = 'foto_siswa/' . Str::uuid() . ".{$ext}";
                    Storage::disk('public')->put($dest, file_get_contents($fullPath));
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

    private function resolveKelas(string $raw): ?int
    {
        $raw = trim($raw);
        if (!$raw) return null;
        if (isset($this->kelasCache[$raw])) return $this->kelasCache[$raw];

        preg_match('/(\d+)\s*[-\s]?\s*([A-Za-z]+)/', $raw, $m);
        $id = null;
        if (count($m) >= 3) {
            $kelas = Kelas::where('tingkat', $m[1])
                ->whereRaw('UPPER(nama_kelas) = ?', [strtoupper($m[2])])
                ->first();
            $id = $kelas?->id;
        }
        $this->kelasCache[$raw] = $id;
        return $id;
    }

    private function parseJK(string $raw): string
    {
        $raw = strtoupper(trim($raw));
        if (in_array(substr($raw, 0, 1), ['L'])) return 'L';
        return 'P';
    }

    private function parseGolonganDarah(mixed $value): ?string
    {
        $v = strtoupper(trim((string) $value));
        return in_array($v, ['A', 'B', 'AB', 'O']) ? $v : ($v === 'TIDAK DIKETAHUI' ? 'Tidak Diketahui' : null);
    }

    private function parseUnsignedInt(mixed $value): ?int
    {
        if ($value === null || trim((string) $value) === '') return null;
        $int = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        return $int > 0 ? $int : null;
    }

    private function parseDecimal(mixed $value): ?float
    {
        if ($value === null || trim((string) $value) === '') return null;
        $normalized = str_replace(',', '.', trim((string) $value));
        return is_numeric($normalized) ? (float) $normalized : null;
    }

    private function parseBool(mixed $value): bool
    {
        $normalized = strtolower(trim((string) $value));
        return in_array($normalized, ['1', 'ya', 'yes', 'true', 'y'], true);
    }

    private function parseKewarganegaraan(mixed $value): ?string
    {
        $normalized = strtoupper(trim((string) $value));
        return in_array($normalized, ['WNI', 'WNA'], true) ? $normalized : null;
    }

    private function parseDate(mixed $value): ?string
    {
        if (!$value) return null;
        if (is_numeric($value)) {
            try {
                return \PhpOffice\PhpSpreadsheet\Shared\Date
                    ::excelToDateTimeObject((float) $value)->format('Y-m-d');
            } catch (\Throwable) {}
        }
        $value = trim((string) $value);
        foreach (['d/m/Y', 'd-m-Y', 'Y-m-d', 'd/m/y', 'd-m-y'] as $fmt) {
            $dt = \DateTime::createFromFormat($fmt, $value);
            if ($dt && $dt->format($fmt) === $value) return $dt->format('Y-m-d');
        }
        return null;
    }

    private function parseString(mixed $value): ?string
    {
        if ($value === null) return null;
        $str = trim((string) $value);
        if ($str === '') return null;
        
        // Handle "Rp." or "Rp. " variations before capitalization
        $str = str_ireplace(['rp. ', 'rp.'], 'rp ', $str);
        
        // Capitalize each word correctly, e.g. "sma / sederajat" -> "SMA / Sederajat", "d4 / s1" -> "D4 / S1"
        $str = ucwords(strtolower($str));
        
        // Fix some common acronyms
        $str = str_replace(
            ['Sd ', 'Smp ', 'Sma ', 'D1 ', 'D2 ', 'D3 ', 'D4 ', 'S1 ', 'S2 ', 'S3 ', 'Rp '],
            ['SD ', 'SMP ', 'SMA ', 'D1 ', 'D2 ', 'D3 ', 'D4 ', 'S1 ', 'S2 ', 'S3 ', 'Rp '],
            $str . ' '
        );
        
        return trim($str);
    }

    public function rules(): array { return []; }  // validasi ditangani di model()
    public function chunkSize(): int { return 200; }
    public function getStats(): array { return $this->stats; }
}
