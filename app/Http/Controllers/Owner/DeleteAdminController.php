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
        
        $admins = User::select('users.id','users.f_name','users.l_name','users.email','users.phone','photoable.filename')->where('role', 1)     ->join('photoable', function ($join) {
          $join->on('photoable.photoable_id', '=', 'users.id')
          ->where('photoable.photoable_type', '=', 'App\Models\User');
      })->get();               
        return view('Owner\Admin\show',compact('admins'));
      //return response()->json($admins);

    }

    public function destroy(User $user)
    {
      if ($user->photo !== null) {
        if ($user->photo instanceof \Illuminate\Support\Collection) {
            foreach ($user->photo as $photo) {
                $filename = $photo->filename;
                unlink('images/' . $filename);
                $photo->delete();
            }
        } else {
            $filename = $user->photo->filename;
            unlink('images/' . $filename);
            $user->photo->delete();
        }
    }

        // Move the user deletion code inside the if block
        $user->delete();

      //return redirect()->route('owner.index')->withStatus(__('Admin successfully deleted.'));
        return response()->json(['message' => 'Admin successfully deleted.']);
    }


}
