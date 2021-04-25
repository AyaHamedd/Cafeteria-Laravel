<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ImageController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
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
Route::post('upload', [App\Http\Controllers\ImageController::class,'upload']);
// Route::resource('rooms', App\Http\Controllers\RoomController::class); 
Route::post('/upload', [App\Http\Controllers\ImageController::class, 'upload'])->name('upload');
Route::apiResource("/products",ProductController::class);

Route::apiResource("/orders",OrderController::class);
Route::get("/orders/price/{order}", [OrderController::class,'orderPrice']);
Route::post("/orders/search-users", [OrderController::class,'searchOrderUsersByDate']);
Route::get("/orders/search-orders/{user_id}", [OrderController::class,'searchOrdersByDate']);
Route::get("/orders/{order_id}/products", [OrderController::class,'getOrderProducts']);

Route::apiResource("/users",UserController::class);
Route::get("/usernames",[UserController::class,'usernames']);
Route::get('/orders/latest_order/{id}', [OrderController::class,'latest_order']);
Route::get('/orders/user/{id}', [OrderController::class,'user_orders']);
Route::post('/register', [App\Http\Controllers\RegisterController::class,'register']);
Route::get('/users/{user}', [App\Http\Controllers\UserController::class,'userOrdersPrice']);
Route::get('/users', [App\Http\Controllers\UserController::class,'index']);
Route::apiResource('/rooms', App\Http\Controllers\RoomController::class);
Route::post('upload', [App\Http\Controllers\ImageController::class,'upload']);
Route::post('/login', [App\Http\Controllers\LoginController::class,'login']);
Route::post('/logout', [App\Http\Controllers\LoginController::class,'logout']);

Route::get('/authorize/{provider}/redirect', [App\Http\Controllers\SocialAuthController::class,'redirectToProvider'])->name('api.social.redirect');
Route::get('/authorize/{provider}/callback', [App\Http\Controllers\SocialAuthController::class,'handleProviderCallback'])->name('api.social.callback');
