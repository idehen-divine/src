<?php

namespace App\Livewire\User\Tickets;

use Livewire\Component;
use App\Livewire\DataTable;

class MyTickets extends Component
{
    use DataTable;

    public function render()
    {
        return view('user.tickets.my-tickets', [
            'closedTickets' => $this->getClosedTickets(),
            'openTickets' => $this->getOpenTickets(),
        ]);
    }

    public function getClosedTickets()
    {
        return helpers()->getAuthUser()->tickets()
            ->where('status', 'won')->orWhere('status', 'lost')
            ->with('game')->orderBy($this->column, $this->direction)
            ->paginate($this->perPage)->through(function ($ticket) {
                $ticket->game->photo_url = $this->gamePhotoUrl($ticket->game->photo_path);
                return $ticket;
            });
    }

    public function getOpenTickets()
    {
        return helpers()->getAuthUser()->tickets()
            ->where('status', 'pending')->with('game')
            ->orderBy($this->column, $this->direction)
            ->paginate($this->perPage)->through(function ($ticket) {
                $ticket->game->photo_url = $this->gamePhotoUrl($ticket->game->photo_path);
                return $ticket;
            });
    }

    public function gamePhotoUrl($photo_path = null)
    {
        $photo_url = $photo_path ? asset('storage/' . $photo_path) : asset('assets/images/games.jpg');
        return $photo_url;
    }
}
