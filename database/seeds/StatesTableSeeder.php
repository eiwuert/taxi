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
            ['id' => 2, 'name' => 'آذربايجان غربي', 'active' => false],
            ['id' => 3, 'name' => 'اردبيل', 'active' => false],
            ['id' => 4, 'name' => 'اصفهان', 'active' => false],
            ['id' => 5, 'name' => 'البرز', 'active' => false],
            ['id' => 6, 'name' => 'ايلام', 'active' => false],
            ['id' => 7, 'name' => 'بوشهر', 'active' => false],
            ['id' => 8, 'name' => 'تهران', 'active' => true],
            ['id' => 9, 'name' => 'چهارمحال بختياري', 'active' => false],
            ['id' => 10, 'name' => 'خراسان جنوبي', 'active' => false],
            ['id' => 11, 'name' => 'خراسان رضوي', 'active' => false],
            ['id' => 12, 'name' => 'خراسان شمالي', 'active' => false],
            ['id' => 13, 'name' => 'خوزستان', 'active' => false],
            ['id' => 14, 'name' => 'زنجان', 'active' => false],
            ['id' => 15, 'name' => 'سمنان', 'active' => false],
            ['id' => 16, 'name' => 'سيستان و بلوچستان', 'active' => false],
            ['id' => 17, 'name' => 'فارس', 'active' => false],
            ['id' => 18, 'name' => 'قزوين', 'active' => false],
            ['id' => 19, 'name' => 'قم', 'active' => false],
            ['id' => 20, 'name' => 'كردستان', 'active' => false],
            ['id' => 21, 'name' => 'كرمان', 'active' => false],
            ['id' => 22, 'name' => 'كرمانشاه', 'active' => false],
            ['id' => 23, 'name' => 'كهكيلويه و بويراحمد', 'active' => false],
            ['id' => 24, 'name' => 'گلستان', 'active' => false],
            ['id' => 25, 'name' => 'گيلان', 'active' => false],
            ['id' => 26, 'name' => 'لرستان', 'active' => false],
            ['id' => 27, 'name' => 'مازندران', 'active' => false],
            ['id' => 28, 'name' => 'مركزي', 'active' => false],
            ['id' => 29, 'name' => 'هرمزگان', 'active' => false],
            ['id' => 30, 'name' => 'همدان', 'active' => false],
            ['id' => 31, 'name' => 'يزد', 'active' => false]

        ]);

    }
}
