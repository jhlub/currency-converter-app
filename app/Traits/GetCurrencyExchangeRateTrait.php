<?php

namespace App\Traits;

use App\Models\Currency;
use App\Models\CurrencyPairExchangeRate;

trait GetCurrencyExchangeRateTrait
{

    /**
     * Get exchange rate of currencies pair by their symbol.
     *
     * @param string $baseCurrencySymbol
     * @param string $quoteCurrencySymbol
     * @return null|float
     * @throws \Exception
     */
    public function getExchangeRateByCurrenciesSymbol($baseCurrencySymbol, $quoteCurrencySymbol): ?float
    {
        foreach ([$baseCurrencySymbol, $quoteCurrencySymbol] as $currencySymbol) {
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
