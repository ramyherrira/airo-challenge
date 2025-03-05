<?php

namespace App\Services;

use Carbon\CarbonImmutable;
use Money\Currency;
use Money\Money;

class PolicyCalculator
{
    const POLICY_FIXED_RATE = 3;

    public function calculate(
        Currency $currency,
        CarbonImmutable $startDate,
        CarbonImmutable $endDate,
        array $ageList
    ): Money {
        $durationInDays = $startDate->diffInDays($endDate, true) + 1;

        $ageLoadSum = array_sum(
            array_map(fn($age) => $this->resolveLoad(($age)) * 100, $ageList)
        );

        return new Money($ageLoadSum * self::POLICY_FIXED_RATE * $durationInDays, $currency);
    }

    public function resolveLoad(int $age): float
    {
        return match (true) {
            $age >= 18 && $age <= 30 => 0.6,
            $age >= 31 && $age <= 40 => 0.7,
            $age >= 41 && $age <= 50 => 0.8,
            $age >= 51 && $age <= 60 => 0.9,
            $age >= 61 && $age <= 70 => 1,
            default => throw new \InvalidArgumentException("Provided age: {$age} is invalid"),
        };
    }
}
