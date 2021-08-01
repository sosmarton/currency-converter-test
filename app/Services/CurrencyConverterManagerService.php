<?php

namespace App\Services;

use App\Interfaces\CurrencyConverterApiInterface;
use App\Interfaces\CurrencyConverterApiManagerInterface;
use Illuminate\Contracts\Support\Arrayable;

class CurrencyConverterManagerService implements CurrencyConverterApiManagerInterface
{
    public function GetServices() : array
    {
        return [
            new FreeCurrencyConverterApiComService(),
            new ExchangeRatesApiIoService()
        ];
    }

    public function GetCurrencyRatesByCurrencyName(string $currency_name) : int|array
    {
        foreach ($this->GetServices() as $service) {
            $result = $service->GetCurrencyRatesByCurrencyName($currency_name);

            if ($result != -1)
                return $result;
        }
        return -1;
    }

    public function ConvertBetweenTwoCurrency(string $from_currency, string $to_currency,float $nominal_value) : int|array
    {
        foreach ($this->GetServices() as $service) {
            $result = $service->ConvertBetweenTwoCurrency($from_currency, $to_currency, $nominal_value);

            if ($result != -1)
                return $result;
        }
        return -1;
    }
}
