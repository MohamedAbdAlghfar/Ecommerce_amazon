<?php

namespace App\Http\Controllers\StoreAdminPanel\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SelectUserToRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getUsers(Request $reqeust)
    {
        if ($reqeust->email) 
        {
            // .. Get Selected Email's User ..
            $user = User::where('email', $request->email)
            ->select(['id','email','f_name'])
            ->first();

            // .. If User Not Found Then Get All Partly Similar Users's ..
            if (!$user) 
            {
                $similar = User::where('email', 'like', '%' . request('email') . '%')->get();

                return response()->json([
                    'results' => $similar,
                ]);
            }

            // .. Get Selected User If Found ..
            return response()->json([
                'user - id'  => $user->id,
                'user-email' => $user->email,
                'user-name'  => $user->f_name,
            ]);
        }

        // .. If No [[ $request->email ]] , Then Get All Users With No Admin Roles ..
        $users = User::where('role', 0)
        ->select(['id','email','f_name'])
        ->get();

        return response()->json([
            'users' => $users,
        ]);
    }

}
