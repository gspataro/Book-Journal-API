<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Isbn implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isbnRegex = "/^\d{10}$|^\d{13}$/";

        if (!preg_match($isbnRegex, $value)) {
            $fail('The :attribute must be a valid ISBN10 or ISBN13 number.');
        }
    }
}
