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
        return $this->hasOne('App\User', 'id', 'user_id');
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
}
