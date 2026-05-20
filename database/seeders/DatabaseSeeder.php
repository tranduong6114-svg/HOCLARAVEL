<?php

namespace Database\Seeders;

use App\Models\NhanVien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        NhanVien::factory(50)->create();

        NhanVien::factory()->create([
            'ma_nv' => 'BOSS01',
            'ten_nv' => 'Giam doc Quang',
            'tuoi' => 35
        ]);
    }
}
