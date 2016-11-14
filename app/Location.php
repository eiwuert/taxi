<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
    	'latitude',
    	'longitude',
        'name',
    	'user_id',
    ];

    /**
     * A location can have one user.
     * 
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
     * A location can be source location of many trips.
     * 
     * @return hasMany
     */
    public function sources()
    {
        return $this->hasMany('App\Trip', 'source', 'id');
    }

    /**
     * A location can be destination location of many trips.
     * 
     * @return hasMany
     */
    public function destinations()
    {
        return $this->hasMany('App\Trip', 'source', 'id');
    }
}
