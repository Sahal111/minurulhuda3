<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataTambahanSiswa extends Model
{
    protected $fillable = [
        'siswa_id',
        'kewarganegaraan',
        'no_registrasi_akta_kelahiran',
        'lintang',
        'bujur',
        'kebutuhan_khusus_ayah',
        'kebutuhan_khusus_ibu',
        'hobi',
        'cita_cita',
        'no_telp_siswa',
        'hp_siswa',
        'email_siswa',
        'lingkar_kepala',
    ];

    protected $casts = [
        'lintang' => 'decimal:8',
        'bujur' => 'decimal:8',
        'lingkar_kepala' => 'decimal:2',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
