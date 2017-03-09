<?php

namespace App;

use Image;
use Storage;
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
        'picture',
    ];

    /**
     * A web user can have one user.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Save user profile picture.
     *
     * @param  string $picture
     * @return string
     */
    public function setPictureAttribute($picture)
    {
        $name = $this->attributes['picture'] = basename($picture->store('public/profile/web/'));
        $img = Image::make('storage/profile/web/' . $name);
        $img->fit(128);
        Storage::delete('storage/profile/web/' . $name);
        $img->save('storage/profile/web/' . $name);
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
            return asset('storage/profile/web/' . $picture);
        } else {
            return asset('img/' . $picture);
        }
    }
}
