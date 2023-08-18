<?php

namespace App\Http\Controllers\ClientSideControllers\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\{Store,User};
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function Create(Request $request){

        $user = auth()->user();

        $userId = $user->id;

        $email = $request->email ?? $user->email;

        $rules = [
            'name' => 'required|min:5|max:150',
            'email' => 'required|email|unique:stores',
            'about_store' => 'required',
            'phone' => 'required',
            'location' =>'required',
            'store_cover' => 'nullable',
            'store_image' => 'required',
            'services' => 'required',  
            'link_website' => 'nullable',                
        ]; 
        $this->validate($request, $rules);

        $createStore = Store::create([
            'name' => $request->name,
            'user_id' => $userId,
            'email'=> $email,
            'about_store'=>$request->about_store,
            'phone'=>$request->phone,
            'location'=>$request->location,
            'store_cover'=>$request->store_cover,
            'store_image'=>$request->store_image,
            'services'=>$request->services,
            'link_website'=>$request->link_site,
        ]);

        if ($createStore) {
            return response()->json([
                'status' => 'Success',
                'message'=> 'Store Created Successfully',
                'store'  => $createStore,
            ]);
        }
        return response()->json([
            'status' => 'Failed',
            'message'=> 'Error In Creating Store ! .. Try Again Later',
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
