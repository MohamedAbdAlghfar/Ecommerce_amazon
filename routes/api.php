<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\homepagecontrollers\mainhomecontroller;
=======
use App\Http\Controllers\Admin\RecentController;


>>>>>>> f7a9a10e887551562d5c45ebeeaf7dc4f6020819
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

Route::get('/product/{id}' , [mainhomecontroller::class , 'getdata']);

Route::get('/test' , function (){
    return "Authenticated";
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('admin/Product/recent' , [RecentController::class ,'index']);
