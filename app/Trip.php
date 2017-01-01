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
    	'status_id',
        'driver_id',
        'etd_text',
        'etd_value',
        'driver_distance_text',
        'driver_distance_value',
        'driver_location',
    ];

    /**
     * A trip can have one driver.
     * 
     * @return hasOne
     */
    public function driver()
    {
        return $this->hasOne('App\Driver', 'user_id', 'driver_id');
    }

    /**
     * A trip can have one client.
     * 
     * @return hasOne
     */
    public function client()
    {
        return $this->hasOne('App\Client', 'user_id', 'client_id');
    }

    /**
     * A trip can have one status.
     * 
     * @return hasOne
     */
    public function status()
    {
        return $this->hasOne('App\Status', 'value', 'status_id');
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
     * A trip can have one transaction.
     * 
     * @return hasOne
     */
    public function transaction()
    {
        return $this->hasOne('App\Transaction');
    }

    /**
     * Get the rate that own the trip.
     * 
     * @return belongsTo
     */
    public function rate()
    {
        return $this->hasOne('App\Rate');
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

    /**
     * Scope a query to count all finished trips.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFinishedCount($query)
    {
        // TRIP_ENDED
        // DRIVER_RATED
        // CLIENT_RATED
        // TRIP_IS_OVER
        return $query->whereIn('status_id', [9, 15, 16, 17])
                     ->count();
    }
}
