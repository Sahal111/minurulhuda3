<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run()
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('password123')
        ]);

        $role = Role::where('name', 'operator')->first();

        $admin->roles()->attach($role->id);
    }

}