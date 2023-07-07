<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\photo;
use App\Models\Category;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin\Product\create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'Name' => 'required|min:5|max:150',
            'Available_Bices' => 'required',
            'Price' => 'required',
            'Brand' => 'required',
            'Color' => 'required',
            'Weight' => 'required',
            'Description' => 'required',
            'About' => 'required',
            'Parent_id' => 'required',
            'image' => 'required',                
        ]; 
        $this->validate($request, $rules);

        $Category = Category::create($request->merge(["Parent_id" => $request->get('Parent_id'),"Buy" => 0])->all());

        if($Category) {
            
            if($file = $request->file('image')) {

                $filename = $file->getClientOriginalName();
                $fileextension = $file->getClientOriginalExtension();
                $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.'.$fileextension;

                if($file->move('images', $file_to_store)) {
                    photo::create([
                        'Filename' => $file_to_store,
                        'photoable_id' => $Category->id,
                        'photoable_type' => 'App\Models\Category',
                    ]);
                }
            }
            return redirect('/admin')->withStatus('Product successfully created.');        }






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
