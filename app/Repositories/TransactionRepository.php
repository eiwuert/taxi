<?php

namespace App\Repositories;

use DB;
use App\Trip;
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
        $this->rules($type);
        $source   = $trip->source()->first();
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
        $this->currency = $currency;
        $timezone = $this->timezone($lat, $long);
        $transactions = [];
        $types = [];
        foreach (config('fare.IRR') as $type => $rules) {
            $this->type = $type;
            $this->rules($type);
            $transaction = $this->transaction($distance_value, $eta_value, $timezone);
            unset($transaction['commission']);
            $transactions[] = $transaction;
        }
        return $transactions;
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
        return $transaction = [
            'car_type'       => $this->type,
            'car_type_id'    => CarType::whereName($this->type)->first()->id,
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
            foreach ($surcharge['*'] as $range) {
                if ($this->inSurcharge($timezone, $range)) {
                    return $range['amount'];
                }
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
        return $this->rules['perـdistance'];
    }

    /**
     * Get per time.
     * @return float
     */
    public function perTime()
    {
        return $this->rules['perـtime'];
    }

    /**
     * Get time unit.
     * @return string
     */
    public function timeUnit()
    {
        return $this->rules['timeـunit'];
    }

    /**
     * Get per distance unit.
     * @return string
     */
    public function distanceUnit()
    {
        return $this->rules['distanceـunit'];
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
    public function rules($type)
    {
        $this->rules = config('fare.' . $this->currency . '.' . $type);
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
