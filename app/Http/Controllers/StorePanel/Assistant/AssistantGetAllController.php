<?php

namespace App\Http\Controllers\StorePanel\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssistantGetAllController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAssistants()
    {
        $user = auth()->user();

        // .. Get The Store Id ..
        $storeId = DB::table('store_user')
        ->where('user_id', $user->id)
        ->select('store_id')
        ->first();

        // .. Get Array Of Store's All Related Users asssitants Or Other[customers, or owners] ..
        $storeAsistantsIds = DB::table('store_user')
        ->where('store_id', $storeId)
        ->select('id')
        ->pluck('id')
        ->toArray();

        // .. Get Just Assistants Of This Store ..
        $users = User::whereIn('id', $storeAsistantsIds)
        ->where('role', 3)
        ->select('email', 'id', 'f_name', 'l_name')
        ->get();

        // .. If No Assistants For This Store ..
        if ($users->isEmpty()) {
            return response()->json([
                'No Assistants For This Store !',
            ]);
        }
        // .. All Assistants For This Store , return All ..
        return response()->json([
            'assistants' => $users,
        ]);

    }
}
