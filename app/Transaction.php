<?php

namespace App;

use App\Trip;
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

    /**
     * Scope a query to calculate income.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIncome($query)
    {
        return $query->whereIn('trip_id', Trip::whereIn('status_id', [9, 15, 16, 17])->get());
    }
}
