<?php

namespace App\Repositories\Trip;

use Log;
use Auth;
use App\Trip;
use Carbon\Carbon;

class MainRepository
{
    /**
     * Role of this user.
     * @return String client or driver
     */
    public static function role()
    {
        return Auth::user()->role;
    }

    /**
     * Is the user client or driver.
     * @param  string  $role
     * @return boolean
     */
    public static function is($role)
    {
        if ($this->role() == $role) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get authenticated client.
     * @return array
     */
    public static function client()
    {
        return Auth::user()->client()->first();
    }

    /**
     * Get authenticated driver.
     * @return array
     */
    public static function driver()
    {
        return Auth::user()->driver()->first();
    }

    /**
     * Get the last trip of the authenticated user.
     * @return array
     */
    public static function trips()
    {
        return $trip->driver;
        return $this->driver()->trips()->orderBy('id', 'desc')->first();
    }

    protected static function pre($request)
    {
        if (isset($request['s_lng'])) {
            $request['s_long'] = $request['s_lng'];
            $request['d_long'] = $request['d_lng'];
        }

        if (!isset($request['currency'])) {
            $request['currency'] = 'IRR';
        }

        if (!isset($request['type'])) {
            $request['type'] = 'any';
        }

        if (!isset($request['payment'])) {
            $request['payment'] = 'cash';
        }

        return $request;
    }

    protected static function dev($pending)
    {
        if (env('APP_ENV', 'production') == 'local') {
            if (is_null($pending->first()->driver)) {
                $pending->first()->updateStatusTo('no_driver');
            } else {
                $pending = $pending->first();
                if (!is_null($pending->next)) {
                    // Multi route
                    $pending->updateStatusTo('trip_is_over_by_admin');
                    $tripToCancel = Trip::find($pending->next);
                    while (!is_null($tripToCancel->next)) {
                        $tripToCancel->updateStatusTo('next_trip_halt');
                        $tripToCancel = Trip::find($tripToCancel->next);
                    }
                    $tripToCancel->updateStatusTo('next_trip_halt');
                } else {
                    // single route
                    $pending->updateStatusTo('trip_is_over_by_admin');
                }
                $pending->driver->updateDriverAvailability(true);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Exclude not responded drivers.
     * @param  integer $clientId
     * @return string
     */
    public static function exclude($clientId)
    {
        if (env('APP_ENV', 'production') == 'local') {
            $exclude = Trip::whereNotIn('status_id', [15, 16, 17])
                            ->where('client_id', $clientId)
                            ->where('created_at', '>', Carbon::now()->subMinutes(1)->toDateTimeString())
                            ->get(['driver_id'])->flatten();
        } else {
            $exclude = Trip::whereNotIn('status_id', [15, 16, 17])
                            ->where('client_id', $clientId)
                            ->whereDate('created_at', '>', Carbon::now()->subMinutes(15)->toDateTimeString())
                            ->get(['driver_id'])->flatten();
        }

        $toExclude = [];
        foreach ($exclude as $e) {
            if (! is_null($e->driver_id)) {
                $toExclude[] = $e->driver_id;
            }
        }

        Log::info('To exclude: ', $toExclude);
        if (empty($toExclude)) {
            $toExclude = [0];
        }

        return [
            'count' => count($toExclude),
            'result' => implode(',', $toExclude)
        ];
    }
}
