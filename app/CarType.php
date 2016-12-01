<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $fillable = [
    	'name'
    ];

    /**
     * Scope a query for searching car types.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'LIKE', '%' . $term . '%');
    }

    /**
     * A type of a car can have many drivers.
     * 
     * @return HasMany
     */
    public function drivers()
    {
        return $this->hasMany('App\User');
    }

    /**
     * A car type can associate to one car.
     * 
     * @return hasOne
     */
    public function car()
    {
        return $this->hasOne('App\Car');
    }

    /**
     * A car type can associate to many transaction.
     * 
     * @return hasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
