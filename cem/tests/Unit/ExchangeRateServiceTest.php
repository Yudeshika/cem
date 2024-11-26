<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ExchangeRateService;

class ExchangeRateServiceTest extends TestCase
{
    use RefreshDatabase;

    // test get exchange rate
    public function testGetExchangeRate()
    {
        // Run the DatabaseSeeder
        $this->seed();
        
        // create a new instance of the ExchangeRateService
        $exchangeRateService = new ExchangeRateService();

        // get the exchange rate for USD to all currencies in the database
        $exchangeRate = $exchangeRateService->getExchangeRate();

        // assert that the exchange rate is an array
        $this->assertIsArray($exchangeRate);
    }
}