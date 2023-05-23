<?php

use App\Events\ProductBid\ProductBidEvent;
use App\Events\TimerFinishedEvent;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Category\SubCategoryController;
use App\Http\Controllers\Favorite\FavoriteController;
use App\services\User\GetUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::post('/signup',[AuthenticateController::class,'signup']);
    Route::post('/login',[AuthenticateController::class,'login']);


    Broadcast::routes();

    Route::group(['middleware'=> ['auth:api']],function()
    {

        Route::prefix('home')->group(function ()
        {

            Route::get('/likes',[ProductController::class,'home_likes']);

            Route::get('/views',[ProductController::class,'home_views']);

            Route::get('/categories',[CategoryController::class,'index']);

            Route::get('/search/{name}',[ProductController::class,'search']);

        });

        Route::prefix('favorite')->group(function ()
        {

            Route::get('/get',[FavoriteController::class,'index']);

            Route::get('/add/{product_id}',[FavoriteController::class,'store']);

            Route::get('/delete/{product_id}',[FavoriteController::class,'destroy']);

        });

        Route::prefix('product')->group(function ()
        {

            Route::get('/{sub_category_id}',[ProductController::class,'index']);

            Route::get('/show/{product_id}',[ProductController::class,'show_product']);

            Route::get('/like/{product_id}',[ProductController::class,'like_product']);

            Route::get('/view/{product_id}',[ProductController::class,'view_product']);

            Route::get('/buyers/{product_id}',[ProductController::class,'buyers']);

            Route::post('/create/{sub_category_id}',[ProductController::class,'create']);

        });

        Route::get('/sub_categories/{category_id}',[SubCategoryController::class,'index']);

        Route::post('/logout',[AuthenticateController::class,'logout']);


    });
    Route::get('/test',function()
    {

        // event(new ProductBidEvent(2,2,3500));
        event(new TimerFinishedEvent(2));
    });
