<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\RejestrationContrallers\SignUpController;
use App\Http\Controllers\HomePageControllers\MainHomeController;
use App\Http\Middleware\{Is_Owner,Is_Owner_Assistant,Is_Store_Admin,Is_Store_Owner,Is_User};


// ..  ..

// Route::get('signup', function() { return view('loginform'); });
// Route::post('signup' , [signupcontraller::class , 'store']);


Route::get('/query' , [MainHomeController::class , 'getdata']);


Route::get('/nav', function(){
    return view('topnav');
});


//<<<<<<< HEAD
Route::get('/fashion' , function (){ //here the route for filter produtcts 
    return view('fashion');
});
// .. Middleware Route Groups ..

Route::middleware([Is_Owner::class])->group(function () {

    Route::get('/profile', function () {
    })->withoutMiddleware([Is_Owner::class]);
});



// admin routes
//

    Route::resource('admin', 'App\Http\Controllers\Admin\AdminController');
    Route::resource('admin/product', 'App\Http\Controllers\Admin\ProductController');
    Route::resource('admin/profile/admins', 'App\Http\Controllers\Admin\ProfileController');
    Route::resource('admin/Product/recent', 'App\Http\Controllers\Admin\RecentController');

    Route::get('admin/profile/myprofile', ['as' => 'myprofile.edit', 'uses' => 'App\Http\Controllers\Admin\MyprofileController@edit']);
	
	Route::put('admin/profile/myprofile', ['as' => 'myprofile.update', 'uses' => 'App\Http\Controllers\Admin\MyprofileController@update']);









 //}



//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
