<?php

namespace App\Providers;

use App\Interfaces\CurrencyConverterApiInterface;
use App\Interfaces\CurrencyConverterApiManagerInterface;
use \App\Services\CurrencyConverterManagerService;
use App\Services\FreeCurrencyConverterApiComService;
use Illuminate\Support\ServiceProvider;


class CurrencyConverterServiceProvider extends ServiceProvider
{


    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {
        $this->app->bind(CurrencyConverterApiInterface::class,FreeCurrencyConverterApiComService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
