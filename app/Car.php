<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
	protected $fillable = [
		'number',
		'color',
		'user_id',
		'type_id',
	];

    /**
     * A car can have one user(driver).
     * 
     * @return hasOne
     */
    public function driver()
    {
        return $this->hasOne('App\User');
    }

    /**
     * A car can have one car type.
     * 
     * @return hasOne
     */
    public function type()
    {
        return $this->hasOne('App\CarType', 'id', 'type_id');
    }
}
