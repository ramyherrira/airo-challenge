<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Money\Currencies\ISOCurrencies;
use Money\Currency as MoneyCurrency;

class Currency implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $currencies = new ISOCurrencies();

        if (!$currencies->contains(new MoneyCurrency($value))) {
            $fail("Currency {$value} is invalid.");
        }
    }
}
