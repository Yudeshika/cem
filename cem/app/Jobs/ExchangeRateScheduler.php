<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Services\ExchangeRateService;
use Log;
use Illuminate\Support\Facades\Queue;

class ExchangeRateScheduler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug('Job started...');

        // create a new instance of the ExchangeRateService
        $exchangeRateService = new ExchangeRateService();

        // get the exchange rate for USD to all currencies in the database
        $exchangeRate = $exchangeRateService->getExchangeRate();

        Log::debug('Exchange rate: ' . json_encode($exchangeRate));

        // update the exchange rate for each currency in the database
        foreach ($exchangeRate as $currency => $rate) {
            $currency = Currency::where('name', $currency)->first();
            $exchangeRate = ExchangeRate::where('currency_id', $currency->id)
            ->whereDate('date', now()->toDateString())
            ->first();

            // if ($exchangeRate) {
            //     $exchangeRate->update(['rate' => $rate]);
            // } else {
                ExchangeRate::create([
                    'currency_id' => $currency->id,
                    'date' => now(),
                    'rate' => $rate,
                ]);
            // }
        }
    }
}
