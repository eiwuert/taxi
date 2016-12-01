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
        'perdistance',
        'distanceunit',
        'time',
        'pertime',
        'timeunit',
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
}
