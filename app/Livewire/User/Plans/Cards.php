<?php

namespace App\Livewire\User\Plans;

use App\Models\Plan;
use Livewire\Component;

class Cards extends Component
{
    public function subscribe($plan)
    {
        if (!Plan::getActivePlans()) {
            auth()->user()->plans()->create([
                'plan' => $plan,
                'start_date' => now(),
                'end_date' => now()->addDays(90),
            ]);

            $this->dispatch('notification', [
                'message' => 'Successfully subscribe to a plan',
                'type' => 'success',
            ]);
            $this->dispatch('redirect', url: route('checkins'));
        } else {
            
            $this->dispatch('notification', [
                'message' => 'User already subscribed to a plan. Pls wait while redirect',
                'type' => 'error',
            ]);
            $this->dispatch('redirect', url: route('checkins'));
        }
    }

    public function render()
    {
        return view('user.plans.cards');
    }
}
