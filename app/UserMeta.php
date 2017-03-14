<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
        'user_id',
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_meta';

    /**
     * A meta belongs to a user.
     * @return Illuminate\Database\Eloquent\Concerns\belongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
