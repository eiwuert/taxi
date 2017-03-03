<?php

namespace App\Repositories\Trip;

use Auth;

class MainRepository
{
    /**
     * Role of this user.
     * @return String client or driver
     */
    public function role()
    {
        return Auth::user()->role;
    }

    /**
     * Is the user client or driver.
     * @param  string  $role
     * @return boolean
     */
    public function is($role)
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
    public function client()
    {
        return Auth::user()->client()->first();
    }

    /**
     * Get authenticated driver.
     * @return array
     */
    public function driver()
    {
        return Auth::user()->driver()->first();
    }

    /**
     * Get the last trip of the authenticated user.
     * @return array
     */
    public function trips()
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
            $request['currency'] = 'USD';
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
}
