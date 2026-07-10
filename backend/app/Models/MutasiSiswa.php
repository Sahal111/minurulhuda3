<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutasiSiswa extends Model
{
    protected $fillable = [
        'siswa_id',
        'jenis_mutasi',
        'tanggal',
        'no_surat',
        'alasan',
        'sekolah_asal_tujuan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function getJenisLabelAttribute(): string
    {
        return match($this->jenis_mutasi) {
            'lulus'         => 'Lulus / Tamat',
            'mutasi_keluar' => 'Pindah Sekolah',
            'nonaktif'      => 'Non-Aktif / DO',
            'mutasi_masuk'  => 'Mutasi Masuk',
            default         => $this->jenis_mutasi,
        };
    }
}