<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;

class Del_StoreController extends Controller
{

    
    public function show()
    {
        $store = Store::orderBy('created_at', 'desc')->get();
        //   return view('admin/Store/show',compact('store')); 
         return response()->json($store);
    }

    public function destroy(Store $store)
    {
        
        $store->deleted_by = auth()->user()->id;
        if ($store->store_image) {
            
            $filename = $store->store_image;
            unlink('images/' . $filename);
            $imagePath = $store->store_image;

            if ($imagePath) {
                Storage::delete($imagePath);
                $store->update(['image' => 'default.jpeg']); // Remove the image path from the category
            }
        
    }
    
    if ($store->store_cover) {
            
        $filename = $store->store_cover;
        unlink('images/' . $filename);
        $imagePath = $store->store_cover;

        if ($imagePath) {
            Storage::delete($imagePath);
            $store->update(['image' => 'default.jpeg']); // Remove the image path from the category
        }
    
}
    
   
    $store->delete();
    return redirect()->route('admin.index')->withStatus(__('store successfully deleted.'));
  //  return response()->json(['message' => 'store successfully deleted.']);



    }
}
