<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'plan', 'status', 'start_date', 'end_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dailyCheckin()
    {
        return $this->hasMany(DailyCheckin::class);
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function isExpired()
    {
        return $this->status === 'expired';
    }

    public function hasExpired()
    {
        $this->status = 'expired';
        $this->save();
    }

    public function currentDay()
    {
        $currentDate = now();
        $startDate = \Carbon\Carbon::parse($this->start_date);
        $currentDate = \Carbon\Carbon::parse($currentDate);
        $difference = $currentDate->diffInDays($startDate);
        if ($difference < 0 || $difference >= 90) {
            return null;
        }
        return $difference + 1;
    }

    public static function getActivePlans()
    {
        return self::where('user_id', auth()->user()->id)
            ->where('status', 'active')
            ->where('end_date', '>=', today()->format('Y-m-d'))
            ->orderBy('start_date', 'desc')
            ->latest()->first();
    }

    public static function subscribe($plan)
    {
        auth()->user()->plans()->create([
            'plan' => $plan,
            'start_date' => now(),
            'end_date' => now()->addDays(90),
        ]);
    }
}
