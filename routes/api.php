<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{RecentController,ProfileController,ProductController,MyprofileController,AdminController,CategoryController,Del_StoreController,RequestController,CategoryDelByController,ProductDelByController,StoreDelByController,ProductRunOutController,ShowProductPhotosController};
use App\Http\Controllers\Owner\{OwnerController,CreateAdminController,DeleteAdminController,CreateOwnerController};
use App\Http\Controllers\Shipping\{ShippingController,DeleteShippingController,updateOrderStatusController,CreateShippingController,StoresShippingDebtController,delStoresShippingDebtController};
// ..
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
// 
// .. Auth Endpoints ..
Route::prefix('auth')->namespace('App\Http\Controllers\AuthControllers')->group(function () {
    // dd(SignUpController::class);
    Route::post('logout', 'LogoutController@logout');
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('register','SignUpController@signup');
});

Route::prefix('store-panel')->namespace('App\Http\Controllers\StoreAdminPanel\Activities')->group(function () { 
    Route::prefix('activities')->group(function () {
        Route::post('/cancelled-orders', 'CanceledOrders@cancelledOrders');
        Route::post('/discounts', 'NewDiscounts@newDiscountsActivity');
        Route::post('/new-orders', 'NewOrders@orderActivity');
        Route::post('/updated-products', 'NewUpdatedProducts@updatedProductsActivity');
        Route::post('/added-products', 'NewAddedProducts@productActivity');
        Route::post('/deleted-products', 'NewDeletedProducts@delProd_Activity');
        Route::post('/questions', 'QuestionsInProduct@newQuestionInProductActivity');
        Route::post('/rate', 'RateInProduct@rateProductActivity');
        Route::post('/response-requests', 'ResponseRequest@reqeustActivity');
    });
    Route::prefix('assitant')->namespace('App\Http\Controllers\StoreAdminPanel\Assistant')->group(function () {
        Route::post('/add-assistant', 'AddAssistantController@createAssistant');
        Route::get('/', 'AssistantGetAllController@getAssistants');
        Route::post('/delete', 'DeleteAssistantController@deleteAssistant');
        Route::post('/disable-request', 'DisableRequestController@disable');
        Route::post('/send-request', 'MakeRequestController@sendRequest');
        Route::post('/show-requests', 'RequestShowController@viewRequests');
        Route::post('/select-user', 'SelectUserToRequestController@getUsers');
    });
    Route::prefix('category')->namespace('App\Http\Controllers\StoreAdminPanel\Categories')->group(function () {
        Route::post('/search', 'ShowAllCategoriesController@showAllCategories');
    });
    Route::prefix('customers')->namespace('App\Http\Controllers\StoreAdminPanel\Customers')->group(function () {
        Route::get('/customers', 'CustomersDataController@showAllCustomers');
        Route::get('/statistics', 'CustomerStatisticsController@statistics');
    });
    Route::prefix('dashboard')->namespace('App\Http\Controllers\StoreAdminPanel\Dashboard')->group(function () {
        Route::get('/', 'GetMainDataController@mainData');
        Route::get('/shipped-orders', 'ShippingCompanyController@shippedOrders');
        Route::get('/shipping-dubt', 'ShippingCompanyController@shippingDubt');
    });
    Route::prefix('offer')->namespace('App\Http\Controllers\StoreAdminPanel\Offers')->group(function () {
        Route::post('/activated/{status?}', 'GetOffersController@getOffers')->where('status', 1);
        Route::post('/disabled/{status?}', 'GetOffersController@getOffers')->where('status', 0);
        Route::post('/add', 'AddOfferController@addOffer');
        Route::post('/delete', 'DeleteOfferController@deleteOffer');
        Route::post('/edit', 'EditOfferController@editOffer');
        Route::post('/activate/{activation?}', 'OfferActivationController@disOrActiveOffer')->where('activation', 1);
        Route::post('/disactivate/{activation?}', 'OfferActivationController@disOrActiveOffer')->where('activation', 1);
        Route::post('/specify-customers', 'OfferSpecificCustomersController@specifyCustomers');
    });    
    Route::prefix('order')->namespace('App\Http\Controllers\StoreAdminPanel\Order')->group(function () {
        Route::post('/cancel', 'CancelOrderController@cancel');
        Route::post('/show', 'ShowOrdersController@getStoreOrders');
    });
    Route::prefix('product')->namespace('App\Http\Controllers\StoreAdminPanel\Product')->group(function () {
        Route::post('/add', 'AddProductController@addProduct');
        Route::post('/', 'AllStoreProductsShow@getProducts');
        Route::post('/delete', 'DeleteProductController@deleteProduct');
        Route::post('/disable-discount', 'DisableDiscountController@disableDiscount');
        Route::post('/make-discount', 'MakeDiscountController@makeDiscount');
        Route::post('/questions', 'QuestionsController@getQuestions');
        Route::post('/rates', 'RatingController@getRates');
        Route::post('/reply', 'ReplyToQuestionController@replyQuestions');
        Route::post('/update', 'UpdateProductController@editProduct');
    });
    Route::prefix('warnings')->namespace('App\Http\Controllers\StoreAdminPanel\ProductWarning')->group(function () {
        Route::post('/add-pices', 'EditAvailablePicesController@newPices');
        Route::post('/', 'WarningController@warning');
    });
    Route::prefix('settings')->namespace('App\Http\Controllers\StoreAdminPanel\Settings')->group(function () {
        Route::post('/delete', 'DeleteStoreController@destroy');
        Route::post('/sell', 'SellStoreController@sellStore');
        Route::get('/data', 'SellStoreController@storeData');
        Route::post('/update', 'UpdateStoreController@update');
        Route::get('/store-data', 'UpdateStoreController@sendStoreData');
    });    
});
Route::prefix('client-side')->group(function () { // .. Client Side EndPoints ..

    Route::prefix('home')->namespace('App\Http\Controllers\ClientSide\HomePage')->group(function () {
        Route::get('/categories','MainHomeController@getCategory');
        Route::get('/products','MainHomeController@getProduct');
        Route::get('/suggested-products','SuggestedProductsController@suggestedProducts');
    });
    Route::prefix('notificatinos')->namespace('App\Http\Controllers\ClientSide\Notificatinos')->group(function () {
        Route::get('/', 'UserController@index');
    });
    Route::prefix('orders')->namespace('App\Http\Controllers\ClientSide\OrderPayment')->group(function () {
        Route::get('/', 'UserController@index');
    });
    Route::prefix('product-details')->namespace('App\Http\Controllers\ClientSide\ProductDetails')->group(function () {
        Route::get('/', 'UserController@index');
    });
    Route::prefix('product-type')->namespace('App\Http\Controllers\ClientSide\ProductType')->group(function () {
        Route::get('/', 'UserController@index');
    });
    Route::prefix('account')->namespace('App\Http\Controllers\ClientSide\UserAccount')->group(function () {
        Route::get('/', 'UserController@index');
    });

});
