<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homepagecontrollers\mainhomecontroller;
use App\Http\Controllers\Admin\RecentController;


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

Route::get('/category' , [mainhomecontroller::class , 'getCategory']);
Route::get('/product/{id}' , [mainhomecontroller::class , 'getProduct']);

Route::get('/test' , function (){
    return "Authenticated";
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Admin
//{
Route::get('admin/Product/recent' , [RecentController::class ,'index']);
//}