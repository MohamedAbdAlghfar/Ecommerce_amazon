<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;

class Del_StoreController extends Controller
{

       // ------------------------------------------------ [ (REPORT) ] ------------------------------------------------------- //
    // this controller belong to {{Delete Store Page}}
      //details
           // 1- show    :  show all stores in web
           // 2- destroy : use to delete store from database and delete his images





    public function show()
    {
        $store = Store::orderBy('stores.created_at', 'desc')
        ->select('stores.id', 'stores.name', 'photoable.filename')
        ->leftJoin('photoable', function ($join) {
        $join->on('photoable.photoable_id', '=', 'stores.id')
        ->where('photoable.photoable_type', '=', 'App\Models\Store');
        })
        ->get()
        ->unique('id');
     // return view('admin/Store/show',compact('store')); 
        return response()->json($store);
    }

    public function destroy(Store $store)
    {
        
        $store->deleted_by = auth()->user()->id; 
        if ($store->photos->isNotEmpty()) {
            foreach ($store->photos as $photo) {
                $filename = $photo->filename;
                unlink('images/' . $filename); 
                $photo->delete();
            }
       }
    
        $users = $store->admins ;
        foreach($users as $user){
          $user->role = 0 ;
          $user->save();
        }

   
        $store->delete();
   
        //return redirect()->route('admin.index')->withStatus(__('store successfully deleted.'));
        return response()->json(['message' => 'store successfully deleted.']);



    }
}
