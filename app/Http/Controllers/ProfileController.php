<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Client;
use App\Driver;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\DriverProfileRequest;

class ProfileController extends Controller
{
	/**
	 * Get profile data.
	 *
	 * @param  Request $request
	 * @return json
	 */
    public function get()
    {
    	return ok($this->user());
    }

    /**
     * Update profile data.
     *
     * Update authenticated user profile data.
     * @param  ProfileRequest $profileRequest
     * @return json
     */
    public function update(ProfileRequest $profileRequest)
    {
    	// All field are optional, but we are not going to accept empty response.
    	if(empty($profileRequest->all())) {
    		return fail([
    				'title'  => 'Empty request is prohibited',
    				'detail' => 'All profile fields are optional, but empty request is prohibited'
    			], 400);
    	}

		User::wherePhone(Auth::user()->phone)
            ->orderBy('id', 'desc')
            ->first()->client()->first()
			->fill($profileRequest->intersect(array_keys($profileRequest->rules())))
			->save();

		return $this->get();
    }

    /**
     * Update driver profile.
     * @param  DriverProfileRequest $request
     * @return json
     */
    public function updateDriver(DriverProfileRequest $request)
    {
        Auth::user()->driver()->orderBy('id', 'desc')
                    ->first()->fill($request->all())->save();
        return $this->get();
    }

    /**
     * Get appropriate user.
     * 
     * @return json
     */
    private function user()
    {
		if (Auth::user()->role == 'client') {
			$client = User::wherePhone(Auth::user()->phone)
		                            ->orderBy('id', 'desc')
		                            ->first()->client()->first();
			$client = $client->toArray();
			$client['phone'] = Auth::user()->phone;
		    return $client;
		} elseif (Auth::user()->role == 'driver') {
			$driver = Auth::user()->driver()->first()->toArray();
			$driver['phone'] = Auth::user()->phone;
			return $driver;
		} else {
		    return fail([
		            'title'  => 'Undefined type.',
		            'detail' => 'You are using undefined type, please contact your administrator.'
		        ], 400);
		}
    }
}
