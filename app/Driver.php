<?php

namespace App;

use Cache;
use Image;
use App\Car;
use Storage;
use App\User;
use App\Rate;
use App\Status;
use App\CarType;
use App\Location;
use App\Repositories\DriverRepository;
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
        'email',
        'country',
        'address',
        'zipcode',
        'picture',
    ];

    public static $sortable = [
        'first_name' => 'First name', 
        'last_name' => 'Last name',
        'email' => 'Email',
        'gender' => 'Gender',
        'device_type' => 'Device type',
        'lang' => 'Language',
        'state' => 'State',
        'country' => 'Country',
        'address' => 'Address',
        'zipcode' => 'Zip code',
        'created_at' => 'Created time',
        'updated_at' => 'Updated time',
    ];

    public static $info = [
        'first_name', 
        'last_name', 
        'email', 
        'gender', 
        'picture', 
        'user_id',
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
     * Save user profile picture.
     * 
     * @param  string $picture
     * @return string
     */
    public function setPictureAttribute($picture)
    {
        $name = $this->attributes['picture'] = basename($picture->store('public/profile/driver/'));
        $img = Image::make('storage/profile/driver/' . $name);
        $img->fit(128);
        Storage::delete('storage/profile/driver/' . $name);
        $img->save('storage/profile/driver/' . $name);
    }

    /**
     * get driver state
     */
    public function state()
    {
        if ($this->online && $this->available && $this->approve) {
            return (object) ['color' => 'success',
                            'name' => 'Online'];
        } else if (! $this->approve) {
            return (object) ['color' => 'danger',
                            'name' => 'not approved'];
        } else if ($this->online && ! $this->available) {
            return (object) ['color' => 'primary',
                            'name' => 'onway'];
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
        return $this->belongsTo('App\User');
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
     * Inverse trips
     * 
     * @return hasMany
     */
    public function inverseTrips()
    {
        return $this->trips()->orderBy('id', 'desc');
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
            return asset('storage/profile/driver/' . $picture);
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
        $this->trips()->finished()->each(function ($t) use (& $income) {
            $income += $t->transaction()->sum('total');
        });
        return number_format($income * .87, 2);
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

    /**
     * Get the last location of the driver.
     * @return string
     */
    public function lastLocation()
    {
        $location = Location::whereUserId($this->user_id)
                            ->orderBy('id', 'desc')
                            ->first();

        if (is_null($location)) {
            return 'Not found';
        } else {
            return $location->name;
        }
    }

    /**
     * Get the last LatLng of the driver.
     * @return string
     */
    public function lastLatLng()
    {
        if (Cache::has('location_' . $this->user_id)) {
            return Cache::get('location_' . $this->user_id);
        } else {
            $location = Location::whereUserId($this->user_id)
                            ->orderBy('id', 'desc')
                            ->first();
            if (is_null($location)) {
                $location = new Location();
                $location->latitude = 0.0;
                $location->longitude = 0.0;
            }
            Cache::forever('location_' . $this->user_id, ['lat' => $location->latitude, 'lng' => $location->longitude]);
            return ['lat' => $location->latitude, 'lng' => $location->longitude];
        }
    }

    /**
     * Get the car of the driver.
     * @return [type] [description]
     */
    public function car()
    {
        return Car::whereUserId($this->user_id)->first();
    }

    /**
     * list of car types.
     * @return array
     */
    public function carTypesPluck()
    {
        return CarType::pluck('name', 'id');
    }

    /**
     * Get driver phone number
     * @deprecated 2.0 in favor of shorter version phone
     * @return string
     */
    public function phoneNumber()
    {
        return User::whereId($this->user_id)->first()->phone;
    }

    /**
     * Get driver phone number
     * @return string
     */
    public function phone()
    {
        return User::whereId($this->user_id)->first()->phone;
    }

    /**
     * Get driver picture url.
     * @return String
     */
    public function getPicture()
    {
        if ($this->picture == 'no-profile.png') {
            return asset('img/no-profile.png');
        } else {
            return $this->picture;
        }
    }

    /**
     * Make driver offline.
     * @return boolean
     */
    public function goOffline()
    {
        // Driver can go offline?
        if (!$this->available) {
            return false;
        }

        // Online    false
        // Available false
        if (DriverRepository::updateFlags(false, false)) {
            return true;
        }
        return false;
    }

    /**
     * Make driver online
     * @return boolean
     */
    public function goOnline()
    {
        // Driver can go online?
        if ($this->online) {
            return false;
        }

        // Online    true
        // Available true
        if (DriverRepository::updateFlags(true, true)) {
            return true;
        }
        return false;
    }

    /**
     * Update driver availability.
     * @param  boolean $state
     * @return void
     */
    public function updateDriverAvailability($state)
    {
        $this->available = $state;
        $this->save();
    }
}
