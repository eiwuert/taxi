<?php

namespace App\Repositories;

use DB;
use Log;
use Auth;
use App\Car;
use App\Trip;
use App\User;
use App\Client;
use App\Driver;
use App\Status;
use App\Payment;
use App\Location;
use Carbon\Carbon;
use App\Events\TripEnded;
use App\Events\TripInitiated;
use App\Http\Requests\TripRequest;
use App\Jobs\SendClientNotification;
use App\Jobs\SendDriverNotification;
use App\Repositories\LocationRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\Trip\CreateRepository as Create;

class TripRepository
{
    /**
     * Calculate trips percentages for each status in current month.
     * @return array
     */
    public static function calculateTripPercentages()
    {
        $count = DB::table('trips')
                    ->select('status_id', DB::raw('count(*) as total'))
                    ->whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])
                    ->groupby('status_id')
                    ->get();
        $total = Trip::whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])
                    ->count();
        $status = [];
        foreach ($count as $c) {
            $status[$c->status_id] = $c->total;
        }

        foreach (range(1, 27) as $i) {
            if (array_key_exists($i, $status)) {
                continue;
            } else {
                $status[$i] = 0;
            }
        }
        $status['total'] = $total;
        return $status;
    }

    /**
     * Count of each day of month finished trip to draw on the chart.
     * @param  String $filter apply filter on returned chart
     * @return array
     */
    public function dailyFinishedTripsOnMonth($filter = null)
    {
        // Goes to start of month
        $startOfMonth = Carbon::now()->startOfMonth()->month;
        $dailyFinishedTripsOnMonth = [];

        // Loop through days
        $add = 0;
        while (Carbon::now()->month == $startOfMonth) {
            // When there is no filter.
            if (is_null($filter)) {
                $total = Trip::whereBetween('created_at', [Carbon::now()->startOfMonth()->addDay($add++),
                                                           Carbon::now()->startOfMonth()->addDay($add)])
                            ->count();
            } else {
                // When there is and active filter.
                $total = Trip::whereBetween('created_at', [Carbon::now()->startOfMonth()->addDay($add++),
                                                           Carbon::now()->startOfMonth()->addDay($add)])
                            ->whereStatusId(Status::whereName($filter)->first()->id)
                            ->count();
            }
            $dailyFinishedTripsOnMonth[] = [Carbon::now()->startOfDay()->addDay($add)->day, $total];
            $startOfMonth = Carbon::now()->startOfMonth()->addDay($add)->month;
        }
        // Sort data.
        asort($dailyFinishedTripsOnMonth);
        
        // return only values.
        return array_values($dailyFinishedTripsOnMonth);
    }

    /**
     * Cancel a trip by admin.
     * @return boolean
     */
    public static function hardCancel($trip)
    {
        if (!Trip::whereId($trip)->exists()) {
            return back();
        }
        $trip = Trip::find($trip);
        $trip->updateStatusTo('trip_is_over_by_admin');
        if (! is_null($trip->driver)) {
            $trip->driver->updateDriverAvailability(true);
            dispatch(new SendDriverNotification('trip_is_over_by_admin', '5', $trip->driver->device_token));
        }
        dispatch(new SendClientNotification('trip_is_over_by_admin', '9', $trip->client->device_token));
        return back();
    }

    /**
     * Calculate distance and cost between 2 points.
     * @return json
     */
    public static function calculate($tripRequest)
    {
        // API V2
        if (isset($tripRequest->s_lng)) {
            $tripRequest->s_long = $tripRequest->s_lng;
            $tripRequest->d_long = $tripRequest->d_lng;
        }
        $source = LocationRepository::getGeocoding($tripRequest->s_lat, $tripRequest->s_long);
        $destination = LocationRepository::getGeocoding($tripRequest->d_lat, $tripRequest->d_long);
        $distanceMatrix = getDistanceMatrix((array)$tripRequest->all()); // 'distance', 'duration'
        if (!isset($distanceMatrix['distance'])) {
            return fail([
                    'title'  => 'Failed',
                    'detail' => 'Failed to interact with Google Maps'
                ]);
        }
        $transactions = (new TransactionRepository())->calculate($tripRequest->s_lat, $tripRequest->s_long,
                                             $distanceMatrix['distance']['value'],
                                             $distanceMatrix['duration']['value'], 'IRR');
        return ok([
                'source'       => $source,
                'destination'  => $destination,
                'distance'     => $distanceMatrix['distance'],
                'duration'     => $distanceMatrix['duration'],
                'transactions' => $transactions,
            ]);
    }

    /**
     * Calculate distance and cost between 2 points.
     * @return json
     */
    public static function calculateV3($tripRequest)
    {
        // API V2
        if (isset($tripRequest->s_lng)) {
            $tripRequest->s_long = $tripRequest->s_lng;
            $tripRequest->d_long = $tripRequest->d_lng;
        }
        $source = LocationRepository::getGeocoding($tripRequest->s_lat, $tripRequest->s_long);
        $destination = LocationRepository::getGeocoding($tripRequest->d_lat, $tripRequest->d_long);
        $distanceMatrix = getDistanceMatrix((array)$tripRequest->all()); // 'distance', 'duration'
        if (!isset($distanceMatrix['distance'])) {
            return fail([
                    'title'  => 'Failed',
                    'detail' => 'Failed to interact with Google Maps'
                ]);
        }
        $transactions = (new TransactionRepository())->calculateV3($tripRequest->s_lat, $tripRequest->s_long,
                                             $distanceMatrix['distance']['value'],
                                             $distanceMatrix['duration']['value'], 'IRR');
        return ok([
                'source'       => $source,
                'destination'  => $destination,
                'distance'     => $distanceMatrix['distance'],
                'duration'     => $distanceMatrix['duration'],
                'transactions' => $transactions,
            ]);
    }
}
