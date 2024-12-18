<?php

namespace App\Livewire\User\Tickets;

use App\Models\Game;
use App\Models\Ticket;
use Livewire\Component;
use App\Livewire\DataTable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TicketsLists extends Component
{
    use DataTable;

    public $buyTicket;
    public $quantity = 0;
    public $showBuyTicketModal = false;

    public function toggleBuyTicketModal($id)
    {
        $this->showBuyTicketModal = true;
        $this->buyTicket = null;
        $this->buyTicket = $this->getGame($id);
    }

    public function toggleBuyTicketModalClose()
    {
        $this->quantity = 0;
        $this->buyTicket = null;
        $this->showBuyTicketModal = false;
    }

    public function addTicket()
    {
        $this->quantity++;
    }

    public function decreaseTicket()
    {
        $this->quantity--;
    }

    public function purchaseTicket()
    {
        $this->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $user = helpers()->getAuthUser();

        if ($user->balance < $this->buyTicket->price * $this->quantity) {
            $this->dispatch('notification', [
                'message' => 'Insufficient balance!',
                'type' => 'error'
            ]);
            $this->toggleBuyTicketModalClose();
            return;
        }

        $dbTransaction = DB::transaction(function () use ($user) {
            for ($i = 0; $i < $this->quantity; $i++) {
                $user->tickets()->create([
                    'game_id' => $this->buyTicket->id,
                    'ticket_number' => Str::upper(Str::random(16)),
                    'numbers' => helpers()->generateLuckyNumbers(3),
                ]);

                $user->decrement('balance', $this->buyTicket->price);

                $user->transactions()->create([
                    'reference' => Str::uuid(),
                    'amount' => $this->buyTicket->price,
                    'type' => 'debit',
                    'status' => 'completed',
                    'description' => 'Ticket purchase for game: ' . ucwords($this->buyTicket->name),
                ]);
            }
            return true;
        });

        $this->toggleBuyTicketModalClose();

        $this->dispatch('notification', [
            'message' => $dbTransaction ? 'Tickets purchased successfully!' : 'Failed to purchase tickets!',
            'type' => $dbTransaction ? 'success' : 'error',
        ]);
    }

    public function getGame($id)
    {
        $game = Game::find($id);
        if ($game) {
            $game->photo_url = $this->gamePhotoUrl($game->photo_path);
        }
        return $game;
    }

    public function render()
    {
        return view(
            'user.tickets.tickets-lists',
            [
                'games' => $this->getGames(),
            ]
        );
    }

    public function getGames()
    {
        $games = Game::search($this->search)
            ->orderBy($this->column, $this->direction)
            ->paginate($this->perPage)
            ->through(function ($game) {
                $game->photo_url = $this->gamePhotoUrl($game->photo_path);
                return $game;
            });

        return $games;
    }

    public function gamePhotoUrl($photo_path = null)
    {
        $photo_url = $photo_path ? asset('storage/' . $photo_path) : asset('assets/images/games.jpg');
        return $photo_url;
    }

    public function placeholder()
    {
        return <<<'HTML'
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10  mx-auto px-4 py-8">
                <div class="flex flex-col justify-between items-center border border-2 dark:border-gray-800 border-gray-200 rounded-lg p-5">
                    <div class="w-full flex flex-row justify-between">
                        <div
                            class="skeleton w-[70px] h-[70px] md:w-[140px] md:h-[140px] rounded-md dark:bg-gray-800 bg-gray-200">
                        </div>
                        <div class="flex flex-col gap-4 mt-2">
                            <div class="skeleton h-2 w-40 md:w-[240px] dark:bg-gray-800 bg-gray-200"></div>
                            <div class="skeleton h-4 w-40 md:w-[240px] dark:bg-gray-800 bg-gray-200"></div>
                            <div class="skeleton h-2 w-40 md:w-[240px] dark:bg-gray-800 bg-gray-200"></div>
                        </div>
                    </div>
                    <div class="skeleton h-10 w-2/4 rounded-full dark:bg-gray-800 bg-gray-200 px-4 py-2 mt-5"></div>
                </div>
                <div class="flex flex-col justify-between items-center border border-2 dark:border-gray-800 border-gray-200 rounded-lg p-5">
                    <div class="w-full flex flex-row justify-between">
                        <div
                            class="skeleton w-[70px] h-[70px] md:w-[140px] md:h-[140px] rounded-md dark:bg-gray-800 bg-gray-200">
                        </div>
                        <div class="flex flex-col gap-4 mt-2">
                            <div class="skeleton h-2 w-40 md:w-[240px] dark:bg-gray-800 bg-gray-200"></div>
                            <div class="skeleton h-4 w-40 md:w-[240px] dark:bg-gray-800 bg-gray-200"></div>
                            <div class="skeleton h-2 w-40 md:w-[240px] dark:bg-gray-800 bg-gray-200"></div>
                        </div>
                    </div>
                    <div class="skeleton h-10 w-2/4 rounded-full dark:bg-gray-800 bg-gray-200 px-4 py-2 mt-5"></div>
                </div>
            </div>
        HTML;
    }
}
