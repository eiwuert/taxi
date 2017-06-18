<?php

namespace App\Repositories;

use DB;
use Cache;
use App\Trip;
use App\Zone;
use App\Fare;
use GoogleMaps;
use App\CarType;
use Carbon\Carbon;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionRepository
{
    /**
     * Rules of the car
     */
    private $rules;

    /**
     * Type of the car
     */
    private $type;

    /**
     * Currency to compute with
     */
    private $currency;

    /**
     * Create new transaction.
     * @param  App\Trip $trip
     * @param String $type
     * @param String $currency
     * @return json
     */
    public function newTransaction($trip, $type, $currency)
    {
        $this->currency = $currency;
        $this->type     = $type;
        $source   = $trip->source()->first();
        $formatedFares = $this->getTransactins($source->latitude, $source->longitude, $trip->distance_value, $trip->eta_value, 'IRR');
        $this->rules($type, $formatedFares);
        $timezone = $this->timezone($source->latitude, $source->longitude);

        $transaction = [
            'car_type'       => $this->type,
            'car_type_id'    => CarType::whereName($this->type)->first()->id,
            'currency'       => $this->currency,
            'entry'          => $this->entry(),
            'distance'       => $trip->distance_value,
            'per_distance'   => $this->perDistance(),
            'distance_unit'  => $this->distanceUnit(),
            'distance_value' => round($this->perDistance() * $this->distanceValue($trip->distance_value), 1),
            'time'           => $trip->eta_value,
            'per_time'       => $this->perTime(),
            'time_unit'      => $this->timeUnit(),
            'time_value'     => round($this->perTime() * $this->timeValue($trip->eta_value), 1),
            'surcharge'      => $this->surcharge($timezone),
            'timezone'       => $timezone,
            'total'          => $this->total($trip->distance_value, $trip->eta_value, $timezone),
            'commission'     => option('commission', 13),
        ];

        return $transaction;
    }

    /**
     * Calculate new transaction.
     * @param  App\Trip $trip
     * @param String $type
     * @param String $currency
     * @return json
     */
    public function calculate($lat, $long, $distance_value, $eta_value, $currency)
    {
        $timezone = $this->timezone($lat, $long);
        $formatedFares = $this->getTransactins($lat, $long, $distance_value, $eta_value, $currency);
        foreach ($formatedFares as $type => $rules) {
            $this->type = $type;
            $rules[$type] = $rules;
            $this->rules($type, $rules);
            $transaction = $this->transaction($distance_value, $eta_value, $timezone);
            unset($transaction['commission']);
            $transactions[] = $transaction;
        }
        return $transactions;
    }

    /**
     * Calculate new transaction.
     * @param  App\Trip $trip
     * @param String $type
     * @param String $currency
     * @param String $type
     * @return json
     */
    public function calculateV3($lat, $long, $distance_value, $eta_value, $currency, $type)
    {
        $type = CarType::find($type);
        if (!is_null($type->car_type_id)) {
            $type = $type->parent;
        }
        $transactions = [];
        $children = $type->children()->get(['name']);
        $types = [];
        foreach ($children as $child) {
            $types[] = $child->name;
        }
        $timezone = $this->timezone($lat, $long);
        $formatedFares = $this->getTransactins($lat, $long, $distance_value, $eta_value, $currency);
        foreach ($formatedFares as $type => $rules) {
            $this->type = $type;
            $rules[$type] = $rules;
            $this->rules($type, $rules);
            $transaction = $this->transaction($distance_value, $eta_value, $timezone);
            if (in_array($transaction['car_type'], $types)) {
                unset($transaction['commission']);
                $transactions[] = $transaction;
            }
        }

        return $transactions;

        // $timezone = $this->timezone($lat, $long);
        // $formatedFares = $this->getTransactins($lat, $long, $distance_value, $eta_value, $currency);
        // foreach ($formatedFares as $type => $rules) {
        //     $this->type = $type;
        //     $rules[$type] = $rules;
        //     $this->rules($type, $rules);
        //     $transaction = $this->transaction($distance_value, $eta_value, $timezone);
        //     unset($transaction['commission']);
        //     $transactions[CarType::whereName($type)->first()->parent->name][CarType::whereName($type)->first()->name] = $transaction;
        // }
        // return $transactions;
    }

    /**
     * Get transaction for car types.
     * @param  App\Trip $trip
     * @param String $type
     * @param String $currency
     * @return array
     */
    protected function getTransactins($lat, $long, $distance_value, $eta_value, $currency)
    {
        // default zone
        $zone_id = Zone::whereName('default')->first()->id;
        $zones = Zone::orderBy('id', 'desc')->get();
        foreach ($zones as $zone) {
            $distance = $zone->radius;
            if ($zone->unit == 'mile') {
                $distance = $zone->radius * 1.60934;
            }
            if ($this->distance($lat, $long, $zone->latitude, $zone->longitude) <= $zone->radius) {
                $zone_id = $zone->id;
            }
        }
        $this->currency = $currency;
        $transactions = [];
        $types = [];
        $fares = [];
        $zone = Zone::find($zone_id);
        if (Cache::has(config('app.name') . '_fare_' . $zone_id)) {
            $fares = Cache::get(config('app.name') . '_fare_' . $zone_id);
        } else {
            $fares = $zone->fare;
            if (is_null($zone->fare)) {
                $default = Zone::whereName('default')->first();
                if (Cache::has(config('app.name') . '_fare_' . $default->id)) {
                    $fares = Cache::get(config('app.name') . '_fare_' . $default->id);
                } else {
                    $fares = $default->fare->cost;
                    Cache::forever(config('app.name') . '_fare_' . $default->id, $fares);
                }
            } else {
                $fares = $fares->cost;
                Cache::forever(config('app.name') . '_fare_' . $zone_id, $fares);
            }
        }
        $formatedFares = [];
        foreach ($fares as $type => $fare) {
            $type = CarType::where('name', $type)->first();
            if (is_null($type) || 
                is_null($type->car_type_id)) {
                continue;
            }
            if (is_null($fare['entry']) ||
                is_null($fare['discount']) || is_null($fare['min']) || is_null($fare['surcharge']['from']) ||
                is_null($fare['surcharge']['to']) || is_null($fare['surcharge']['amount']) || is_null($fare['per_distance']) ||
                is_null($fare['per_time']) || is_null($fare['distance_unit']) || is_null($fare['time_unit'])) {
                continue;
            }
            $fare['surcharge']['*'] = $fare['surcharge'];
            unset($fare['surcharge']['to'], $fare['surcharge']['from'], $fare['surcharge']['amount']);
            $fare['discount'] = (float)($fare['discount'] / 100);
            $fare['surcharge']['*']['amount'] = (1 + ($fare['surcharge']['*']['amount'] / 100));
            $formatedFares[$type->name] = $fare;
        }
        return $formatedFares;
    }

    /**
     * Get distance between 2 latLng (KM)
     * @param  float $lat1
     * @param  float $lng1
     * @param  float $lat2
     * @param  float $lng2
     * @return float
     */
    protected function distance($lat1, $lng1, $lat2, $lng2)
    {
        $p = 0.017453292519943295;
        $a = 0.5 - cos(($lat2 - $lat1) * $p) / 2 +
            cos($lat1 * $p) * cos($lat2 * $p) *
            (1 - cos(($lng2 - $lng1) * $p)) / 2;
        return round(12742 * asin(sqrt($a)));
    }

    /**
     * Transaction array.
     * @param  string $distance_value
     * @param  string $eat_value
     * @param  string $timezone
     * @return array
     */
    private function transaction($distance_value, $eta_value, $timezone)
    {
        $carType = CarType::whereName($this->type)->first();
        return $transaction = [
            'car_type'       => __('car_types.'.$carType->slug),
            'car_type_id'    => $carType->id,
            'currency'       => $this->currency,
            'entry'          => $this->entry(),
            'distance'       => $distance_value,
            'per_distance'   => $this->perDistance(),
            'distance_unit'  => $this->distanceUnit(),
            'distance_value' => round($this->perDistance() * $this->distanceValue($distance_value), 1),
            'time'           => $eta_value,
            'per_time'       => $this->perTime(),
            'time_unit'      => $this->timeUnit(),
            'time_value'     => round($this->perTime() * $this->timeValue($eta_value), 1),
            'surcharge'      => $this->surcharge($timezone),
            'timezone'       => $timezone,
            'total'          => $this->total($distance_value, $eta_value, $timezone),
            'commission'     => option('commission', 13),
        ];
    }

    /**
     * Get total trip cost.
     * @param  int    $distance_value
     * @param  string $eta_value
     * @param  string $timezone
     * @return int
     */
    protected function total(int $distance_value, string $eta_value, string $timezone) : int
    {
        $total = round(($this->entry() + round($this->perDistance() * $this->distanceValue($distance_value), 1)
                                       + round($this->perTime()     * $this->timeValue($eta_value), 1))
                                                                    * $this->surcharge($timezone), -2);

        // Apply discount
        $total = $total * ((float) (1 - $this->rules['discount']));
        if ($total <= $this->minFare()) {
            $total = $this->minFare();
        }

        return (round((($total/1000)+5/2)/5)*5)*1000;
    }

    /**
     * Get entry fee.
     * @return float
     */
    public function entry()
    {
        return $this->rules['entry'];
    }

    /**
     * Get surcharge.
     * @param  string $week
     * @param  Carbon\Carbon $time
     * @return float
     */
    public function surcharge($timezone)
    {
        $now = Carbon::now($timezone);
        $surcharge = $this->rules['surcharge'];
        if (@isset($surcharge['*'])) {
            if ($this->inSurcharge($timezone, $surcharge['*'])) {
                return $surcharge['*']['amount'];
            }
        }

        if (@isset($surcharge[$this->dayToWeek($now->dayOfWeek)])) {
            foreach ($surcharge[$this->dayToWeek($now->dayOfWeek)] as $range) {
                if ($this->inSurcharge($timezone, $range)) {
                    return $range['amount'];
                }
            }
        }

        return 1.0;
    }

    /**
     * If we are in surcharge range.
     * @param  string $timezone
     * @param  array  $range
     * @return bool
     */
    protected function inSurcharge(string $timezone, array $range) : bool
    {
        $now = Carbon::now($timezone);
        $from = Carbon::now($timezone)->setTimeFromTimeString($range['from']);
        $to   = Carbon::now($timezone)->setTimeFromTimeString($range['to']);
        if ($now->between($from, $to)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get per distance.
     * @return float
     */
    public function perDistance()
    {
        return $this->rules['per_distance'];
    }

    /**
     * Get per time.
     * @return float
     */
    public function perTime()
    {
        return $this->rules['per_time'];
    }

    /**
     * Get time unit.
     * @return string
     */
    public function timeUnit()
    {
        return $this->rules['time_unit'];
    }

    /**
     * Get per distance unit.
     * @return string
     */
    public function distanceUnit()
    {
        return $this->rules['distance_unit'];
    }

    /**
     * Min fare of a trip.
     * @return string
     */
    public function minFare()
    {
        return $this->rules['min'];
    }

    /**
     * Get car type rules.
     * @param  string $type
     * @return array
     */
    public function rules($type, $rules)
    {
        $this->rules = $rules[$type];
    }

    /**
     * Convert day number to week name.
     * @param  integer $day
     * @return string
     */
    private function dayToWeek($day)
    {
        switch ($day) {
            case '1':
                return 'mon';
                break;
            case '2':
                return 'tue';
                break;
            case '3':
                return 'wed';
                break;
            case '4':
                return 'thu';
                break;
            case '5':
                return 'fri';
                break;
            case '6':
                return 'sat';
                break;
            default:
                return 'sun';
                break;
        }
    }

    /**
     * Get the timezone of the given lat and long.
     * @param float $lat
     * @param float $long
     * @return string
     */
    private function timezone(float $lat, float $long) : string
    {
        $timezone = @GoogleMaps::load('timezone')
                                ->setParam([
                                    'location' => $lat . ',' . $long,
                                    'timestamp' => '1331161200'
                                ])
                                ->get('timeZoneId')['timeZoneId'];

        if (! is_null($timezone)) {
            return $timezone;
        } else {
            return 'Asia/Tehran';
        }
    }

    /**
     * Convert distance to its corresponding unit.
     * @param  integer $distance
     * @return float
     */
    private function distanceValue($distance)
    {
        if ($this->distanceUnit() == 'kilometer') {
            return $distance / 1000;
        } elseif ($this->distanceUnit() == 'mile') {
            return $distance / 0.000621371;
        } else {
            return $distance;
        }
    }

    /**
     * Convert time to its corresponding unit.
     * @param  integer $time
     * @return float
     */
    private function timeValue($time)
    {
        if ($this->timeUnit() == 'minute') {
            return $time / 60;
        } elseif ($this->timeUnit() == 'hour') {
            return $time / 360;
        } else {
            return $time;
        }
    }

    /**
     * Calculate income of SAAMTaxi - 13%
     * @return numeric
     */
    public function income()
    {
        return Transaction::join('trips', 'transactions.trip_id', '=', 'trips.id')
                    ->select(['total'])
                    ->whereIn('status_id', Trip::$finished)
                    ->sum('total') * ((int)(option('commission', '13')) / 100);
    }
}
