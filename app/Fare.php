<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['currency_id', 'zone_id', 'cost'];

    /**
     * A fare can belong to a zone.
     *
     * @return Illuminate\Database\Eloquent\Concerns\belongsTo
     */
    public function zone()
    {
        return $this->belongsTo('App\Zone');
    }

    /**
     * A fare can belong to a currency.
     *
     * @return Illuminate\Database\Eloquent\Concerns\belongsTo
     */
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }

    /**
     * Set the cost value.
     *
     * @param  string  $value
     * @return void
     */
    public function setCostAttribute($value)
    {
        $this->attributes['cost'] = serialize($value);
    }

    /**
     * Get the cost value.
     *
     * @param  string  $value
     * @return string
     */
    public function getCostAttribute($value)
    {
        // dd(unserialize($value));
        return unserialize($value);
    }
}
