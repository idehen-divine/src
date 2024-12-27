<?php

namespace App\Livewire\User\Plans;

use App\Models\Plan;
use Livewire\Component;
use App\Models\DailyCheckin;
use Illuminate\Support\Facades\DB;

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
            return;
        }

        DB::beginTransaction();

        try {
            // Perform the check-in
            DailyCheckin::checkin();

            // Deduct balance
            if (!DailyCheckin::deduct()) {
                DB::rollBack(); // Rollback transaction on failure
                $this->dispatch('notification', [
                    'message' => 'Insufficient balance',
                    'type' => 'error',
                ]);
                return;
            }

            // Check if it's the 90th day
            if (Plan::getActivePlans()->currentDay() == 90) {
                Plan::getActivePlans()->hasExpired();

                $this->dispatch('notification', [
                    'message' => 'Congratulations, you\'ve completed day 90',
                    'type' => 'success',
                ]);

                DB::commit(); // Commit transaction
                $this->dispatch('redirect', url: route('checkins'));
                return;
            }

            DB::commit(); // Commit transaction if all operations are successful

            // Success notification for regular check-in
            $this->dispatch('notification', [
                'message' => 'Successfully checked in',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on exception
            $this->dispatch('notification', [
                'message' => 'An error occurred during check-in. Please try again.',
                'type' => 'error',
            ]);
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
