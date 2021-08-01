<?php
namespace App\Interfaces;

interface CurrencyConverterApiBaseInterface
{

    public function GetCurrencyRatesByCurrencyName(string $currency_name): int|array;

    public function ConvertBetweenTwoCurrency(string $from_currency, string $to_currency, float $nominal_value): int|array;
}

?>
