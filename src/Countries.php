<?php

use fileReader\FileReader;
use fileReader\FileReaderInterface;

class Countries
{
    const AUSTRIA = 'AT';
    const BELGIUM = 'BE';
    const BULGARIA = 'BG';
    const CYPRUS = 'CY';
    const CZECH_REPUBLIC = 'CZ';
    const GERMANY = 'DE';
    const DENMARK = 'DK';
    const ESTONIA = 'EE';
    const SPAIN = 'ES';
    const FINLAND = 'FI';
    const FRANCE = 'FR';
    const GREECE = 'GR';
    const CROATIA = 'HR';
    const HUNGARY = 'HU';
    const IRELAND = 'IE';
    const ITALY = 'IT';
    const LITHUANIA = 'LT';
    const LUXEMBOURG = 'LU';
    const LATVIA = 'LV';
    const MALTA = 'MT';
    const NETHERLANDS = 'NL';
    const POLAND = 'PO';
    const PORTUGAL = 'PT';
    const ROMANIA = 'RO';
    const SWEDEN = 'SE';
    const SLOVENIA = 'SI';
    const SLOVAKIA = 'SK';

    private FileReaderInterface $fileReader;

    public function __construct(FileReaderInterface $fileReader = new FileReader())
    {
        $this->fileReader = $fileReader;
    }

    private function getAllEuCountries(): array
    {
        return [
            self::AUSTRIA,
            self::BELGIUM,
            self::BULGARIA,
            self::CYPRUS,
            self::CZECH_REPUBLIC,
            self::GERMANY,
            self::DENMARK,
            self::ESTONIA,
            self::SPAIN,
            self::FINLAND,
            self::FRANCE,
            self::GREECE,
            self::CROATIA,
            self::HUNGARY,
            self::IRELAND,
            self::ITALY,
            self::LITHUANIA,
            self::LUXEMBOURG,
            self::LATVIA,
            self::MALTA,
            self::NETHERLANDS,
            self::POLAND,
            self::PORTUGAL,
            self::ROMANIA,
            self::SWEDEN,
            self::SLOVENIA,
            self::SLOVAKIA,
        ];
    }

    public function isEuCountry(string $countryIsoCode): bool
    {
        return in_array($countryIsoCode, self::getAllEuCountries());
    }

    /**
     * @throws Exception
     */
    public function getCountryAlpha2(int $bin): string
    {
        $url = 'https://lookup.binlist.net/' . $bin;
        $binResults = $this->fileReader->read($url);
        if (!$binResults) {
            throw new \Exception('Unable to get binlist');
        }

        $data = json_decode($binResults, true);

        if (!$data || !isset($data['country']) || !isset($data['country']['alpha2'])) {
            throw new \Exception('Invalid binlist data');
        }

        return $data['country']['alpha2'];
    }

    /**
     * @throws Exception
     */
    public function isEuCountryByBin(int $bin): bool
    {
        $alpha2 = $this->getCountryAlpha2($bin);
        return $this->isEuCountry($alpha2);
    }
}
