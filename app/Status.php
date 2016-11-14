<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'value',
    ];

    /**
     * A status can have many trips.
     * 
     * @return hasMany
     */
    public function trips()
    {
        return $this->hasMany('App\Trip');
    }
}
