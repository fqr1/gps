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

Route::post('/coordinates/',function(Request $request){
    $all = $request->all();

    $created = App\Gps_data::create($all);

    \Log::debug('all',compact('all'));


    return json_encode([
        'created' => $created
    ]);
});

Route::post('/coordinates/many/',function(Request $request){
    $all = $request->all();
    \Log::debug('all many',compact('all'));

    $all_coords = $all['coordinates'];
    $all_str = json_decode($all_coords);

    $created = [];
    foreach ($all_str as $coord){
        $created[] = App\Gps_data::create((array)$coord);
    }

    return json_encode([
        'created' => $created
    ]);
});
