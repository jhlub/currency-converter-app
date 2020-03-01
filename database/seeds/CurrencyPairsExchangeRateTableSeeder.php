<?php

use App\Models\Currency;
use App\Models\CurrencyPairExchangeRate as CurrencyPair;
use Illuminate\Database\Seeder;

class CurrencyPairsExchangeRateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = Currency::all();

        CurrencyPair::create([
            'base_currency_id' => $currencies->where('symbol', 'SGD')->first()->id,
            'quote_currency_id' => $currencies->where('symbol', 'PLN')->first()->id,
            'exchange_rate' => 2.83,
        ]);

         CurrencyPair::create([
            'base_currency_id' => $currencies->where('symbol', 'PLN')->first()->id,
            'quote_currency_id' => $currencies->where('symbol', 'SGD')->first()->id,
            'exchange_rate' => 0.35,
        ]);
    }
}
