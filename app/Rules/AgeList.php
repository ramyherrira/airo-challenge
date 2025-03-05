<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AgeList implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $list = explode(',', trim($value, ','));

        foreach ($list as $element) {
            if (!filter_var($element, FILTER_VALIDATE_INT)) {
                $fail('Age list is invalid.');
                return;
            }

            $age = (int) $element;
            if ($age < 18 || $age > 70) {
                $fail('Age list is invalid.');
                return;
            }
        }
    }
}
