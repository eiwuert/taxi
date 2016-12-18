<?php

namespace App\Http\Controllers\Trip;

use DB;
use Auth;
use Gate;
use App\Trip;
use App\Rate;
use App\Status;
use App\Http\Requests\RateRequest;
use App\Http\Controllers\Controller;

class RateController extends Controller
{
	/**
	 * Submit client rating for driver.
	 * @param  App\Http\Requests\RateRequest $request
	 * @return json
	 */
    public function client(RateRequest $request)
    {
		if (Gate::allows('client', Auth::user()->client()->first()->trips()->orderBy('id', 'desc')->first())) {
			$this->rateOfClient($request->stars);

			$this->postRatingProcessing(Auth::user()->client()->first()
													 ->trips()->orderBy('id', 'desc')
													 ->first());

			return ok([
						'title' => 'Thanks for rating',
					]);
		} else {
			return fail([
				'title'  => 'You cannot rate',
				'detail' => 'You cannot rate this trip',
			]);
		}
    }

    /**
     * Submit driver rating for client.
     * @param  App\Http\Requests\RateRequest $request
     * @return json
     */
    public function driver(RateRequest $request)
    {
		if (Gate::allows('driver', Auth::user()->driver()->first()->trips()->orderBy('id', 'desc')->first())) {
			$this->rateOfDriver($request->stars);

			$this->postRatingProcessing(Auth::user()->driver()->first()
													 ->trips()->orderBy('id', 'desc')
													 ->first());

			return ok([
						'title' => 'Thanks for rating',
					]);
		} else {
			return fail([
					'title'  => 'You cannot rate',
					'detail' => 'You cannot rate this trip',
				]);
		}
    }

    /**
     * If both driver and client rate the trip then the trip is over.
     * @param  App\Trip $trip
     * @return void
     */
    private function postRatingProcessing($trip)
    {
    	$rate = $trip->rate()->first();
    	if (! is_null($rate->client) && ! is_null($rate->driver)) {
    		DB::table('trips')->where('id', $trip->id)
    			->update([
    					'status_id' => Status::where('name', 'trip_is_over')->first()->value,
    				]);
    	}
    }

    /**
     * Update rate of client.
     * @param  integer $stars
     * @return void
     */
    private function rateOfClient($stars)
    {
    	// Update rate
		DB::table('rates')->where('trip_id', Auth::user()->client()->first()
												 ->trips()->orderBy('id', 'desc')
												 ->first()->id)
			->update([
					'client'  => $stars,
				]);

		// Update trip status
		DB::table('trips')->where('id', Auth::user()->client()->first()
												 ->trips()->orderBy('id', 'desc')
												 ->first()->id)
			->update([
					'status_id' => Status::where('name', 'client_rated')->first()->value,
				]);
    }

    /**
     * Update rate of driver.
     * @param  integer $stars
     * @return void
     */
    private function rateOfDriver($stars)
    {
		DB::table('rates')->where('trip_id', Auth::user()->driver()->first()
												 ->trips()->orderBy('id', 'desc')
												 ->first()->id)
			->update([
					'driver'  => $stars,
				]);

		DB::table('trips')->where('id', Auth::user()->driver()->first()
												 ->trips()->orderBy('id', 'desc')
												 ->first()->id)
			->update([
					'status_id' => Status::where('name', 'driver_rated')->first()->value,					
				]);
    }
}
