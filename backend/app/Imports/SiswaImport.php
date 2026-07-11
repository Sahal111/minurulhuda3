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

/**
 * Import siswa dari template yang kolomnya sesuai DATA_SISWA.xlsx (EMIS MI Nurul Huda 3).
 *
 * Mapping heading (WithHeadingRow otomatis lowercase + snake_case spasi→underscore):
 *
 * Excel Header              → key di $row[]
 * ─────────────────────────────────────────────────────────────────────────
 * NO                        → no
 * NAMA LENGKAP              → nama_lengkap
 * NISN                      → nisn
 * NIS LOKAL                 → nis_lokal
 * KEWARGA NEGARAAN          → kewarga_negaraan
 * NIK SISWA                 → nik_siswa
 * TEMPAT LAHIR              → tempat_lahir
 * TANGGAL LAHIR             → tanggal_lahir
 * JENIS KELAMIN             → jenis_kelamin
 * KELAS                     → kelas
 * KELAS PARAREL             → kelas_pararel
 * NO ABSEN                  → no_absen
 * JUMLAH SAUDARA            → jumlah_saudara
 * ANAK KE                   → anak_ke
 * CITA-CITA                 → cita_cita  (tanda - diganti _ oleh Laravel Excel)
 * AGAMA                     → agama
 * NO. HP SISWA              → no_hp_siswa
 * ALAMAT SISWA              → alamat_siswa
 * HOBI                      → hobi
 * YANG MEMBIAYAI SEKOLAH    → yang_membiayai_sekolah
 * Asal Sekolah              → asal_sekolah
 * IMUNISASI                 → imunisasi
 * NOMOR KIP                 → nomor_kip
 * NOMOR KK                  → nomor_kk
 * NAMA KEPALA KELUARGA      → nama_kepala_keluarga
 *
 * NAMA AYAH                 → nama_ayah
 * STATUS                    → status        (ayah – kolom ke-27)
 * KEWARGANEGARAAN           → kewarganegaraan (ayah – kolom ke-28)
 * NIK AYAH                  → nik_ayah
 * TEMPAT LAHIR (AYAH)       → tempat_lahir_ayah
 * TANGGAL LAHIR (AYAH)      → tanggal_lahir_ayah
 * PENDIDIKAN TERAKHIR (AYAH)→ pendidikan_terakhir_ayah
 * PEKERJAAN UTAMA (AYAH)    → pekerjaan_utama_ayah
 * PENGHASILAN PERBULAN (AYAH)→ penghasilan_perbulan_ayah
 * NO. HP AYAH               → no_hp_ayah
 *
 * NAMA IBU                  → nama_ibu
 * STATUS                    → status_2      (ibu – kolom ke-37, duplikat heading)
 * KEWARGANEGARAAN           → kewarganegaraan_2
 * NIK IBU                   → nik_ibu
 * TEMPAT LAHIR (IBU)        → tempat_lahir_ibu
 * TANGGAL LAHIR (IBU)       → tanggal_lahir_ibu
 * PENDIDIKAN TERAKHIR (IBU) → pendidikan_terakhir_ibu
 * PEKERJAAN UTAMA (IBU)     → pekerjaan_utama_ibu
 * PENGHASILAN PERBULAN (IBU)→ penghasilan_perbulan_ibu
 * NO. HP IBU                → no_hp_ibu
 *
 * NAMA WALI                 → nama_wali
 * STATUS                    → status_3
 * KEWARGA NEGARAAN          → kewarga_negaraan_2
 * NIK (WALI)                → nik_wali
 * TEMPAT LAHIR (WALI)       → tempat_lahir_wali
 * TANGGAL LAHIR (WALI)      → tanggal_lahir_wali
 * PENDIDIKAN TERAKHIR (WALI)→ pendidikan_terakhir_wali
 * PEKERJAAN UTAMA (WALI)    → pekerjaan_utama_wali
 * PENGHASILAN PERBULAN (WALI)→penghasilan_perbulan_wali
 * NO. HP WALI               → no_hp_wali
 *
 * AYAH KANDUNG              → ayah_kandung
 * STATUS KEPEMILIKAN        → status_kepemilikan
 * PROVINSI                  → provinsi
 * KAB                       → kab
 * KEC                       → kec
 * KELURAHAN / DESA          → kelurahan_desa
 * RT                        → rt
 * RW                        → rw
 * ALAMAT                    → alamat
 * KODE POS                  → kode_pos
 *
 * IBU KANDUNG               → ibu_kandung
 * STATUS KEPEMILIKAN        → status_kepemilikan_2
 * PROVINSI                  → provinsi_2
 * KAB                       → kab_2
 * KEC                       → kec_2
 * KELURAHAN / DESA          → kelurahan_desa_2
 * RT                        → rt_2
 * RW                        → rw_2
 * ALAMAT                    → alamat_2
 * KODE POS                  → kode_pos_2
 *
 * WALI (alamat)             → wali
 * STATUS KEPEMILIKAN        → status_kepemilikan_3
 * PROVINSI                  → provinsi_3
 * KAB                       → kab_3
 * KEC                       → kec_3
 * KELURAHAN / DESA          → kelurahan_desa_3
 * RT                        → rt_3
 * RW                        → rw_3
 * ALAMAT                    → alamat_3
 * KODE POS                  → kode_pos_3
 *
 * URUT                      → urut
 * NSM ASAL                  → nsm_asal
 * NPSN ASAL                 → npsn_asal
 * NAMA MADRASAH ASAL        → nama_madrasah_asal
 *
 * CATATAN: Heading duplikat (STATUS, KEWARGANEGARAAN, dst.) secara otomatis
 * di-suffix _2, _3, … oleh Maatwebsite\Excel WithHeadingRow.
 */
class SiswaImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnError,
    SkipsOnFailure,
    WithChunkReading
{
    use SkipsErrors, SkipsFailures;

    private array $fotoMap;      // [stem_lowercase => fullpath]
    private array $kelasCache = [];
    private array $stats = [
        'inserted' => 0,
        'updated' => 0,
        'skipped' => 0,
        'foto_matched' => 0,
        'foto_avatar' => 0,
    ];

    public function __construct(array $fotoMap = [])
    {
        $this->fotoMap = $fotoMap;
    }

    public function model(array $row): ?Siswa
    {
        // Skip baris yang benar-benar kosong
        $allEmpty = collect($row)->filter(fn($v) => !is_null($v) && trim((string) $v) !== '')->isEmpty();
        if ($allEmpty)
            return null;

        // ── Identitas utama ────────────────────────────────────────────────
        $nis = trim($row['nis_lokal'] ?? '');
        $nisn = trim($row['nisn'] ?? '');
        $nama = trim($row['nama_lengkap'] ?? '');

        if (!$nis) {
            $this->stats['skipped']++;
            return null;
        }

        // ── Resolve kelas ──────────────────────────────────────────────────
        $kelasRaw = trim($row['kelas'] ?? '');
        $kelasPararel = trim($row['kelas_pararel'] ?? '');
        // Gabungkan "1" + "A" → "1 A" supaya resolveKelas bisa parse
        $kelasGabung = $kelasPararel ? "{$kelasRaw} {$kelasPararel}" : $kelasRaw;
        $kelasId = $this->resolveKelas($kelasGabung);
        $tingkat = 1;
        if ($kelasId) {
            $kelas = Kelas::find($kelasId);
            $tingkat = $kelas?->tingkat ?? 1;
        }

        // ── Data siswa ─────────────────────────────────────────────────────
        $data = [
            'nisn' => $nisn ?: null,
            'nis' => $nis,
            'nama' => $nama,
            'tingkat' => $tingkat,
            'nik' => trim($row['nik_siswa'] ?? '') ?: null,
            'no_kk' => trim($row['nomor_kk'] ?? '') ?: null,
            'jenis_kelamin' => $this->parseJK($row['jenis_kelamin'] ?? ''),
            'tempat_lahir' => trim($row['tempat_lahir'] ?? '') ?: null,
            'tanggal_lahir' => $this->parseDate($row['tanggal_lahir'] ?? null),
            'agama' => trim($row['agama'] ?? '') ?: null,
            'kebutuhan_khusus' => null,  // kolom tidak ada di template EMIS ini
            'status' => 'aktif',
            'kelas_id' => $kelasId,
            'asal_sekolah' => trim($row['asal_sekolah'] ?? '') ?: null,
            'tanggal_masuk' => null,
            // Domisili siswa
            'alamat_siswa' => trim($row['alamat_siswa'] ?? '') ?: null,
            'rt' => trim($row['rt'] ?? '') ?: null,
            'rw' => trim($row['rw'] ?? '') ?: null,
            'kelurahan' => trim($row['kelurahan_desa'] ?? '') ?: null,
            'kecamatan' => trim($row['kec'] ?? '') ?: null,
            'kode_pos' => trim($row['kode_pos'] ?? '') ?: null,
            'anak_ke' => $this->parseUnsignedInt($row['anak_ke'] ?? null),
            'jumlah_saudara' => $this->parseUnsignedInt($row['jumlah_saudara'] ?? null),
            'jarak_tempat_tinggal' => null,
            'waktu_tempuh' => null,
            'moda_transportasi' => null,
            // BUG FIX: field ini masuk ke tabel siswas, bukan data_tambahan_siswas
            // dan nama kolom DB adalah 'pembiaya_sekolah' (bukan 'yang_membiayai_sekolah')
            'no_absen' => $this->parseUnsignedInt($row['no_absen'] ?? null),
            'nama_kepala_keluarga' => trim($row['nama_kepala_keluarga'] ?? '') ?: null,
            'pembiaya_sekolah' => trim($row['yang_membiayai_sekolah'] ?? '') ?: null,
            'imunisasi' => trim($row['imunisasi'] ?? '') ?: null,
        ];

        // ── Data tambahan ──────────────────────────────────────────────────
        $dataTambahan = [
            'kewarganegaraan' => $this->parseKewarganegaraan($row['kewarga_negaraan'] ?? null),
            'no_registrasi_akta_kelahiran' => null,
            'lintang' => null,
            'bujur' => null,
            'kebutuhan_khusus_ayah' => null,
            'kebutuhan_khusus_ibu' => null,
            'hobi' => trim($row['hobi'] ?? '') ?: null,
            'cita_cita' => trim($row['cita_cita'] ?? '') ?: null,
            'no_telp_siswa' => null,
            'hp_siswa' => trim($row['no_hp_siswa'] ?? '') ?: null,
            'email_siswa' => null,
            'lingkar_kepala' => null,
        ];

        // ── Program kesejahteraan ──────────────────────────────────────────
        $programKesejahteraan = [
            'penerima_kps_pkh' => false,
            'no_kps_pkh' => null,
            'layak_pip' => false,
            'alasan_layak_pip' => null,
            'penerima_kip' => !empty(trim($row['nomor_kip'] ?? '')),
            'no_kip' => trim($row['nomor_kip'] ?? '') ?: null,
            'nama_tertera_di_kip' => null,
        ];

        // ── Data ayah ──────────────────────────────────────────────────────
        $dataAyah = [
            'nama_ayah' => trim($row['nama_ayah'] ?? '') ?: null,
            'nik_ayah' => trim($row['nik_ayah'] ?? '') ?: null,
            'tahun_lahir_ayah' => $this->parseTahun($row['tanggal_lahir_ayah'] ?? null),
            'pendidikan_ayah' => $this->parseString($row['pendidikan_terakhir_ayah'] ?? ''),
            'pekerjaan_ayah' => trim($row['pekerjaan_utama_ayah'] ?? '') ?: null,
            'penghasilan_ayah' => $this->parseString($row['penghasilan_perbulan_ayah'] ?? ''),
            'no_hp' => trim($row['no_hp_ayah'] ?? '') ?: null,
            // FIX: field ada di template tapi tidak dimap
            'status_ayah' => trim($row['status'] ?? '') ?: null,
            'kewarganegaraan_ayah' => trim($row['kewarganegaraan'] ?? '') ?: null,
            'tempat_lahir_ayah' => trim($row['tempat_lahir_ayah'] ?? '') ?: null,
            'no_hp_ayah' => trim($row['no_hp_ayah'] ?? '') ?: null,
            // Alamat diambil dari blok "ALAMAT AYAH KANDUNG"
            'alamat' => trim($row['alamat'] ?? '') ?: null,
            'nama_ibu' => null,
            'nik_ibu' => null,
            'tahun_lahir_ibu' => null,
            'pendidikan_ibu' => null,
            'pekerjaan_ibu' => null,
            'penghasilan_ibu' => null,
            'nama_wali' => null,
            'nik_wali' => null,
            'tahun_lahir_wali' => null,
            'pendidikan_wali' => null,
            'pekerjaan_wali' => null,
            'penghasilan_wali' => null,
            'no_hp_wali' => null,
            'alamat_wali' => null,
        ];

        // ── Data ibu ───────────────────────────────────────────────────────
        $dataIbu = [
            'nama_ibu' => trim($row['nama_ibu'] ?? '') ?: null,
            'nik_ibu' => trim($row['nik_ibu'] ?? '') ?: null,
            'tahun_lahir_ibu' => $this->parseTahun($row['tanggal_lahir_ibu'] ?? null),
            'pendidikan_ibu' => $this->parseString($row['pendidikan_terakhir_ibu'] ?? ''),
            'pekerjaan_ibu' => trim($row['pekerjaan_utama_ibu'] ?? '') ?: null,
            'penghasilan_ibu' => $this->parseString($row['penghasilan_perbulan_ibu'] ?? ''),
            'no_hp' => trim($row['no_hp_ibu'] ?? '') ?: null,
            // FIX: field ada di template tapi tidak dimap
            // heading duplikat → suffix _2 otomatis dari WithHeadingRow
            'status_ibu' => trim($row['status_2'] ?? '') ?: null,
            'kewarganegaraan_ibu' => trim($row['kewarganegaraan_2'] ?? '') ?: null,
            'tempat_lahir_ibu' => trim($row['tempat_lahir_ibu'] ?? '') ?: null,
            'no_hp_ibu' => trim($row['no_hp_ibu'] ?? '') ?: null,
            // Alamat diambil dari blok "ALAMAT IBU KANDUNG"
            'alamat' => trim($row['alamat_2'] ?? '') ?: null,
            'nama_ayah' => null,
            'nik_ayah' => null,
            'tahun_lahir_ayah' => null,
            'pendidikan_ayah' => null,
            'pekerjaan_ayah' => null,
            'penghasilan_ayah' => null,
            'nama_wali' => null,
            'nik_wali' => null,
            'tahun_lahir_wali' => null,
            'pendidikan_wali' => null,
            'pekerjaan_wali' => null,
            'penghasilan_wali' => null,
            'no_hp_wali' => null,
            'alamat_wali' => null,
        ];

        // ── Data wali ──────────────────────────────────────────────────────
        $dataWali = [
            'nama_wali' => trim($row['nama_wali'] ?? '') ?: null,
            'nik_wali' => trim($row['nik_wali'] ?? '') ?: null,
            'tahun_lahir_wali' => $this->parseTahun($row['tanggal_lahir_wali'] ?? null),
            'pekerjaan_wali' => trim($row['pekerjaan_utama_wali'] ?? '') ?: null,
            'pendidikan_wali' => $this->parseString($row['pendidikan_terakhir_wali'] ?? ''),
            'penghasilan_wali' => $this->parseString($row['penghasilan_perbulan_wali'] ?? ''),
            'no_hp_wali' => trim($row['no_hp_wali'] ?? '') ?: null,
            'no_hp' => trim($row['no_hp_wali'] ?? '') ?: null,
            // FIX: field ada di template tapi tidak dimap
            // heading duplikat → suffix _3 / kewarga_negaraan_2 (beda ejaan di template)
            'status_wali' => trim($row['status_3'] ?? '') ?: null,
            'kewarganegaraan_wali' => trim($row['kewarga_negaraan_2'] ?? '') ?: null,
            'tempat_lahir_wali' => trim($row['tempat_lahir_wali'] ?? '') ?: null,
            // Alamat diambil dari blok "ALAMAT WALI"
            'alamat_wali' => trim($row['alamat_3'] ?? '') ?: null,
            'alamat' => trim($row['alamat_3'] ?? '') ?: null,
            'nama_ayah' => null,
            'nik_ayah' => null,
            'tahun_lahir_ayah' => null,
            'pendidikan_ayah' => null,
            'pekerjaan_ayah' => null,
            'penghasilan_ayah' => null,
            'nama_ibu' => null,
            'nik_ibu' => null,
            'tahun_lahir_ibu' => null,
            'pendidikan_ibu' => null,
            'pekerjaan_ibu' => null,
            'penghasilan_ibu' => null,
        ];

        // ── Upsert dalam satu transaksi ────────────────────────────────────
        $existing = Siswa::where('nis', $nis)->first();

        \Illuminate\Support\Facades\DB::transaction(function () use ($existing, $data, $dataAyah, $dataIbu, $dataWali, $dataTambahan, $programKesejahteraan, $nisn, $nis, $nama) {
            if ($existing) {
                // UPDATE
                $existing->update($data);
                $existing->dataTambahan()->updateOrCreate(['siswa_id' => $existing->id], $dataTambahan);
                $existing->programKesejahteraan()->updateOrCreate(['siswa_id' => $existing->id], $programKesejahteraan);

                if (!empty($this->fotoMap)) {
                    $fotoPath = $this->resolveFoto($nisn, $nis, $nama, false);
                    if ($fotoPath !== null) {
                        if ($existing->foto) {
                            Storage::disk('public')->delete($existing->foto);
                        }
                        $existing->update(['foto' => $fotoPath]);
                    }
                }

                if ($dataAyah['nama_ayah']) {
                    // BUG FIX: gunakan NIK sebagai unique key jika tersedia, bukan nama (bisa duplikat)
                    $ayahKey = $dataAyah['nik_ayah']
                        ? ['nik_ayah' => $dataAyah['nik_ayah']]
                        : ['nama_ayah' => $dataAyah['nama_ayah'], 'nama_ibu' => null, 'nama_wali' => null];
                    $ayah = OrangTua::firstOrCreate($ayahKey, $dataAyah);
                    $existing->orangTuas()->syncWithoutDetaching([$ayah->id => ['hubungan_keluarga' => 'Ayah']]);
                }
                if ($dataIbu['nama_ibu']) {
                    $ibuKey = $dataIbu['nik_ibu']
                        ? ['nik_ibu' => $dataIbu['nik_ibu']]
                        : ['nama_ibu' => $dataIbu['nama_ibu'], 'nama_ayah' => null, 'nama_wali' => null];
                    $ibu = OrangTua::firstOrCreate($ibuKey, $dataIbu);
                    $existing->orangTuas()->syncWithoutDetaching([$ibu->id => ['hubungan_keluarga' => 'Ibu']]);
                }
                if ($dataWali['nama_wali']) {
                    $waliKey = $dataWali['nik_wali']
                        ? ['nik_wali' => $dataWali['nik_wali']]
                        : ['nama_wali' => $dataWali['nama_wali'], 'nama_ayah' => null, 'nama_ibu' => null];
                    $wali = OrangTua::firstOrCreate($waliKey, $dataWali);
                    $existing->orangTuas()->syncWithoutDetaching([$wali->id => ['hubungan_keluarga' => 'Wali']]);
                }

                $this->stats['updated']++;
                return;
            }

            // INSERT
            $foto = $this->resolveFoto($nisn, $nis, $nama);
            $data['foto'] = $foto;

            $siswa = Siswa::create($data);
            $siswa->dataTambahan()->create($dataTambahan);
            $siswa->programKesejahteraan()->create($programKesejahteraan);

            if ($dataAyah['nama_ayah']) {
                // BUG FIX: gunakan NIK sebagai unique key jika tersedia, bukan nama (bisa duplikat)
                $ayahKey = $dataAyah['nik_ayah']
                    ? ['nik_ayah' => $dataAyah['nik_ayah']]
                    : ['nama_ayah' => $dataAyah['nama_ayah'], 'nama_ibu' => null, 'nama_wali' => null];
                $ayah = OrangTua::firstOrCreate($ayahKey, $dataAyah);
                $siswa->orangTuas()->attach($ayah->id, ['hubungan_keluarga' => 'Ayah']);
            }
            if ($dataIbu['nama_ibu']) {
                $ibuKey = $dataIbu['nik_ibu']
                    ? ['nik_ibu' => $dataIbu['nik_ibu']]
                    : ['nama_ibu' => $dataIbu['nama_ibu'], 'nama_ayah' => null, 'nama_wali' => null];
                $ibu = OrangTua::firstOrCreate($ibuKey, $dataIbu);
                $siswa->orangTuas()->attach($ibu->id, ['hubungan_keluarga' => 'Ibu']);
            }
            if ($dataWali['nama_wali']) {
                $waliKey = $dataWali['nik_wali']
                    ? ['nik_wali' => $dataWali['nik_wali']]
                    : ['nama_wali' => $dataWali['nama_wali'], 'nama_ayah' => null, 'nama_ibu' => null];
                $wali = OrangTua::firstOrCreate($waliKey, $dataWali);
                $siswa->orangTuas()->attach($wali->id, ['hubungan_keluarga' => 'Wali']);
            }

            $this->stats['inserted']++;
        });

        return null; // sudah di-handle manual dalam transaction
    }

    // ── Helper: resolve foto ───────────────────────────────────────────────

    private function resolveFoto(string $nisn, string $nis, string $nama, bool $countAvatar = true): ?string
    {
        if (!empty($this->fotoMap)) {
            $candidates = array_filter([
                $nisn ? strtolower(trim($nisn)) : null,
                $nis ? strtolower(trim($nis)) : null,
                $nama ? strtolower(Str::slug($nama)) : null,
            ]);

            foreach ($candidates as $stem) {
                if (isset($this->fotoMap[$stem])) {
                    $fullPath = $this->fotoMap[$stem];
                    $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
                    $dest = 'foto_siswa/' . Str::uuid() . ".{$ext}";
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

    // ── Helper: resolve kelas ──────────────────────────────────────────────

    private function resolveKelas(string $raw): ?int
    {
        $raw = trim($raw);
        if (!$raw)
            return null;
        if (isset($this->kelasCache[$raw]))
            return $this->kelasCache[$raw];

        // Format: "1 A", "1-A", "1A"
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

    // ── Helper: parse ──────────────────────────────────────────────────────

    private function parseJK(string $raw): string
    {
        return strtoupper(substr(trim($raw), 0, 1)) === 'L' ? 'L' : 'P';
    }

    private function parseUnsignedInt(mixed $value): ?int
    {
        if ($value === null || trim((string) $value) === '')
            return null;
        $int = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        return $int > 0 ? $int : null;
    }

    /**
     * Ambil tahun dari string tanggal (YYYY-MM-DD, DD/MM/YYYY, dll.)
     * atau langsung nilai 4-digit angka.
     */
    private function parseTahun(mixed $value): ?int
    {
        if ($value === null || trim((string) $value) === '')
            return null;

        // Kalau sudah 4-digit angka → langsung tahun
        $str = trim((string) $value);
        if (preg_match('/^\d{4}$/', $str)) {
            return (int) $str;
        }

        // Coba parse sebagai tanggal lalu ambil tahunnya
        $date = $this->parseDate($value);
        if ($date) {
            return (int) substr($date, 0, 4);
        }

        return null;
    }

    private function parseDecimal(mixed $value): ?float
    {
        if ($value === null || trim((string) $value) === '')
            return null;
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
        if (!$value)
            return null;

        // Serial number Excel
        if (is_numeric($value)) {
            try {
                return \PhpOffice\PhpSpreadsheet\Shared\Date
                    ::excelToDateTimeObject((float) $value)->format('Y-m-d');
            } catch (\Throwable) {
            }
        }

        $value = trim((string) $value);
        foreach (['d/m/Y', 'd-m-Y', 'Y-m-d', 'd/m/y', 'd-m-y'] as $fmt) {
            $dt = \DateTime::createFromFormat($fmt, $value);
            if ($dt && $dt->format($fmt) === $value) {
                return $dt->format('Y-m-d');
            }
        }

        return null;
    }

    private function parseString(mixed $value): ?string
    {
        if ($value === null)
            return null;
        $str = trim((string) $value);
        if ($str === '')
            return null;

        $str = str_ireplace(['rp. ', 'rp.'], 'rp ', $str);
        $str = ucwords(strtolower($str));

        $str = str_replace(
            ['Sd ', 'Smp ', 'Sma ', 'D1 ', 'D2 ', 'D3 ', 'D4 ', 'S1 ', 'S2 ', 'S3 ', 'Rp '],
            ['SD ', 'SMP ', 'SMA ', 'D1 ', 'D2 ', 'D3 ', 'D4 ', 'S1 ', 'S2 ', 'S3 ', 'Rp '],
            $str . ' '
        );

        return trim($str);
    }

    // ── Interface methods ──────────────────────────────────────────────────

    public function rules(): array
    {
        return [];
    }
    public function chunkSize(): int
    {
        return 200;
    }
    public function getStats(): array
    {
        return $this->stats;
    }
}