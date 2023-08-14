<?php

namespace App\Http\Controllers\ClientSideControllers\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;

class GetUserStore extends Controller
{
    public function __construct()
    {
        $this->middeware('auth:api');
    }

    public function getUserStore(){
        $user = auth()->user();

        $userId = $user->id;

        $userStore = Store::where('user_id', $userId)->get();

        if (!$userStore) {
            return response()->json([
                'message'=>'User Doesent Have Any Store .',
            ]);
        }
        return response()->json([
            'Store'=>$userStore,
        ]);
    }
}
