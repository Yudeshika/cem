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
        $currency = 'EUR';
        // create a new instance of the ExchangeRateService
        $exchangeRateService = new ExchangeRateService();

        // get the exchange rate for USD to EUR
        $exchangeRate = $exchangeRateService->getExchangeRate([$currency]);

        // assert that the exchange rate is a float
        $this->assertIsFloat($exchangeRate[$currency]);
    }
}