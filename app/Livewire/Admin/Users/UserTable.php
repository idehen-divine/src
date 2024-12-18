<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use App\Livewire\DataTable;
use Laravel\Jetstream\Jetstream;

class UserTable extends Component
{
    use DataTable;

    public $showModal = false;
    public $user;
    public $showPhoto = false;
    public $showWalletModal = false;
    public $balance;

    public function delete($id)
    {
        dd($id);
        User::destroy($id);
    }

    public function wallet($id)
    {
        $this->user = User::find($id);
        $this->balance = $this->user->balance;
        $this->showWalletModal = true;
    }

    public function updateWallet()
    {
        $this->validate([
            'balance' => 'required|numeric',
        ]);

        $this->user->balance = $this->balance;
        $this->user->save();

        $this->dispatch('notification', [
            'message' => 'User balance updated successfully!',
            'type' => 'success',
        ]);

        $this->showWalletModal = false;
    }

    public function showUser($id)
    {
        $this->user = User::find($id);
        $this->showModal = true;
        Jetstream::managesProfilePhotos() ? ($this->showPhoto = true) : ($this->showPhoto = false);
    }

    public function toggleStatus($id)
    {
        $user = User::find($id);
        $user->is_active = !$user->is_active;
        $user->save();

        $this->dispatch('notification', [
            'message' => 'User status updated successfully!',
            'type' => 'success',
        ]);
    }

    public function render()
    {
        return view('admin.users.user-table', [
                'users' => $this->getUsers(),
            ]
        );
    }

    public function getUsers()
    {
        return User::where('role', 'USER')
            ->search($this->search)
            ->orderBy($this->column, $this->direction)
            ->paginate($this->perPage);
    }
}
