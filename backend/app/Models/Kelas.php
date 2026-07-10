<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'wali_kelas_id',
        'tahun_ajaran_id',
        'kapasitas',
        'parent_meeting_at',
    ];
    protected $casts = [
        'parent_meeting_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        if (!$this->tingkat || !$this->nama_kelas)
            return null;

        return $this->tingkat . ' ' . $this->nama_kelas;
    }
    
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function guruMapels()
    {
        return $this->hasMany(GuruMapel::class);
    }

    public function getPerformanceIndexAttribute()
    {
        // Simple calculation based on average student grades
        $avg = \App\Models\Nilai::whereIn('siswa_id', $this->siswas->pluck('id'))
            ->avg('nilai_akhir');

        return $avg ? round($avg, 1) : 0;
    }

    public function getPerformanceChangeAttribute()
    {
        // Placeholder for trending (e.g. +2.5%)
        return "+0.0%";
    }
}