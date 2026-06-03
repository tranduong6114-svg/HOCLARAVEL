<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class PhoneNumberFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^[0-9]{4}-[0-9]{3}-[0-9]{3}$/', $value)) {
            $fail('Số điện thoại phải đúng định dạng xxxx-xxx-xxx (VD: 0987-123-456).');
        }
    }
}
