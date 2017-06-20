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
    protected $fillable = ['name', 'latitude', 'longitude', 'coordinates'];

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
        $default = Zone::whereName('default')->first();
        $zone_id = $default->id;
        $zones = Zone::where('id', '!=', $zone_id)->get();
        foreach ($zones as $zone) {
            if (self::isIn($zone, $lat, $lng)) {
                $zone_id = $zone->id;
            }
        }
        if ($zone_id == $default->id) {
            return $default;
        } else {
            return Zone::find($zone_id);
        }
    }

    /**
     * Is in the polygon.
     *
     * @param  \App\Zone  $zone
     * @param  float $lat
     * @param  float $lng
     * @return boolean
     */
    public static function isIn($zone, $lat, $lng)
    {
        $vertices_x = $zone->xCoordinates();
        $vertices_y = $zone->yCoordinates();
        $points_polygon = count($vertices_x) - 1;
        $i = $j = $c = $point = 0;
        for ($i = 0, $j = $points_polygon ; $i < $points_polygon; $j = $i++) {
            $point = $i;
            if ($point == $points_polygon) {
                $point = 0;
            }
            if ((($vertices_y[$point]  >  $lng != ($vertices_y[$j] > $lng)) &&
                ($lat < ($vertices_x[$j] - $vertices_x[$point]) *
                ($lng - $vertices_y[$point]) / ($vertices_y[$j] -
                $vertices_y[$point]) + $vertices_x[$point]))) {
                $c = !$c;
            }
        }
        return $c;
    }

    /**
     * Get all the car types that are in the given zone
     * @param  \App\Zone $zone
     * @param  integer $type
     * @return string
     */
    protected static function givenCarTypeInTheZone($zone, $type) : string
    {
        if (in_array($type, self::allCarTypesInTheZone($zone, true))) {
            $in = [];
            foreach ($carTypes = $zone->carTypes()->whereActive(true)
                                      ->orWhere('car_types.id', $type)
                                      ->orWhere('car_types.car_type_id', $type)
                                      ->get()->toArray() as $car) {
                if ($car === end($carTypes)) {
                    $in[] = $car['id'];
                } else {
                    $in[] = $car['id'];
                }
            }
            return '(' . implode(',', $in) . ')';
        } else {
            return '(0)';
        }
    }

    /**
     * Get car type for give
     * @param  \App\Zone $zone
     * @param  bool $array
     * @return string
     */
    protected static function allCarTypesInTheZone($zone, $array = false)
    {
        $in = [0];
        foreach ($carTypes = $zone->carTypes()->whereActive(true)
                                ->whereNotNull('car_types.car_type_id')
                                ->whereHas('parent', function($query) use ($zone) {
                                    $query->whereActive(true)->whereHas('zones', function ($query) use ($zone) {
                                        $query->where('zones.id', $zone->id);
                                    });
                                })->get()->toArray() as $car) {
            $in[] = $car['id'];
        }
        if ($array) {
            return $in;
        } else {
            return '(' . implode(',', $in) . ')';
        }
    }

    /**
     * Get the coordinates value.
     *
     * @param  string  $value
     * @return string
     */
    public function getCoordinatesAttribute($value)
    {
        return json_decode($value);
    }

    /**
     * Get zone's x-coordinates.
     *
     * @return array
     */
    public function xCoordinates()
    {
        return array_column($this->coordinates->geometries[0]->coordinates[0][0], 1);
    }

    /**
     * Get zone's y-coordinates.
     *
     * @return array
     */
    public function yCoordinates()
    {
        return array_column($this->coordinates->geometries[0]->coordinates[0][0], 0);
    }
}
