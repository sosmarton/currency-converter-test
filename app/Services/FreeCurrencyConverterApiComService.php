<?php

namespace App\Services;

use App\Interfaces\CurrencyConverterApiInterface;
use Illuminate\Support\Facades\Http;
use App\Helpers\CurrencyHelper as CurrencyHelper;
use Illuminate\Support\Facades\Log;


class FreeCurrencyConverterApiComService implements CurrencyConverterApiInterface
{
    public function __construct()
    {
        $this->config_object = new \stdClass();
        $this->config_object->api_uri = env('FREE_CURRENCY_CONVERTER_API_URI');
        $this->config_object->api_key = env('FREE_CURRENCY_CONVERTER_API_KEY');
        $this->config_object->sleep_delay = env('API_SLEEP_DELAY');

    }

    public function RequestRateForCurrency(string|bool $currency_string = false): \Illuminate\Http\Client\Response|int
    {

        try {

            $response = Http::get($this->config_object->api_uri, [
                'q' => $currency_string,
                'compact' => "ultra",
                "apiKey" => $this->config_object->api_key
            ]);

        } catch (\Throwable $e) {
            Log::emergency('General Exception occured during sending a request: ' . $e->getMessage());
            return -1;
        }
        return $response;

    }


    public function GetCurrencyRatesByCurrencyName(string $currency_name): int|array
    {
        $rate_results = [
            "name" => $currency_name
        ];


        foreach (CurrencyHelper::GetAvailableCurrenciesInArrayFormat() as $to_currency) {

            $currency_string = implode("_", [$currency_name, $to_currency]);
            $response = $this->RequestRateForCurrency($currency_string);

            if ($response === -1 || !$response->successful())
                return -1;

            $response_data = $response->object();

            $rate_results["rates"][] = [
                "currency" => $to_currency,
                "rate" => $response_data->$currency_string
            ];

            sleep($this->config_object->sleep_delay);

        }

        return $rate_results;
    }

    public function ConvertBetweenTwoCurrency(string $from_currency, string $to_currency, float $nominal_value): int|array
    {

        $currency_string = implode("_", [$from_currency, $to_currency]);
        $response = $this->RequestRateForCurrency($currency_string);

        if ($response === -1 || !$response->successful())
            return -1;

        $response_data = $response->object();

        return [
            "from" => $from_currency,
            "to" => $to_currency,
            "fromValue" => $nominal_value,
            "result" => $nominal_value * $response_data->$currency_string
        ];

    }
}
