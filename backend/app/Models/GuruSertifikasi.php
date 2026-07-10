<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class GuruSertifikasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'guru_id',
        'jenis_sertifikasi',
        'no_sertifikat',
        'tahun_sertifikasi',
        'bidang_studi',
        'nrg',
        'file_sertifikat',
        'tanggal_terbit',
        'expired_at',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    protected $casts = [
        'tanggal_terbit' => 'date',
        'expired_at' => 'date',
    ];
    
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}