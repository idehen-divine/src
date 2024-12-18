<?php

namespace App\Livewire\Admin\Tickets;

use App\Livewire\DataTable;
use App\Models\Ticket;
use Livewire\Component;

class TicketTable extends Component
{
    use DataTable;

    public $game;

    public function getTickets()
    {
        return Ticket::where('game_id', $this->game->id)->orderBy($this->column, $this->direction)
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

    public function render()
    {
        return view('admin.tickets.ticket-table', [
            'tickets' => $this->getTickets()
        ]);
    }
}
