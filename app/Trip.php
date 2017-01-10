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
        return $this->hasOne('App\Client', 'id', 'client_id');
    }

    /**
     * A trip can have one client.
     * 
     * @return hasOne
     */
    public function getClient()
    {
        return $this->belongsTo('App\Client', 'user_id', 'client_id');
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
     * Status meanings.
     * @return string
     */
    public function statusName()
    {
        switch ($this->status()->first()->name) {
            case 'trip_is_over':
                return 'Ended';
                break;
            case 'client_rated':
                return 'Client rated';
                break;
            case 'driver_rated':
                return 'Driver rated';
                break;
            case 'driver_cancel_arrived_status':
                return 'Canceled on arrived by driver';
                break;
            case 'client_canceled_arrived_driver':
                return 'Canceled on arrived by client';
                break;
            case 'driver_arrived':
                return 'Arrived';
                break;
            case 'cancel_onway_driver':
                return 'Canceled onway by client';
                break;
            case 'cancel_request_taxi':
                return 'Requested taxi canceled by client';
                break;
            case 'trip_ended':
                return 'Trip ended waiting for ratings';
                break;
            case 'trip_started':
                return 'Started';
                break;
            case 'driver_reject_started_trip':
                return 'Starting trip rejected by driver';
                break;
            case 'driver_onway':
                return 'Onway';
                break;
            case 'no_driver':
                return 'NO available driver';
                break;
            case 'reject_client_found':
                return 'New client rejected by driver';
                break;
            case 'no_reponse':
                return 'No response from driver';
                break;
            case 'client_found':
                return 'New client found';
                break;
            case 'request_taxi':
                return 'Taxi requested';
                break;
            default:
                return 'error';
                break;
        }
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
     * Destination name
     * 
     * @return string
     */
    public function destinationName()
    {
        return $this->destination()->first()->name;
    }

    /**
     * Source name
     * 
     * @return string
     */
    public function sourceName()
    {
        return $this->source()->first()->name;
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
     * A trip can have one transaction.
     * 
     * @return hasOne
     */
    public function firstTransaction()
    {
        return $this->hasOne('App\Transaction')->first();
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

    /**
    * Get the rate that own the trip.
    *
    * @return belongsTo
    */
    public function rate()
    {
        return $this->hasOne('App\Rate');
    }

    public function rateOfDriverToClient()
    {
        return $this->rate()->first()->get(['driver', 'driver_comment'])->first();
    }

    public function rataOfClientToDriver()
    {
        return $this->rate()->first()->get(['client', 'client_comment'])->first();
    }    

}
