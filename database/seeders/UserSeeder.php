<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'KepalaBagian',
            'email' => 'kepalabagian@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'kepalabagian'
        ]);

        User::create([
            'name' => 'HRD',
            'email' => 'hrd@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'hrd'
        ]);

        User::create([
            'name' => 'Pelaksana',
            'email' => 'pelaksana@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'pelaksana'
        ]);
    }
}
