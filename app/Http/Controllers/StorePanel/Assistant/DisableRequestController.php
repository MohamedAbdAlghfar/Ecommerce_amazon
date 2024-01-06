<?php

namespace App\Http\Controllers\StorePanel\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\_Request;
use Illuminate\Support\Facades\DB;

class DisableRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function disable(Request $request)
    {
        $user = auth()->user();

        $storeId = DB::table('store_user')->where('user_id', $user->id)->select('store_id')->get();

        $userId = $request->id;

        $findInRequest = _Request::where('user_id', $userId)->where('store_id', $storeId)->get();
        if (!$findInRequest) {
            return response()->json([
                'message'=>'user already have an request !',
            ]);
        }else {
            $disableRequest = _Request::where('user_id', $userId)->where('store_id', $storeId)->delete();
            return response()->json([
                'message' => 'Request Were Disabled Successfully .',
            ]);
        }

    }
}
