<h1>Danh Sách Nhân Viên</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('employees.create') }}">Thêm mới</a><br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Mã NV</th>
        <th>Họ Tên</th>
        <th>Email</th>
        <th>Lương Cơ Bản</th>
        <th>Phòng Ban</th>
        <th>Chức Vụ</th>
        
        <th>Dự Án Tham Gia</th>
        
        <th>Hành động</th>
    </tr>
    
    @foreach($employees as $emp)
    <tr>
        <td>{{ $emp->employee_code }}</td>
        <td>{{ $emp->full_name }}</td>
        <td>{{ $emp->email }}</td>
        <td>{{ number_format($emp->base_salary) }} đ</td>
        <td>{{ $emp->department->name }}</td>
        <td>{{ $emp->position->name }}</td>
        
        <td>
            @foreach($emp->projects as $project)
                <span style="background: #eee; padding: 2px 5px; margin-right: 5px; font-size: 12px; display: inline-block; margin-bottom: 2px;">
                    {{ $project->name }}
                </span>
            @endforeach
        </td>
        
        <td>
            <form action="{{ route('employees.destroy', $emp->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<div style="margin-top: 15px;">
    {{ $employees->links() }}
</div>