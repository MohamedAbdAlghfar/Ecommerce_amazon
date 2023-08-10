<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
class CategoryController extends Controller
{
    
    public function index()
    {
        //
    }

   
    public function create() 
    {
      //  return view("Admin\Category\create"); 
      return response()->json(['message' => ' Create method called.']); 
    }

    
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|max:150',
            'image' => 'required',  
            'parent_id' => 'required',              
        ]; 
        $this->validate($request, $rules);
        $category = Category::create($request->merge(["parent_id" => $request->get('parent_id')])->all());
        $category->save();
        if($category) {
            
            if($file = $request->file('image')) {

                $filename = $file->getClientOriginalName();
                $fileextension = $file->getClientOriginalExtension();
                $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.'.$fileextension;

                if($file->move('images', $file_to_store)) {
                    $Photo = $category->image;
                    $filename = $Photo;
                    $category->image = $file_to_store;
                    $category->save();




                }
            }






    }
 // return redirect('/admin')->withStatus('category successfully created.');        
return response()->json(['message' => 'category successfully created.']);

    }
    
    public function show()
    {
        $category = Category::orderBy('created_at', 'desc')->get();
     //   return view('admin/Category/show',compact('category'));
      return response()->json($category);

    }

    
    public function edit(Category $category)
    {
        
  // return view('admin/Category/edit',compact('category'));
  return response()->json($category);




    }

    
    public function update(Request $request,  Category $category)
    {
        
        $rules = [
            'name' => 'required|min:5|max:150',            
            'image' => 'required',                
        ];

        $this->validate($request, $rules);
        $category->update($request->all());
     
     
     
        if($file = $request->file('image')) {

            $filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.'.$fileextension;

            if($file->move('images', $file_to_store)) {
                if($category->image) {
                    $Photo = $category->image;

                    // remove the old image

                    $filename = $Photo;
                    if(file_exists('images/'.$filename)) {
                        // delete the file
                        unlink('images/'.$filename);
                    }

                    $category->image = $file_to_store;
$category->save();
                }else {
                    $category->image = $file_to_store;
                }
            }
        }


     //   return redirect('/admin')->withStatus('category successfully updated.');
     return response()->json(['message' => 'category successfully updated.']);



    }


    public function destroy(Category $category)
    {
        

        if ($category->image) {
            
                $filename = $category->image;
                unlink('images/' . $filename);
                $imagePath = $category->image;

                if ($imagePath) {
                    Storage::delete($imagePath);
                    $category->update(['image' => 'default.jpeg']); // Remove the image path from the category
                }
            
        }
        
        $category->delete();
       // return redirect()->route('admin.index')->withStatus(__('category successfully deleted.'));
        return response()->json(['message' => 'category successfully deleted.']);







    }
}
