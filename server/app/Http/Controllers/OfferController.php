<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function index(){
        $offers = Offer::with(['course', 'image', 'level.image', 'user.image'])->get();
        return $offers;
    }

    public function getById(int $id){
        $offer = Offer::where('id', $id)->with(['course', 'image', 'level.image', 'user.image'])->first();
        return $offer != null ? response()->json($offer, 200): response()->json(null, 200);
    }

    public function save(Request $req) : JsonResponse {
        $req = $this->parseRequest($req);
        DB::beginTransaction();
        try {
            $offer = new Offer();
            $offer->title = $req['title'];
            $offer->description = $req['description'];
            $offer->date = $req['date'];
            $offer->startTime = $req['startTime'];
            $offer->endTime = $req['endTime'];
            $offer->user_id = $req['user_id'];
            $offer->course_id = $req['course_id'];
            $offer->level_id = $req['level_id'];

            // save image
            if (isset($req['image']) && $req['image']['url'] != '') {
                $image = Image::firstOrCreate(['url' => $req['image']['url']]);
                $offer->image()->associate($image['id']);
            }
            else {
                //placeholder
                $image = Image::all()->find(1);
                $offer->image()->associate($image);
            }

            $offer->save();
            DB::commit();
            return response()->json($offer, 200);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving offer failed: " . $e->getMessage(), 420);
        }
    }

    public function update(Request $req, int $id) : JsonResponse {
        DB::beginTransaction();
        try {
            $offer = Offer::with(['course', 'image', 'level', 'user'])->where('id', $id)->first();
            if($offer != null) {
                $req = $this->parseRequest($req);

                $offer->update($req->all());

                // save image
                if (isset($req['image']) && $req['image']['url'] != '') {
                    $image = Image::firstOrCreate(['url' => $req['image']['url']]);
                    $offer->image()->associate($image['id']);
                } else {
                    //placeholder
                    $image = Image::all()->find(1);
                    $offer->image()->associate($image);
                }
                $offer->save();
            }
            DB::commit();
            return response()->json($offer, 200);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("updating offer failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(int $id): JsonResponse {
        $offer = Offer::where('id', $id)->first();
        if($offer != null){
            $offer->delete();
        }
        else {
            throw new \Exception("offer could not be deleted - it does not exist");
        }
        return response()->json('offer(' . $id .') successfully deleted', 200);
    }

    private function parseRequest(Request $req):Request {
        //get data and comvert it - ISO 8601, e.g., "2022-03-11T14:51:00.00Z"
        $req['date'] = new \DateTime($req->date);;
        $req['startTime'] = new \DateTime($req->startTime);;
        $req['endTime'] = new \DateTime($req->endTime);;
        return $req;
    }

}
