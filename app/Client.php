<?php

namespace App;

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
        $this->attributes['picture'] = $picture->store('public/storage/profile/client');
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
     * Get client phone number
     * @return string
     */
    public function phoneNumber()
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
        return $query->where('lock', true);
    }

    /**
     * Scope a query to only include unlocked clients.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnlocked($query)
    {
        return $query->where('lock', false);
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
}
