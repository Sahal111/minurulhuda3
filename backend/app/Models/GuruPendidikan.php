<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class GuruPendidikan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'guru_id',
        'jenjang',
        'nama_sekolah',
        'jurusan',
        'tahun_lulus',
        'no_ijazah',
        'file_ijazah',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
