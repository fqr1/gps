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

Route::get('/ping',function(){
	return 'api pong';
});

Route::post('/coordinates/','\App\Http\Controllers\CoordinatesController@postCoordinate');

Route::post('/coordinates/many/','\App\Http\Controllers\CoordinatesController@postCoordinates');

Route::get('/coordinates/last/','\App\Http\Controllers\CoordinatesController@getLastCoordinate');
