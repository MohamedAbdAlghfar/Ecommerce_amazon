<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{RecentController,ProfileController,ProductController,MyprofileController,AdminController,CategoryController,Del_StoreController,RequestController,CategoryDelByController,ProductDelByController,StoreDelByController,ProductRunOutController,ShowProductPhotosController};
use App\Http\Controllers\Owner\{OwnerController,CreateAdminController,DeleteAdminController,CreateOwnerController};
use App\Http\Controllers\Shipping\{ShippingController,DeleteShippingController,updateOrderStatusController,CreateShippingController,StoresShippingDebtController,delStoresShippingDebtController};
// ..
use App\Http\Controllers\AuthControllers\{SignUpController,LoginController,LogoutController};
use App\Http\Controllers\ClientSide\UserAccount\{DelCartController,GetCartProducts,DeleteAccountController,
    EditPersonalDataController,CreateStoreController,GetPersonalDataController,GetUserOrders,GetUserStore};
use App\Http\Controllers\ClientSide\HomePage\{MainHomeController};
use App\Http\Controllers\ClientSide\ProductType\{CategoryProductsController};
use App\Http\Controllers\ClientSide\ProductDetails_Payment\{AddToCartController,GetSuggestedProducts,GetProductDetails};
use App\Http\Controllers\Store\{EditStoreController};
use App\Http\Middleware\{Is_Owner,Is_Owner_Assistant,Is_Store_Admin,Is_Store_Owner,Is_User};

/*
|--------------------------------------------------------------------------
| API Routes   - Mohammed
|--------------------------------------------------------------------------
*/

