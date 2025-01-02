<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaystackRecipient
{
    use Service;

    public function __construct()
    {
        $this->initPaystack();
    }

    public function all()
    {
        $response = $this->getUrl('/transferrecipient');

        return $response->json();
    }

    public function create($name, $bank_code, $account_number)
    {
        $response = $this->postUrl('/transferrecipient', [
            'type' => 'nuban',
            'name' => $name,
            'account_number' => $account_number,
            'bank_code' => $bank_code,
            'currency' => 'NGN'
        ]);

        return $response->json();
    }

    public function get($recipient_code)
    {
        $response = $this->getUrl('/transferrecipient/' . $recipient_code);

        return $response->json();
    }

    public function update($recipient_code, $name)
    {
        $response = $this->putUrl('/transferrecipient/' . $recipient_code, [
            'name' => $name,
        ]);

        return $response->json();
    }

    public function delete($recipient_code)
    {
        $response = $this->deleteUrl('/transferrecipient/' . $recipient_code);

        return $response->json();
    }
}
