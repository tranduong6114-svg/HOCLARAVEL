<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PhoneNumberFormat;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_code' => 'required|unique:employees|max:20',
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:employees',
            'base_salary'   => 'required|numeric|min:0',
            'department_id' => 'required|exists:departments,id',
            'position_id'   => 'required|exists:positions,id',
            'project_ids'   => 'nullable|array',
            'project_ids.*' => 'exists:projects,id',
            'phone' => ['nullable', new PhoneNumberFormat()]
        ];
    }

    public function messages(): array
    {
        return [
            'employee_code.required' => 'Mã nhân viên không được để trống.',
            'employee_code.unique'   => 'Mã nhân viên này đã tồn tại trong hệ thống.',
            'email.required'         => 'Email là bắt buộc nhập.',
            'email.email'            => 'Định dạng email không hợp lệ.',
            'email.unique'           => 'Email này đã được sử dụng.',
            'base_salary.required'   => 'Vui lòng nhập lương cơ bản.',
            'base_salary.numeric'    => 'Lương cơ bản phải là số.',
            'department_id.required' => 'Vui lòng chọn phòng ban.',
            'position_id.required'   => 'Vui lòng chọn chức vụ.'
        ];
    }
}
