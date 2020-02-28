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
}
