<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class KepsekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 1. Buat User Kepala Sekolah
        $kepsek = User::create([
            'name'      => 'Kepala Sekolah',
            'email'     => 'kepsek@sekolah.id',
            'password'  => Hash::make('kepsek123'),
            'is_active' => true,
        ]);

        // 2. Ambil Role 'kepsek'
        $role = Role::where('name', 'kepsek')->first();

        // 3. Lampirkan Role ke User
        if ($role) {
            $kepsek->roles()->attach($role->id);
        }
    }
}
