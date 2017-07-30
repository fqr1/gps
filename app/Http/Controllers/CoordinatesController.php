<?php
/**
 * Created by PhpStorm.
 * User: fqr
 * Date: 30/07/17
 * Time: 13:58
 */

namespace App\Http\Controllers;
use App\Gps_data;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CoordinatesController extends BaseController
{
    public function postCoordinate(Request $request){
        $all = $request->all();

        $created = \App\Gps_data::create($all);

        \Log::debug('all',compact('all'));


        return json_encode([
            'created' => $created
        ]);
    }

    public function postCoordinates(Request $request){
        $all = $request->all();
        \Log::debug('all many',compact('all'));

        $all_coords = $all['coordinates'];
        $all_str = json_decode($all_coords);

        \Log::debug('Received coordinates: '.count($all_str));

        $created = [];
        foreach ($all_str as $coord){
            $created[] = \App\Gps_data::create((array)$coord);
        }

        return json_encode([
            'created' => $created
        ]);
    }

    public function getLastCoordinate(Request $request){
        $u = $request->get('user');
        \Log::debug('u',compact('u'));

        $u = explode(',',$u);
        if($u[0] !== 'asd'){
            return json_encode([
                'last_coordinate' => null
            ]);
        }
        $user = $u[1];


        \Log::debug('user',compact('user'));

        $lastCoordinate = Gps_data::whereUser($user)->orderBy('date','desc')->first();

        return json_encode([
           'last_coordinate' => $lastCoordinate
        ]);

    }

    public function getCoordinates(Request $request){
        $u = $request->get('user');
        \Log::debug('u',compact('u'));

        $u = explode(',',$u);
        if($u[0] !== 'asd'){
            return json_encode([
                'coordinates' => null
            ]);
        }
        $user = $u[1];
        $from = $request->get('start',null);
        $to = $request->get('end',null);

        \Log::debug('user',compact('user'));

        //$coordinates = null;
        $coordinates = Gps_data::whereUser($user)
            ->whereBetween('date', [$from, $to])
            ->orderBy('date','desc')
            ->get();

        return json_encode([
            'coordinates' => $coordinates
        ]);
    }
}