<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatusTableSeeder::class);
        $this->call(CarTypeTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(ZonesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(FaresTableSeeder::class);
    }
}
