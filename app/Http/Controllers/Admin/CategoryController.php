<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\photo;
use Tymon\JWTAuth\Facades\JWTAuth;
class CategoryController extends Controller 
{
       // ------------------------------------------------ [ (REPORT) ] ------------------------------------------------------- //
    // this controller belong to {{Category Pages}}
      //details
           // functions
                // 1- create : return view to create category
                // 2- store  : store the category in database and save his image
                // 3- show   : show all category in web
                // 4- edit   : show specific category to edit
                // 5- update : update the category in database and his image
                // 6- destroy: delete specific category from database and delete his image and save data of admin that delete (soft delete)






    public function create() 
    {
        $category = Category::select('id','name')->orderBy('id', 'desc')->get();
      //  return view("Admin\Category\create",compact('category')); 
      return response()->json($category); 
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
                    photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $category->id,
                        'photoable_type' => 'App\Models\Category', 
                    ]);
                }
            }
        }   
       return redirect('/admin')->withStatus('category successfully created.');        
     //return response()->json(['message' => 'category successfully created.']);

    }
    
    public function show()
    {
        $category = Category::orderBy('categories.created_at', 'desc')->select('categories.name','categories.id','photoable.filename')
        ->join('photoable', function ($join) {
            $join->on('photoable.photoable_id', '=', 'categories.id')
            ->where('photoable.photoable_type', '=', 'App\Models\Category');
        })->get();
            return view('admin/Category/show',compact('category'));
       //  return response()->json($category); 
    }

    
    public function edit($category) 
    {
        

    
    
        $category = Category::select('categories.name','categories.id','photoable.filename','categories.parent_id')->join('photoable', function ($join) {
            $join->on('photoable.photoable_id', '=', 'categories.id')
            ->where('photoable.photoable_type', '=', 'App\Models\Category');
        })->find($category);
        $all_category    = Category::select('categories.name','categories.id')->get();
        $parent_id       = $category->parent_id; 
       if($parent_id == 0)
        $category_parent = Null ;     
       else       
        $category_parent = Category::find($parent_id);
        $data = [
               'category' => $category,
               'category_parent' => $category_parent,
               'all_category' => $all_category, 
                 ];
        

        return view('admin/Category/edit',compact('data'));
    //  return response()->json($data);

    } 

    
    public function update(Request $request,  Category $category)
    {
        
        $rules = [
            'name' => 'required|min:2|max:150',                                
                 ];

        $this->validate($request, $rules);
        $category->update($request->all());
        
        if ($file = $request->file('image')) { 
            $filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.' . $fileextension;
        
            if ($file->move('images', $file_to_store)) {
                if ($category->photo) {
                   
                      $photo = $category->photo;
        
                      // Remove the old image
                      $oldFilename = $photo->filename; 
                      unlink('images/' . $oldFilename);
                    
                    $photo->filename = $file_to_store;
                    $photo->save();
                } 
                else {
                    Photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $category->id,
                        'photoable_type' => 'App\Models\Category',
                    ]);
                }
            }
        }


    //    return redirect('/admin')->withStatus('category successfully updated.');
      return response()->json(['message' => 'category successfully updated.']);

    }


    public function destroy(Category $category)
    {
        
        $category->deleted_by = auth()->user()->id;
        if ($category->photo !== null) {
            if ($category->photo instanceof \Illuminate\Support\Collection) {
                foreach ($category->photo as $photo) {
                    $filename = $photo->filename;
                    unlink('images/' . $filename);
                    $photo->delete();
                }
            } else {
                $filename = $category->photo->filename;
                unlink('images/' . $filename);
                $category->photo->delete();
            }
        }
        
        $category->delete();
        return redirect()->route('admin.index')->withStatus(__('category successfully deleted.'));
   //       return response()->json(['message' => 'category successfully deleted.']);


    }
}
