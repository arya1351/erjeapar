<?php

namespace Database\Seeders;

use App\Models\Gedung;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gedung::create([
            'nama_ruangan' => 'Test Ruangan',
            'x' => 100,
            'y' => 200,
            'gambargedung_id' => 1, // Pastikan ID ini valid
        ]);
    }
}
