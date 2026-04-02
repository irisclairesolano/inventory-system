<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@inventory.com',
            'password' => Hash::make('Admin@1234'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Staff User',
            'email'    => 'staff@inventory.com',
            'password' => Hash::make('Staff@1234'),
            'role'     => 'staff',
        ]);
    }
}
