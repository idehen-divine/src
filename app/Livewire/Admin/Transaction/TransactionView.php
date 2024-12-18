<?php

namespace App\Livewire\Admin\Transaction;

use App\Models\User;
use Livewire\Component;
use App\Livewire\DataTable;
use App\Models\Transaction;

class TransactionView extends Component
{
    use DataTable;

    public $showDebitModal = false;
    public $showCreditModal = false;
    public $details;

    public function showTransaction($id)
    {
        $this->toggletransactionModal();
        $transaction = Transaction::find($id);
        if ($transaction->type == 'debit') {
            $this->showDebitModal = true;
        } else {
            $transaction->photo_url = $this->transactionPhotoUrl($transaction->photo_path);
            // dd($transaction->photo_url);
            $this->showCreditModal = true;

        }
        $this->details = $transaction;
    }

    public function toggletransactionModal()
    {
        $this->showDebitModal = false;
        $this->showCreditModal = false;
        $this->details = null;
    }

    public function fail()
    {
        Transaction::find($this->details->id)->update(['status' => 'failed']);
        $this->dispatch('notification', [
            'message' => 'Transaction updated successfully!',
            'type' => 'success',
        ]);
        $this->toggletransactionModal();
    }

    public function accept()
    {
        $transaction = Transaction::find($this->details->id);
        if ($transaction->type == 'debit') {
            $user = User::find($transaction->user_id);
            $user->balance = $user->balance - $transaction->amount;
            $user->save();
            $transaction->status = 'completed';
            $transaction->save();
        } else {
            $user = User::find($transaction->user_id);
            $user->balance = $user->balance + $transaction->amount;
            $user->save();
            $transaction->status = 'completed';
            $transaction->save();
        }
        $this->toggletransactionModal();
        $this->dispatch('notification', [
            'message' => 'Transaction updated successfully!',
            'type' => 'success',
        ]);
        $this->dispatch('notification', [
            'message' => 'User balance updated successfully!',
            'type' => 'success',
        ]);
    }

    public function render()
    {
        return view('admin.transaction.transaction-view',
            [
                'transactions' => $this->getTransactions(),
                'pendingTransactions' => $this->getPendingTransactions(),
            ]
        );
    }

    public function getTransactions()
    {
        return Transaction::where('status', '!=', 'pending')
            ->search($this->search)
            ->orderBy($this->column, $this->direction)
            ->paginate($this->perPage)
            ->through(function ($game) {
                $game->photo_url = $this->transactionPhotoUrl($game->photo_path);
                return $game;
            });
    }

    public function getPendingTransactions()
    {
        return Transaction::where('status', 'pending')
            ->search($this->search)
            ->orderBy($this->column, $this->direction)
            ->paginate($this->perPage)
            ->through(function ($transaction) {
                $transaction->photo_url = $this->transactionPhotoUrl($transaction->photo_path);
                return $transaction;
            });
    }

    public function transactionPhotoUrl($photo_path)
    {
        return $photo_path ? asset('storage/' . $photo_path) : null;
    }
}
