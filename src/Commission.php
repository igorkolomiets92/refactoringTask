<?php

class Commission
{

    public static function calculate($currency, $amount, $rate, $isEuCountry): float
    {
        $amntFixed = 0;

        if ($currency == 'EUR' || $rate == 0) {
            $amntFixed = $amount;
        } elseif ($rate > 0) {
            $amntFixed = $amount / $rate;
        }

        return $amntFixed * ($isEuCountry ? 0.01 : 0.02);
    }
}