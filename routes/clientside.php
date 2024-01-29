<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers\{SignUpController,LoginController,LogoutController};
use App\Http\Controllers\ClientSide\UserAccount\{DelCartController,GetCartProducts,DeleteAccountController,
    EditPersonalDataController,CreateStoreController,GetPersonalDataController,GetUserOrders,GetUserStore};
use App\Http\Controllers\ClientSide\HomePage\{MainHomeController};
use App\Http\Controllers\ClientSide\ProductType\{CategoryProductsController};
use App\Http\Controllers\ClientSide\ProductDetails\{AddToCartController,GetSuggestedProducts,GetProductDetails};
use App\Http\Controllers\StorePanel\ProductWarning\WarningController;
use App\Http\Middleware\{Is_Owner,Is_Owner_Assistant,Is_Store_Admin,Is_Store_Owner,Is_User};

Route::middleware('auth:api')->group(function () {

    Route::get('/dashboard', 'StorePanelController@dashboard');
    Route::get('/orders', 'StorePanelController@orders');

    Route::prefix('/products')->group(function () {

    });
});

Route::get('/settings', 'StorePanelController@settings');
Route::post('/notifications', 'StorePanelController@notifications');
