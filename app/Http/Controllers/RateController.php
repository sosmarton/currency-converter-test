<?php

namespace App\Http\Controllers;

use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;
use App\Http\Requests\RateRequest;
use App\Services\CurrencyConverterManagerService;

class RateController extends Controller
{
    public function GetAllRateByCurrencyName(RateRequest $request, CurrencyConverterManagerService $converter_manager) : array
    {
        $validated = $request->validated();

        $result = $converter_manager->GetCurrencyRatesByCurrencyName($validated["fromCurrency"]);

        if ($result === -1)
            return ["error" => "Fatal Error - no api can be reached"];

        return $result;
    }
}
