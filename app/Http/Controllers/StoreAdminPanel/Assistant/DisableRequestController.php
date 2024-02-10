<?php

namespace App\Http\Controllers\StoreAdminPanel\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\_Request;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\Is_Store_Owner;

class DisableRequestController extends Controller
{

    public function __construct(Is_Store_Owner $middleware)
    {
        $this->middleware($middleware);
    }

    public function disable(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'id' => 'required|unique:users',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $store_Id = DB::table('store_user')
        ->where('user_id', $user->id)
        ->select('store_id')
        ->first();
        $storeId = $store_Id->store_id;

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
