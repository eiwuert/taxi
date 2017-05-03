<?php

namespace App;

use Cache;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'value'];

    /**
     * Find option key and if find it update it. mass update.
     * @param  array $options
     * @return void
     */
    public static function findAndUpdate($options)
    {
        foreach ($options as $key => $value) {
            if ($option = self::whereName($key)->first()) {
                Cache::forever(config('app.name') . '_' . $key, $value);
                $option->update(['value' => $value]);
            }
        }
    }
}
