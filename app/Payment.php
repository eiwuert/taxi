<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'paid',
        'type',
        'detail',
    ];

    /**
     * Get payment's detail.
     *
     * @param  array $value
     * @return array
     */
    public function getDetailAttribute($value)
    {
        return unserialize($value);
    }

    /**
     * Set the payment's detail.
     *
     * @param  array  $value
     * @return void
     */
    public function setDetailAttribute($value)
    {
        $this->attributes['detail'] = serialize($value);
    }

    /**
     * A payment has a trip.
     *
     * @return Illuminate\Database\Eloquent\Concerns\belongsTo
     */
    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }

    /**
     * A payment has a transaction.
     *
     * @return Illuminate\Database\Eloquent\Concerns\belongsTo
     */
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
}
