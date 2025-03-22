<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'full_name' => 'Admin User',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => true,
            ],
            [
                'full_name' => 'Petugas User',
                'username' => 'petugas',
                'email' => 'petugas@example.com',
                'password' => Hash::make('password'),
                'role' => 'petugas',
                'status' => true,
            ],
            [
                'full_name' => 'Regular User',
                'username' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'status' => true,
            ],
        ]);
    }
}
