<?php

namespace App\Http\Controllers\StoreAdminPanel\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\_Request;
use App\Http\Middleware\Is_Store_Owner;

class MakeRequestController extends Controller
{
    public function __construct(Is_Store_Owner $middleware)
    {
        $this->middleware($middleware);
    }

    public function sendRequest(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }
        
        $user = auth()->user();

        if (!$user->role == 2) 
        {
            return response()->json([
                'message' =>'you are not allowed to visit this link !',
            ]);
        }

        $store_Id = DB::table('store_user')
        ->where('user_id', $user->id)
        ->select('store_id')
        ->first();
        $storeId = $store_Id->store_id;

        $findStore = Store::find($storeId);

        if ($findStore) {
            $storeName = $findStore->name;
        }else {
            return response()->json([
                'message' => 'this account does not have an store',
            ]);
        }

        $addedUserId = User::where('email', $request->email)->select(['id'])->pluck();

            $add_request = new _Request;
            $add_reqeust->store_id = $storeId ;
            $add_reqeust->user_id  = $addedUserId ;
            $add_reqeust->store_name = $storeName;
            $add_reqeust->save();
        
        if ($add_reqeust) {
            return response()->json([
                'message'=>'Sending Reqeust Done .',
                'request'=>$add_reqeust,
            ]);
        }else {
            return response()->json([
                'message'=>'error while send request , try again later !'
            ]);
        }

    }
    
}
