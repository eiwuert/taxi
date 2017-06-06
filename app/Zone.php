<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'latitude', 'longitude', 'radius', 'unit'];

    /**
     * A zone can has one fare.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function fare()
    {
        return $this->hasOne('App\Fare');
    }

    /**
     * A Zone belongs to many car types.
     * @return belongsToMany
     */
    public function carTypes()
    {
        return $this->belongsToMany('App\CarType');
    }
}
