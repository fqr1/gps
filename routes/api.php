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
    $all_str = str_replace("\\","",$all['coordinates']);
    $all_str = json_decode($all_str);



    //$created = App\Gps_data::create($all);

    \Log::debug('all many',compact('all'));
    \Log::debug('all many str',compact('all_str'));


    return json_encode([
        'created' => 'dummy'
    ]);
});
