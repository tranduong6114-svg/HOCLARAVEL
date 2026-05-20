<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nhanVien;

class NhanSuController extends Controller
{
    public function layDanhSach() {
        return "Day 2 - Controller: Giao dien danh sach nhan su";
    }

    public function xemChiTiet($id) {
        return "Day 2 - Controller: Dang xem chi tiet nhan su ma: " . $id;
    }

    // Ham 1: Tra ve truc tiep chuoi HTML chua Form tu Controller 
    public function hienThiForm() {
        $csrf = csrf_field();

        return "
                <h2>Form Them Nhan Su (Thuc hanh CSRF - Day 2)</h2>
                <form method='POST' action='/nhan-su/luu'>
                    $csrf
                    <label>Nhap ten:</label>
                    <input type='text' name='ten'>
                    <button type='submit'>Gui len Server</button>
                </form>    
                ";
    }

    // Ham 2: Nhan du lieu POST tu Form gui len
    public function luuDuLieu(Request $request) {
        return "Day 2 - CSRF: Middleware da check token hop le. He thong nhan du lieu an toan!";
    }

    // Ham hien thi Form (Day 3)
    public function formRequest() {
        $csrf = csrf_field();
        return "
                <h2>Day 3 - Thuc hanh Request</h2>
                <form method='POST' action='/nhan-su/day3/xu-ly-request' enctype='multipart/form-data'>
                    $csrf
                    <p><label>Nhập Tên:</label> <input type='text' name='ten_nhan_vien'></p>
                    <p><label>Nhập Tuổi:</label> <input type='text' name='tuoi_nhan_vien'></p>
                    <p><label>Ảnh hồ sơ (File):</label> <input type='file' name='anh_ho_so'></p>
                    <button type='submit'>Test Request</button>
                </form>
                ";
    }

    // Ham xu ly Request (Day 3)
    public function xuLyRequest(Request $request) {
        // ACCESSING THE REQUEST (Lay toan bo)
        $toan_bo_du_lieu = $request->all(); // Tra ve 1 mang chua tat ca input

        // RETRIEVING INPUT (Lay tung phan tu)
        $ten = $request->input('ten_nhan_vien');
        $tuoi = $request->input('tuoi_nhan_vien', 18);

        $ket_qua = "<h3>Ket qua phan tich Request:</h3>";
        $ket_qua .= "<p>- Ten NV: $ten (Tuoi: $tuoi)</p>";

        // FILE (Xu li file upload)
        if ($request->hasFile('anh_ho_so') && $request->file('anh_ho_so')->isValid()) {
            $path = $request->file('anh_ho_so')->store('avatars');
            $ket_qua .= "<p>- Da luu file anh thanh cong tai duong dan: <b>storage/app/$path</b></p>";   
        } else {
            $ket_qua .= "<p>- Khong phat hien file upload hoac file bi loi</p>";
        }
        return $ket_qua;
    }

    // View Response: Tra ve 1 giao dien HTML hoan chinh
    public function testView() {
        return view('welcome');
    }

    // Json Response: Tra ve du lieu tho dang JSON 
    public function testJson() {
        $mang_du_lieu = [
            'ma_code' => 200,
            'thong_diep' => 'Thanh cong',
            'danh_sach' => ['Nguyen A', 'Le B', 'Tran C']
        ];
        // Laravel tu dong ep kieu mang PHP thanh chuoi JSON
        return response()->json($mang_du_lieu);
    }

    // File Response: Mo va hien thi file truc tiep tren trinh duyet
    public function testFile() {
        $path = storage_path('app/noi_quy_nhan_su.txt');
        if(!file_exists($path)) { file_put_contents($path, "Day la noi quy an toan thong tin cong ty..."); }
        
        return response()->file($path);
    }

    // File Download: Ep trinh duyet tai file ve may tinh
    public function testDownload() {
        $path = storage_path('app/hop_dong_lao_dong.txt');
        if(!file_exists($path)) { file_put_contents($path, "Noi dung hop dong lao dong..."); }
        
        // Tham so thu 2 la ten file se hien thi cho nguoi dung khi tai ve
        return response()->download($path, 'HopDong_ChinhThuc.txt');
    }

