<?php

namespace App\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;

class CurrencyPairExchangeRate extends Model
{

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
     * TODO Oprzec znalezienie danej na podstawie relacji z Currency!
     *
     * @return null|float
     */
    public static function getExchangeRateBySymbols($baseCurrencySymbol, $quoteCurrencySymbol): ?float
    {

        $baseCurrencyId = Currency::where('symbol', $baseCurrencySymbol)->first()->id;
        $quoteCurrencyId = Currency::where('symbol', $quoteCurrencySymbol)->first()->id;

        $exchangeRate = CurrencyPairExchangeRate::where('base_currency_id', $baseCurrencyId)
                                                ->where('quote_currency_id', $quoteCurrencyId)
                                                ->first();

        return $exchangeRate->exchange_rate ?? null;
    }
}
