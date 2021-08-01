<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class RouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_frontend_entry_point_is_200()
    {
        $response = Http::get(env('TEST_HOST'));
        $this->assertEquals(200,$response->status(),"Assert if frontend entry point returns status code 200.");
    }

    public function test_currencies_endpoint_is_200()
    {
        $response = Http::get(env('TEST_HOST')."/currencies");
        $this->assertEquals(200,$response->status(),"Assert if frontend entry point returns status code 200.");
    }

    public function test_currencies_endpoint_is_only_returning_environment_data_and_the_data_format_is_good()
    {
        // We are using built in function here, because it can start a web server.
        // Other tests need to be performed while the server is running
        $response = $this->get("/currencies");
        $this->assertEquals(
            explode(",",env('CURRENCIES')),
            $response->json(),
            "Assert if currencies are returned correctly. (/currencies endpoint)"
        );
    }




}
