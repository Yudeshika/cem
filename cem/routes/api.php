<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExchangeRateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//  authenticated api route for store currency
Route::middleware('auth:api')->post('/currencies', [CurrencyController::class, 'store']);

//  authenticated api route for get exchange rate
Route::middleware('auth:api')->get('/exchange-rates/{date}', [ExchangeRateController::class, 'getExchangeRate']);

