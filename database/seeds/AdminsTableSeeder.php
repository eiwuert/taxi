<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Artisan::call('make:admin', [
            'email' => 'admin@example.com', 
            'password' => '123456'
        ]);
    }
}
