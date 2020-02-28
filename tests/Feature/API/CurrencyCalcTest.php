<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\ExtendedTestCase;

/**
 * Simple test for CurrencyCalc API.
 *
 * @group APITest
 */
class CurrencyCalcTest extends ExtendedTestCase
{

    /**
     * Simple test for currency converter - Correct.
     * SGD to PLN
     *
     * Action: API\CurrencyCalcController@convert
     * Endpoint: /api/v1/convert
     * 
     * @return void
     */
    public function testCurrencyConvertSgdCorrect(): void
    {
        $response = $this->json('GET', route('api.convert'), [
            'from' => 'SGD',
            'to' => 'PLN',
            'value' => 100,
            'api_key' => 'testkey1111'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "data" => [
                    "value" => 283,
                    "currencyPair" => "SGD_TO_PLN",
                    "exchangeRate" => 2.83
                ],
                "message" => "100.00 SGD is worth 283.00 PLN"
            ]);
    }

    /**
     * Simple test for currency converter - Correct.
     * PLN to SGD
     *
     * Action: API\CurrencyCalcController@convert
     * Endpoint: /api/v1/convert
     * 
     * @return void
     */
    public function testCurrencyConvertPlnCorrect(): void
    {
        $response = $this->json('GET', route('api.convert'), [
            'from' => 'PLN',
            'to' => 'SGD',
            'value' => 100,
            'api_key' => 'testkey1111'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "data" => [
                    "value" => 35,
                    "currencyPair" => "PLN_TO_SGD",
                    "exchangeRate" => 0.35
                ],
                "message" => "100.00 PLN is worth 35.00 SGD"
            ]);
    }

    /**
     * Simple test for currency converter - Validation fails.
     *
     * Action: API\CurrencyCalcController@convert
     * Endpoint: /api/v1/convert
     * 
     * @return void
     */
    public function testCurrencyConvertIncorrectValidation(): void
    {

        $response = $this->json('GET', route('api.convert'), [
            'to' => 'PLN',
            'value' => 100,
            'api_key' => 'testkey1111'
        ]);


        $response
            ->assertStatus(400)
            ->assertJson([
                "success" => false,
                "message" => "Wrong parameters."
            ]);
    }

    /**
     * Simple test for currency converter - Incorrect curriences.
     *
     * Action: API\CurrencyCalcController@convert
     * Endpoint: /api/v1/convert
     * 
     * @return void
     */
    public function testCurrencyConvertIncorrectCurriences(): void
    {

        $response = $this->json('GET', route('api.convert'), [
            'from' => 'ASD',
            'to' => 'PLN',
            'value' => 100,
            'api_key' => 'testkey1111'
        ]);


        $response
            ->assertStatus(400)
            ->assertJson([
                "success" => false,
                "message" => "Wrong currencies."
            ]);
    }

    /**
     * TODO ADD: Add functionality.
     * Simple test for currency converter - Incorrect api key.
     *
     * Action: API\CurrencyCalcController@convert
     * Endpoint: /api/v1/convert
     * 
     * @return void
     */
    /*
    public function testCurrencyConvertIncorrectApiKey(): void
    {

    }
    */
}
