<?php

namespace App\Http\Controllers\ClientSide\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use App\Http\Models\{_Request,User};
use Illuminate\Support\Facades\Log;

class ResponseRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function response(Request $request)
    {

        $user = auth()->user();

        $storeid = $request->store_id ;

        try {
            DB::beginTransaction();

            // Retrieve the latest request ID for the user
            $latestRequest = _Request::where('user_id', $user->id)->latest()->value('id');

            if ($request->response == 1) {
                // .. Update the user's role to 3 ..
                User::where('id', $user->id)->update(['role' => 3]);

                // .. Insert a new Record into the store_user Pivot Table ..
                DB::table('store_user')->insert([
                    'store_id' => $storeId,
                    'user_id' => $user->id,
                    'user_role' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // .. Log the Activity if the Request Were Accepted ..
                if ($latestRequest) {
                    activity()
                        ->performedOn(_Request::class, $latestRequest)
                        ->log("User : {$user->f_name} accepted the request to be an assistant in your team");
                }

                DB::commit();
                return response()->json(['message' => 'Accepted Request']);
            } else {
                DB::rollback();
                return response()->json(['message' => 'Rejected Request'], 400);
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::error("An error occurred: {$e->getMessage()}");
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }
}
