<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class GuruJabatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'guru_id',
        'jabatan',
        'golongan',
        'status_kepegawaian',
        'sk_nomor',
        'sk_tanggal',
        'tmt_jabatan',
        'tanggal_selesai',
        'is_current',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $casts = [
        'sk_tanggal' => 'date',
        'tmt_jabatan' => 'date',
        'is_current' => 'boolean',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
