<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    //protected $table = 'currencies';

    /**
     * Get the base_currencies for the currency.
     */
    public function base_currencies() {
        return $this->hasMany('App\Models\CurrencyPairExchangeRate', 'base_currency_id', 'id');
    }

    /**
     * Get the quote_currencies for the currency.
     */
    public function quote_currencies() {
        return $this->hasMany('App\Models\CurrencyPairExchangeRate', 'quote_currency_id', 'id');
    }


    /**
     * Check if currency with provided symbol exists.
     *
     * @param string $symbol
     * @return bool
     */
    public static function isCurrencyBySymbolExists($symbol)
    {
        $isCurrencyExists = false;

        $currency = Currency::where('symbol', $symbol)->first();

        if ($currency !== null) {
            $isCurrencyExists = true;
        }

        return $isCurrencyExists;
    }
}
