<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $fillable = [
        'name', 'car_type_id'
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
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drivers()
    {
        return $this->hasMany('App\User');
    }

    /**
     * A car type can associate to one car.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function car()
    {
        return $this->hasOne('App\Car');
    }

    /**
     * A car type can associate to many transaction.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    /**
     * A car type can have many sub types
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function children()
    {
        return $this->hasMany('App\CarType', 'car_type_id', 'id');
    }

    /**
     * A car type can have a parent
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function parent()
    {
        return $this->belongsTo('App\CarType', 'id', 'car_type_id');
    }

    /**
     * Scope a query for parents types.
     *
     * @param \Illuminate\Database\Eloquent\Builder 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeParents($query)
    {
        return $query->whereNull('car_type_id');
    }
}
