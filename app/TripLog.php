<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 
        'driver_id',
        'trip_id',
        'status_id',
        'driver_location',
    ];
}
