<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'driver_id',
        'trip_id',
        'status_id',
        'driver_location',
    ];

    /**
     * A trip log can belongs to on trip.
     *
     * @return Illuminate\Database\Eloquent\Concerns\belongsTo
     */
    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }

    /**
     * A trip log can belongs to on status.
     *
     * @return Illuminate\Database\Eloquent\Concerns\belongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Status', 'status_id', 'value');
    }

    /**
     * Calculate time after.
     *
     * @param  integer $key
     * @return string
     */
    public function after($key)
    {
        switch ($key) {
            case '1':
                return __('admin/general.request');
                break;
            case '2':
                return __('admin/general.find');
                break;
            case '3':
                return __('admin/general.accept');
                break;
            case '4':
                return __('admin/general.arrived');
                break;
            case '5':
                return __('admin/general.start');
                break;
            default:
                return __('admin/general.default');
                break;
        }
    }

    /**
     * Status meanings.
     *
     * @return string
     */
    public function statusName($log)
    {
        switch ($log->status->name) {
            case 'on_next_trip':
                return __('admin/general.On next trip');
                break;
            case 'on_next_trip_canceled':
                return __('admin/general.On next trip canceled');
                break;
            case 'next_trip_start':
                return __('admin/general.Next trip started');
                break;
            case 'next_trip_end':
                return __('admin/general.Next trip ended');
                break;
            case 'next_trip_wait':
                return __('admin/general.Next trip on wait');
                break;
            case 'next_trip_cancel':
                return __('admin/general.Next trip canceled');
                break;
            case 'next_trip_halt':
                return __('admin/general.Next trip halted');
                break;
            case 'next_trip_to_happen':
                return __('admin/general.Next trip is going to happen');
                break;
            case 'trip_is_over_by_admin':
                return __('admin/general.Ended by admin');
                break;
            case 'trip_is_over':
                return __('admin/general.Ended');
                break;
            case 'client_rated':
                return __('admin/general.Client rated');
                break;
            case 'driver_rated':
                return __('admin/general.Driver rated');
                break;
            case 'driver_cancel_arrived_status':
                return __('admin/general.Canceled on arrived by driver');
                break;
            case 'client_canceled_arrived_driver':
                return __('admin/general.Canceled on arrived by client');
                break;
            case 'driver_arrived':
                return __('admin/general.Arrived');
                break;
            case 'cancel_onway_driver':
                return __('admin/general.Canceled onway by client');
                break;
            case 'cancel_request_taxi':
                return __('admin/general.Requested taxi canceled by client');
                break;
            case 'trip_ended':
                return __('admin/general.Trip ended waiting for ratings');
                break;
            case 'trip_started':
                return __('admin/general.Started');
                break;
            case 'driver_reject_started_trip':
                return __('admin/general.Starting trip rejected by driver');
                break;
            case 'driver_onway':
                return __('admin/general.Onway');
                break;
            case 'no_driver':
                return __('admin/general.NO available driver');
                break;
            case 'reject_client_found':
                return __('admin/general.New client rejected by driver');
                break;
            case 'no_response':
                return __('admin/general.No response from driver');
                break;
            case 'client_found':
                return __('admin/general.New client found');
                break;
            case 'request_taxi':
                return __('admin/general.Taxi requested');
                break;
            default:
                return __('admin/general.error');
                break;
        }
    }
}
