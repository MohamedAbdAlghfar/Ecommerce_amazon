<?php

namespace App\Http\Controllers\ClientSideControllers\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\{Store,User};

class CreateStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function Create(Request $request){

        $user = auth()->user();

        $userId = $user->id;

        // look if user want to but emil to store or if he dont pass any email the default email will be his account email
        // and in front end he should writ to user : 'if you dont pass the email , the email of store will be your account email'
        if ($request->email) {

            $email = $request->email;

            // .. if request have email , then validate the email ..
            $rules = [
                'name' => 'required|min:5|max:150',
                'email' => 'required|email',
                'about_store' => 'required',
                'phone' => 'required',
                'location' =>'required',
                'store_cover' => 'required',
                'store_image' => 'required',
                'services' => 'required',  
                'link_website' => 'required',                
            ]; 
            $this->validate($request, $rules);

        }else {

            $email = $user->email;

            // .. if request doesent have email , then we didnt need to make validate for email ..
            $rules = [
                'name' => 'required|min:5|max:150',
                // .. no email validation , coz it weren't in the request ..
                'about_store' => 'required',
                'phone' => 'required',
                'location' =>'required',
                'store_cover' => 'required',
                'store_image' => 'required',
                'services' => 'required',  
                'link_website' => 'required',                
            ]; 
            $this->validate($request, $rules);
            
        }

        $createStore = Store::create([
            'name' => $request->name,
            'user_id' => $userId,
            'email'=> $email,
            'about_store'=>$requst->about_store,
            'phone'=>$request->phone,
            'location'=>$request->location,
            'store_cover'=>'',
            'store_image'=>'',
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
            'store'  => $createStore,
        ]);
    }
}
