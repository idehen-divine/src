<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function homePage()
    {
        return view('guest.home.index');
    }

    public function investmentsPlansPage()
    {
        return view('guest.plans.index');
    }

    public function faqsPage()
    {
        return view('guest.faqs.index');
    }

    public function aboutUsPage()
    {
        return view('guest.about.index');
    }

    public function contactUsPage()
    {
        return view('guest.contact.index');
    }
}
