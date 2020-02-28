<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    /**
     * Shortcut for success response.
     *
     * @param mixed $result
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        //return response($response, 200);
        return response()->json($response, 200);
    }

    /**
     * Shortcut for error reponse.
     *
     * @param string $error
     * @param mixed $errorMessages
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    /**
     * TODO ADD: Create authentication with domain and api_key.
     *
     * Check if API KEY is correct for domain which sent request.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public function authApiKey($request): bool
    {

    }
}
