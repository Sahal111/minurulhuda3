<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class OperatorSeeder extends Seeder
{
    public function run()
    {
        $user = User::firstOrCreate(
            ['email' => 'operator@gmail.com'],
            [
                'name' => 'Super Operator',
                'password' => Hash::make('operator123'),
            ]
        );

        $role = Role::where('name', 'operator')->first();

        $user->roles()->syncWithoutDetaching([$role->id]);
    }

}