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

    public function getAllGames()
    {
        return view('admin.games.index');
    }

    public function getAllTickets(Game $game)
    {
        return view('admin.tickets.index', [
            'game' => $game
        ]);
    }

    public function getTicket(Ticket $ticket)
    {
        return view('admin.tickets.ticket', [
            'id' => $ticket
        ]);
    }

    public function transaction()
    {
        return view('admin.transaction.index');
    }

    public function winners()
    {
        return view('admin.winners.index');
    }
}
