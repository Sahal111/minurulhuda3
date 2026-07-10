<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bendahara extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_bendahara'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}