<?php

namespace App\Repositories\Trip;

use App\Repositories\Trip\MainRepository;

class UserRepository extends MainRepository
{
    /**
     * determine return object or array
     * @var string
     */
    protected static $obj;

    /**
     * Get client object of the given trip.
     * @return static
     */
    public static function of()
    {
        if (is_null(static::$obj)) {
            static::$obj = true;
        }
        return new static;
    }

    /**
     * Get client info the given trip.
     * @return static
     */
    public static function info()
    {
        static::$obj = false;
        return new static;
    }
}