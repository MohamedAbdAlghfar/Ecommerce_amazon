<?php

namespace App\Http\Controllers\homepagecontrollers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Get_category_type_controller extends Controller
{
    public function Fashion()
    {
        return view('fashion');
    }
    public function Electronics()
    {
        return view('electronics');
    }
    public function Sport()
    {
        return view('sport');
    }
    public function Offers()
    {
        return view('offers');
    }
    public function Books()
    {
        return view('Books');
    }
    public function Mobile()
    {
        return view('fashion');
    }
    public function Kitchen()
    {
        return view('fashion');
    }
    public function Home()
    {
        return view('fashion');
    }
    public function Makeup_Beauty()
    {
        return view('makeup_beauty');
    }
    public function Pc()
    {
        return view('pc');
    }
}
