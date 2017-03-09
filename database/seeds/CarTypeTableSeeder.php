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
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name'       => 'van',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name'       => 'sport',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name'       => 'sedans',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name'       => 'economy',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name'       => 'off-roader',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ], [
                    'name'       => 'motorcycle',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]);
    }
}
