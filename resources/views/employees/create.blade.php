<h1>Thêm Nhân Viên Mới</h1>

<form action="{{ route('employees.store') }}" method="POST">
    @csrf
    
    <div style="margin-bottom: 10px;">
        <p>Mã NV: <input type="text" name="employee_code" value="{{ old('employee_code') }}"></p>
        @error('employee_code') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 10px;">
        <p>Họ Tên: <input type="text" name="full_name" value="{{ old('full_name') }}"></p>
        @error('full_name') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 10px;">
        <p>Email: <input type="text" name="email" value="{{ old('email') }}"></p>
        @error('email') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 15px;">
    <label for="phone">Số điện thoại (Định dạng: xxxx-xxx-xxx):</label><br>
    <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
    
    @error('phone')
        <span style="color: red; font-size: 14px;">{{ $message }}</span>
    @enderror
    </div>
    
    <div style="margin-bottom: 10px;">
        <p>Lương cơ bản: <input type="number" name="base_salary" value="{{ old('base_salary') }}"></p>
        @error('base_salary') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
    </div>
    
    <div style="margin-bottom: 10px;">
        <p>Phòng ban: 
            <select name="department_id">
                <option value="">-- Chọn --</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                @endforeach
            </select>
        </p>
        @error('department_id') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 10px;">
        <p>Chức vụ: 
            <select name="position_id">
                <option value="">-- Chọn --</option>
                @foreach($positions as $pos)
                    <option value="{{ $pos->id }}" {{ old('position_id') == $pos->id ? 'selected' : '' }}>{{ $pos->name }}</option>
                @endforeach
            </select>
        </p>
        @error('position_id') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
    </div>

    <div style="margin-bottom: 20px;">
        <p>Dự án tham gia:</p>
        @foreach($projects as $project)
            <label style="margin-right: 15px;">
                <input type="checkbox" name="project_ids[]" value="{{ $project->id }}" 
                    {{ (is_array(old('project_ids')) && in_array($project->id, old('project_ids'))) ? 'checked' : '' }}> 
                {{ $project->name }}
            </label>
        @endforeach
        <br>
        @error('project_ids') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
    </div>
    
    <button type="submit">Lưu lại</button>
</form>