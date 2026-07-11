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

    private int $no = 0;

    public function map($s): array
{
    $this->no++;
    $fisik = $s->perkembangans->last();

    // Ambil masing-masing orang tua berdasarkan pivot hubungan_keluarga
    $ayah = $s->orangTuas->where('pivot.hubungan_keluarga', 'Ayah')->first();
    $ibu  = $s->orangTuas->where('pivot.hubungan_keluarga', 'Ibu')->first();
    $wali = $s->orangTuas->where('pivot.hubungan_keluarga', 'Wali')->first();

    // Untuk no_hp dan alamat, prioritas: ayah > ibu > wali
    $noHpOrtu = $ayah?->no_hp ?? $ibu?->no_hp ?? $wali?->no_hp_wali;
    $alamat   = $ayah?->alamat ?? $ibu?->alamat ?? $wali?->alamat_wali;

    return [
        $s->nisn ?? '',
        $s->nis,
        $s->nama,
        $s->nik ?? '',
        $s->no_kk ?? '',
        $s->dataTambahan?->kewarganegaraan ?? '',
        $s->dataTambahan?->no_registrasi_akta_kelahiran ?? '',
        $s->jenis_kelamin,
        $s->tempat_lahir ?? '',
        $s->tanggal_lahir?->format('Y-m-d') ?? '',
        $s->agama ?? '',
        $s->golongan_darah ?? '',
        $fisik?->tinggi_badan ?? '',
        $fisik?->berat_badan ?? '',
        $s->dataTambahan?->lingkar_kepala ?? '',
        $s->kebutuhan_khusus ?? '',
        $s->kelas ? ($s->kelas->tingkat . ' ' . $s->kelas->nama_kelas) : '',
        $s->status,
        $ayah?->nama_ayah      ?? '',
        $ayah?->pekerjaan_ayah ?? '',
        $ayah?->nik_ayah       ?? '',
        $ayah?->tahun_lahir_ayah ?? '',
        $ayah?->pendidikan_ayah ?? '',
        $s->dataTambahan?->kebutuhan_khusus_ayah ?? '',
        $ibu?->nama_ibu        ?? '',
        $ibu?->pekerjaan_ibu   ?? '',
        $ibu?->nik_ibu         ?? '',
        $ibu?->tahun_lahir_ibu ?? '',
        $ibu?->pendidikan_ibu  ?? '',
        $s->dataTambahan?->kebutuhan_khusus_ibu ?? '',
        $noHpOrtu              ?? '',
        $alamat                ?? '',
        $ayah?->penghasilan_ayah ?? '',
        $ibu?->penghasilan_ibu   ?? '',
        $wali?->nama_wali      ?? '',
        $wali?->pekerjaan_wali ?? '',
        $wali?->pendidikan_wali ?? '',
        $wali?->penghasilan_wali ?? '',
        $wali?->no_hp_wali     ?? '',
        $wali?->alamat_wali    ?? '',
        $s->asal_sekolah ?? '',
        $s->tanggal_masuk?->format('Y-m-d') ?? '',
        $s->alamat_siswa ?? '',
        $s->rt ?? '',
        $s->rw ?? '',
        $s->kelurahan ?? '',
        $s->kecamatan ?? '',
        $s->kode_pos ?? '',
        $s->dataTambahan?->lintang ?? '',
        $s->dataTambahan?->bujur ?? '',
        $s->anak_ke ?? '',
        $s->jumlah_saudara ?? '',
        $s->jarak_tempat_tinggal ?? '',
        $s->waktu_tempuh ?? '',
        $s->moda_transportasi ?? '',
        $s->dataTambahan?->hobi ?? '',
        $s->dataTambahan?->cita_cita ?? '',
        $s->dataTambahan?->no_telp_siswa ?? '',
        $s->dataTambahan?->hp_siswa ?? '',
        $s->dataTambahan?->email_siswa ?? '',
        $s->programKesejahteraan?->penerima_kps_pkh ? 'Ya' : 'Tidak',
        $s->programKesejahteraan?->no_kps_pkh ?? '',
        $s->programKesejahteraan?->layak_pip ? 'Ya' : 'Tidak',
        $s->programKesejahteraan?->alasan_layak_pip ?? '',
        $s->programKesejahteraan?->penerima_kip ? 'Ya' : 'Tidak',
        $s->programKesejahteraan?->no_kip ?? '',
        $s->programKesejahteraan?->nama_tertera_di_kip ?? '',
    ];
    }

    public function styles(Worksheet $sheet): array
    {
        $last = $sheet->getHighestRow();
        $lastCol = 'BO';
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
            'A' => 14, 'B' => 12, 'C' => 28, 'D' => 18, 'E' => 18,
            'F' => 14, 'G' => 16, 'H' => 14, 'I' => 12, 'J' => 14,
            'K' => 12, 'L' => 12, 'M' => 20, 'N' => 20, 'O' => 12,
            'P' => 24, 'Q' => 18, 'R' => 18, 'S' => 14, 'T' => 18,
            'U' => 24, 'V' => 18, 'W' => 18, 'X' => 14, 'Y' => 18,
            'Z' => 16, 'AA' => 36,
            'AB' => 18, 'AC' => 18,
            'AD' => 24, 'AE' => 18, 'AF' => 18, 'AG' => 18, 'AH' => 16, 'AI' => 36,
            'AJ' => 22, 'AK' => 14,
            'AL' => 36, 'AM' => 8, 'AN' => 8, 'AO' => 18, 'AP' => 18,
            'AQ' => 10, 'AR' => 10, 'AS' => 14, 'AT' => 18,
            'AU' => 14, 'AV' => 18, 'AW' => 18,
        ];
    }

    public function title(): string { return 'Data Siswa'; }
}
