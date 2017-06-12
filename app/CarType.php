<?php

namespace App;

use File;
use Image;
use Storage;
use App\Car;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $fillable = [
        'name', 'car_type_id', 'icon', 'active', 'position', 'slug',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'active' , 'car_type_id',
         'names'  //must be delete
    ];

    protected $appends = ['name'];

    /**
     * Scope a query for searching car types.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'LIKE', '%' . $term . '%');
    }

    /**
     * A type of a car can have many drivers.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drivers()
    {
        return $this->hasMany('App\User');
    }

    /**
     * A car type can associate to one car.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function car()
    {
        return $this->hasOne('App\Car');
    }

    /**
     * A car type can associate to many transaction.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    /**
     * A car type can have many sub types
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function children()
    {
        return $this->hasMany('App\CarType', 'car_type_id', 'id');
    }

    /**
     * A car type can have a parent
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasMany
     */
    public function parent()
    {
        return $this->belongsTo('App\CarType', 'car_type_id', 'id');
    }

    /*
     * Scope a query for parents types.
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeParents($query)
    {
        return $query->whereNull('car_type_id');
    }

    /*
     * Scope a query for children types.
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeChildren($query)
    {
        return $query->whereNotNull('car_type_id');
    }

    /**
     * Save car type icon.
     *
     * @param  string $icon
     * @return string
     */
    public function setIconAttribute($icon)
    {
        if (!is_null($icon)) {
            $name = $this->attributes['icon'] = basename($icon->store('public/car_types/icon/'));
            $img = Image::make('storage/car_types/icon/' . $name);
            $img->fit(128);
            Storage::delete('storage/car_types/icon/' . $name);
            $img->save('storage/car_types/icon/' . $name);
            $img->fit(30);
            $img->save('storage/car_types/icon/30-' . $name . '');
        }
    }

    /**
     * Get full path to car type icon url.
     *
     * @param  string $picture
     * @return string
     */
    public function getIconAttribute($picture)
    {
        if ($picture != 'no-icon.png') {
            return asset('storage/car_types/icon/' . $picture);
        } else {
            return asset('img/no-icon.png');
        }
    }

    /**
     * Get full path to car type icon url.
     *
     * @return string
     */
    public function getMapIconAttribute()
    {
        $picture = $this->getOriginal('icon');
        if ($picture != 'no-icon.png') {
            if (!File::exists(asset('storage/car_types/icon/30-' . $picture))) {
                $img = Image::make('storage/car_types/icon/' . $picture);
                $img->fit(30);
                $img->save('storage/car_types/icon/30-' . $picture . '');
            }
            return asset('storage/car_types/icon/30-' . $picture);
        } else {
            return asset('img/30-no-icon.png');
        }
    }

    /**
     * Can delete the given car type. A car type can be deleted when no driver's
     * car assigned to the given car type.
     *
     * @return bool
     */
    public function canDelete()
    {
        $types = [$this->id];
        if (!is_null($this->children) && !$this->children->isEmpty()) {
            foreach ($this->children()->get(['id']) as $type) {
                $types[] = $type->id;
            }
        }
        if (Car::with('type')->whereIn('type_id', $types)->exists()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Update car type position
     *
     * @return [type] [description]
     */
    public function updatePosition()
    {

    }

    /** Get translated of name
     * @return \Illuminate\Contracts\Translation\Translator|string
     */
    public function getNameAttribute()
    {
        $translate =  __('car_types.' . $this->attributes['slug'] . '.name');
        if( $translate == 'car_types.' . $this->attributes['slug'] . '.name' ){
            return $this->attributes['slug'];
        }
        return $translate;
    }

}
