<?php

use \fileReader\FileReaderInterface;
use \fileReader\FileReader;

class Rates {
    private array $rates = [];
    private FileReaderInterface $fileReader;

    public function __construct(FileReaderInterface $fileReader = new FileReader())
    {
        $this->fileReader = $fileReader;
        $this->fillRates();
    }

    /**
     * @throws Exception
     */
    private function fillRates(string $apiKey = 'testApiKey'): void
    {
        $url = 'https://api.exchangeratesapi.io/latest?access_key=' . $apiKey;
        $content = $this->fileReader->read($url);
        $data = json_decode($content, true);
        if (isset($data['rates'])) {
            $this->rates = $data['rates'];
        } else {
            throw new Exception('Unable to get exchange rate');
        }
    }

    public function getRateByCurrency(string $currency)
    {
        return (isset($this->rates[$currency])) ? $this->rates[$currency] : null;
    }
}