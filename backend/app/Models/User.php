<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active', // ← WAJIB ADA
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /*
|--------------------------------------------------------------------------
| RELATIONS
|--------------------------------------------------------------------------
*/

    // Many-to-many roles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Guru profile
    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    // Bendahara profile
    public function bendahara()
    {
        return $this->hasOne(Bendahara::class);
    }

    // Admin PPDB profile
    public function adminPpdb()
    {
        return $this->hasOne(AdminPpdbProfile::class);
    }

    // Orang tua profile
    public function orangTua()
    {
        return $this->hasOne(OrangTua::class);
    }
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }
    public function hasAnyRole($roles)
    {
        return $this->roles->whereIn('name', (array) $roles)->isNotEmpty();
    }
    /*
    |--------------------------------------------------------------------------
    | ROLE SHORTCUT (OPSIONAL, RECOMMENDED)
    |--------------------------------------------------------------------------
    */

    public function isGuru()
    {
        return $this->hasRole('guru');
    }

    public function isWaliKelas()
    {
        return $this->hasRole('wali_kelas');
    }

    public function isKepsek()
    {
        return $this->hasRole('kepsek');
    }

    public function isOperator()
    {
        return $this->hasRole('operator');
    }

    public function isBendahara()
    {
        return $this->hasRole('bendahara');
    }

    public function isOrtu()
    {
        return $this->hasRole('ortu');
    }

    public function isAdminPpdb()
    {
        return $this->hasRole('admin_ppdb');
    }

    /*
    |--------------------------------------------------------------------------
    | PRIMARY ROLE (Optional Advanced)
    |--------------------------------------------------------------------------
    */

    public function primaryRole()
    {
        return $this->roles->first();
    }
}