<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    /** @use HasFactory<\Database\Factories\NhanVienFactory> */
    use HasFactory;

    // Dinh vi Database
    protected $table = 'nhan_vien';
    
    // Dinh vi Khoa chinh
    protected $primaryKey = 'id';

    // Mass Assignment
    protected $fillable = [
        'ma_nv',
        'ten_nv',
        'tuoi',
        'sdt'        
    ];

    public function scopeKyCuu($query) {
        return $query->where('tuoi', '>', 40);
    }
}
