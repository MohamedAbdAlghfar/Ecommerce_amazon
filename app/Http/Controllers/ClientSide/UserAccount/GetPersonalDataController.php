<?php

namespace App\Http\Controllers\ClientSide\UserAccount;

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

        $userPersonalData = User::find($userId)->only('f_name','l_name','email','age','gender','address','phone');

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
