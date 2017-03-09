<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
    ];

    /**
     * A SMS can have one user.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function user()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Scope a query for getting sms based on time.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReceived($query, $minute)
    {
        return $query->where('created_at', '>', Carbon::now()->subMinute($minute)->toDateTimeString());
    }
}
