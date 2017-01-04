<?php

namespace App\Repositories;

use App\Driver;

class DriverRepository
{
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
}