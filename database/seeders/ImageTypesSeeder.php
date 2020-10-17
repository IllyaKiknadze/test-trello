<?php

namespace Database\Seeders;

use App\Models\ImageTypes;
use Faker\Provider\Image;
use Illuminate\Database\Seeder;

class ImageTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImageTypes::truncate();

        ImageTypes::create([
                'title'  => 'desktop',
                'width'  => '1280',
                'height' => '720',
            ]);
        ImageTypes::create([
                'title'  => 'mobile',
                'width'  => '640',
                'height' => '360'
        ]);
    }
}
