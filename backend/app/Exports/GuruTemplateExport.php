<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GuruTemplateExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize, WithColumnFormatting, WithEvents
{
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // A=NUPTK, C=NIP, D=NPWP, AM=NIK, AN=NO_KK, AW=NO_REKENING
                $textColumns = ['A', 'C', 'D', 'AM', 'AN', 'AW'];  // ← fix

                foreach ($textColumns as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                    $sheet
                        ->getStyle("{$col}2:{$col}1000")
                        ->getNumberFormat()
                        ->setFormatCode(NumberFormat::FORMAT_TEXT);
                }

                foreach ($textColumns as $col) {
                    $cell = $sheet->getCell("{$col}2");
                    $cell->setValueExplicit($cell->getValue(), DataType::TYPE_STRING);
                }
            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,  // NUPTK
            'C' => NumberFormat::FORMAT_TEXT,  // NIP
            'D' => NumberFormat::FORMAT_TEXT,  // NPWP
            'AM' => NumberFormat::FORMAT_TEXT,  // NIK        ← fix
            'AN' => NumberFormat::FORMAT_TEXT,  // NO_KK      ← fix
            'AW' => NumberFormat::FORMAT_TEXT,  // NO_REKENING ← fix
        ];
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

    public function array(): array
    {
        return [[
            '1234567890123456',  // NUPTK
            'Ahmad Fauzi, S.Pd',  // NAMA
            '198001012005011001',  // NIP
            '12.345.678.9-012.000',  // NPWP
            'Jakarta',  // TEMPAT_LAHIR
            '1980-01-01',  // TANGGAL_LAHIR
            'Laki-laki',  // JENIS_KELAMIN
            'Islam',  // AGAMA
            'Jl. Pendidikan No 1, RT 01/RW 02',  // ALAMAT
            '081234567890',  // NO_HP
            'ahmad@sekolah.id',  // EMAIL
            'S1 - Sarjana',  // PENDIDIKAN_TERAKHIR
            'Pendidikan Agama Islam',  // JURUSAN_TERAKHIR
            'UIN Jakarta',  // KAMPUS_TERAKHIR
            '2003',  // TAHUN_LULUS
            'IJZ/S1/2003/001',  // NO_IJAZAH
            'Pendidikan Agama Islam',  // MATA_PELAJARAN
            '1A',  // KELAS
            '2005',  // TAHUN_MENGAJAR
            'PNS',  // STATUS_KEPEGAWAIAN
            'Guru Kelas',  // JABATAN
            'Aktif',  // STATUS_AKTIF
            'III/a',  // GOLONGAN
            'SK/2005/001',  // SK_PENGANGKATAN
            '2005-01-01',  // TANGGAL_SK
            '2005-01-01',  // TANGGAL_BERGABUNG
            '2005-01-01',  // TMT_JABATAN
            '',  // TANGGAL_SELESAI_JABATAN
            '2005-01-01',  // TMT_PNS
            '',  // TMT_GTY
            'SRT/2010/001',  // NO_SERTIFIKASI
            '2010',  // TAHUN_SERTIFIKASI
            'Guru Kelas SD/MI',  // BIDANG_SERTIFIKASI
            '12345678901234',  // NRG
            '2010-06-01',  // TANGGAL_TERBIT_SERTIFIKASI
            '',  // EXPIRED_SERTIFIKASI
            '5000000',  // GAJI_POKOK
            '',  // TUNJANGAN_FUNGSIONAL
            '3276000000000001',  // NIK
            '3276000000000002',  // NO_KK
            'O',  // GOLONGAN_DARAH
            'Siti Aminah',  // NAMA_IBU_KANDUNG
            'Menikah',  // STATUS_PERKAWINAN
            'Siti Khodijah',  // NAMA_PASANGAN
            'Wiraswasta',  // PEKERJAAN_PASANGAN
            '2',  // JUMLAH_ANAK
            'K123456',  // NO_KARPEG
            'KK123456',  // NO_KARIS_KARSU
            '1234567890',  // NO_REKENING
            'BRI',  // NAMA_BANK
            'Cabang Bogor',  // CABANG_BANK
            'Ahmad Fauzi',  // ATAS_NAMA_REKENING
        ]];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '059669']]],
        ];
    }
}
