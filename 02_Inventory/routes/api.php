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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Auth\RegisterController@APIregister');
Route::post('login', 'Auth\LoginController@APIlogin');
Route::post('logout', 'Auth\LoginController@APIlogout');

Route::group(['middleware' => 'auth:api'], function() {
    Route::apiResource('/locations', API\LocationController::class);
    Route::apiResource('/devices', API\DeviceController::class);
});




