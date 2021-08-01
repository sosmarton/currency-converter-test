<?php

namespace App\Http\Controllers;
use App\Interfaces\CurrencyConverterApiInterface;
use App\Interfaces\CurrencyConverterApiManagerInterface;
use App\Services\ExchangeRatesApiIoService;
use App\Services\FreeCurrencyConverterApiComService;
use Illuminate\Http\Request;

class CurrencyDataManagerController extends Controller implements CurrencyConverterApiManagerInterface
{
    private string $currency_converter_interface;

    public function __construct()
    {
        $this->currency_converter_interface = CurrencyConverterApiInterface::class;
    }
    public function GetServices() : array
    {
        return config('currencyapis.api_classes');
    }

    public function GetCurrencyRatesByCurrencyName(string $currency_name) : int|array
    {
        foreach ($this->GetServices() as $service) {
            app()->bind($this->currency_converter_interface,$service);

            $result = app()->make($this->currency_converter_interface)->GetCurrencyRatesByCurrencyName($currency_name);

            if ($result != -1)
                return $result;
        }
        return -1;
    }

    public function ConvertBetweenTwoCurrency(string $from_currency, string $to_currency,float $nominal_value) : int|array
    {
        foreach ($this->GetServices() as $service) {
            app()->bind($this->currency_converter_interface,$service);
            $result = app()->make($this->currency_converter_interface)->ConvertBetweenTwoCurrency($from_currency, $to_currency, $nominal_value);

            if ($result != -1)
                return $result;
        }
        return -1;
    }

}
