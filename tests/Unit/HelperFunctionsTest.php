<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Config;
use \App\Helpers\CurrencyHelper;
use Tests\TestCase;

class HelperFunctionsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


    public function test_CurrencyHelper_GetAvailableCurrenciesInArrayFormat_function_returns_valid_array()
    {
        $return_array = CurrencyHelper::GetAvailableCurrenciesInArrayFormat();

        $this->assertTrue(
            is_array($return_array)
            &&
            $return_array === Config::get("currencyapis.currencies")
        );
    }

    public function test_CurrencyHelper_ConvertFromEuroToCustomCurrency_function_returns_valid_data()
    {
        $this->assertEquals(
            2,
            CurrencyHelper::ConvertFromEuroToCustomCurrency(2, 2, 2)
        );
    }
}
