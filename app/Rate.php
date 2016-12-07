<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    /**
     * A rate can have one trip.
     * 
     * @return hasOne
     */
    public function trip()
    {
        return $this->hasOne('App\Trip');
    }
}
