<?php

namespace App\Livewire\User\Transaction;

use Livewire\Component;
use App\Livewire\DataTable;
use Livewire\Attributes\On;

class Transaction extends Component
{
    use DataTable;

    public $wallet;

    #[On('refresh')] 
    public function render()
    {
        return view('user.transaction.transaction', [
            'transactions' => $this->getTransactions()
        ]);
    }

    public function getTransactions()
    {
        if($this->wallet){
            $transaction = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'trx%')
            ->search($this->search)
            ->orderBy($this->column, $this->direction)
            ->paginate($this->perPage);
        }else{
            $transaction = auth()->user()
            ->transactions()
            ->search($this->search)
            ->orderBy($this->column, $this->direction)
            ->paginate($this->perPage);
        }
        return $transaction;
    }

}
