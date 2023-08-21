<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\RejestrationContrallers\SignUpController;
use App\Http\Controllers\HomePageControllers\MainHomeController;
use App\Http\Middleware\{Is_Owner,Is_Owner_Assistant,Is_Store_Admin,Is_Store_Owner,Is_User};
 use App\Http\Controllers\Admin;
 use App\Http\Controllers\Owner;
// ..  ..

// Route::get('signup', function() { return view('loginform'); });
// Route::post('signup' , [signupcontraller::class , 'store']);


// Route::get('/query' , [MainHomeController::class , 'getdata']);


// Route::get('/nav', function(){
//     return view('topnav');
// });


//<<<<<<< HEAD
// Route::get('/fashion' , function (){ //here the route for filter produtcts 
//     return view('fashion');
// });
// .. Middleware Route Groups ..

// Route::middleware([Is_Owner::class])->group(function () {

//     Route::get('/profile', function () {
//     })->withoutMiddleware([Is_Owner::class]);
// });



// admin routes 
//

     Route::resource('admin', 'App\Http\Controllers\Admin\AdminController'); 
    
     Route::resource('admin/product', App\Http\Controllers\Admin\ProductController::class); 
     Route::get('admin/product/show', [App\Http\Controllers\Admin\ProductController::class, 'show']);
     Route::resource('admin/Product/recent', 'App\Http\Controllers\Admin\RecentController');
     Route::resource('admin/Product/request', 'App\Http\Controllers\Admin\RequestController');
     Route::get('admin/product/delBy/{id}', 'App\Http\Controllers\Admin\ProductDelByController@showDeletedProduct');

     Route::resource('admin/profile/admins', 'App\Http\Controllers\Admin\ProfileController');

     Route::get('admin/profile/myprofile', ['as' => 'myprofile.edit', 'uses' => 'App\Http\Controllers\Admin\MyprofileController@edit']);	
	 Route::put('admin/profile/myprofile', ['as' => 'myprofile.update', 'uses' => 'App\Http\Controllers\Admin\MyprofileController@update']);
     
      Route::resource('admin/category', 'App\Http\Controllers\Admin\CategoryController');
      Route::get('admin/category/show', [App\Http\Controllers\Admin\CategoryController::class, 'show']);
      Route::get('admin/category/delBy/{id}', 'App\Http\Controllers\Admin\CategoryDelByController@showDeletedCategory');

      Route::get('admin/store/show', [App\Http\Controllers\Admin\Del_StoreController::class, 'show']);
      Route::resource('admin/store', 'App\Http\Controllers\Admin\Del_StoreController');
      Route::get('admin/store/delBy/{id}', 'App\Http\Controllers\Admin\StoreDelByController@showDeletedStore');

// owner routes

Route::get('owner', 'App\Http\Controllers\Owner\OwnerController@index')->name('owner.index');
Route::get('admin/create', 'App\Http\Controllers\Owner\CreateAdminController@create');
Route::post('admin/create', 'App\Http\Controllers\Owner\CreateAdminController@store')->name('CreateAdmin.store');
Route::get('owner/admin/show', 'App\Http\Controllers\Owner\DeleteAdminController@index');
Route::delete('owner/delete-admin/{user}', 'App\Http\Controllers\Owner\DeleteAdminController@destroy')->name('DeleteAdmin.destroy');
Route::get('owner/create', 'App\Http\Controllers\Owner\CreateOwnerController@create');
Route::post('owner/create', 'App\Http\Controllers\Owner\CreateOwnerController@store')->name('CreateOwner.store');



 //}



//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
