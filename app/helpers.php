<?php

use GoogleMaps;
use Illuminate\Contracts\Routing\ResponseFactory;

if (! function_exists('ok')) {
    /**
     * Return a new OK response from the application.
     *
     * @param  string  $content
     * @param  int     $status
     * @param  array   $headers
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    function ok($content = '', $status = 200, array $headers = [])
    {
        $factory = app(ResponseFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        $content = [
            'success' => true,
            'data'    => [$content]
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
            $name = GoogleMaps::load('geocoding')
                              ->setParamByKey('latlng', $lat . ',' . $long)
                              ->get('results.formatted_address');
            (isset($name['results'][0]['formatted_address'])) ? $name = $name['results'][0]['formatted_address'] : '';
        }

        return App\Location::create([
                    'latitude' => $lat,
                    'longitude' => $long,
                    'name'     => $name,
                ]);

    }
}
