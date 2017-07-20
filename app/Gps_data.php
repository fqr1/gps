<?php
/**
 * Created by PhpStorm.
 * User: fqr
 * Date: 20/07/17
 * Time: 14:50
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Gps_data extends Model
{
    protected $table = 'gps_data';

    protected $fillable = [
        'lat',
        'lon',
        'date',
        'user',
    ];

}