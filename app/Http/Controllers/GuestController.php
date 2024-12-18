<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function homePage()
    {
        return view('guest.home-page');
    }

    public function playNowPage()
    {
        //
    }

    public function resultPage()
    {
        return view('guest.results.index');
    }

    public function faqsPage()
    {
        //
    }   

    public function contactUsPage()
    {
        return view('guest.contact.index');
    }
}
