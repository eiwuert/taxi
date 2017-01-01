<?php

namespace App;

use Auth;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'email', 
        'phone',
        'role',
        'password',
        'login_by',
        'social_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Encrypt password before saving to database.
     * 
     * @param  string $value
     * @return string
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * A user can have many locations.
     * 
     * @return HasMany
     */
    public function locations()
    {
        return $this->hasMany('App\Location');
    }

    /**
     * A user(driver) can have one car type.
     * 
     * @return hasOne
     */
    public function carType()
    {
        return $this->hasOne('App\CarType');
    }

    /**
     * A user(driver) can have one car.
     * 
     * @return hasOne
     */
    public function car()
    {
        return $this->hasOne('App\Car');
    }

    /**
     * A user can have one client.
     * 
     * @return hasMany
     */
    public function client()
    {
        return $this->hasMany('App\Client');
    }

    /**
     * A user can have one driver.
     * 
     * @return hasMany
     */
    public function driver()
    {
        return $this->hasOne('App\Driver');
    }

    /**
     * A user can have one web user.
     * 
     * @return hasMany
     */
    public function web()
    {
        return $this->hasMany('App\Web');
    }

    /**
     * A user can have many sms.
     * 
     * @return hasMany
     */
    public function sms()
    {
        return $this->hasMany('App\Sms');
    }

    /**
     * Scope a query to get all verified clients.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVerifiedClients($query)
    {
        return $query->where('role', 'client')
                     ->where('verified', true);
    }

    /**
     * Scope a query to get all verified drivers.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVerifiedDrivers($query)
    {
        return $query->where('role', 'driver')
                     ->where('verified', true);
    }

    /**
     * Scope a query to count all verified clients.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClientsCount($query)
    {
        return $query->select(['phone', 'verified'])
                        ->distinct()
                        ->verifiedClients()
                        ->get()
                        ->count();
    }

    /**
     * Scope a query to count all verified drivers.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDriversCount($query)
    {
        return $query->select(['phone', 'verified'])
                        ->distinct()
                        ->verifiedDrivers()
                        ->get()
                        ->count();
    }
}
