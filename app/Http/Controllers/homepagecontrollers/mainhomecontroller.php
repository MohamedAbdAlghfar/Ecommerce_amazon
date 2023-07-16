<?php

namespace App\Http\Controllers\homepagecontrollers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\homepagecontrollers\mainhomecontroller;
use App\Http\Controllers\homepagecontrollers\Bestsellercontroller;

class mainhomecontroller extends Controller
{
    public function __construct() {
        // .. Best Seller Part
        // all have the same "Logic"..
        $this->best_books = DB::table('categories')->select('image','name','price')
        ->where('parent_id',1)->orderBy('Buy', 'desc')->take(10)->get();

        $this->best_kitchen = DB::table('categories')->select('image','name','price')
        ->where('parent_id',2)->orderBy('Buy', 'desc')->take(10)->get();

        $this->best_sports = DB::table('categories')->select('image','name','price')
        ->where('parent_id',3)->orderBy('Buy', 'desc')->take(10)->get();

        $this->best_electronics= DB::table('categories')->select('image','name','price')
        ->where('parent_id',4)->orderBy('credit', 'desc')->take(10)->get();

        $this->best_computers = DB::table('categories')->select('image','name','price')
        ->where('parent_id',5)->orderBy('credit', 'desc')->take(10)->get();

        $this->best_supermarket = DB::table('categories')->select('image','name','price')
        ->where('parent_id',6)->orderBy('credit', 'desc')->take(10)->get();

        $this->best_fashion = DB::table('categories')->select('image','name','price')
        ->where('parent_id',7)->orderBy('credit', 'desc')->take(10)->get();

        $this->best_home = DB::table('categories')->select('image','name','price')
        ->where('parent_id',8)->orderBy('credit', 'desc')->take(10)->get();

        $this->best_phones = DB::table('categories')->select('image','name','price')
        ->where('parent_id',9)->orderBy('credit', 'desc')->take(10)->get();

        $this->best_makeup = DB::table('categories')->select('image','name','price')
        ->where('parent_id',10)->orderBy('credit', 'desc')->take(10)->get();

    }
    public function getdata()
    {

        return view('homepage', compact(
        'best_books',
        'best_kitchen',
        'best_sports',
        'best_electronics',
        'best_computers',
        'best_supermarket',
        'best_fashion',
        'best_home',
        'best_phones',
        'best_makeup'));
    }
}
