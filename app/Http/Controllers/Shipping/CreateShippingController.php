<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use App\Models\photo;

class CreateShippingController extends Controller
{
    
    public function create() 
    {
      // return view("Shipping\create");
         return response()->json(['message' => ' Create method called.']); 
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|max:150',
            'phone' => 'required',  
            'website' => 'required',
            'email' => 'required',
            'address' => 'required', 
            'location' => 'required',
            'image' => 'required',
                 ]; 
        $this->validate($request, $rules);
        $shipping = ShippingCompany::create($request->all());
        $shipping->save();
        if($shipping) {
            
            if($file = $request->file('image')) {

                $filename = $file->getClientOriginalName();
                $fileextension = $file->getClientOriginalExtension();
                $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.'.$fileextension;

                if($file->move('images', $file_to_store)) {
                    photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $shipping->id,
                        'photoable_type' => 'App\Models\ShippingCompany', 
                    ]);
                }
            }
        }
//      return redirect('/shippingCombany')->withStatus('shipping successfully created.');        
        return response()->json(['message' => 'shipping successfully created.']);

    }


}
