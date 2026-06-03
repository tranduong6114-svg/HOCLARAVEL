<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;
use App\Models\Employee;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $totalEmployees = Employee::count();
    
    Log::info("BÁO CÁO NHÂN SỰ HÀNG NGÀY: Công ty hiện đang có {$totalEmployees} nhân viên.");
    
})->dailyAt('23:59');