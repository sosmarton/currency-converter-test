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
    public function test_frontend_entry_point_is_only_replying_to_head_and_get_requests()
    {
        $response = Http::post(env('TEST_HOST'));
        $this->assertEquals(405,$response->status(),"Assert if frontend entry point does not return POST.");
        $response = Http::put(env('TEST_HOST'));
        $this->assertEquals(405,$response->status(),"Assert if frontend entry point does not return put.");
        $response = Http::delete(env('TEST_HOST'));
        $this->assertEquals(405,$response->status(),"Assert if frontend entry point does not return delete.");
        $response = Http::patch(env('TEST_HOST'));
        $this->assertEquals(405,$response->status(),"Assert if frontend entry point does not return patch.");

    }

    public function test_currencies_endpoint_is_200()
    {
        $response = Http::get(env('TEST_HOST')."/currencies");
        $this->assertEquals(200,$response->status(),"Assert if frontend entry point returns status code 200.");
    }
    public function test_currencies_endpoint_is_only_replying_to_head_and_get_requests()
    {
        $currencies_endpoint = env('TEST_HOST')."/currencies";
        $response = Http::post($currencies_endpoint);
        $this->assertEquals(405,$response->status(),"Assert if frontend entry point does not return POST.");
        $response = Http::put($currencies_endpoint);
        $this->assertEquals(405,$response->status(),"Assert if frontend entry point does not return put.");
        $response = Http::delete($currencies_endpoint);
        $this->assertEquals(405,$response->status(),"Assert if frontend entry point does not return delete.");
        $response = Http::patch($currencies_endpoint);
        $this->assertEquals(405,$response->status(),"Assert if frontend entry point does not return patch.");

    }

    public function test_convert_endpoint_is_only_replying_to_post_requests()
    {
        $endpoint = env('TEST_HOST')."/convert";
        $response = Http::get($endpoint);
        $this->assertEquals(405,$response->status(),"Assert if convert endpoint does not return get.");

        $response = Http::head($endpoint);
        $this->assertEquals(405,$response->status(),"Assert if convert endpoint does not return head.");

        $response = Http::put($endpoint);
        $this->assertEquals(405,$response->status(),"Assert if convert endpoint does not return put.");
        $response = Http::delete($endpoint);
        $this->assertEquals(405,$response->status(),"Assert if convert endpoint does not return delete.");
        $response = Http::patch($endpoint);
        $this->assertEquals(405,$response->status(),"Assert if convert endpoint does not return patch.");

    }
    public function test_rates_endpoint_is_only_replying_to_head_and_get_requests()
    {
        $endpoint = env('TEST_HOST')."/rates/0";
        $response = Http::post($endpoint);
        $this->assertEquals(405,$response->status(),"Assert if rates endpoint does not return POST.");
        $response = Http::put($endpoint);
        $this->assertEquals(405,$response->status(),"Assert if rates endpoint does not return put.");
        $response = Http::delete($endpoint);
        $this->assertEquals(405,$response->status(),"Assert if rates endpoint does not return delete.");
        $response = Http::patch($endpoint);
        $this->assertEquals(405,$response->status(),"Assert if rates endpoint does not return patch.");

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
