<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class MyprofileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit()
    {
        $admin = User::where('id', 2)->first();
        return view('Admin.Myprofile.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $admin = User::where('id', 2)->first();
        $admin->update($request->all());


        if($file = $request->file('image')) {

            $Filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $Filename)[0] . '_.'.$fileextension;

            if($file->move('images', $file_to_store)) {
                if($admin->Photo) {
                    $Photo = $admin->Photo;

                    // remove the old image

                    $Filename = $Photo->Filename;
                    if(file_exists('images/'.$Filename)) {
                        // delete the file
                        unlink('images/'.$Filename);
                    }

                    $Photo->Filename = $file_to_store;
                    $Photo->save();
                }else {
                    Photo::create([
                        'Filename' => $file_to_store,
                        'photoable_id' => $admin->id,
                        'photoable_type' => 'App\Models\User',
                    ]);
                }
            }
        }


        return redirect('/admin')->withStatus('Product successfully created.');


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
