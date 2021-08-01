<?php

use App\Services\ExchangeRatesApiIoService;
use App\Services\FreeCurrencyConverterApiComService;

return [
    'api_classes' => [
        FreeCurrencyConverterApiComService::class,
        ExchangeRatesApiIoService::class
    ],
    'currencies' => [
        "EUR",
        "USD",
        "HUF",
        "GBP"
    ]
];
