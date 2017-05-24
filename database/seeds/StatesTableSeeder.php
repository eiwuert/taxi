<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            ['id' => 1, 'name' => 'آذربايجان شرقي', 'active' => true],
            ['id' => 2, 'name' => 'آذربايجان غربي'],
            ['id' => 3, 'name' => 'اردبيل'],
            ['id' => 4, 'name' => 'اصفهان'],
            ['id' => 5, 'name' => 'البرز'],
            ['id' => 6, 'name' => 'ايلام'],
            ['id' => 7, 'name' => 'بوشهر'],
            ['id' => 8, 'name' => 'تهران', 'active' => true],
            ['id' => 9, 'name' => 'چهارمحال بختياري'],
            ['id' => 10, 'name' => 'خراسان جنوبي'],
            ['id' => 11, 'name' => 'خراسان رضوي'],
            ['id' => 12, 'name' => 'خراسان شمالي'],
            ['id' => 13, 'name' => 'خوزستان'],
            ['id' => 14, 'name' => 'زنجان'],
            ['id' => 15, 'name' => 'سمنان'],
            ['id' => 16, 'name' => 'سيستان و بلوچستان'],
            ['id' => 17, 'name' => 'فارس'],
            ['id' => 18, 'name' => 'قزوين'],
            ['id' => 19, 'name' => 'قم'],
            ['id' => 20, 'name' => 'كردستان'],
            ['id' => 21, 'name' => 'كرمان'],
            ['id' => 22, 'name' => 'كرمانشاه'],
            ['id' => 23, 'name' => 'كهكيلويه و بويراحمد'],
            ['id' => 24, 'name' => 'گلستان'],
            ['id' => 25, 'name' => 'گيلان'],
            ['id' => 26, 'name' => 'لرستان'],
            ['id' => 27, 'name' => 'مازندران'],
            ['id' => 28, 'name' => 'مركزي'],
            ['id' => 29, 'name' => 'هرمزگان'],
            ['id' => 30, 'name' => 'همدان'],
            ['id' => 31, 'name' => 'يزد']

        ]);

    }
}
