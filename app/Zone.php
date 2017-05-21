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
}
