<?php
namespace App\Interfaces;

interface CurrencyConverterApiBaseInterface
{

    public static function GetCurrencyRatesByCurrencyName(string $currency_name): int|array;

    public static function ConvertBetweenTwoCurrency(string $from_currency, string $to_currency, float $nominal_value): int|array;
}

?>
