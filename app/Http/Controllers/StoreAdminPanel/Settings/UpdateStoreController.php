<?php

namespace App\Http\Controllers\StoreAdminPanel\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\{Store, Photo};
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Middleware\Is_Store_Owner;

class UpdateStoreController extends Controller
{
    public function __construct(Is_Store_Owner $middleware)
    {
        $this->middleware($middleware);
    }

    public function sendStoreData(){
        $userId = auth()->user()->id;
        if ($userId->role == 3) {
            // .. select owner's store id ..
            $store = User::find($userId)->stores;
            $storeId = $store->id;

            // .. get the Owner's store ..
            $storeData = Store::where('id', $storeId)->get();

            // .. return store data to show in update form in front end side ..
            return response()->json([$storeData,]);
        }
        return response()->json([
            'message'=>'You dont have an store to update , Create your own to do !',
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = Validator::make(($request->all()),[
            'name'        => 'required|string',
            'email'       => 'required|email',
            'about_store' => 'required|string',
            'phone'       => 'required|string',
            'location'    => 'required|string',
            'services'    => 'required|string',
            'link_website'=> 'required|url',
            'store_image' => 'required|image|size:300|mimes:jpg,bmp,png',
            'store_cover' => 'required|image|size:300|mimes:jpg,bmp,png',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }
    
        $store = Store::find($request->id);

        if ($request->hasFile('store_image')) {

            $oldStoreImage = $store->photos()->where('ordering', 1)->first();

            Storage::delete('images/Store-Images/' . $oldStoreImage->filename);

            $image = $request->file('store_image');

            $imageName = time() . '.' . $image->extension();

            $image->move(storage_path('images/Store-Images'), $imageName);

            $oldStoreImage->update([
                'filename' => $imageName,
            ]);
        }
        // Check if the request has a new store cover
        if ($request->hasFile('store_cover')) {

            $oldStoreCover = $store->photos()->where('ordering', 2)->firstOrNew([
                'photoable_id' => $request->id,
                'photoable_type' => Store::class,
                'ordering' => 2,
            ]);

            // Delete the old store cover file from the storage folder, if it exists
            if ($oldStoreCover->exists) {
                Storage::delete('images/Store-Images/' . $oldStoreCover->filename);
            }

            $image = $request->file('store_cover');

            $imageName = time() . '.' . $image->extension();

            $image->move(storage_path('images/Store-Images'), $imageName);

            $oldStoreCover->fill([
                'filename' => $imageName,
            ])->save();
        }

        $store->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'about_store' => $request->about_store,
            'phone'       => $request->phone,
            'location'    => $request->location,
            'services'    => $request->services,
            'link_website'=> $request->link_website,
        ]);
    
        return response()->json(['message' => 'Store updated successfully']);
    }

}
