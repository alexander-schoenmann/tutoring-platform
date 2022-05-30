<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* ----------------------- */

        $student1 = new User();
        $student1->firstname = 'Markus';
        $student1->lastname = 'Huber';
        $student1->email = 'markus@huber.at';
        $student1->password = bcrypt('mhuber');
        $student1->phone = '0664/12312312';
        $student1->education = 'Informatics student';
        $student1->description = 'Hello, i am Markus and i am 22 years old';
        $student1->isStudent = true;

        $student1_img = \App\Models\Image::all()->find(5);
        $student1->image()->associate($student1_img);

        $student1->save();

        /* ----------------------- */

        $student2 = new User();
        $student2->firstname = 'Gregor';
        $student2->lastname = 'Maier';
        $student2->email = 'gregor@maier.at';
        $student2->password = bcrypt('gmaier');
        $student2->phone = '0660/12456533';
        $student2->isStudent = true;

        $student2_img = \App\Models\Image::all()->find(6);
        $student2->image()->associate($student2_img);

        $student2->save();

        /* ----------------------- */

        $lector1 = new User();
        $lector1->firstname = 'Herbert';
        $lector1->lastname = 'Bauer';
        $lector1->email = 'herbert@bauer.at';
        $lector1->password = bcrypt('hbauer');
        $lector1->phone = '0664/45645645';
        $lector1->education = 'Higher technical collage';
        $lector1->description = 'My name is Herbert and I am 34 years old. As a graduate of a higher technical college, I know a lot about technology and like to pass on my knowledge.';
        $lector1->isStudent = false;

        $lector1_img = \App\Models\Image::all()->find(7);
        $lector1->image()->associate($lector1_img);

        $lector1->save();

        /* ----------------------- */

        $lector2 = new User();
        $lector2->firstname = 'Simon';
        $lector2->lastname = 'Wagner';
        $lector2->email = 'simon@wagner.at';
        $lector2->password = bcrypt('swagner');
        $lector2->phone = '0676/12447603';
        $lector2->education = 'JKU Linz';
        $lector2->description = 'Hi, I\'m Simon and I live in Linz. I am a former student and I like to help others.';
        $lector2->isStudent = false;

        $lector2_img = \App\Models\Image::all()->find(8);
        $lector2->image()->associate($lector2_img);

        $lector2->save();

        /* ----------------------- */
    }
}
