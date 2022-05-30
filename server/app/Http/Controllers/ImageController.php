<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function index(){
        $images = Image::with([])->get();
        return $images;
    }

    public function save(Request $req) : JsonResponse {
        DB::beginTransaction();
        try{
            $image = Image::firstOrCreate($req->all());
            DB::commit();
            return response()->json($image, 200);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json("saving images failed: " . $e->getMessage(), 420);
        }
    }

    public function update(Request $req, int $id) : JsonResponse {
        DB::beginTransaction();
        try{
            $image = Image::with([])->where('id', $id)->first();
            if($image != null){
                $image->update($req->all());
            }
            DB::commit();
            return response()->json($image, 200);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json("updating images failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(int $id): JsonResponse {
        $image = Image::where('id', $id)->first();
        if($image != null){
            $image->delete();
        }
        else {
            throw new \Exception("image could not be deleted - it does not exist");
        }
        return response()->json('image(' . $id .') successfully deleted', 200);
    }

}
