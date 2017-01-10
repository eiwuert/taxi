<?php

use Illuminate\Database\Seeder;

class TripsClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::Trip, 100)
            ->create()
            ->each(function ($t) {
                $t->driver()->save(factory(App\Driver::class)->make());
                for ($i = 0; $i <= 100; $i++)
                    $u->locations()->save(factory(App\Location::class)->make());
                $u->car()->save(factory(App\Car::class)->make());
            });
    }
}
