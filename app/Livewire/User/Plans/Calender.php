<?php

namespace App\Livewire\User\Plans;

use Livewire\Component;
use App\Models\DailyCheckin;
use App\Models\Plan;

class Calender extends Component
{
    public $streak;

    public function checkin()
    {
        if (DailyCheckin::getTodayCheckin()) {
            $this->dispatch('notification', [
                'message' => 'You have already checked in today',
                'type' => 'error',
            ]);
        } else {
            if (Plan::getActivePlans()->currentDay() == 90) {
                DailyCheckin::checkin();
                Plan::getActivePlans()->hasExpired();
                $this->dispatch('notification', [
                    'message' => 'Congratulation you\'ve completed day 90',
                    'type' => 'success',
                ]);
                $this->dispatch('redirect', url: route('checkins'));
            } else {
                DailyCheckin::checkin();
                $this->dispatch('notification', [
                    'message' => 'Successfully checked in',
                    'type' => 'success',
                ]);
            }
        }
    }

    public function mount()
    {
        // $this->streak = auth()->user()->dailyCheckins->streak;
    }

    public function render()
    {
        return view('user.plans.calender', [
            'checkinsForCalendar' => DailyCheckin::getCheckinsForCalendar(),
            'today' => now()->format('Y-m-d'),
            'currentDay' => Plan::first()->currentDay(),
            'checkedin' => DailyCheckin::getTodayCheckin(),
            'currentStreak' => DailyCheckin::currentStreak(),
            'longestStreak' => DailyCheckin::longestStreak(),
        ]);
    }
}
