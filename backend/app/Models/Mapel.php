<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $fillable = [
        'kode',
        'nama_mapel',
        'kelompok',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function guruMapels()
    {
        return $this->hasMany(GuruMapel::class);
    }
}