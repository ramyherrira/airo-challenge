<?php

namespace Tests\Unit;

use App\Services\PolicyCalculator;
use Carbon\CarbonImmutable;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Tests\CanCompareMoneyTrait;

class PolicyCalculatorTest extends TestCase
{
    use CanCompareMoneyTrait;
    
    public function test_calculate_a_policy_with_a_single_client()
    {
        $service = new PolicyCalculator();

        $price = $service->calculate(
            new Currency('EUR'),
            new CarbonImmutable('2020-10-01'),
            new CarbonImmutable('2020-10-30'),
            [18]
        );

        $this->assertTrue($price instanceof Money);
        $this->assertMoneyEquals($price, '54.00');
    }

    public function test_calculate_a_policy_with_multiple_clients()
    {
        $service = new PolicyCalculator();

        $price = $service->calculate(
            new Currency('EUR'),
            new CarbonImmutable('2020-10-01'),
            new CarbonImmutable('2020-10-30'),
            [18, 35]
        );

        $this->assertMoneyEquals($price, '117.00');
    }

    public function test_get_age_load_table()
    {
        $service = new PolicyCalculator();

        $this->assertEquals(0.6, $service->resolveLoad(18));
        $this->assertEquals(0.7, $service->resolveLoad(38));
        $this->assertEquals(0.8, $service->resolveLoad(45));
        $this->assertEquals(0.9, $service->resolveLoad(52));
        $this->assertEquals(1, $service->resolveLoad(66));

        $this->expectException(\InvalidArgumentException::class);
        $service->resolveLoad(75);
    }
}
