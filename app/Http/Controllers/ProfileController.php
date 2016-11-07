<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	/**
	 * API caller type.
	 * 
	 * @var string
	 */
	private $type;

	/**
	 * Constructor function
	 */
	public function __construct(Request $request)
	{
		$this->type = $request->segment(2);
	}

	/**
	 * Get profile data.
	 * 
	 * @return 
	 */
    public function get(Request $request)
    {
    	if ($this->type == 'client') {
			return ok([
					Auth::user()->client()->get()->first()
				]);
    	} elseif ($this->type == 'driver') {
			return ok([
					Auth::user()->driver()->get()->first()
				]);
    	} else {
            return fail([
                    'title'  => 'Undefined type.',
                    'detail' => 'You are using undefined type, please contact your adminstrator.'
                ], 400);
    	}
    }

    /**
     * Update profile data.
     * 
     * @return [type] [description]
     */
    public function update()
    {

    }
}
