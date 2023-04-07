<?php

class JsonValidator
{
    public static function validate(string $jsonString): bool
    {
        $data = json_decode($jsonString);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        if (empty($data->bin) || !ctype_digit($data->bin)) {
            return false;
        }

        if (empty($data->amount) || !preg_match('/^\d+\.\d{2}$/', $data->amount)) {
            return false;
        }

        if (empty($data->currency) || strlen($data->currency) > 3) {
            return false;
        }

        return true;
    }
}