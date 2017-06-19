<?php

use Illuminate\Contracts\Routing\ResponseFactory;

if (!function_exists('ok')) {
    /**
     * Return a new OK response from the application.
     *
     * @param  string $content
     * @param  int $status
     * @param  array $headers
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

if (!function_exists('fail')) {
    /**
     * Return a new fail response from the application.
     *
     * @param  string $content
     * @param  int $status
     * @param  array $headers
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

if (!function_exists('getDistanceMatrix')) {
    /**
     * Get distance matrix response.
     *
     * @param  array $location
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
                'detail' => 'unable to get distance and time from Google Matrix API'
            ], 422);
        }
    }
}

if (!function_exists('js_josn')) {
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

if (!function_exists('option')) {
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

if (!function_exists('nearby')) {
    /**
     * Find nearby
     * @param  numeric $lat
     * @param  numeric $long
     * @param  float $distance
     * @param  integer $limit
     * @return PDO
     */
    function nearby($lat, $long, $type = 'any', $distance = 1.0, $limit = 100, $exclude = 0)
    {
        $distance = option('distance', 1);
        $ids = \App\Zone::carTypeIds($lat, $long, $type);
        $type = "SELECT id 
                 FROM car_types
                 WHERE id in $ids OR car_type_id in $ids";

        $query = "SELECT id, distance, longitude, latitude, user_id AS user_id
        FROM (
        SELECT id, user_id, longitude, latitude, ( 6371 * acos( COS( RADIANS(CAST($lat AS double precision)) ) * 
                                                                COS( RADIANS( CAST(latitude  AS double precision) ) ) * 
                                                                COS( RADIANS( CAST(longitude AS double precision) ) - 
                                                                RADIANS(CAST($long AS double precision)) ) + 
                                                                SIN( RADIANS(CAST($lat AS double precision)) ) * 
                                                                SIN( RADIANS( CAST(latitude AS double precision) ) ) 
                                                            ) 
                                                ) AS distance
            FROM drivers
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
                        AND deleted_at IS NULL 
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

    if (!function_exists('convert')) {
        /**
         * Convert string numbers to Persian format.
         *
         * @param  string $string
         * @return string
         */
        function convert($string)
        {
            $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            $num = range(0, 9);
            $converted = str_replace($num, $persian, $string);
            return $converted;
        }
    }

    if (!function_exists('convert_back')) {
        /**
         * Convert back Persian format to English format.
         *
         * @param  string $string
         * @return string
         */
        function convert_back($string)
        {
            $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            $num = range(0, 9);
            $converted = str_replace($persian, $num, $string);
            return $converted;
        }
    }

    if (!function_exists('getTranslateFile')) {
        /**
         * return selected locale translate file.
         *
         * @param $locale
         * @param $lang
         * @return array
         * @internal param string $string
         */
        function getTranslateFile($locale, $lang)
        {

            if (file_exists(resource_path('lang/' . $locale . '/' . $lang)))
                return include(resource_path('lang/' . $locale . '/' . $lang));

            return [];

        }
    }

    if (!function_exists('translateMe')) {
        /**
         * Convert back selected locale translate.
         *
         * @param $locale
         * @param $file
         * @param $slug
         * @return string
         */
        function translateMe($locale, $file, $slug)
        {
            $file = $file.'.php';
            $translate = getTranslateFile($locale, $file);
            if (isset($translate [$slug]))
                return $translate [$slug];
            return null;
        }
    }

    if (!function_exists('array_to_str')) {
        /**
         * Convert array to string.
         *
         * @param $array
         * @return string
         */
        function array_to_str($array)
        {
            return '<?php
return ' . var_export($array, true) . ';';
        }
    }

    if (!function_exists('addLang')) {
        /**
         * Add Translate file to a specify lang.
         *
         * @param $locale [fa,en,..]
         * @param $lang lang name : car_type, state
         * @param param array $translate
         * @return bool
         */
        function addLang($locale , $lang, $translate)
        {
            $translate = array_to_str($translate);
            $path = resource_path('lang/' . $locale);
            $lang = $path . '/' . $lang . '.php';

            // make directory(lang) if not exist
            if (!is_dir($path))
                \File::makeDirectory($path);

            // create lang files [ fa , en , ...]
            $res = \File::put($lang, $translate);

            if ($res)
                return true;

            return false;
        }
    }

    if (!function_exists('addLangs')) {
        /**
         * Add all translate files to langs.
         *
         * @param $lang lang name : car_type, state
         * @param $translates array of translates
         * @return bool
         */
        function addLangs($lang, $translates)
        {
            foreach (config('app.locales') as $locale) {
                addLang($locale , $lang, $translates[$locale]);
            }
            return true;
        }
    }

    if (!function_exists('changeTranslateSlug')) {
        /**
         * Add all translate files to langs.
         *
         * @param $lang lang name : car_type, state
         * @param $translates array of translates
         * @return bool
         */
        function changeTranslateSlug($lang, $old_slug, $new_slug)
        {

            foreach (config('app.locales') as $locale) {
                $translate = getTranslateFile($locale, $lang . '.php');
                if(isset($translate[$old_slug])){
                    $translate[$new_slug] = $translate[$old_slug];
                    unset($translate[$old_slug]);
                    addLang($locale , $lang, $translate);
                }
            }
            return true;
        }
    }
}
