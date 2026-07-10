<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'tahun_ajaran_id',
        'nama',
        'tgl_mulai',
        'tgl_selesai',
        'is_active',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'tgl_mulai'   => 'date',
        'tgl_selesai'  => 'date',
    ];

    // ─── Relationships ───

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function guruMapels()
    {
        return $this->hasMany(GuruMapel::class);
    }

    // ─── Scopes ───

    /**
     * Scope: semester aktif saat ini
     * Usage: Semester::active()->first()
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ─── Accessors ───

    /**
     * Label lengkap: "2024/2025 Ganjil"
     */
    public function getFullLabelAttribute()
    {
        return ($this->tahunAjaran->tahun ?? '?') . ' ' . $this->nama;
    }
}
