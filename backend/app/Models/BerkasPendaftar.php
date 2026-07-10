<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasPendaftar extends Model
{
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }

}