<?php

namespace App\Http\Controllers\StoreAdminPanel\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\Is_Store_Admin;
use Illuminate\Support\Facades\DB;

class OfferSpecificCustomersController extends Controller
{
    // .. Make An Offer Just For Customers  ..

    public function __construct()
    {
        $this->middleware(Is_Store_Admin::class);
    }

    public function specifyCustomers(Request $request)
    {
        $user = auth()->user();
        $userId = User::find($user->id);
        $storeId = $userId->store->id;

        $store = StoreUser::find($storeId);
        $customersIds = [];
        $customersIds = StoreUser::where('store_id',$storeId)->where('user_role', 0)->pluck('user_id')->toArray();

        // Begin a transaction
        DB::beginTransaction();

        try {
            $addOfferController = new AddOfferController();
            $createOffer = $addOfferController->addOffer($request);

            foreach ($customersIds as $customerId) {
                $createOffersOnPivot = OfferUser::create([
                    'user_id' => $customerId,
                    'offer_id' => $createOffer->id,
                ]);

                // Check if the offer pivot creation was successful
                if (!$createOffersOnPivot) {
                    // If offer pivot creation fails, throw an exception
                    throw new \Exception('Offer pivot creation failed.');
                }
            }

            // If everything is successful, commit the transaction
            DB::commit();

            return response()->json([
                'status' => 'Success',
                'message' => 'Offer Added Successfully for specified customers.',
            ]);
        } catch (\Exception $e) {
            // If an exception occurs, rollback the transaction
            DB::rollBack();

            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage(),
            ]);
        }
    
    }

}
