<?php

namespace App\Http\Controllers\ClientSide\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Store, User, Product, Photo, StoreUser};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CreateStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(Request $request)
    {
        $user = auth()->user();
        $userId = $user->id;
        $email = $request->email ?? $user->email;

        // .. Check Is Not Owner To Other Store Or Admin Or Owner ..
        if ($user->role !== 0) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'You are not allowed to create a store.',
            ]);
        }

        $validatedData = Validator::make($request->all(), [
            'name' => 'required|min:5|max:150',
            'email' => 'nullable|email|unique:stores',
            'about_store' => 'required',
            'phone' => 'required',
            'location' =>'required',
            'store_cover' => 'nullable|image',
            'store_image' => 'required|image',
            'services' => 'required',  
            'link_website' => 'required|url',                
        ]); 

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        // Start the transaction
        DB::beginTransaction();

        try {
            $createStore = Store::create([
                'name'        => $request->name,
                'email'       => $email,
                'about_store' => $request->about_store,
                'phone'       => $request->phone,
                'location'    => $request->location,
                'services'    => $request->services,
                'link_website'=> $request->link_site,
            ]);

            $storeid = $createStore->id;

            // .. Relate The Store With Authenticated User ..
            DB::table('store_user')->insert([
                'store_id' => $storeid,
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // .. Part Of Create Store-Image ..
            if ($request->store_image) {
                $image1 = $request->file('store_image');
                $imageName1 = uniqid() . '.' . $image1->extension();
                $image1->move(storage_path('images/Store-Images'), $imageName1);
                Photo::create([
                    'photoable_id' => $storeid,
                    'ordering' => 1,
                    'photoable_type' => Store::class,
                    'filename' => $imageName1,
                ]);
            }

            // .. Part Of Create Store Cover ..
            if ($request->store_cover) {
                $image_ = $request->file('store_cover');
                $image_Name = time() . '.' . $image_->extension();
                $image_->move(storage_path('images/Store-Images'), $image_Name);
                Photo::create([
                    'photoable_id' => $storeid,
                    'ordering' => 2,
                    'photoable_type' => Store::class,
                    'filename' => $image_Name,
                ]);
            }

            // Commit the transaction if all queries succeeded
            DB::commit();

            return response()->json([
                'status' => 'Success',
                'message' => 'Store Created Successfully',
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction if any query fails
            DB::rollback();

            return response()->json([
                'status' => 'Failed',
                'message' => 'Error In Creating Store! Please try again later.',
            ]);
        }
    }
}