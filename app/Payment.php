<?php

namespace App;

use App\Repositories\FilterRepository;
use App\Scopes\PaymentPermissionScope;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'paid',
        'type',
        'detail',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PaymentPermissionScope);
    }

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
     * A payment has a client.
     *
     * @return Illuminate\Database\Eloquent\Concerns\belongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
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

    /**
     * Determine that this payment is for a trip or its for charge.
     * @return string
     */
    public function purpose()
    {
        if (is_null($this->trip_id)) {
            return 'Charge';
        } else {
            return 'Trip';
        }
    }

    /**
     * Scope a query to include payments with type of cash.
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCash($query)
    {
        return $query->where('type', 'cash');
    }

    /**
     * Scope a query to include payments with type of wallet.
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWallet($query)
    {
        return $query->where('type', 'wallet')->whereNotNull('trip_id');
    }

    /**
     * Scope a query to include payments with type of charge.
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCharge($query)
    {
        return $query->where('type', 'wallet')->whereNull('trip_id');
    }

    /**
     * Show amount of payment.
     * @return integer
     */
    public function amount()
    {
        if ($this->type == 'wallet' && is_null($this->trip_id)) {
            return $this->transactionAmount;
        } else {
            return $this->trip->transaction->total;
        }
    }

    /**
     * Scope a query to get data within a range.
     *
     * @param string $range
     * @param \Illuminate\Database\Eloquent\Builder 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRange($query, $range)
    {
        return FilterRepository::daterange($range, $query);
    }
}
