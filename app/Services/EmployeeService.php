<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService {
    
    public function getPaginatedEmployees($perPage = 5)
    {
        return Employee::with(['department', 'position', 'projects'])->paginate($perPage);
    }

    public function getEmployeeDetails($id)
    {
        return Employee::with(['department', 'position', 'projects'])->findOrFail($id);
    }
}