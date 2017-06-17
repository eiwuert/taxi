<?php

use Illuminate\Database\Seeder;

class SlugCarTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Auto fill slug from name and fill translate files
        $types = \App\CarType::all();
        $localTranslate = [];
        $translate = [];
        foreach ($types as $type) {
            $slug = $type->name;
            if(in_array($slug,$translate))
                $slug = $slug.'_'.str_random(5);
            $type->slug = $slug;
            $type->save();
            $localTranslate[$type->slug] = $type->name;
            $translate[$type->slug] = $slug;
        }

        // array to string
        $localTranslate = array_to_str($localTranslate);
        $translate = array_to_str($translate);

        foreach (config('app.locales') as $locale) {

            $path = resource_path('lang/' . $locale);
            $lang = $path . '/car_types.php';

            //create directory if not exist
            if (!is_dir($path))
                \File::makeDirectory($path);

            if (config('app.locale') == $locale) {
                \File::put($lang, $localTranslate);
            } else {
                \File::put($lang, $translate);
            }
        }
    }
}
