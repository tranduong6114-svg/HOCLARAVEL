<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NhanSuController;
use App\Http\Controllers\ChiNhanhController;

Route::get('/', function () { 
    return redirect()->route('employees.index'); 
    });

Route::resource('employees', EmployeeController::class);
