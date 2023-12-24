<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use App\Models\order;
use App\Models\photo;


class ShippingController extends Controller
{
    
    public function index()
    {
        $shipping = ShippingCompany::select('shipping_companies.name', 'shipping_companies.id', 'photoable.filename', 'shipping_companies.phone', 'shipping_companies.email', 'shipping_companies.website', 'shipping_companies.location', 'shipping_companies.address')
        ->join('photoable', function ($join) {
            $join->on('photoable.photoable_id', '=', 'shipping_companies.id')
            ->where('photoable.photoable_type', '=', 'App\Models\ShippingCompany');
        })
        ->get()
        ->unique('id');  
              return view('Shipping\index',compact('shipping'));
    //  return response()->json($shipping);

    }

    public function show($id)
    {
        
        $shipping = ShippingCompany::select('shipping_companies.name','shipping_companies.id','photoable.filename')     ->join('photoable', function ($join) {
            $join->on('photoable.photoable_id', '=', 'shipping_companies.id')
            ->where('photoable.photoable_type', '=', 'App\Models\ShippingCompany');
        })->findOrFail($id); 
        
        $order = order::select('orders.id','orders.created_at','orders.trans_date','orders.price','orders.location','products.name as product_name','users.f_name as user_name','stores.name as store_name')
          ->join('products', 'orders.product_id', '=', 'products.id')
          ->leftJoin('users', 'orders.user_id', '=', 'users.id')
          ->leftJoin('stores', 'products.store_id', '=', 'stores.id')
          ->where('shipping_company_id',$id)->where('status',2)
          ->get();
      
        $data = [
            'shipping' => $shipping, 
            'order' => $order,
                ];


         return view('Shipping\show',compact('data'));
     //  return response()->json($data);
    } 

    public function edit($shipping_id)  
    {
               
        $shipping = ShippingCompany::select('shipping_companies.name','shipping_companies.id','photoable.filename','shipping_companies.phone','shipping_companies.website','shipping_companies.email','shipping_companies.address','shipping_companies.location')     ->join('photoable', function ($join) {
            $join->on('photoable.photoable_id', '=', 'shipping_companies.id')
            ->where('photoable.photoable_type', '=', 'App\Models\ShippingCompany');
        })->findOrFail($shipping_id);    
       // return view('Shipping/edit',compact('shipping'));
        return response()->json($shipping);

    }    

    public function update(Request $request,   $shipping_id)
    {
        
        $rules = [
            'name' => 'required|min:2|max:150',
            'phone' => 'required',  
            'website' => 'required',
            'email' => 'required',
            'address' => 'required', 
            'location' => 'required',  
                 ]; 

        $shipping = ShippingCompany::find($shipping_id);       
        $this->validate($request, $rules);
        $shipping->update($request->all());
        
        if ($file = $request->file('image')) { 
            $filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.' . $fileextension;
        
            if ($file->move('images', $file_to_store)) {
                if ($shipping->photo) {
                   
                      $photo = $shipping->photo;
        
                      // Remove the old image
                      $oldFilename = $photo->filename; 
                      unlink('images/' . $oldFilename);
                    
                    $photo->filename = $file_to_store;
                    $photo->save();
                } 
                else {
                    Photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $shipping->id,
                        'photoable_type' => 'App\Models\ShippingCompany',
                    ]);
                }
            }
        }


        return redirect('/shippingCombany')->withStatus('shipping company successfully updated.');
    //  return response()->json(['message' => 'shipping company successfully updated.']);

    }









}
