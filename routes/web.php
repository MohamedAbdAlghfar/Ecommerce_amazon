<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Rejestrationcontrallers\signupcontraller;
use App\Http\Controllers\homepagecontrollers\Get_category_type_controller;


Route::get('signup', function() { return view('loginform'); });
Route::post('signup' , [signupcontraller::class , 'store']);


Route::get('/home' , function (){ //here the route for filter produtcts 
    return view('home');
});




//<<<<<<< HEAD
Route::get('/fashion' , function (){ //here the route for filter produtcts 
    return view('fashion');
});

Route::get('/electronics' , function (){ //here the route for filter produtcts 
    return view('electronics');
});

Route::get('/computers' , function (){ //here the route for filter produtcts 
    return view('Computers');
});

// admin routes
//{

    Route::resource('admin', 'App\Http\Controllers\Admin\AdminController');
    Route::resource('admin/product', 'App\Http\Controllers\Admin\ProductController');
    Route::resource('admin/profile/admins', 'App\Http\Controllers\Admin\ProfileController');












 //}

















//=======
Route::controller(Get_category_type_controller::class)->group(function () {
    Route::get('/fashion', 'Fashion');
    Route::get('/home', 'Home');
    Route::get('/books', 'Books');
    Route::get('/Sports', 'Sport');
    Route::get('/pc', 'Pc');
    Route::get('/electronics', 'Electronics');
    Route::get('/Makeup', 'Makeup_Beauty');
    Route::get('/offers', 'Offers');
    Route::get('/mobile', 'Mobile');
    Route::get('/kitchen', 'Kitchen');
});
//>>>>>>> 6b226dde2fa9348aeca0f3f3d52cd44afe1a8084
