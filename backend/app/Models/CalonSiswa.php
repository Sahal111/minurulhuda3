<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    public function berkas()
    {
        return $this->hasMany(BerkasPendaftar::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(PembayaranPpdb::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

}