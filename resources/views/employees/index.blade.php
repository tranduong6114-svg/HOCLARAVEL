<h1>Danh Sách Nhân Viên</h1>

<div style="background: #f8f9fa; padding: 10px; margin-bottom: 20px; border: 1px solid #ddd;">
    <span>Xin chào quản trị viên: <strong>{{ Auth::user()->name }}</strong></span>
    
    <form action="{{ route('logout') }}" method="POST" style="display:inline; float:right;">
        @csrf
        <button type="submit" style="cursor: pointer;">Đăng xuất</button>
    </form>
    <div style="clear: both;"></div>
</div>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif


<a href="{{ route('employees.create') }}">Thêm mới</a><br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Mã NV</th>
        <th>Họ Tên</th>
        <th>Email</th>
        <th>Số Điện Thoại</th>
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
        <td>{{ $emp->phone ?? 'Chưa cập nhật' }}</td>
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
            <a href="{{ route('employees.show', $emp->id) }}" style="text-decoration: none; padding: 2px 5px; border: 1px solid #007bff; color: #007bff; background-color: white; margin-right: 5px;">Chi tiết</a>
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