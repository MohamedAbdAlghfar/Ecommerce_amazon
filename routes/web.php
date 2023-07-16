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









//<<<<<<< HEAD
Route::get('/fashion' , function (){ //here the route for filter produtcts 
    return view('fashion');
});
// .. Middleware Route Groups ..

Route::middleware([Is_Owner::class])->group(function () {
   // Route::get('/add-admin', [ProductController::class , 'store']);

    Route::get('/profile', function () {
        // .. Use That If You Didnt Want To Make Check For This Route .. 
    })->withoutMiddleware([Is_Owner::class]);
});

Route::middleware([Is_Owner_Assistant::class])->group(function () {
    Route::get('/anything', 'handle');
});

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

*/







// admin routes
//

    Route::resource('admin', 'App\Http\Controllers\Admin\AdminController');
    Route::resource('admin/product', 'App\Http\Controllers\Admin\ProductController');
    Route::resource('admin/profile/admins', 'App\Http\Controllers\Admin\ProfileController');



    Route::get('admin/profile/myprofile', ['as' => 'myprofile.edit', 'uses' => 'App\Http\Controllers\Admin\MyprofileController@edit']);
	
	Route::put('admin/profile/myprofile', ['as' => 'myprofile.update', 'uses' => 'App\Http\Controllers\Admin\MyprofileController@update']);







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

//

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
