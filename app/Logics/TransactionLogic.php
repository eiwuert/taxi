<?php

namespace App\Logics;

use App\Trip;
use GoogleMaps;
use Carbon\Carbon;

class TransactionLogic
{
	/**
	 * Rules of the car
	 */
	private $rules;

	/**
	 * Currency to compute with
	 */
	private $currency;

	public function __construct($type, $currency)
	{
		$this->currency = $currency;
		$this->rules($type);
	}

	/**
	 * Create new transaction.
	 * @param  App\Trip $trip
	 * @return json
	 */
	public function new($trip)
	{
		$source   = $trip->source()->first();
		$timezone = $this->timezone($source->latitude, $source->longitude);

		$transaction = [
			'currency'		 => $this->currency,
			'entry'			 => $this->entry(),
			'distance'		 => $trip->distance_value,
			'per_distance'	 => $this->perDistance(),
			'distanceـunit'	 => $this->distanceUnit(),
			'distance_value' => round($this->perDistance() * $this->distanceValue($trip->distance_value), 1),
			'time'			 => $trip->eta_value,
			'per_time'		 => $this->perTime(),
			'timeـunit'		 => $this->timeUnit(),
			'time_value'	 => round($this->perTime() * $this->timeValue($trip->eta_value), 1),
			'surcharge'		 => $this->surcharge($timezone),
			'timezone'		 => $timezone,
			'total'			 => ( $this->entry() + round($this->perDistance() * $this->distanceValue($trip->distance_value), 1)
								  			     + round($this->perTime()     * $this->timeValue($trip->eta_value), 1))
											     * $this->surcharge($timezone),
		];

		return $transaction;
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
		$surcharge = $this->rules['surcharge'];
        $now = Carbon::today($timezone);

		if (@isset($surcharge[$this->dayToWeek($now->dayOfWeek)])) {
			foreach ($surcharge[$this->dayToWeek($now->dayOfWeek)] as $range) {
				$from = Carbon::now($timezone)->setTimeFromTimeString($range['from']);
				$to   = Carbon::now($timezone)->setTimeFromTimeString($range['to']);
				if ($now->between($from, $to)) {
					return $range['amount'];
				}
				
			}
		}

		return 1.0;
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
	 */
	private function timezone($lat, $long)
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
		} else if ($this->distanceUnit() == 'mile') {
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
		} else if ($this->timeUnit() == 'hour') {
			return $time / 360;
		} else {
			return $time;
		}
	}
}
