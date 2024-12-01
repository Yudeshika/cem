<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class ExchangeRateTest extends TestCase
{
    // get exchange rate with valid data
    public function testGetExchangeRateWithValidData()
    {
        $date = now()->toDateString();

        // Act: Make a GET request to the /api/exchange-rates endpoint

        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->getJson("/api/exchange-rates/{$date}");


         // Assert: Verify response structure and data 
         $response->assertStatus(200);
        //  this one needs to be further improved to check the response data returned as an array
    }

}
