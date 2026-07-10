<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TahunAjaran extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tahun',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ─── Relationships ───

    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }

    // ─── Scopes ───

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ─── Accessors ───

    public function getActiveSemesterAttribute()
    {
        return $this->semesters()->where('is_active', true)->first();
    }

    // ─── Cascade Soft Deletes ───

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (TahunAjaran $tahunAjaran) {
            if (! $tahunAjaran->isForceDeleting()) {
                $tahunAjaran->semesters()->delete();
            }
        });

        static::restoring(function (TahunAjaran $tahunAjaran) {
            $tahunAjaran->semesters()->onlyTrashed()->where(
                'deleted_at', '>=', $tahunAjaran->deleted_at->subSeconds(5)
            )->each(function (Semester $semester) {
                $semester->restore();
            });
        });

        static::forceDeleting(function (TahunAjaran $tahunAjaran) {
            $tahunAjaran->semesters()->withTrashed()->get()->each(function (Semester $semester) {
                $semester->forceDelete();
            });
        });
    }
}
