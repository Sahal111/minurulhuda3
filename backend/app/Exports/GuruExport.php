<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GuruExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize,
    WithTitle,
    WithColumnFormatting,
    WithEvents
{
    // kolom yang harus jadi teks (huruf kolom => index array di map(), 0-based)
    private const TEXT_COLUMNS = [
        'A' => 0,  // NUPTK
        'C' => 2,  // NIP
        'D' => 3,  // NPWP
        'AM' => 38,  // NIK
        'AN' => 39,  // NO_KK
        'AW' => 48,  // NO_REKENING
    ];

    private string $search;
    private string $jabatan;
    private string $status;
    private string $statusKepegawaian;
    private string $sertifikasi;
    // simpan data per baris agar AfterSheet bisa set TYPE_STRING
    private array $mappedRows = [];

    public function __construct(
        string $search = '',
        string $jabatan = 'semua',
        string $status = 'semua',
        string $statusKepegawaian = 'semua',
        string $sertifikasi = ''
    ) {
        $this->search = $search;
        $this->jabatan = $jabatan;
        $this->status = $status;
        $this->statusKepegawaian = $statusKepegawaian;
        $this->sertifikasi = $sertifikasi;
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'AM' => NumberFormat::FORMAT_TEXT,
            'AN' => NumberFormat::FORMAT_TEXT,
            'AW' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                foreach (self::TEXT_COLUMNS as $col => $_) {
                    // Set format teks untuk seluruh kolom data (baris 2 ke bawah)
                    $sheet
                        ->getStyle("{$col}2:{$col}{$lastRow}")
                        ->getNumberFormat()
                        ->setFormatCode(NumberFormat::FORMAT_TEXT);

                    // Set ulang setiap cell sebagai TYPE_STRING eksplisit
                    for ($row = 2; $row <= $lastRow; $row++) {
                        $cell = $sheet->getCell("{$col}{$row}");
                        $value = $cell->getValue();
                        if ($value !== null && $value !== '') {
                            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
                        }
                    }
                }
            },
        ];
    }

    public function query()
    {
        $query = Guru::with(['kelasWali', 'currentJabatan', 'rekening', 'keluarga', 'pendidikans', 'sertifikasis']);

        if ($this->search) {
            $query->search($this->search);
        }

        if ($this->jabatan !== 'semua') {
            $map = [
                'guru' => 'Guru Kelas',
                'wali' => 'Wali Kelas',
                'kepala' => 'Kepala Sekolah',
                'staf' => 'Staf TU',
            ];
            $val = $map[$this->jabatan] ?? $this->jabatan;
            $query->whereHas('jabatans', fn($q) => $q->where('jabatan', $val)->where('is_current', true));
        }

        if ($this->statusKepegawaian !== 'semua') {
            $query->whereHas('jabatans', fn($q) => $q->where('status_kepegawaian', $this->statusKepegawaian)->where('is_current', true));
        }

        if ($this->status !== 'semua') {
            $query->where('status_aktif', $this->status === 'tetap' ? 1 : 0);
        }

        if ($this->sertifikasi === 'sudah') {
            $query->has('sertifikasis');
        } elseif ($this->sertifikasi === 'belum') {
            $query->doesntHave('sertifikasis');
        }

        return $query->latest();
    }

    public function headings(): array
    {
        return [
            'NUPTK',
            'NAMA',
            'NIP',
            'NPWP',
            'TEMPAT_LAHIR',
            'TANGGAL_LAHIR',
            'JENIS_KELAMIN',
            'AGAMA',
            'ALAMAT',
            'NO_HP',
            'EMAIL',
            'PENDIDIKAN_TERAKHIR',
            'JURUSAN_TERAKHIR',
            'KAMPUS_TERAKHIR',
            'TAHUN_LULUS',
            'NO_IJAZAH',
            'MATA_PELAJARAN',
            'KELAS',
            'TAHUN_MENGAJAR',
            'STATUS_KEPEGAWAIAN',
            'JABATAN',
            'STATUS_AKTIF',
            'GOLONGAN',
            'SK_PENGANGKATAN',
            'TANGGAL_SK',
            'TANGGAL_BERGABUNG',
            'TMT_JABATAN',
            'TANGGAL_SELESAI_JABATAN',
            'TMT_PNS',
            'TMT_GTY',
            'NO_SERTIFIKASI',
            'TAHUN_SERTIFIKASI',
            'BIDANG_SERTIFIKASI',
            'NRG',
            'TANGGAL_TERBIT_SERTIFIKASI',
            'EXPIRED_SERTIFIKASI',
            'GAJI_POKOK',
            'TUNJANGAN_FUNGSIONAL',
            'NIK',
            'NO_KK',
            'GOLONGAN_DARAH',
            'NAMA_IBU_KANDUNG',
            'STATUS_PERKAWINAN',
            'NAMA_PASANGAN',
            'PEKERJAAN_PASANGAN',
            'JUMLAH_ANAK',
            'NO_KARPEG',
            'NO_KARIS_KARSU',
            'NO_REKENING',
            'NAMA_BANK',
            'CABANG_BANK',
            'ATAS_NAMA_REKENING',
        ];
    }

    public function map($guru): array
    {
        $j = $guru->currentJabatan;
        $rek = $guru->rekening;
        $kel = $guru->keluarga;

        $jenjangOrder = [
            'S3 - Doktor' => 5,
            'S2 - Magister' => 4,
            'S1 - Sarjana' => 3,
            'D3 - Diploma' => 2,
            'SMA / MA' => 1,
        ];

        $pendidikanTerakhir = $guru
            ->pendidikans
            ->filter(fn($p) => isset($jenjangOrder[$p->jenjang]))
            ->sortByDesc(fn($p) => $jenjangOrder[$p->jenjang])
            ->first();

        $cert = $guru->sertifikasis->first();

        return [
            (string) $guru->nuptk,  // A  - NUPTK   → paksa string
            $guru->nama,
            (string) $guru->nip,  // C  - NIP      → paksa string
            (string) $rek?->npwp,  // D  - NPWP     → paksa string
            $guru->tempat_lahir,
            $guru->tanggal_lahir?->format('Y-m-d'),
            $guru->jenis_kelamin,
            $guru->agama,
            $guru->alamat,
            $guru->no_hp,
            $guru->email,
            $pendidikanTerakhir?->jenjang,
            $pendidikanTerakhir?->jurusan,
            $pendidikanTerakhir?->nama_sekolah,
            $pendidikanTerakhir?->tahun_lulus,
            $pendidikanTerakhir?->no_ijazah,
            $guru->mapel,
            $guru->kelas,
            $guru->tahun_mengajar,
            $j?->status_kepegawaian,
            $j?->jabatan,
            $guru->status_aktif ? 'Aktif' : 'Tidak Aktif',
            $j?->golongan,
            $j?->sk_nomor,
            $j?->sk_tanggal?->format('Y-m-d'),
            $guru->tanggal_bergabung?->format('Y-m-d'),
            $j?->tmt_jabatan instanceof \Carbon\Carbon ? $j->tmt_jabatan->format('Y-m-d') : $j?->tmt_jabatan,
            $j?->tanggal_selesai instanceof \Carbon\Carbon ? $j->tanggal_selesai->format('Y-m-d') : $j?->tanggal_selesai,
            $guru->tmt_pns?->format('Y-m-d'),
            $guru->tmt_gty?->format('Y-m-d'),
            $cert?->no_sertifikat,
            $cert?->tahun_sertifikasi,
            $cert?->bidang_studi,
            $cert?->nrg,
            $cert?->tanggal_terbit instanceof \Carbon\Carbon ? $cert->tanggal_terbit->format('Y-m-d') : $cert?->tanggal_terbit,
            $cert?->expired_at instanceof \Carbon\Carbon ? $cert->expired_at->format('Y-m-d') : $cert?->expired_at,
            $rek?->gaji_pokok,
            $rek?->tunjangan_fungsional,
            (string) $guru->nik,  // AL - NIK       → paksa string
            (string) $guru->no_kk,  // AM - NO_KK     → paksa string
            $guru->golongan_darah,
            $guru->nama_ibu_kandung,
            $kel?->status_perkawinan,
            $kel?->nama_pasangan,
            $kel?->pekerjaan_pasangan,
            $kel?->jumlah_anak,
            $guru->no_karpeg,
            $guru->no_karis_karsu,
            (string) $rek?->no_rekening,  // AV - NO_REKENING → paksa string
            $rek?->nama_bank,
            $rek?->cabang,
            $rek?->atas_nama,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF059669']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }

    public function title(): string
    {
        return 'Data Guru & Staf';
    }
}
