<?php

use PHPUnit\Framework\TestCase;

class JsonValidatorTest extends TestCase
{
    public function testValidJson(): void
    {
        $json = '{"bin":"123123123","amount":"100.00","currency":"EUR"}';
        $validator = new JsonValidator();
        $this->assertTrue($validator->isValid($json));
    }

    public function testEmptyJson(): void
    {
        $json = '';
        $validator = new JsonValidator();
        $this->assertFalse($validator->isValid($json));
    }

    public function testInvalidBin(): void
    {
        $json = '{"bin":"12312312a","amount":"100.00","currency":"EUR"}';
        $validator = new JsonValidator();
        $this->assertFalse($validator->isValid($json));
    }

    public function testInvalidAmount(): void
    {
        $json = '{"bin":"123123123","amount":"100","currency":"EUR"}';
        $validator = new JsonValidator();
        $this->assertFalse($validator->isValid($json));
    }

    public function testInvalidCurrency(): void
    {
        $json = '{"bin":"123123123","amount":"100.00","currency":"EURO"}';
        $validator = new JsonValidator();
        $this->assertFalse($validator->isValid($json));
    }

    public function testInvalidJson(): void
    {
        $json = '{"bin""123123123","amount":"100.00","currency":"EUR"}';
        $validator = new JsonValidator();
        $this->assertFalse($validator->isValid($json));
    }
}
