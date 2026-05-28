<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập hệ thống</title>
</head>
<body>
    <div style="width: 350px; margin: 100px auto; border: 1px solid #ccc; padding: 20px;">
        <h2>Đăng Nhập Hệ Thống</h2>
        
        <form action="{{ route('authenticate') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 10px;">
                <label>Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" style="width: 100%;">
            </div>
            
            <div style="margin-bottom: 10px;">
                <label>Mật khẩu:</label>
                <input type="password" name="password" style="width: 100%;">
            </div>
            
            @error('email') 
                <p style="color: red; font-size: 13px;">{{ $message }}</p> 
            @enderror
            
            <button type="submit" style="margin-top: 10px;">Đăng nhập</button>
        </form>
    </div>
</body>
</html>