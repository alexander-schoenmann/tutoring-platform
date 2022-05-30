<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $users = User::with(['image'])->get();
        return $users;
    }

    public function save(Request $req) : JsonResponse {
        DB::beginTransaction();
        try {
            if (!$this->findByPhoneNumber($req['phone']) && !$this->findByEMail($req['email'])) {
                $user = new User();
                $user->firstname = $req['firstname'];
                $user->lastname = $req['lastname'];

                $user->email = $req['email'];
                $user->password = bcrypt($req['password']);
                $user->phone = $req['phone'];
                $user->education = $req['education'];
                $user->description = $req['description'];
                $user->isStudent = $req['isStudent'];

                // save image
                if (isset($req['image']) && $req['image']['url'] != '') {
                    $image = Image::firstOrCreate(['url' => $req['image']['url']]);
                    $user->image()->associate($image['id']);
                } else {
                    //placeholder
                    $image = Image::all()->find(2);
                    $user->image()->associate($image);
                }

                $user->save();
                DB::commit();
                return response()->json($user, 200);
            }
            return response()->json("User already exists!", 409);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving user failed: " . $e->getMessage(), 420);
        }
    }

    public function update(Request $req, int $id) : JsonResponse {
        DB::beginTransaction();
        try {
            $user = User::with(['image'])->where('id', $id)->first();
            if($user != null) {

                if((!$this->findByPhoneNumber($req['phone']) || ($req['phone'] == $user['phone'])) && (!$this->findByEMail($req['email']) || $req['email'] == $user['email'])) {
                    $user->update($req->all());

                    // save image
                    if (isset($req['image'])) {
                        $image = Image::firstOrCreate(['url' => $req['image']['url']]);
                        $user->image()->associate($image['id']);
                    } else {
                        //placeholder
                        $image = Image::all()->find(2);
                        $user->image()->associate($image);
                    }
                    $user->save();
                }
                DB::commit();
                return response()->json($user, 200);
            }
            return response()->json("User already exists!", 409);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving user failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(int $id): JsonResponse {
        $user = User::where('id', $id)->first();
        if($user != null){
            $user->delete();
        }
        else {
            throw new \Exception("user could not be deleted - it does not exist");
        }
        return response()->json('user(' . $id .') successfully deleted', 200);
    }

    public function findByPhoneNumber(string $phone) {
        return User::where('phone', $phone)->first();
    }

    public function findByEMail(string $email) {
        return User::where('email', $email)->first();
    }

}
