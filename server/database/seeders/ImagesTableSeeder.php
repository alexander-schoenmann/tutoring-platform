<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Placeholder
        $imagePlaceholder = new Image();
        $imagePlaceholder->url = 'https://fm-bueromoebel-oesterreich.at/wp-content/uploads/2021/09/placeholder-19.png';
        $imagePlaceholder->save();

        //Level Easy
        $imageEasy = new Image();
        $imageEasy->url = 'http://www.s1910456030.student.kwmhgb.at/teaching22/images/level_easy.png';
        $imageEasy->save();

        //Level Medium
        $imageMedium = new Image();
        $imageMedium->url = 'http://www.s1910456030.student.kwmhgb.at/teaching22/images/level_medium.png';
        $imageMedium->save();

        //Level Hard
        $imageHard = new Image();
        $imageHard->url = 'http://www.s1910456030.student.kwmhgb.at/teaching22/images/level_hard.png';
        $imageHard->save();

        //Student 1
        $imageUser1 = new Image();
        $imageUser1->url = 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1148&q=80';
        $imageUser1->save();

        //Student 2
        $imageUser2 = new Image();
        $imageUser2->url = 'https://images.unsplash.com/photo-1511551203524-9a24350a5771?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80';
        $imageUser2->save();

        //Lector 1
        $imageUser3 = new Image();
        $imageUser3->url = 'https://images.unsplash.com/photo-1524854859347-bd2f42367134?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80';
        $imageUser3->save();

        //Lector 2
        $imageUser4 = new Image();
        $imageUser4->url = 'https://images.unsplash.com/photo-1529284607059-de6f2f0e661f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80';
        $imageUser4->save();

        //Offer 1
        $imageOffer1 = new Image();
        $imageOffer1->url = 'https://images-na.ssl-images-amazon.com/images/I/61HegiQwG0L.jpg';
        $imageOffer1->save();

        //Offer 2
        $imageOffer2 = new Image();
        $imageOffer2->url = 'https://images-na.ssl-images-amazon.com/images/I/61rrszUiwUL.jpg';
        $imageOffer2->save();

        //Offer 3
        $imageOffer3 = new Image();
        $imageOffer3->url = 'https://images-na.ssl-images-amazon.com/images/I/617wTKyT9DL.jpg';
        $imageOffer3->save();

        //Offer 4
        $imageOffer4 = new Image();
        $imageOffer4->url = 'https://i.weltbild.de/p/mathe-ganz-leicht-249550620.jpg?v=11&wp=_max';
        $imageOffer4->save();

    }
}
