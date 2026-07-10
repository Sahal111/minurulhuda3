<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaTemplateExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    public function array(): array
    {
        return [
            [
                '1234567890',        // NISN
                '1001',              // NIS
                'Budi Santoso',      // NAMA_LENGKAP
                '3201012345678901',  // NIK
                '3201011234567890',  // NO_KK
                'WNI',               // KEWARGANEGARAAN
                'AL.2024.000123',    // NO_REGISTRASI_AKTA_KELAHIRAN
                'L',                 // JENIS_KELAMIN_L_P
                'Jakarta',           // TEMPAT_LAHIR
                '2015-05-14',        // TANGGAL_LAHIR
                'Islam',             // AGAMA
                'A',                 // GOLONGAN_DARAH
                '125',               // TINGGI_BADAN_CM
                '25',                // BERAT_BADAN_KG
                '51.5',              // LINGKAR_KEPALA_CM
                '',                  // KEBUTUHAN_KHUSUS
                '1 A',               // KELAS
                'aktif',             // STATUS_SISWA
                'Tono Santoso',      // NAMA_AYAH
                'Wiraswasta',        // PEKERJAAN_AYAH
                '3201019876543210',  // NIK_AYAH
                '1975',              // TAHUN_LAHIR_AYAH
                'SMA / Sederajat',   // PENDIDIKAN_AYAH
                '',                  // KEBUTUHAN_KHUSUS_AYAH
                'Siti',              // NAMA_IBU
                'Ibu Rumah Tangga',  // PEKERJAAN_IBU
                '3201019876543211',  // NIK_IBU
                '1980',              // TAHUN_LAHIR_IBU
                'D4 / S1',           // PENDIDIKAN_IBU
                '',                  // KEBUTUHAN_KHUSUS_IBU
                '08123456789',       // NO_HP_ORTU
                'Jl. Merdeka No 1',  // ALAMAT
                'Rp 2.000.000 - Rp 4.999.999',  // PENGHASILAN_AYAH
                'Rp 1.000.000 - Rp 1.999.999',  // PENGHASILAN_IBU
                'Ahmad Wali',        // NAMA_WALI
                'Pedagang',          // PEKERJAAN_WALI
                'SMA / Sederajat',   // PENDIDIKAN_WALI
                'Rp 2.000.000 - Rp 4.999.999',  // PENGHASILAN_WALI
                '08198765432',       // NO_HP_WALI
                'Jl. Melati No 3',   // ALAMAT_WALI
                'SDN 1 Jakarta',     // ASAL_SEKOLAH
                '2024-07-15',        // TANGGAL_MASUK
                'Jl. Kenangan No 5', // ALAMAT_SISWA
                '003',               // RT
                '005',               // RW
                'Sukamaju',          // KELURAHAN
                'Cilandak',          // KECAMATAN
                '12345',             // KODE_POS
                '-6.26000000',       // LINTANG
                '106.81000000',      // BUJUR
                '2',                 // ANAK_KE
                '3',                 // JUMLAH_SAUDARA
                '2.5',               // JARAK_TEMPAT_TINGGAL
                '15',                // WAKTU_TEMPUH
                'Sepeda Motor',      // MODA_TRANSPORTASI
                'Membaca',           // HOBI
                'Dokter',            // CITA_CITA
                '021123456',         // NO_TELP_SISWA
                '081212121212',      // HP_SISWA
                'budi@example.test', // EMAIL_SISWA
                'Ya',                // PENERIMA_KPS_PKH
                'KPS123456',         // NO_KPS_PKH
                'Ya',                // LAYAK_PIP
                'Keluarga kurang mampu', // ALASAN_LAYAK_PIP
                'Ya',                // PENERIMA_KIP
                'KIP123456',         // NO_KIP
                'Budi Santoso',      // NAMA_TERTERA_DI_KIP
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'NISN',
            'NIS',
            'NAMA_LENGKAP',
            'NIK',
            'NO_KK',
            'KEWARGANEGARAAN',
            'NO_REGISTRASI_AKTA_KELAHIRAN',
            'JENIS_KELAMIN_L_P',
            'TEMPAT_LAHIR',
            'TANGGAL_LAHIR',
            'AGAMA',
            'GOLONGAN_DARAH',
            'TINGGI_BADAN_CM',
            'BERAT_BADAN_KG',
            'LINGKAR_KEPALA_CM',
            'KEBUTUHAN_KHUSUS',
            'KELAS',
            'STATUS_SISWA',
            'NAMA_AYAH',
            'PEKERJAAN_AYAH',
            'NIK_AYAH',
            'TAHUN_LAHIR_AYAH',
            'PENDIDIKAN_AYAH',
            'KEBUTUHAN_KHUSUS_AYAH',
            'NAMA_IBU',
            'PEKERJAAN_IBU',
            'NIK_IBU',
            'TAHUN_LAHIR_IBU',
            'PENDIDIKAN_IBU',
            'KEBUTUHAN_KHUSUS_IBU',
            'NO_HP_ORTU',
            'ALAMAT',
            'PENGHASILAN_AYAH',
            'PENGHASILAN_IBU',
            'NAMA_WALI',
            'PEKERJAAN_WALI',
            'PENDIDIKAN_WALI',
            'PENGHASILAN_WALI',
            'NO_HP_WALI',
            'ALAMAT_WALI',
            'ASAL_SEKOLAH',
            'TANGGAL_MASUK',
            'ALAMAT_SISWA',
            'RT',
            'RW',
            'KELURAHAN',
            'KECAMATAN',
            'KODE_POS',
            'LINTANG',
            'BUJUR',
            'ANAK_KE',
            'JUMLAH_SAUDARA',
            'JARAK_TEMPAT_TINGGAL',
            'WAKTU_TEMPUH',
            'MODA_TRANSPORTASI',
            'HOBI',
            'CITA_CITA',
            'NO_TELP_SISWA',
            'HP_SISWA',
            'EMAIL_SISWA',
            'PENERIMA_KPS_PKH',
            'NO_KPS_PKH',
            'LAYAK_PIP',
            'ALASAN_LAYAK_PIP',
            'PENERIMA_KIP',
            'NO_KIP',
            'NAMA_TERTERA_DI_KIP',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '059669']]],
        ];
    }
}
