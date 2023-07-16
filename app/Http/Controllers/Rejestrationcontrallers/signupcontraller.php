<?php

namespace App\Http\Controllers\Rejestrationcontrallers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class signupcontraller extends Controller
{
    public function store(Request $Request)
    {
        $user = new User();
        
        //..
        if($Request->Conf_Password==$Request->Password){
            $user->Password= bcrypt($Request->Password);
            $user->F_Name  = $Request->F_Name;
            $user->L_Name  = $Request->L_Name;
            $user->Email   = $Request->Email;
            $user->Address = $Request->Address;
            $user->Gender  = $Request->Gender;
            $user->Phone   =$Request->Phone;
            $user->save();//----
            return back();
        }else{
            //return back();
            echo "<h1>please write the similar password</h1>";
        }
        
 
        
    }
}
