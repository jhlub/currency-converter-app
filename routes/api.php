<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Just for test.
Route::any('/test', 'API\CurrencyCalcController@index');

// Currency Converter API.
// Endpoint: /api/v1/convert 
Route::group(['prefix' => 'v1'], function() {
    Route::get('/convert', 'API\CurrencyCalcController@convert')->name('api.convert');
});

// TODO! Remove before deploy. It's just a helper.
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    return 'Cache cleared.';
});


// TODO! Remove before deploy.
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
