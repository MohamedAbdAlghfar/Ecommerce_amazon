<?php

namespace App\Http\Controllers\StoreAdminPanel\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\{User, Offer, Photo, OfferProduct};
use App\Http\Middleware\Is_Store_Admin;

class AddOfferController extends Controller
{

    public function __construct(Is_Store_Admin $middleware)
    {
        $this->middleware($middleware);
    }


    public function addOffer(Request $request)
    {
        $user = auth()->user();
        $userId = User::find($user->id);
        $store_Id = DB::table('store_user')
            ->where('user_id', $user->id)
            ->select('store_id')
            ->first();
        $storeId = $store_Id->store_id;


        $validatedData = $request->validate([
            'price' => 'required|integer',
            'store_id' => 'required|integer',
            'product_id' => 'integer|required_without:no_pices',
            'custom' => 'required|integer|in:0,1',
            'name' => 'required|string',
            'about' => 'required|string',
            'offer_image' => 'required|image|size:300|mimes:jpg,bmp,png',
            'no_pices' => 'integer|required_without:product_id',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }
        
        if ($request->no_pices) {
            // Begin a transaction
            DB::beginTransaction();
        
            try {
                // .. Create Offer ..
                $offer = Offer::create([
                    'price'    => $request->price,
                    'store_id' => $storeId,
                    'name'     => $request->name,
                    'about'    => $request->about,
                    'custom'   => $request->custom,
                    'no_pices' => $request->no_pices,
                ]);
        
                // .. Create Image For The Offer ..
                {    
                    $image1 = $request->file('offer_image');
                    $imageName1 = uniqid() . '.' . $image1->extension();
                    $image1->move(storage_path('images/'), $imageName1);

                    if (!$image1->isValid()) { // this isValid() ensures that file uploaded successfully , it Provided by Laravel
                        throw new \Exception('Invalid image provided.');
                    }

                    Photo::create([
                        'photoable_id'   => $offer->id,
                        'ordering'       => 1,
                        'photoable_type' => Offer::class,
                        'filename'       => $imageName1,
                    ]);
                }

                // .. Save OfferProduct In Pivot ..
                $offerPivot = OfferProduct::create([
                        'store_id'   => $storeId,
                        'product_id' => $request->product_id,
                        'offer_id'   => $offer->id,
                    ]);
        
                // Check if the offer creation was successful
                if (!$offer) {
                    // If offer creation fails, throw an exception
                    throw new \Exception('Offer creation failed.');
                }

                // Check if the offer pivot creation was successful
                if (!$offerPivot) {
                    // If offer pivot creation fails, throw an exception
                    throw new \Exception('Offer pivot creation failed.');
                }
        
                // If everything is successful, commit the transaction
                DB::commit();
        
                return response()->json([
                    'status'  => 'Success',
                    'message' => 'Offer Added Successfully',
                ]);
        
            } catch (\Exception $e) {
                // If an exception occurs, rollback the transaction
                DB::rollBack();
        
                return response()->json([
                    'status'  => 'Error',
                    'message' => $e->getMessage(),
                ]);
            }
        }
        //..     Then If Offer Contains a Number Of One Product        ..
        elseif ($request->product_id) {
            // .. Begin a Transaction , If One Query False => Then All False ..
            DB::beginTransaction();

            try {
                $productId = $request->product_id;

                // .. Create Offer ..
                $offer = Offer::create([
                    'price'    => $request->price,
                    'store_id' => $storeId,
                    'name'     => $request->name,
                    'about'    => $request->about,
                    'custom'   => $request->custom,
                    'no_pices' => null,
                ]);

                // .. Create Image For The Offer ..
                {
                    $image1 = $request->file('offer_image');
                    $imageName1 = uniqid() . '.' . $image1->extension();
                    $image1->move(storage_path('images/'), $imageName1);
                    Photo::create([
                        'photoable_id'   => $offer->id,
                        'ordering'       => 1,
                        'photoable_type' => Offer::class,
                        'filename'       => $imageName1,
                    ]);
                }

                // .. Save Records In Pivot For Every Product In This One Offer ..
                foreach ($productId as $product_id) {
                    $offerPivot = OfferProduct::create([
                            'store_id'   => $offer->store_id,
                            'product_id' => $product_id,
                            'offer_id'   => $offer->id,
                        ]);

                    // Check if the offer pivot creation was successful
                    if (!$offerPivot) {
                        // If offer pivot creation fails, throw an exception
                        throw new \Exception('Offer pivot creation failed.');
                    }
                }
                
                // Check if the offer creation was successful
                if (!$offer) {
                    // If offer creation fails, throw an exception
                    throw new \Exception('Offer creation failed.');
                }


                // If everything is successful, commit the transaction
                DB::commit();

                return response()->json([
                    'status'  => 'Success',
                    'message' => 'Offer Added Successfully',
                ]);

            } catch (\Exception $e) {
                // If an exception occurs, rollback the transaction
                DB::rollBack();

                return response()->json([
                    'status'  => 'Error',
                    'message' => $e->getMessage(),
                ]);
            }
        }
        else {
            return response()->json([
                'status'=> 'Fails',
            ]);
        }
    }
}
