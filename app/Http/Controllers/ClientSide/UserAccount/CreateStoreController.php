<?php

namespace App\Http\Controllers\ClientSide\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\{Store,User,Product,Photo};
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

        // .. if user doesent pass email for store , then the store's email will be user's email .. 
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
            'store_cover'=>$request->store_cover ? asset('storage/images/' . $request->file('store_cover')->hashName()) : null,
            'store_image'=>$request->asset('storage/images/' . $request->file('store_image')->hashName()), // hasName choose a unique name for the file in public/images 
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
