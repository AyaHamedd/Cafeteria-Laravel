<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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
Route::apiResource("/products",ProductController::class);
Route::apiResource('/category', 'App\Http\Controllers\CategoyController');
Route::get('categoryLookup', [\App\Http\Controllers\CategoyController::class, 'lookUp']);
Route::apiResource("/orders",OrderController::class);
Route::post('/register', [App\Http\Controllers\RegisterController::class,'register']);
Route::apiResource('/rooms', App\Http\Controllers\RoomController::class);
Route::post('upload', [App\Http\Controllers\ImageController::class,'upload']);