<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	//
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

    /**
     * A trip can have one source location.
     * 
     * @return hasOne
     */
    public function source()
    {
        return $this->hasOne('App\Location', 'id', 'source');
    }

    /**
     * A trip can have one destination location.
     * 
     * @return hasOne
     */
    public function destination()
    {
        return $this->hasOne('App\Location', 'id', 'destination');
    }

    /**
     * Scope a query for getting trip based on created time.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePassed($query, $minute = 2)
    {
        return $query->where('created_at', '<', Carbon::now()->subMinute($minute)->toDateTimeString());
    }
}
