<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Photo;


class ShowProductPhotosController extends Controller
{
    
    public function showPhotos($id)
    {
        $product = Product::select('id','name')->find($id);
        $photos = $product->photos;
       
           return view('admin/Product/showPhotos',compact('product'));
      //  return response()->json($product);
    } 

    public function EditPhoto($id)
    {

        $photo = Photo::find($id);
           return view('admin/Product/editPhotos',compact('photo'));
      //  return response()->json($photo);
    }

    public function updatePhoto(Request $request,$id)
    {
        
        $photo = Photo::find($id);
        $photo->delete();
        // Remove the old image
        $oldFilename = $photo->filename;
        unlink('images/' . $oldFilename);
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $fileextension = $file->getClientOriginalExtension();
        $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.' . $fileextension;
        
        if ($file->move('images', $file_to_store)) {
                    
        
            Photo::create([
                'filename' => $file_to_store,
                'photoable_id' => $photo->photoable_id,
                'photoable_type' => 'App\Models\Product',
                'ordering' => $photo->ordering,
            ]);
        }
        $photo->delete();
        return redirect()->route('admin.index')->withStatus(__('photo successfully updated.'));
        //return response()->json(['message' => 'photo successfully updated.']);
    }

    public function destroy($id)
    {
        $photo = Photo::find($id);
        $photo->delete();
        $oldFilename = $photo->filename;
        unlink('images/' . $oldFilename);
        $photo->delete();
        //return redirect()->route('admin.index')->withStatus(__('photo successfully deleted.'));
        return response()->json(['message' => 'photo successfully deleted.']);
    }


    public function create($id)
    {
        $product = Product::find($id);
        //return view("admin/Product/createPhotos",compact('product')); 
         return response()->json(['message' => ' Create method called.']);  
    }

    public function store(Request $request,$id)
    {
        $rules = [
            'images' => 'required',                
                 ]; 
        $this->validate($request, $rules);

        $Product = Product::find($id);
        $largestNumber = $Product->photos()
        ->orderByDesc('ordering')
        ->value('ordering');
        
       
        if($Product) {
            
            if ($files = $request->file('images')) {
               $i = $largestNumber + 1;
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
            return redirect('/admin')->withStatus('Photos successfully created.');        
         // return response()->json(['message' => 'Photos successfully created.']);

        }



    }







}
