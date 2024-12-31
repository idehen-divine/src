<?php

namespace App\Http\Controllers;

use App\Services\Paystack;
use Illuminate\Http\Request;

class PaystackController extends Controller
{
    public function webhook(Request $request)
    {
        return Paystack::webhook()->charge($request);
    }
}
