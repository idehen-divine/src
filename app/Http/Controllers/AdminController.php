<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Ticket;

class AdminController extends Controller
{
    public function getAllUsers()
    {
        return view('admin.users.index');
    }

    public function transaction()
    {
        return view('admin.transaction.index');
    }

    public function settings()
    {
        return view('admin.settings.index');
    }
}
