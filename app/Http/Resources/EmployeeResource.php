<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'ma_nhan_vien' => $this->employee_code,
            'ho_ten'       => $this->full_name,
            'thong_tin_lien_he' => [
                'email' => $this->email,
                'sdt'   => $this->phone ?? 'Chưa có SDT'
            ],
            'luong_co_ban' => number_format($this->base_salary) . ' VNĐ',
            'phong_ban'    => $this->department->name ?? 'Không có',
        ];
    }
}