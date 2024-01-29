<?php

namespace App\Http\Controllers\StoreAdminPanel\Assistant;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class AddAssistantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // .. here admin can add an account to be an assistant in store ..
    public function createAssistant(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|email|unique:users',
            'age' => 'required',
            'address' => 'nullable',
            'gender' => 'required',
            'phone' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        DB::beginTransaction();

        try {
            $user = User::create([
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'email' => $request->email,
                'age' => $request->age,
                'address' => $request->address,
                'gender' => $request->gender,
                'role' => 3,          // .. Owner Make New Assistant In His Store ..
                'phone' => $request->phone,
                'password' => Hash::make($request->input('password')),
            ]);

            $authenticatedUser = auth()->user();
            $authUserId = $authenticatedUser->id;

            $storeId = DB::table('store_user')
                ->where('user_id', $authUserId)
                ->select('store_id')
                ->first();

            // .. Make The Account Belonged To This Store ..
            if ($storeId) {
                DB::table('store_user')->insert([
                    'store_id' => $storeId,
                    'user_id' => $authUserId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // .. Create The Default Cart Of User ..
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);

            $this->token = JWTAuth::fromUser($user);

            DB::commit();

            return response()->json([
                'status' => 'Success',
                'message' => 'Assistant Added Successfully',
                'token' => $this->token,
                'user' => $user,
                'usercart' => $cart,
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => 'Error',
                'message' => 'Failed to add assistant',
            ], 500);
        }
    }
}