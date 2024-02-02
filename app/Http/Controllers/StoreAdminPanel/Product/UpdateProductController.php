<?php

namespace App\Http\Controllers\StoreAdminPanel\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\Is_Store_Admin;
use Illuminate\Support\Facades\Storage;

class UpdateProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Admin::class);
    }

    public function editProducts(Request $request)
    {
        $validatedData = $request->validate([
            'product_id'  => 'required|exists:products,id',
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

        // Begin a transaction
        DB::beginTransaction();

        try {

            $product = Product::find($request->product_id);

            $updateProduct = $product->update([
                'product_id' => $request->product_id,
                'name' => $request->name,
                'price' => $request->price,
                'discount' => $request->discount,
                'available_pieces' => $request->available_pieces,
                'weight' => $request->weight,
                'color' => $request->color,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'added_by' => $request->added_by,
                'brand' => $request->brand,
            ]);

            $productImages = [];
            $productImages = $request->product_image;

            foreach ($productImages as $p_image) {
                $imageOrdering = Photo::find($p_image->id);
                $ordering = $imageOrdering->ordering;
            }
            if ($request->hasFile('product_image')) // if admin update the offer image
            {
                $image = $request->file('product_image');
                $imageName = uniqid() . '.' . $image->extension();
                $image->move(storage_path('images/'), $imageName);

                if (!$image->isValid()) { // this isValid() ensures that file uploaded successfully , it Provided by Laravel
                    throw new \Exception('Invalid image provided.');
                }

                $oldProductImage = $product->photo()->first([
                    'photoable_id' => $request->product_id,
                    'photoable_type' => Product::class,
                ]);
    
                // Delete the old store cover file from the storage folder, if it exists
                if ($oldProductImage->exists) {
                    Storage::delete('images/' . $oldProductImage->filename);
                }

                $oldProductImage->fill([
                    'filename' => $imageName,
                ])->save();
            }

            // If everything is successful, commit the transaction
            DB::commit();

            return response()->json([
                'status' => 'Success',
                'message' => 'Product updated successfully.',
            ]);

        } catch (\Exception $e) {
            // If an exception occurs, rollback the transaction
            DB::rollBack();

            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
