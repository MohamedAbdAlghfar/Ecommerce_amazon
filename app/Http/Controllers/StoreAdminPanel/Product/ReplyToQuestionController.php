<?php

namespace App\Http\Controllers\StoreAdminPanel\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\{User, Comment};
use App\Http\Middleware\Is_Store_Admin;

class ReplyToQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Admin::class);
    }

    public function replyQuestions(Request $request)
    {
        $validatedData = $request->validate([
            'parent_id' => 'required|exists:comments,id',
            'body' => 'required|string',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }
        // .. Get StoreId To Use It ..
        $user = auth()->user();
        $userId = User::find($user->id);
        $storeId = $userId->store->id;

        $comment = Comment::find($request->parent_id);
        $storeOfProduct = $comment->product->store->id;
        $productId = $comment->product->id;

        if (!$storeOfProduct == $storeId) // ensure that this product is from this store products 
        {
            return response()->json([
                'status' => 'Failed',
                'message' => 'This Product Not From This Store Products.',
            ]);
        }

        // .. Create The Reply ..
        $makeReply = Comment::create([
            'parent_id' => $request->parent_id,
            'body'      => $request->body,
            'product_id'=> $productId,
            'user_id'   => $userId,
        ]);

        if (!$makeReply) {  // .. If Creation Fails ..
            return response()->json([ 
                'status' => 'Failed',
                'message' => 'Failed To Reply To Comment.',
            ]);
        }
        // .. Creation Done ..
        return response()->json([
            'status' => 'Failed',
            'message' => 'Reply Pulblished Successfully.',
        ]);


    }
}
