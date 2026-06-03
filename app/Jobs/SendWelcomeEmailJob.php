<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use App\Models\Employee;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Queueable;

    public $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function handle(): void
    {
        sleep(3);
        
        Log::info("HỆ THỐNG QUEUE: Đã gửi email chào mừng tới [{$this->employee->email}]");
    }
}