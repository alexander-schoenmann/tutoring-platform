<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use App\Models\Offer;
use Illuminate\Support\Facades\Date;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* ----------------------- */

        $offer1 = new Offer();
        $offer1->title = 'Java for Beginners';
        $offer1->description = 'A beginners\' course on "Programming with Java". The course is suitable for everyone and no previous knowledge is required!';
        $offer1->date = new DateTime("2022-08-16");
        $offer1->startTime = new DateTime(  "2022-01-01T09:00:00.000Z");
        $offer1->endTime = new DateTime(  "2022-01-01T10:00:00.000Z");
        $offer1->status = 'available';

        $offer_user1 = \App\Models\User::all()->find(3);
        $offer1->user()->associate($offer_user1);

        $offer_course1 = \App\Models\Course::all()->find(1);
        $offer1->course()->associate($offer_course1);

        $offer_image1 = \App\Models\Image::all()->find(9);
        $offer1->image()->associate($offer_image1);

        $offer_level1 = \App\Models\Level::all()->find(1);
        $offer1->level()->associate($offer_level1);

        $offer1->save();

        /* ----------------------- */

        $offer2 = new Offer();
        $offer2->title = 'Linux Command Line';
        $offer2->description = 'Here you will learn everything about the command line of Linux. Previous knowledge of Linux Ubuntu is necessary.';
        $offer2->date = new DateTime("2022-08-14");
        $offer2->startTime = new DateTime("2022-01-01T19:00:00.000Z");
        $offer2->endTime = new DateTime(  "2022-01-01T22:00:00.000Z");
        $offer2->status = 'available';

        $offer_user2 = \App\Models\User::all()->find(3);
        $offer2->user()->associate($offer_user2);

        $offer_course2 = \App\Models\Course::all()->find(2);
        $offer2->course()->associate($offer_course2);

        $offer_image2 = \App\Models\Image::all()->find(11);
        $offer2->image()->associate($offer_image2);

        $offer_level2 = \App\Models\Level::all()->find(3);
        $offer2->level()->associate($offer_level2);

        $offer2->save();

        /* ----------------------- */

        $offer3 = new Offer();
        $offer3->title = 'Python Programming';
        $offer3->description = 'This course is about the programming language Python. You should already have some previous experience with a programming language.';
        $offer3->date = new DateTime("2022-07-29");
        $offer3->startTime = new DateTime(  "2022-01-01T13:00:00.000Z");
        $offer3->endTime = new DateTime(  "2022-01-01T16:00:00.000Z");
        $offer3->status = 'available';

        $offer_user3 = \App\Models\User::all()->find(4);
        $offer3->user()->associate($offer_user3);

        $offer_course3 = \App\Models\Course::all()->find(1);
        $offer3->course()->associate($offer_course3);

        $offer_image3 = \App\Models\Image::all()->find(10);
        $offer3->image()->associate($offer_image3);

        $offer_level3 = \App\Models\Level::all()->find(2);
        $offer3->level()->associate($offer_level3);

        $offer3->save();

        /* ----------------------- */

        $offer4 = new Offer();
        $offer4->title = 'Integral Calculations';
        $offer4->description = 'This course is about integral calculus. Previous knowledge of mathematics is necessary.';
        $offer4->date = new DateTime("2022-08-02");
        $offer4->startTime = new DateTime(  "2022-01-01T11:00:00.000Z");
        $offer4->endTime = new DateTime(  "2022-01-01T14:00:00.000Z");
        $offer4->status = 'available';

        $offer_user4 = \App\Models\User::all()->find(4);
        $offer4->user()->associate($offer_user4);

        $offer_course4 = \App\Models\Course::all()->find(3);
        $offer4->course()->associate($offer_course4);

        $offer_image4 = \App\Models\Image::all()->find(12);
        $offer4->image()->associate($offer_image4);

        $offer_level4 = \App\Models\Level::all()->find(2);
        $offer4->level()->associate($offer_level4);

        $offer4->save();

    }

}
