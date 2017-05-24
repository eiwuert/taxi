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
            ['name' => 'آذربایجان شرقی', 'active' => true],
            ['name' => 'آذربایجان غربی', 'active' => false],
            ['name' => 'اردبیل', 'active' => false],
            ['name' => 'اصفهان', 'active' => false],
            ['name' => 'البرز', 'active' => false],
            ['name' => 'ایلام', 'active' => false],
            ['name' => 'بوشهر', 'active' => false],
            ['name' => 'تهران', 'active' => true],
            ['name' => 'چهارمحال بختیاری', 'active' => false],
            ['name' => 'خراسان جنوبی', 'active' => false],
            ['name' => 'خراسان رضوی', 'active' => false],
            ['name' => 'خراسان شمالی', 'active' => false],
            ['name' => 'خوزستان', 'active' => false],
            ['name' => 'زنجان', 'active' => false],
            ['name' => 'سمنان', 'active' => false],
            ['name' => 'سیستان و بلوچستان', 'active' => false],
            ['name' => 'فارس', 'active' => false],
            ['name' => 'قزوین', 'active' => false],
            ['name' => 'قم', 'active' => false],
            ['name' => 'کردستان', 'active' => false],
            ['name' => 'کرمان', 'active' => false],
            ['name' => 'کرمانشاه', 'active' => false],
            ['name' => 'کهکیلویه و بویراحمد', 'active' => false],
            ['name' => 'گلستان', 'active' => false],
            ['name' => 'گیلان', 'active' => false],
            ['name' => 'لرستان', 'active' => false],
            ['name' => 'مازندران', 'active' => false],
            ['name' => 'مرکزی', 'active' => false],
            ['name' => 'هرمزگان', 'active' => false],
            ['name' => 'همدان', 'active' => false],
            ['name' => 'یزد', 'active' => false]

        ]);

    }
}
