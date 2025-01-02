<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaystackTransfer
{
    use Service;

    protected static $recipient;

    public function __construct()
    {
        $this->initPaystack();
    }

    public static function recipient()
    {
        if (self::$recipient === null) {
            self::$recipient = new PaystackRecipient();
        }
        return self::$recipient;
    }

    public function all()
    {
        $response = $this->getUrl('/transfer');

        return $response->json();
    }

    public function create($recipient, $amount, $reference, $reason = null)
    {
        $response = $this->postUrl('/transfer', [
            'source' => 'balance',
            'reason' => $reason,
            'amount' => $amount,
            'recipient' => $recipient,
            'reference' => $reference,
        ]);

        return $response->json();
    }

    public function get($transfer_code)
    {
        $response = $this->getUrl('/transfer/' . $transfer_code);

        return $response->json();
    }

    public function verify($reference)
    {
        $response = $this->getUrl('/transfer/verify/' . $reference);

        return $response->json();
    }

    public function balance()
    {
        $response = $this->getUrl('/balance');
        return $response->json();
    }
}
