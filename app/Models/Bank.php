<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_name',
        'account_number',
        'bank_name',
        'bank_code',
        'recipient_code',
        'country_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
