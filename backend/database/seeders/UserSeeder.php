<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'operator' => [
                'name' => 'Operator Madrasah',
                'email' => 'operator@gmail.com',
            ],
            'kepsek' => [
                'name' => 'Kepala Madrasah',
                'email' => 'kepsek@gmail.com',
            ],
            'guru' => [
                'name' => 'Guru Pengajar',
                'email' => 'guru@gmail.com',
            ],
            'wali_kelas' => [
                'name' => 'Wali Kelas 1',
                'email' => 'walikelas@gmail.com',
            ],
            'bendahara' => [
                'name' => 'Bendahara Madrasah',
                'email' => 'bendahara@gmail.com',
            ],
            'ortu' => [
                'name' => 'Orang Tua Siswa',
                'email' => 'ortu@gmail.com',
            ],
            'admin_ppdb' => [
                'name' => 'Admin PPDB',
                'email' => 'admin_ppdb@gmail.com',
            ],
        ];

        foreach ($roles as $roleName => $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password123'),
                    'is_active' => true,
                ]
            );

            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $user->roles()->syncWithoutDetaching([$role->id]);
            }
        }
    }
}