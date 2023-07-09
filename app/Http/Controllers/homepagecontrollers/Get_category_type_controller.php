<?php

namespace App\Http\Controllers\homepagecontrollers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Get_category_type_controller extends Controller
{
    //functions of the cards in home page 

    public function get_fashion(){
        $fashion = DB::table('categories')->where('Parent_id',1)->get();
        return $fashion;
    }

    public function get_kitchen(){
        $kitchen = DB::table('categories')->where('Parent_id',2)->get();
        return $kitchen;
    }

    public function get_home(){
        $home = DB::table('categories')->where('Parent_id',3)->get();
        return $home;
    }

    public function get_mobile_phones(){
        $phones = DB::table('categories')->where('Parent_id',4)->get();
        return $phones;
    }

    public function get_pc(){
        $pc = DB::table('categories')->where('Parent_id',5)->get();
        return $pc;
    }

    public function get_electronics(){
        $electronics = DB::table('categories')->where('Parent_id',6)->get();
        return $electronics;
    }

    public function get_sports(){
        $sports = DB::table('categories')->where('Parent_id',7)->get();
        return $sports;
    }

    public function get_books(){
        $books = DB::table('categories')->where('Parent_id',8)->get();
        return $books;
    }

    public function get_makeup(){
        $beauty_and_makeup = DB::table('categories')->where('Parent_id',9)->get();
        return $beauty_and_makeup;
    }

    public function get_supermarket(){
        $supermarket = DB::table('categories')->where('Parent_id',10)->get();
        return $supermarket;
    }

}
