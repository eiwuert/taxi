<?php

namespace App;

use App\Rate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name',
        'gender',
        'device_token',
        'device_type',
        'lang',
        'state',
        'country',
        'address',
        'zipcode',
        'picture',
    ];

    /**
     * Scope a query to only include offline drivers.
     * online    0
     * available 0
     * approve   1
     * 
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOffline($query)
    {
        return $query->where('online', 0)
                     ->where('available', 0)
                     ->where('approve', 1);
    }

    /**
     * Scope a query to only include inapprove drivers.
     * online    0
     * available 0
     * approve   0
     * 
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInapprove($query)
    {
        return $query->where('online', 0)
                     ->where('available', 0)
                     ->where('approve', 0);
    }

    /**
     * Scope a query to only include onWay drivers.
     * online    1
     * available 0
     * approve   1
     * 
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnWay($query)
    {
        return $query->where('online', 1)
                     ->where('available', 0)
                     ->where('approve', 1);
    }

    /**
     * Scope a query to only include available/online drivers.
     * online    1
     * available 1
     * approve   1
     * 
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('online', 1)
                     ->where('available', 1)
                     ->where('approve', 1);
    }

    /**
     * Scope a query to only include available/online drivers.
     * online    1
     * available 1
     * approve   1
     * 
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnline($query)
    {
        return $query->where('online', 1)
                     ->where('available', 1)
                     ->where('approve', 1);
    }

    /**
     * get driver state
     */
    public function state()
    {
        if ($this->online) {
            return (object) ['color' => 'success',
                            'name' => 'Online'];
        } else if (! $this->approve) {
            return (object) ['color' => 'danger',
                            'name' => 'not approved'];
        } else if ($this->online && ! $this->available) {
            return (object) ['color' => 'primary',
                            'name' => 'on-way'];
        } else {
            return (object) ['color' => 'warning',
                            'name' => 'Offline'];
        }
    }

    /**
     * A driver can have one user.
     * 
     * @return hasOne
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
     * A driver can have many trips.
     * 
     * @return hasMany
     */
    public function trips()
    {
        return $this->hasMany('App\Trip');
    }

    /**
     * Save user profile picture.
     * 
     * @param  string $picture
     * @return string
     */
    public function setPictureAttribute($picture)
    {
        $this->attributes['picture'] = $picture->store('public/storage/profile/driver');
    }

    /**
     * Get full path to profile picture url.
     * 
     * @param  string $picture
     * @return string
     */
    public function getPictureAttribute($picture)
    {
        if ($picture != 'no-profile.png') {
            return asset($picture);
        } else {
            return $picture;
        }
    }

    /**
     * Count of trips that drivers had.
     * @return numeric
     */
    public function countOfTrips()
    {
        return $this->trips()->count();
    }

    /**
     * Get driver income
     * @return numeric
     */
    public function income()
    {
        $income = 0;
        $this->trips()->each(function ($t) use (& $income) {
            $income += $t->transaction()->sum('total');
        });
        return number_format($income);
    }

    /**
     * Get driver average rate
     * @return float
     */
    public function rate()
    {
        $rate = Rate::whereIn('trip_id', $this->trips()
                                            ->get(['id'])
                                            ->flatten())
                    ->avg('client');
        return number_format($rate, 2);
    }
}
