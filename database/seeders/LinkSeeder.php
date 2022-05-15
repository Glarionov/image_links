<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Link;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            $link = new Link();

            $text = Str::random(30);

            $link->text = $text;
            $imageId = $i % 5 + 1;
            $link->image_id = $imageId;

            $year = 3000 + $i;
            $link->expires_at = "$year-01-01";
            $link->save();
        }
    }
}
