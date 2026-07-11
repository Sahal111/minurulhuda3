<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SiswaExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithColumnWidths,
    WithTitle
{
    public function __construct(
        private string $status  = 'all',
        private ?int   $kelasId = null,
        private string $keyword = ''
    ) {}

    public function query()
    {
        return Siswa::with(['kelas', 'orangTuas', 'dataTambahan', 'programKesejahteraan', 'perkembangans'])
            ->when($this->status  !== 'all', fn($q) => $q->where('status', $this->status))
            ->when($this->kelasId,           fn($q) => $q->where('kelas_id', $this->kelasId))
            ->when($this->keyword,           fn($q) => $q->search($this->keyword))
            ->orderBy('nama');
    }

    public function headings(): array
    {
        return [
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

            'NAMA AYAH',
            'STATUS AYAH',
            'KEWARGANEGARAAN AYAH',
            'NIK AYAH',
            'TEMPAT LAHIR (AYAH)',
            'TANGGAL LAHIR (AYAH)',
            'PENDIDIKAN TERAKHIR (AYAH)',
            'PEKERJAAN UTAMA (AYAH)',
            'PENGHASILAN PERBULAN (AYAH)',
            'NO. HP AYAH',

            'NAMA IBU',
            'STATUS IBU',
            'KEWARGANEGARAAN IBU',
            'NIK IBU',
            'TEMPAT LAHIR (IBU)',
            'TANGGAL LAHIR (IBU)',
            'PENDIDIKAN TERAKHIR (IBU)',
            'PEKERJAAN UTAMA (IBU)',
            'PENGHASILAN PERBULAN (IBU)',
            'NO. HP IBU',

            'NAMA WALI',
            'STATUS WALI',
            'KEWARGANEGARAAN WALI',
            'NIK (WALI)',
            'TEMPAT LAHIR (WALI)',
            'TANGGAL LAHIR (WALI)',
            'PENDIDIKAN TERAKHIR (WALI)',
            'PEKERJAAN UTAMA (WALI)',
            'PENGHASILAN PERBULAN (WALI)',
            'NO. HP WALI',

            'AYAH KANDUNG',
            'STATUS KEPEMILIKAN AYAH',
            'PROVINSI AYAH',
            'KAB AYAH',
            'KEC AYAH',
            'KELURAHAN AYAH',
            'RT AYAH',
            'RW AYAH',
            'ALAMAT AYAH',
            'KODE POS AYAH',

            'IBU KANDUNG',
            'STATUS KEPEMILIKAN IBU',
            'PROVINSI IBU',
            'KAB IBU',
            'KEC IBU',
            'KELURAHAN IBU',
            'RT IBU',
            'RW IBU',
            'ALAMAT IBU',
            'KODE POS IBU',

            'WALI',
            'STATUS KEPEMILIKAN WALI',
            'PROVINSI WALI',
            'KAB WALI',
            'KEC WALI',
            'KELURAHAN WALI',
            'RT WALI',
            'RW WALI',
            'ALAMAT WALI',
            'KODE POS WALI',

            'URUT',
            'NSM ASAL',
            'NPSN ASAL',
            'NAMA MADRASAH ASAL',

            'GOLONGAN DARAH',
            'TINGGI BADAN (CM)',
            'BERAT BADAN (KG)',
            'LINGKAR KEPALA (CM)',
            'RIWAYAT PENYAKIT',
            'KEBUTUHAN KHUSUS SISWA',
            'KEBUTUHAN KHUSUS AYAH',
            'KEBUTUHAN KHUSUS IBU',
            'CATATAN KESEHATAN',

            'STATUS SISWA',
            'TANGGAL MASUK',
            'TAHUN AJARAN MASUK',

            'LINTANG',
            'BUJUR',
            'JARAK TEMPAT TINGGAL (KM)',
            'WAKTU TEMPUH (MENIT)',
            'MODA TRANSPORTASI',

            'NO TELP SISWA (RUMAH)',
            'EMAIL SISWA',

            'PENERIMA KPS/PKH',
            'NO KPS PKH',
            'LAYAK PIP',
            'ALASAN LAYAK PIP',
            'NAMA TERTERA DI KIP',

            'JENIS PENDAFTARAN',
            'NO SURAT MUTASI',
            'ALASAN MUTASI',

            'NO REGISTRASI AKTA KELAHIRAN',
        ];
    }

    private int $no = 0;

    public function map($s): array
{
    $this->no++;
    $fisik = $s->perkembangans->last();

    $ayah = $s->orangTuas->where('pivot.hubungan_keluarga', 'Ayah')->first();
    $ibu  = $s->orangTuas->where('pivot.hubungan_keluarga', 'Ibu')->first();
    $wali = $s->orangTuas->where('pivot.hubungan_keluarga', 'Wali')->first();

    return [
        // ── INFORMASI PESERTA DIDIK (1-25) ────────────────────
        $this->no,                                          // 1. NO
        $s->nama,                                           // 2. NAMA LENGKAP
        $s->nisn ?? '',                                     // 3. NISN
        $s->nis,                                            // 4. NIS LOKAL
        $s->dataTambahan?->kewarganegaraan ?? '',           // 5. KEWARGA NEGARAAN
        $s->nik ?? '',                                      // 6. NIK SISWA
        $s->tempat_lahir ?? '',                             // 7. TEMPAT LAHIR
        $s->tanggal_lahir?->format('Y-m-d') ?? '',          // 8. TANGGAL LAHIR
        $s->jenis_kelamin,                                  // 9. JENIS KELAMIN
        $s->kelas ? ($s->kelas->tingkat . ' ' . $s->kelas->nama_kelas) : '', // 10. KELAS
        $s->kelas_pararel ?? '',                            // 11. KELAS PARAREL
        $s->no_absen ?? '',                                 // 12. NO ABSEN
        $s->jumlah_saudara ?? '',                           // 13. JUMLAH SAUDARA
        $s->anak_ke ?? '',                                  // 14. ANAK KE
        $s->dataTambahan?->cita_cita ?? '',                 // 15. CITA-CITA
        $s->agama ?? '',                                    // 16. AGAMA
        $s->dataTambahan?->hp_siswa ?? '',                  // 17. NO. HP SISWA
        $s->alamat_siswa ?? '',                             // 18. ALAMAT SISWA
        $s->dataTambahan?->hobi ?? '',                      // 19. HOBI
        $s->pembiaya_sekolah ?? '',                         // 20. YANG MEMBIAYAI SEKOLAH
        $s->asal_sekolah ?? '',                             // 21. Asal Sekolah
        $s->imunisasi ?? '',                                // 22. IMUNISASI
        $s->programKesejahteraan?->no_kip ?? '',            // 23. NOMOR KIP
        $s->no_kk ?? '',                                    // 24. NOMOR KK
        $s->nama_kepala_keluarga ?? '',                     // 25. NAMA KEPALA KELUARGA

        // ── AYAH (26-35) ─────────────────────────────────────
        $ayah?->nama_ayah ?? '',                            // 26. NAMA AYAH
        $ayah?->status_ayah ?? '',                          // 27. STATUS AYAH
        $ayah?->kewarganegaraan_ayah ?? '',                 // 28. KEWARGANEGARAAN AYAH
        $ayah?->nik_ayah ?? '',                             // 29. NIK AYAH
        $ayah?->tempat_lahir_ayah ?? '',                    // 30. TEMPAT LAHIR (AYAH)
        $ayah?->tahun_lahir_ayah ?? '',                     // 31. TANGGAL LAHIR (AYAH)
        $ayah?->pendidikan_ayah ?? '',                      // 32. PENDIDIKAN TERAKHIR (AYAH)
        $ayah?->pekerjaan_ayah ?? '',                       // 33. PEKERJAAN UTAMA (AYAH)
        $ayah?->penghasilan_ayah ?? '',                     // 34. PENGHASILAN PERBULAN (AYAH)
        $ayah?->no_hp_ayah ?? '',                           // 35. NO. HP AYAH

        // ── IBU (36-45) ──────────────────────────────────────
        $ibu?->nama_ibu ?? '',                              // 36. NAMA IBU
        $ibu?->status_ibu ?? '',                            // 37. STATUS IBU
        $ibu?->kewarganegaraan_ibu ?? '',                   // 38. KEWARGANEGARAAN IBU
        $ibu?->nik_ibu ?? '',                               // 39. NIK IBU
        $ibu?->tempat_lahir_ibu ?? '',                      // 40. TEMPAT LAHIR (IBU)
        $ibu?->tahun_lahir_ibu ?? '',                       // 41. TANGGAL LAHIR (IBU)
        $ibu?->pendidikan_ibu ?? '',                        // 42. PENDIDIKAN TERAKHIR (IBU)
        $ibu?->pekerjaan_ibu ?? '',                         // 43. PEKERJAAN UTAMA (IBU)
        $ibu?->penghasilan_ibu ?? '',                       // 44. PENGHASILAN PERBULAN (IBU)
        $ibu?->no_hp_ibu ?? '',                             // 45. NO. HP IBU

        // ── WALI (46-55) ─────────────────────────────────────
        $wali?->nama_wali ?? '',                            // 46. NAMA WALI
        $wali?->status_wali ?? '',                          // 47. STATUS WALI
        $wali?->kewarganegaraan_wali ?? '',                 // 48. KEWARGANEGARAAN WALI
        $wali?->nik_wali ?? '',                             // 49. NIK (WALI)
        $wali?->tempat_lahir_wali ?? '',                    // 50. TEMPAT LAHIR (WALI)
        $wali?->tahun_lahir_wali ?? '',                     // 51. TANGGAL LAHIR (WALI)
        $wali?->pendidikan_wali ?? '',                      // 52. PENDIDIKAN TERAKHIR (WALI)
        $wali?->pekerjaan_wali ?? '',                       // 53. PEKERJAAN UTAMA (WALI)
        $wali?->penghasilan_wali ?? '',                     // 54. PENGHASILAN PERBULAN (WALI)
        $wali?->no_hp_wali ?? '',                           // 55. NO. HP WALI

        // ── ALAMAT AYAH KANDUNG (56-65) ──────────────────────
        $ayah?->nama_ayah ?? '',                            // 56. AYAH KANDUNG
        '',                                                 // 57. STATUS KEPEMILIKAN AYAH
        '',                                                 // 58. PROVINSI AYAH
        '',                                                 // 59. KAB AYAH
        '',                                                 // 60. KEC AYAH
        '',                                                 // 61. KELURAHAN AYAH
        '',                                                 // 62. RT AYAH
        '',                                                 // 63. RW AYAH
        $ayah?->alamat ?? '',                               // 64. ALAMAT AYAH
        '',                                                 // 65. KODE POS AYAH

        // ── ALAMAT IBU KANDUNG (66-75) ───────────────────────
        $ibu?->nama_ibu ?? '',                              // 66. IBU KANDUNG
        '',                                                 // 67. STATUS KEPEMILIKAN IBU
        '',                                                 // 68. PROVINSI IBU
        '',                                                 // 69. KAB IBU
        '',                                                 // 70. KEC IBU
        '',                                                 // 71. KELURAHAN IBU
        '',                                                 // 72. RT IBU
        '',                                                 // 73. RW IBU
        $ibu?->alamat ?? '',                                // 74. ALAMAT IBU
        '',                                                 // 75. KODE POS IBU

        // ── ALAMAT WALI (76-85) ──────────────────────────────
        $wali?->nama_wali ?? '',                            // 76. WALI
        '',                                                 // 77. STATUS KEPEMILIKAN WALI
        '',                                                 // 78. PROVINSI WALI
        '',                                                 // 79. KAB WALI
        '',                                                 // 80. KEC WALI
        '',                                                 // 81. KELURAHAN WALI
        '',                                                 // 82. RT WALI
        '',                                                 // 83. RW WALI
        $wali?->alamat_wali ?? '',                          // 84. ALAMAT WALI
        '',                                                 // 85. KODE POS WALI

        // ── ASAL SEKOLAH (86-89) ─────────────────────────────
        '',                                                 // 86. URUT
        '',                                                 // 87. NSM ASAL
        '',                                                 // 88. NPSN ASAL
        $s->asal_sekolah ?? '',                             // 89. NAMA MADRASAH ASAL

        // ── DATA TAMBAHAN LENGKAP (90-116) ───────────────────
        // Kesehatan & Fisik
        $s->golongan_darah ?? '',                           // 90. GOLONGAN DARAH
        $fisik?->tinggi_badan ?? '',                        // 91. TINGGI BADAN (CM)
        $fisik?->berat_badan ?? '',                         // 92. BERAT BADAN (KG)
        $s->dataTambahan?->lingkar_kepala ?? '',            // 93. LINGKAR KEPALA (CM)
        $s->riwayat_penyakit ?? '',                         // 94. RIWAYAT PENYAKIT

        // Kebutuhan Khusus
        $s->kebutuhan_khusus ?? '',                         // 95. KEBUTUHAN KHUSUS SISWA
        $s->dataTambahan?->kebutuhan_khusus_ayah ?? '',     // 96. KEBUTUHAN KHUSUS AYAH
        $s->dataTambahan?->kebutuhan_khusus_ibu ?? '',      // 97. KEBUTUHAN KHUSUS IBU
        '',                                                 // 98. CATATAN KESEHATAN

        // Status & Waktu
        $s->status,                                         // 99. STATUS SISWA
        $s->tanggal_masuk?->format('Y-m-d') ?? '',          // 100. TANGGAL MASUK
        $s->tahun_ajaran_id ?? '',                          // 101. TAHUN AJARAN MASUK

        // Lokasi & Transportasi
        $s->dataTambahan?->lintang ?? '',                   // 102. LINTANG
        $s->dataTambahan?->bujur ?? '',                     // 103. BUJUR
        $s->jarak_tempat_tinggal ?? '',                     // 104. JARAK TEMPAT TINGGAL (KM)
        $s->waktu_tempuh ?? '',                             // 105. WAKTU TEMPUH (MENIT)
        $s->moda_transportasi ?? '',                        // 106. MODA TRANSPORTASI

        // Kontak Lengkap
        $s->dataTambahan?->no_telp_siswa ?? '',             // 107. NO TELP SISWA (RUMAH)
        $s->dataTambahan?->email_siswa ?? '',               // 108. EMAIL SISWA

        // Program Kesejahteraan Lengkap
        $s->programKesejahteraan?->penerima_kps_pkh ? 'Ya' : 'Tidak',  // 109. PENERIMA KPS/PKH
        $s->programKesejahteraan?->no_kps_pkh ?? '',        // 110. NO KPS PKH
        $s->programKesejahteraan?->layak_pip ? 'Ya' : 'Tidak',          // 111. LAYAK PIP
        $s->programKesejahteraan?->alasan_layak_pip ?? '',  // 112. ALASAN LAYAK PIP
        $s->programKesejahteraan?->nama_tertera_di_kip ?? '', // 113. NAMA TERTERA DI KIP

        // Data Mutasi
        $s->jenis_pendaftaran ?? '',                        // 114. JENIS PENDAFTARAN
        $s->no_surat_mutasi ?? '',                          // 115. NO SURAT MUTASI
        $s->alasan_mutasi ?? '',                            // 116. ALASAN MUTASI
        $s->dataTambahan?->no_registrasi_akta_kelahiran ?? '', // 117. NO REGISTRASI AKTA KELAHIRAN
    ];
    }

    public function styles(Worksheet $sheet): array
    {
        $last = $sheet->getHighestRow();
        $lastCol = 'DM';
        $sheet->getStyle("A1:{$lastCol}1")->applyFromArray([
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '064e3b']],
            'font' => ['color' => ['rgb' => 'FFFFFF'], 'bold' => true, 'size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        for ($i = 2; $i <= $last; $i++) {
            $sheet->getStyle("A{$i}:{$lastCol}{$i}")->applyFromArray([
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $i % 2 === 0 ? 'f0fdf4' : 'FFFFFF']],
                'font' => ['size' => 9],
            ]);
        }
        $sheet->getStyle("A1:{$lastCol}{$last}")->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'd1fae5']]],
        ]);
        $sheet->freezePane('A2');
        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8, 'B' => 28, 'C' => 14, 'D' => 12, 'E' => 14,
            'F' => 18, 'G' => 12, 'H' => 14, 'I' => 14, 'J' => 18,
            'K' => 12, 'L' => 10, 'M' => 14, 'N' => 10, 'O' => 18,
            'P' => 12, 'Q' => 16, 'R' => 36, 'S' => 18, 'T' => 24,
            'U' => 22, 'V' => 16, 'W' => 16, 'X' => 18, 'Y' => 24,
            'Z' => 18, 'AA' => 18, 'AB' => 18, 'AC' => 18, 'AD' => 18,
            'AE' => 16, 'AF' => 18, 'AG' => 18, 'AH' => 18, 'AI' => 18,
            'AJ' => 16, 'AK' => 18, 'AL' => 18, 'AM' => 18, 'AN' => 18,
            'AO' => 16, 'AP' => 18, 'AQ' => 18, 'AR' => 18, 'AS' => 18,
            'AT' => 16, 'AU' => 18, 'AV' => 16, 'AW' => 16, 'AX' => 16,
            'AY' => 16, 'AZ' => 18, 'BA' => 18, 'BB' => 18, 'BC' => 18,
            'BD' => 8, 'BE' => 8, 'BF' => 18, 'BG' => 18, 'BH' => 10,
            'BI' => 10, 'BJ' => 14, 'BK' => 18, 'BL' => 18, 'BM' => 18,
            'BN' => 18, 'BO' => 18, 'BP' => 18, 'BQ' => 18, 'BR' => 18,
            'BS' => 18, 'BT' => 18, 'BU' => 18, 'BV' => 10, 'BW' => 18,
            'BX' => 18, 'BY' => 18, 'BZ' => 22, 'CA' => 14, 'CB' => 14,
            'CC' => 16, 'CD' => 16, 'CE' => 16, 'CF' => 16, 'CG' => 24,
            'CH' => 12, 'CI' => 12, 'CJ' => 16, 'CK' => 16, 'CL' => 18,
            'CM' => 16, 'CN' => 18, 'CO' => 16, 'CP' => 24, 'CQ' => 16,
            'CR' => 16, 'CS' => 24, 'CT' => 24, 'CU' => 24, 'CV' => 18,
            'CW' => 18, 'CX' => 18, 'CY' => 18, 'CZ' => 24, 'DA' => 18,
            'DB' => 18, 'DC' => 18, 'DD' => 18, 'DE' => 18, 'DF' => 18,
            'DG' => 18, 'DH' => 24, 'DI' => 18,             'DJ' => 18, 'DK' => 18,
            'DL' => 18, 'DM' => 24,
        ];
    }

    public function title(): string { return 'Data Siswa'; }
}
