<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Isbn implements ValidationRule
{
    private const PATTERN = '/^.{10}$|^.{13}$/';
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (is_string($value)) {
            if (!preg_match(self::PATTERN, $value)) {
                $fail('The :attribute must be a string of 10 or 13 symbols.');
            }
        } elseif (is_array($value)) {
            foreach ($value as $isbn) {
                if (!is_string($isbn) || !preg_match(self::PATTERN, $isbn)) {
                    $fail('Each element in :attribute must be a string of 10 or 13 symbols.');
                }
            }
        } else {
            $fail('The :attribute must be a string of 10 or 13 symbols or an array of such strings.');
        }
    }
}
