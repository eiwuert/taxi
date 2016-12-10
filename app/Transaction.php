<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_type_id',
    	'entry',
        'distance',
        'per_distance',
        'distance_unit',
        'distance_value',
        'time',
        'per_time',
        'time_unit',
        'time_value',
        'surcharge',
        'currency',
        'timezone',
        'total',
    ];

    /**
     * A transaction can have one trip.
     * 
     * @return hasOne
     */
    public function trip()
    {
        return $this->hasOne('App\Trip');
    }

    /**
     * A transaction can have one car type.
     * 
     * @return hasOne
     */
    public function type()
    {
        return $this->hasOne('App\CarType');
    }
}
