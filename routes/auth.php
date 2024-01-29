<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers\{SignUpController,LoginController,LogoutController};

Route::post('logout', [LogoutController::class , 'logout']);
Route::post('login' , [LoginController::class , 'login'])->name('login');
Route::post('register', [SignUpController::class , 'signup']);