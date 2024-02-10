<?php

namespace App\Http\Controllers\StoreAdminPanel\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\{User, Offer};
use App\Http\Middleware\Is_Store_Admin;

class DeleteOfferController extends Controller
{

    public function __construct(Is_Store_Admin $middleware)
    {
        $this->middleware($middleware);
    }


    public function deleteOffer(Request $request)
    {
        $validatedData = $request->validate([
            'offer_id' => 'required|exists:offers,id',
        ]);
        
        $user = auth()->user();
        $userId = User::find($user->id);
        $store_Id = DB::table('store_user')
            ->where('user_id', $user->id)
            ->select('store_id')
            ->first();
        $storeId = $store_Id->store_id;


        $deletedOffer = Offer::find($request->offer_id);
        $deletion = $deletedOffer->delete();

        if($deletion){
            return response()->json([
                'status'=>'Success', 
                'message'=>'Deletion Done .'
            ]);
        }else{
            return response()->json([
                'status'=>'Fails', 
                'message'=>'Failed To Delete Offer , Try Again Later'
            ]);
        }
    }
}
