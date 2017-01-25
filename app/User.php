<?php

namespace App;

use Auth;
use Carbon\Carbon;
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
        return $this->HasMany('App\Driver');
    }

    /**
     * A user can have one web user.
     * 
     * @return hasMany
     */
    public function web()
    {
        return $this->hasMany('App\Web')->first();
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

    /**
     * Count of unread notifications that are belongs to registered clients.
     * @return Numeric
     */
    public function countOfRegisteredClients()
    {
        $count = 0;
        foreach ($this->unreadNotifications as $noti) {
            if ($noti->type == 'App\Notifications\ClientCreated') {
                $count += 1;
            }
        }
        return $count;
    }

    /**
     * Count of unread notifications that are belongs to registered drivers.
     * @return Numeric
     */
    public function countOfRegisteredDrivers()
    {
        $count = 0;
        foreach ($this->unreadNotifications as $noti) {
            if ($noti->type == 'App\Notifications\DriverCreated') {
                $count += 1;
            }
        }
        return $count;
    }

    /**
     * new clients notifications text.
     * @return String
     */
    public function newClientsNotificationText()
    {
        if ($this->countOfRegisteredClients() == 1) {
            return '<i class="ion-android-walk text-aqua"></i> ' . $this->countOfRegisteredClients() . ' new client registered';
        } else {
            return '<i class="ion-android-walk text-aqua"></i> ' . $this->countOfRegisteredClients() . ' new clients registered';
        }
    }

    /**
     * new drivers notifications text.
     * @return String
     */
    public function newDriversNotificationText()
    {
        if ($this->countOfRegisteredDrivers() == 1) {
            return '<i class="ion-model-s text-aqua"></i> ' . $this->countOfRegisteredDrivers() . ' new driver registered';
        } else {
            return '<i class="ion-model-s text-aqua"></i> ' . $this->countOfRegisteredDrivers() . ' new drivers registered';
        }
    }

    /**
     * new driver ids.
     * @return String
     */
    public function newDriverIds()
    {
        $driverIds = [];
        foreach ($this->unreadNotifications as $noti) {
            if ($noti->type == 'App\Notifications\DriverCreated') {
                $driverIds[] = $noti->data['driver_id'];
            }
        }
        return implode(',', $driverIds);
    }

    /**
     * new client ids.
     * @return String
     */
    public function newClientIds()
    {
        $clientIds = [];
        foreach ($this->unreadNotifications as $noti) {
            if ($noti->type == 'App\Notifications\ClientCreated') {
                $clientIds[] = $noti->data['client_id'];
            }
        }
        return implode(',', $clientIds);
    }

    /**
     * Mark new drivers notifications as read for all administrators
     * @return void
     */
    public function markNewDriversNotificationsAsRead()
    {
        foreach(User::whereRole('web')->get() as $admin) {
            $admin->unreadNotifications()
                  ->whereType('App\Notifications\DriverCreated')
                  ->update(['read_at' => Carbon::now()]);
        }
    }

    /**
     * Mark new clients notifications as read for all administrators
     * @return void
     */
    public function markNewClientsNotificationsAsRead()
    {
        foreach(User::whereRole('web')->get() as $admin) {
            $admin->unreadNotifications()
                  ->whereType('App\Notifications\ClientCreated')
                  ->update(['read_at' => Carbon::now()]);
        }
    }
}
