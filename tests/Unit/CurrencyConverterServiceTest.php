<?php

namespace Tests\Unit;

use App\Services\CurrencyConverterService;
use Error;
use PHPUnit\Framework\Error\Warning;
use Tests\ExtendedTestCase;

/**
 * @group CurrencyConverterService
 */
class CurrencyConverterServiceTest extends ExtendedTestCase
{

    /**
     * @var mixed
     */
    protected $baseCurrencySymbol;

    /**
     * @var mixed
     */
    protected $exchangeRate;

    /**
     * @var mixed
     */
    protected $quoteCurrencySymbol;

    /**
     * @var mixed
     */
    protected $valueToExchange;

    /**
     * Add custom data on construct.
     *
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->valueToExchange = 100;
        $this->exchangeRate = 2.83;
        $this->baseCurrencySymbol = 'SGD';
        $this->quoteCurrencySymbol = 'PLN';
    }

    /**
     * Test converter with correct data.
     * Expect correct result.
     *
     * @return void
     */
    public function testConvertCurrenciesCorrect()
    {
        $converter = new CurrencyConverterService(
            $this->baseCurrencySymbol,
            $this->quoteCurrencySymbol,
            $this->valueToExchange
        );

        $this->assertEquals(
            $converter->convertCurrencies(),
            round($this->valueToExchange * $this->exchangeRate, 2)
        );
    }

    /**
     * Test converter with incorrect value format.
     * Expect warning.
     *
     * @return void
     */
    public function testConvertCurrenciesFail()
    {
        $this->expectException(\Exception::class);
        $converter = new CurrencyConverterService(
            $this->baseCurrencySymbol,
            $this->quoteCurrencySymbol,
            'asb'
        );
        $converter->convertCurrencies();
    }

    /**
     * Test converter with incorrect base currency format.
     * Expect error.
     *
     * @return void
     */
    public function testGetExchangeRate()
    {
        $this->expectException(\Exception::class);
        $converter2 = new CurrencyConverterService(123, 'DSA', 100);
        $converter2->getExchangeRate();

        $converter3 = new CurrencyConverterService('ASD', 123, 100);
        $converter3->getExchangeRate();
    }
}
