<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $image = new Image();
            $image->path = "private/images/$i.png";
            $image->name = "image_$i";
            $image->save();
        }
    }
}
