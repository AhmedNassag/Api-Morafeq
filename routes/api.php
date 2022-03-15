<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ShopController;

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
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router)
{
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});



//User must be have token to be able to visit those routes
Route::group(['middleware' => 'JwtMiddleware'],function()
{
    Route::get('/shops',[ShopController::class,'index']);
    Route::get('/shops/{id}',[ShopController::class,'show']);
    Route::post('/shop',[ShopController::class,'store']);
    Route::post('/shop/{id}',[ShopController::class,'update']);
    Route::get('/shop/{id}',[ShopController::class,'destroy']);
});



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
