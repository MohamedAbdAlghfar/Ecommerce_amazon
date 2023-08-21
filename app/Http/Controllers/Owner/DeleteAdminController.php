<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DeleteAdminController extends Controller
{
    
    public function index()
    {
        
        $admins = User::select('id','f_name','l_name','email','phone','profile_image')->where('role', 1)->get();        
        
     //   return view('Owner\Admin\show',compact('admins'));
        return response()->json($admins);

    }

    public function destroy(User $user)
{
    if ($user->profile_image) {
        $filename = $user->profile_image;
        unlink('images/' . $filename);
        $imagePath = $user->profile_image;

        if ($imagePath) {
            Storage::delete($imagePath);
            $user->update(['image' => 'default.jpeg']); // Remove the image path from the admin
        }
    }

    // Move the user deletion code inside the if block
    $user->delete();

  //  return redirect()->route('owner.index')->withStatus(__('Admin successfully deleted.'));
    return response()->json(['message' => 'Admin successfully deleted.']);
}







}
