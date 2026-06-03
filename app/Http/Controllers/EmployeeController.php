<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\Project;
use App\Http\Requests\StoreEmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendWelcomeEmailJob;
use App\Notifications\NewEmployeeNotification;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $employees = $this->employeeService->getPaginatedEmployees(5);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        $projects = Project::all();
        return view('employees.create', compact('departments', 'positions', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->all());
        
        if ($request->has('project_ids')) {
            $employee->projects()->attach($request->project_ids);
        }

        SendWelcomeEmailJob::dispatch($employee);

        $admin = Auth::user();
        if ($admin) {
            $admin->notify(new NewEmployeeNotification($employee));
        }
        
        return redirect()->route('employees.index')->with('success', 'Thêm nhân viên thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = $this->employeeService->getEmployeeDetails($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $employee = \App\Models\Employee::findOrFail($id);
            $empName = $employee->full_name; 
            
            $employee->delete();
            
            $userName = Auth::check() ? Auth::user()->name : 'Hệ thống';
            Log::info("Nhân viên [{$empName}] đã bị xóa bởi: {$userName}");

            return redirect()->route('employees.index')->with('success', 'Đã xóa nhân viên!');

        } catch (\Exception $e) {
            Log::error("Lỗi sập DB khi xóa NV ID {$id}: " . $e->getMessage());

            return redirect()->route('employees.index')->with('error', 'Hệ thống đang bận, không thể xóa lúc này!');
        }
    }
}
