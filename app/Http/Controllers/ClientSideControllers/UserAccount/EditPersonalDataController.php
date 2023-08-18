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

    public function getData(){
        $user_ = auth()->user();
        $user_id = $user_->id;

        $userPersonalData = User::where('id',$user_id)->get();

        if ($userPersonalData) {
            return response()->json([
                'status'=>'success',
                'data'  =>$userPersonalData,
            ]);
        }
        return response()->json([
            'status'=>'failed',
            'data'  =>'failed to get the data !. try Again Later ',
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
            'profile_image'  => 'required',
            'address' => 'required',
            'gender'  => 'required',
            'phone'   => 'required',
            'password'=> 'required|min:8|confirmed',
        ];
        $this->validate($request, $rules);


        // .. updating .. 
        $updateUser = User::find($user->id);
        $updateUser->f_name  = $request->f_name;
        $updateUser->l_name  = $request->l_name;
        $updateUser->email   = $request->email;
        $updateUser->age     = $request->age;
        $updateUser->profile_image  = $request->profile_image;
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
