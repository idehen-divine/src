<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'customer_code',
        'account_id',
        'account_number',
        'account_name',
        'bank_name',
        'balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public static function deduct($amount, $description = 'Withdraw to bank')
    {
        $balance = auth()->user()->wallet->balance;
        if ($balance > $amount) {
            auth()->user()->wallet->decrement('balance', $amount);
            return auth()->user()->transactions()->create([
                'transaction_reference' => 'trx_' . Str::random(16),
                'amount' => $amount,
                'transaction_type' => 'debit',
                'description' => $description,
            ]);
        }
        return false;
    }

    public function deposit($amount, $description = 'Deposit from bank')
    {
        $this->user->wallet->increment('balance', $amount);
        return $this->user->transactions()->create([
            'transaction_reference' => 'adc_' . Str::random(12),
            'amount' => $amount,
            'status' => 'successful',
            'processed_at' => now(),
            'transaction_type' => 'credit',
            'description' => $description,
        ]);
    }

    public function withdraw($amount, $description = 'Withraw from wallet')
    {
        $balance = $this->user->wallet->balance;
        if ($balance >= $amount) {
            $this->user->wallet->decrement('balance', $amount);
            return $this->user->transactions()->create([
                'transaction_reference' => 'adb_' . Str::random(12),
                'amount' => $amount,
                'status' => 'successful',
                'processed_at' => now(),
                'transaction_type' => 'debit',
                'description' => $description,
            ]);
        }

        throw new \Exception('Insufficient balance for the requested withdrawal.');
    }
}
