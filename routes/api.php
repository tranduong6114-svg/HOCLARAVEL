<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/employees/{id}', function ($id) {
    $employee = Employee::with('department')->findOrFail($id);
    
    return new EmployeeResource($employee);
});
