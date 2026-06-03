<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::where('email', 'admin@hrm.com')->doesntExist()) {
            User::create([
                'name' => 'Sếp Tổng',
                'email' => 'admin@hrm.com',
                'password' => bcrypt('123456'),
            ]);
        }
    }
}
