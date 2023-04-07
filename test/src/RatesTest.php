<?php

use PHPUnit\Framework\TestCase;

class RatesTest extends TestCase
{
    private function getFileReaderMock(string $url, $returnValue)
    {
        $fileReader = $this->createMock(FileReaderInterface::class);
        $fileReader->expects($this->once())
            ->method('read')
            ->with($url)
            ->willReturn($returnValue);

        return $fileReader;
    }

    public function testGetRateByCurrency()
    {
        $fileReader = $this->getFileReaderMock(
            'https://api.exchangeratesapi.io/latest',
            '{"rates":{"EUR":1.0,"USD":1.18},"base":"EUR","date":"2023-04-08"}'
        );

        $rates = new Rates($fileReader);

        $this->assertEquals(1.0, $rates->getRateByCurrency('EUR'));
        $this->assertEquals(1.18, $rates->getRateByCurrency('USD'));
        $this->assertNull($rates->getRateByCurrency('GBP'));
    }

    public function testFillRatesThrowsExceptionOnInvalidResponse()
    {
        $fileReader = $this->getFileReaderMock(
            'https://api.exchangeratesapi.io/latest',
            '{"error":"invalid response"}'
        );

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unable to get exchange rate');

        $rates = new Rates($fileReader);
    }

    public function testFillRatesThrowsExceptionOnApiError()
    {
        $fileReader = $this->getFileReaderMock(
            'https://api.exchangeratesapi.io/latest',
            new Exception('API error')
        );

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unable to get exchange rate');

        $rates = new Rates($fileReader);
    }
}
