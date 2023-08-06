<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\photo;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
   
    public function index()
    {
        // 
    }


    public function create()
    {
       // return view("Admin\Product\create");
        return response()->json(['message' => ' Create method called.']);
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
        $Product->fill($request->merge(["buy" => 0])->all());
        
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
           // return redirect('/admin')->withStatus('Product successfully created.');        
            return response()->json(['message' => 'product successfully created.']);

        }



    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
