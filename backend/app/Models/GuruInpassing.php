<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class GuruInpassing extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'guru_inpassings';

    protected $fillable = [
        'guru_id',
        'no_sk',
        'tanggal_sk',
        'tmt_inpassing',
        'golongan_sebelum',
        'golongan_sesudah',
        'jabatan_fungsional',
        'angka_kredit',
        'pejabat_penetap',
        'instansi_penetap',
        'status',
        'file_sk',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_sk'    => 'date',
        'tmt_inpassing' => 'date',
    ];

    protected $appends = [
        'tanggal_sk_fmt',
        'tmt_inpassing_fmt',
        'jabatan_label',
        'golongan_label',
        'file_sk_url',
        'is_aktif',
    ];

    // ===== RELATIONS =====

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // ===== ACCESSORS =====

    public function getTanggalSkFmtAttribute(): string
    {
        return $this->tanggal_sk
            ? $this->tanggal_sk->translatedFormat('d M Y')
            : '-';
    }

    public function getTmtInpassingFmtAttribute(): string
    {
        return $this->tmt_inpassing
            ? $this->tmt_inpassing->translatedFormat('d M Y')
            : '-';
    }

    public function getJabatanLabelAttribute(): string
    {
        return self::JABATAN_FUNGSIONAL[$this->jabatan_fungsional]
            ?? $this->jabatan_fungsional;
    }

    public function getGolonganLabelAttribute(): string
    {
        $sebelum = $this->golongan_sebelum ? $this->golongan_sebelum . ' → ' : '';
        return $sebelum . $this->golongan_sesudah;
    }

    public function getFileSKUrlAttribute(): ?string
    {
        return $this->file_sk
            ? Storage::disk('public')->url($this->file_sk)
            : null;
    }

    public function getIsAktifAttribute(): bool
    {
        return $this->status === 'aktif';
    }

    // ===== CONSTANTS =====

    const JABATAN_FUNGSIONAL = [
        'Guru Pertama' => 'Guru Pertama (III/a – III/b)',
        'Guru Muda'    => 'Guru Muda (III/c – III/d)',
        'Guru Madya'   => 'Guru Madya (IV/a – IV/b – IV/c)',
        'Guru Utama'   => 'Guru Utama (IV/d – IV/e)',
    ];

    const JABATAN_COLORS = [
        'Guru Pertama' => 'emerald',
        'Guru Muda'    => 'blue',
        'Guru Madya'   => 'purple',
        'Guru Utama'   => 'amber',
    ];

    const GOLONGAN_LIST = [
        'III/a', 'III/b', 'III/c', 'III/d',
        'IV/a',  'IV/b',  'IV/c',  'IV/d', 'IV/e',
    ];
}