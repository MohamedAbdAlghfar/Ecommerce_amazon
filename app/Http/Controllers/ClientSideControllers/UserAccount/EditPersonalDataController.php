<?php

namespace App\Http\Controllers\ClientSideControllers\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditPersonalDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $userId = $user->id;

        $rules = [
            'f_name'  => 'nullable',
            'l_name'  => 'nullable',
            'email'   => 'nullable|email|unique:users',
            'age'     => 'nullable',
            'address' => 'nullable',
            'gender'  => 'nullable',
            'phone'   => 'nullable',
            'password'=> 'nullable|min:8|confirmed',
        ];
        $this->validate($request, $rules);


        // .. updating .. 
        $updateUser = User::find($user->id);
        $updateUser->f_name  = $request->f_name;
        $updateUser->l_name  = $request->l_name;
        $updateUser->email   = $request->email;
        $updateUser->age     = $request->age;
        $updateUser->address = $request->address;
        $updateUser->gender  = $request->gender;
        $updateUser->phone   = $request->phone;
        $updateUser->password= $request->password;

        $updateUser->save();  

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
