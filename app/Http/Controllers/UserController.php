<?php

namespace App\Http\Controllers;

use App\Models\Plan;

class UserController extends Controller
{
    public function updateProfile()
    {
        return view('profile.update');
    }

    public function checkins()
    {
        $activePlan = Plan::getActivePlans();
        return view('user.plans.index', [
            'activePlan' => $activePlan,
        ]);
    }
}
