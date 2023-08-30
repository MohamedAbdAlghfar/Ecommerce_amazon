<?php

namespace App\Http\Controllers\ClientSide\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
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

        $user = User::find($userId);

        $rules = [
            'f_name'  => 'required',
            'l_name'  => 'required',
            'email'   => 'required|email|unique:users',
            'age'     => 'required',
            'profile_image' => 'required|image',
            'address' => 'required',
            'gender'  => 'required',
            'phone'   => 'required',
            'password'=> 'required|min:8|confirmed', 
        ];
        $this->validate($request, $rules);

        $user_profile_hash = $request->file('store_image')->hashName();

        // .. If Photo Not Same With Old Then Delete It Or Dont Update It ..
        if ($user_profile_hash != basename($user->profile_image)) {
            // delete the old image from the storage
            Storage::disk('public')->delete('images/Profile-Images/' . basename($store->store_cover));
            // update the store cover with the new one
            $user->update([
                'store_cover' => asset('storage/images/Profile-Images/' . $user_profile_hash)
            ]);
        }


        // .. updating ..  
        $updateUser = $user->update([
            'name'    => $request->f_name,
            'l_name'  => $request->l_name,
            'email'   => $request->email,
            'age'     => $request->age,
            'address' => $request->address,
            'gender'  => $request->gender,
            'phone'   => $request->phone,
            'password'=> $request->password,
        ]);
        
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