    // Ham xu ly va thuc hien Redirect
    Public function testRedirect() {
        return redirect()->route('day3.trangdich')->with('thong_bao_chuyen_huong', 'Ban da duoc Redirect an toan qua Named Route');
    }

    // Ham dong vai tro la dich den
    public function dichDenRedirect() {
        if (session('thong_bao_chuyen_huong')) {
            return "<h2 style='color:green'>" . session('thong_bao_chuyen_huong') . "</h2><p>Day la trang dich</p>";
        }
        return "<h2>Day la trang dich.</h2><p>Ban truy cap binh thuong, khong thong qua Redirect</p>";
    }

    // Ham nap du lieu cho View 
    public function giaoDien() {
        $ds_nhan_su = [
            (object)['ma_nv' => 'NV01', 'ten' => 'Duong', 'trang_thai' => 'Dang_Lam', 'tuoi' => 30],
            (object)['ma_nv' => 'NV02', 'ten' => 'Quang', 'trang_thai' => 'Thu_Viec', 'tuoi' => 22]
        ];
        
        // Du lieu de test bao mat XSS
        $ma_doc_hacker = "<script>alert('He thong da bi hack!');</script>";
        $chu_in_dam_an_toan = "<b>Nhan vien xuat sac</b>";

        // Tao view va truyen du lieu sang
        return view('nhansu.index', compact('ds_nhan_su', 'ma_doc_hacker', 'chu_in_dam_an_toan'));
    }

    public function testTruyXuat() {

        // Tra ve Collection
        $danhSach = NhanVien::all(); // Lay tat ca
        $nhungNguoiGia = NhanVien::where('tuoi', '>', 30)->get();
        echo "<h3>Danh sach nhan vien:</h3>";

        foreach ($nhungNguoiGia as $nv) {
            echo "Ten: " . $nv->ten_nv . " Tuoi: " . $nv->tuoi . "<br>";
        }

        // Tra ve Object
        $motNhanVien = NhanVien::find(51);
        $nguoiDauTien = NhanVien::where('tuoi', '>', 30)->first(); // Lay nguoi dau tien thay

        echo "<h3>Thong tin sep:</h3>";
        if ($motNhanVien) {
            echo "Xin chao sep: " . $motNhanVien->ten_nv;
        } else {
            echo "Khong tim thay";
        }    
    }

    public function testThemMoi() {
        // Thu cong
        $nv_moi = new NhanVien();
        $nv_moi->ma_nv = 'NV9999';
        $nv_moi->ten_nv = 'Nguyen Van A';
        $nv_moi->tuoi = 22;
        $nv_moi->save();

        $dataForm = [
            'ma_nv' => 'NV8888',
            'ten_nv' => 'Nguyen Van B',
            'tuoi' => 25
        ];
        $nv_cong_ty = NhanVien::create($dataForm);

        dd("Da them thanh cong nhan vien: " . $nv_cong_ty->ten_nv);
    }

    public function testCapNhat() {
        // Cap nhat 1 nguoi
        $nv_cu = NhanVien::find(1);
        if ($nv_cu) {
            $nv_cu->tuoi = 36;
            $nv_cu->save();
        }
        // cap nhat hang loat
        NhanVien::where('ten_nv', 'Davis')->update(['tuoi' => 40]);

        dd("Da cap nhat xong");
    }

    public function testXoa() {
        // Xoa co quy trinh
        $nv = NhanVien::find(10);
        if ($nv) {
            $nv->delete();
        }

        // Xoa toc do theo ID
        NhanVien::destroy(11);
        NhanVien::destroy([12, 13]);

        dd("Da sa thai hoan tat");
    }

    public function testScope() {
        $ds_ky_cuu = NhanVien::kyCuu()->get();
        $ds_ket_hop = NhanVien::kyCuu()->where('ten_nv', 'Davis')->get();

        dd($ds_ket_hop);
    }
}
