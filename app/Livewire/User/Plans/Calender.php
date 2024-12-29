<?php

namespace App\Livewire\User\Plans;

use App\Models\Plan;
use Livewire\Component;
use App\Models\DailyCheckin;
use Illuminate\Support\Facades\DB;

class Calender extends Component
{
    public function checkin()
    {
        if (DailyCheckin::getTodayCheckin()) {
            $this->dispatch('notification', [
                'message' => 'You have already checked in today',
                'type' => 'error',
            ]);
            return;
        }

        DB::beginTransaction();

        try {
            DailyCheckin::checkin();
            DailyCheckin::transaction();
            if (!DailyCheckin::deduct()) {
                DB::rollBack();
                $this->dispatch('notification', [
                    'message' => 'Insufficient balance',
                    'type' => 'error',
                ]);
                return;
            }
            
            if (Plan::getActivePlans()->currentDay() == 90) {
                Plan::getActivePlans()->returnCapital();
                Plan::getActivePlans()->returnInterest();
                Plan::getActivePlans()->hasExpired();
                $this->dispatch('notification', [
                    'message' => 'Congratulations, you\'ve completed day 90',
                    'type' => 'success',
                ]);

                DB::commit();
                $this->dispatch('redirect', url: route('checkins'));
                return;
            }

            DB::commit();
            $this->dispatch('notification', [
                'message' => 'Successfully checked in',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notification', [
                'message' => 'An error occurred during check-in. Please try again.',
                'type' => 'error',
            ]);
        }
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
