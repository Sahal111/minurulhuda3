<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestasi extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'siswa_id',
        'nama',
        'jenis',
        'tingkat',
        'tahun',
        'penyelenggara',
        'keterangan',
        'file_bukti',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
