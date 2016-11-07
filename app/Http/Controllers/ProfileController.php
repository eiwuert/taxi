<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
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
     * @param  ProfileRequest $profileRequest
     * @return json
     */
    public function update(ProfileRequest $profileRequest)
    {
    	return ok($this->user()->update($profileRequest->all()));
    }

    /**
     * Get appropriate user.
     * 
     * @return json
     */
    private function user()
    {
		if ($this->type == 'client') {
			return $this->user = Auth::user()->client();
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
