<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $imageSeeder = new ImagesSeeder();
        $imageSeeder->run();

        # Uncomment code below to get example links

//        $linkSeeder = new LinkSeeder();
//        $linkSeeder->run();
    }
}
