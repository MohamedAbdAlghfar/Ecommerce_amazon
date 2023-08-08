<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
class MyprofileController extends Controller
{
   
     

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit()
    {
        $admin = JWTAuth::user();
        $profileData = [
            'profile_image' => $admin->profile_image,
            'f_name' => $admin->f_name,
            'l_name' => $admin->l_name,
            'email' => $admin->email,
            'address' => $admin->address,
            'phone' => $admin->phone,
            'gender' => $admin->gender,
        ];
        return response()->json($profileData);

    }

   
    public function update(Request $request)
    {
        
        $admin = JWTAuth::user();
        $data = $request->all();
        if(isset($data['gender'])) {
            if($data['gender'] == 'male') {
                $data['gender'] = 0;
            }
            else{
                $data['gender'] = 1;
            }
        }
        $admin->update($data);


        if($file = $request->file('image')) {

            $filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.'.$fileextension;

            if($file->move('images', $file_to_store)) {
                if($admin->profile_image) {
                    $Photo = $admin->profile_image;

                    // remove the old image

                    $filename = $Photo;
                    if(file_exists('images/'.$filename)) {
                        // delete the file
                        unlink('images/'.$filename);
                    }

                    $admin->profile_image = $file_to_store;
$admin->save();
                }else {
                    $admin->profile_image = $file_to_store;
                }
            }
        }


     //   return redirect('/admin')->withStatus('profile successfully updated.');
     return response()->json(['message' => 'profile successfully updated.']);

    }


    public function destroy($id)
    {
        //
    }
}
