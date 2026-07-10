<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrangTua extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'nama_ayah',
        'nik_ayah',
        'tahun_lahir_ayah',
        'pendidikan_ayah',
        'nama_ibu',
        'nik_ibu',
        'tahun_lahir_ibu',
        'pendidikan_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'no_hp',
        'alamat',
        'nama_wali',
        'nik_wali',
        'tahun_lahir_wali',
        'pekerjaan_wali',
        'pendidikan_wali',
        'no_hp_wali',
        'alamat_wali',
        'penghasilan_ayah',
        'penghasilan_ibu',
        'penghasilan_wali',
        // Excel fields
        'status_ayah', 'kewarganegaraan_ayah', 'tempat_lahir_ayah', 'no_hp_ayah',
        'status_ibu', 'kewarganegaraan_ibu', 'tempat_lahir_ibu', 'no_hp_ibu',
        'status_wali', 'kewarganegaraan_wali', 'tempat_lahir_wali',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class, 'orang_tua_siswa')->withPivot('hubungan_keluarga')->withTimestamps();
    }
}