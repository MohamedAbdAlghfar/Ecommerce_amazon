<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers\{SignUpController,LoginController,LogoutController};
use App\Http\Controllers\HomePageControllers\{MainHomeController,UserProfileController};
use App\Http\Controllers\Admin\{RecentController,ProfileController,ProductController,MyprofileController,AdminController,CategoryController};
use App\Http\Middleware\{Is_Owner,Is_Owner_Assistant,Is_Store_Admin,Is_Store_Owner,Is_User};


/*
|--------------------------------------------------------------------------
| API Routes   - Mohammed
|--------------------------------------------------------------------------
*/

Route::prefix('my-api')->group(function(){

    Route::get('admin/Product/recent' , [RecentController::class ,'index']);
    Route::get('admin' , [AdminController::class ,'index']);
    Route::get('admin/profile/admins' , [ProfileController::class ,'index']);
    Route::get('admin/profile/myprofile', [MyprofileController::class, 'edit']);
    Route::put('admin/profile/myprofile', [MyprofileController::class, 'update']);
    Route::get('admin/product', [ProductController::class, 'create']);
    Route::post('admin/product', [ProductController::class, 'store']);
    Route::get('admin/product/{product}', [ProductController::class, 'edit']);
    Route::put('admin/product/{product}', [ProductController::class, 'update']);
    Route::get('admin/product/show', [ProductController::class, 'show']);
    Route::delete('admin/product/{product}', [ProductController::class, 'destroy']);
    Route::get('admin/category', [CategoryController::class, 'create']);
    Route::post('admin/category', [CategoryController::class, 'store']);

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
   
    Route::post('logout', [LogoutController::class , 'logout']);
    Route::post('login' , [LoginController::class , 'login']);
    Route::post('register', [SignUpController::class , 'signup']);
    Route::get('/category' , [MainHomeController::class , 'getCategory']);
    Route::get('/product/{id}' , [MainHomeController::class , 'getProduct']);
    // 
    Route::get('/profile' , [UserProfileController::class , 'index']);
    Route::post('/profile' , [UserProfileController::class , 'store']);
    Route::get('/profile/{id}' , [UserProfileController::class , 'show']);
    Route::put('/profile/{id}' , [UserProfileController::class , 'update']);
    Route::delete('/profile/{id}' , [UserProfileController::class , 'delete']);
    // 
    // Route::group(['middleware' => ['is-owner']], function () {
    //     Route::get('/profile-page', function () { // .. that to make example for disaple middleware for one route ..
    //     })->withoutMiddleware([Is_Owner::class]);
    // });

    Route::group(['middleware' => ['is-owner-assistant']],function () {
        Route::get('/owner', function () {
            return 'owner page';
        });
    }); 
});
