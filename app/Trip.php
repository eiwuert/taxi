<?php

namespace App;

use App\Status;
use Carbon\Carbon;
use App\Events\TripUpdated;
use App\Events\TripCreated;
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
     * Sortable items.
     * 
     * @var array
     */
    public static $sortable = [
        'driver_id' => 'Driver', 
        'client_id' => 'Client',
    ];

    public static $status = [
        'all' => 'All',
        'trip_is_over_by_admin' => 'Ended by admin',
        'trip_is_over' => 'Ended',
        'client_rated' => 'Client rated',
        'driver_rated' => 'Driver rated',
        'driver_cancel_arrived_status' => 'Canceled on arrived by driver',
        'client_canceled_arrived_driver' => 'Canceled on arrived by client',
        'driver_arrived' => 'Arrived',
        'cancel_onway_driver' => 'Canceled onway by client',
        'cancel_request_taxi' => 'Requested taxi canceled by client',
        'trip_ended' => 'Trip ended waiting for ratings',
        'trip_started' => 'Started',
        'driver_reject_started_trip' => 'Starting trip rejected by driver',
        'driver_onway' => 'Onway',
        'no_driver' => 'NO available driver',
        'reject_client_found' => 'New client rejected by driver',
        'no_reponse' => 'No response from driver',
        'client_found' => 'New client found',
        'request_taxi' => 'Taxi requested',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $events = [
        'created' => TripCreated::class,
        'updated' => TripUpdated::class,
    ];

    /** 
     * Pending trips statuses.
     * 
     * @var array
     */
    public static $pending = [1, 2, 7, 12, 6, 9, 15, 20];

    /**
     * A trip can have one driver.
     * 
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function driver()
    {
        return $this->hasOne('App\Driver', 'id', 'driver_id');
    }

    /**
     * A trip can have one client.
     * 
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function client()
    {
        return $this->hasOne('App\Client', 'id', 'client_id');
    }

    /**
     * A trip can have one client.
     * 
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function getClient()
    {
        return $this->belongsTo('App\Client', 'user_id', 'client_id');
    }

    /**
     * A trip can have one status.
     * 
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function status()
    {
        return $this->hasOne('App\Status', 'value', 'status_id');
    }

    /**
     * Status meanings.
     * 
     * @return string
     */
    public function statusName()
    {
        switch ($this->status()->first()->name) {
            case 'on_next_trip':
                return 'On next trip';
                break;
            case 'on_next_trip_canceled':
                return 'On next trip canceled';
                break;
            case 'next_trip_start':
                return 'Next trip started';
                break;
            case 'next_trip_end':
                return 'Next trip ended';
                break;
            case 'next_trip_wait':
                return 'Next trip on wait';
                break;
            case 'next_trip_cancel':
                return 'Next trip canceled';
                break;
            case 'next_trip_halt':
                return 'Next trip halted';
                break;
            case 'next_trip_to_happen':
                return 'Next trip is going to happen';
                break;
            case 'trip_is_over_by_admin':
                return 'Ended by admin';
                break;
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
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function source()
    {
        return $this->hasOne('App\Location', 'id', 'source');
    }

    /**
     * A trip can have one destination location.
     * 
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function destination()
    {
        return $this->hasOne('App\Location', 'id', 'destination');
    }

    /**
     * A trip can have one driver destination location.
     * 
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function driverLocation()
    {
        return $this->hasOne('App\Location', 'id', 'driver_location');
    }

    /**
     * Name of the destination of the trip.
     * 
     * @return string
     */
    public function destinationName()
    {
        return $this->destination()->first()->name;
    }

    /**
     * Name of the source of the trip.
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
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function transaction()
    {
        return $this->hasOne('App\Transaction');
    }

    /**
     * A trip can have one transaction.
     * 
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
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
    public function scopePassed($query, $seconds = 35)
    {
        return $query->where('created_at', '<', Carbon::now()->subSeconds($seconds)->toDateTimeString());
    }

    /**
     * Scope a query to count all finished trips.
     * 
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
     * Scope a query to count all canceled trips.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCanceledCount($query)
    {
        // CANCEL_REQUEST_TAXI
        // NO_RESPONSE
        // CANCEL_ONWAY_DRIVER
        // DRIVER_REJECT_STARTED_TRIP
        // DRIVER_CANCEL_ARRIVED_STATUS
        // NO_DRIVER
        return $query->whereNotIn('status_id', [9, 15, 16, 17])
                     ->count();
    }

    /**
     * Scope a query to get all finished trips.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFinished($query)
    {
        // TRIP_ENDED
        // DRIVER_RATED
        // CLIENT_RATED
        // TRIP_IS_OVER
        return $query->whereIn('status_id', [9, 15, 16, 17]);
    }

    /**
    * Get the rate that own the trip.
    *
    * @return Illuminate\Database\Eloquent\Concerns\belongsTo
    */
    public function rate()
    {
        return $this->hasOne('App\Rate');
    }

    /**
     * A trip has many payments.
     * 
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    /**
     * Get rate of the driver to client.
     * 
     * @return array
     */
    public function rateOfDriverToClient()
    {
        return $this->rate()->first()->get(['driver', 'driver_comment'])->first();
    }

    /**
     * Get rate of the client to driver.
     * 
     * @return array
     */
    public function rataOfClientToDriver()
    {
        return $this->rate()->first()->get(['client', 'client_comment'])->first();
    }

    /**
     * Update status of the trip to the given status name.
     * 
     * @return boolean
     */
    public function updateStatusTo($name)
    {
        $this->update([
            'status_id' => Status::where('name', $name)->firstOrFail()->value,
        ]);
    }
}
