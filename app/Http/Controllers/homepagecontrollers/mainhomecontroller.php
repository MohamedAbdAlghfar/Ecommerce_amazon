<?php

namespace App\Http\Controllers\homepagecontrollers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\homepagecontrollers\mainhomecontroller;
use App\Http\Controllers\homepagecontrollers\Bestsellercontroller;

class mainhomecontroller extends Controller
{
    public function getdata()
    {
        mainhomecontroller::get_fashion();
        mainhomecontroller::get_kitchen();
        mainhomecontroller::get_home();
        mainhomecontroller::get_sports();
        mainhomecontroller::get_books();
        mainhomecontroller::get_mobile_phones();
        mainhomecontroller::get_pc();
        mainhomecontroller::get_electronics();
        mainhomecontroller::get_makeup();
        mainhomecontroller::get_supermarket();

        // .. Best Seller Part ..
        Bestsellercontroller::best_computers();
        Bestsellercontroller::best_kitchen();
        Bestsellercontroller::best_home();
        Bestsellercontroller::best_books();
        Bestsellercontroller::best_electronics();
        Bestsellercontroller::best_supermarket();
        Bestsellercontroller::best_makeup();
        Bestsellercontroller::best_mobilephones();
        Bestsellercontroller::best_sports();
        Bestsellercontroller::get_computers();

        return view('homepage', compact('fashion',
        'kitchen',
        'books',
        'home',
        'pc',
        'sports',
        'electronics',
        'phones',
        'beauty_and_makeup',
        'supermarket'));
    }
}
