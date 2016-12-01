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
    	'entry',
        'distance',
        'per_distance',
        'distance_unit',
        'time',
        'per_time',
        'time_unit',
        'surcharge',
        'currency',
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
