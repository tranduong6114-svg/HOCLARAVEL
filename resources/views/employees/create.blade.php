<h1>Thêm Nhân Viên Mới</h1>

<form action="{{ route('employees.store') }}" method="POST">
    @csrf
    <p>Mã NV: <input type="text" name="employee_code" required></p>
    <p>Họ Tên: <input type="text" name="full_name" required></p>
    <p>Email: <input type="email" name="email" required></p>
    <p>Lương cơ bản: <input type="number" name="base_salary" required></p>
    
    <p>Phòng ban: 
        <select name="department_id" required>
            <option value="">-- Chọn --</option>
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
            @endforeach
        </select>
    </p>

    <p>Chức vụ: 
        <select name="position_id" required>
            <option value="">-- Chọn --</option>
            @foreach($positions as $pos)
                <option value="{{ $pos->id }}">{{ $pos->name }}</option>
            @endforeach
        </select>
    </p>

    <p>Dự án tham gia:</p>
    <div style="margin-bottom: 20px;">
        @foreach($projects as $project)
            <label style="margin-right: 15px;">
                <input type="checkbox" name="project_ids[]" value="{{ $project->id }}"> 
                {{ $project->name }}
            </label>
        @endforeach
    </div>
    
    <button type="submit">Lưu lại</button>
</form>