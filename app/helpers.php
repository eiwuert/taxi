<?php

use Illuminate\Contracts\Routing\ResponseFactory;

if (! function_exists('ok')) {
    /**
     * Return a new OK response from the application.
     *
     * @param  string  $content
     * @param  int     $status
     * @param  array   $headers
     * @param  toArray $toArray
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    function ok($content = '', $status = 200, array $headers = [], $toArray = true)
    {
        $factory = app(ResponseFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        $content = [
            'success' => true,
            'data'    => ($toArray)?[$content]:$content
        ];

        // It should not be 200, that's because of some package named volly on 
        // android side that cannot handle responses otherthan 200! so wiered
        return $factory->json($content, 200, $headers);
    }
}

if (! function_exists('fail')) {
    /**
     * Return a new fail response from the application.
     *
     * @param  string  $content
     * @param  int     $status
     * @param  array   $headers
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    function fail($content = '', $status = 500, array $headers = [])
    {
        $factory = app(ResponseFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        $content['status'] = $status;
        $content = [
            'success' => false,
            'data'    => [$content]
        ];

        // It should not be 200, that's because of some package named volly on 
        // android side that cannot handle responses otherthan 200! so wiered
        return $factory->json($content, 200, $headers);
    }
}

if (! function_exists('setLocation')) {
    /**
     * Return a new location id that has been saved.
     *
     * @param  decimal  $lat
     * @param  decimal  $long
     * @param  string   $name
     * @return integer Location id
     */
    function setLocation($lat, $long, $name = '')
    {
        if ($name == '') {
            $name = \GoogleMaps::load('geocoding')
                              ->setParamByKey('latlng', $lat . ',' . $long)
                              ->setParamByKey('mode', 'driving')
                              ->setParamByKey('language', 'FA')
                              ->setParamByKey('traffic_model', 'best_guess')
                              ->get('results.formatted_address');
            (isset($name['results'][0]['formatted_address'])) ? $name = $name['results'][0]['formatted_address'] : '';
        }

        return \Auth::user()->locations()->create([
                    'latitude'  => $lat,
                    'longitude' => $long,
                    'name'      => $name,
                ]);

    }
}

if (! function_exists('getDistanceMatrix')) {
    /**
     * Get distance matrix response.
     *
     * @param  array  $location
     * @return json
     */
    function getDistanceMatrix($location)
    {
        $distance = \GoogleMaps::load('distancematrix')
                                ->setParamByKey('origins', $location['s_lat'] . ',' . $location['s_long'])
                                ->setParamByKey('destinations', $location['d_lat'] . ',' . $location['d_long'])                      
                                ->getResponseByKey('rows.elements');

        if (@isset($distance['rows'][0]['elements'][0])) {
            return $distance['rows'][0]['elements'][0];
        } else {
            fail([
                    'title' => 'unable to fetch location distance and time',
                    'detail'=> 'unable to get distance and time from Google Matrix API'
                ], 422);
        }
    }  
}

if (! function_exists('nearby')) {
    /**
     * Find nearby
     * @param  numeric  $lat
     * @param  numeric  $long
     * @param  float    $distance
     * @param  integer  $limit
     * @return PDO
     */
    function nearby($lat, $long, $distance = 1.0, $limit = 5)
    {
        $query = "SELECT id, distance, longitude, latitude, name, user_id AS user_id
        FROM (
        SELECT DISTINCT ON (user_id) user_id AS LU, id, longitude, latitude, name, user_id, ( 6371 * acos( COS( RADIANS(CAST($lat AS double precision)) ) * 
                                                                COS( RADIANS( CAST(latitude  AS double precision) ) ) * 
                                                                COS( RADIANS( CAST(longitude AS double precision) ) - 
                                                                RADIANS(CAST($long AS double precision)) ) + 
                                                                SIN( RADIANS(CAST($lat AS double precision)) ) * 
                                                                SIN( RADIANS( CAST(latitude AS double precision) ) ) 
                                                            ) 
                                                ) AS distance
            FROM locations
                WHERE user_id IN (
                    SELECT id 
                    FROM users
                    WHERE verified = true 
                    AND role = 'driver'
                    AND id IN (
                        SELECT user_id 
                        FROM drivers 
                        WHERE online = true
                        AND approve = true
                        AND available = true
                    )
                )
                ORDER BY user_id, id DESC
            ) AS loc 
            where distance < $distance
            ORDER BY distance ASC
            LIMIT $limit";

        return \DB::select(DB::raw($query));
    }
}
