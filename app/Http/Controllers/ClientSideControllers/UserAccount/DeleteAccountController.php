<?php

namespace App\Http\Controllers\ClientSideControllers\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\User;

class DeleteAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function destroy()
    {
        $user = auth()->user();

        $userId = $user->id;

        $deleteUser = User::where('id', $userId)->delete();

        if (!$deleteUser) {
            return resposne()->json([
                'status'=>'Failed',
                'message'=>'Error on deleting the user ! .. Try Again',
            ]);
        }
        return response()->json([
            'status'=>'Success',
            'message'=>'Account Deletion Were Done !'
        ]);
    }
}
