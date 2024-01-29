<?php

namespace App\Http\Controllers\StoreAdminPanel\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Category, Photo};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AddProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function addProduct(Request $request)
    {
        $validatedData = Validator::make(($request->all()),[
            'name'  => 'required',
            'price'  => 'required',
            'discount'   => 'nullable',
            'available_pieces'     => 'required',
            'weight' => 'nullable',
            'color'  => 'required',
            'description'   => 'required',
            'store_id'=> 'nullable',
            'category_id'=> 'required',
            'added_by'=> 'required',
            'brand'=> 'required',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $user = auth()->user();

        $storeId = DB::table('store_user')
        ->where('user_id', $user->id)
        ->select(['store_id'])
        ->firstOrFail();

        $product = new Product ;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->available_pieces = $request->available_pieces;
            $product->weight = $request->weight;
            $product->color = $request->color;
            $product->description = $request->description;
            $product->about = $request->about;
            $product->store_id = $storeId;
            $product->category_id = $request->category_id; /*
            ---->>>>
            .. he must choose it from the select box with search to find categroy by name
            using Categories/ShowAllCategoreisController endpoint to get all of categoreis and search for any thing
            */
            $product->added_by = $user->id;
            $product->brand = $request->brand;
        $product->save();

        // .. Save Main Image For The Product ..
        if ($request->main_product_image) {
            $image1 = $request->file('main_product_image');
            $imageName1 = uniqid() . '.' . $image1->extension();
            $image1->move(storage_path('images'), $imageName1);
            Photo::create([
                'photoable_id' => $product->id,
                'ordering' => 1,
                'photoable_type' => Product::class,
                'filename' => $imageName1,
            ]);
        }
        if ($request->product_image2) {
            $image = $request->file('main_product_image');
            $imageName = Str::uuid()->toString() . '.' . $image->extension();
            $image->move(storage_path('images'), $imageName);
            Photo::create([
                'photoable_id' => $product->id,
                'ordering' => 2,
                'photoable_type' => Product::class,
                'filename' => $imageName,
            ]);
        }
        if ($request->product_image3) {
            $image = $request->file('main_product_image');
            $imageName = time() . mt_rand() . '.' . $image->extension();
            $image->move(storage_path('images'), $imageName);
            Photo::create([
                'photoable_id' => $product->id,
                'ordering' => 3,
                'photoable_type' => Product::class,
                'filename' => $imageName,
            ]);
        }
        if ($request->product_image4) {
            $image = $request->file('main_product_image');
            $imageName = Str::random(14) . '.' . $image->extension();
            $image->move(storage_path('images'), $imageName);
            Photo::create([
                'photoable_id' => $product->id,
                'ordering' => 4,
                'photoable_type' => Product::class,
                'filename' => $imageName,
            ]);
        }
        if ($request->product_image5) {
            $image = $request->file('main_product_image');
            $imageName = Str::random(12) . '.' . $image->extension();
            $image->move(storage_path('images'), $imageName);
            Photo::create([
                'photoable_id' => $product->id,
                'ordering' => 5,
                'photoable_type' => Product::class,
                'filename' => $imageName,
            ]);
        }
        if ($request->product_image6) {
            $image = $request->file('main_product_image');
            $imageName = Str::random(10) . '.' . $image->extension();
            $image->move(storage_path('images'), $imageName);
            Photo::create([
                'photoable_id' => $product->id,
                'ordering' => 6,
                'photoable_type' => Product::class,
                'filename' => $imageName,
            ]);
        }
        if ($request->product_image7) {
            $image = $request->file('main_product_image');
            $imageName = Str::random(8) . '.' . $image->extension();
            $image->move(storage_path('images'), $imageName);
            Photo::create([
                'photoable_id' => $product->id,
                'ordering' => 7,
                'photoable_type' => Product::class,
                'filename' => $imageName,
            ]);
        }
        if ($request->product_image8) {
            $image = $request->file('main_product_image');
            $imageName = Str::random(9) . '.' . $image->extension();
            $image->move(storage_path('images'), $imageName);
            Photo::create([
                'photoable_id' => $product->id,
                'ordering' => 8,
                'photoable_type' => Product::class,
                'filename' => $imageName,
            ]);

        }

    }

}
