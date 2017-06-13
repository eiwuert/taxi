<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'latitude', 'longitude', 'radius', 'unit'];

    /**
     * A zone can has one fare.
     *
     * @return Illuminate\Database\Eloquent\Concerns\hasOne
     */
    public function fare()
    {
        return $this->hasOne('App\Fare');
    }

    /**
     * A Zone belongs to many car types.
     * @return belongsToMany
     */
    public function carTypes()
    {
        return $this->belongsToMany('App\CarType');
    }

    /**
     * Get car type IDs for given latLng and car type id.
     * @param  float $lat
     * @param  float $lng
     * @param  float $type
     * @return string
     */
    public static function carTypeIds(float $lat, float $lng, $type) : string
    {
        $zone = self::findZone($lat, $lng);
        $carTypes = [];
        if ($type != 'any') {
            return self::givenCarTypeInTheZone($zone, $type);
        } else {
            return self::allCarTypesInTheZone($zone);
        }
    }

    /**
     * Find zone for given lat and lng
     * @param  float $lat
     * @param  float $lng
     * @return \App\Zone
     */
    public static function findZone($lat, $lng) : Zone
    {
        $zone_id = Zone::whereName('default')->first()->id;
        $zones = Zone::where('id', '!=', $zone_id)->get();
        foreach ($zones as $zone) {
            $distance = $zone->radius;
            if ($zone->unit == 'mile') {
                $distance = $zone->radius * 1.60934;
            }
            if (self::distance($lat, $lng, $zone->latitude, $zone->longitude) <= $zone->radius) {
                $zone_id = $zone->id;
            }
        }
        return Zone::find($zone_id);
    }

    /**
     * Get distance between 2 latLng (KM)
     * @param  float $lat1
     * @param  float $lng1
     * @param  float $lat2
     * @param  float $lng2
     * @return float
     */
    protected static function distance(float $lat1, float $lng1, float $lat2, float $lng2) : float
    {
        $p = 0.017453292519943295;
        $a = 0.5 - cos(($lat2 - $lat1) * $p) / 2 +
            cos($lat1 * $p) * cos($lat2 * $p) *
            (1 - cos(($lng2 - $lng1) * $p)) / 2;
        return round(12742 * asin(sqrt($a)));
    }

    /**
     * Get all the car types that are in the given zone
     * @param  \App\Zone $zone
     * @param  integer $type
     * @return string
     */
    protected static function givenCarTypeInTheZone($zone, $type) : string
    {
        $in = '(';
        if ($zone->carTypes()->where('car_types.id', $type)->exists()) {
            foreach ($carTypes = CarType::whereIn('id', $zone->carTypes->where('id', $type)->pluck('id'))->get(['id'])->toArray() as $car) {
                if ($car === end($carTypes)) {
                    $in .= $car['id'] . ')';
                } else {
                    $in .= $car['id'] . ',';
                }
            }
        } else {
            $in .= '0)';
        }
        return $in;
    }

    /**
     * Get car type for give
     * @param  \App\Zone $zone
     * @return string
     */
    protected static function allCarTypesInTheZone($zone)
    {
        $in = '(';
        foreach ($carTypes = CarType::whereIn('id', $zone->carTypes->pluck('id'))->get(['id'])->toArray() as $car) {
            if ($car === end($carTypes)) {
                $in .= $car['id'] . ')';
            } else {
                $in .= $car['id'] . ',';
            }
        }
        return $in;
    }
}
