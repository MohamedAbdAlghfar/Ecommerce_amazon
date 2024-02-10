<?php

namespace App\Http\Controllers\StoreAdminPanel\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Photo, User};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\Is_Store_Admin;

class AddProductController extends Controller
{

    public function __construct(Is_Store_Admin $middleware)
    {
        $this->middleware($middleware);
    }


    public function addProduct(Request $request)
    {
        $validatedData = $request->validate([
            'name'  => 'required',
            'price'  => 'required',
            'discount'   => 'nullable',
            'available_pieces'     => 'required',
            'weight' => 'nullable',
            'color'  => 'required',
            'description'   => 'required',
            'category_id'=> 'required',
            'added_by'=> 'required',
            'brand'=> 'required',
            'product_image' => 'required|image|size:300|mimes:jpg,bmp,png',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        // .. Get StoreId To Use It ..
        $user = auth()->user();
        $userId = User::find($user->id);
        $store_Id = DB::table('store_user')
            ->where('user_id', $user->id)
            ->select('store_id')
            ->first();
        $storeId = $store_Id->store_id;

        $productImages = [];
        $productImages = $request->product_image;

        DB::beginTransaction();
        try {
            // .. Create New Product ..
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->available_pieces = $request->available_pieces;
            $product->weight = $request->weight;
            $product->color = $request->color;
            $product->description = $request->description;
            $product->store_id = $storeId;
            $product->category_id = $request->category_id;
            $product->added_by = $user->id;
            $product->brand = $request->brand;
            $product->save();

            $counter = 1;
            foreach($productImages as $product_images)
            {
                $image = $product_images;
                $imageName = uniqid() . '.' . $image->extension();
                $image->move(storage_path('images/'), $imageName);

                $createPhoto = Photo::create([
                    'photoable_id' => $offer->id,
                    'photoable_type' => Offer::class,
                    'ordering' => $counter,
                    'filename' => $imageName,
                ]);
                $counter++;

                if (!$image->isValid()) { // this isValid() ensures that file uploaded successfully , it Provided by Laravel
                    throw new \Exception('Invalid image provided.');
                }

                if (!$createPhoto) {
                    throw new \Exception('Failed to create photo record.');
                }
            }
        } catch (\Exception $e) {
            // If an exception occurs, rollback the transaction
            DB::rollBack();
    
            return response()->json([
                'status'  => 'Error',
                'message' => $e->getMessage(),
            ]);
        }
    }

}
