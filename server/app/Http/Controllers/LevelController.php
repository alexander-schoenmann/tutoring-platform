<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Level;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::with(['image'])->get();
        return $levels;
    }

    public function save(Request $req): JsonResponse
    {
        DB::beginTransaction();
        try {
            if (!$this->findByTitle($req['title'])) {
                if (isset($req['image']['url'])) {
                    $level = new Level();
                    $level->title = $req['title'];

                    // save image
                    $image = Image::firstOrCreate(['url' => $req['image']['url']]);
                    $level->image()->associate($image['id']);

                    $level->save();
                    DB::commit();
                    return response()->json($level, 200);
                }
                return response()->json("Image is needed!", 420);
            }
            return response()->json("Level already exists!", 409);

        } catch
        (\Exception $e) {
            DB::rollBack();
            return response()->json("saving levels failed: " . $e->getMessage(), 420);
        }
    }

    public function update(Request $req, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $level = Level::with(['image'])->where('id', $id)->first();
            if($level != null) {
                if (!$this->findByTitle($req['title']) || ($req['title'] == $level['title'])) {
                    $level->update($req->all());


                    // save image
                    if (isset($req['image']['url'])) {
                        $image = Image::firstOrCreate(['url' => $req['image']['url']]);
                        $level->image()->associate($image['id']);

                        $level->save();
                        DB::commit();
                        return response()->json($level, 200);
                    }

                    return response()->json("Image is needed!", 420);
                }
            }
            return response()->json("Level already exists!", 409);

        } catch
        (\Exception $e) {
            DB::rollBack();
            return response()->json("saving levels failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(int $id): JsonResponse {
        $level = Level::where('id', $id)->first();
        if($level != null){
            $level->delete();
        }
        else {
            throw new \Exception("level could not be deleted - it does not exist");
        }
        return response()->json('level(' . $id .') successfully deleted', 200);
    }

    public function findByTitle(string $title)
    {
        return Level::where('title', $title)->first();
    }


}
