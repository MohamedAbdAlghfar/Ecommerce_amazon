<?php

namespace App\Http\Controllers\ClientSide\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ResponseRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // if user approve the request then delete the record of this request from requests table by _Request model
    public function response(Request $request)
    {
        // if request = 1 accepted if = 0 rejected
        // if accepted delete request from requests table , and then make his role 3
        // then add record to store_user by user_id and store_id 

        $user = auth()->user();

        $storeid = $request->store_id ;


        DB::beginTransaction();

        try {
        if ($request->response == 1) {
            $deleteResult = _Request::where('user_id', $user->id)->delete();
            $updateResult = User::where('id', $user->id)->update(['role' => 3]);
            $insertResult = DB::table('store_user')->insert([
                'store_id' => $storeid,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($deleteResult && $updateResult && $insertResult) {
                DB::commit();
                return response()->json(['message' => 'All queries executed successfully']);
            } else {
                DB::rollback();
                return response()->json(['message' => 'One or more queries failed to execute'], 500);
            }
        } else {
            return response()->json(['message' => 'Condition not met'], 400);
        }
        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }

    }
}
