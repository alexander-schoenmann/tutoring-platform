<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use App\Models\Request;

class RequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* ----------------------- */

        $request1 = new Request();
        $request1->description = 'I would like to start earlier!';
        $request1->date = new DateTime("2022-08-16");
        $request1->startTime = new DateTime(  "2022-01-01T08:30:00.000Z");
        $request1->endTime = new DateTime(  "2022-01-01T10:00:00.000Z");
        $request1->status = 'waiting';

        $request_offer1 = \App\Models\Offer::all()->find(1);
        $request1->offer()->associate($request_offer1);

        $request_user1 = \App\Models\User::all()->find(1);
        $request1->user()->associate($request_user1);

        $request1->save();

        /* ----------------------- */

        $request2 = new Request();
        $request2->description = 'I would like to attend this course.';
        $request2->date = new DateTime("2022-08-16");
        $request2->startTime = new DateTime(  "2022-01-01T09:00:00.000Z");
        $request2->endTime = new DateTime(  "2022-01-01T10:00:00.000Z");
        $request2->status = 'waiting';

        //$request->offer_id = 1;
        $request_offer2 = \App\Models\Offer::all()->find(1);
        $request2->offer()->associate($request_offer2);

        //$request->user_id = 1;
        $request_user2 = \App\Models\User::all()->find(2);
        $request2->user()->associate($request_user2);

        $request2->save();

        /* ----------------------- */

        $request3 = new Request();
        $request3->date = new DateTime("2022-07-29");
        $request3->startTime = new DateTime(  "2022-01-01T13:00:00.000Z");
        $request3->endTime = new DateTime(  "2022-01-01T16:00:00.000Z");
        $request3->status = 'waiting';

        $request_offer3 = \App\Models\Offer::all()->find(3);
        $request3->offer()->associate($request_offer3);

        $request_user3 = \App\Models\User::all()->find(1);
        $request3->user()->associate($request_user3);

        /* ----------------------- */

        $request4 = new Request();
        $request4->description = 'I would like to attend this course one day later.';
        $request4->date = new DateTime("2022-08-03");
        $request4->startTime = new DateTime(  "2022-01-01T11:00:00.000Z");
        $request4->endTime = new DateTime(  "2022-01-01T14:00:00.000Z");
        $request4->status = 'waiting';

        $request_offer4 = \App\Models\Offer::all()->find(4);
        $request4->offer()->associate($request_offer4);

        $request_user4 = \App\Models\User::all()->find(2);
        $request4->user()->associate($request_user4);

        /* ----------------------- */
    }
}
