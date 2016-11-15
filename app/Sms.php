<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sms';

    /**
     * A SMS can have one user.
     * 
     * @return hasMany
     */
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
