<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasSiswa extends Model
{
    protected $table = 'berkas_siswas';

    protected $fillable = [
        'siswa_id',
        'jenis_berkas',
        'nama_file_asli',
        'nama_file_sistem',
        'path_file',
        'ekstensi',
        'ukuran_file',
        'created_by',
        'updated_by',
    ];

    /**
     * Label jenis berkas (untuk ditampilkan di UI)
     */
    public const JENIS_LABELS = [
        'kartu_keluarga'    => 'Kartu Keluarga (KK)',
        'akte_kelahiran'    => 'Akte Kelahiran',
        'ktp_orang_tua'     => 'KTP Orang Tua',
        'ijazah_sebelumnya' => 'Ijazah Sebelumnya',
        'kip_pkh_kks'       => 'KIP / PKH / KKS',
        'pas_foto'          => 'Pas Foto Berwarna',
        'surat_mutasi'      => 'Surat / Berkas Mutasi',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    /**
     * Mendapatkan label jenis berkas
     */
    public function getJenisLabelAttribute(): string
    {
        return self::JENIS_LABELS[$this->jenis_berkas] ?? $this->jenis_berkas;
    }

    /**
     * Mendapatkan ukuran file yang human-readable
     */
    public function getUkuranReadableAttribute(): string
    {
        $bytes = $this->ukuran_file;
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }
}
