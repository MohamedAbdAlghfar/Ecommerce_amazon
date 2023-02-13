<?php

namespace App\Http\Controllers\homepages;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class topnav extends Controller
{
    // all opponents in top nav

    public function get_fashion(){
        $fashion = DB::table('categories')->where('Parent_id',1)->get();
        return view('' ,compact('fashion'));
    }

    public function get_kitchen(){
        $kitchen = DB::table('categories')->where('Parent_id',2)->get();
        return view('' ,compact('kitchen'));
    }

    public function get_home(){
        $home = DB::table('categories')->where('Parent_id',3)->get();
        return view('' ,compact('home')); 
    }

    public function get_mobile_phones(){
        $phones = DB::table('categories')->where('Parent_id',4)->get();
        return view('' ,compact('phones'));
    }

    public function get_pc(){
        $pc = DB::table('categories')->where('Parent_id',5)->get();
        return view('' ,compact('pc'));
    }

    public function get_electronics(){
        $electronics = DB::table('categories')->where('Parent_id',6)->get();
        return view('' ,compact('electronics'));
    }

    public function get_sports(){
        $sports = DB::table('categories')->where('Parent_id',7)->get();
        return view('' ,compact('sports'));
    }

    public function get_books(){
        $books = DB::table('categories')->where('Parent_id',8)->get();
        return view('' ,compact('books'));
    }

    public function get_makeup(){
        $beauty_and_makeup = DB::table('categories')->where('Parent_id',9)->get();
        return view('' ,compact('beauty_and_makeup'));
    }

    public function get_supermarket(){
        $supermarket = DB::table('categories')->where('Parent_id',10)->get();
        return view('' ,compact('supermarket'));
    }

    // ..    ..

    public function get_offers(){
        $offers = DB::table('categories')->where('discount','>',0)->get();
        return view('' ,compact('offers'));
    }

}
