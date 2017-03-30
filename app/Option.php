<?php

namespace App;

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
                $option->update(['value' => $value]);
            }
        }
    }
}
