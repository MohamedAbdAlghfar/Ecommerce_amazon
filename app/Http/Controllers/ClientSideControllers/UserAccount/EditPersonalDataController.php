<?php

namespace App\Http\Controllers\ClientSideControllers\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditPersonalDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // .. Get User's All Data To Show In Update Form And Modify Any Of it ..
    public function getUserData(){
        $user = auth()->user();
        return response()->json([
            'userdata' => $user,
        ]);
    }
        
    public function update(Request $request)
    {
        $user = auth()->user();

        $userId = $user->id;

        $rules = [
            'f_name'  => 'required',
            'l_name'  => 'required',
            'email'   => 'required|email|unique:users',
            'age'     => 'required',
            'profile_image' => 'required',
            'address' => 'required',
            'gender'  => 'required',
            'phone'   => 'required',
            'password'=> 'required|min:8|confirmed',
        ];
        $this->validate($request, $rules);


        // .. updating ..  
        $updateUser = User::update(
            [
                'id' => $user->id,
            ],
            $request->except(['f_name', 'l_name', 'email', 'age', 'address', 
            'gender','profile_image', 'phone', 'password']),
        );
        
        if ($updateUser) {
            return response()->json([
                'status'  => 'Success',
                'message' => 'User Updated Successfully',
                'user'    => $updateUser,
            ]);
        }
        return response()->json([
            'status' => 'Failed',
            'message'=> 'Error In Updating User Data ! .. Try Again Later',
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

}
