<?php

namespace App\Repositories\Trip;

use App\User;
use App\CarType;

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
            $driverToCheck = User::whereId($u->user_id)->first()
                                ->driver->first();
            if (is_null($driverToCheck)) {
                $driver->angle = rand(0, 359);
            } else {
                $driver->angle = $driverToCheck->angle();
            }
            $nearby[] = $driver;
        }
        return $nearby;
    }

    /**
     * Get nearby drivers.
     * @param App\Http\Requests\NearbyRequest $request
     * @return array
     */
    public static function nearbyCategorizedByCarType($request)
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
            $driverToCheck = User::whereId($u->user_id)->first()
                                ->driver->first();
            if (!is_null($driverToCheck)) {
                $type = $driverToCheck->car()->type;
                $parent = $type->parent;
                $driver->angle = $driverToCheck->angle();
                $driver->cat_id = $type->id;
                if (!is_null($parent)) {
                    $driver->parent_id = $parent->id;
                    $driver->parent_icon = $parent->icon;
                } else {
                    $driver->parent_id = 0;
                    $driver->parent_icon = asset('img/no-icon.png');
                }
                // $nearby[$driverToCheck->car()->type->parent->name][$driverToCheck->car()->type->name][] = $driver;
                // $nearby->cat_id = $driverToCheck->car()->type->id;
            }
            $nearby[] = $driver;
        }
        // foreach(CarType::orderBy('id', 'desc')->parents()->get() as $top) {
        //     if ($top->children()->count() != 0) {
        //         foreach ($top->children()->get() as $child) {
        //             if (! isset($nearby[$top->name][$child->name])) {
        //                 $nearby[$top->name][$child->name] = [];
        //             }
        //         }
        //     }
        // }
        return $nearby;
    }
}
