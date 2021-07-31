<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class CurrencyHelper
{
    public static function GetAvailableCurrenciesInArrayFormat() : int|array
    {
        try {
            $currencies = env('CURRENCIES');
            return explode(',', $currencies);
        }
        catch (\Throwable $e) {
            Log::emergency( 'General Exception occured during currency import: ' . $e->getMessage());
            return -1;
        }
    }

    public static function ConvertFromEuroToCustomCurrency(float $from_currency_euro_ratio, float $to_currency_euro_ratio, float $nominal_value = 1.0) : float
    {
        return 1/$from_currency_euro_ratio * $to_currency_euro_ratio * $nominal_value;
    }
}

?>
