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
}
