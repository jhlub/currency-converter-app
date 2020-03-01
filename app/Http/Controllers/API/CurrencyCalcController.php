<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\GetConvertedCurrency;
use App\Services\CurrencyConverterService;
use Illuminate\Http\JsonResponse;

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
    public function convert(GetConvertedCurrency $request): JsonResponse
    {

        // Allow only GET method.
        // It's not necessary since Route for this action is set to ::get.
        if (!$request->isMethod('get')) {
            return $this->sendError('Wrong method.' , [], 405);
        }

        $inputValues = $request->all();

        try {
            $converter = new CurrencyConverterService($inputValues['from'], $inputValues['to'], $inputValues['value']);
            $converter->convertCurrencies();
        } catch (\Exception $e) {
            return $this->sendError(
                $e->getMessage(),
                [], 422);
        }

        // Return response.
        return $this->sendResponse(
            [
                'value' => $converter->convertCurrencies(),
                'currencyPair' => $inputValues['from'] . '_TO_' . $inputValues['to'],
                'exchangeRate' => $converter->getExchangeRate(),
            ],
            sprintf('%.2f %s is worth %.2f %s',
                $inputValues['value'],
                $inputValues['from'],
                $converter->convertCurrencies(),
                $inputValues['to']
            )
        );
    }
}
