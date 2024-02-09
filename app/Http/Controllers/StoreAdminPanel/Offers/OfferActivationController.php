<?php

namespace App\Http\Controllers\StoreAdminPanel\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Offer;

class OfferActivationController extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Admin::class);
    }

    public function disOrActiveOffer(Request $request)
    {
        $validatedData = $request->validate([
            'offer_id' => 'required|exists:offers,id',
            'activation' => 'required|integer|in:0,1',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $disactiveOffer = Offer::find($request->offer_id);

        $activation = $request->activation;

        if ($disactiveOffer) {
            $disactiveOffer->update([
                'status'=> $request->activation,
            ]);
            return response()->json(['status'=>'Success', 'message'=>'Offer Disactivied Successfully']);
            
        }else{
            return response()->json(['status'=>'Fails', 'message'=>'Failed To Disactive Offer , Try Again Later']);
        }

    }
}
