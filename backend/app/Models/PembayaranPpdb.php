<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranPpdb extends Model
{
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }

}