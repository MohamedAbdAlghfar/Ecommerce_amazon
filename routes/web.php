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