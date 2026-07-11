<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

/**
 * Template export siswa.
 *
 * Urutan kolom disesuaikan PERSIS dengan DATA_SISWA.xlsx (EMIS MI Nurul Huda 3):
 *
 * --- INFORMASI PESERTA DIDIK (Col 1–22) ---
 *  1  NO
 *  2  NAMA LENGKAP
 *  3  NISN
 *  4  NIS LOKAL
 *  5  KEWARGA NEGARAAN
 *  6  NIK SISWA
 *  7  TEMPAT LAHIR
 *  8  TANGGAL LAHIR
 *  9  JENIS KELAMIN
 * 10  KELAS
 * 11  KELAS PARAREL
 * 12  NO ABSEN
 * 13  JUMLAH SAUDARA
 * 14  ANAK KE
 * 15  CITA-CITA
 * 16  AGAMA
 * 17  NO. HP SISWA
 * 18  ALAMAT SISWA
 * 19  HOBI
 * 20  YANG MEMBIAYAI SEKOLAH
 * 21  Asal Sekolah
 * 22  IMUNISASI
 * 23  NOMOR KIP
 * 24  NOMOR KK
 * 25  NAMA KEPALA KELUARGA
 *
 * --- AYAH (Col 26–35) ---
 * 26  NAMA AYAH
 * 27  STATUS
 * 28  KEWARGANEGARAAN
 * 29  NIK AYAH
 * 30  TEMPAT LAHIR (AYAH)
 * 31  TANGGAL LAHIR (AYAH)
 * 32  PENDIDIKAN TERAKHIR (AYAH)
 * 33  PEKERJAAN UTAMA (AYAH)
 * 34  PENGHASILAN PERBULAN (AYAH)
 * 35  NO. HP AYAH
 *
 * --- IBU (Col 36–45) ---
 * 36  NAMA IBU
 * 37  STATUS
 * 38  KEWARGANEGARAAN
 * 39  NIK IBU
 * 40  TEMPAT LAHIR (IBU)
 * 41  TANGGAL LAHIR (IBU)
 * 42  PENDIDIKAN TERAKHIR (IBU)
 * 43  PEKERJAAN UTAMA (IBU)
 * 44  PENGHASILAN PERBULAN (IBU)
 * 45  NO. HP IBU
 *
 * --- WALI (Col 46–55) ---
 * 46  NAMA WALI
 * 47  STATUS
 * 48  KEWARGA NEGARAAN
 * 49  NIK (WALI)
 * 50  TEMPAT LAHIR (WALI)
 * 51  TANGGAL LAHIR (WALI)
 * 52  PENDIDIKAN TERAKHIR (WALI)
 * 53  PEKERJAAN UTAMA (WALI)
 * 54  PENGHASILAN PERBULAN (WALI)
 * 55  NO. HP WALI
 *
 * --- ALAMAT AYAH KANDUNG (Col 56–65) ---
 * 56  AYAH KANDUNG
 * 57  STATUS KEPEMILIKAN
 * 58  PROVINSI
 * 59  KAB
 * 60  KEC
 * 61  KELURAHAN / DESA
 * 62  RT
 * 63  RW
 * 64  ALAMAT
 * 65  KODE POS
 *
 * --- ALAMAT IBU KANDUNG (Col 66–75) ---
 * 66  IBU KANDUNG
 * 67  STATUS KEPEMILIKAN
 * 68  PROVINSI
 * 69  KAB
 * 70  KEC
 * 71  KELURAHAN / DESA
 * 72  RT
 * 73  RW
 * 74  ALAMAT
 * 75  KODE POS
 *
 * --- ALAMAT WALI (Col 76–85) ---
 * 76  WALI
 * 77  STATUS KEPEMILIKAN
 * 78  PROVINSI
 * 79  KAB
 * 80  KEC
 * 81  KELURAHAN / DESA
 * 82  RT
 * 83  RW
 * 84  ALAMAT
 * 85  KODE POS
 *
 * --- ASAL SEKOLAH (Col 86–89) ---
 * 86  URUT
 * 87  NSM ASAL
 * 88  NPSN ASAL
 * 89  NAMA MADRASAH ASAL
 */
class SiswaTemplateExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    public function array(): array
    {
        return [
            [
                // ── INFORMASI PESERTA DIDIK ──────────────────────────
                '1',                        // NO
                'Budi Santoso',             // NAMA LENGKAP
                '1234567890',               // NISN
                '1001',                     // NIS LOKAL
                'WNI',                      // KEWARGA NEGARAAN
                '3201012345678901',         // NIK SISWA
                'Jakarta',                  // TEMPAT LAHIR
                '2015-05-14',               // TANGGAL LAHIR
                'L',                        // JENIS KELAMIN (L/P)
                '1',                        // KELAS
                'A',                        // KELAS PARAREL
                '1',                        // NO ABSEN
                '3',                        // JUMLAH SAUDARA
                '2',                        // ANAK KE
                'Dokter',                   // CITA-CITA
                'Islam',                    // AGAMA
                '081212121212',             // NO. HP SISWA
                'Jl. Kenangan No. 5',       // ALAMAT SISWA
                'Membaca',                  // HOBI
                'Orang Tua',                // YANG MEMBIAYAI SEKOLAH
                'SDN 1 Jakarta',            // Asal Sekolah
                'Lengkap',                  // IMUNISASI
                'KIP123456',                // NOMOR KIP
                '3201011234567890',         // NOMOR KK
                'Tono Santoso',             // NAMA KEPALA KELUARGA

                // ── AYAH ─────────────────────────────────────────────
                'Tono Santoso',             // NAMA AYAH
                'Kandung',                  // STATUS
                'WNI',                      // KEWARGANEGARAAN
                '3201019876543210',         // NIK AYAH
                'Jakarta',                  // TEMPAT LAHIR (AYAH)
                '1975-03-10',               // TANGGAL LAHIR (AYAH)
                'SMA / Sederajat',          // PENDIDIKAN TERAKHIR (AYAH)
                'Wiraswasta',               // PEKERJAAN UTAMA (AYAH)
                'Rp 2.000.000 - Rp 4.999.999', // PENGHASILAN PERBULAN (AYAH)
                '08123456789',              // NO. HP AYAH

                // ── IBU ──────────────────────────────────────────────
                'Siti Rahayu',              // NAMA IBU
                'Kandung',                  // STATUS
                'WNI',                      // KEWARGANEGARAAN
                '3201019876543211',         // NIK IBU
                'Bogor',                    // TEMPAT LAHIR (IBU)
                '1980-07-20',               // TANGGAL LAHIR (IBU)
                'D4 / S1',                  // PENDIDIKAN TERAKHIR (IBU)
                'Ibu Rumah Tangga',         // PEKERJAAN UTAMA (IBU)
                'Rp 1.000.000 - Rp 1.999.999', // PENGHASILAN PERBULAN (IBU)
                '08129876543',              // NO. HP IBU

                // ── WALI ─────────────────────────────────────────────
                'Ahmad Wali',               // NAMA WALI
                'Paman',                    // STATUS
                'WNI',                      // KEWARGA NEGARAAN
                '3201019876543299',         // NIK (WALI)
                'Depok',                    // TEMPAT LAHIR (WALI)
                '1978-11-05',               // TANGGAL LAHIR (WALI)
                'SMA / Sederajat',          // PENDIDIKAN TERAKHIR (WALI)
                'Pedagang',                 // PEKERJAAN UTAMA (WALI)
                'Rp 2.000.000 - Rp 4.999.999', // PENGHASILAN PERBULAN (WALI)
                '08198765432',              // NO. HP WALI

                // ── ALAMAT AYAH KANDUNG ───────────────────────────────
                'Tono Santoso',             // AYAH KANDUNG
                'Kontrak',                  // STATUS KEPEMILIKAN
                'DKI Jakarta',              // PROVINSI
                'Jakarta Selatan',          // KAB
                'Cilandak',                 // KEC
                'Sukamaju',                 // KELURAHAN / DESA
                '003',                      // RT
                '005',                      // RW
                'Jl. Merdeka No. 1',        // ALAMAT
                '12345',                    // KODE POS

                // ── ALAMAT IBU KANDUNG ────────────────────────────────
                'Siti Rahayu',              // IBU KANDUNG
                'Milik Sendiri',            // STATUS KEPEMILIKAN
                'DKI Jakarta',              // PROVINSI
                'Jakarta Selatan',          // KAB
                'Cilandak',                 // KEC
                'Sukamaju',                 // KELURAHAN / DESA
                '003',                      // RT
                '005',                      // RW
                'Jl. Merdeka No. 1',        // ALAMAT
                '12345',                    // KODE POS

                // ── ALAMAT WALI ───────────────────────────────────────
                'Ahmad Wali',               // WALI
                'Sewa',                     // STATUS KEPEMILIKAN
                'Jawa Barat',               // PROVINSI
                'Depok',                    // KAB
                'Sukmajaya',                // KEC
                'Mekar Jaya',               // KELURAHAN / DESA
                '001',                      // RT
                '002',                      // RW
                'Jl. Melati No. 3',         // ALAMAT
                '16411',                    // KODE POS

                // ── ASAL SEKOLAH ──────────────────────────────────────
                '1',                        // URUT
                '111231770001',             // NSM ASAL
                '20100001',                 // NPSN ASAL
                'SDN 1 Jakarta',            // NAMA MADRASAH ASAL
            ],
        ];
    }

    public function headings(): array
    {
        return [
            // ── INFORMASI PESERTA DIDIK ──────────────────────────
            'NO',
            'NAMA LENGKAP',
            'NISN',
            'NIS LOKAL',
            'KEWARGA NEGARAAN',
            'NIK SISWA',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'JENIS KELAMIN',
            'KELAS',
            'KELAS PARAREL',
            'NO ABSEN',
            'JUMLAH SAUDARA',
            'ANAK KE',
            'CITA-CITA',
            'AGAMA',
            'NO. HP SISWA',
            'ALAMAT SISWA',
            'HOBI',
            'YANG MEMBIAYAI SEKOLAH',
            'Asal Sekolah',
            'IMUNISASI',
            'NOMOR KIP',
            'NOMOR KK',
            'NAMA KEPALA KELUARGA',

            // ── AYAH ─────────────────────────────────────────────
            'NAMA AYAH',
            'STATUS',
            'KEWARGANEGARAAN',
            'NIK AYAH',
            'TEMPAT LAHIR (AYAH)',
            'TANGGAL LAHIR (AYAH)',
            'PENDIDIKAN TERAKHIR (AYAH)',
            'PEKERJAAN UTAMA (AYAH)',
            'PENGHASILAN PERBULAN (AYAH)',
            'NO. HP AYAH',

            // ── IBU ──────────────────────────────────────────────
            'NAMA IBU',
            'STATUS',
            'KEWARGANEGARAAN',
            'NIK IBU',
            'TEMPAT LAHIR (IBU)',
            'TANGGAL LAHIR (IBU)',
            'PENDIDIKAN TERAKHIR (IBU)',
            'PEKERJAAN UTAMA (IBU)',
            'PENGHASILAN PERBULAN (IBU)',
            'NO. HP IBU',

            // ── WALI ─────────────────────────────────────────────
            'NAMA WALI',
            'STATUS',
            'KEWARGA NEGARAAN',
            'NIK (WALI)',
            'TEMPAT LAHIR (WALI)',
            'TANGGAL LAHIR (WALI)',
            'PENDIDIKAN TERAKHIR (WALI)',
            'PEKERJAAN UTAMA (WALI)',
            'PENGHASILAN PERBULAN (WALI)',
            'NO. HP WALI',

            // ── ALAMAT AYAH KANDUNG ───────────────────────────────
            'AYAH KANDUNG',
            'STATUS KEPEMILIKAN',
            'PROVINSI',
            'KAB',
            'KEC',
            'KELURAHAN / DESA',
            'RT',
            'RW',
            'ALAMAT',
            'KODE POS',

            // ── ALAMAT IBU KANDUNG ────────────────────────────────
            'IBU KANDUNG',
            'STATUS KEPEMILIKAN',
            'PROVINSI',
            'KAB',
            'KEC',
            'KELURAHAN / DESA',
            'RT',
            'RW',
            'ALAMAT',
            'KODE POS',

            // ── ALAMAT WALI ───────────────────────────────────────
            'WALI',
            'STATUS KEPEMILIKAN',
            'PROVINSI',
            'KAB',
            'KEC',
            'KELURAHAN / DESA',
            'RT',
            'RW',
            'ALAMAT',
            'KODE POS',

            // ── ASAL SEKOLAH ──────────────────────────────────────
            'URUT',
            'NSM ASAL',
            'NPSN ASAL',
            'NAMA MADRASAH ASAL',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '059669'],
                ],
            ],
        ];
    }
}