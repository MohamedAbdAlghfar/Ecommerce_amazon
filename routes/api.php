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

Route::prefix('v-api')->group(function () {
  
    Route::get('/category' , [MainHomeController::class , 'getCategory']);
    Route::get('/product/{id}' , [MainHomeController::class , 'getProduct']);
    // 
    Route::get('/profile' , [UserProfileController::class , 'index']);
    Route::post('/profile' , [UserProfileController::class , 'store']);
    Route::get('/profile/{id}' , [UserProfileController::class , 'show']);
    Route::put('/profile/{id}' , [UserProfileController::class , 'update']);
    Route::delete('/profile/{id}' , [UserProfileController::class , 'delete']);
    // 
    Route::group(['middleware' => ['is-user']], function () {

        Route::get('/profile', function () {
            return 'profile page';
        });
        Route::get('/profile/page', function () { //that to make example for disaple middleware for one route
        })->withoutMiddleware([Is_Owner::class]);
    });
});

Route::get('admin/Product/recent' , [RecentController::class ,'index']);
