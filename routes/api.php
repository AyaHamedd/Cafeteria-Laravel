<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ImageController;

 
 
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
// Route::Resource('pages', 'App\Http\Controllers\AdminController');
Route::resource('pages', App\Http\Controllers\AdminController::class); 
Route::resource('rooms', App\Http\Controllers\RoomController::class); 

Route::post('upload', [App\Http\Controllers\ImageController::class,'upload']);

 