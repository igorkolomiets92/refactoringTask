<?php
require_once __DIR__ . '/vendor/autoload.php';

foreach (explode("\n", file_get_contents($argv[1])) as $row) {

    if (empty($row)) {
        break;
    }

    if (!JsonValidator::validate($row)) {
        // send exception to logger
        continue;
    }

    $data = json_decode($row);


    try {
        $countries = new Countries();
        $isEuCountry = $countries->isEuCountryByBin((int) $data->bin);

        $rate = (new Rates())->getRateByCurrency($data->currency);

        echo Commission::calculate($data->currency, $data->amount, $rate, $isEuCountry);
    } catch (Exception $e) {
        //log exceptions
    }


    print "\n";
}