<?php

namespace App\Http\Controllers\Store\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreUser;

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

        $deleteStore = StoreUser::where('user_id', $userId)->delete();

        if (!$deleteStore) {
            return resposne()->json([
                'status'=>'Failed',
                'message'=>'Error on deleting Store ! .. Try Again',
            ]);
        }
        return response()->json([
            'status'=>'Success',
            'message'=>'Store Deletion Were Done !'
        ]);
    }
}
