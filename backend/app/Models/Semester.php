<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semester extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tahun_ajaran_id',
        'nama',
        'tgl_mulai',
        'tgl_selesai',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date',
    ];

    // ─── Relationships ───

    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function guruMapels(): HasMany
    {
        return $this->hasMany(GuruMapel::class);
    }

    // ─── Scopes ───

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ─── Accessors ───

    public function getFullLabelAttribute()
    {
        return ($this->tahunAjaran->tahun ?? '?').' '.$this->nama;
    }
}
