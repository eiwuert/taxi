<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Web extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name',
    ];

    /**
     * A web user can have one user.
     * 
     * @return hasOne
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
