<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuruDiklat extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'guru_diklats';

    protected $fillable = [
        'guru_id',
        'nama_diklat',
        'penyelenggara',
        'jenis',
        'tingkat',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_jam',
        'no_sertifikat',
        'peran',
        'file_sertifikat',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'jumlah_jam'      => 'integer',
    ];

    protected $appends = [
        'tanggal_mulai_fmt',
        'tanggal_selesai_fmt',
        'durasi_label',
        'jenis_label',
        'tingkat_label',
        'peran_label',
        'file_sertifikat_url',
    ];

    // ===== RELATIONS =====

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // ===== ACCESSORS =====

    public function getTanggalMulaiFmtAttribute(): string
    {
        return $this->tanggal_mulai
            ? $this->tanggal_mulai->translatedFormat('d M Y')
            : '-';
    }

    public function getTanggalSelesaiFmtAttribute(): string
    {
        return $this->tanggal_selesai
            ? $this->tanggal_selesai->translatedFormat('d M Y')
            : '-';
    }

    public function getDurasiLabelAttribute(): string
    {
        if (!$this->tanggal_mulai || !$this->tanggal_selesai) {
            return $this->jumlah_jam ? "{$this->jumlah_jam} JP" : '-';
        }

        $days = $this->tanggal_mulai->diffInDays($this->tanggal_selesai) + 1;
        $jpStr = $this->jumlah_jam ? " · {$this->jumlah_jam} JP" : '';

        if ($days === 1) return "1 Hari{$jpStr}";
        if ($days < 7)  return "{$days} Hari{$jpStr}";

        $weeks = round($days / 7, 1);
        return "{$weeks} Minggu{$jpStr}";
    }

    public function getJenisLabelAttribute(): string
    {
        return self::JENIS[$this->jenis] ?? $this->jenis;
    }

    public function getTingkatLabelAttribute(): string
    {
        return self::TINGKAT[$this->tingkat] ?? ($this->tingkat ?? '-');
    }

    public function getPeranLabelAttribute(): string
    {
        return self::PERAN[$this->peran] ?? $this->peran;
    }

    public function getFileSertifikatUrlAttribute(): ?string
    {
        return $this->file_sertifikat
            ? Storage::disk('public')->url($this->file_sertifikat)
            : null;
    }

    // ===== CONSTANTS =====

    const JENIS = [
        'diklat'    => 'Diklat Fungsional',
        'workshop'  => 'Workshop',
        'seminar'   => 'Seminar',
        'bimtek'    => 'Bimtek',
        'pelatihan' => 'Pelatihan',
        'magang'    => 'Magang',
        'lainnya'   => 'Lainnya',
    ];

    const TINGKAT = [
        'sekolah'       => 'Tingkat Sekolah',
        'kecamatan'     => 'Tingkat Kecamatan',
        'kabupaten'     => 'Tingkat Kabupaten/Kota',
        'provinsi'      => 'Tingkat Provinsi',
        'nasional'      => 'Tingkat Nasional',
        'internasional' => 'Internasional',
    ];

    const PERAN = [
        'peserta'     => 'Peserta',
        'narasumber'  => 'Narasumber',
        'panitia'     => 'Panitia',
        'fasilitator' => 'Fasilitator',
    ];

    const JENIS_COLORS = [
        'diklat'    => 'blue',
        'workshop'  => 'purple',
        'seminar'   => 'teal',
        'bimtek'    => 'amber',
        'pelatihan' => 'emerald',
        'magang'    => 'rose',
        'lainnya'   => 'slate',
    ];

    const TINGKAT_COLORS = [
        'sekolah'       => 'slate',
        'kecamatan'     => 'teal',
        'kabupaten'     => 'blue',
        'provinsi'      => 'purple',
        'nasional'      => 'amber',
        'internasional' => 'rose',
    ];
}