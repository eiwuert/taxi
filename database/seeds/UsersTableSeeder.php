<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create();

        factory(App\User::class, 200)
        	->states('driver')
        	->create()
            ->each(function ($u) {
                $u->driver()->save(factory(App\Driver::class)->make());
                $u->locations()->save(factory(App\Location::class)->make());
            });

        factory(App\User::class, 200)
            ->states('client')
            ->create()
            ->each(function ($u) {
                $u->client()->save(factory(App\Client::class)->make());
                $u->locations()->save(factory(App\Location::class)->make());
            });
    }
}
