<?php

namespace App\Repositories;

use Auth;
use App\Driver;

class DriverRepository
{
    /**
     * Count of total drivers
     * @return numeric
     */
    public function countOfTotalDrivers()
    {
        return Driver::count();
    }

    /**
     * Count of online drivers
     * @return numeric
     */
    public function countOfOnlineDrivers()
    {
        return Driver::available()->count();
    }

    /**
     * Count of on way drivers
     * @return numeric
     */
    public function countOfOnWayDrivers()
    {
        return Driver::onWay()->count();
    }

    /**
     * Count of in-approve drivers
     * @return numeric
     */
    public function countOfInapproveDrivers()
    {
        return Driver::inapprove()->count();
    }

    /**
     * Count of offline drivers
     * @return numeric
     */
    public function countOfOfflineDrivers()
    {
        return Driver::offline()->count();
    }

    /**
     * Set online and available flags.
     * @param  boolean $online
     * @param  boolean $available
     * @return boolean
     */
    public static function updateFlags($online, $available)
    {
        $driver = Auth::user()->driver()->first();
        $driver->online    = $online;
        $driver->available = $available;
        return $driver->save();
    }
}
