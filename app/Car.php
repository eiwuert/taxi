<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'number',
        'color',
        'user_id',
        'type_id',
    ];

    public static $info = [
        'number',
        'color',
        'type_id',
    ];

    /**
     * A car can have one user(driver).
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function driver()
    {
        return $this->hasOne('App\User');
    }

    /**
     * A car can have one car type.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function type()
    {
        return $this->hasOne('App\CarType', 'id', 'type_id');
    }

    /**
     * Get plate segment by segment.
     * @param  integer|null $segment
     * @return string|array|null
     */
    public function segments($segment = null)
    {
        $plate = [];
        if (in_array(substr($this->number, 0, 2), ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'])) {
            $plate[] = substr($this->number, 0, 4);
            $plate[] = substr($this->number, 4, 2);
            $plate[] = substr($this->number, 6, 6);
            $plate[] = substr($this->number, -4);
        } else {
            $plate[] = substr($this->number, 0, 2);
            $plate[] = substr($this->number, 2, 1);
            $plate[] = substr($this->number, 3, 3);
            $plate[] = substr($this->number, -2);
        }
        if (is_null($segment)) {
            return $plate;
        } else {
            return $plate[$segment] ?? null;
        }
    }
}
