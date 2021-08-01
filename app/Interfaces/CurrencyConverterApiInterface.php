<?php
namespace App\Interfaces;

use App\Services\CurrencyConverterManagerService;

interface CurrencyConverterApiInterface extends CurrencyConverterApiBaseInterface
{
    public function RequestRateForCurrency(string|bool $currency_string = false) : \Illuminate\Http\Client\Response | int;
}

?>
