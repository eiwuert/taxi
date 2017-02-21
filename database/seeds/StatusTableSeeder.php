<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
        		[
                    'name'  => 'request_taxi',
                    'value' => 1,
                ], [
                    'name'  => 'client_found',
                    'value' => 2,
                ], [
                    'name'  => 'no_response',
                    'value' => 3,
                ], [
                    'name'  => 'reject_client_found',
                    'value' => 4,
                ], [
                    'name'  => 'no_driver',
                    'value' => 5,
                ], [
                    'name'  => 'trip_started',
                    'value' => 6,
                ], [
                    'name'  => 'driver_onway',
                    'value' => 7,
                ], [
                    'name'  => 'driver_reject_started_trip',
                    'value' => 8,
                ], [
                    'name'  => 'trip_ended',
                    'value' => 9,
                ], [
                    'name'  => 'cancel_request_taxi',
                    'value' => 10,
                ], [
                    'name'  => 'cancel_onway_driver',
                    'value' => 11,
                ], [
                    'name'  => 'driver_arrived',
                    'value' => 12,
                ], [
                    'name'  => 'client_canceled_arrived_driver',
                    'value' => 13,
                ], [
                    'name'  => 'driver_cancel_arrived_status',
                    'value' => 14,
                ], [
                    'name'  => 'driver_rated',
                    'value' => 15,
                ], [
                    'name'  => 'client_rated',
                    'value' => 16,
                ], [
                    'name'  => 'trip_is_over',
                    'value' => 17,
                ], [
                    'name'  => 'trip_is_over_by_admin',
                    'value' => 18,
                ]
            ]);
    }
}
