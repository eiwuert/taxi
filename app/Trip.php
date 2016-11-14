<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start', 
        'end',
        'eta',
        'etd',
    ];

    /**
     * A trip can have one driver.
     * 
     * @return hasOne
     */
    public function driver()
    {
        return $this->hasOne('App\Driver');
    }

    /**
     * A trip can have one client.
     * 
     * @return hasOne
     */
    public function client()
    {
        return $this->hasOne('App\Client');
    }

    /**
     * A trip can have one status.
     * 
     * @return hasOne
     */
    public function status()
    {
        return $this->hasOne('App\Status');
    }
}
