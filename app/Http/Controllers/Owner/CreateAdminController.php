<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\photo;
use Illuminate\Support\Facades\Hash;

class CreateAdminController extends Controller
{
    
    public function create() 
    {
       return view("Owner\Admin\create");
       //  return response()->json(['message' => ' Create method called.']); 
    }

    public function store(Request $request)
    {
        $rules = [
            'f_name'   => 'required|min:2|max:150',
            'l_name'   => 'required|min:2|max:150',
            'phone'    => 'required',
            'age'      => 'required',
            'address'  => 'required',
            'email'    => 'required',
            'password' =>'required',           
            'image'    => 'required',                
                 ]; 
        
        $data = $request->all();
        if(isset($data['gender'])) {
            if($data['gender'] == 'male') {
                $data['gender'] = 0;
            }
            else{
                $data['gender'] = 1;              
            }
        }
      
        $this->validate($request, $rules);
        $Admin = new User;
        $Admin->fill($request->merge(["role" => 1 , 'password'=> Hash::make('password')])->all());        
        
        $Admin->save();
        if($Admin) {
            
            if($file = $request->file('image')) {

                $filename = $file->getClientOriginalName();
                $fileextension = $file->getClientOriginalExtension();
                $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.'.$fileextension;

                if($file->move('images', $file_to_store)) {
                    photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $Admin->id,
                        'photoable_type' => 'App\Models\User', 
                    ]);
                }
            }
        }
     //return redirect('/owner')->withStatus('Admin successfully created.');        
       return response()->json(['message' => 'Admin successfully created.']);


    }





}
