<?php

namespace App\Repositories\Trip;

use App\User;

class NearbyRepository
{
    /**
     * Handle defaults value for not given values and API v1 and v2.
     * @param  Request $request
     * @return Request $request
     */
    private static function defaults($request)
    {
        // API V2
        if (isset($request->lng)) {
            $request->long = $request->lng;
        }

        if (is_null($request->limit)) {
            $request->limit = 5;
        }

        if (is_null($request->distance)) {
            $request->distance = 1;
        }

        if (is_null($request->type)) {
            $request->type = 'any';
        }

        return $request;
    }
    /**
     * Get nearby drivers.
     * @param App\Http\Requests\NearbyRequest $request
     * @return array
     */
    public static function nearby($request)
    {
        $request = self::defaults($request);
        $drivers = nearby($request->lat,
                              $request->long,
                              $request->type,
                              $request->distance,
                              $request->limit)['result'];
        $nearby = [];
        foreach ($drivers as $u) {
            $driver = $u;
            $driver->angle = User::whereId($u->user_id)->first()
                                 ->driver->first()->angle();
            $nearby[] = $driver;
        }
        return $nearby;
    }
}
