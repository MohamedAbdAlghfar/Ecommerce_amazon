<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
class MyprofileController extends Controller
{
   
   // ------------------------------------------------ [ (REPORT) ] ------------------------------------------------------- //
    // this controller belong to {{Myprofile Page}}
      //details
           // 1- edit  : return view have data of authintecation admin
           // 2- update: update data of authintecation admin 




    public function __construct()
    {
        $this->middleware('auth:api');
    }
 
    public function edit()
    {
        // get the authenticated user
        $user = auth()->user();

        //  return the user profile as a JSON response
    
     //  return view('admin/Myprofile/edit',compact('user'));
         return response()->json(optional($user)->only('email', 'address','gender','f_name','l_name'));
    
    }
    
   
    public function update(Request $request)
    {
        
        $admin = auth()->user();
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
   
}
