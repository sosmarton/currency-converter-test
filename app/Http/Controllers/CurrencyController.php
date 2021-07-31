<?php

namespace App\Http\Controllers;
use App\Helpers\CurrencyHelper as CurrencyHelper;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function ListAllCurrency() : array
    {

        return CurrencyHelper::GetAvailableCurrenciesInArrayFormat();

    }
}
