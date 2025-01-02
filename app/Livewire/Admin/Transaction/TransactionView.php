<?php

namespace App\Livewire\Admin\Transaction;

use App\Models\User;
use Livewire\Component;
use App\Livewire\DataTable;
use App\Models\Transaction;
use App\Services\Paystack;
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
        DB::beginTransaction();
        try {
            $transaction = Transaction::find($id);
            $user = $transaction->user;
            $bank = $user->bank;

            if (!$bank->recipient_code) {
                $recipient_code = Paystack::transfer()->recipient()->create(($user->first_name . ' ' . $user->last_name), $bank->bank_code, $bank->account_number);

                if ($recipient_code['status'] == false) {
                    throw new \Exception($recipient_code['message']);
                }

                $bank->recipient_code = $recipient_code['data']['recipient_code'];
                $bank->save();
            }

            $balance = Paystack::transfer()->balance()['data'][0]['balance'];
            if ($balance < ($transaction->amount * 100)) {
                throw new \Exception('Insufficient balance');
            }

            $transfer = Paystack::transfer()->create($bank->recipient_code, ($transaction->amount * 100), $transaction->transaction_reference);
            if ($transfer['status'] == false) {
                throw new \Exception($transfer['message']);
            }
            $transaction->status = 'processing';
            $transaction->save();

            DB::commit();
            $this->dispatch('notification', [
                'message' => 'Transaction accepted successfully',
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
