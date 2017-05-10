<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    /**
     * Table name.
     * @var string
     */
    protected $table = 'agencies';

    /**
     * Mass assignable columns.
     * @var array
     */
    protected $fillable = ['phone', 'address', 'state'];

    /**
     * List of available agencies that can be updated.
     * @return array
     */
    public static function states($agency = null) : array
    {
        $states = config('states');
        foreach (self::get(['state'])->flatten() as $a) {
            unset($states[$a->state]);
        }
        if (!is_null($agency)) {
            $states[$agency->state] = config('states')[$agency->state];
        }
        return $states;
    }
}
