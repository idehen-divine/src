<?php

namespace App\Livewire\User\Dashboard;

use App\Models\DailyCheckin;
use App\Models\Plan;
use Livewire\Component;

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
        $this->getMissedDays();
        $this->checkedDays();
        $this->remainingDays();
    }

    public function getMissedDays()
    {
        $this->missedDays = Plan::getActivePlans() ? DailyCheckin::getMissedDays() : 0;
    }

    public function checkedDays()
    {
        $this->checkedDays = Plan::getActivePlans() ? DailyCheckin::getCheckedDays() : 0;
    }

    public function remainingDays()
    {
        $this->remainingDays = Plan::getActivePlans() ? DailyCheckin::getRemainingDays() : 0;
    }

    public function render()
    {
        return view('user.dashboard.index', [
            'totalDeposit' => $this->getTotalDeposit(),
            'totalWithdrawal' => $this->getTotalWithdrawal(),
            'totalInvested' => $this->getTotalInvested(),
        ]);
    }

    public function getTotalDeposit()
    {
        $deposit = new \stdClass();
        $deposit->amount = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'trx%')
            ->where('transaction_type', 'credit')
            ->sum('amount');

        $deposit->count = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'trx%')
            ->where('transaction_type', 'credit')
            ->count();

        $deposit->start_date = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'trx%')
            ->where('transaction_type', 'credit')
            ->min('created_at');

        $deposit->end_date = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'trx%')
            ->where('transaction_type', 'credit')
            ->max('created_at');
            
        return $deposit;
    }

    public function getTotalWithdrawal()
    {
        $withdrawal = new \stdClass();
        $withdrawal->amount = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'trx%')
            ->where('transaction_type', 'debit')
            ->sum('amount');

        $withdrawal->count = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'trx%')
            ->where('transaction_type', 'debit')
            ->count();

        $withdrawal->start_date = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'trx%')
            ->where('transaction_type', 'debit')
            ->min('created_at');

        $withdrawal->end_date = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'trx%')
            ->where('transaction_type', 'debit')
            ->max('created_at');

        return $withdrawal;
    }

    public function getTotalInvested()
    {
        $invested = new \stdClass();
        $invested->amount = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'dci%')
            ->where('transaction_type', 'debit')
            ->sum('amount');

        $invested->count = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'dci%')
            ->where('transaction_type', 'debit')
            ->count();

        $invested->start_date = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'dci%')
            ->where('transaction_type', 'debit')
            ->min('created_at');

        $invested->end_date = auth()->user()
            ->transactions()
            ->where('transaction_reference', 'like', 'dci%')
            ->where('transaction_type', 'debit')
            ->max('created_at');

        return $invested;
    }
}
