<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPpdbProfile extends Model
{
    protected $fillable = [
        'user_id',
        'tahun_ajaran'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}