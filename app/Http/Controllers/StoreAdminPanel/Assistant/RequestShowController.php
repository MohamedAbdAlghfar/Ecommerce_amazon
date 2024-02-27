<?php

namespace App\Http\Controllers\StoreAdminPanel\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\_Request;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\Is_Store_Owner;

class RequestShowController extends Controller
{
    public function __construct(Is_Store_Owner $middleware)
    {
        $this->middleware($middleware);
    }

    public function viewRequests()
    {
        $user = auth()->user();

        $store_Id = DB::table('store_user')
        ->where('user_id', $user->id)
        ->select('store_id')
        ->first();
        $storeId = $store_Id->store_id;

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
