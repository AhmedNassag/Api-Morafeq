<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Api\SubsubcategoryController;
use App\Http\Controllers\Api\MarketController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\PhoneController;
use App\Http\Controllers\Api\ProductController;


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
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});



//User must be have token to be able to visit those routes
Route::group(['middleware' => 'JwtMiddleware'],function()
{

    //category api routes
    Route::get('/categories',[CategoryController::class,'index']);
    Route::get('/categories/{id}',[CategoryController::class,'show']);
    Route::post('/categories',[CategoryController::class,'store']);
    Route::post('/categories/{id}',[CategoryController::class,'update']);
    Route::post('/category/{id}',[CategoryController::class,'destroy']);

    //sub category api routes
    Route::get('/subcategories',[SubCategoryController::class,'index']);
    Route::get('/subcategories/{id}',[SubCategoryController::class,'show']);
    Route::post('/subcategories',[SubCategoryController::class,'store']);
    Route::post('/subcategories/{id}',[SubCategoryController::class,'update']);
    Route::post('/subcategory/{id}',[SubCategoryController::class,'destroy']);

    //sub sub category api routes
    Route::get('/subsubcategories',[SubsubCategoryController::class,'index']);
    Route::get('/subsubcategories/{id}',[SubsubCategoryController::class,'show']);
    Route::post('/subsubcategories',[SubsubCategoryController::class,'store']);
    Route::post('/subsubcategories/{id}',[SubsubCategoryController::class,'update']);
    Route::post('/subsubcategory/{id}',[SubsubCategoryController::class,'destroy']);

    //market api routes
    Route::get('/markets',[MarketController::class,'index']);
    Route::get('/markets/{id}',[MarketController::class,'show']);
    Route::post('/markets',[MarketController::class,'store']);
    Route::post('markets/{id}',[MarketController::class,'update']);
    Route::post('/market/{id}',[MarketController::class,'destroy']);

    //country api routes
    Route::get('/countries',[CountryController::class,'index']);
    Route::get('/countries/{id}',[CountryController::class,'show']);
    Route::post('/countries',[CountryController::class,'store']);
    Route::post('/countries/{id}',[CountryController::class,'update']);
    Route::post('/country/{id}',[CountryController::class,'destroy']);

    //region api routes
    Route::get('/regions',[RegionController::class,'index']);
    Route::get('/regions/{id}',[RegionController::class,'show']);
    Route::post('/regions',[RegionController::class,'store']);
    Route::post('/regions/{id}',[RegionController::class,'update']);
    Route::post('/region/{id}',[RegionController::class,'destroy']);

    //phone api routes
    Route::get('/phones',[PhoneController::class,'index']);
    Route::get('/phones/{id}',[PhoneController::class,'show']);
    Route::post('/phones',[PhoneController::class,'store']);
    Route::post('/phones/{id}',[PhoneController::class,'update']);
    Route::post('/phone/{id}',[PhoneController::class,'destroy']);

    //product api routes
    Route::get('/products',[ProductController::class,'index']);
    Route::get('/products/{id}',[ProductController::class,'show']);
    Route::post('/products',[ProductController::class,'store']);
    Route::post('/products/{id}',[ProductController::class,'update']);
    Route::post('/product/{id}',[ProductController::class,'destroy']);

});



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
