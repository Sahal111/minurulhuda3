<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuruDokumen extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'guru_dokumens';

    protected $fillable = [
        'guru_id',
        'kategori',
        'nama_dokumen',
        'nomor_dokumen',
        'tanggal_dokumen',
        'tanggal_berlaku',
        'tanggal_kadaluarsa',
        'penerbit',
        'file_path',
        'file_type',
        'file_size',
        'keterangan',
        'is_verified',
    ];

    protected $casts = [
        'tanggal_dokumen' => 'date',
        'tanggal_berlaku' => 'date',
        'tanggal_kadaluarsa' => 'date',
        'is_verified' => 'boolean',
    ];

    protected $appends = [
        'url',
        'file_size_human',
        'is_expired',
        'is_expiring_soon',
        'kategori_label',
        'kategori_group',
        'tanggal_dokumen_fmt',
        'tanggal_kadaluarsa_fmt',
    ];

    public function getTanggalDokumenFmtAttribute(): string
    {
        return $this->tanggal_dokumen
            ? $this->tanggal_dokumen->translatedFormat('d M Y')
            : '-';
    }

    public function getTanggalKadaluarsaFmtAttribute(): string
    {
        return $this->tanggal_kadaluarsa
            ? $this->tanggal_kadaluarsa->translatedFormat('d M Y')
            : '-';
    }

    // ===== RELATIONS =====
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // ===== ACCESSORS =====
    public function getUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->file_path);
    }

    public function getFileSizeHumanAttribute(): string
    {
        $bytes = $this->file_size ?? 0;
        if ($bytes < 1024)
            return $bytes . ' B';
        if ($bytes < 1048576)
            return round($bytes / 1024, 1) . ' KB';
        return round($bytes / 1048576, 1) . ' MB';
    }

    public function getIsExpiredAttribute(): bool
    {
        if (!$this->tanggal_kadaluarsa)
            return false;
        return $this->tanggal_kadaluarsa->isPast();
    }

    public function getIsExpiringSoonAttribute(): bool
    {
        if (!$this->tanggal_kadaluarsa)
            return false;
        return $this->tanggal_kadaluarsa->isFuture() &&
            $this->tanggal_kadaluarsa->diffInDays(now()) <= 30;
    }

    public function getKategoriLabelAttribute(): string
    {
        return self::KATEGORI[$this->kategori] ?? $this->kategori;
    }

    public function getKategoriGroupAttribute(): string
    {
        return match (true) {
            in_array($this->kategori, ['ktp', 'kk', 'akta_lahir', 'pas_foto']) =>
                'Identitas Diri',
            in_array($this->kategori, ['sk_pengangkatan', 'sk_cpns', 'sk_pns', 'sk_pppk',
                    'sk_jabatan', 'sk_berkala', 'sk_golongan', 'sk_mengajar', 'karpeg', 'karis_karsu']) =>
                'Kepegawaian',
            in_array($this->kategori, ['ijazah_s1', 'transkrip_s1', 'ijazah_s2',
                    'transkrip_s2', 'ijazah_sma']) =>
                'Pendidikan',
            in_array($this->kategori, ['sertifikat_pendidik', 'sertifikat_pelatihan',
                    'sertifikat_lainnya', 'npwp']) =>
                'Sertifikasi & Profesi',
            in_array($this->kategori, ['buku_rekening', 'slip_gaji']) =>
                'Keuangan',
            in_array($this->kategori, ['akta_nikah', 'akta_cerai', 'akta_anak']) =>
                'Keluarga',
            in_array($this->kategori, ['surat_sehat', 'bpjs']) =>
                'Kesehatan',
            default => 'Lainnya',
        };
    }

    // ===== CONSTANTS =====
    const KATEGORI = [
        'ktp' => 'KTP',
        'kk' => 'Kartu Keluarga',
        'akta_lahir' => 'Akta Kelahiran',
        'pas_foto' => 'Pas Foto',
        'sk_pengangkatan' => 'SK Pengangkatan',
        'sk_cpns' => 'SK CPNS',
        'sk_pns' => 'SK PNS',
        'sk_pppk' => 'SK PPPK',
        'sk_jabatan' => 'SK Jabatan',
        'sk_berkala' => 'SK Kenaikan Berkala',
        'sk_golongan' => 'SK Kenaikan Golongan',
        'sk_mengajar' => 'SK Mengajar',
        'karpeg' => 'Karpeg',
        'karis_karsu' => 'Karis/Karsu',
        'ijazah_s1' => 'Ijazah S1',
        'transkrip_s1' => 'Transkrip S1',
        'ijazah_s2' => 'Ijazah S2',
        'transkrip_s2' => 'Transkrip S2',
        'ijazah_sma' => 'Ijazah SMA/MA',
        'sertifikat_pendidik' => 'Sertifikat Pendidik',
        'sertifikat_pelatihan' => 'Sertifikat Pelatihan',
        'sertifikat_lainnya' => 'Sertifikat Lainnya',
        'npwp' => 'NPWP',
        'buku_rekening' => 'Buku Rekening',
        'slip_gaji' => 'Slip Gaji',
        'akta_nikah' => 'Akta Nikah',
        'akta_cerai' => 'Akta Cerai',
        'akta_anak' => 'Akta Anak',
        'surat_sehat' => 'Surat Sehat',
        'bpjs' => 'BPJS Kesehatan',
        'lainnya' => 'Lainnya',
    ];
}