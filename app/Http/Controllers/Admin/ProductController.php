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
        return view("Admin\Product\create");
     //    return response()->json(['message' => ' Create method called.']); 
    }

    
    public function store(Request $request)
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
            
            'image' => 'required',                
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
            
            if($file = $request->file('image')) {

                $filename = $file->getClientOriginalName();
                $fileextension = $file->getClientOriginalExtension();
                $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.'.$fileextension;

                if($file->move('images', $file_to_store)) {
                    photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $Product->id,
                        'photoable_type' => 'App\Models\Product', 
                    ]);
                }
            }
            return redirect('/admin')->withStatus('Product successfully created.');        
       //     return response()->json(['message' => 'product successfully created.']);

        }



    }

    
    public function show()
    {

        $product = Product::select('id','name','available_pieces','store_id')->orderBy('store_id', 'asc')->get();
        return view('admin/Product/show',compact('product'));
     //  return response()->json($product);
    }

    
    public function edit(Product $product)
    {
        return view('admin/Product/edit',compact('product'));
     //  return response()->json($product); 
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


        if ($file = $request->file('image')) {
            $filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.' . $fileextension;
        
            if ($file->move('images', $file_to_store)) {
                if ($product->Photos) {
                   foreach($product->Photos as $product->Photos){
                    $photo = $product->Photos;
        
                    // Remove the old image
                    $oldFilename = $photo->filename;
                    unlink('images/' . $oldFilename);
                }
                    $photo->filename = $file_to_store;
                    $photo->save();
                } else {
                    Photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $product->id,
                        'photoable_type' => 'App\Models\Product',
                    ]);
                }
            }
        }
  return redirect()->route('admin.index')->withStatus(__('product successfully updated.'));
// return response()->json(['message' => 'product successfully updated.']);


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
