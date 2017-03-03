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
     * Scope a query to only include paid payments.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePaid($query)
    {
        return $query->wherePaid(true);
    }

    /**
     * Scope a query to only include not paid payments.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotPaid($query)
    {
        return $query->wherePaid(false);
    }

    /**
     * Update payment paid flag to true.
     *
     * @return void
     */
    public function paid()
    {
        $this->forceFill([
            'paid' => true
        ])->save();
    }
}
