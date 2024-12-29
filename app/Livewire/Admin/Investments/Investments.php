<?php

namespace App\Livewire\Admin\Investments;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Investments extends Component
{
    use WithPagination;

    public $planAdirection = 'DESC';
    public $planBdirection = 'DESC';
    public $planAColumn = 'joined_at';
    public $planBColumn = 'joined_at';
    public $planAPerPage = 10;
    public $planBPerPage = 10;

    public function updatingPlanAdirection()
    {
        $this->resetPage();
    }

    public function updatingPlanBdirection()
    {
        $this->resetPage();
    }

    public function updatingPlanAColumn()
    {
        $this->resetPage();
    }

    public function updatingPlanBColumn()
    {
        $this->resetPage();
    }

    public function updatingPlanAPerPage()
    {
        $this->resetPage();
    }

    public function updatingPlanBPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.investments.investments', [
            'planAUsers' => $this->planAUsers(),
            'planBUsers' => $this->planBUsers(),
        ]);
    }

    public function planAUsers()
    {
        $users = User::whereHas('plans', function ($query) {
            $query->where('plan', 1);
        })
            ->with(['plans', 'dailyCheckin'])
            ->paginate($this->planAPerPage);

        $users->getCollection()->transform(function ($user) {
            $user->current_streak = $this->currentStreak($user);
            $user->longest_streak = $this->longestStreak($user);
            $user->total_invested = $user->plans ? ($user->plans->amount * $user->dailyCheckin->count()) : 0;
            $user->total_checked_in = $user->dailyCheckin->count();
            $user->last_checkin = $user->dailyCheckin->max('checked_in_at');
            $user->joined_at = $user->dailyCheckin->min('checked_in_at');
            return $user;
        });

        $sortedUsers = $users->getCollection()->sortBy(function ($user) {
            return $user->{$this->planAColumn};
        }, SORT_REGULAR, $this->planAdirection === 'DESC');

        $users->setCollection($sortedUsers);

        return $users;
    }

    public function planBUsers()
    {
        $users = User::whereHas('plans', function ($query) {
            $query->where('plan', 2);
        })
            ->with(['plans', 'dailyCheckin'])
            ->paginate($this->planAPerPage);

        $users->getCollection()->transform(function ($user) {
            $user->current_streak = $this->currentStreak($user);
            $user->longest_streak = $this->longestStreak($user);
            $user->total_invested = $user->plans ? ($user->plans->amount * $user->dailyCheckin->count()) : 0;
            $user->total_checked_in = $user->dailyCheckin->count();
            $user->last_checkin = $user->dailyCheckin->max('checked_in_at');
            $user->joined_at = $user->dailyCheckin->min('checked_in_at');
            return $user;
        });

        $sortedUsers = $users->getCollection()->sortBy(function ($user) {
            return $user->{$this->planAColumn};
        }, SORT_REGULAR, $this->planAdirection === 'DESC');

        $users->setCollection($sortedUsers);

        return $users;
    }

    public function currentStreak($user)
    {
        $checkins = $user->dailyCheckin;
        $currentStreak = 0;

        if ($checkins->isNotEmpty()) {
            $expectedDate = Carbon::parse($checkins->first()->checked_in_at)->format('Y-m-d');

            if ($expectedDate == today()->format('Y-m-d') || $expectedDate == today()->subDay()->format('Y-m-d')) {
                foreach ($checkins as $checkin) {
                    $checkinDate = Carbon::parse($checkin->checked_in_at)->format('Y-m-d');

                    if ($checkinDate == $expectedDate) {
                        $currentStreak++;
                        $expectedDate = Carbon::parse($expectedDate)->subDay()->format('Y-m-d');
                    } else {
                        break;
                    }
                }
            }
        }

        return $currentStreak;
    }

    public function longestStreak($user)
    {
        $checkins = $user->dailyCheckin->sortBy('checked_in_at');
        $longestStreak = 0;
        $currentStreak = 0;
        $previousDate = null;

        foreach ($checkins as $checkin) {
            $currentDate = Carbon::parse($checkin->checked_in_at)->format('Y-m-d');

            if ($previousDate && Carbon::parse($previousDate)->addDay()->format('Y-m-d') == $currentDate) {
                $currentStreak++;
            } else {
                $currentStreak = 1;
            }

            $longestStreak = max($longestStreak, $currentStreak);
            $previousDate = $currentDate;
        }

        return $longestStreak;
    }
}
