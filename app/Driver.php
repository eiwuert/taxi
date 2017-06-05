<?php

namespace App;
use Auth;
use Cache;
use Image;
use Storage;
use App\Car;
use App\Rate;
use App\User;
use App\Status;
use App\CarType;
use App\Location;
use App\Scopes\DriverPermissionScope;
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
    protected $fillable = ['first_name', 'last_name', 'gender', 'device_token',
        'device_type', 'lang', 'state', 'email', 'country', 'address', 'zipcode',
        'picture', 'identity_number', 'identity_code', 'abuse_history','drug_abuse', 
        'credit_card'
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
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new DriverPermissionScope);
    }

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
        return $query->where('online', false)
                     ->where('available', false)
                     ->where('approve', true);
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
        return $query->where('online', false)
                     ->where('available', false)
                     ->where('approve', false);
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
        return $query->where('online', true)
                     ->where('available', 0)
                     ->where('approve', true);
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
        return $query->where('online', true)
                     ->where('available', true)
                     ->where('approve', true);
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
        return $query->where('online', true)
                     ->where('available', true)
                     ->where('approve', true);
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
                            'name' => __('admin/general.Online')];
        } elseif (! $this->approve) {
            return (object) ['color' => 'danger',
                            'name' => __('admin/general.not approved')];
        } elseif ($this->online && ! $this->available) {
            return (object) ['color' => 'primary',
                            'name' => __('admin/general.onway')];
        } else {
            return (object) ['color' => 'warning',
                            'name' => __('admin/general.Offline')];
        }
    }

    /**
     * A driver can have one user.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * A driver can have many trips.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function trips()
    {
        return $this->hasMany('App\Trip');
    }

    /**
     * A driver can have many accounting records.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function accounting()
    {
        return $this->hasMany('App\Accounting');
    }

    /**
     * Inverse trips
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
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
            return asset('img/no-profile.png');
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
     * @deprecated 2.0 in favor of credit and debit
     * @return numeric
     */
    public function income($date = null)
    {
        $income = 0;
        $this->trips()->range($date)->finished()->each(function ($t) use (& $income) {
            $total = $t->transaction()->sum('total');
            $income += (((100 - (int)($t->transaction->commission)) / 100) * $total);
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
        $cacheName = config('app.name') . '_location_' . $this->user_id;
        if (Cache::has($cacheName)) {
            return Cache::get($cacheName);
        } else {
            if (is_null($this->latitude) || is_null($this->longitude)) {
                $location = Location::whereUserId($this->user_id)
                                ->orderBy('id', 'desc')
                                ->first();
                if (is_null($location)) {
                    $location = new Location();
                    $location->latitude = 0.0;
                    $location->longitude = 0.0;
                } else {
                    $this->forceFill([
                        'latitude'  => $location->latitude,
                        'longitude' => $location->longitude,
                    ])->save();
                }
            }
            Cache::forever($cacheName, ['lat' => $this->latitude, 'lng' => $this->longitude]);
            return ['lat' => $this->latitude, 'lng' => $this->longitude];
        }
    }

    /**
     * Get the car of the driver.
     * @return integer
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
        return CarType::orderBy('created_at', 'desc')
                        ->children()->pluck('name', 'id');
    }

    /**
     * Get driver phone number
     * @deprecated 2.0 in favor of shorter version phone
     * @return string
     */
    public function phoneNumber()
    {
        $phone = User::whereId($this->user_id)->first()->phone;
        if (\Request::segment(1)) {
            $phone = convert($phone);
        }
        return $phone;
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
     * Get the first name value.
     *
     * @param  string  $value
     * @return string
     */
    public function getFirstNameAttribute($first_name)
    {
        if (is_null($this->getOriginal('last_name')) && is_null($first_name)) {
            return __('drivers.Unknown');
        } else if (! is_null($this->getOriginal('last_name')) && is_null($first_name)) {
            return '';
        } else {
            return $first_name;
        }
    }

    /**
     * Get the LastName value.
     *
     * @param  string  $value
     * @return string
     */
    public function getLastNameAttribute($last_name)
    {
        if (is_null($this->getOriginal('first_name')) && is_null($last_name)) {
            return __('drivers.Driver');
        } else if (! is_null($this->getOriginal('first_name')) && is_null($last_name)) {
            return '';
        } else {
            return $last_name;
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

    /**
     * Calculate angle between last 2 position of the driver.
     * @return int
     */
    public function angle()
    {
        $locations = Location::whereUserId($this->user_id)
                            ->distinct()
                            ->orderBy('id', 'desc')
                            ->limit(2);
        $locations = $locations->get();
        if ($locations->count() == 2) {
            $cache = config('app.name') . '_driver_' . $this->id . '_angle';
            $lng1 = $locations[0]->longitude;
            $lng2 = $locations[1]->longitude;
            $lat1 = $locations[0]->latitude;
            $lat2 = $locations[1]->latitude;
            // If last location is within the 20 meter return the previous angle.
            if (!$this->distance($lat1, $lng1, $lat2, $lng2) && Cache::has($cache)) {
                return Cache::get($cache);
            }
            $dLon = $lng2 - $lng1;
            $y = sin($dLon) * cos($lat2);
            $x = cos($lat1) * sin($lat2) - sin($lat1) * cos($lat2) * cos($dLon);
            $angle = 360 - ((rad2deg(atan2($y, $x)) + 360) % 360);
            Cache::forever($cache, $angle);
            return $angle;
        } else {
            return rand(0, 359);
        }
    }

    /**
     * Get distance between 2 latLng
     * @param  float $lat1
     * @param  float $lng1
     * @param  float $lat2
     * @param  float $lng2
     * @return float
     */
    protected function distance($lat1, $lng1, $lat2, $lng2) : int
    {
        $p = 0.017453292519943295;
        $a = 0.5 - cos(($lat2 - $lat1) * $p) / 2 + 
            cos($lat1 * $p) * cos($lat2 * $p) * 
            (1 - cos(($lng2 - $lng1) * $p)) / 2;
        return round(12742 * asin(sqrt($a)) * 1000);
    }

    /**
     * Get state name.
     * 
     * @return string
     */
    public function stateName()
    {
        return config('states.' . $this->state);
    }

    /**
     * Driver debit.
     * @return integer
     */
    public function totalDebit($date = null) : string
    {
        $debit = 0;
        $this->trips()->range($date)->finished()->each(function ($t) use (& $debit) {
            if (! is_null($trip = $t->payments()->paid())) {
                if ($trip->first()->type == 'cash') {
                    $total = $t->transaction()->sum('total');
                    $debit += ((((int)($t->transaction->commission)) / 100) * $total);
                }
            }
        });
        return $debit;
    }

    /**
     * Driver credit.
     * @return integer
     */
    public function totalCredit($date = null) : string
    {
        $credit = 0;
        $this->trips()->range($date)->finished()->each(function ($t) use (& $credit) {
            if (! is_null($trip = $t->payments()->paid())) {
                if ($trip->first()->type == 'wallet') {
                    $total = $t->transaction()->sum('total');
                    $credit += (((100 - (int)($t->transaction->commission)) / 100) * $total);
                }
            }
        });
        return $credit;
    }

    /**
     * Driver credit
     * @return string
     */
    public function credit() : string
    {
        return ($this->totalCredit() + $this->accounting->sum('debit')) - 
               ($this->totalDebit() + $this->accounting->sum('credit'));
    }

    /**
     * Driver debit
     * @return string
     */
    public function debit() : string
    {
        return ($this->totalDebit() + $this->accounting->sum('credit')) - 
               ($this->totalCredit() + $this->accounting->sum('debit'));
    }
}
