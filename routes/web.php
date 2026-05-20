<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NhanSuController;
use App\Http\Controllers\ChiNhanhController;
// GET: Yeu cau lay du lieu (Xem danh sach nhan vien)
Route::get('/nhan-vien', function() {
    return 'Giao dien danh sach nhan vien cong ty';
});

// POST: Yeu cau gui du lieu moi (Nop form them nhan vien)
Route::post('/nhan-vien', function() {
    return 'Da nhan du lieu form va tao nhan vien moi';
});

// PUT: Yeu cap cap nhat, ghi de toan bo thong tin (Sua toan bo ho so NV 1)
Route::put('/nhan-vien/1', function() {
    return 'Da cap nhat toan bo ly lich cho nhan vien 1';
});

// PATCH: Yeu cau cap nhat 1 phan 
Route::patch('/nhan-vien/1/tang-luong', function() {
    return 'Da tang luong cho nhan vien so 1 (Cac thong tin khac giu nguyen)';
});


// DELETE: Yeu cau xoa du lieu (Xoa NV 1)
Route::delete('/nhan-vien/1', function() {
    return 'Da duoi viec nhan vien so 1';
});

// Tham so bat buoc: Bat buoc phai co ID moi xem duoc ho so
Route::get('/nhan-vien/ho-so/{id}', function ($id) {
    return "Dang hien thi ho so chi tiet cua nhan vien ma: " . $id;
});

// Tham so tuy chon: Loc nhan vien theo phong ban, neu khong nhap thi mac dinh la lay tat ca
Route::get('/nhan-vien/phong-ban/{ten_phong?}', function($ten_phong = 'Tat ca cac phong') {
    return "Dang hien thi nhan vien thuoc phong: " . $ten_phong;
});

// Named Route: Dat ten cho route nay la 'nhanvien.chitiet'
Route::get('/chi-tiet-nhan-su/{id}', function($id) {
    return "Thong tin nhan su " . $id;
})->name('nhanvien.chitiet');

// Route Group
Route::prefix('quan-tri')->group(function() {
    Route::get('/danh-sach', function() {
        return 'Giao dien quan ly danh sach cua Admin HR';
    });
    Route::get('/hop-dong', function() {
        return 'GIoa dien quan ly hop dong cua Admin HR';
    });
});

// Goi ham layDanhSach
Route::get('nhan-su/danh-sach', [NhanSuController::class, 'layDanhSach']);

// Goi ham xemChiTiet, truyen bien $id
Route::get('/nhan-su/chi-tiet/{id}', [NhanSuController::class, 'xemChiTiet']);

Route::resource('chi-nhanh', ChiNhanhController::class);

 
Route::get('/nhan-su/xoa/{id}', function($id) {
    return "He thong: Da xoa thanh cong nhan su so " . $id;
})->middleware('check_quyen:GiamDoc');

// Link hien thi Form
Route::get('/nhan-su/them-moi', [NhanSuController::class, 'hienThiForm']);

// Link xu ly du lieu gui len
Route::post('/nhan-su/luu', [NhanSuController::class, 'luuDuLieu']);

// Route test Request
Route::get('/nhan-su/day3/form-request', [NhanSuController::class, 'formRequest']);
Route::post('/nhan-su/day3/xu-ly-request', [NhanSuController::class, 'xuLyRequest']);

// Route test 4 kieu Response
Route::get('/nhan-su/day3/test-view', [NhanSuController::class, 'testView']);
Route::get('/nhan-su/day3/test-json', [NhanSuController::class, 'testJson']);
Route::get('/nhan-su/day3/test-file', [NhanSuController::class, 'testFile']);
Route::get('/nhan-su/day3/test-download', [NhanSuController::class, 'testDownload']);

// Route test Redirect
Route::get('/nhan-su/day3/chay-redirect', [NhanSuController::class, 'testRedirect']);

// Route dich den (Duoc gan ten dinh danh bang ham name() de Redirect goi toi)
Route::get('/nhan-su/day3/trang-dich', [NhanSuController::class, 'dichDenRedirect'])->name('day3.trangdich');

Route::get('/nhan-su/day4/giao-dien', [NhanSuController::class, 'giaoDien'])->name('day4.giaodien');

// 1. Link test lay du lieu
Route::get('/test-truy-xuat', [NhanSuController::class, 'testTruyXuat']);

// 2. Link test them moi
Route::get('/test-them', [NhanSuController::class, 'testThemMoi']);

// 3. Link test cap nhat
Route::get('/test-sua', [NhanSuController::class, 'testCapNhat']);

// 4. Link test xoa
Route::get('/test-xoa', [NhanSuController::class, 'testXoa']);

// 5. Link test Scope
Route::get('/test-scope', [NhanSuController::class, 'testScope']);