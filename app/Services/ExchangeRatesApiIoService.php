<?php

namespace App\Services;

use App\Helpers\CurrencyHelper as CurrencyHelper;
use App\Interfaces\CurrencyConverterApiInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ExchangeRatesApiIoService implements CurrencyConverterApiInterface
{
    public function __construct()
    {
        $this->config_object = new \stdClass();
        $this->config_object->api_uri = env('EXCHANGE_RATES_API_URI');
        $this->config_object->api_key = env('EXCHANGE_RATES_API_KEY');
        $this->config_object->sleep_delay = env('API_SLEEP_DELAY');
        $this->config_object->currencies = implode(',',config('currencyapis.currencies'));

    }


    public function RequestRateForCurrency(bool|string $currency_string = false): \Illuminate\Http\Client\Response|int
    {

        try {
            $response = Http::get($this->config_object->api_uri, [
                'symbols' => $this->$this->config_object->currencies,
                "access_key" => $this->$this->config_object->api_key
            ]);
        } catch (\Throwable $e) {
            Log::emergency('General Exception occured during sending a request: ' . $e->getMessage());
            return -1;
        }

        return $response;
    }


    public function GetCurrencyRatesByCurrencyName(string $currency_name): array|int
    {
        $rate_results = [
            "name" => $currency_name
        ];

        $response = $this->RequestRateForCurrency();

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

    public function ConvertBetweenTwoCurrency(string $from_currency, string $to_currency, float $nominal_value) : array|int
    {

        $response = $this->RequestRateForCurrency();

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
