<?php

namespace App\Repositories\Trip;

use App\Car;
use App\Driver;
use App\Repositories\Trip\UserRepository;

class DriverRepository extends UserRepository {
    /**
     * Get driver of this trip.
     * @param  \App\Trip $trip
     * @return array
     */
    public static function this($trip)
    {
        // Will return object of the driver.
        if (! is_null($trip->driver_id)) {
            $driver = Driver::whereId($trip->driver_id);
            if (self::$obj) {
                return $driver->first();
            } else {
                $driver = $driver->first(Driver::$info);
                $driver->phone = $driver->phone();
                $car = $driver->car()->first(Car::$info);
                $type = $car->type()->first(['name']);
                unset($car->type_id, $driver->user_id);
                return [
                    'driver' => $driver,
                    'car'    => $car,
                    'type'   => $type,
                ];
            }
        }
        return false;
    }
}