<?php

use Illuminate\Support\Facades\Route;
use app\Http\Contrallers\signupcontraller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/  // ....      

Route::get('/loginform' , function(){
    return view('loginform');
});

// Route::get('adduser' , 'adduser');
// Route::post('adduser' , signupcontraller::class , ['store']);

Route::get('/home' , function (){ //here the route for filter produtcts 
    return view('home');
});

Route::get('/mobilephones' , function (){ //here the route for filter produtcts 
    return view('mobilephones');
});

Route::get('/fashion' , function (){ //here the route for filter produtcts 
    return view('fashion');
});

Route::get('/electronics' , function (){ //here the route for filter produtcts 
    return view('electronics');
});

Route::get('/computers' , function (){ //here the route for filter produtcts 
    return view('Computers');
});