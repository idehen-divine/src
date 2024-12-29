<?php

namespace App\Livewire\Admin\Transaction;

use App\Models\User;
use Livewire\Component;
use App\Livewire\DataTable;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionView extends Component
{
    use DataTable;

    public function decline($id)
    {
        DB::beginTransaction();
        try {
            $transaction = Transaction::find($id);
            $transaction->status = 'failed';
            $transaction->processed_at = now();
            $transaction->save();
            $user = $transaction->user;
            $user->wallet->balance += $transaction->amount;
            $user->wallet->save();

            DB::commit();
            $this->dispatch('notification', [
                'message' => 'Transaction declined successfully',
                'type' => 'success'
            ]);
        } catch (\Exception $th) {
            DB::rollBack();
            $this->dispatch('notification', [
                'message' => 'Transaction declined failed' . $th->getMessage(),
                'type' => 'error'
            ]);
        }
    }

    public function accept($id)
    {
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
            ->paginate($this->perPage);
    }

    public function getPendingTransactions()
    {
        return Transaction::where('status', 'pending')
            ->search($this->search)
            ->orderBy($this->column, $this->direction)
            ->paginate($this->perPage);
    }
}
