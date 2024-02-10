<?php

namespace App\Http\Controllers\StoreAdminPanel\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Store,User};
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Middleware\Is_Store_Owner;

class SellStoreController extends Controller
{

    // .. Here owner can give his store to another new owner ..

    public function __construct(Is_Store_Owner $middleware)
    {
        $this->middleware($middleware);
    }
    public function sellStore(Request $request)
    {
        // .. Validation .. 
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }
        
            $user = auth()->user();
            $userId = $user->id;
            $store_Id = DB::table('store_user')
                ->where('user_id', $user->id)
                ->select('store_id')
                ->first();
            $storeId = $store_Id->store_id;
            // ..        ..        ..
            $email = $request->email; 
            $newOwnerId = User::where('email', $email)->pluck('id')->first();

        if (!$newOwnerId) {
            return response()->json([
                'message' => 'User does not exist',
            ]);
        }

        // Check if the user's role is equal to zero
        $newUser = User::find($newOwnerId);
        if ($newUser->role !== 0) {
            return response()->json([
                'message' => 'The selected user cannot be the new owner of the store.',
            ]);
        }

        // Start the transaction
        DB::beginTransaction();

        try {

            DB::table('store_user')
            ->where('store_id', $storeId)
            ->where('user_role', 2)
            ->update('user_id', $newOwnerId);
            
            // .. Transfer Store ..
            User::where('id', $newOwnerId)->update([
                'role' => 2,
            ]);

            // .. Changing Roles ..
            User::where('id', $userId)->update([
                'role' => 0,
            ]);

            // Commit the transaction if all queries succeeded
            DB::commit();

            return response()->json([
                'message' => 'Store Successfully Transferred',
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction if any query fails
            DB::rollback();

            return response()->json([
                'message' => 'The Transaction Failed',
            ]);
        }
    }


    // that will return user email to form that have only one thing to change 
    // which is email and then change the id 
    public function storeData(){

        $user = auth()->user();
        $userId = $user->id;
        $userRole = $user->role;
        $userEmail= $user->email;

        if (!$userRole == 2) {
            return response()->json([
                'message'=>'role not allowed to use this form',
            ]);
        }
        return response()->json([
            $userEmail,
        ]);
    }

}
