<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\photo;
use App\Models\Product;
use App\Models\Category;
use Tymon\JWTAuth\Facades\JWTAuth;
class ProductController extends Controller
{
    
       // ------------------------------------------------ [ (REPORT) ] ------------------------------------------------------- //
    // this controller belong to {{Product Pages}}
      //details
           // functions
                // 1- create : return view to create product
                // 2- store  : store the product in database and save his image
                // 3- show   : show all product in web
                // 4- edit   : show specific product to edit
                // 5- update : update the product in database and his image
                // 6- destroy: delete specific product from database and delete his image and save data of admin that delete (soft delete)








    public function create() 
    {
        $category = Category::select('id','name')->orderBy('id', 'desc')->get();
      //  return view("Admin\Product\create",compact('category'));
         return response()->json($category); 
    }

    
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|max:150',
            'available_pieces' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'color' => 'required',
            'weight' =>'required',
            'description' => 'required', 
            'about' => 'required',
            'images' => 'required',                
                 ]; 
        $this->validate($request, $rules);

        $Product = new Product;
        $Product->fill($request->merge(["sold" => 0 , "store_id" => Null])->all());
        
        $parent_id = $request->input('parent_id'); // get the selected parent category ID from the request data
        $category = Category::find($parent_id); // get the Category model for the selected parent category
        if ($category !== null)
            $Product->category_id = $category->id; // set the "category_id" attribute of the "Product" model to the "parent_id" attribute of the related "Category" model
        
        $Product->save();
        if($Product) {
            
            if ($files = $request->file('images')) {
               $i = 1;
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $fileextension = $file->getClientOriginalExtension();
                    $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.' . $fileextension;
            
                    if ($file->move('images', $file_to_store)) {
                        photo::create([
                            'filename' => $file_to_store,
                            'photoable_id' => $Product->id,
                            'photoable_type' => 'App\Models\Product',
                            'ordering' => $i,
                        ]);
                    }
                $i++;
                }
            }
           // return redirect('/admin')->withStatus('Product successfully created.');        
          return response()->json(['message' => 'product successfully created.']);

        }



    }

    
    public function show()
    {

        $product_of_web = Product::select('products.id', 'products.name as product_name', 'products.available_pieces', 'products.store_id', 'photoable.filename')
        ->where('products.store_id', null)
        ->leftJoin('photoable', function ($join) {
        $join->on('photoable.photoable_id', '=', 'products.id')
        ->where('photoable.photoable_type', '=', 'App\Models\Product');
        })
        ->get()
        ->unique('id');
        $product_of_store = Product::select('products.id', 'products.name as product_name', 'products.available_pieces', 'products.store_id', 'stores.name as store_name', 'photoable.filename')
         ->join('stores', 'stores.id', '=', 'products.store_id')
         ->leftJoin('photoable', function ($join) {
            $join->on('photoable.photoable_id', '=', 'products.id')
            ->where('photoable.photoable_type', '=', 'App\Models\Product');
            })
         ->orderBy('products.store_id', 'asc')
         ->get();

        $data = [
           'product_of_web' => $product_of_web,
           'product_of_store' => $product_of_store 
                ];




          return view('admin/Product/show',compact('data'));
      //  return response()->json($data);
    }

    
    public function edit($product_id)
    {
      
        $product = Product::select('products.id', 'products.name as product_name', 'products.available_pieces', 'photoable.filename','price','discount','weight','color','col_1','description','col_2','col_3','col_4','about','brand','category_id')
        ->where('products.store_id', null)
        ->leftJoin('photoable', function ($join) {
        $join->on('photoable.photoable_id', '=', 'products.id')
        ->where('photoable.photoable_type', '=', 'App\Models\Product');
        })
        ->find($product_id);
        
        $product2 = Product::findOrFail($product_id);
        $photos = $product2->photos;
        $category = Category::select('id','name')->orderBy('id', 'desc')->get();
        $data = [
           'category' => $category,
           'product' => $product,
           'photos' => $photos,    
                ];
      
         return view('admin/Product/edit',compact('data'));
     //  return response()->json($data); 
    }

    
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required|min:5|max:150',
            'available_pieces' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'color' => 'required',
            'weight' =>'required',
            'description' => 'required',
            'about' => 'required',                       
                 ]; 
        $this->validate($request, $rules);
        $product->update($request->all());
        $parent_id = $request->input('parent_id'); // get the selected parent category ID from the request data
        $category = Category::find($parent_id); // get the Category model for the selected parent category
        if ($category !== null)
           $product->category_id = $category->id; // set the "category_id" attribute of the "Product" model to the "parent_id" attribute of the related "Category" model
        
        $product->save();
        if ($files = $request->file('images')) {
            if ($product->Photos) {
                foreach ($product->Photos as $photo) {
                    $photo->delete();
                    // Remove the old image
                    $oldFilename = $photo->filename;
                    unlink('images/' . $oldFilename);

                }
                
            }
            $i = 1;
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $fileextension = $file->getClientOriginalExtension();
                $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.' . $fileextension;
        
                if ($file->move('images', $file_to_store)) {
                    
        
                    Photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $product->id,
                        'photoable_type' => 'App\Models\Product',
                        'ordering' => $i,
                    ]);
        
                    $i++;
                }
            }
        }
        return redirect()->route('admin.index')->withStatus(__('product successfully updated.'));
    //  return response()->json(['message' => 'product successfully updated.']);


    }

   
    public function destroy(Product $product)
    {
       
        $product->deleted_by = auth()->user()->id;
        if ($product->photos->isNotEmpty()) {
            foreach ($product->photos as $photo) {
                $filename = $photo->filename;
                unlink('images/' . $filename); 
                $photo->delete();
            }
        }
        
        $product->delete();
        return redirect()->route('admin.index')->withStatus(__('product successfully deleted.'));
    //  return response()->json(['message' => 'product successfully deleted.']);


    }
}
