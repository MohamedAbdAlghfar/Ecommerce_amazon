<?php

namespace App\Http\Controllers\StoreAdminPanel\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\{User, Offer};
use App\Http\Middleware\Is_Store_Admin;

class DeleteOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Admin::class);
    }

    public function deleteOffer(Request $request)
    {
        $validatedData = $request->validate([
            'offer_id' => 'required|exists:offers,id',
        ]);
        
        $user = auth()->user();
        $userId = User::find($user->id);
        $storeId = $userId->store->id;

        $deletedOffer = Offer::find($request->offer_id);

        if($deletedOffer){
            $deletedOffer->delete();
            return response()->json(['status'=>'Success', 'message'=>'Deletion Done .']);

        }else{
            return response()->json(['status'=>'Fails', 'message'=>'Failed To Delete Offer , Try Again Later']);
        }
    }
}
