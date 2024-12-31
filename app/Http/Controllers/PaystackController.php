<?php

namespace App\Http\Controllers;

use App\Services\Paystack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaystackController extends Controller
{
    public function webhook(Request $request)
    {
        Log::info($request->input());
        return Paystack::webhook()->charge($request);
    }
}
