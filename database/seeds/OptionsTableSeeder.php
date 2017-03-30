<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            ['name' => 'distance', 
            'value' => '1', 
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now()],
            ['name' => 'admin.perPage', 
            'value' => '15', 
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now()],
        ]);
    }
}
