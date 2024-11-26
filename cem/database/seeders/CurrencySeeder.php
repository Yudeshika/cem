<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            ['name' => 'LKR', 'symbol' => 'LKR'],
            ['name' => 'EUR', 'symbol' => 'EUR'],
            ['name' => 'GBP', 'symbol' => 'GBP'],
            ['name' => 'JPY', 'symbol' => 'JPY'],
            ['name' => 'AUD', 'symbol' => 'AUD'],
            ['name' => 'CAD', 'symbol' => 'CAD'],
            ['name' => 'CHF', 'symbol' => 'CHF'],
            ['name' => 'CNY', 'symbol' => 'CNY'],
            ['name' => 'INR', 'symbol' => 'INR'],
            ['name' => 'BRL', 'symbol' => 'BRL']
        ];

        foreach ($currencies as $currency) {
            Currency::create([ 'name' => $currency['name'], 'symbol' => $currency['symbol'], ]);
        }
    }
}
