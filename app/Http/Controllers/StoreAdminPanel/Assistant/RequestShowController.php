<?php

namespace App\Http\Controllers\StoreAdminPanel\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\_Request;
use Illuminate\Support\Facades\DB;

class RequestShowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function viewRequests()
    {
        $user = auth()->user();

        $storeId = DB::table('store_user')
        ->where('user_id', $user->id)
        ->select('store_id')
        ->first();

        $storeRequests = _Request::where('store_id', $storeId)->get(); // .. No Need To Use Select Here ..

        if ($storeRequests->isEmpty()) {
            return response()->json([
                'No Requests For This Store !',
            ]);
        }
        
        return response()->json([
            'Reqeusts' => $storeRequests,
        ]);
    }

}
