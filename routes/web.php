<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Rejestrationcontrallers\signupcontraller;
use App\Http\Controllers\homepagecontrollers\Get_category_type_controller;
use App\Http\Controllers\homepagecontrollers\ProductController;
use App\Http\Middleware\Is_Owner;
use App\Http\Middleware\Is_Owner_Assistant;
use App\Http\Middleware\Is_Store_Admin;
use App\Http\Middleware\Is_Store_Owner;
use App\Http\Middleware\Is_User;


Route::get('signup', function() { return view('loginform'); });
Route::post('signup' , [signupcontraller::class , 'store']);


Route::get('/link' , function (){ //here the route for filter produtcts 
    return 'hello world';
});


Route::get('/topnav' , function(){
    return view('topnav');
});



// .. Home Page Routes ..
Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        // Matches The "/admin/users" URL
    });
});
// .. End Of Home Page Routes ..







// .. Middleware Route Groups ..

Route::middleware([Is_Owner::class])->group(function () {
   // Route::get('/add-admin', [ProductController::class , 'store']);

    Route::get('/profile', function () {
        // .. Use That If You Didnt Want To Make Check For This Route .. 
    })->withoutMiddleware([Is_Owner::class]);
});

// Route::middleware([Is_Owner_Assistant::class])->group(function () {
//     Route::get('/anything', 'handle');
// });

// Route::middleware([Is_Store_Admin::class])->group(function () {
//     Route::get('/anything', 'handle');
// });

// Route::middleware([Is_Store_Owner::class])->group(function () {
//     Route::get('/anything', 'handle');
// });

// Route::middleware([Is_User::class])->group(function () {
//     Route::get('/anything', 'handle');
// });

// .. End Of Authentication Routes









// admin routes
//

    Route::resource('admin', 'App\Http\Controllers\Admin\AdminController');
    Route::resource('admin/product', 'App\Http\Controllers\Admin\ProductController');

//
