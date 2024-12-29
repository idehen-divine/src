<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Plan;
use App\Models\User;
use Livewire\Component;
use App\Models\Transaction as TransactionModel;

class Dashboard extends Component
{
    public $wallet;
    public $bank;
    public $plan;
    public $missedDays;
    public $checkedDays;
    public $remainingDays;

    public function boot()
    {
        $this->wallet = auth()->user()->wallet;
        $this->bank = auth()->user()->bank;
        $this->plan = Plan::getActivePlans();
    }

    public function render()
    {
        return view('admin.dashboard.index', [
            'totalUsers' => $this->getTotalUsers(),
            'totalDeposit' => $this->getTotalDeposit(),
            'totalWithdrawal' => $this->getTotalWithdrawal(),
            'totalInvested' => $this->getTotalInvested(),
            'totalAdminDeposit' => $this->getTotalAdminDeposit(),
            'totalAdminWithdrawal' => $this->getTotalAdminWithdrawal(),
            'totalInvested' => $this->getTotalInvested(),
            'totalWithdrawnInterest' => $this->getTotalWithdrawnInterest(),
            'totalFailedTransactions' => $this->getTotalFailedTransactions(),
        ]);
    }

    public function getTotalUsers()
    {
        $users = new \stdClass();
        $users->count = User::where('role', 'USER')->count();
        $users->start_date = User::where('role', 'USER')->min('created_at');
        $users->end_date = User::where('role', 'USER')->max('created_at');
        return $users;
    }

    public function getTotalDeposit()
    {
        $deposit = new \stdClass();
        $deposit->amount = TransactionModel::where('transaction_reference', 'like', 'trx%')
            ->where('transaction_type', 'credit')->where('status', 'successful')
            ->sum('amount');

        $deposit->count = TransactionModel::where('transaction_reference', 'like', 'trx%')
            ->where('transaction_type', 'credit')->where('status', 'successful')
            ->count();

        $deposit->start_date = TransactionModel::where('transaction_reference', 'like', 'trx%')
            ->where('transaction_type', 'credit')->where('status', 'successful')
            ->min('created_at');

        $deposit->end_date = TransactionModel::where('transaction_reference', 'like', 'trx%')
            ->where('transaction_type', 'credit')->where('status', 'successful')
            ->max('created_at');

        return $deposit;
    }

    public function getTotalAdminDeposit()
    {
        $deposit = new \stdClass();
        $deposit->amount = TransactionModel::where('transaction_reference', 'like', 'adc%')
        ->where('transaction_type', 'credit')->where('status', 'successful')
        ->sum('amount');

        $deposit->count = TransactionModel::where('transaction_reference', 'like', 'adc%')
        ->where('transaction_type', 'credit')->where('status', 'successful')
        ->count();

        $deposit->start_date = TransactionModel::where('transaction_reference', 'like', 'adc%')
        ->where('transaction_type', 'credit')->where('status', 'successful')
        ->min('created_at');

        $deposit->end_date = TransactionModel::where('transaction_reference', 'like', 'adc%')
        ->where('transaction_type', 'credit')->where('status', 'successful')
        ->max('created_at');

        return $deposit;
    }

    public function getTotalWithdrawal()
    {
        $withdrawal = new \stdClass();
        $withdrawal->amount = TransactionModel::where('transaction_reference', 'like', 'trx%')
        ->where('transaction_type', 'debit')->where('status', 'successful')
        ->sum('amount');

        $withdrawal->count = TransactionModel::where('transaction_reference', 'like', 'trx%')
        ->where('transaction_type', 'debit')->where('status', 'successful')
        ->count();

        $withdrawal->start_date = TransactionModel::where('transaction_reference', 'like', 'trx%')
        ->where('transaction_type', 'debit')->where('status', 'successful')
        ->min('created_at');

        $withdrawal->end_date = TransactionModel::where('transaction_reference', 'like', 'trx%')
        ->where('transaction_type', 'debit')->where('status', 'successful')
        ->max('created_at');

        return $withdrawal;
    }

    public function getTotalAdminWithdrawal()
    {
        $withdrawal = new \stdClass();
        $withdrawal->amount = TransactionModel::where('transaction_reference', 'like', 'adb%')
        ->where('transaction_type', 'debit')->where('status', 'successful')
        ->sum('amount');

        $withdrawal->count = TransactionModel::where('transaction_reference', 'like', 'adb%')
        ->where('transaction_type', 'debit')->where('status', 'successful')
        ->count();

        $withdrawal->start_date = TransactionModel::where('transaction_reference', 'like', 'adb%')
        ->where('transaction_type', 'debit')->where('status', 'successful')
        ->min('created_at');

        $withdrawal->end_date = TransactionModel::where('transaction_reference', 'like', 'adb%')
        ->where('transaction_type', 'debit')->where('status', 'successful')
        ->max('created_at');

        return $withdrawal;
    }

    public function getTotalInvested()
    {
        $invested = new \stdClass();
        $invested->amount = TransactionModel::where('transaction_reference', 'like', 'dci%')
            ->where('transaction_type', 'debit')
            ->sum('amount');

        $invested->count = TransactionModel::where('transaction_reference', 'like', 'dci%')
            ->where('transaction_type', 'debit')
            ->count();

        $invested->start_date = TransactionModel::where('transaction_reference', 'like', 'dci%')
            ->where('transaction_type', 'debit')
            ->min('created_at');

        $invested->end_date = TransactionModel::where('transaction_reference', 'like', 'dci%')
            ->where('transaction_type', 'debit')
            ->max('created_at');

        return $invested;
    }

    public function getTotalWithdrawnInterest()
    {
        $interest = new \stdClass();
        $interest->amount = TransactionModel::where('transaction_reference', 'like', 'pii%')
            ->where('transaction_type', 'credit')
            ->sum('amount');

        $interest->count = TransactionModel::where('transaction_reference', 'like', 'pii%')
            ->where('transaction_type', 'credit')
            ->count();

        return $interest;
    }

    public function getTotalFailedTransactions()
    {
        $failed = new \stdClass();
        $failed->count = TransactionModel::where('status', 'failed')
            ->count();

        return $failed;
    }
}
