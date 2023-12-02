<?php

namespace App\Http\Controllers\ClientSide\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function userRequests()
    {
        $user = auth()->user();

        $userRequests = _Request::where('user_id', $user->id);

        if ($userRequests == null){
            return response()->json([
                'status' => 'Success',
                'message' => 'there is no Requests for this account',
            ]);
        }elseif (!$userRequests) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Error While Get Requests',
            ]);
        }else {
            return response()->json([
                'status' => 'Success',
                'requests' => $userRequests,
            ]);
        }

    }
}
