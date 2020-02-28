<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => 'Singapore Dollar',
            'symbol' => 'SGD',
        ]);

        Currency::create([
            'name' => 'Polish Zloty',
            'symbol' => 'PLN',
        ]);
    }
}
