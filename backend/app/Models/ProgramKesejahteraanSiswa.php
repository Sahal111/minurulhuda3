<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKesejahteraanSiswa extends Model
{
    protected $fillable = [
        'siswa_id',
        'penerima_kps_pkh',
        'no_kps_pkh',
        'layak_pip',
        'alasan_layak_pip',
        'penerima_kip',
        'no_kip',
        'nama_tertera_di_kip',
    ];

    protected $casts = [
        'penerima_kps_pkh' => 'boolean',
        'layak_pip' => 'boolean',
        'penerima_kip' => 'boolean',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
