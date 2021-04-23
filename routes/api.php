<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ImageController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::Resource('pages', 'App\Http\Controllers\AdminController');
Route::resource('pages', App\Http\Controllers\AdminController::class); 
// Route::resource('rooms', App\Http\Controllers\RoomController::class); 
Route::post('/upload', [App\Http\Controllers\ImageController::class, 'upload'])->name('upload');
Route::apiResource("/products",ProductController::class);
Route::apiResource("/orders",OrderController::class);
Route::post('/register', [App\Http\Controllers\RegisterController::class,'register']);
Route::apiResource('/rooms', App\Http\Controllers\RoomController::class);
Route::post('upload', [App\Http\Controllers\ImageController::class,'upload']);

Route::post('/login', [App\Http\Controllers\LoginController::class,'login']);
Route::post('/logout', [App\Http\Controllers\LoginController::class,'logout']);
