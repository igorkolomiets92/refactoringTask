<?php

class CommissionTest extends PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider commissionDataProvider
     */
    public function testCalculateCommission($currency, $amount, $rate, $isEuCountry, $expectedCommission)
    {
        $commission = Commission::calculate($currency, $amount, $rate, $isEuCountry);
        $this->assertEquals($expectedCommission, $commission);
    }

    public function commissionDataProvider()
    {
        return [
            ['EUR', 100, 1, true, 1],
            ['USD', 100, 1.2, true, 0.02],
            ['GBP', 100, 0, true, 2],
            ['JPY', 100, 0.008, false, 2],
            ['BGN', 100, 1.95, true, 0.02],
        ];
    }
}
