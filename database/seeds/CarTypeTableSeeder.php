<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CarTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('car_types')->insert([[
                    'name'       => 'luxury',
                    'slug'       => 'luxury',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name'       => 'van',
                    'slug'       => 'van',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name'       => 'sport',
                    'slug'       => 'sport',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name'       => 'sedans',
                    'slug'       => 'sedans',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name'       => 'economy',
                    'slug'       => 'economy',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name'       => 'off-roader',
                    'slug'       => 'off-roader',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name'       => 'motorcycle',
                    'slug'       => 'motorcycle',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]);
    }
}
