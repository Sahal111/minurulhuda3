<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class GuruRekening extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'guru_id',
        'nama_bank',
        'no_rekening',
        'atas_nama',
        'cabang',
        'npwp',
        'gaji_pokok',
        'tunjangan_fungsional',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
