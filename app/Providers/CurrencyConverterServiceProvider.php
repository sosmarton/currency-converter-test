<?php

namespace App\Providers;

use \App\Services\CurrencyConverterManagerService;
use Illuminate\Support\ServiceProvider;


class CurrencyConverterServiceProvider extends ServiceProvider
{



    public $bindings = [
        CurrencyConverterServiceProvider::class => CurrencyConverterManagerService::class,
    ];
    public $singletons = [
        CurrencyConverterServiceProvider::class => CurrencyConverterManagerService::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {

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
