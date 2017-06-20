<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' =>  \Hash::make(123456),
        'remember_token' => str_random(10),
        'phone' => $faker->unique()->e164PhoneNumber(),
        'role' => 'web',
        'verified' => true,
        'uuid' => Webpatser\Uuid\Uuid::generate(1)->string,
    ];
});

$factory->state(App\User::class, 'driver', function (Faker\Generator $faker) {
    return [
        'role' => 'driver',
    ];
});

$factory->state(App\User::class, 'client', function (Faker\Generator $faker) {
    return [
        'role' => 'client',
    ];
});

$factory->define(App\Driver::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->randomElement(['male', 'female', 'not specified']),
        'device_token' => $faker->unique()->sha256(),
        'device_type' => 'ios',
        'online' => true,
        'approve' => true,
        'available' => true,
        'address' => $faker->address,
        'state' => $faker->numberBetween(1,30),
        'country' => $faker->country,
        'zipcode' => $faker->postcode,
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->randomElement(['male', 'female', 'not specified']),
        'device_token' => $faker->unique()->sha256(),
        'device_type' => 'ios',
        'address' => $faker->address,
        'state' => $faker->numberBetween(1,30),
        'country' => $faker->country,
        'zipcode' => $faker->postcode,
    ];
});

$factory->define(App\Car::class, function (Faker\Generator $faker) {
    return [
        'color' => 'black',
        'number' => '00000',
        'type_id' => 1,
    ];
});

$factory->define(App\Location::class, function (Faker\Generator $faker) {
    $location = fakerLocation();

    // SET LOCATION NAME
    /*
    $name = \GoogleMaps::load('geocoding')
                      ->setParamByKey('latlng', $location['lat'] . ',' . $location['long'])
                      ->setParamByKey('mode', 'driving')
                      ->setParamByKey('language', 'FA')
                      ->setParamByKey('traffic_model', 'best_guess')
                      ->get('results.formatted_address');
    (isset($name['results'][0]['formatted_address'])) ? $name = $name['results'][0]['formatted_address'] : $name ='';
    */
   $name = 'NOT SET';
    return [
        'latitude'  => $location['lat'],
        'longitude' => $location['long'],
        'name'      => $name,
    ];
});

$factory->define(App\Zone::class, function (Faker\Generator $faker) {
    return [
        'name'      => 'default',
        'latitude'  => '0.0',
        'longitude' => '0.0',
        'radius'    => '0'
    ];
});

$factory->define(App\Zone::class, function (Faker\Generator $faker) {
    return [
        'name'      => 'default',
        'latitude'  => '0.0',
        'longitude' => '0.0',
        'radius'    => '0'
    ];
});

$factory->define(App\Currency::class, function (Faker\Generator $faker) {
    return [
        'name'      => 'default',
        'symbol'    => 'DEF',
    ];
});

$factory->define(App\Fare::class, function (Faker\Generator $faker) {
    $default = [
        'entry' => '14000',
        'discount' => '10',
        'min' => '36000',
        'surcharge' => [
            'from' => '00:00',
            'to'   => '06:00',
            'amount' => '20',
        ],
        'per_distance' => '0',
        'per_time' => '1400',
        'time_unit' => 'minute',
        'distance_unit' => 'kilometer',
    ];
    $fares = [];
    foreach(\App\CarType::get() as $type) {
        $fares[$type->name] = $default;
    }
    return [
        'zone_id'       => \App\Zone::whereName('default')->first()->id,
        'currency_id'   => \App\Currency::whereName('default')->first()->id,
        'cost'          => $fares,
    ];
});

/**
 * Generate random lat/long within tehran area.
 * @return array
 */
function fakerLocation()
{
    $r  = 10000 / 111300;
    $y0 = 35.719035;
    $x0 = 51.393068;
    $u  = (float)rand()/(float)getrandmax();
    $v  = (float)rand()/(float)getrandmax();
    $w  = $r * sqrt($u);
    $t  = 2  * pi() * $v;
    $x  = $w * cos($t);
    $y1 = $w * sin($t);
    $x1 = $x / cos($y0);
    return ['lat' => $y0 + $y1,
            'long' => $x0 + $x1];
}
