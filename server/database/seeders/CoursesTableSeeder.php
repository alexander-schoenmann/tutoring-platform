<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course1 = new Course();
        $course1->title = 'Programming';
        $course1->save();

        $course2 = new Course();
        $course2->title = 'IT & Software';
        $course2->save();

        $course3 = new Course();
        $course3->title = 'Mathematics';
        $course3->save();
    }
}
