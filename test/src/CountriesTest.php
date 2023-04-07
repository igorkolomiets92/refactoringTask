<?php

class CountriesTest extends PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider validEuCountriesProvider
     */
    public function testIsEuCountryReturnsTrueForValidEuCountry($countryCode)
    {
        $this->assertTrue(Countries::isEuCountry($countryCode));
    }

    /**
     * @dataProvider invalidEuCountriesProvider
     */
    public function testIsEuCountryReturnsFalseForInvalidEuCountry($countryCode)
    {
        $this->assertFalse(Countries::isEuCountry($countryCode));
    }

    public function validEuCountriesProvider()
    {
        return [
            ['AT'],
            ['BE'],
            ['BG'],
            ['CY'],
            ['CZ'],
            ['DE'],
            ['DK'],
            ['EE'],
            ['ES'],
            ['FI'],
            ['FR'],
            ['GR'],
            ['HR'],
            ['HU'],
            ['IE'],
            ['IT'],
            ['LT'],
            ['LU'],
            ['LV'],
            ['MT'],
            ['NL'],
            ['PL'],
            ['PT'],
            ['RO'],
            ['SE'],
            ['SI'],
            ['SK'],
        ];
    }

    public function invalidEuCountriesProvider()
    {
        return [
            ['AU'], // Australia
            ['CA'], // Canada
            ['CN'], // China
            ['JP'], // Japan
            ['US'], // United States
            ['RU'], // Russia
        ];
    }
}
