<?php

namespace App\Http\Controllers;

use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;
use App\Services\CurrencyConverterManagerService;
use App\Http\Requests\RateRequest;

class RateController extends Controller
{
    public function GetAllRateByCurrencyName(RateRequest $request) : array
    {
        $validated = $request->validated();

        $result = CurrencyConverterManagerService::GetCurrencyRatesByCurrencyName($validated["fromCurrency"]);

        if ($result == [-1])
            return ["error" => "Fatal Error - no api can be reached"];

        return $result;
    }
}
