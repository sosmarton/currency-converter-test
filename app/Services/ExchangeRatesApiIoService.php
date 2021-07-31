<?php

namespace App\Services;

use App\Helpers\CurrencyHelper as CurrencyHelper;
use App\Interfaces\CurrencyConverterApiInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ExchangeRatesApiIoService implements CurrencyConverterApiInterface
{
    public static function GetConfigObject()
    {
        $object = new stdClass();
        $object->api_uri = env('EXCHANGE_RATES_API_URI');
        $object->api_key = env('EXCHANGE_RATES_API_KEY');
        $object->sleep_delay = env('API_SLEEP_DELAY');
        $object->currencies = env('CURRENCIES');

        return $object;
    }



    public static function RequestRateForCurrency($currency_string = false)
    {

        try
        {
            $response = Http::get(self::GetConfigObject()->api_uri, [
                'symbols' => self::GetConfigObject()->currencies,
                "access_key" => self::GetConfigObject()->api_key
            ]);
        }
        catch (\Throwable $e)
        {
            Log::emergency('General Exception occured during sending a request: ' . $e->getMessage());
            return -1;
        }

        return $response;
    }


    public static function GetCurrencyRatesByCurrencyName($currency_name)
    {
        $rate_results = [
            "name" => $currency_name
        ];

        $response = self::RequestRateForCurrency();

        if ($response === -1 || !$response->successful())
            return -1;

        $response_data = $response->object();


        foreach (CurrencyHelper::GetAvailableCurrenciesInArrayFormat() as $to_currency) {

            // EUR to CUSTOM rates
            $rates = $response_data->rates;

            $rate_results["rates"][] = [
                "currency" => $to_currency,
                "rate" => CurrencyHelper::ConvertFromEuroToCustomCurrency(
                    $rates->$currency_name,
                    $rates->$to_currency
                )
            ];

            //sleep($this->sleep_delay);

        }

        return $rate_results;
    }

    public static function ConvertBetweenTwoCurrency($from_currency, $to_currency, $nominal_value)
    {

        $response = self::RequestRateForCurrency();

        if ($response === -1 || !$response->successful())
            return -1;

        $response_data = $response->object();
        $rates = $response_data->rates;

        return [
            "from" => $from_currency,
            "to" => $to_currency,
            "fromValue" => $nominal_value,
            "result" => $nominal_value * CurrencyHelper::ConvertFromEuroToCustomCurrency(
                    $rates->$from_currency,
                    $rates->$to_currency
                )
        ];

    }

}
