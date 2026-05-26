<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_code', 'full_name', 'email', 
        'base_salary', 'department_id', 'position_id'
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}
