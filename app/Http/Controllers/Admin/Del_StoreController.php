<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Storage;

class Del_StoreController extends Controller
{

    public function index()
    {
        //
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show()
    {
        $store = Store::orderBy('created_at', 'desc')->get();
         //  return view('admin/Store/show',compact('store'));
         return response()->json($store);




    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy(Store $store)
    {
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
  //  return redirect()->route('admin.index')->withStatus(__('store successfully deleted.'));
    return response()->json(['message' => 'store successfully deleted.']);



    }
}
