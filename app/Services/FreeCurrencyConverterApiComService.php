<?php

namespace App\Services;

use App\Interfaces\CurrencyConverterApiInterface;
use Illuminate\Support\Facades\Http;
use App\Helpers\CurrencyHelper as CurrencyHelper;
use Illuminate\Support\Facades\Log;


class FreeCurrencyConverterApiComService implements CurrencyConverterApiInterface
{

    public static function GetConfigObject(): \stdClass
    {
        $object = new \stdClass();
        $object->api_uri = env('FREE_CURRENCY_CONVERTER_API_URI');
        $object->api_key = env('FREE_CURRENCY_CONVERTER_API_KEY');
        $object->sleep_delay = env('API_SLEEP_DELAY');

        return $object;
    }


    public static function RequestRateForCurrency(string|bool $currency_string = false): \Illuminate\Http\Client\Response|int
    {

        try {

            $response = Http::get(self::GetConfigObject()->api_uri, [
                'q' => $currency_string,
                'compact' => "ultra",
                "apiKey" => self::GetConfigObject()->api_key
            ]);

        } catch (\Throwable $e) {
            Log::emergency('General Exception occured during sending a request: ' . $e->getMessage());
            return -1;
        }
        return $response;

    }


    public static function GetCurrencyRatesByCurrencyName(string $currency_name): int|array
    {
        $rate_results = [
            "name" => $currency_name
        ];


        foreach (CurrencyHelper::GetAvailableCurrenciesInArrayFormat() as $to_currency) {

            $currency_string = implode("_", [$currency_name, $to_currency]);
            $response = self::RequestRateForCurrency($currency_string);

            if ($response === -1 || !$response->successful())
                return -1;

            $response_data = $response->object();

            $rate_results["rates"][] = [
                "currency" => $to_currency,
                "rate" => $response_data->$currency_string
            ];

            sleep(self::GetConfigObject()->sleep_delay);

        }

        return $rate_results;
    }

    public static function ConvertBetweenTwoCurrency(string $from_currency, string $to_currency, float $nominal_value) : int|array
    {

        $currency_string = implode("_", [$from_currency, $to_currency]);
        $response = self::RequestRateForCurrency($currency_string);

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
