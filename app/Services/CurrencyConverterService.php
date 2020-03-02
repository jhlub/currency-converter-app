<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\CurrencyPairExchangeRate;

class CurrencyConverterService
{

    /**
     * Base currency.
     *
     * @var string
     */
    protected $baseCurrencySymbol;

    /**
     * Quote currency.
     *
     * @var string
     */
    protected $quoteCurrencySymbol;

    /**
     * Exchange rate.
     *
     * @var float|integer
     */
    protected $valueToExchange;


    /**
     * Add base vars on construct.
     */
    public function __construct($baseCurrencySymbol, $quoteCurrencySymbol, $valueToExchange)
    {
        $this->baseCurrencySymbol = $baseCurrencySymbol;
        $this->quoteCurrencySymbol = $quoteCurrencySymbol;
        $this->valueToExchange = $valueToExchange;
    }


    /**
     * Convert value of base_currency to quote_currency.
     * Returned value is rounded to two decimal places.
     *
     * @return null|float
     */
    public function convertCurrencies(): ?float
    {
        $exchangeRate = $this->getExchangeRate();

        return round($this->valueToExchange * $exchangeRate, 2);
    }

    /**
     * Get exchange rate.
     * Throws exception on wrong data.
     *
     * @return null|float
     * @throws \Exception
     */
    public function getExchangeRate()
    {
        foreach ([$this->baseCurrencySymbol, $this->quoteCurrencySymbol] as $currencySymbol) {
            if (!Currency::isCurrencyBySymbolExists($currencySymbol)) {
                throw new \Exception('Wrong currencies.');
            }
        }

        $exchangeRate = CurrencyPairExchangeRate::getExchangeRateBySymbols(
            $this->baseCurrencySymbol,
            $this->quoteCurrencySymbol
        );

        if ($exchangeRate === null) {
            throw new \Exception('Exchange rate for those currencies does not exists.');
        }

        return $exchangeRate;
    }
}
