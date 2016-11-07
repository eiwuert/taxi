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
        'sex',
        'device_token',
        'device_type',
        'lock',
        'lang',
        'phone',
        'picture',
    ];

    /**
     * A client can have one user.
     * 
     * @return hasOne
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
     * Save user profile picture.
     * 
     * @param  string $picture
     * @return string
     */
    public function setPictureAttribute($picture)
    {
        $this->attributes['picture'] = $picture->store('public/profile/client');
    }
}
