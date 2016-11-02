<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
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
        'online',
        'approve',
        'available',
        'phone',
    ];

    /**
     * A driver can have one user.
     * 
     * @return hasOne
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
