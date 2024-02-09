<?php

namespace App\Http\Controllers\StoreAdminPanel\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\{Product, Comment};
use App\Http\Middleware\Is_Store_Admin;
use App\Http\Resources\CommentResource;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Admin::class);
    }

    public function getQuestions(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $rateings = Comment::where('product_id', $request->product_id)
        ->where('type',1)
        ->paginate(20);

        $ratings->appends($request->query());

        $commentsResource = CommentResource::collection($ratings);

        return response()->json([
            'status' => 'Success',
            'rates'  => $commentsResource,
        ]);
    }
}
