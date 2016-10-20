<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'sex',
        'email', 
        'password',
        'picture',
        'device_type',
        'login_by',
        'social_id',
        'token',
        'active',
        'online',
        'approve',
        'role',
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
     * Set the user's token.
     *
     * @param  string  $value
     * @return void
     */
    public function setTokenAttribute($value)
    {
        $this->attributes['token'] = md5(microtime().rand());
    }
}
