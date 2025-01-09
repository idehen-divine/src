<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use App\Livewire\DataTable;
use Illuminate\Support\Facades\DB;
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
        if ($this->user->wallet) {
            $this->balance = $this->user->wallet->balance;
            $this->showWalletModal = true;
        } else {
            $this->dispatch('notification', [
                'message' => 'This user has not updated their profile.',
                'type' => 'Error',
            ]);
        }
    }

    public function updateWallet()
    {
        $this->validate([
            'balance' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $oldBalance = $this->user->wallet->balance; // Current balance
            $newBalance = $this->balance; // New balance
            $balanceDifference = $newBalance - $oldBalance; // Calculate difference

            // Determine transaction type
            if ($balanceDifference > 0) {
                $transactionType = 'credit';
            } elseif ($balanceDifference < 0) {
                $transactionType = 'debit';
            } else {
                $transactionType = 'unchanged';
            }

            // Handle unchanged balance
            if ($transactionType === 'unchanged') {
                $this->dispatch('notification', [
                    'message' => 'No changes made to the user balance.',
                    'type' => 'info',
                ]);
                return;
            }

            // Perform wallet update
            if ($transactionType === 'credit') {
                $this->user->wallet->deposit(abs($balanceDifference), 'Admin wallet update');
            } elseif ($transactionType === 'debit') {
                $this->user->wallet->withdraw(abs($balanceDifference), 'Admin wallet update');
            }

            DB::commit();

            // Dispatch success notification
            $this->dispatch('notification', [
                'message' => 'User balance updated successfully! Amount ' .
                ($transactionType === 'credit' ? 'added: ' : 'deducted: ') .
                abs($balanceDifference),
                'type' => 'success',
            ]);
        } catch (\Exception $th) {
            DB::rollBack();

            // Dispatch error notification
            $this->dispatch('notification', [
                'message' => 'User balance update failed: ' . $th->getMessage(),
                'type' => 'error',
            ]);
        }

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
        return view(
            'admin.users.user-table',
            [
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
