<?php

namespace App\Http\Controllers;

use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;
use App\Http\Requests\RateRequest;
use App\Services\CurrencyConverterManagerService;

class RateController extends CurrencyDataManagerController
{
    public function GetAllRateByCurrencyName(RateRequest $request) : array
    {
        $validated = $request->validated();

        $result = $this->GetCurrencyRatesByCurrencyName($validated["fromCurrency"]);

        if ($result === -1)
            return ["error" => "Fatal Error - no api can be reached"];

        return $result;
    }
}