Route::prefix('my-api')->group(function(){

    /////////////////////////Admin Part/////////////////////////////////////////
    Route::group(['middleware' => ['is-owner-assistant']],function () {
    // product
    Route::get('admin/product', [ProductController::class, 'create']);
    Route::post('admin/product', [ProductController::class, 'store']);
    Route::get('admin/product/{product}', [ProductController::class, 'edit']);
    Route::post('admin/product/{product}', [ProductController::class, 'update']);
    Route::get('admin/Product/show', [ProductController::class, 'show']);
    Route::delete('admin/product/{product}', [ProductController::class, 'destroy']);
    Route::get('admin/Product/request' , [RequestController::class ,'index']);
    Route::get('admin/Product/recent' , [RecentController::class ,'index']);
    Route::get('admin/product/delBy/{id}', [ProductDelByController::class,'showDeletedProduct']);
    Route::get('admin/products/RunOut', [ProductRunOutController::class,'showRunOut']);
    Route::get('admin/products/showPhotos/{id}', [ShowProductPhotosController::class,'showPhotos'])->name('ShowProductPhotos.showPhotos');
    Route::delete('admin/products/deletePhotos/{id}', [ShowProductPhotosController::class, 'destroy'])->name('ShowProductPhotos.destroy');
    Route::get('admin/products/editPhotos/{id}', [ShowProductPhotosController::class,'EditPhoto'])->name('ShowProductPhotos.EditPhoto');
    Route::post('admin/products/editPhotos/{id}', [ShowProductPhotosController::class,'updatePhoto'])->name('ShowProductPhotos.updatePhoto');
    Route::get('admin/products/createPhotos/{id}', [ShowProductPhotosController::class,'create'])->name('ShowProductPhotos.create');
    Route::post('admin/products/createPhotos/{id}', [ShowProductPhotosController::class,'store'])->name('ShowProductPhotos.store');
    // dashboard
    Route::get('admin' , [AdminController::class ,'index']);
    // profile
    Route::get('admin/profile/admins' , [ProfileController::class ,'index']);
    Route::get('admin/profile/myprofile', [MyprofileController::class, 'edit']);
    Route::post('admin/profile/myprofile', [MyprofileController::class, 'update']);
    // category
    Route::get('admin/category', [CategoryController::class, 'create']);
    Route::post('admin/category', [CategoryController::class, 'store']);
    Route::get('admin/category/show', [CategoryController::class, 'show']);
    Route::delete('admin/category/{category}', [CategoryController::class, 'destroy']);
    Route::post('admin/category/{category}', [CategoryController::class, 'update']);
    Route::get('admin/category/{category}', [CategoryController::class, 'edit']);
    Route::get('admin/category/delBy/{id}', [CategoryDelByController::class,'showDeletedCategory']);
    // store
    Route::delete('admin/store/{store}', [Del_StoreController::class, 'destroy']);
    Route::get('admin/store/show', [Del_StoreController::class, 'show']);
    Route::get('admin/store/delBy/{id}', [StoreDelByController::class,'showDeletedStore']);
    });
    /////////////////////////Owner Part/////////////////////////////////////////
    Route::group(['middleware' => ['is-owner']],function () {
    // dashboard
    Route::get('owner' , [OwnerController::class ,'index'])->name('owner.index');
    // admin
    Route::get('admin/create', [CreateAdminController::class, 'create']);
    Route::post('admin/create', [CreateAdminController::class, 'store'])->name('CreateAdmin.store');
    Route::get('owner/admin/show', [DeleteAdminController::class, 'index']);
    Route::delete('owner/delete-admin/{user}', [DeleteAdminController::class, 'destroy'])->name('DeleteAdmin.destroy');
    // owner
    Route::get('owner/create', [CreateOwnerController::class, 'create']);
    Route::post('owner/create', [CreateOwnerController::class, 'store'])->name('CreateOwner.store');
    });
/////////////////////////Shipping company Part/////////////////////////////////////////
    // dashboard
    Route::get('shippingCombany' , [ShippingController::class ,'index'])->name('owner.index');
    // shipping company
    Route::get('shippingCombany/show/{id}', [ShippingController::class, 'show'])->name('Shipping.show');
    Route::delete('shippingCombany/{shipping}', [DeleteShippingController::class, 'destroy'])->name('DeleteShipping.destroy');
    Route::get('shippingCombany/create', [CreateShippingController::class, 'create']);
    Route::post('shippingCombany/create', [CreateShippingController::class, 'store'])->name('CreateShipping.store');
    Route::get('shippingCombany/edit/{id}', [ShippingController::class, 'edit'])->name('Shipping.edit');
    Route::post('shippingCombany/edit/{id}', [ShippingController::class, 'update'])->name('Shipping.update');
    // order
    Route::post('shippingCombany/order/{id}', [updateOrderStatusController::class, 'change'])->name('UpdateStatus.change');
    // store
    Route::get('shippingCombany/getStoresShippingPrice/{id}', [StoresShippingDebtController::class, 'getShippingStores'])->name('Shipping.getShippingStores');
    Route::delete('shippingCombany/delStoresShippingDebt/{shipping_id}/{store_id}', [delStoresShippingDebtController::class, 'DelStoreDebt'])->name('delShippingStoresDebt.DelStoreDebt');

}); 


/*
|--------------------------------------------------------------------------
| API Routes   - Abdullah
|--------------------------------------------------------------------------
*/

Route::prefix('v-api')->group(function () { 
   
    Route::post('logout', [LogoutController::class , 'logout']);
    Route::post('login' , [LoginController::class , 'login'])->name('login');
    Route::post('register', [SignUpController::class , 'signup']);
    Route::get('/category' , [MainHomeController::class , 'getCategory']);
    Route::get('/product/{id}' , [MainHomeController::class , 'getProduct']);
    // 
    Route::get('/profile' , [UserProfileController::class , 'index']);
    Route::post('/profile' , [UserProfileController::class , 'store']);
    Route::get('/profile/{id}' , [UserProfileController::class , 'show']);
    Route::put('/profile/{id}' , [UserProfileController::class , 'update']);
    Route::delete('/profile/{id}' , [UserProfileController::class , 'delete']);
    // 
    Route::post('addcart/{productId}', [AddCartController::class, 'addToCart']);
    Route::post('delcart/{productId}', [DelCartController::class, 'deleteFromCart']);
    Route::post('cartproducts', [GetCartProducts::class, 'getAllProducts']);

    Route::group(['middleware' => ['is-owner-assistant']],function () {
        Route::get('/owner', function () {
            return 'owner page'->withoutMiddleware([Is_Owner_Assistant::class]);
        });
    }); 
});
