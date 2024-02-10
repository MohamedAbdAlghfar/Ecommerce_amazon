<?php

namespace App\Http\Controllers\StoreAdminPanel\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\Is_Store_Admin;
use Illuminate\Support\Facades\DB;

class OfferSpecificCustomersController extends Controller
{
    // .. Make An Offer Just For Customers  ..

    public function __construct(Is_Store_Admin $middleware)
    {
        $this->middleware($middleware);
    }


    public function specifyCustomers(Request $request)
    {
        // no validatino coz it will be in AddOfferController in addOffer();   .. and all data in request the same in request of create offer

        $user = auth()->user();
        $userId = User::find($user->id);
        $store_Id = DB::table('store_user')
            ->where('user_id', $user->id)
            ->select('store_id')
            ->first();
        $storeId = $store_Id->store_id;

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
