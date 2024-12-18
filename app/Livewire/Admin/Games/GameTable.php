<?php

namespace App\Livewire\Admin\Games;

use App\Models\Game;
use Livewire\Component;
use App\Livewire\DataTable;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class GameTable extends Component
{
    use DataTable, WithFileUploads;

    public $showCreateModal = false;
    public $id;
    public $name;
    public $description;
    public $price;
    public $reward;
    public $start_date;
    public $draw_time;
    public $photo_path;
    public $photo_url;
    public $gamePhoto;
    public $recurrence;

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'sometimes',
            'price' => 'required',
            'reward' => 'required',
            'start_date' => 'required|date',
            'recurrence' => 'required'
        ]);

        if ($this->gamePhoto) {
            $this->validate([
                'gamePhoto' => 'image|max:4096',
            ]);
        }

        $game = Game::updateOrCreate([
            'id' => $this->id,
        ], [
            'game_id' => strtolower(uniqid(helpers()->getInitials($this->name) . '_')),
            'name' => strtolower($this->name),
            'description' => strtolower($this->description),
            'price' => $this->price,
            'reward' => $this->reward,
            'start_date' => $this->start_date,
            'draw_time' => $this->draw_time,
            'recurrence' => strtolower($this->recurrence),
            'winning_numbers' => helpers()->generateLuckyNumbers(5),
        ]);

        if ($this->gamePhoto) {
            // Delete old photo if it exists
            if ($game->photo_path && Storage::disk('public')->exists($game->photo_path)) {
                Storage::disk('public')->delete($game->photo_path);
            }

            // Store new photo
            $filePath = $this->gamePhoto->store('game_photos', 'public');
            $game->update(['photo_path' => $filePath]);

            // Clear Livewire's temporary files
            Storage::disk('local')->deleteDirectory('livewire-tmp');
        }

        if ($game->wasRecentlyCreated) {
            $this->dispatch('notification', ['message' => 'Game created successfully!', 'type' => 'success']);
        } else {
            $this->dispatch('notification', ['message' => 'Game updated successfully!', 'type' => 'success']);
        }
        $this->toggleCreateModal();
    }

    public function gamePhotoUrl($photo_path = null)
    {
        $photo_url = $photo_path ? asset('storage/' . $photo_path) : asset('assets/images/games.jpg');
        return $photo_url;
    }

    public function update($id)
    {
        $this->toggleCreateModal();
        $game = Game::find($id);
        $this->id = $game->id;
        $this->name = $game->name;
        $this->description = $game->description;
        $this->price = $game->price;
        $this->reward = $game->reward;
        $this->start_date = $game->start_date;
        $this->draw_time =  $game->draw_time;
        $this->recurrence = $game->recurrence;
        $this->photo_path = $game->photo_path;
        $this->photo_url = $this->gamePhotoUrl($game->photo_path);
        $this->gamePhoto = null;
    }

    public function delete($id)
    {
        Game::destroy($id);
    }

    public function render()
    {
        return view('admin.games.game-table', [
            'games' => $this->getGames(),
        ]);
    }

    public function toggleCreateModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->name = null;
        $this->description = null;
        $this->price = null;
        $this->reward = null;
        $this->start_date = null;
        $this->draw_time = null;
        $this->recurrence = null;
        $this->photo_path = null;
        $this->photo_url = $this->gamePhotoUrl();
        $this->gamePhoto = null;
        $this->showCreateModal = !$this->showCreateModal;
    }

    public function toggleStatus($id)
    {
        $game = Game::find($id);
        $game->is_active = !$game->is_active;
        $game->save();

        $this->dispatch('notification', [
            'message' => 'Game status updated successfully!',
            'type' => 'success',
        ]);
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
}
