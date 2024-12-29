<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'plan', 'amount', 'status', 'start_date', 'end_date'];

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

    public function returnCapital()
    {
        $amount = $this->amount * $this->dailyCheckin->count();
        auth()->user()->wallet->increment('balance', $amount);
        return auth()->user()->transactions()->create([
            'transaction_reference' => 'dpi_' . Str::random(12),
            'amount' => $amount,
            'status' => 'successful',
            'processed_at' => now(),
            'transaction_type' => 'credit',
            'description' =>  'Deposit from investment',
        ]);
    }

    public function returnInterest()
    {
        $amount = ($this->amount * $this->dailyCheckin->count()) * ($this->amount == 500 ? 0.025 : 0.05);
        auth()->user()->wallet->increment('balance', $amount);
        return auth()->user()->transactions()->create([
            'transaction_reference' => 'pii_' . Str::random(12),
            'amount' => $amount,
            'status' => 'successful',
            'processed_at' => now(),
            'transaction_type' => 'credit',
            'description' =>  'Plan investment interest',
        ]);
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
            'amount' => $plan === 1 ? 500 : 1000,
            'start_date' => now(),
            'end_date' => now()->addDays(90),
        ]);
    }
}
