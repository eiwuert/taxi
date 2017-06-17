<?php

namespace App\Http\Controllers\V4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V2\NearbyRequest;
use App\Repositories\Trip\NearbyRepository as Find;

class TripController extends Controller
{
  /**
   * Show nearby taxi to client.
   * @param  \App\Http\Requests\NearbyRequest $point
   * @return json
   */
  public function nearby(NearbyRequest $point)
  {
        return ok(Find::nearbyWithCount($point), 200, [], false);
  }
}
