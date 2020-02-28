<?php

namespace App\Http\Controllers\API;

use App\Models\Currency;
use App\Models\CurrencyPairExchangeRate as CurrencyPairs;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyCalcController extends BaseController
{

    /**
     * TEST method.
     * REMOVE BEFORE DEPLOYMENT.
     * 
     * Endpoint: /api/test
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse([], 'It works!');
    }

    /**
     * Convert currencies method.
     * 
     * Endpoint: /api/v1/convert
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function convert(Request $request): JsonResponse
    {

        // Allow only GET method.
        // It's not necessary since Route for this action is set to ::get.
        if (!$request->isMethod('get')) {
            return $this->sendError('Wrong method.' , [], 405);
        }

        // Just simple data validation.
        $simpleRequestValidation = Validator::make($request->all(), [
            'from' => 'string|required|min:3|max:3',
            'to' => 'string|required|min:3|max:3',
            'value' => 'required|numeric',
            'api_key' => 'string|required',
        ]);



        // Send error repospone on validation fails
        if ($simpleRequestValidation->fails()) {
            return $this->sendError('Wrong parameters.' , [], 400);
        }

        $currency = Currency::all();
        $currencyPairs = CurrencyPairs::all();

        // Collect vars
        $inputValues = $request->all();
        $currencyFrom = $currency->where('symbol', $inputValues['from'])->first();
        $currencyTo = $currency->where('symbol', $inputValues['to'])->first();
        $valueFrom = round($inputValues['value'], 2);

        
        if ($currencyFrom === null || $currencyTo === null) {
            return $this->sendError('Wrong currencies.' , [], 400);
        }

        // Get currency pair
        $currencyPair = $currencyPairs
                            ->where('base_currency_id', $currencyFrom->id)
                            ->where('quote_currency_id', $currencyTo->id)
                            ->first();

        // If currency pair cannot be found return error
        if ($currencyPair === null) {
            return $this->sendError(
                'Exchange rate for those currencies does not exists.',
                [], 400);
        }

        // Get exchange rate
        $exchangeRate = $currencyPair->exchange_rate;

        // Calculate exchanged value
        $valueTo = round($valueFrom * $exchangeRate, 2);

        // Return response.
        return $this->sendResponse(
            [
                'value' => $valueTo,
                'currencyPair' => $currencyFrom->symbol . '_TO_' . $currencyTo->symbol,
                'exchangeRate' => $exchangeRate,
            ],
            sprintf('%.2f %s is worth %.2f %s', $valueFrom, $currencyFrom->symbol, $valueTo, $currencyTo->symbol)
        );
    }
}
