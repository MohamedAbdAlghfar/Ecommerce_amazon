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
use App\Http\Controllers\ClientSide\ProductDetails\{AddToCartController,GetSuggestedProducts,GetProductDetails};
use App\Http\Controllers\StoreAdminPanel\Activities\CanceledOrders;
use App\Http\Middleware\{Is_Owner,Is_Owner_Assistant,Is_Store_Admin,Is_Store_Owner,Is_User};
use App\Http\Controllers\ClientSide\OrderPayment\MakeOrderController;
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

// .. Auth Endpoints ..
Route::prefix('auth')->group(function () {
    Route::post('logout', [LogoutController::class , 'logout']);
    Route::post('login' , [LoginController::class , 'login'])->name('login');
    Route::post('register', [SignUpController::class , 'signup']);
});
Route::prefix('store-panel')->group(function () { 
    Route::prefix('activities')->group(function () {
        Route::post('/cancelled-orders', [CanceledOrders::class , 'cancelledOrders']);
        Route::post('/discounts', [NewDiscounts::class , 'newDiscountsActivity']);
        Route::post('/new-orders', [NewOrders::class , 'orderActivity']);
        Route::post('/updated-products', [NewUpdatedProducts::class , 'updatedProductsActivity']);
        Route::post('/added-products', [NewAddedProducts::class , 'productActivity']);
        Route::post('/deleted-products', [NewDeletedProducts::class , 'delProd_Activity']);
        Route::post('/questions', [QuestionsInProduct::class , 'newQuestionInProductActivity']);
        Route::post('/rate', [RateInProduct::class , 'rateProductActivity']);
        Route::post('/response-requests', [ResponseRequest::class , 'reqeustActivity']);
    });
    Route::prefix('assitant')->group(function () {
        Route::post('/add-assitant', [AddAssistantController::class , 'createAssistant']);
        Route::get('/ ', [AssistantGetAllController::class , 'getAssistants']);
        Route::post('/delete', [DeleteAssistantController::class , 'deleteAssistant']);
        Route::post('/disable-request', [DisableRequestController::class , 'disable']);
        Route::post('/send-request', [MakeRequestController::class , 'sendRequest']);
        Route::post('/show-requests', [RequestShowController::class , 'viewRequests']);
        Route::post('/select-user', [SelectUserToRequestController::class , 'getUsers']);
    });
    Route::prefix('category')->group(function () {
        Route::post('/search', [ShowAllCategoriesController::class , 'showAllCategories']);
    });
    Route::prefix('customers')->group(function () {
        Route::get('/customers', [CustomersDataControllr::class , 'showAllCustomers']);
        Route::get('/statistics', [CustomerStatisticsController::class , 'statistics']);
    });
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [GetMainDataController::class , 'mainData']);
        Route::get('/shipped-orders', [ShippingCompanyCont_::class , 'shippedOrders']);
        Route::get('/shipping-dubt', [ShippingCompanyCont_::class , 'shippingDubt']);
    });
    Route::prefix('offer')->group(function () {
        Route::post('/activated/{status?}', [GetOffersController::class, 'getOffers'])->where('status', 1);
        Route::post('/disabled/{status?}', [GetOffersController::class, 'getOffers'])->where('status', 0);
        Route::post('/add', [AddOfferController::class , 'addOffer']);
        Route::post('/delete', [DeleteOfferController::class , 'deleteOffer']);
        Route::post('/edit', [EditOfferController::class , 'editOffer']);
        Route::post('/activate/{activation?}', [OfferActivationController::class , 'disOrActiveOffer'])->where('activation', 1);
        Route::post('/disactivate/{activation?}', [OfferActivationController::class , 'disOrActiveOffer'])->where('activation', 1);
        Route::post('/specify-customers', [OfferSpecificCustomersController::class , 'specifyCustomers']);
    });    
    Route::prefix('order')->group(function () {
        Route::post('/cancel',[CancelOrderController::class, '']);
        Route::post('/show',[ShowOrdersController::class, 'getStoreOrders']);
    });
    Route::prefix('product')->group(function () {
        Route::post('/add', [AddProductController::class , 'addProduct']);
        Route::post('/', [AllStoreProductsShow::class , 'getProducts']);
        Route::post('/delete', [DeleteProductController::class , 'deleteProduct']);
        Route::post('/disable-discount', [DisableDiscountController::class , 'disableDiscount']);
        Route::post('/make-discount', [MakeDiscountController::class , 'makeDiscount']);
        Route::post('/questions', [QuestionsController::class , 'getQuestions']);
        Route::post('/rates', [RatingController::class , 'getRates']);
        Route::post('/reply', [ReplyToQuestionController::class , 'replyQuestions']);
        Route::post('/update', [UpdateProductController::class , 'editProduct']);
    });
    Route::prefix('warnings')->group(function () {
        Route::post('/add-pices', [EditAvailablePicesController::class , 'newPices']);
        Route::post('/', [WarningController::class , 'warning']);
    });
    Route::prefix('settings')->group(function () {
        Route::post('/delete', [DeleteStoreController::class , 'destroy']);
        Route::post('/sell', [SellStoreController::class , 'sellStore']);
        Route::get('/data', [SellStoreController::class , 'storeData']);
        Route::post('/update', [UpdateStoreController::class , 'update']);
        Route::get('/store-data', [UpdateStoreController::class , 'sendStoreData']);
    });    
});
Route::prefix('client-side')->group(function () { // .. Client Side EndPoints ..

    Route::prefix('home')->group(function () {
        Route::get('/categories',[MainHomeController::class ,'getCategory']);
        Route::get('/products',[MainHomeController::class ,'getProduct']);
        Route::get('/suggested-products',[SuggestedProductsController::class ,'suggestedProducts']);
    });
    Route::prefix('notificatinos')->group(function () {
        Route::get('/', 'UserController@index');
    });
    Route::prefix('orders')->group(function () {
        Route::get('/', 'UserController@index');
    });
    Route::prefix('product-details')->group(function () {
        Route::get('/', 'UserController@index');
    });
    Route::prefix('product-type')->group(function () {
        Route::get('/', 'UserController@index');
    });
    Route::prefix('account')->group(function () {
        Route::get('/', 'UserController@index');
    });

});
