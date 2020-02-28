<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyPairExchangeRate extends Model
{

    /**
     * @var array
     */
    protected const CURRENCY_PAIRS = [
        'SGD_TO_PLN' => 2.83,
        'PLN_TO_SGD' => 0.35,
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currency_pairs_exchange_rate';

    /**
     * Get the currency that is set as base_currency.
     */
    public function base_currency()
    {
        return $this->belongsTo('App\Models\Currency', 'base_currency_id', 'id');
    }

    /**
     * Get the currency that is set as quote_currency.
     */
    public function quote_currency()
    {
        return $this->belongsTo('App\Models\Currency', 'quote_currency_id', 'id');
    }

    /**
     * Method returns value how much of the quote currency is needed to purchase
     * one unit of the base currency.
     *
     * @param string $currencyPair
     * @return null|float
     */
    public static function getExchangeRate(string $currencyPair): ?float
    {
        return self::CURRENCY_PAIRS[$currencyPair] ?? null;
    }
}
