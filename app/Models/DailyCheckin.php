<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyCheckin extends Model
{
    protected $fillable = ['user_id', 'checked_in_at', 'plan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public static function checkin()
    {
        auth()->user()->plans->dailyCheckin()->create([
            'checked_in_at' => now(),
            'user_id' => auth()->id(),
        ]);
    }

    public static function deduct()
    {
        $amount = auth()->user()->plans->amount;
        $balance = auth()->user()->wallet->balance;
        if ($balance > $amount) {
            auth()->user()->wallet->decrement('balance', $amount);
            return true;
        }
        return false;
    }

    public static function transaction()
    {
        auth()->user()->transactions()->create([
            'transaction_reference' => 'dci_' . Str::random(12),
            'amount' => auth()->user()->plans->amount,
            'transaction_type' => 'debit',
            'status' => 'successful',
            'description' => 'Daily check-in',
            'processed_at' => now(),
        ]);
    }

    public static function getTodayCheckin()
    {
        return self::where('user_id', auth()->user()->id)
            ->where('plan_id', auth()->user()->plans->id)
            ->whereDate('checked_in_at', now()->format('Y-m-d'))
            ->first();
    }

    public static function getCheckinsForCalendar()
    {
        // Get the first check-in date, if it exists, otherwise use today
        $firstCheckin = self::where('user_id', auth()->user()->id)
            ->where('plan_id', auth()->user()->plans->id)
            ->orderBy('checked_in_at')
            ->first();

        // If the user has never checked in, use today as the starting point
        $startDate = $firstCheckin ? Carbon::parse($firstCheckin->checked_in_at)->format('Y-m-d') : now()->format('Y-m-d');

        // Generate 90 days starting from the start date (including the start day)
        $allDays = collect(range(0, 89))->map(function ($day) use ($startDate) {
            return Carbon::parse($startDate)->addDays($day)->format('Y-m-d');
        });

        // Get the check-in dates for the user in 'Y-m-d' format
        $checkins = self::where('user_id', auth()->user()->id)
            ->where('plan_id', auth()->user()->plans->id)
            ->whereDate('checked_in_at', '>=', $startDate)
            ->orderBy('checked_in_at')
            ->get();

        // Convert check-in dates to an array of 'Y-m-d' format
        $checkinDates = $checkins->pluck('checked_in_at')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d');
        })->toArray();

        // Map each day to its status
        $daysStatus = $allDays->mapWithKeys(function ($day) use ($checkinDates) {
            // If the day is in the future, mark it as 'remaining'
            if ($day > today()->format('Y-m-d')) {
                return [$day => 'remaining'];
            }

            // If the day is checked, mark it as 'checked'
            if (in_array($day, $checkinDates)) {
                return [$day => 'checked'];
            }

            // Otherwise, mark it as 'missed'
            return [$day => 'missed'];
        });

        return $daysStatus;
    }

    public static function currentStreak()
    {
        $checkins = self::where('user_id', auth()->user()->id)
            ->where('plan_id', auth()->user()->plans->id)
            ->orderBy('checked_in_at', 'desc')
            ->get();

        $currentStreak = 0;

        if (count($checkins) > 0) {
            $expectedDate = Carbon::parse($checkins[0]->checked_in_at)->format('Y-m-d');

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

    public static function longestStreak()
    {
        $checkins = self::where('user_id', auth()->user()->id)
            ->where('plan_id', auth()->user()->plans->id)
            ->orderBy('checked_in_at', 'asc')
            ->get();

        $longestStreak = 0;
        $currentStreak = 0;
        $previousDate = null;

        // Loop through the check-ins in order
        foreach ($checkins as $checkin) {
            $currentDate = Carbon::parse($checkin->checked_in_at)->format('Y-m-d');

            if ($previousDate && Carbon::parse($previousDate)->addDay()->format('Y-m-d') == $currentDate) {
                // Consecutive day, increment current streak
                $currentStreak++;
            } else {
                // Streak interrupted, reset current streak
                $currentStreak = 1; // Reset streak to 1 for the current day
            }

            // Update the longest streak if necessary
            $longestStreak = max($longestStreak, $currentStreak);

            $previousDate = $currentDate;
        }

        return $longestStreak;
    }
}
