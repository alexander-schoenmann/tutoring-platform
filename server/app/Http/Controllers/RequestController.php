<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function index(){
        $requests = Request::with(['offer.image', 'user.image'])->get();
        return $requests;
    }

    public function save(\Illuminate\Http\Request $req) : JsonResponse {
        $req = $this->parseRequest($req);
        DB::beginTransaction();
        try{
            $request = Request::create($req->all());
            DB::commit();
            return response()->json($request, 200);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json("saving requests failed: " . $e->getMessage(), 420);
        }
    }

    public function update(\Illuminate\Http\Request $req, int $id) : JsonResponse {
        DB::beginTransaction();
        try{
            $request = Request::with(['offer', 'user'])->where('id', $id)->first();
            if($request != null) {
                $req = $this->parseRequest($req);
                $request->update($req->all());
            }
            DB::commit();
            return response()->json($request, 200);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json("updating requests failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(int $id): JsonResponse {
        $request = Request::where('id', $id)->first();
        if($request != null){
            $request->delete();
        }
        else {
            throw new \Exception("request could not be deleted - it does not exist");
        }
        return response()->json('request(' . $id .') successfully deleted', 200);
    }

    private function parseRequest(\Illuminate\Http\Request $req): \Illuminate\Http\Request {
        //get data and comvert it - ISO 8601, e.g., "2022-03-11T14:51:00.00Z"
        $req['date'] = new \DateTime($req->date);;
        $req['startTime'] = new \DateTime($req->startTime);;
        $req['endTime'] = new \DateTime($req->endTime);;
        return $req;
    }

}
