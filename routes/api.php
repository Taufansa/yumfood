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

Route::prefix('v1')->group(function () {
    Route::apiResource('vendors', 'VendorController');
    Route::post('/vendors/insert','VendorController@store');
    Route::get('/vendors/show/{id}','VendorController@show');
    Route::patch('/vendors/update/{id}','VendorController@update');
    Route::delete('/vendors/delete/{id}','VendorController@destroy');
    Route::apiResource('tags', 'TagController');
    Route::post('/tags/insert','TagController@store');
    Route::get('/tags/show/{id}','TagController@show');
    Route::patch('/tags/update/{id}','TagController@update');
    Route::delete('/tags/delete/{id}','TagController@destroy');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


