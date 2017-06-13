<?php

namespace App;

use Image;
use Storage;
use App\Scopes\ClientPermissionScope;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
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
        static::addGlobalScope(new ClientPermissionScope);
    }

    /**
     * A client can have one user.
     *
     * @return hasOne
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * A client can have many trips.
     *
     * @return hasMany
     */
    public function trips()
    {
        return $this->hasOne('App\Trip');
    }

    /**
     * Save user profile picture.
     *
     * @param  string $picture
     * @return string
     */
    public function setPictureAttribute($picture)
    {
        $name = $this->attributes['picture'] = basename($picture->store('public/profile/client/'));
        $img = Image::make('storage/profile/client/' . $name);
        $img->fit(128);
        Storage::delete('storage/profile/client/' . $name);
        $img->save('storage/profile/client/' . $name);
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
            return asset('storage/profile/client/' . $picture);
        } else {
            return asset('img/no-profile.png');
        }
    }

    /**
     * Get client phone number
     * @deprecated 2.0 in favor phone method
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
     * Get client phone number
     * @return string
     */
    public function phone()
    {
        return User::whereId($this->user_id)->first()->phone;
    }

    /**
     * Scope a query to only include locked clients.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLocked($query)
    {
        return $query->where('lock', 1);
    }

    /**
     * Scope a query to only include unlocked clients.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnlocked($query)
    {
        return $query->where('lock', 0);
    }


    /**
     * get client state
     */
    public function state()
    {
        if ($this->lock) {
            return (object) ['color' => 'danger',
                            'name' => '<i class="ion-locked"></i>'];
        } else {
            return (object) ['color' => 'success',
                            'name' => '<i class="ion-unlocked"></i>'];
        }
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
     * Count of trips that client had.
     * @return numeric
     */
    public function countOfTrips()
    {
        return $this->trips()->count();
    }

    /**
     * Get client disbursement
     * @return numeric
     */
    public function disbursement()
    {
        $disbursement = 0;
        $this->trips()->finished()->each(function ($t) use (& $disbursement) {
            $disbursement += $t->transaction()->sum('total');
        });
        return number_format($disbursement);
    }

    /**
     * Get client average rate
     * @return float
     */
    public function rate()
    {
        $rate = Rate::whereIn('trip_id', $this->trips()
                                            ->get(['id'])
                                            ->flatten())
                    ->avg('driver');
        return number_format($rate, 2);
    }

    /**
     * Get the last location of the client.
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
     * Get client picture url.
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
            return __('clients.Unknown');
        } elseif (! is_null($this->getOriginal('last_name')) && is_null($first_name)) {
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
            return __('clients.Passenger');
        } elseif (! is_null($this->getOriginal('first_name')) && is_null($last_name)) {
            return '';
        } else {
            return $last_name;
        }
    }


    /**
     * Update client balance.
     *
     * @param  integer $addition
     * @return void
     */
    public function updateBalance($addition)
    {
        $this->forceFill([
            'balance' => $this->balance + $addition
        ])->save();
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
}
