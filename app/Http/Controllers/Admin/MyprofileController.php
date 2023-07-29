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
        $data = $request->all();
        if(isset($data['gender'])) {
            if($data['gender'] == 'male') {
                $data['gender'] = 0;
            }
            else{
                $data['gender'] = 1;
            }
        }
        $admin->update($data);


        if($file = $request->file('image')) {

            $filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.'.$fileextension;

            if($file->move('images', $file_to_store)) {
                if($admin->profile_image) {
                    $Photo = $admin->profile_image;

                    // remove the old image

                    $filename = $Photo;
                    if(file_exists('images/'.$filename)) {
                        // delete the file
                        unlink('images/'.$filename);
                    }

                    $admin->profile_image = $file_to_store;
$admin->save();
                }else {
                    $admin->profile_image = $file_to_store;
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
