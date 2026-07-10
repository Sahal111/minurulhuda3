<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run()
    {
        $roles = [
            'kepsek',
            'guru',
            'wali_kelas',
            'operator',
            'bendahara',
            'ortu',
            'admin_ppdb'
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }

}