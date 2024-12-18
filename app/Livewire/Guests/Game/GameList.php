<?php

namespace App\Livewire\Guests\Game;

use App\Models\Game;
use Livewire\Component;

class GameList extends Component
{
    public function render()
    {
        return view('guest.game.game-list',[
                'games' => $this->getGames(),
            ]
        );
    }

    public function getGames()
    {
        $games = Game::paginate(6)
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
