<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateProfile()
    {
        return view('profile.update');
    }

    public function getAllTickets()
    {
        return view('user.tickets.index');
    }

    public function getUserTickets()
    {
        return view('user.tickets.tickets');
    }

    public function getTicket(Ticket $ticket)
    {
        return view('user.tickets.ticket', [
            'id' => $ticket
        ]);
    }

    public function getUserHistory()
    {
        return view('user.history.index');
    }

    public function getUserWallet()
    {
        return view('user.wallet.index');
    }
}
