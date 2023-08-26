<?php

namespace App\Http\Controllers\Store\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Store,User};
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SellStoreController extends Controller
{

    // .. Here owner can give his store to another new owner ..
    /* 
        1- make Store_id in StoreUser equals new userId , 
        2- make new User's role = owner role 
        3- make old owner's role = user  role
    */


    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function sellStore(Request $request){
        // .. Validation .. 
        $request->validate([
            'email' => 'required|email',
        ]);
        
        $user   =  auth()->user();
        $userId =  $user->id;
        //     ..        ..        ..
        $email  =  $request->email; 
        //     ..        ..        ..
        $pivotId = StoreUser::where('user_id',$userId)->select(['id'])->pluck('id');
        $newOwnerId = User::where('email',$email)->select(['id'])->pluck('id');

        if (!$newOwnerId) {
            return response()->json([
                'message'=>'User does not exist',
            ]);
        }

        // .. If One Query False , Then No Query Will Done .. 
        DB::transaction(function () {
            // .. Transfer Store ..
            $update = StoreUser::updateOrFail([
                [
                    'id'=>$pivotId,
                ],
                'user_id'=>$newOwnerId,
            ]);
            // .. Changing Roles ..
            $updateRoleForNew = User::updateOrFail([
                [
                    'id' => $newOwnerId,
                ],
                'role' => 2 ,
            ]);
            // .. Changing Roles ..
            $updateRoleForOld = User::updateOrFail([
                [
                    'id'=>$userId,
                ],
                'role' => 0 ,
            ]);

            // ..
            // .. Transaction Failed ..
        })->catch(function () {
                return response()->json([
                    'message'=>'The Transaction Failed',
                ]);
            });
        // .. Transaction Done ..
        return response()->json([
            'message'=>'Store Successfully Transferred',
        ]);
    }

    
    // Override the failedValidation method
    protected function failedValidation(Validator $validator)
    {
        // Throw an exception with a custom response
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }


    // that will return user email to form that have only one thing to change 
    // which is email and then change the id 
    public function storeData(){

        $user = auth()->user();
        $userId = $user->id;
        $userRole = $user->role;
        $userEmail= $user->email;

        if (!$userRole == 2) {
            return response()->json([
                'message'=>'role not allowed to use this form',
            ]);
        }
        return response()->json([
            $userEmail,
        ]);
    }

}
