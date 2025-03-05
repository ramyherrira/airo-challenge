<?php

namespace App\Util;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

class MoneyFormatter
{
    public static function format(Money $money): string
    {
        return (new DecimalMoneyFormatter(new ISOCurrencies()))->format($money);
    }
}

