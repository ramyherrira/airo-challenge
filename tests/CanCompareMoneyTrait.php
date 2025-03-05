<?php

namespace Tests;

use App\Util\MoneyFormatter;
use Money\Money;

trait CanCompareMoneyTrait
{
    public function assertMoneyEquals(Money $money, string $amount)
    {
        $this->assertEquals($amount, MoneyFormatter::format($money));
    }
}
