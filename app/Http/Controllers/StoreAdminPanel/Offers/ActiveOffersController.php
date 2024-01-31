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

class ActiveOffersController extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Admin::class);
    }

    public function activeOffers()
    {
        $user = auth()->user();
        $userId = User::find($user->id);
        $storeId = $userId->store->id;

        // Select active offers for the specific store with eager loading of products
        $activeOffers = Offer::with('products')->where('store_id', $storeId)->where('status', 1)->get();

        $offersWithProducts = [];

        foreach ($activeOffers as $offer) 
        {
            $productResource = ProductResource::collection($offer->products);

            // Add images of each product to the product
            $extraData = [
                'photo_paths' => $offer->products->map(function ($product) {
                    return $product->photos->pluck('filename')->toArray();
                }),
            ];

            $extraOfferImage = [
                'offer_image' => $offer->photo->map(function ($offer_){
                    return $offer->photo->filename;
                }),
            ];

            $productResource->additional($extraData);

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
