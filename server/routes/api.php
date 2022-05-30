<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\OfferController;
use \App\Http\Controllers\RequestController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api', 'auth.jwt']], function(){

    //POST
    Route::post('offers', [OfferController::class, 'save']);
    Route::post('requests', [RequestController::class, 'save']);
    Route::post('courses', [CourseController::class, 'save']);
    Route::post('images', [ImageController::class, 'save']);
    Route::post('levels', [LevelController::class, 'save']);
    Route::post('users', [UserController::class, 'save']);
    Route::post('auth/logout', [AuthController::class, 'logout']);

    //PUT
    Route::put('offers/{id}', [OfferController::class, 'update']);
    Route::put('requests/{id}', [RequestController::class, 'update']);
    Route::put('courses/{id}', [CourseController::class, 'update']);
    Route::put('images/{id}', [ImageController::class, 'update']);
    Route::put('levels/{id}', [LevelController::class, 'update']);
    Route::put('users/{id}', [UserController::class, 'update']);

    //DELETE
    Route::delete('offers/{id}', [OfferController::class, 'delete']);
    Route::delete('requests/{id}', [RequestController::class, 'delete']);
    Route::delete('courses/{id}', [CourseController::class, 'delete']);
    Route::delete('images/{id}', [ImageController::class, 'delete']);
    Route::delete('levels/{id}', [LevelController::class, 'delete']);
    Route::delete('users/{id}', [UserController::class, 'delete']);

});

//GET
Route::get('offers', [OfferController::class, 'index']);
Route::get('offers/{id}', [OfferController::class, 'getById']);
Route::get('requests', [RequestController::class, 'index']);
Route::get('courses', [CourseController::class, 'index']);
Route::get('images', [ImageController::class, 'index']);
Route::get('levels', [LevelController::class, 'index']);
Route::get('users', [UserController::class, 'index']);

//POST
Route::post('auth/login', [AuthController::class, 'login']);





