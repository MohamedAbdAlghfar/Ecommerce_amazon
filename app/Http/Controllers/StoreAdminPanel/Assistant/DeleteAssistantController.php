<?php

namespace App\Http\Controllers\StoreAdminPanel\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Http\Middleware\Is_Store_Owner;

class DeleteAssistantController extends Controller
{

    public function __construct(Is_Store_Owner $middleware)
    {
        $this->middleware($middleware);
    }
    
    public function deleteAssistant(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|unique:users',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $user = auth()->user();

        if ($user->role == 2) {
            return response()->json([
                'message'=>'You are not allowed to Visit this link',
            ]);
        }

        DB::beginTransaction();

        try {
            DB::table('store_user')
            ->where('user_id', $request->id)
            ->delete();

            User::where('id',$request->id)->update('role', 0);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => 'Error',
                'message' => 'Failed to Delete assistant',
            ], 500);
        }
    }
}
