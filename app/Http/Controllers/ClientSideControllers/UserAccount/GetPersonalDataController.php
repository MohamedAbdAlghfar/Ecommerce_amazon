<?php

namespace App\Http\Controllers\ClientSideControllers\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class GetPersonalDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getPersonalData(){

        $user = auth()->user();
        
        $userId = $user->id;

        $userPersonalData = User::where('id', $userId)->get();

        if (!$userPersonalData) {
            return response()->json([
                'status'=>'Failed',
                'message'=>'Some Thing Went Wrong ! .. Try Again Later',
            ]);
        }
        return response()->json([
            'status'=>'Success',
            'user data'=>$userPersonalData,
        ]);
    }
}
