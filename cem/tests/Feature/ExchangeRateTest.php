<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExchangeRateTest extends TestCase
{
    // get exchange rate with valid data
    public function testGetExchangeRateWithValidData()
    {
        $date = now()->toDateString();

        // Act: Make a GET request to the /api/exchange-rates endpoint

        $response = $this->getJson("/api/exchange-rates/{$date}");
        dd($response);
         // Assert: Verify response structure and data 
         $response->assertStatus(200) ->assertJson([ 
            [ 'currency' => 'USD', 'rate' => 1.0, ], 
            [ 'currency' => 'EUR', 'rate' => 0.85, ], 
            [ 'currency' => 'GBP', 'rate' => 0.75, ],
         ]);  
    }

}
