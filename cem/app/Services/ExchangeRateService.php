<?php

namespace App\Services;

use App\Models\ExchangeRate;
use App\Models\Currency;
use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    // create protected variables for the base url and the api key
    protected $baseUrl;
    protected $apiKey;

    // create a constructor that sets the base url and the api key
    public function __construct()
    {
        $this->baseUrl = config('services.currency.base_url');
        $this->apiKey = config('services.currency.api_key');
    }

    // create a method to get the exchange rate for USD to a given currency
    // public function getExchangeRate($currency)
    // {
    //     // get the exchange rate from the api using  exchangeratesapi.io
    //     $response = Http::get("{$this->baseUrl}/latest", [
    //         'access_key' => $this->apiKey,
    //         'symbols' => $currency,
    //     ]);

    //     // return the exchange rate
    //     return $response['rates'][$currency];


    //     // $response = Http::get("{$this->baseUrl}/latest", [
    //     //     'access_key' => $this->apiKey,
    //     //     'symbols' => $currency,
    //     // ]);

    //     // // return the exchange rate
    //     // return $response['rates'][$currency];
    // }

    public function getExchangeRate(string $baseCurrency = 'USD')
    {
        // Get the list of currencies from the database
        $currencies = Currency::all()->pluck('symbol')->toArray();

        // Prepare the URL and query parameters
        $url = $this->baseUrl . 'latest.json?app_id=' . $this->apiKey . '&base=' . $baseCurrency;

        // Send GET request to the external API
        $response = Http::get($url);

        // Check if the request was successful
        if ($response->successful()) {
            // Get the exchange rates from the response
            $exchangeRates = $response->json()['rates'];

            // Filter the exchange rates based on the symbols and base currency
            $filteredExchangeRates = array_filter($exchangeRates, function ($key) use ($currencies) {
                return in_array($key, $currencies);
            }, ARRAY_FILTER_USE_KEY);

            return $filteredExchangeRates;  // Return the filtered exchange rates
        } else {
            // Handle errors 
            return [
                'error' => 'Unable to fetch exchange rates. Please try again later.'
            ];
        }
    }

}
