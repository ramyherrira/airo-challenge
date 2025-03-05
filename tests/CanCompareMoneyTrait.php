<?php

namespace Tests;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

trait CanCompareMoneyTrait
{
    protected function formatMoney(Money $money)
    {
        return (new DecimalMoneyFormatter(new ISOCurrencies()))->format($money);
    }

    public function assertMoneyEquals(Money $money, string $amount)
    {
        $this->assertEquals($amount, $this->formatMoney($money));
    }
}
