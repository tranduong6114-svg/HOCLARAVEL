<?php

namespace Database\Seeders;

use App\Models\NhanVien;
use App\Models\Department;
use App\Models\Position;
use App\Models\Project;
use App\Models\Employee;
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
        Department::create(['name' => 'Phòng Giám Đốc']);
        Department::create(['name' => 'Phòng IT']);
        Department::create(['name' => 'Phòng Kế Toán']);

        Position::create(['name' => 'Giám đốc']);
        Position::create(['name' => 'Trưởng phòng']);
        Position::create(['name' => 'Nhân viên']);

        Project::create(['name' => 'Dự án Hệ thống ERP']);
        Project::create(['name' => 'Dự án Mobile App']);


    }
}
