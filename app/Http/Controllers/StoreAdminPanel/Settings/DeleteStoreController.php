<?php

namespace App\Http\Controllers\StoreAdminPanel\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\{User,Product,_Request,Order};
use Illuminate\Support\Facades\DB;
use Exception;

class DeleteStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function destroy()
    {
        // he can not delets store untill he do all dubt to shipping company and also delete all his products 
        
        $user = auth()->user();

        $userId = $user->id;

        $storeId = DB::table('store_user')->where('user_id', $userId)->select('store_id')->pluck();


        $storeUsers = DB::table('store_user')->where('store_id', $storeId)->get();

        $store = Store::find($storeId);

        // .. If One Query Fails , Then All Queries Should Fail ..
        DB::beginTransaction();

        try {
            // 1 .. Change Role Of All Belonged To This Store of Assistants and Owner .. 
            $changeUserRole = User::whereIn('id', $storeUsers)->update([
                'role'=> 0 ,
            ]);

            // 2 .. Delete All Records Of Pivot ..
            $deletePivotRecords = DB::table('store_user')->where('store_id', $storeId)->delete();

            // 3 .. Delete Images of Store ..
            {
                $storeImages = $store->photos()->where('photoable_id', $storeId)->get();

                foreach ($storeImages as $image) {
                    Storage::delete('images/Store-Images/' . $image->filename);
                }
            }

            // 4 .. Delete all Products and images of Products
            {
                $selectAllProducts = Product::where('store_id', $storeId)->select('id')->pluck();
                // .. Select all Images Of all Belonged Products ..
                $productsImages = $store->photos()->whereIn('photoable_id', $selectAllProducts)
                ->where('photoable_type', Product::class)
                ->get();

                foreach ($productsImages as $image) {
                    Storage::delete('images/Product-Images/' . $image->filename);
                    $image->delete();
                }

                // .. Delete all Products of the Store ..
                Product::where('store_id', $storeId)->delete();
        
            }

            // 5 .. Delete all Requests To Be Assistant .. 
            {
                $requests = _Request::where('store_id', $storeId)->delete();
            }

            // 6 .. Delete all Orders That Had Requested .. 
            {
                $orders = Order::whereIn('product_id', $selectAllProducts)->delete();
            }

            DB::commit();

            return response()->json([
                'status' => 'Success',
                'message' => 'Store Deletion Was Successful!',
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => 'Failed',
                'message' => 'Error on deleting Store! Please try again.',
            ]);

        }

    }

}
