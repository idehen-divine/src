<?php

namespace App\Livewire\Admin\Investments;

use App\Http\Middleware\User;
use stdClass;
use App\Models\Plan;
use Livewire\Component;
use App\Models\Transaction;

class Cards extends Component
{
    public function render()
    {
        return view('admin.investments.cards', [
            'planADetails' => $this->getPlanDetails(1),
            'planBDetails' => $this->getPlanDetails(2),
        ]);
    }

    public function getPlanDetails($planId)
    {
        $detail = new stdClass();

        $planTotalInvested = 0;
        Plan::where('plan', $planId)->get()->each(function ($plan) use (&$planTotalInvested) {
            $planTotalInvested += $plan->dailyCheckin->count() * $plan->amount;
        });
        $detail->totalInvested = $planTotalInvested;

        $planTotalRunningInvested = 0;
        Plan::where('plan', $planId)->where('status', 'active')->get()->each(function ($plan) use (&$planTotalRunningInvested) {
            $planTotalRunningInvested += $plan->dailyCheckin->count() * $plan->amount;
        });
        $detail->totalRunningInvested = $planTotalRunningInvested;

        $planTotalRunningInvestmentsUser = Plan::where('plan', $planId)
            ->where('status', 'active')->withCount('user')->get()->sum('user_count');
        $detail->totalRunningInvestmentsUser = $planTotalRunningInvestmentsUser;


        return $detail;
    }
}
