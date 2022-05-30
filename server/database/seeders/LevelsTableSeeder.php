<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* ----------------------- */

        $level1 = new Level();
        $level1->title = 'Easy';

        $level_image1 = \App\Models\Image::all()->find(2);
        $level1->image()->associate($level_image1);

        $level1->save();

        /* ----------------------- */

        $level2 = new Level();
        $level2->title = 'Medium';

        $level_image2 = \App\Models\Image::all()->find(3);
        $level2->image()->associate($level_image2);

        $level2->save();

        /* ----------------------- */

        $level3 = new Level();
        $level3->title = 'Hard';

        $level_image3 = \App\Models\Image::all()->find(4);
        $level3->image()->associate($level_image3);

        $level3->save();

        /* ----------------------- */
    }
}
