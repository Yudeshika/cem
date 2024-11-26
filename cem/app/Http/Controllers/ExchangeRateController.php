<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExchangeRateRequest;
use App\Http\Requests\UpdateExchangeRateRequest;
use App\Models\ExchangeRate;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExchangeRateController extends Controller
{
    /**
     * Get the exchange rate for a given date.
     *
     * @param  string  $date
     * @return \Illuminate\Http\Response
     */
    public function getExchangeRate($date){
        // get the exchange rate for the given date
        $rates = ExchangeRate::with('currency')->whereDate('date', $date)->get();
        // return the exchange rates with currency names

        // loop through the exchange rates and add the currency name
        foreach ($rates as $rate) {
            $rate->currency_name = $rate->currency->name;
        }

        // pluck the exchange rates and currency names
        $rates = $rates->pluck('rate', 'currency_name');

        return response()->json($rates);
    }
}
