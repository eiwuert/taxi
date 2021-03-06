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
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->hasMany('App\Location');
    }

    /**
     * A user(driver) can have one car type.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function carType()
    {
        return $this->hasOne('App\CarType');
    }

    /**
     * A user(driver) can have one car.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function car()
    {
        return $this->hasOne('App\Car');
    }

    /**
     * A user can have one client.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function client()
    {
        return $this->hasMany('App\Client');
    }

    /**
     * A user can have one driver.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function driver()
    {
        return $this->HasMany('App\Driver');
    }

    /**
     * A user can have one web user.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function web()
    {
        return $this->hasOne('App\Web');
    }

    /**
     * A user can have many sms.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
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
        foreach (User::whereRole('web')->get() as $admin) {
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
        foreach (User::whereRole('web')->get() as $admin) {
            $admin->unreadNotifications()
                  ->whereType('App\Notifications\ClientCreated')
                  ->update(['read_at' => Carbon::now()]);
        }
    }

    /**
     * A user has one meta data.
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function meta()
    {
        return $this->hasOne('App\UserMeta');
    }

    /**
     * Set the phone value.
     *
     * @param  string  $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = '98' . substr($value, -10);
    }

    /**
     * Get the phone attribute started with 0.
     *
     * @return string
     */
    public function phone()
    {
        return '0' . substr($this->phone, -10);
    }

    /**
     * Get name of the client or driver.
     *
     * @return string|null
     */
    public function name()
    {
        $user = call_user_func([$this, $this->role])->first();
        if (is_null($user)) {
            return null;
        }
        if ((is_null($user->first_name) && is_null($user->last_name)) ||
            ($user->first_name == '' && $user->last_name == '')) {
            return null;
        } else if ($user->first_name == '' &&  $user->last_name != '') {
            return $user->last_name;
        } else if ($user->first_name != '' &&  $user->last_name == '') {
            return $user->first_name;
        } else {
            return $user->first_name . ' ' . $user->last_name;
        }
    }

    /**
     * Get the user last trip if existed.
     * @return \App\Trip|null
     */
    public function trip()
    {
        $user = call_user_func([$this, $this->role])->first();
        if (!is_null($user->trips())) {
            return $user->trips()->orderBy('id', 'desc')->first();
        } else {
            return null;
        }
    }

    public function states()
    {
        $permissions = Auth::user()->web->permissions;
        if (! in_array(0, $permissions)) {
            $states = [];
            foreach ($permissions as $key => $value) {
                $states[$value] = config('states')[$value];
            }
            return $states;
        } else {
            $states = config('states');
            unset($states[0]);
            return $states;
        }
    }
}
