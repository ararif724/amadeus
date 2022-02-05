<?php

use App\Http\Controllers\Amadeus;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/airports', function () {
    return response()->view('airports')->header('Content-Type', 'application/json');
});
Route::view('/', 'airsearch');
Route::post('flights-search', [Amadeus::class, 'flightSearch']);
Route::post('multi-search', [Amadeus::class, 'multiSearch']);
Route::post('store-flight', [Amadeus::class, 'storeFlight']);
Route::get('validate/{sessionId}', [Amadeus::class, 'flightValidate']);
Route::post('pnr/{sessionId}', [Amadeus::class, 'generatepnr']);
