<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Client;
use App\Driver;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
	/**
	 * API caller type.
	 * 
	 * @var string
	 */
	private $type;

	/**
	 * User instance.
	 * 
	 * @var App\User
	 */
	private $user;

	/**
	 * Constructor function
	 *
	 * @param  Request $request
	 * @return void
	 */
	public function __construct(Request $request)
	{
		$this->type = $request->segment(2);
	}

	/**
	 * Get profile data.
	 *
	 * @param  Request $request
	 * @return json
	 */
    public function get(Request $request)
    {
    	return ok($this->user()->first());
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
    				'detail' => 'All profile fields are optional, but empty requst is prohibited'
    			], 400);
    	}

		Client::where('user_id', Auth::user()->id)
			->first()
			->fill($profileRequest->all())
			->save();

		return $this->get($profileRequest);
    }

    public function profile($image)
    {
    	dd($image);
    }

    /**
     * Get appropriate user.
     * 
     * @return json
     */
    private function user()
    {
		if ($this->type == 'client') {
			return $this->user = User::wherePhone(Auth::user()->phone)
		                            ->orderBy('id', 'desc')
		                            ->first()->client()->first();
		} elseif ($this->type == 'driver') {
			return $this->user = Auth::user()->driver();
		} else {
		    return fail([
		            'title'  => 'Undefined type.',
		            'detail' => 'You are using undefined type, please contact your adminstrator.'
		        ], 400);
		}
    }
}
