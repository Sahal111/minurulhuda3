<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class GuruKeluarga extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'guru_id',
        'status_perkawinan',
        'nama_pasangan',
        'pekerjaan_pasangan',
        'jumlah_anak',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
