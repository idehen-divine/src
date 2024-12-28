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

    public static function deduct($amount)
    {
        $balance = auth()->user()->wallet->balance;
        if ($balance > $amount) {
            auth()->user()->wallet->decrement('balance', $amount);
            return auth()->user()->transactions()->create([
                'transaction_reference' => 'trx_' . Str::random(12),
                'amount' => $amount,
                'transaction_type' => 'debit',
                'description' => 'Withdraw to bank',
            ]);
        }
        return false;
    }
}
