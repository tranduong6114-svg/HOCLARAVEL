<h1>Chi Tiết Nhân Viên: {{ $employee->full_name }}</h1>

<ul>
    <li><strong>Mã NV:</strong> {{ $employee->employee_code }}</li>
    <li><strong>Email:</strong> {{ $employee->email }}</li>
    <li><strong>Lương:</strong> {{ number_format($employee->base_salary) }} đ</li>
    <li><strong>Phòng ban:</strong> {{ $employee->department->name }}</li>
    <li><strong>Chức vụ:</strong> {{ $employee->position->name }}</li>
    <li><strong>Dự án tham gia:</strong>
        <ul>
            @foreach($employee->projects as $project)
                <li>{{ $project->name }}</li>
            @endforeach
        </ul>
    </li>
</ul>

<a href="{{ route('employees.index') }}">Quay lại danh sách</a>