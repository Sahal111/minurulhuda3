<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $fillable = [
        'tahun',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ─── Relationships ───

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    // ─── Scopes ───

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ─── Accessors ───

    /**
     * Semester aktif untuk tahun ajaran ini
     */
    public function getActiveSemesterAttribute()
    {
        return $this->semesters()->where('is_active', true)->first();
    }
}