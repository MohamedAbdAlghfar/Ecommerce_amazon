<?php

namespace App\Http\Controllers\ClientSideControllers\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'f_name'  => 'required',
            'l_name'  => 'required',
            'email'   => 'required|email',
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
        $updateUser->address = $request->address;
        $updateUser->gender  = $request->gender;
        $updateUser->phone   = $request->phone;
        $updateUser->password= $request->password;

        $updateUser->save();  

        if ($updateUser) {
            return response()->json([
                'status' => 'Success',
                'message'=> 'User Updated Successfully',
                'user'  => $updateUser,
            ]);
        }
        return response()->json([
            'status' => 'Failed',
            'message'=> 'Error In Updating User Data ! .. Try Again Later',
        ]);
        
    }

}
