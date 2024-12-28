<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateProfile()
    {
        return view('profile.update');
    }

    public function updateEmailView()
    {
        return view('auth.update-email');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'old-email' => 'required|email',
            'email' => 'required|email|unique:users',
        ]);

        if (auth()->user()->email != $request->input('old-email')) {
            return back()->withInput()->withErrors(['old-email' => 'Invalid old email']);
        }

        $user = auth()->user();
        $user->email = $request->email;
        $user->save();
        return redirect()->route('dashboard');
    }

    public function checkins()
    {
        $activePlan = Plan::getActivePlans();
        return view('user.plans.index', [
            'activePlan' => $activePlan,
        ]);
    }

    public function wallet()
    {
        return view('user.wallet.index');
    }

    public function transactions()
    {
        return view('user.transaction.index');
    }
}
