<?php
namespace App\Interfaces;

use App\Services\CurrencyConverterManagerService;

interface CurrencyConverterApiInterface extends CurrencyConverterApiBaseInterface
{
    public static function RequestRateForCurrency(string|bool $currency_string = false) : \Illuminate\Http\Client\Response | int;
}

?>
