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

        $response = [
            'success' => true,
            'data' => ($toArray) ? [$content] : $content,
        ];

        // It should not be 200, that's because of some package named volly on
        // android side that cannot handle responses otherthan 200! so wiered
        return $factory->json($response, 200, $headers);
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

        $response['code'] = $status;
        $response = [
            'success' => false,
            'data' => [$content],
        ];

        // It should not be 200, that's because of some package named volly on
        // android side that cannot handle responses otherthan 200! so wiered
        return $factory->json($response, 200, $headers);
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
        if (is_object($location)) {
            $location = $location->all();
        }
        // API V2
        if (isset($location['s_lng'])) {
            $location['s_long'] = $location['s_lng'];
            $location['d_long'] = $location['d_lng'];
        }
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

if (! function_exists('js_josn')) {
    /**
     * Convert the array data to js specific json data.
     * @param  array $data
     * @return String
     */
    function js_json($data)
    {
        return str_replace('"', '', json_encode($data));
    }
}

if (! function_exists('option')) {
    /**
     * Get the value by its name.
     * @param  String $name
     * @param  mix $default
     * @return String
     */
    function option($name, $default)
    {
        $name = config('app.name') . '_' . $name;
        if (Cache::has($name)) {
            return Cache::get($name, $default);
        } else {
            if ($option = App\Option::whereName($name)->first()) {
                Cache::forever($name, $option->value);
                return $option->value;
            } else {
                return $default;
            }
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
    function nearby($lat, $long, $type = 'any', $distance = 1.0, $limit = 5, $exclude = 0)
    {
        // TODO: remove this stupid number. :)
        $distance = option('distance', 1);
        if ($type == 'any') {
            $type = "SELECT id FROM car_types";
        } else {
            $type = "SELECT id 
                     FROM car_types
                     WHERE name = '$type'";
        }
        
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
                        AND id NOT IN ( $exclude )
                    ) 
                    AND id IN (
                        SELECT user_id
                        FROM cars 
                        WHERE type_id
                        IN ( $type )
                    )
                )
                ORDER BY user_id, id DESC
            ) AS loc 
            where distance < $distance
            ORDER BY distance ASC
            LIMIT $limit";

        return [
            'result' => \DB::select(DB::raw($query)),
            'exclude' => $exclude
            ];
    }

    if (! function_exists('convert')) {
        function convert($string)
        {
            $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            $num = range(0, 9);
            $converted = str_replace($num, $persian, $string);
            return $converted;
        }
    }
}
