<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RejestrationContrallers\{SignUpController,LoginController};
use App\Http\Controllers\HomePageControllers\{MainHomeController,UserProfileController};
use App\Http\Controllers\Admin\{RecentController,ProfileController,ProductController,MyprofileController,AdminController};
use App\Http\Middleware\{Is_Owner,Is_Owner_Assistant,Is_Store_Admin,Is_Store_Owner,Is_User};


/*
|--------------------------------------------------------------------------
| API Routes   - Mohammed
|--------------------------------------------------------------------------
*/

Route::prefix('my-api')->group(function(){

    Route::get('admin/Product/recent' , [RecentController::class ,'index']);

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


/*
|--------------------------------------------------------------------------
| API Routes   - Abdullah
|--------------------------------------------------------------------------
*/

Route::prefix('my-api')->group(function () {
  
    Route::get('/category' , [MainHomeController::class , 'getCategory']);
    Route::get('/product/{id}' , [MainHomeController::class , 'getProduct']);
    Route::get('' , [UserProfileController::class]);

    Route::middleware([Is_Owner::class])->group(function () {

        Route::get('/profile', function () {
        })->withoutMiddleware([Is_Owner::class]);
    });
});
