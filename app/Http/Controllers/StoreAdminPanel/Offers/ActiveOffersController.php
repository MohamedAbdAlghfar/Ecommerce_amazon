<?php

namespace App\Http\Controllers\StoreAdminPanel\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\{Offer, User};
use App\Http\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\OfferResource;
use App\Http\Resources\ProductResource;
use App\Http\Middleware\Is_Store_Admin;

class GetOffersController extends Controller
{

    public function __construct(Is_Store_Admin $middleware)
    {
        $this->middleware($middleware);
    }

    public function getOffers(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:0,1',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $user = auth()->user();
        $userId = User::find($user->id);
        $store_Id = DB::table('store_user')
            ->where('user_id', $user->id)
            ->select('store_id')
            ->first();
        $storeId = $store_Id->store_id;

        // Select active offers for the specific store with eager loading of products
        $activeOffers = Offer::with('products')->where('store_id', $storeId)->where('status', $request->status)->get();

        $offersWithProducts = [];

        foreach ($activeOffers as $offer) 
        {
            $productResource = ProductResource::collection($offer->products);

            // Add images of each product to the product
            $extraOfferImage = [
                'offer_image' => $offer->photo->map(function ($offer_){
                    return $offer->photo->filename;
                }),
            ];

            $offerResource = new OfferResource($offer);
            $offerResource->additional($extraOfferImage);

            $offersWithProducts[] = [
                'new one' => 'new one',
                'offer'   => $offerResource,
                'products' => $productResource,
            ];
        }

        if (!$offersWithProducts) {
            return response()->json([
                'message' => 'No active offers found for the store.',
            ]);
        }

        return response()->json([
            'status' => 'Success',
            'offers' => $offersWithProducts,
        ]);
    }
}
